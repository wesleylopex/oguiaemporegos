<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PersonalInfo extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('cadastro');
    $this->load->view('candidates/signup/personal-info', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('birthdate', 'Data de nascimento', 'trim|required');
      $this->form_validation->set_rules('phone', 'Celular / Telefone', 'trim|required|numeric|max_length[11]');
      $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|numeric|max_length[11]');
      $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
      $this->form_validation->set_rules('rg', 'RG', 'trim|required|numeric|exact_length[10]');
      $this->form_validation->set_rules('genre', 'Gênero', 'trim|required');
      $this->form_validation->set_rules('marital_status', 'Estado civil', 'trim|required');
  
      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'birthdate' => antiInjection($this->input->post('birthdate')),
        'phone' => antiInjection($this->input->post('phone')),
        'whatsapp' => antiInjection($this->input->post('whatsapp')),
        'cpf' => antiInjection($this->input->post('cpf')),
        'rg' => antiInjection($this->input->post('rg')),
        'genre' => antiInjection($this->input->post('genre')),
        'marital_status' => antiInjection($this->input->post('marital_status'))
      ];

      $data['birthdate'] = implode('-', array_reverse(explode('/', $data['birthdate'])));

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