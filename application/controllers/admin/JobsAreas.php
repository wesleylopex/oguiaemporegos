<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JobsAreas extends AdminGodController {
	protected $model = 'jobsAreasModel';
	protected $names = [
		'singular' => 'área',
		'plural' => 'áreas',
		'link' => 'jobsAreas'
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
			'rules' => 'trim',
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
		]
	];

	function __construct () {
		parent::__construct();
	}
}
