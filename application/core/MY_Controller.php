<?php

include_once 'application/core/AdminController.php';
include_once 'application/core/AdminGodController.php';

class SiteController extends CI_Controller {
  public $data = [];

  protected function __construct () {
    parent::__construct();

    $this->load->model('companyInformationsModel');
    $this->data['companyInformations'] = $this->companyInformationsModel->getLast();

    $this->load->vars($this->data);
  }

  protected function response (array $response) {
    echo json_encode($response);
    return array_key_exists('success', $response) ? $response['success'] : false;
  }

  protected function isCandidateLoggedIn () {
    return !!$this->session->userdata('candidate');
  }

  protected function redirectIfCandidateNotLoggedIn (string $to) {
    $isCandidateLoggedIn = $this->isCandidateLoggedIn();
    if (!$isCandidateLoggedIn) {
      if (!$to) {
        $this->goToPreviousPage();
      }

      redirect($to);
    }
  }
  
  protected function isCompanyLoggedIn () {
    return !!$this->session->userdata('company');
  }

  protected function redirectIfCompanyNotLoggedIn (string $to = null) {
    $isCompanyLoggedIn = $this->isCompanyLoggedIn();
    if (!$isCompanyLoggedIn) {
      if (!$to) {
        $this->goToPreviousPage();
      }

      redirect($to);
    }
  }

  protected function getMetatags ($page) {
    $this->load->model('metatagsModel');
    return $this->metatagsModel->getRowWhere(['slug' => $page]);
  }

  protected function goToPreviousPage () {
    $this->load->library('user_agent');
    redirect($this->agent->referrer());
  }

  protected function paginate (string $url, int $totalRows, int $limit) {
    $this->load->library('pagination');
    $this->data['opportunitiesLength'] = $totalRows;

    $config['base_url'] = base_url() . $url;
    $config['total_rows'] = $totalRows;
    $config['per_page'] = $limit;
    $config['use_page_numbers'] = true;

    $config['prev_link'] = '<i class="feather-xl" data-feather="chevron-left"></i>';
    $config['prev_tag_open'] = '<div>';
    $config['prev_tag_close'] = '</div>';

    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['page_query_string'] = true;
    $config['query_string_segment'] = 'pagina';
    $config['attributes'] = ['class' => 'pagination__item'];

    $config['next_link'] = '<i class="feather-xl" data-feather="chevron-right"></i>';
    $config['next_tag_open'] = '<div>';
    $config['next_tag_close'] = '</div>';

    $config['num_tag_open'] = '<div>';
    $config['num_tag_close'] = '</div>';
    
    $config['cur_tag_open'] = '<div class="pagination__item pagination__item--active">';
    $config['cur_tag_close'] = '</div>';

    $this->pagination->initialize($config);

    return $this->pagination->create_links();
  }
}
