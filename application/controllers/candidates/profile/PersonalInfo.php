<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PersonalInfo extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('name', 'Nome completo', 'trim|required|min_length[3]');
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
      $this->form_validation->set_rules('birthdate', 'Data de nascimento', 'trim|required');
      $this->form_validation->set_rules('phone', 'Celular / Telefone', 'trim|required|numeric|max_length[11]');
      $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|numeric|max_length[11]');
      $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
      $this->form_validation->set_rules('rg', 'RG', 'trim|required|numeric|exact_length[10]');
      $this->form_validation->set_rules(
        'genre',
        'Gênero',
        'trim|required|in_list[Masculino,Feminino,Outro]',
        ['in_list' => 'Gênero inválido']
      );
      $this->form_validation->set_rules(
        'marital_status',
        'Estado civil',
        'trim|required|in_list[Solteiro,Casado,Viúvo,Separado,Divorciado,União estável]',
        ['in_list' => 'Estado civil inválido']
      );

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $email = antiInjection($this->input->post('email'));

      if (!validEmail($email)) {
        return $this->response(['success' => false, 'error' => 'Digite um e-mail válido']);
      }

      $data = [
        'id' => $this->session->userdata('candidate')['id'],
        'name' => antiInjection($this->input->post('name')),
        'email' => $email,
        'birthdate' => antiInjection($this->input->post('birthdate')),
        'phone' => antiInjection($this->input->post('phone')),
        'whatsapp' => antiInjection($this->input->post('whatsapp')),
        'cpf' => antiInjection($this->input->post('cpf')),
        'rg' => antiInjection($this->input->post('rg')),
        'genre' => antiInjection($this->input->post('genre')),
        'marital_status' => antiInjection($this->input->post('marital_status'))
      ];

      $this->load->model('candidatesModel');
      $emailAlreadyExists = $this->candidatesModel->count(['id !=' => $data['id'], 'email' => $data['email']]) > 0;
      
      if ($emailAlreadyExists) {
        return $this->response(['success' => false, 'error' => 'Este e-mail já está cadastrado']);
      }

      $data['birthdate'] = implode('-', array_reverse(explode('/', $data['birthdate'])));

      $updated = $this->candidatesModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Informações salvas com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
    }
  }
}
