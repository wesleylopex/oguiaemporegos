<?php
class CandidatesExperiencesModel extends MY_Model {
	protected $table = 'candidates_experiences';
	protected $primary = 'id';
	protected $field_order = 'entry_date';
	protected $type_order = 'desc';
}
