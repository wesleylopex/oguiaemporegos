<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesProfessionalExperiences extends AdminGodController {
	protected $model = 'candidatesProfessionalExperiencesModel';
	protected $names = [
		'singular' => 'experiência',
		'plural' => 'experiências profissionais',
		'link' => 'candidatesProfessionalExperiences',
	];
	protected $permissions = [
		'create' => false,
		'update' => true,
		'delete' => true
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
			'rules' => 'trim',
			'disabled' => true,
			'col' => 'col-md-4'
		],
		[
			'name' => 'company_name',
			'label' => 'Nome da empresa',
      'type' => 'text',
      'showOnTable' => true,
      'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'entry_date',
      'label' => 'Data de entrada',
			'type' => 'month',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'exit_date',
      'label' => 'Data de saída',
			'type' => 'month',
      'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'area',
      'label' => 'Área',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'responsability',
      'label' => 'Cargo',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'salary',
      'label' => 'Salário',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim',
			'class' => 'money',
			'col' => 'col-md-4',
		],
		[
			'name' => 'activities_description',
      'label' => 'Descrição das atividades',
			'type' => 'textarea',
			'rules' => 'trim',
			'col' => 'col-md-12',
		],
		[
			'name' => 'leaving_reason',
      'label' => 'Motivo de saída',
			'type' => 'textarea',
			'rules' => 'trim',
			'col' => 'col-md-12',
		]
	];

	function __construct () {
		parent::__construct();
	}
}