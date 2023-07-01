<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CandidatesCourses extends AdminGodController {
	protected $model = 'candidatesCoursesModel';
	protected $names = [
		'singular' => 'curso',
		'plural' => 'cursos',
		'link' => 'candidatesCourses',
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
			'name' => 'course_name',
			'label' => 'Nome do curso',
      'type' => 'text',
      'showOnTable' => true,
      'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'institution_name',
      'label' => 'Nome da instituição',
			'type' => 'text',
      'showOnTable' => true,
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4',
		],
		[
			'name' => 'conclusion_year',
      'label' => 'Ano de conclusão',
			'type' => 'text',
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