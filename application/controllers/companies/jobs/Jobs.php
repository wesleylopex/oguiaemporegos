<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Jobs extends SiteController {
  function __construct () {
    parent::__construct();
  }

  public function create () {
    $this->redirectIfCompanyNotLoggedIn();
    
    $this->loadAllForeign();

    $this->load->view('companies/jobs/form', $this->data);
  }

  public function update ($jobId) {
    $this->redirectIfCompanyNotLoggedIn();

    $this->load->model('jobsModel');
    
    $job = $this->jobsModel->getByPrimary($jobId);
    if (!$job) redirect($this->session->userdata('company')['username']);

    $isAllowed = $job->company_id == $this->session->userdata('company')['id'];
    if (!$isAllowed) redirect($this->session->userdata('company')['username']);

    $this->data['job'] = $job;

    $this->loadAllForeign();

    $this->load->view('companies/jobs/form', $this->data);
  }

  private function loadAllForeign () {
    $this->load->model('jobsSituationsModel');
    $this->data['situations'] = $this->jobsSituationsModel->getAll();

    $this->load->model('jobsAreasModel');
    $this->data['areas'] = $this->jobsAreasModel->getAll();

    $this->load->model('jobsTypesModel');
    $this->data['types'] = $this->jobsTypesModel->getAll();

    $this->load->model('jobsCitiesModel');
    $this->data['cities'] = $this->jobsCitiesModel->getAll();
  }

  public function delete ($id) {
    $isLoggedIn = $this->isCompanyLoggedIn();

    if (!$isLoggedIn) {
      return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
    }

    $this->load->model('jobsModel');
    $data = $this->jobsModel->getByPrimary($id);

    if (!$data) {
      return $this->response(['success' => false, 'error' => 'Vaga de emprego não encontrada']);
    }
    
    if ($data->company_id != $this->session->userdata('company')['id']) {
      return $this->response(['success' => false, 'error' => 'Permissão negada']);
    }

    $deleted = $this->jobsModel->delete($id);

    if (!$deleted) {
      return $this->response(['success' => false, 'error' => 'Não foi possível remover a vaga de emprego']);
    }

    $this->session->set_flashdata('success', 'Vaga de emprego removida com sucesso');
    return $this->response(['success' => true]);
  }

  public function updateSituation ($id, $situationId) {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $this->load->model('jobsModel');

      $data = [
        'id' => antiInjection($id),
        'company_id' => $this->session->userdata('company')['id'],
        'situation_id' => antiInjection($situationId)
      ];

      $job = $this->jobsModel->getByPrimary($data['id']);

      if (array_key_exists('id', $data) && $data['id']) {
        if (!$job) {
          return $this->response(['success' => false, 'error' => 'Vaga de emprego inválida']);
        }
        
        if ($job->company_id != $this->session->userdata('company')['id']) {
          return $this->response(['success' => false, 'error' => 'Permissão negada para editar']);
        }
      }

      $this->load->model('jobsSituationsModel');
      $situation = $this->jobsSituationsModel->getByPrimary($data['situation_id']);
      
      if (!$situation) {
        return $this->response(['success' => false, 'error' => 'Situação inválida']);
      }

      $saved = $this->jobsModel->update($data);

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->load->model('interestsModel');

      $candidates = $this->interestsModel->getCandidatesByJobId($job->id);
      $emails = array_column($candidates, 'email');

      $this->PHPMailerSend($emails, $job, $situation);

      $this->session->set_flashdata('success', 'Vaga de emprego salva com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }

  public function save () {
    try {
      $isLoggedIn = $this->isCompanyLoggedIn();

      if (!$isLoggedIn) {
        return $this->response(['success' => false, 'error' => 'Você precisa estar logado']);
      }

      $fields = [
        ['label' => 'Id', 'name' => 'id', 'rules' => 'trim'],
        ['label' => 'Título', 'name' => 'title', 'rules' => 'trim|required'],
        ['label' => 'Situação', 'name' => 'situation_id', 'rules' => 'trim'],
        ['label' => 'Área', 'name' => 'area_id', 'rules' => 'trim|required|is_natural_no_zero'],
        ['label' => 'Tipo', 'name' => 'type_id', 'rules' => 'trim|required|is_natural_no_zero'],
        ['label' => 'Salário', 'name' => 'salary', 'rules' => 'trim'],
        ['label' => 'Horário de trabalho', 'name' => 'work_time', 'rules' => 'trim|required'],
        ['label' => 'Cidade', 'name' => 'city_id', 'rules' => 'trim|required|is_natural_no_zero'],
        ['label' => 'Descrição', 'name' => 'activities_description', 'rules' => 'trim|required|max_length[200]'],
        ['label' => 'Requisitos', 'name' => 'requirements', 'rules' => 'trim|max_length[200]'],
        ['label' => 'Benefícios', 'name' => 'benefits', 'rules' => 'trim|max_length[200]'],
        ['label' => 'Informações adicionais', 'name' => 'additional_information', 'rules' => 'trim|max_length[200]'],
      ];

      foreach ($fields as $field) {
        $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);
      }

      if ($this->form_validation->run() == false) {
        return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
      }

      $data = [
        'company_id' => $this->session->userdata('company')['id']
      ];

      foreach ($fields as $field) {
        $data[$field['name']] = antiInjection($this->input->post($field['name']));
      }

      $this->load->model('jobsModel');

      if (array_key_exists('id', $data) && $data['id']) {
        $job = $this->jobsModel->getByPrimary($data['id']);

        if (!$job) {
          return $this->response(['success' => false, 'error' => 'Vaga de emprego inválida']);
        }
        
        if ($job->company_id != $this->session->userdata('company')['id']) {
          return $this->response(['success' => false, 'error' => 'Permissão negada para editar']);
        }
      }

      $defaultSlug = slugify($data['title']);
      $slug = slugify($data['title']);
      $slugFound = !!$this->jobsModel->getRowWhere(['slug' => $defaultSlug, 'id !=' => $data['id']]);
      $counter = 2;

      while ($slugFound) {
        $slug = $defaultSlug . '-' . $counter;
        $slugFound = !!$this->jobsModel->getRowWhere(['slug' => $slug, 'id !=' => $data['id']]);
        $counter++;
      }

      $data['slug'] = $slug;

      $this->load->model('jobsSituationsModel');
      $isSituationValid = !!$this->jobsSituationsModel->getByPrimary($data['situation_id']);
      if (!$isSituationValid) {
        return $this->response(['success' => false, 'error' => 'Situação inválida']);
      }
      
      $this->load->model('jobsTypesModel');
      $isTypeValid = !!$this->jobsTypesModel->getByPrimary($data['type_id']);
      if (!$isTypeValid) {
        return $this->response(['success' => false, 'error' => 'Tipo de vaga inválido']);
      }
      
      $this->load->model('jobsAreasModel');
      $isAreaValid = !!$this->jobsAreasModel->getByPrimary($data['area_id']);
      if (!$isAreaValid) {
        return $this->response(['success' => false, 'error' => 'Área inválida']);
      }
      
      $this->load->model('jobsCitiesModel');
      $isCityValid = !!$this->jobsCitiesModel->getByPrimary($data['city_id']);
      if (!$isCityValid) {
        return $this->response(['success' => false, 'error' => 'Cidade inválida']);
      }

      if (array_key_exists('id', $data) && $data['id']) {
        $saved = $this->jobsModel->update($data);
      } else {
        unset($data['id']);
        $saved = $this->jobsModel->create($data);
      }

      if (!$saved) {
        return $this->response(['success' => false, 'error' => 'Erro ao salvar, tente novamente']);
      }

      $this->session->set_flashdata('success', 'Vaga de emprego salva com sucesso');
      return $this->response(['success' => true]);
    } catch (\Throwable $th) {
      return $this->response(['success' => false, 'error' => 'Erro ao salvar, se continuar entre em contato']);
    }
  }

  private function PHPMailerSend (array $emails, $job, $situation) : array {
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
      $mailer->Subject = 'Vaga de emprego atualizada - O Guia Empregos';
			$mailer->Body = $this->getEmailBody($job, $situation);

			$sent = $mailer->send();

      return ['success' => $sent];
    } catch (Exception $error) {
			return ['success' => false, 'error' => "Erro ao enviar e-mail: $mailer->ErrorInfo"];
    }
  }

  private function getEmailBody ($job, $situation) : string {
    $baseURL = base_url();
    $body = "
      <section>
        <div style=\"width: 100%; max-width: 448px\">
          <h1 style=\"color: #343434; font-size: 20px; font-weight: 600\">Vaga de emprego atualizada - O Guia Empregos</h1>
          <p style=\"color: #5c5c5c; font-size: 14px; margin-top: 16px\">
            A situação da vaga de emprego '$job->title' foi atualizado para '$situation->title'
          </p>
          <p style=\"color: #5c5c5c; font-size: 14px; margin: 16px 0\">
            Para visualizar sua candidatura nesta vaga entre no site O Guia Empregos pelo link abaixo
          </p>
          <a href=\"$baseURL\" style=\"text-decoration: underline; color: #2563eb\">
            $baseURL
          </a>
        </div>
      </section>
    ";

    return $body;
  }
}