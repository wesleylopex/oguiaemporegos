<?php
class JobsModel extends MY_Model {
	protected $table = 'jobs';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'desc';

	public function getByCandidate (int $candidateId, int $limit = null, int $offset = null) {
		$jobs = $this->db
		->select('jobs.*')
		->join('jobs', 'jobs.id = interests.job_id')
		->where('interests.candidate_id', $candidateId)
		->get('interests', $limit, $offset)
		->result();

		return $this->getJobsWithDependencies($jobs);
	}

	public function getAllWithForeign (?array $where = null, ?int $limit = null, ?int $offset = null, bool $onlyValid = false) {
		$query = $this->db->order_by($this->table.'.'.$this->field_order, $this->type_order);

		if ($where) {
			$query = $query->where($where);
		}

		if ($onlyValid === true) {
			$query = $query->join('jobs_situations', 'jobs_situations.id = jobs.situation_id', 'left')->where('jobs_situations.is_finished', false);
		}

		$query = $query->select('jobs.*')->get($this->table, $limit, $offset);
		$jobs = $query->result();
		$jobs = $this->getJobsWithDependencies($jobs);

		return $jobs;
	}

	private function getJobsWithDependencies ($jobs) {
		foreach ($jobs as $job) {
			$job = $this->getJobWithForeignRows($job);
			$job->timeAgo = timeElapsedString($job->created_at);
		}

		return $jobs;
	}

	public function getJobWithForeignRows ($job) {
		$job->city = $this->getJobForeignRow('jobs_cities', $job->city_id);
		$job->type = $this->getJobForeignRow('jobs_types', $job->type_id);
		$job->area = $this->getJobForeignRow('jobs_areas', $job->area_id);
		$job->situation = $this->getJobForeignRow('jobs_situations', $job->situation_id);
		$job->company = $this->getJobForeignRow('companies', $job->company_id);

		return $job;
	}

	private function getJobForeignRow ($table, $foreignKey) {
		$query = $this->db
			->where(['id' => $foreignKey])
			->get($table);
		
			return $query->row();
	}

	private function searchQuery (
		string $search = null,
		?array $cities = [],
		?array $areas = [],
		?array $types = [],
		?array $companies = [],
		bool $onlyValid = false
	) {
		$search = strtolower($search);
		$words = explode(' ', $search);

		$columns = [
			'jobs.title',
			'jobs.activities_description',
			'jobs.benefits',
			'jobs.additional_information',
			'jobs.requirements',
			'companies.name'
		];

		$query = $this->db
			->select('jobs.*')
			->where_in('city_id', $cities)
			->where_in('area_id', $areas)
			->where_in('type_id', $types)
			->where_in('company_id', $companies)
			->join('companies', 'companies.id = jobs.company_id')
			->order_by($this->table.'.'.$this->field_order, $this->type_order)
			->group_start();
			
		foreach ($words as $word) {
			foreach ($columns as $column) {
				$query = $query->or_like('LOWER('. $column .')', $word);
			}
		}

		$query = $query->group_end();

		if ($onlyValid === true) {
			$query = $query->join('jobs_situations', 'jobs_situations.id = jobs.situation_id')
			->where('jobs_situations.is_finished', false);
		}

		return $query;
	}

	public function search (
		string $search = null,
		?array $cities = [],
		?array $areas = [],
		?array $types = [],
		?array $companies = [],
		int $limit = null,
		int $offset = null,
		bool $onlyValid = false
	) {
		$query = $this->searchQuery($search, $cities, $areas, $types, $companies, $onlyValid);
		$jobs = $query->get($this->table, $limit, $offset)->result();
		$jobs = $this->getJobsWithDependencies($jobs);
		
		return $jobs;
	}

	public function countSearch (
		string $search = null,
		?array $cities = [],
		?array $areas = [],
		?array $types = [],
		?array $companies = [],
		bool $onlyValid = false
	) {
		$query = $this->searchQuery($search, $cities, $areas, $types, $companies, $onlyValid);
		$length = $query->count_all_results($this->table);
		
		return $length;
	}
	
	public function getRowBySlug ($table, $slug) {
		if(!$slug) return null;
		
		$query = $this->db->where(['slug' => $slug])->get($table);
		return $query->row();
	}
}
