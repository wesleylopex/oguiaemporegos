<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesLanguages extends AdminGodController {
	protected $model = 'candidatesLanguagesModel';
	protected $names = [
		'singular' => 'idioma',
		'plural' => 'idiomas',
		'link' => 'candidatesLanguages',
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
			'showOnTable' => false,
			'rules' => 'trim',
		],
		[
			'name' => 'candidate_id',
			'label' => 'Candidato',
			'type' => 'select',
			'baseForeignLinkOnLabel' => 'admin/candidates/update',
			'options' => [
				'model' => 'candidatesModel',
				'value' => 'id',
				'text' => 'name',
			],
			'fromDataBase' => true,
			'showOnTable' => true,
			'rules' => 'trim',
			'disabled' => true,
			'col' => 'col-md-4'
		],
		[
			'name' => 'language',
			'label' => 'Idioma',
      'type' => 'text',
      'showOnTable' => true,
      'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'level',
      'label' => 'Nível',
			'type' => 'select',
			'options' => [
				'Básico' => 'Básico',
				'Intermediário' => 'Intermediário',
				'Avançado' => 'Avançado',
				'Fluente' => 'Fluente',
			],
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
	];

	function __construct () {
		parent::__construct();
	}
}