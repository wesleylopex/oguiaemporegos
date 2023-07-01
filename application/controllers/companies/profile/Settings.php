<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }
      
      $this->form_validation->set_rules('name', 'Nome da empresa', 'trim|required|max_length[200]');
      $this->form_validation->set_rules('username', 'Nome de usuário', 'trim|required|max_length[200]|alpha_dash');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $this->load->model('companiesModel');

      $username = antiInjection($this->input->post('username'));
      $usernameAlreadyExists = $this->companiesModel->count([
        'username' => $username,
        'id !=' => $this->session->userdata('company')['id']
      ]) >= 1;
  
      if ($usernameAlreadyExists) {
        return $this->response(['success' => false, 'error' => 'Este nome de usuário já está cadastrado']);
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'name' => antiInjection($this->input->post('name')),
        'username' => $username
      ];

      $updated = $this->companiesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Configurações salvas com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}