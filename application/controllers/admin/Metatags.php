<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Metatags extends AdminGodController {
	protected $model = 'metatagsModel';
	protected $names = [
		'singular' => 'metatag',
		'plural' => 'metatags',
		'link' => 'metatags'
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
			'name' => 'page',
			'label' => 'Página',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'disabled' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'slug',
			'label' => 'Slug',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'col' => 'col-md-6'
		],
		[
			'name' => 'title',
			'label' => 'Título',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-6'
		],
		[
			'name' => 'description',
			'label' => 'Descrição',
			'type' => 'textarea',
			'rules' => 'trim',
			'col' => 'col-md-12'
		],
		[
			'name' => 'keywords',
			'label' => 'Palavras chaves',
			'type' => 'textarea',
			'rules' => 'trim',
			'col' => 'col-md-12'
		]
	];

	function __construct () {
		parent::__construct();
	}
}
