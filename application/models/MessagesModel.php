<?php
class MessagesModel extends MY_Model {
	protected $table = 'messages';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'desc';
}
