<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProfessionalGoals extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('cadastro');
    $this->load->view('candidates/signup/professional-goals', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('function_1', 'Cargo desejado 1', 'trim|required');
      $this->form_validation->set_rules('function_2', 'Cargo desejado 2', 'trim');
      $this->form_validation->set_rules('function_3', 'Cargo desejado 3', 'trim');
      $this->form_validation->set_rules('desired_salary', 'Salário pretendido', 'trim|required');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'function_1' => antiInjection($this->input->post('function_1')),
        'function_2' => antiInjection($this->input->post('function_2')),
        'function_3' => antiInjection($this->input->post('function_3')),
        'desired_salary' => antiInjection($this->input->post('desired_salary'))
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