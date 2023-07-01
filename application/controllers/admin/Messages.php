<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends AdminGodController {
	protected $model = 'messagesModel';
	protected $names = [
		'singular' => 'mensagem',
		'plural' => 'mensagens',
		'link' => 'messages'
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
			'rules' => 'trim|required'
		],
		[
			'name' => 'is_read',
			'label' => 'Está lida',
			'type' => 'select',
			'showOnTable' => true,
			'options' => [
				false => 'Não',
				true => 'Sim'
			],
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-2'
		],
		[
			'name' => 'name',
			'label' => 'Nome',
			'type' => 'text',
			'showOnTable' => true,
			'disabled' => true,
			'col' => 'col-md-4'
		],
		[
			'name' => 'email',
			'label' => 'E-mail',
			'type' => 'email',
			'showOnTable' => true,
			'disabled' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'phone',
			'label' => 'Telefone',
			'type' => 'text',
			'showOnTable' => true,
			'disabled' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'message',
			'label' => 'Mensagem',
			'type' => 'textarea',
			'disabled' => true,
			'col' => 'col-md-12'
		],
		[
			'name' => 'created_at',
			'label' => 'Data de envio',
			'type' => 'date',
			'showOnTable' => true,
			'disabled' => true,
			'col' => 'col-md-4'
		],
	];

	function __construct () {
		parent::__construct();
	}
}
