<?php
class Login extends CI_Controller {
  function __construct () {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('utils');
    $this->load->library('form_validation');
  }

  public function index () {
    $this->data['nomes']['plural'] = 'Login';
    $this->load->view('admin/login/form', $this->data);
  }

  public function signin () {
    $this->session->unset_userdata('admin');

    $this->form_validation->set_rules('username', 'Usuário', 'trim|required');
    $this->form_validation->set_rules('password', 'Senha', 'trim|required');

    if ($this->form_validation->run() != false) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $this->load->model('administratorsModel');
      $validatedAdmin = $this->administratorsModel->validate($username, $password);

      if ($validatedAdmin != false) {
        $user = [
          'id' => $validatedAdmin->id,
          'name' => $validatedAdmin->name,
          'username' => $validatedAdmin->username
        ];

        $this->session->set_userdata('admin', $user);

        redirect('admin/home');
      }  
    }

    redirect('admin/login');
  }

  function logout () {
    $this->session->unset_userdata('admin');
    redirect('admin/login');
  }
}