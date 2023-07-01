<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Experiences extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function delete ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesExperiencesModel');
    $data = $this->candidatesExperiencesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Experiência não encontrada']);
    }
    
    if ($data->candidate_id != $this->session->userdata('candidate')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    $deleted = $this->candidatesExperiencesModel->delete($id);

    if (!$deleted) {
      return $this->response(['success' => false, 'error' => 'Não foi possível remover a experiência']);
    }

    $this->session->set_flashdata('success', 'Experiência removida com sucesso');
    return $this->response(['success' => true]);
  }

  public function get ($id) {
    $isLoggedIn = $this->isCandidateLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('candidatesExperiencesModel');
    $data = $this->candidatesExperiencesModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Experiência não encontrada']);
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
      $this->form_validation->set_rules('company_name', 'Nome da empresa', 'trim|required');
      $this->form_validation->set_rules('function', 'Cargo', 'trim|required');
      $this->form_validation->set_rules('area_id', 'Área', 'trim|required|is_natural_no_zero');
      $this->form_validation->set_rules('salary', 'Salário final', 'trim|required|is_natural');
      $this->form_validation->set_rules('entry_date', 'Data de entrada', 'trim|required');
      $this->form_validation->set_rules('exit_date', 'Data de saída', 'trim');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => antiInjection($this->input->post('id')),
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'company_name' => antiInjection($this->input->post('company_name')),
        'function' => antiInjection($this->input->post('function')),
        'area_id' => antiInjection($this->input->post('area_id')),
        'salary' => antiInjection($this->input->post('salary')),
        'entry_date' => antiInjection($this->input->post('entry_date')),
        'exit_date' => antiInjection($this->input->post('exit_date'))
      ];

      $this->load->model('jobsAreasModel');
      $isAreaValid = !!$this->jobsAreasModel->getByPrimary($data['area_id']);
      if (!$isAreaValid) {
        return $this->response(['success' => false, 'error' => 'Área inválida']);
      }

      $data['entry_date'] = implode('-', array_reverse(explode('/', $data['entry_date'])));
      $data['exit_date'] = $data['exit_date'] ? implode('-', array_reverse(explode('/', $data['exit_date']))) : null;

      $this->load->model('candidatesExperiencesModel');
      
      if ($data['id']) {
        $saved = $this->candidatesExperiencesModel->update($data);
      } else {
        unset($data['id']);
        $saved = $this->candidatesExperiencesModel->create($data);
      }

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Experiência salva com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}