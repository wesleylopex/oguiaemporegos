<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Formations extends AdminGodController {
	protected $model = 'formationsModel';
	protected $names = [
		'singular' => 'formação',
		'plural' => 'formações',
		'link' => 'formations',
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
			'name' => 'training_degree',
			'label' => 'Grau de formação',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6',
		],
		[
			'name' => 'payment_value',
			'label' => 'Valor de pagamento (R$)',
			'type' => 'number',
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6',
		],
	];

	function __construct () {
		parent::__construct();
	}
}
