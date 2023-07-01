<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class companyInformations extends AdminGodController {
	protected $model = 'companyInformationsModel';
	protected $names = [
		'singular' => 'Informações',
		'plural' => 'Informações',
		'link' => 'companyInformations',
	];
	protected $uploadFolder = 'company';
	protected $permissions = [
		'create' => false,
		'update' => true,
		'delete' => false,
		'isUnique' => true
	];
	protected $fields = [
		[
			'name' => 'id',
			'label' => 'Id',
			'type' => 'hidden',
			'rules' => 'trim|required',
		],
		[
			'name' => 'name',
			'label' => 'Nome da empresa',
			'type' => 'text',
			'rules' => 'trim|required',
			'required' => true,
			'col' => 'col-md-4'
		],
		[
			'name' => 'phone',
			'label' => 'Telefone',
			'type' => 'text',
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'email',
			'label' => 'E-mail',
			'type' => 'text',
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'payments_due_date_time_in_months',
			'label' => 'Tempo de vencimento dos pagamentos (meses)',
			'type' => 'number',
			'rules' => 'trim|required',
			'col' => 'col-md-4',
		],
		[
			'name' => 'address',
			'label' => 'Endereço',
			'type' => 'textarea',
			'rules' => 'trim|required',
			'col' => 'col-md-12',
		],
		[
			'name' => 'contract_terms_file',
			'label' => 'Arquivo de termos de contrato (.pdf)',
			'type' => 'file',
			'rules' => 'trim',
			'col' => 'col-md-6',
		],		
		// [
		// 	'name' => 'logo_size',
		// 	'label' => 'Tamanho do logo',
		// 	'type' => 'select',
		// 	'options' => [
		// 		'w-16' => 'Pequeno',
		// 		'w-24' => 'Médio',
		// 		'w-32' => 'Grande',
		// 		'w-40' => 'Extra grande',
		// 		'w-48' => 'Gigante',
		// 	],
		// 	'rules' => 'trim|required',
		// 	'col' => 'col-md-6'
		// ],		
		[
			'name' => 'logo',
			'label' => 'Logo da empresa',
			'type' => 'image',
			'rules' => 'trim',
			'col' => 'col-md-12',
		],
		[
			'name' => 'favicon',
			'label' => 'Ícone',
			'type' => 'image',
			'rules' => 'trim',
			'col' => 'col-md-12',
		],
		[
			'title' => 'Redes Sociais',
			'type' => 'separator'
		],
		[
			'name' => 'facebook',
			'label' => 'Facebook',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'instagram',
			'label' => 'Instagram',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],		
		[
			'name' => 'twitter',
			'label' => 'Twitter',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],	
		[
			'name' => 'youtube',
			'label' => 'YouTube',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],
		[
			'name' => 'linkedin',
			'label' => 'Linkedin',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		],	
		[
			'name' => 'whatsapp',
			'label' => 'WhatsApp',
			'type' => 'text',
			'showOnTable' => true,
			'rules' => 'trim',
			'col' => 'col-md-4',
		]
	];

	function __construct () {
		parent::__construct();
	}
}
