<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesJobsSituations extends AdminGodController {
	protected $model = 'candidatesJobsSituationsModel';
	protected $names = [
		'singular' => 'situação',
		'plural' => 'situações',
		'link' => 'candidatesJobsSituations',
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
			'col' => 'col-md-8',
		]
	];

	function __construct () {
		parent::__construct();
	}
}
