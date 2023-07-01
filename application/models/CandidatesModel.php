<?php
class CandidatesModel extends MY_Model {
	protected $table = 'candidates';
	protected $primary = 'id';
	protected $field_order = 'updated_at';
	protected $type_order = 'desc';

	public function validateCredentials (string $email, string $password) {
		$email = antiInjection($email, true);
		$password = antiInjection($password, true);
		
		$user = $this->getRowWhere(['email' => $email]);
		if (!$user) {
			return false;
		}

		$userIsValid = compareHash($password, $user->password);
		if ($userIsValid) {
			return $user;
		}

		return false;
	}

	private function searchQuery (?string $query, ?int $minAge, ?int $maxAge, ?string $city, ?array $genres, ?array $languages, bool $onlyAttached = false) {
		$minBirthdate = date('Y-m-d', strtotime($minAge ? "-$minAge years" : 'today'));
		$maxBirthdate = $maxAge ? date('Y-m-d', strtotime("-$maxAge years -11 months")) : '';
		
		$dbQuery = $this->db
			->select($this->table . '.*')
			->distinct()
			->group_start()
				->where($this->table . '.birthdate IS NULL')
				->or_where($this->table . '.birthdate <=', $minBirthdate)
				->where($this->table . '.birthdate >=', $maxBirthdate)
			->group_end();

		if ($onlyAttached) {
			$dbQuery = $dbQuery->where($this->table . '.resume_file IS NOT NULL');
		}

		$dbQuery = $dbQuery->join('candidates_languages', 'candidates_languages.candidate_id = candidates.id', 'left')
			->join('candidates_courses', 'candidates_courses.candidate_id = candidates.id', 'left')
			->join('candidates_formations', 'candidates_formations.candidate_id = candidates.id', 'left')
			->join('candidates_experiences', 'candidates_experiences.candidate_id = candidates.id', 'left')
			->where_in($this->table . '.genre', $genres)
			->where_in('candidates_languages.language', $languages)
			->like($this->table . '.address_city', $city)
			->group_start()
				->like($this->table . '.name', $query)
				->or_like($this->table . '.function_1', $query)
				->or_like($this->table . '.function_2', $query)
				->or_like($this->table . '.function_3', $query)
				->or_like($this->table . '.email', $query)
				->or_like($this->table . '.image', $query)
				->or_like('candidates_courses.course_name', $query)
				->or_like('candidates_courses.institution_name', $query)
				->or_like('candidates_formations.formation_degree', $query)
				->or_like('candidates_formations.institution_name', $query)
				->or_like('candidates_formations.course_name', $query)
				->or_like('candidates_experiences.company_name', $query)
				->or_like('candidates_experiences.function', $query)
			->group_end();

		return $dbQuery;
	}

	public function search (int $companyId, ?string $query, ?int $minAge, ?int $maxAge, ?string $city, ?array $genres, ?array $languages, bool $onlyAttached = false, ?int $limit, ?int $offset) : ?array {
		$candidates = $this->searchQuery($query, $minAge, $maxAge, $city, $genres, $languages, $onlyAttached)
			->order_by($this->table . '.' . $this->field_order, $this->type_order)
			->get($this->table, $limit, $offset)
			->result();

		$candidates = array_map(function ($candidate) use ($companyId) {
			$candidate->age = $candidate->birthdate ? getAge($candidate->birthdate) : null;

			$candidate->interests_length = $this->db
				->join('jobs', 'jobs.id = interests.job_id')
				->where('interests.candidate_id', $candidate->id)
				->where('jobs.company_id', $companyId)
				->count_all_results('interests');

			return $candidate;
		}, $candidates);

		return $candidates;
	}

	public function countSearch (?string $query, ?int $minAge, ?int $maxAge, ?string $city, ?array $genres, ?array $languages, bool $onlyAttached = false) : ?int {
		return $this->searchQuery($query, $minAge, $maxAge, $city, $genres, $languages, $onlyAttached)->count_all_results($this->table);
	}
}
