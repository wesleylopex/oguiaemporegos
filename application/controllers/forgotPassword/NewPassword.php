<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewPassword extends SiteController {
  function __construct() {
    parent::__construct();
  }

  public function index () {
    $this->form_validation->set_rules('code', 'Código', 'trim|required');
    
    $code = antiInjection($this->input->get('code'));
    $this->data['code'] = $code;
    
    $type = $this->input->get('type');
    $acceptedTypes = ['companies', 'candidates'];

    if (!in_array($type, $acceptedTypes)) {
      $this->session->set_flashdata('error', strip_tags(validation_errors()));
      $this->goToPreviousPage();
    }

    $model = $type . 'Model';
    $this->load->model($model);

    $record = $this->{$model}->getRowWhere(['forgot_password_code' => $code]);

    if (!$record) {
      $this->session->set_flashdata('error', 'Código inválido, tente novamente');
      redirect('esqueceu-senha?type=' . $type);
    }

    $record = $this->{$model}->getRowWhere(['forgot_password_code' => $code]);

    if (!$record) {
      $this->session->set_flashdata('error', 'Código inválido, tente novamente');
      redirect('esqueceu-senha?type=' . $type);
    }

    $this->load->view('forgot-password/new-password', $this->data);
  }

  public function save () {
    $this->form_validation->set_rules('password', 'Nova senha', 'trim|required|min_length[4]|max_length[26]');
    $this->form_validation->set_rules('password-confirmation', 'Confirmar nova senha', 'trim|required|matches[password]');
    $this->form_validation->set_rules('code', 'Código', 'trim|required');

    if ($this->form_validation->run() == false) {
      return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
    }

    $code = antiInjection($this->input->post('code'));

    $type = $this->input->post('type');
    $acceptedTypes = ['companies', 'candidates'];

    if (!in_array($type, $acceptedTypes)) {
      return $this->response(['success' => false, 'error' => 'Tipo inválido, tente novamente']);
    }

    $model = $type . 'Model';
    $this->load->model($model);

    $record = $this->{$model}->getRowWhere(['forgot_password_code' => $code]);

    if (!$record) {
      return $this->response(['success' => false, 'error' => 'Código inválido, tente novamente']);
    }

    $toSave = [
      'id' => $record->id,
      'password' => encodeCrip(antiInjection($this->input->post('password'))),
      'forgot_password_code' => null
    ];

    $updated = $this->{$model}->update($toSave);

    if (!$updated) {
      return $this->response(['success' => false, 'error' => 'Não foi possível alterar sua senha, tente novamente']);
    }

    $this->session->set_flashdata('success', 'Senha atualizada com sucesso. Faça o Login');
    return $this->response(['success' => true]);
  }
}
