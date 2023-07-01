<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Formations extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function delete ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesFormationsModel');
    $data = $this->candidatesFormationsModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Formação não encontrada']);
    }
    
    if ($data->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    $deleted = $this->candidatesFormationsModel->delete($id);

    if (!$deleted) {
      return $this->response(['success' => false, 'error' => 'Não foi possível remover a formação']);
    }

    $this->session->set_flashdata('success', 'Formação removida com sucesso');
    return $this->response(['success' => true]);
  }

  public function get ($formationId) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesFormationsModel');
    $formation = $this->candidatesFormationsModel->getByPrimary($formationId);

    if (!$formation) {
      return $this->response(['success' => false, 'error' => 'Formação não encontrada']);
    }
    
    if ($formation->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    return $this->response(['success' => true, 'data' => $formation]);
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('id', 'Id', 'trim|is_natural_no_zero');
      $this->form_validation->set_rules('formation_degree', 'Grau de formação', 'trim|required');
      $this->form_validation->set_rules('institution_name', 'Nome da instituição', 'trim|required');
      $this->form_validation->set_rules('course_name', 'Nome do curso', 'trim');
      $this->form_validation->set_rules('started_at', 'Data de início', 'trim|required');
      $this->form_validation->set_rules('ended_at', 'Data de conclusão', 'trim');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => antiInjection($this->input->post('id')),
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'formation_degree' => antiInjection($this->input->post('formation_degree')),
        'institution_name' => antiInjection($this->input->post('institution_name')),
        'course_name' => antiInjection($this->input->post('course_name')),
        'started_at' => antiInjection($this->input->post('started_at')),
        'ended_at' => antiInjection($this->input->post('ended_at'))
      ];

      $data['started_at'] = implode('-', array_reverse(explode('/', $data['started_at'])));
      $data['ended_at'] = $data['ended_at'] ? implode('-', array_reverse(explode('/', $data['ended_at']))) : null;

      $this->load->model('candidatesFormationsModel');
      if ($data['id']) {
        $saved = $this->candidatesFormationsModel->update($data);
      } else {
        unset($data['id']);
        $saved = $this->candidatesFormationsModel->create($data);
      }

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Formação salva com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}