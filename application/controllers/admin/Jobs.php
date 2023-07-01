<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends AdminGodController {
	protected $model = 'jobsModel';
	protected $names = [
		'singular' => 'vaga de emprego',
		'plural' => 'vagas de emprego',
		'link' => 'jobs'
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
			'rules' => 'trim'
		],
		[
			'name' => 'title',
			'label' => 'Título',
			'type' => 'text',
			'editableOnTable' => false,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'slug' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'company_id',
			'label' => 'Empresa',
			'type' => 'select',
			'options' => [
				'model' => 'companiesModel',
				'value' => 'id',
				'text' => 'name'
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'situation_id',
			'label' => 'Situação',
			'type' => 'select',
			'options' => [
				'model' => 'jobsSituationsModel',
				'value' => 'id',
				'text' => 'title'
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'area_id',
			'label' => 'Área',
			'type' => 'select',
			'options' => [
				'model' => 'jobsAreasModel',
				'value' => 'id',
				'text' => 'title'
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'editableOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'salary',
			'label' => 'Salário',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'work_time',
			'label' => 'Horário de trabalho',
			'type' => 'text',
			'showOnTable' => false,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'city_id',
			'label' => 'Cidade',
			'type' => 'select',
			'options' => [
				'model' => 'jobsCitiesModel',
				'value' => 'id',
				'text' => 'name'
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'editableOnTable' => false,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'type_id',
			'label' => 'Tipo de vaga',
			'type' => 'select',
			'options' => [
				'model' => 'jobsTypesModel',
				'value' => 'id',
				'text' => 'title'
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-3'
		],
		[
			'name' => 'activities_description',
			'label' => 'Descrição das atividades',
			'type' => 'textarea',
			'showOnTable' => false,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-6'
		],
		[
			'name' => 'requirements',
			'label' => 'Requisitos',
			'type' => 'textarea',
			'showOnTable' => false,
			'rules' => 'trim',
			'col' => 'col-md-6'
		],
		[
			'name' => 'benefits',
			'label' => 'Benefícios',
			'type' => 'textarea',
			'showOnTable' => false,
			'rules' => 'trim',
			'col' => 'col-md-6'
		],
		[
			'name' => 'additional_information',
			'label' => 'Informações adicionais',
			'type' => 'textarea',
			'rules' => 'trim',
			'col' => 'col-md-6'
		]
	];

	function __construct () {
		parent::__construct();
	}
}
