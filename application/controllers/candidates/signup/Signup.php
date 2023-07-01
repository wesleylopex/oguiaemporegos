<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['metatags'] = $this->getMetatags('signup');
  }

  public function index () {
    $isLoggedIn = $this->isCandidateLoggedIn();
    if ($isLoggedIn) redirect('candidates/profile');

    $isCompanyLoggedIn = $this->isCompanyLoggedIn();
    if ($isCompanyLoggedIn) redirect($this->session->userdata('company')['username']);

    $this->load->view('candidates/signup/index', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]');
      $this->form_validation->set_rules(
        'email',
        'E-mail',
        'trim|required|is_unique[candidates.email]',
        ['is_unique' => 'Este e-mail já está cadastrado']
      );
      $this->form_validation->set_rules('password', 'Senha', 'trim|required');
      $this->form_validation->set_rules('password_confirmation', 'Confirmar senha', 'trim|required|matches[password]');
  
      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $email = antiInjection($this->input->post('email'));

      if (!validEmail($email)) {
        return $this->response(['success' => false, 'error' => 'Digite um e-mail válido']);
      }

      $data = [
        'name' => antiInjection($this->input->post('name')),
        'email' => antiInjection($email),
        'password' => encodeCrip(antiInjection($this->input->post('password'))),
      ];
      
      $this->load->model('candidatesModel');
      $createdCandidateId = $this->candidatesModel->create($data);

      if (!$createdCandidateId) {
        return $this->response(['success' => false, 'error' => 'Erro ao se cadastrar, tente novamente']);
      }
  
      $candidate = [
        'id' => $createdCandidateId,
        'name' => $data['name'],
        'email' => $data['email'],
        'image' => null
      ];
  
      $this->session->set_userdata('candidate', $candidate);
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao se cadastrar, se continuar entre em contato']);
    }
  }
}