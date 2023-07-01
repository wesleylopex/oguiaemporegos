<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'jobs';
    $this->data['metatags'] = $this->getMetatags($this->data['page']);
  }

  public function index () {    
    $query = $this->input->get('query');
    $cities = $this->input->get('cities');
    $areas = $this->input->get('areas');
    $types = $this->input->get('types');
    $companies = $this->input->get('companies');

    $limit = 8;
    $page = $this->input->get('pagina') ?? 1;
    $offset = ($page - 1) * $limit;

    $onlyValid = true;

    $this->load->model('jobsModel');
    $jobs = $this->jobsModel->search($query, $cities, $areas, $types, $companies, $limit, $offset, $onlyValid);
    $this->data['jobs'] = $this->setInterests($jobs);
    
    $totalRows = $this->jobsModel->countSearch($query, $cities, $areas, $types, $companies, $onlyValid);
    $base = 'vagas-de-emprego?' . $_SERVER['QUERY_STRING'];
    $url = str_replace('&pagina=' . $page, '', $base);
    $pagination = $this->paginate($url, $totalRows, $limit);

    $this->data['pagination'] = $pagination;

    $from = $offset + 1;

    $toBase = $page * $limit;
    $to = $toBase > $totalRows ? $totalRows : $toBase;

    $resultsMessage = "Mostrando de $from até $to de $totalRows resultados totais";
    $this->data['resultsMessage'] = $resultsMessage;

    $this->load->model('jobsSituationsModel');
    $this->data['situations'] = $this->jobsSituationsModel->getAll();

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->model('jobsTypesModel');
    $this->data['types'] = $this->jobsTypesModel->getAll();

    $this->load->model('jobsCitiesModel');
    $this->data['cities'] = $this->jobsCitiesModel->getAll();

    $this->load->model('companiesModel');
    $this->data['companies'] = $this->companiesModel->getAll();

    $this->data['jobsLength'] = $this->jobsModel->count();

    $this->load->view('jobs', $this->data);
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