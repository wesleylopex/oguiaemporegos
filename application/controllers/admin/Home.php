<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends AdminController {
  function __construct () {
    parent::__construct();
    $this->data['nomes']['link'] = 'home';
  }

  public function index () {
    redirect('admin/messages');
    // $this->load->view('admin/home/index');
  }

  public function error () {
    redirect('admin/messages');
  }
}
