<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Info extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCompanyNotLoggedIn('empresas/cadastro');
    $this->load->view('companies/signup/info', $this->data);
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('latitude', 'Latitude', 'trim');
      $this->form_validation->set_rules('longitude', 'Longitude', 'trim');
      $this->form_validation->set_rules('description', 'Descrição', 'trim|max_length[200]');
  
      if ($this->form_validation->run() == false) {
        echo json_encode(['success' => false, 'error' => strip_tags(validation_errors())]);
        return false;
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'latitude' => antiInjection($this->input->post('latitude')),
        'longitude' => antiInjection($this->input->post('longitude')),
        'description' => antiInjection($this->input->post('description'))
      ];

      $this->load->model('companiesModel');
      $updated = $this->companiesModel->update($data);

      if (!$updated) {
        echo json_encode(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
        return false;
      }

      echo json_encode(['success' => true]);
      return false;
    } catch (\Throwable $th) {
      echo json_encode(['success' => false, 'error' => 'Erro salvar, se continuar entre em contato']);
      return false;
    }
  }
}