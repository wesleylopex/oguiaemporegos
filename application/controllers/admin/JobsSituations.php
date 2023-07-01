<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JobsSituations extends AdminGodController {
	protected $model = 'jobsSituationsModel';
	protected $names = [
		'singular' => 'situação',
		'plural' => 'situações',
		'link' => 'jobsSituations'
	];
	protected $permissions = [
		'create' => true,
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
			'name' => 'title',
			'label' => 'Título',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'is_finished',
			'label' => 'Está finalizada',
			'type' => 'select',
			'options' => [
				false => 'Não',
				true => 'Sim'
			],
			'editableOnTable' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		]
	];

	function __construct () {
		parent::__construct();
	}
}
