<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Candidates extends AdminGodController {
	protected $model = 'candidatesModel';
	protected $names = [
		'singular' => 'candidato',
		'plural' => 'candidatos',
		'link' => 'candidates',
	];
	protected $uploadFolder = 'candidates';
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
			'showOnTable' => false,
			'rules' => 'trim',
		],
		[
			'type' => 'separator',
			'title' => 'Informações pessoais'
		],
		[
			'name' => 'name',
			'label' => 'Nome completo',
			'type' => 'text',
			'showOnTable' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'email',
			'label' => 'E-mail',
			'type' => 'text',
			'col' => 'col-md-4'
		],
		[
			'name' => 'cpf',
			'label' => 'CPF',
			'type' => 'text',
			'showOnTable' => false,
			'rules' => 'trim',
			'col' => 'col-md-4',
			'class' => 'cpf'
		],
		[
			'name' => 'rg',
			'label' => 'RG',
			'type' => 'text',
			'showOnTable' => false,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'birthdate',
			'label' => 'Data de nascimento',
			'type' => 'date',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'genre',
			'label' => 'Gênero',
			'type' => 'select',
			'rules' => 'trim|required',
			'required' => true,
			'showOnTable' => true,
			'options' => [
				'Masculino' => 'Masculino',
				'Feminino' => 'Feminino',
				'Outro' => 'Outro',
			],
			'col' => 'col-md-4',
		],
		[
			'name' => 'image',
			'label' => 'Imagem de perfil',
			'type' => 'image',
			'rules' => 'trim',
			'col' => 'col-md-12',
		],
		[
			'name' => 'marital_status',
			'label' => 'Estado civil',
			'type' => 'select',
			'rules' => 'trim',
			'required' => true,
			'options' => [
				'Solteiro' => 'Solteiro',
				'Casado' => 'Casado',
				'Viúvo' => 'Viúvo',
				'Separado' => 'Separado',
				'Divorciado' => 'Divorciado',
				'União estável' => 'União estável',
				'Não desejo informar' => 'Não desejo informar',
			],
			'col' => 'col-md-4',
		],
		[
			'name' => 'phone',
			'label' => 'Telefone',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'class' => 'phone',
			'col' => 'col-md-4',
		],

		'separator_address' => [
			'type' => 'separator',
			'title' => 'Endereço'
		],
		[
			'name' => 'address_zip_code',
			'label' => 'CEP',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'class' => 'zip-code',
			'col' => 'col-md-4',
		],
		[
			'name' => 'address_street',
			'label' => 'Rua',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6',
		],
		[
			'name' => 'address_number',
			'label' => 'Número',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-2',
		],
		[
			'name' => 'address_neighborhood',
			'label' => 'Bairro',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'address_complement',
			'label' => 'Complemento',
			'type' => 'text',
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'address_uf',
			'label' => 'Estado',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6',
		],
		[
			'name' => 'address_city',
			'label' => 'Cidade',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'showOnTable' => true,
			'col' => 'col-md-6',
		],

		'separator_work' => [
			'type' => 'separator',
			'title' => 'Informações de trabalho'
		],
		[
			'name' => 'desired_salary',
			'label' => 'Pretensão salarial (R$)',
			'type' => 'text',
			'rules' => 'trim',
			'class' => 'money',
			'col' => 'col-md-4',
		],
	];

	function __construct () {
		parent::__construct();
	}
}