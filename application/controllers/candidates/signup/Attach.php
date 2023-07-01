<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attach extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('cadastro');
    $this->load->view('candidates/signup/attach', $this->data);
  }

  public function save () {
    try {
      $response = $this->uploadResumeFile('resume_file');
      
      if (!array_key_exists('success', $response) || !$response['success']) {
        return $this->response(['success' => false, 'error' => $response['error']]);
      }

      $fileName = $response['file_name'];

      if (!$fileName) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar o arquivo, tente novamente']);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'resume_file' => antiInjection($fileName),
      ];

      $this->deletePreviousResumeFile();

      $this->load->model('candidatesModel');
      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
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
    if (!array_key_exists($fieldName, $_FILES)) return false;

    $file = $_FILES[$fieldName];
    $fileName = $file['name'];

    if (!$fileName) return false;

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