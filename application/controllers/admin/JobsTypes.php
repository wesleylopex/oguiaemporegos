<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JobsTypes extends AdminGodController {
	protected $model = 'jobsTypesModel';
	protected $names = [
		'singular' => 'tipo',
		'plural' => 'tipos',
		'link' => 'jobsTypes'
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
			'rules' => 'trim'
		],
		[
			'name' => 'title',
			'label' => 'Título',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'slug' => true,
			'col' => 'col-md-6',
		],
	];

	function __construct () {
		parent::__construct();
	}
}
