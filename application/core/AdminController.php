<?php
class AdminController extends CI_Controller {
  public function __construct () {
    parent::__construct();
    $this->load->library('parser');
    $this->isUserLoggedIn();
    $this->data['unreadMessagesLength'] = $this->getUnreadMessagesLength();
  }

  private function getUnreadMessagesLength () {
    $this->load->model('messagesModel');
    return $this->messagesModel->count(['is_read' => false]);
  }

  private function isUserLoggedIn () {
    $admin = $this->session->userdata('admin');

    if (!$admin) {
      redirect('admin/login', 'refresh');
    }
  }
}