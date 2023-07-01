<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'search-candidates';
  }

  public function index () {
    $company = $this->getCompany();

    $this->data['metatags'] = (object) [
      'title' => 'Pesquisar candidatos',
      'description' => 'Pesquisa de candidatos'
    ];
    
    $this->load->model('interestsModel');
    $this->data['todayInterestsLength'] = $this->interestsModel->getTodayInterestsLengthByCompany($company->id);

    $query = $this->input->get('query');
		$minAge = intval($this->input->get('min-age'));
		$maxAge = intval($this->input->get('max-age'));
		$city = $this->input->get('city');
		$genres = $this->input->get('genres');
		$languages = $this->input->get('languages');
		$onlyAttached = (bool) $this->input->get('only-attached');

    $limit = $this->input->get('limit') ? intval($this->input->get('limit')) : 10;

    $page = $this->input->get('pagina') ?? 1;
    $offset = ($page - 1) * $limit;

		$this->load->model('candidatesModel');
		$this->data['candidates'] = $this->candidatesModel->search($company->id, $query, $minAge, $maxAge, $city, $genres, $languages, $onlyAttached, $limit, $offset);
		
		$totalRows = $this->candidatesModel->countSearch($query, $minAge, $maxAge, $city, $genres, $languages, $onlyAttached);
		
		$base = 'companies/candidates/search?' . $_SERVER['QUERY_STRING'];
    $url = str_replace('&pagina=' . $page, '', $base);
		
		$this->data['pagination'] = $this->paginate($url, $totalRows, $limit);

		$from = $totalRows > 0 ? ($offset + 1) : $offset;
    $toBase = $page * $limit;
    $to = $toBase > $totalRows ? $totalRows : $toBase;

    $resultsMessage = "Mostrando de $from até $to de $totalRows resultados totais";
    $this->data['resultsMessage'] = $resultsMessage;

    $this->load->view('companies/candidates/search', $this->data);
  }

  private function getCompany () {
    $this->redirectIfCompanyNotLoggedIn();
    
    $this->load->model('companiesModel');
    $company = $this->companiesModel->getByPrimary($this->session->userdata('company')['id']);
    
    if (!$company) {
      redirect('entrar');
    }
    
    $this->data['company'] = $company;

    return $company;
  }
}