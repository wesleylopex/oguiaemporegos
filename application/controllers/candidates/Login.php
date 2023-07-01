<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['metatags'] = $this->getMetatags('login');
  }

  public function index () {
    $isLoggedIn = $this->isCandidateLoggedIn();
    if ($isLoggedIn) redirect('candidates/profile');
    
    $isCompanyLoggedIn = $this->isCompanyLoggedIn();
    if ($isCompanyLoggedIn) redirect($this->session->userdata('company')['username']);

    $this->load->view('candidates/login', $this->data);
  }

  public function login () {
    $this->session->unset_userdata('candidate');

    $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
    $this->form_validation->set_rules('password', 'Senha', 'trim|required');

    if ($this->form_validation->run() == false) {
      return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
    }

    $email = antiInjection($this->input->post('email'));
    $password = antiInjection($this->input->post('password'));
    
    $this->load->model('candidatesModel');
    $candidateExists = $this->candidatesModel->count(['email' => $email]) == 1;

    if (!$candidateExists) {
      return $this->response(['success' => false, 'error' => 'E-mail não encontrado, tente novamente']);
    }

    $validatedCandidate = $this->candidatesModel->validateCredentials($email, $password);

    if (!$validatedCandidate) {
      return $this->response(['success' => false, 'error' => 'Senha incorreta, tente novamente']);
    }

    try {
      $user = [
        'id' => $validatedCandidate->id,
        'name' => $validatedCandidate->name,
        'email' => $validatedCandidate->email,
        'image' => $validatedCandidate->image
      ];

      $this->session->set_userdata('candidate', $user);

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao logar, se continuar entre em contato']);
    }
  }

  public function logout () {
    $this->session->unset_userdata('candidate');
    redirect('entrar');
  }
}