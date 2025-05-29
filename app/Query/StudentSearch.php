<?php

namespace App\Query;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;

class StudentSearch
{
    protected Builder $query;
    protected array $filters;


    public function __construct(array $filters = [])
    {
        $this->query = Student::query();
        $this->filters = $filters;
    }

    public function filter(): Builder
    {
        $query = clone $this->query;

        // Si hay un término de búsqueda general (por ejemplo, 'search_term')
        if (isset($this->filters['search_term']) && $this->filters['search_term']) {
            $searchTerm = $this->filters['search_term'];
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->searchByFirstName($searchTerm)
                  ->orWhere('last_name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('dni_nie', 'like', "%{$searchTerm}%");
            });
        } else {
            // Mantener los filtros específicos si se proporcionan
            if (isset($this->filters['first_name']) && $this->filters['first_name']) {
                $query->searchByFirstName($this->filters['first_name']);
            }
            if (isset($this->filters['last_name']) && $this->filters['last_name']) {
                $query->searchByLastName($this->filters['last_name']);
            }
            if (isset($this->filters['email']) && $this->filters['email']) {
                $query->searchByEmail($this->filters['email']);
            }
            if (isset($this->filters['dni_nie']) && $this->filters['dni_nie']) {
                $query->searchByDniNie($this->filters['dni_nie']);
            }
            if (isset($this->filters['disability']) && $this->filters['disability'] !== null) {
                $query->hasDisability(filter_var($this->filters['disability'], FILTER_VALIDATE_BOOLEAN));
            }
        }

        return $query;
    }
}
