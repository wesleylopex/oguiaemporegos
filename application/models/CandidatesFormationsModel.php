<?php
class CandidatesFormationsModel extends MY_Model {
	protected $table = 'candidates_formations';
	protected $primary = 'id';
	protected $field_order = 'started_at';
	protected $type_order = 'asc';
}
