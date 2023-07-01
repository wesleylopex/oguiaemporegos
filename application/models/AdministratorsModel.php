<?php
class AdministratorsModel extends MY_Model {
	protected $table = 'administrators';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'desc';

	public function validate (string $username, string $password) {
		$username = antiInjection($username, true);
		$password = antiInjection($password, true);
		
		$user = $this->getRowWhere(['username' => $username]);
		if (!$user) {
			return false;
		}

		$userIsValid = compareHash($password, $user->password);
		if ($userIsValid) {
			return $user;
		}

		return false;
	}
}
