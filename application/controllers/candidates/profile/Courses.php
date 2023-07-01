<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function delete ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesCoursesModel');
    $data = $this->candidatesCoursesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Curso não encontrado']);
    }
    
    if ($data->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    $deleted = $this->candidatesCoursesModel->delete($id);

    if (!$deleted) {
      return $this->response(['success' => false, 'error' => 'Não foi possível remover o curso']);
    }

    $this->session->set_flashdata('success', 'Curso removido com sucesso');
    return $this->response(['success' => true]);
  }

  public function get ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesCoursesModel');
    $data = $this->candidatesCoursesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Curso não encontrado']);
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
      $this->form_validation->set_rules('course_name', 'Nome do curso', 'trim|required');
      $this->form_validation->set_rules('institution_name', 'Nome da instituição', 'trim|required');
      $this->form_validation->set_rules('hours', 'Horas', 'trim|required|is_natural_no_zero|max_length[4]');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => antiInjection($this->input->post('id')),
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'course_name' => antiInjection($this->input->post('course_name')),
        'institution_name' => antiInjection($this->input->post('institution_name')),
        'hours' => antiInjection($this->input->post('hours'))
      ];

      $this->load->model('candidatesCoursesModel');
      if ($data['id']) {
        $saved = $this->candidatesCoursesModel->update($data);
      } else {
        unset($data['id']);
        $saved = $this->candidatesCoursesModel->create($data);
      }

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Curso salvo com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}