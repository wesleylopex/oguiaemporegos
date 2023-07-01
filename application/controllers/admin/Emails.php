<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emails extends AdminController {
	function __construct () {
		parent::__construct();

		$this->data['names'] = [
			'singular' => 'e-mail',
			'plural' => 'e-mails',
			'link' => 'emails',
		];
	}

	public function index () {
		$this->load->model('EmailsModel');
		$this->data['emails'] = $this->EmailsModel->getAll();

		$this->load->view('admin/emails/index', $this->data);
	}

	public function create () {
		$this->load->view('admin/emails/form', $this->data);
	}

	protected function response (array $response) : bool {
    echo json_encode($response);
    return array_key_exists('success', $response) ? $response['success'] : false;
  }

	public function sendEmail () {
    $this->load->model('candidatesModel');
    $candidates = $this->candidatesModel->getAll();
    
    if (!$candidates || !is_array($candidates)) {
      return $this->response(['success' => false, 'error' => 'Nenhum candidato encontrado']);
		}
		
		$this->form_validation->set_rules('subject', 'Assunto', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('message', 'Mensagem', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|max_length[255]|valid_url');

		if (!$this->form_validation->run()) {
			return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
		}

		$emails = array_column($candidates, 'email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$link = $this->input->post('link');

		$PHPMailerResponse = $this->PHPMailerSend($emails, $subject, $message, $link);
		
		if (!$PHPMailerResponse['success']) {
			return $this->response(['success' => false, 'error' => $PHPMailerResponse['error']]);
		}

		$this->load->model('EmailsModel');
		$this->EmailsModel->create([
			'subject' => $subject,
			'message' => $message,
			'link' => $link ? $link : null,
		]);

		$this->session->set_flashdata('success', 'E-mail enviado com sucesso');
		return $this->response(['success' => true]);
	}

	private function PHPMailerSend (array $emails, string $subject, string $message, ?string $link = null) : array {
    require APPPATH . 'plugins/PHPMailer/src/Exception.php';
    require APPPATH . 'plugins/PHPMailer/src/PHPMailer.php';
    require APPPATH . 'plugins/PHPMailer/src/SMTP.php';
    
    $mailer = new PHPMailer(true);
    
    try {
			$mailer->setFrom('contato@oguiaempregos.com.br', 'O Guia Empregos');

			foreach ($emails as $email) {
				$mailer->addBCC($email);
			}

      $mailer->isHTML(true);

      $mailer->CharSet = 'UTF-8';
      $mailer->Subject = $subject;
			$mailer->Body = $this->getEmailBody($subject, $message, $link);

			$sent = $mailer->send();

      return ['success' => $sent];
    } catch (Exception $error) {
			return ['success' => false, 'error' => "Erro ao enviar e-mail: $mailer->ErrorInfo"];
    }
  }

  private function getEmailBody (string $subject, string $message, ?string $link = null) : string {
    $body = "
      <section>
        <div style=\"width: 100%; max-width: 448px\">
          <h1 style=\"color: #343434; font-size: 20px; font-weight: 600\">$subject</h1>
					<p style=\"color: #5c5c5c; font-size: 14px; margin-top: 16px\">" . nl2br($message) . "</p>"
					. ($link ? "<a href=\"$link\" style=\"text-decoration: underline; color: #2563eb\">$link</a>" : "")
			. "</div>
      </section>
    ";

    return $body;
  }
}