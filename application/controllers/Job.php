<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'jobs';
    $this->data['metatags'] = $this->getMetatags($this->data['page']);
  }

  public function index ($jobSlug) {
    $this->load->model('jobsModel');
    $job = $this->jobsModel->getRowWhere(['slug' => $jobSlug]);

    if (!$job) redirect('vagas-de-emprego');

    $job = $this->jobsModel->getJobWithForeignRows($job);
    $candidate = $this->session->userdata('candidate');
    
    if ($candidate) {
      $this->load->model('interestsModel');
      $interest = $this->interestsModel->getRowWhere(['candidate_id' => $candidate['id'], 'job_id' => $job->id]);
      
      if ($interest) {
        $this->load->model('interestsSituationsModel');
        $interest->situation = $this->interestsSituationsModel->getByPrimary($interest->situation_id);

        $job->interest = $interest;
      }
    }

    $this->data['metatags']->title = $job->title;
    $this->data['job'] = $job;

    $relatedJobs = $this->jobsModel->getAllWithForeign([
      'jobs.id !=' => $job->id,
      'company_id' => $job->company_id
    ], 2, null, true);

    $this->data['relatedJobs'] = $this->setInterests($relatedJobs);

    $this->load->view('job', $this->data);
  }

  private function setInterests (?array $jobs) : ?array {
    $candidate = $this->session->userdata('candidate');
    
    if (!$candidate) {
      return $jobs;
    }

    $this->load->model('interestsModel');
    $this->load->model('interestsSituationsModel');

    foreach ($jobs as $job) {
      $interest = $this->interestsModel->getRowWhere(['candidate_id' => $candidate['id'], 'job_id' => $job->id]);
      
      if ($interest) {
        $interest->situation = $this->interestsSituationsModel->getByPrimary($interest->situation_id);
        $job->interest = $interest;
      }
    }

    return $jobs;
  }
}