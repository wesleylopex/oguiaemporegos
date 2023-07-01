<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewPassword extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }
      
      $this->form_validation->set_rules('password', 'Senha antiga', 'trim|required');
      $this->form_validation->set_rules('new_password', 'Nova senha', 'trim|required');
      $this->form_validation->set_rules('new_password_confirmation', 'Confirmar nova senha', 'trim|required|matches[new_password]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $this->load->model('candidatesModel');
      
      $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);
      $password = antiInjection($this->input->post('password'));

      $validatedCandidate = $this->candidatesModel->validateCredentials($candidate->email, $password);

      if (!$validatedCandidate) {
        return $this->response(['success' => false, 'error' => 'Senha antiga incorreta, tente novamente']);
      }

      $newPassword = antiInjection($this->input->post('new_password'));

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'password' => encodeCrip($newPassword)
      ];

      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}