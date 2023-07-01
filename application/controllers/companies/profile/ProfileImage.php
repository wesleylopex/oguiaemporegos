<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProfileImage extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        $this->session->set_flashdata('error', 'Você precisa estar logado');
        return redirect('entrar');
      }
      
      $response = $this->uploadProfileImage('image');
      
      if (!is_array($response) || !array_key_exists('success', $response) || !$response['success']) {
        $this->session->set_flashdata('error', $response['error']);
        return $this->goToPreviousPage();
      }

      $fileName = $response['file_name'];

      if (!$fileName) {
        $this->session->set_flashdata('error', 'Nome do arquivo inválido, tente novamente');
        return $this->goToPreviousPage();
      }

      $validationErros = strip_tags(validation_errors());

      if ($validationErros) {
        return $this->response(['success' => false, 'error' => $validationErros]);
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'image' => antiInjection($fileName),
      ];

      $this->deletePreviousProfileImage();

      $this->load->model('companiesModel');
      $updated = $this->companiesModel->update($data);

      if (!$updated) {
        $this->session->set_flashdata('error', 'Erro ao salvar, tente novamente');
        return $this->goToPreviousPage();
      }

      $company = $this->companiesModel->getByPrimary($this->session->userdata('company')['id']);

      $this->session->set_userdata('company', [
        'id' => $this->session->userdata('company')['id'],
        'name' => $company->name,
        'email' => $company->email,
        'username' => $company->username,
        'image' => $company->image
      ]);

      $this->session->set_flashdata('success', 'Imagem de perfil atualizada com sucesso');
      return $this->goToPreviousPage();
    } catch (\Throwable $th) {
      $this->session->set_flashdata('error', 'Erro ao salvar, se continuar entre em contato');
      return $this->goToPreviousPage();
    }
  }

  private function deletePreviousProfileImage () {
    $this->load->model('companiesModel');
    $company = $this->companiesModel->getByPrimary($this->session->userdata('company')['id']);
    
    if (!$company) {
      return false;
    }

    $fileName = $company->image;

    if (!$fileName) {
      return false;
    }

    $this->load->model('filesModel');
    return $this->filesModel->removeFile(
      'companies/',
      $fileName,
      'image'
    );
  }

  private function uploadProfileImage ($fieldName) {
    if (!array_key_exists($fieldName, $_FILES)) {
      return ['success' => false, 'error' => 'Arquivo não encontrado'];
    }

    $file = $_FILES[$fieldName];
    $fileName = $file['name'];

    if (!$fileName) {
      return ['success' => false, 'error' => 'Arquivo inválido'];
    }

    $this->load->model('filesModel');
    $response = $this->filesModel->uploadFile(
      'companies',
      'companies-' . $fileName,
      $fieldName,
      'image'
    );
    
    if (!$response['success']) {
      return ['success' => false, 'error' => $response['error']];
    }

    $fileName = $response['uploadData']['file_name'];
    return ['success' => true, 'file_name' => $fileName];
  }
}