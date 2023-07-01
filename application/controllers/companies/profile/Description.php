<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Description extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }
      
      $this->form_validation->set_rules('description', 'Descrição', 'trim|required|max_length[200]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'description' => antiInjection($this->input->post('description'))
      ];

      $this->load->model('companiesModel');
      $updated = $this->companiesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}