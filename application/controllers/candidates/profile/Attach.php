<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attach extends SiteController {
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

      $response = $this->uploadResumeFile('resume_file');
      
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
        'resume_file' => antiInjection($fileName),
      ];

      $this->deletePreviousResumeFile();

      $this->load->model('candidatesModel');
      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        $this->session->set_flashdata('error', 'Erro ao salvar, tente novamente');
        return $this->goToPreviousPage();
      }

      $this->session->set_flashdata('success', 'Arquivo atualizado com sucesso');
      return redirect('candidates/profile');
    } catch (\Throwable $th) {
      $this->session->set_flashdata('error', 'Erro ao salvar, se continuar entre em contato');
      return $this->goToPreviousPage();
    }
  }

  private function deletePreviousResumeFile () {
    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);
    
    if (!$candidate) {
      return false;
    }

    $fileName = $candidate->resume_file;

    if (!$fileName) {
      return false;
    }

    $this->load->model('filesModel');
    return $this->filesModel->removeFile(
      'candidates/',
      $fileName,
      'file'
    );
  }

  private function uploadResumeFile ($fieldName) {
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
      'file'
    );

    if (!$response['success']) {
      return ['success' => false, 'error' => $response['error']];
    }

    $fileName = $response['uploadData']['file_name'];
    return ['success' => true, 'file_name' => $fileName];
  }
}