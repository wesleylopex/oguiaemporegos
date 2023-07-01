<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SiteController {
  function __construct () {
    parent::__construct();
    
    $this->data['page'] = 'profile';
  }

  public function index (string $companyUsername = null) {
    $this->load->model('companiesModel');

    if ($companyUsername) {
      $company = $this->companiesModel->getRowWhere(['username' => $companyUsername]);
    }

    $sessionCompany = $this->session->userdata('company');

    if ($companyUsername && !isset($company) && is_array($sessionCompany) &&  array_key_exists('id', $sessionCompany)) {
      redirect($this->session->userdata('company')['username']);
    }

    if (!isset($company) && is_array($sessionCompany) &&  array_key_exists('id', $sessionCompany)) { 
      $company = $this->companiesModel->getByPrimary($this->session->userdata('company')['id']);
      
    }
    
    if (!isset($company) || !$company) {
      redirect('home/error');
    }

    $this->load->model('interestsModel');
    $this->data['todayInterestsLength'] = $this->interestsModel->getTodayInterestsLengthByCompany($company->id);

    $this->data['metatags'] = (object) [
      'title' => 'Perfil da empresa ' . $company->name,
      'description' => 'Perfil da empresa ' . $company->name,
      'image' => $company->image ? base_url('assets/uploads/images/companies/' . $company->image) : ''
    ];

    $this->data['company'] = $company;
    
    $companyIsSameLogged = false;

    if (is_array($sessionCompany) &&  array_key_exists('id', $sessionCompany)) {
      $companyIsSameLogged = $sessionCompany['id'] == $company->id;
    }

    $this->data['canUpdate'] = !!$sessionCompany && $companyIsSameLogged;

    $this->load->model('jobsModel');
    
    $query = $this->input->get('query');
    $cities = $this->input->get('cities');
    $areas = $this->input->get('areas');
    $types = $this->input->get('types');

    $limit = 6;
    $page = $this->input->get('pagina') ?? 1;
    $offset = ($page - 1) * $limit;

    $this->load->model('jobsModel');
    $jobs = $this->jobsModel->search($query, $cities, $areas, $types, [$company->id], $limit, $offset);
    $jobs = $this->getJobsCandidates($jobs);
    
    $totalRows = $this->jobsModel->countSearch($query, $cities, $areas, $types, [$company->id]);
    $base = $company->username . '?' . $_SERVER['QUERY_STRING'];
    $url = str_replace("&pagina=$page", '', $base);
    $pagination = $this->paginate($url, $totalRows, $limit);

    $from = $totalRows > 0 ? ($offset + 1) : $offset;
    $toBase = $page * $limit;
    $to = $toBase > $totalRows ? $totalRows : $toBase;
    $resultsMessage = "Mostrando de $from até $to de $totalRows resultados totais";

    $this->data['resultsMessage'] = $resultsMessage;
    $this->data['pagination'] = $pagination;
    $this->data['jobs'] = $jobs;

    $this->load->model('jobsSituationsModel');
    $this->data['situations'] = $this->jobsSituationsModel->getAll();

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->model('jobsTypesModel');
    $this->data['types'] = $this->jobsTypesModel->getAll();

    $this->load->model('jobsCitiesModel');
    $this->data['cities'] = $this->jobsCitiesModel->getAll();

    $this->load->view('companies/profile/profile', $this->data);
  }

  private function getJobsCandidates (array $jobs): array {
    foreach ($jobs as $job) {
      $job->candidates = $this->getJobCandidates($job);
    }

    return $jobs;
  }

  private function getJobCandidates ($job): array {
    $this->load->model('interestsModel');
    $this->load->model('candidatesModel');

    $interests = $this->interestsModel->getAllWhere(['job_id' => $job->id]);
      
    $candidates = [];
    
    foreach ($interests as $interest) {
      $candidate = $this->candidatesModel->getByPrimary($interest->candidate_id);
      array_push($candidates, $candidate);
    }

    return $candidates;
  }
}