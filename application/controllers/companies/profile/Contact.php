<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }
      
      $this->form_validation->set_rules('instagram', 'Instagram', 'trim|max_length[200]');
      $this->form_validation->set_rules('facebook', 'Facebook', 'trim|max_length[200]');
      $this->form_validation->set_rules('website', 'Website', 'trim|max_length[200]');
      $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|max_length[200]');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|max_length[200]');
      $this->form_validation->set_rules('phone', 'Telefone', 'trim|numeric|max_length[11]');
      $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|numeric|max_length[11]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $email = antiInjection($this->input->post('email'));

      if (!validEmail($email)) {
        echo json_encode(['success' => false, 'error' => 'Digite um e-mail válido']);
        return false;
      }

      $this->load->model('companiesModel');
      $emailAlreadyExists = $this->companiesModel->count([
        'email' => $email,
        'id !=' => $this->session->userdata('company')['id']
      ]) >= 1;
  
      if ($emailAlreadyExists) {
        return $this->response(['success' => false, 'error' => 'Este e-mail já está cadastrado']);
      }

      $data = [
        'id' => $this->session->userdata('company')['id'],
        'instagram' => antiInjection($this->input->post('instagram')),
        'facebook' => antiInjection($this->input->post('facebook')),
        'website' => antiInjection($this->input->post('website')),
        'whatsapp' => antiInjection($this->input->post('whatsapp')),
        'email' => $email,
        'phone' => antiInjection($this->input->post('phone'))
      ];

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