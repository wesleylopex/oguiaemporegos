<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Interests extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'profile';
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('entrar');
    
    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);

    if (!$candidate) {
      redirect('entrar');
    }

    $this->data['metatags'] = (object) [
      'title' => 'Interesses de ' . $candidate->name,
      'description' => 'Interesses do(a) candidato(a) ' . $candidate->name
    ];

    $this->load->model('interestsModel');
    $this->data['todayInterestsLength'] = $this->interestsModel->getTodayInterestsLengthByCandidate($candidate->id);

    $this->data['candidate'] = $candidate;

    $this->load->model('jobsModel');
    $jobs = $this->jobsModel->getByCandidate($candidate->id);
    $this->data['jobs'] = $this->getJobsWithInterestSituations($jobs);
    
    $this->load->view('candidates/profile/interests', $this->data);
  }

  private function getJobsWithInterestSituations (array $jobs) : array {
    $this->load->model('interestsModel');
    $this->load->model('interestsSituationsModel');
    
    foreach ($jobs as $job) {
      $interest = $this->interestsModel->getRowWhere([
        'candidate_id' => $this->session->userdata('candidate')['id'],
        'job_id' => $job->id
      ]);
      
      if ($interest) {
        $interest->situation = $this->interestsSituationsModel->getByPrimary($interest->situation_id);
        
        $job->interest = $interest;
      }
    }

    return $jobs;
  }

  public function delete () {
    try {
      $isLoggedIn = $this->isCandidateLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('job-id', 'Vaga de emprego', 'trim|required|is_natural_no_zero');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $this->load->model('interestsModel');

      $interest = $this->interestsModel->getRowWhere([
        'job_id' => $this->input->post('job-id'),
        'candidate_id' => $this->session->userdata('candidate')['id']
      ]);

      if (!$interest) {
        return $this->response(['success' => false, 'error' => 'Interesse inválido']);
      }

      $deleted = $this->interestsModel->delete($interest->id);

      if (!$deleted) {
        return $this->response(['success' => false, 'error' => 'Erro ao remover, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Interesse removido com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao remover, se continuar entre em contato']);
    }
  }
}