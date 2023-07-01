<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('cadastro');
    $this->load->view('candidates/signup/address', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('address_zip_code', 'CEP', 'trim|required');
      $this->form_validation->set_rules('address_street', 'Rua', 'trim|required');
      $this->form_validation->set_rules('address_number', 'Número', 'trim|required');
      $this->form_validation->set_rules('address_neighborhood', 'Bairro', 'trim|required');
      $this->form_validation->set_rules('address_complement', 'Complemento', 'trim');
      $this->form_validation->set_rules('address_uf', 'UF', 'trim|required');
      $this->form_validation->set_rules('address_city', 'Cidade', 'trim|required');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'address_zip_code' => antiInjection($this->input->post('address_zip_code')),
        'address_street' => antiInjection($this->input->post('address_street')),
        'address_number' => antiInjection($this->input->post('address_number')),
        'address_neighborhood' => antiInjection($this->input->post('address_neighborhood')),
        'address_complement' => antiInjection($this->input->post('address_complement')),
        'address_uf' => antiInjection($this->input->post('address_uf')),
        'address_city' => antiInjection($this->input->post('address_city'))
      ];

      $this->load->model('candidatesModel');
      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se persistir, entre em contato']);
    }
  }
}