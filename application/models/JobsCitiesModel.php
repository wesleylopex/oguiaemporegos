<?php
class JobsCitiesModel extends MY_Model {
	protected $table = 'jobs_cities';
	protected $primary = 'id';
	protected $field_order = 'name';
	protected $type_order = 'asc';	
}
