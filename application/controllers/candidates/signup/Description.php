<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Description extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('cadastro');
    $this->load->view('candidates/signup/description', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('description', 'Descrição', 'trim|required|max_length[200]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'description' => antiInjection($this->input->post('description'))
      ];

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
}