<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'profile';
  }

  public function index () {
    $this->redirectIfCandidateNotLoggedIn('entrar');

    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary($this->session->userdata('candidate')['id']);

    if (!$candidate) {
      redirect('candidates/login/logout');
    }

    $this->data['metatags'] = (object) [
      'title' => 'Perfil de ' . $candidate->name,
      'description' => 'Perfil do(a) candidato(a) ' . $candidate->name
    ];

    $candidate->age = $candidate->birthdate ? getAge($candidate->birthdate) : null;

    $this->load->model('interestsModel');
    $this->data['todayInterestsLength'] = $this->interestsModel->getTodayInterestsLengthByCandidate($candidate->id);

    $this->load->model('candidatesFormationsModel');
    $candidate->formations = $this->candidatesFormationsModel->getAllWhere(['candidate_id' => $candidate->id]);
    
    $this->load->model('candidatesCoursesModel');
    $candidate->courses = $this->candidatesCoursesModel->getAllWhere(['candidate_id' => $candidate->id]);
    
    $this->load->model('candidatesExperiencesModel');
    $experiences = $this->candidatesExperiencesModel->getAllWhere(['candidate_id' => $candidate->id]);
    $candidate->experiences = $this->getExperiencesWithAreas($experiences);
    
    $this->load->model('candidatesLanguagesModel');
    $candidate->languages = $this->candidatesLanguagesModel->getAllWhere(['candidate_id' => $candidate->id]);

    $this->load->model('interestsModel');
    $candidate->interests_length = $this->interestsModel->count(['candidate_id'=> $candidate->id]);

    $this->data['candidate'] = $candidate;

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->view('candidates/profile/profile', $this->data);
  }

  private function getExperiencesWithAreas (array $experiences) : array {
    $this->load->model('jobsAreasModel');
    
    foreach ($experiences as $experience) {
      $experience->area = $this->jobsAreasModel->getByPrimary($experience->area_id);
    }

    return $experiences;
  }
}