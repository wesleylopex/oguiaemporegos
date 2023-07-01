<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesPayments extends AdminGodController {
	protected $model = 'candidatesPaymentsModel';
	protected $names = [
		'singular' => 'pagamento',
		'plural' => 'pagamentos',
		'link' => 'candidatesPayments',
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
			'name' => 'candidate_id',
			'label' => 'Candidato',
			'type' => 'select',
			'options' => [
				'model' => 'candidatesModel',
				'value' => 'id',
				'text' => 'name',
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4'
		],
		[
			'name' => 'value',
			'label' => 'Valor (R$)',
      'type' => 'text',
      'showOnTable' => true,
      'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'status',
      'label' => 'Status',
			'type' => 'select',
			'options' => [
				1 => 'Em análise',
				2 => 'Aprovado',
				3 => 'Cancelado'
			],
      'showOnTable' => true,
      'editableOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'expires_at',
      'label' => 'Expira em',
			'type' => 'date',
      'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
	];

	function __construct () {
		parent::__construct();
	}
}