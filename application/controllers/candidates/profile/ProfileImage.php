<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProfileImage extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

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

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'image' => antiInjection($fileName),
      ];

      $this->deletePreviousProfileImage();

      $this->load->model('candidatesModel');
      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        $this->session->set_flashdata('error', 'Erro ao salvar, tente novamente');
        return $this->goToPreviousPage();
      }

      $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);

      $this->session->set_userdata('candidate', [
        'id' => $this->session->userdata('candidate')['id'],
        'name' => $candidate->name,
        'email' => $candidate->email,
        'image' => $candidate->image
      ]);

      $this->session->set_flashdata('success', 'Imagem de perfil atualizada com sucesso');
      return $this->goToPreviousPage();
    } catch (\Throwable $th) {
      $this->session->set_flashdata('error', 'Erro ao salvar, se continuar entre em contato');
      return $this->goToPreviousPage();
    }
  }

  private function deletePreviousProfileImage () {
    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);
    
    if (!$candidate) {
      return false;
    }

    $fileName = $candidate->image;

    if (!$fileName) {
      return false;
    }

    $this->load->model('filesModel');
    return $this->filesModel->removeFile(
      'candidates/',
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
      'candidates',
      'candidates-' . $fileName,
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