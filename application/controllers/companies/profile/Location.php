<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }
      
      $this->form_validation->set_rules('latitude', 'Latitude', 'trim|max_length[100]');
      $this->form_validation->set_rules('longitude', 'Longitude', 'trim|max_length[100]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'latitude' => antiInjection($this->input->post('latitude')),
        'longitude' => antiInjection($this->input->post('longitude'))
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