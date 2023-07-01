<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'companies';
    $this->data['metatags'] = $this->getMetatags('signup');
  }

  public function index () {
    redirect('empresas/entrar');

    $isLoggedIn = $this->isCompanyLoggedIn();
    if ($isLoggedIn) redirect($this->session->userdata('company')['username']);
    
    $isCandidateLoggedIn = $this->isCandidateLoggedIn();
    if ($isCandidateLoggedIn) redirect('candidates/profile');

    $this->load->view('companies/signup/index', $this->data);
  }

  public function save () {
    try {
      $this->form_validation->set_rules('name', 'Nome', 'trim|required');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
      $this->form_validation->set_rules('username', 'Nome de usuário', 'trim|required|max_length[20]');
      $this->form_validation->set_rules('password', 'Senha', 'trim|required');
      $this->form_validation->set_rules('password_confirmation', 'Confirmar senha', 'trim|required');
  
      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $email = antiInjection($this->input->post('email'));

      if (!validEmail($email)) {
        return $this->response(['success' => false, 'error' => 'Digite um e-mail válido']);
      }

      $this->load->model('companiesModel');
      $emailAlreadyExists = $this->companiesModel->count(['email' => $email]) >= 1;
  
      if ($emailAlreadyExists) {
        return $this->response(['success' => false, 'error' => 'Este e-mail já está cadastrado']);
      }
      
      $username = antiInjection($this->input->post('username'));
      $usernameAlreadyExists = $this->companiesModel->count(['username' => $username]) > 1;
  
      if ($usernameAlreadyExists) {
        return $this->response(['success' => false, 'error' => 'Este nome de usuário já está cadastrado']);
      }

      $data = [
        'name' => antiInjection($this->input->post('name')),
        'email' => antiInjection($email),
        'username' => antiInjection($username),
        'password' => encodeCrip(antiInjection($this->input->post('password'))),
      ];

      $createdCompanyId = $this->companiesModel->create($data);

      if (!$createdCompanyId) {
        return $this->response(['success' => false, 'error' => 'Erro ao se cadastrar, tente novamente']);
      }
  
      $company = [
        'id' => $createdCompanyId,
        'name' => $data['name'],
        'email' => $data['email'],
        'username' => $data['username'],
        'image' => null
      ];
  
      $this->session->set_userdata('company', $company);
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao se cadastrar, se continuar entre em contato']);
    }
  }
}