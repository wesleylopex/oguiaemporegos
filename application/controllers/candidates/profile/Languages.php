<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function delete ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesLanguagesModel');
    $data = $this->candidatesLanguagesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Idioma não encontrado']);
    }
    
    if ($data->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    $deleted = $this->candidatesLanguagesModel->delete($id);

    if (!$deleted) {
      return $this->response(['success' => false, 'error' => 'Não foi possível remover o idioma']);
    }

    $this->session->set_flashdata('success', 'Idioma removido com sucesso');
    return $this->response(['success' => true]);
  }

  public function get ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesLanguagesModel');
    $data = $this->candidatesLanguagesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Idioma não encontrado']);
    }
    
    if ($data->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    return $this->response(['success' => true, 'data' => $data]);
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('id', 'Id', 'trim|is_natural_no_zero');
      $this->form_validation->set_rules('language', 'Idioma', 'trim|required');
      $this->form_validation->set_rules(
        'level',
        'Nível',
        'trim|required|in_list[Básico,Intermediário,Técnico,Avançado,Fluente]',
        ['in_list' => 'Nível inválido']
      );

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => antiInjection($this->input->post('id')),
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'language' => antiInjection($this->input->post('language')),
        'level' => antiInjection($this->input->post('level'))
      ];

      $this->load->model('candidatesLanguagesModel');
      if ($data['id']) {
        $saved = $this->candidatesLanguagesModel->update($data);
      } else {
        unset($data['id']);
        $saved = $this->candidatesLanguagesModel->create($data);
      }

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Idioma salvo com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}