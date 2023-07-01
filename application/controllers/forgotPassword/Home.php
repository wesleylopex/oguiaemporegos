<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SiteController {
  function __construct() {
    parent::__construct();
  }

  public function index () {
    $type = $this->input->get('type');
    $acceptedTypes = ['companies', 'candidates'];

    if (!in_array($type, $acceptedTypes)) {
      $this->session->set_flashdata('error', strip_tags(validation_errors()));
      $this->goToPreviousPage();
    }

    $this->load->view('forgot-password/index', $this->data);
  }
}
