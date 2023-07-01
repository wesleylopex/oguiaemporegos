<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'terms';
    $this->data['metatags'] = $this->getMetatags($this->data['page']);
  }

  public function index () {
    $this->load->view('terms', $this->data);
  }
}