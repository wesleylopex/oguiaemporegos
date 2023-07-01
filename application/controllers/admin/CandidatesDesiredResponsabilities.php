<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesDesiredResponsabilities extends AdminGodController {
	protected $model = 'candidatesDesiredResponsabilitiesModel';
	protected $names = [
		'singular' => 'cargo',
		'plural' => 'cargos desejados',
		'link' => 'candidatesDesiredResponsabilities'
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
			'name' => 'responsability',
      'label' => 'Cargo desejado',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'experience_time',
      'label' => 'Tempo de experiência',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
	];

	function __construct () {
		parent::__construct();
	}
}