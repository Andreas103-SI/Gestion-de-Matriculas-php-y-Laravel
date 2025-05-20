<?php

namespace App\Query;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;

class StudentSearch
{
    protected $query;
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->query = Student::query();
        $this->filters = $filters;
    }

    public function search(): Builder
    {
        if (!empty($this->filters['first_name'])) {
            $this->query->searchByFirstName($this->filters['first_name']);
        }

        if (!empty($this->filters['last_name'])) {
            $this->query->searchByLastName($this->filters['last_name']);
        }

        if (!empty($this->filters['email'])) {
            $this->query->searchByEmail($this->filters['email']);
        }

        if (!empty($this->filters['dni_nie'])) {
            $this->query->searchByDniNie($this->filters['dni_nie']);
        }

        if (isset($this->filters['disability'])) {
            $this->query->hasDisability(filter_var($this->filters['disability'], FILTER_VALIDATE_BOOLEAN));
        }

        return $this->query;
    }
}