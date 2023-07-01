<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Interests extends SiteController {
  function __construct () {
    parent::__construct();

    $this->data['page'] = 'profile';
  }

  // Views

  public function index () {
    $company = $this->getCompany();

    $this->data['metatags'] = (object) [
      'title' => 'Interesses',
      'description' => 'Interesses nas vagas da empresa ' . $company->name
    ];

    $this->load->model('interestsModel');
    $this->data['todayInterestsLength'] = $this->interestsModel->getTodayInterestsLengthByCompany($company->id);

    $limit = 6;
    $page = $this->input->get('pagina') ?? 1;
    $offset = ($page - 1) * $limit;

    $interests = $this->interestsModel->search(
      $company->id,
      intval($this->input->get('min-age')),
      intval($this->input->get('max-age')),
      $this->input->get('query'),
      $this->input->get('genres'),
      $this->input->get('jobs'),
      $this->input->get('situations'),
      $this->input->get('city'),
      $this->input->get('languages'),
      (bool) $this->input->get('only-attached'),
      $limit,
      $offset
    );

    $this->data['interests'] = $interests;

    $totalRows = $this->interestsModel->countSearch(
      $company->id,
      intval($this->input->get('min-age')),
      intval($this->input->get('max-age')),
      $this->input->get('query'),
      $this->input->get('genres'),
      $this->input->get('jobs'),
      $this->input->get('situations'),
      $this->input->get('city'),
      $this->input->get('languages'),
      (bool) $this->input->get('only-attached')
    );
    $base = 'companies/profile/interests?' . $_SERVER['QUERY_STRING'];
    $url = str_replace('&pagina=' . $page, '', $base);
    $pagination = $this->paginate($url, $totalRows, $limit);

    $this->data['pagination'] = $pagination;

    $from = $totalRows > 0 ? ($offset + 1) : $offset;

    $toBase = $page * $limit;
    $to = $toBase > $totalRows ? $totalRows : $toBase;

    $resultsMessage = "Mostrando de $from até $to de $totalRows resultados totais";
    $this->data['resultsMessage'] = $resultsMessage;

    $this->load->model('interestsSituationsModel');
    $this->data['situations'] = $this->interestsSituationsModel->getAll();
    
    $this->load->model('jobsSituationsModel');
    $this->data['jobsSituations'] = $this->jobsSituationsModel->getAll();
    
    $this->load->model('jobsModel');
    $this->data['jobs'] = $this->jobsModel->getAllWhere(['company_id' => $this->session->userdata('company')['id']]);

    $this->load->view('companies/profile/interests', $this->data);
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

  // Rest ----

  public function get ($id) {
    $isLoggedIn = $this->isCompanyLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('interestsModel');
    $interest = $this->interestsModel->getById($id);

    if (!$interest) {
      return $this->response(['success' => false, 'error' => 'Interesse não encontrado']);
    }
    
    $this->load->model('jobsModel');
    $job = $this->jobsModel->getByPrimary($interest->job_id);

    if ($job->company_id != $this->session->userdata('company')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    return $this->response(['success' => true, 'data' => $interest]);
  }

  public function delete ($interestId) {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->load->model('interestsModel');
      $interest = $this->interestsModel->getByPrimary($interestId);

      if (!$interest) {
        return $this->response(['success' => false, 'error' => 'Interesse inválido']);
      }

      $deleted = $this->interestsModel->delete($interest->id);

      if (!$deleted) {
        return $this->response(['success' => false, 'error' => 'Erro ao remover, tente novamente']);
      }

      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao remover, se continuar entre em contato']);
    }
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero');
      $this->form_validation->set_rules('situation_id', 'Situação', 'trim|required|is_natural_no_zero');

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'id' => antiInjection($this->input->post('id')),
        'situation_id' => antiInjection($this->input->post('situation_id'))
      ];

      $this->load->model('interestsModel');
      $interest = $this->interestsModel->getByPrimary($data['id']);

      if (!$interest) {
        return $this->response(['success' => false, 'error' => 'Interesse não encontrado']);
      }

      $this->load->model('interestsSituationsModel');
      $situation = $this->interestsSituationsModel->getByPrimary($data['situation_id']);

      if (!$situation) {
        return $this->response(['success' => false, 'error' => 'Situação inválida']);
      }
      
      $this->load->model('jobsModel');
      $job = $this->jobsModel->getByPrimary($interest->job_id);

      if (!$job) {
        return $this->response(['success' => false, 'error' => 'Vaga de emprego não encontrada']);
      }
      
      if ($job->company_id !== $this->session->userdata('company')['id']) {
        return $this->response(['success' => false, 'error' => 'Permissão negada para editar este interesse']);
      }

      $updated = $this->interestsModel->update($data);

      if (!$updated) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->sendEmail($data['id']);

      $this->session->set_flashdata('success', 'Interesse salvo com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => $th->getMessage()]);
    }
  }

  private function sendEmail (int $interestId) : bool {
    $this->load->model('interestsModel');
    $interest = $this->interestsModel->getByPrimary($interestId);

    if (!$interest) {
      return false;
    }

    $this->load->model('candidatesModel');
    $candidate = $this->candidatesModel->getByPrimary($interest->candidate_id);
    
    if (!$candidate) {
      return false;
    }
    
    $this->load->model('jobsModel');
    $job = $this->jobsModel->getByPrimary($interest->job_id);
    
    $this->load->model('interestsSituationsModel');
    $situation = $this->interestsSituationsModel->getByPrimary($interest->situation_id);

    $message = "O seu interesse na vaga $job->title foi atualizado para $situation->title.";

    return $this->PHPMailerSend($candidate->email, $message);
  }

  private function PHPMailerSend (string $email, string $message) : bool {
    require APPPATH . 'plugins/PHPMailer/src/Exception.php';
    require APPPATH . 'plugins/PHPMailer/src/PHPMailer.php';
    require APPPATH . 'plugins/PHPMailer/src/SMTP.php';
    
    $mailer = new PHPMailer(true);
    
    try {
      $mailer->setFrom('contato@pontoagencia.com.br', 'O Guia Empregos');
      $mailer->addAddress($email, 'Recuperação de senha');
      $mailer->isHTML(true);

      $mailer->CharSet = 'UTF-8';
      $mailer->Subject = 'Status de interesse atualizado - O Guia Empregos';
      $mailer->Body = $this->getEmailBody($message);

      return $mailer->send();
    } catch (Exception $error) {
      return "Erro ao enviar e-mail $mailer->ErrorInfo";
    }
  }

  private function getEmailBody (string $message) : string {
    $baseUrl = base_url();
    $body = "
      <section>
        <div style=\"width: 100%; max-width: 448px\">
          <h1 style=\"color: #343434; font-size: 20px; font-weight: 600\">Status de interesse atualizado</h1>
          <p style=\"color: #5c5c5c; font-size: 14px; margin-top: 16px\">
            $message
          </p>
          <p style=\"color: #5c5c5c; font-size: 14px; margin: 16px 0\">
            Para visualizar o resultado, entre no site e faça o login
          </p>
          <a href=\"$baseUrl\" style=\"text-decoration: underline; color: #2563eb\">
            $baseUrl
          </a>
        </div>
      </section>
    ";

    return $body;
  }
}