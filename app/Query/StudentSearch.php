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
        Student::query()
                ->ofType();
        $this->filters = $filters;
    }

    public function search(): Builder
    {
        $query = clone $this->query; // Clona la consulta inicial para no modificarla directamente
        if (isset($this->filters['first_name']) && $this->filters['first_name']) {
            $query->where('first_name', 'like', '%' . $this->filters['first_name'] . '%');
        }
        if (isset($this->filters['last_name']) && $this->filters['last_name']) {
            $query->where('last_name', 'like', '%' . $this->filters['last_name'] . '%');
        }
        if (isset($this->filters['email']) && $this->filters['email']) {
            $query->where('email', 'like', '%' . $this->filters['email'] . '%');
        }
        if (isset($this->filters['dni_nie']) && $this->filters['dni_nie']) {
            $query->where('dni_nie', 'like', '%' . $this->filters['dni_nie'] . '%');
        }
        if (isset($this->filters['disability']) && $this->filters['disability'] !== null) {
            $query->where('disability', filter_var($this->filters['disability'], FILTER_VALIDATE_BOOLEAN));
        }
        return $query;
    }
}
