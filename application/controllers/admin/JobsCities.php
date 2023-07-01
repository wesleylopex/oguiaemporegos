<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JobsCities extends AdminGodController {
	protected $model = 'jobsCitiesModel';
	protected $names = [
		'singular' => 'cidade',
		'plural' => 'cidades',
		'link' => 'jobsCities',
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
			'name' => 'name',
			'label' => 'Nome da cidade',
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
