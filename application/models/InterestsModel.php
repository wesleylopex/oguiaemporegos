<?php
class InterestsModel extends MY_Model {
	protected $table = 'interests';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'desc';

	public function getCandidatesByJobId (int $jobId) : array {
		return $this->db
			->select('candidates.*')
			->join('candidates', 'candidates.id = interests.candidate_id')
			->join('jobs', 'jobs.id = interests.job_id')
			->where('jobs.id', $jobId)
			->get($this->table)
			->result();
	}

	private function getTodayInterestsLength (array $where) : int {
		return $this->db
			->join('jobs', 'jobs.id = interests.job_id')
			->where('interests.created_at >=', date('Y-m-d H:i:s', strtotime('today midnight')))
			->where($where)
			->count_all_results($this->table);
	}

	public function getTodayInterestsLengthByCandidate (int $candidateId) : int {
		return $this->getTodayInterestsLength(['interests.candidate_id' => $candidateId]);
	}
	
	public function getTodayInterestsLengthByCompany (int $companyId) : int {
		return $this->getTodayInterestsLength(['jobs.company_id' => $companyId]);
	}

	private function setInterestsCandidatesAge (array $interests) : array {
		return array_map(function ($interest) {
			$interest->candidate_age = getAge($interest->candidate_birthdate);
			return $interest;
		}, $interests);
	}

	private function getDefaultQuery (string $select = '') {
		return $this->db
			->select($select . '
				interests.id,
				interests.created_at,
				
				candidates.id AS candidate_id,
				candidates.name AS candidate_name,
				candidates.function_1 AS candidate_function_1,
				candidates.birthdate AS candidate_birthdate,
				candidates.genre AS candidate_genre,
				candidates.address_city AS candidate_address_city,
				candidates.address_uf AS candidate_address_uf,
				candidates.image AS candidate_image,

				jobs.id AS job_id,
				jobs.title AS job_title,

				jobs_situations.title AS job_situation_title,
				jobs_situations.type AS job_situation_type,
		
				interests_situations.id AS situation_id,
				interests_situations.title AS situation_title,
				interests_situations.type AS situation_type
			')
			->join('jobs', 'jobs.id = interests.job_id')
			->join('candidates', 'candidates.id = interests.candidate_id')
			->join('interests_situations', 'interests_situations.id = interests.situation_id', 'left')
			->join('jobs_situations', 'jobs_situations.id = jobs.situation_id', 'left');
	}
	
	public function getById (int $id) {
		$interest = $this->getDefaultQuery()
			->where('interests.id', $id)
			->get('interests')
			->row();

		$interest->candidate_age = getAge($interest->candidate_birthdate);

		return $interest;
	}

	private function searchQuery (
		int $companyId,
		int $minAge = null,
		int $maxAge = null,
		string $search = null,
		?array $genres = [],
		?array $jobs = [],
		?array $situations = [],
		string $city = null,
		?array $languages = [],
		bool $onlyAttached = false
	) {
		$words = explode(' ', strtolower($search));
		$columns = [
			'candidates.name',
			'candidates.image',
			'candidates.function_1',
			'candidates.function_2',
			'candidates.function_3',
			'jobs.title'
		];

		$minBirthdate = date('Y-m-d', strtotime($minAge ? "-$minAge years" : 'today'));
		$maxBirthdate = $maxAge ? date('Y-m-d', strtotime("-$maxAge years -11 months")) : '';

		$query = $this->getDefaultQuery()
			->distinct()
			->where('candidates.birthdate <=', $minBirthdate)
			->where('candidates.birthdate >=', $maxBirthdate)
			->join('candidates_languages', 'candidates_languages.candidate_id = candidates.id', 'left');

		if ($onlyAttached) {
			$query = $query->where('candidates.resume_file IS NOT NULL');
		}

		$query = $query->where('jobs.company_id', $companyId)
			->where_in('candidates.genre', $genres)
			->where_in('jobs.id', $jobs)
			->where_in('interests_situations.id', $situations)
			->where_in('candidates_languages.language', $languages)
			->like('candidates.address_city', $city)
			->order_by($this->table.'.'.$this->field_order, $this->type_order)
			->group_start();

		foreach ($words as $word) {
			foreach ($columns as $column) {
				$query = $query->or_like('LOWER('. $column .')', $word);
			}
		}
	
		$query = $query->group_end();

		return $query;
	}

	public function search (
		int $companyId,
		int $minAge = null,
		int $maxAge = null,
		string $search = null,
		?array $genres = [],
		?array $jobs = [],
		?array $situations = [],
		string $city = null,
		?array $languages = [],
		bool $onlyAttached = false,
		int $limit = null,
		int $offset = null
	) : array {
		$interests = $this->searchQuery(
			$companyId,
			$minAge,
			$maxAge,
			$search,
			$genres,
			$jobs,
			$situations,
			$city,
			$languages,
			$onlyAttached
		)->get($this->table, $limit, $offset)->result();

		$interests = $this->setInterestsCandidatesAge($interests);
		
		return $interests;
	}

	public function countSearch (
		int $companyId,
		int $minAge = null,
		int $maxAge = null,
		string $search = null,
		?array $genres = [],
		?array $jobs = [],
		?array $situations = [],
		string $city = null,
		?array $languages = [],
		bool $onlyAttached = false
	) {
		$length = $this->searchQuery(
			$companyId,
			$minAge,
			$maxAge,
			$search,
			$genres,
			$jobs,
			$situations,
			$city,
			$languages,
			$onlyAttached
		)->count_all_results($this->table);
		
		return $length;
	}
}
