<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CreateInterest extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function save () {
    try {
      $this->form_validation->set_rules('job_id', 'Vaga de emprego', 'trim|required');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'job_id' => antiInjection($this->input->post('job_id'))
      ];

      $this->load->model('jobsModel');
      
      $job = $this->jobsModel->getByPrimary($data['job_id']);

      if (!$job) {
        return $this->response(['success' => false, 'error' => 'Vaga de emprego inválida']);
      }

      $this->load->model('interestsModel');

      $alreadyCreated = $this->interestsModel->getRowWhere(['job_id' => $data['job_id'], 'candidate_id' => $data['candidate_id']]);

      if ($alreadyCreated) {
        return $this->response(['success' => false, 'error' => 'Você já está concorrendo à esta vaga']);
      }

      $this->load->model('jobsSituationsModel');

      $situation = $this->jobsSituationsModel->getByPrimary($job->situation_id);

      if ($situation->is_finished) {
        return $this->response(['success' => false, 'error' => 'Esta vaga está finalizada ou cancelada']);
      }

      $created = $this->interestsModel->create($data);

      if (!$created) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }
}