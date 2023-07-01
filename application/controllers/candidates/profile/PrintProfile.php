<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PrintProfile extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function index ($id = null) {
    $isCandidateLoggedIn = $this->isCandidateLoggedIn();
    $isCompanyLoggedIn = $this->isCompanyLoggedIn();

    if (!$isCandidateLoggedIn && !$isCompanyLoggedIn) {
      $this->goToPreviousPage();
    }
    
    if ($isCandidateLoggedIn && $id && $this->session->userdata('candidate')['id'] != $id) {
      $this->goToPreviousPage();
    }

    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary(($id ?? $this->session->userdata('candidate')['id']));

    if (!$candidate) {
      redirect('candidates/login/logout');
    }

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

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->view('candidates/profile/print', $this->data);
  }

  private function getExperiencesWithAreas (array $experiences) : array {
    $this->load->model('jobsAreasModel');
    
    foreach ($experiences as $experience) {
      $experience->area = $this->jobsAreasModel->getByPrimary($experience->area_id);
    }

    return $experiences;
  }
}