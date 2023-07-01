<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends SiteController {
  function __construct() {
    parent::__construct();
  }

  public function sent () {
    $type = $this->input->get('type');
    $acceptedTypes = ['companies', 'candidates'];

    if (!in_array($type, $acceptedTypes)) {
      $this->session->set_flashdata('error', strip_tags(validation_errors()));
      $this->goToPreviousPage();
    }

    $this->load->view('forgot-password/email-sent', $this->data);
  }

  public function send () {
    $this->form_validation->set_rules('email', 'e-mail', 'trim|required');

    if ($this->form_validation->run() == false) {
      return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
    }

    $email = antiInjection($this->input->post('email'));

    $isEmailValid = validEmail($email);
    
    if (!$isEmailValid) {
      return $this->response(['success' => false, 'error' => 'Informe um e-mail válido']);
    }

    $type = antiInjection($this->input->post('type'));
    $acceptedTypes = ['companies', 'candidates'];

    if (!in_array($type, $acceptedTypes)) {
      $this->session->set_flashdata('error', strip_tags(validation_errors()));
      $this->goToPreviousPage();
    }

    $model = $type . 'Model';
    $this->load->model($model);

    $record = $this->{$model}->getRowWhere(['email' => $email]);

    if (!$record) {
      return $this->response(['success' => false, 'error' => 'E-mail não encontrado, tente novamente']);
    }

    $forgotPasswordCode = md5(uniqid());
    
    $recordData = [
      'id' => $record->id,
      'forgot_password_code' => $forgotPasswordCode
    ];

    $updated = $this->{$model}->update($recordData);

    if (!$updated) {
      return $this->response(['success' => false, 'error' => 'Não foi possível alterar sua senha, tente novamente']);
    }

    $newPasswordLink = base_url("esqueceu-senha/nova-senha?code=$forgotPasswordCode&type=$type");

    $emailSent = $this->PHPMailerSend($email, $newPasswordLink);

    if (!$emailSent) {
      return $this->response(['success' => false, 'error' => 'Não foi possível enviar o e-mail, tente novamente']);
    }

    return $this->response(['success' => true]);
  }

  private function PHPMailerSend (string $email, string $newPasswordLink) : bool {
    require APPPATH . 'plugins/PHPMailer/src/Exception.php';
    require APPPATH . 'plugins/PHPMailer/src/PHPMailer.php';
    require APPPATH . 'plugins/PHPMailer/src/SMTP.php';
    
    try {
      $mailer = new PHPMailer(true);
      $mailer->setFrom('contato@pontoagencia.com.br', 'O Guia Empregos');
      $mailer->addAddress($email, 'Recuperação de senha');
      $mailer->isHTML(true);

      $mailer->CharSet = 'UTF-8';
      $mailer->Subject = 'Recuperação de senha O Guia Empregos';
      $mailer->Body = $this->getEmailHTML($newPasswordLink);

      $mailer->send();
      return true;
    } catch (Exception $error) {
      return false;
    }
  }

  private function getEmailHTML (string $link) : string {
    $body = "
      <section>
        <div style=\"width: 100%; max-width: 448px\">
          <h1 style=\"color: #343434; font-size: 20px; font-weight: 600\">Recuperação de senha</h1>
          <p style=\"color: #5c5c5c; font-size: 14px; margin-top: 16px\">
            Não compartilhe este e-mail com ninguém, escolha uma senha segura que contenha números, símbolos e letras maiúsculas e minúsculas.
          </p>
          <p style=\"color: #5c5c5c; font-size: 14px; margin: 16px 0\">
            Para recuperar sua senha, entre no link abaixo:
          </p>
          <a href=\"$link\" style=\"text-decoration: underline; color: #2563eb\">
            $link
          </a>
        </div>
      </section>
    ";

    return $body;
  }
}
