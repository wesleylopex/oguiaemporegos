<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrators extends AdminGodController {
	protected $model = 'administratorsModel';
	protected $names = [
		'singular' => 'administrador',
		'plural' => 'administradores',
		'link' => 'administrators'
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
			'name' => 'name',
			'label' => 'Nome',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'username',
			'label' => 'Nome de usuário',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'password',
			'label' => 'Senha',
			'type' => 'password',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6'
		]
	];

	function __construct () {
		parent::__construct();
	}
}
