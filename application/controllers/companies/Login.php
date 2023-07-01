<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'companies';
    $this->data['metatags'] = $this->getMetatags('login');
  }

  public function index () {
    $isLoggedIn = $this->isCompanyLoggedIn();
    if ($isLoggedIn) redirect($this->session->userdata('company')['username']);

    $isCandidateLoggedIn = $this->isCandidateLoggedIn();
    if ($isCandidateLoggedIn) redirect('candidates/profile');

    $this->load->view('companies/login', $this->data);
  }

  public function login () {
    $this->session->unset_userdata('company');

    $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
    $this->form_validation->set_rules('password', 'Senha', 'trim|required');

    if ($this->form_validation->run() == false) {
      echo json_encode(['success' => false, 'error' => strip_tags(validation_errors())]);
      return false;
    }

    $email = antiInjection($this->input->post('email'));
    $password = antiInjection($this->input->post('password'));
    
    $this->load->model('companiesModel');
    $companyExists = $this->companiesModel->count(['email' => $email]) == 1;

    if (!$companyExists) {
      echo json_encode(['success' => false, 'error' => 'E-mail não encontrado, tente novamente']);
      return false;
    }

    $validatedCompany = $this->companiesModel->validateCredentials($email, $password);

    if (!$validatedCompany) {
      echo json_encode(['success' => false, 'error' => 'Senha incorreta, tente novamente']);
      return false;
    }

    try {
      $company = [
        'id' => $validatedCompany->id,
        'name' => $validatedCompany->name,
        'email' => $validatedCompany->email,
        'username' => $validatedCompany->username,
        'image' => $validatedCompany->image
      ];

      $this->session->set_userdata('company', $company);

      echo json_encode(['success' => true, 'data' => ['username' => $company['username']]]);
      return true;
    } catch (\Throwable $th) {
      echo json_encode(['success' => false, 'error' => 'Erro ao logar, se continuar entre em contato']);
      return false;
    }
  }

  public function logout () {
    $this->session->unset_userdata('company');
    redirect('empresas/entrar');
  }
}