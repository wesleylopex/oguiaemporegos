<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    $this->data['page'] = 'home';
    $this->data['metatags'] = $this->getMetatags($this->data['page']);

    $this->load->model('jobsModel');
    $this->data['jobs'] = $this->jobsModel->getAllWithForeign(null, 9, null, true);

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->model('jobsCitiesModel');
    $this->data['cities'] = $this->jobsCitiesModel->getAll();

    $this->data['jobsLength'] = $this->jobsModel->count();

    $this->load->view('index', $this->data);
  }

  public function error () {
    $this->load->view('404', $this->data);
  }

  public function saveContactMessage () {
    try {
      $this->form_validation->set_rules('name', 'Empresa / Nome', 'trim|required|max_length[100]');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required|max_length[100]');
      $this->form_validation->set_rules('message', 'Mensagem', 'trim|required');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $email = $this->input->post('email');

      if (!validEmail($email)) {
        return $this->response(['success' => false, 'error' => 'Digite um e-mail válido']);
      }
      $data = [
        'name' => antiInjection($this->input->post('name')),
        'email' => antiInjection($email),
        'message' => antiInjection($this->input->post('message')),
      ];
      
      $this->load->model('messagesModel');
      $createdId = $this->messagesModel->create($data);

      if (!$createdId) {
        return $this->response(['success' => false, 'error' => 'Não foi possível salvar a mensagem, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao se salvar mensagem, se continuar entre em contato']);
    }
  }
}