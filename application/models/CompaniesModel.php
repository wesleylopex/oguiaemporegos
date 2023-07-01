<?php
class CompaniesModel extends MY_Model {
	protected $table = 'companies';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'asc';

	public function validateCredentials (string $email, string $password) {
		$email = antiInjection($email, true);
		$password = antiInjection($password, true);
		
		$company = $this->getRowWhere(['email' => $email]);
		if (!$company) {
			return false;
		}

		$companyIsValid = compareHash($password, $company->password);
		if ($companyIsValid) {
			return $company;
		}

		return false;
	}
}
