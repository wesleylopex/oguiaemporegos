<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesJobs extends AdminGodController {
	protected $model = 'candidatesJobsModel';
	protected $names = [
		'singular' => 'interesse',
		'plural' => 'interesses',
		'link' => 'candidatesJobs',
	];
	protected $permissions = [
		'create' => false,
		'update' => true,
		'delete' => true,
	];
	protected $fields = [
		[
			'name' => 'id',
			'label' => 'Id',
			'type' => 'hidden',
			'showOnTable' => false,
			'rules' => 'trim',
		],

		[
			'name' => 'candidate_id',
			'label' => 'Candidato',
			'type' => 'select',
			'baseForeignLinkOnLabel' => 'admin/candidates/update',
			'options' => [
				'model' => 'candidatesModel',
				'value' => 'id',
				'text' => 'name',
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'disabled' => true,
			'rules' => 'trim',
			'col' => 'col-md-4'
		],
		[
			'name' => 'job_id',
			'label' => 'Vaga',
			'type' => 'select',
			'baseForeignLinkOnLabel' => 'admin/jobs/update',
			'options' => [
				'model' => 'jobsModel',
				'value' => 'id',
				'text' => 'title',
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim',
			'disabled' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'situation_id',
			'label' => 'Situação',
			'type' => 'select',
			'options' => [
				'model' => 'candidatesJobsSituationsModel',
				'value' => 'id',
				'text' => 'title',
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],

		[
			'name' => 'created_at',
			'label' => 'Data',
			'type' => 'date',
			'showOnTable' => true,
			'disabled' => true,
			'col' => 'col-md-4'
		]
	];

	function __construct() {
		parent::__construct();
	}

	public function updateSituation () {
		$jobId = $this->input->post('jobId');
		$candidateId = $this->input->post('candidateId');
		$situationId = $this->input->post('situationId');

		$this->load->model('candidatesJobsModel');
		$interest = $this->candidatesJobsModel
			->getRowWhere([
				'job_id' => $jobId,
				'candidate_id' => $candidateId
			]);
		
		$response = [
			'success' => false,
			'jobId' => $jobId,
			'candidateId' => $candidateId
		];
		
		if ($interest) {
			$interestToSave = [
				'id' => $interest->id,
				'situation_id' => $situationId
			];
			$result = $this->candidatesJobsModel->update($interestToSave);
			if ($result) {
				$response['success'] = true;
			}
		}
		
		echo json_encode($response);
	}
}
