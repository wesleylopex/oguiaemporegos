<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Candidate extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index ($candidateId) {
    $this->redirectIfCompanyNotLoggedIn();

    $this->load->model('candidatesModel');
    
    $candidate = $this->candidatesModel->getByPrimary($candidateId);
    if (!$candidate) redirect($this->session->userdata('company')['username']);

    $candidate->age = $candidate->birthdate ? getAge($candidate->birthdate) : null;

    $this->load->model('candidatesFormationsModel');
    $candidate->formations = $this->candidatesFormationsModel->getAllWhere(['candidate_id' => $candidate->id]);
    
    $this->load->model('candidatesCoursesModel');
    $candidate->courses = $this->candidatesCoursesModel->getAllWhere(['candidate_id' => $candidate->id]);
    
    $this->load->model('candidatesExperiencesModel');
    $experiences = $this->candidatesExperiencesModel->getAllWhere(['candidate_id' => $candidate->id]);
    $candidate->experiences = $this->getExperiencesWithAreas($experiences);
    
    $this->load->model('candidatesLanguagesModel');
    $candidate->languages = $this->candidatesLanguagesModel->getAllWhere(['candidate_id' => $candidate->id]);

    $this->data['candidate'] = $candidate;

    $this->load->view('companies/candidates/index', $this->data);
  }

  private function getExperiencesWithAreas (array $experiences) : array {
    $this->load->model('jobsAreasModel');
    
    foreach ($experiences as $experience) {
      $experience->area = $this->jobsAreasModel->getByPrimary($experience->area_id);
    }

    return $experiences;
  }
}