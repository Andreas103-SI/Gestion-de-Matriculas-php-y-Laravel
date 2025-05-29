<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use App\Traits\NormalizeName;


#[ObservedBy(StudentObserver::class)]

class Student extends Model
{
    use HasFactory, SoftDeletes, NormalizeName;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni_nie',
        'email',
        'phone',
        'birth_date',
        'disability',
        'address',
        'document_image_path',
    ];

    protected $casts = [
        'disability' => 'boolean',
        'birth_date' => 'date',
    ];



    // Ámbitos locales
    #[Scope]
    protected function searchByFirstName(Builder $query, string $firstName): Builder
    {
        return $query->where('first_name', 'like', "%{$firstName}%");
    }

    #[Scope]
    public function searchByLastName(Builder $query, string $lastName): Builder
    {
        return $query->where('last_name', 'like', "%{$lastName}%");
    }

    #[Scope]
    public function searchByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', 'like', "%{$email}%");
    }

    #[Scope]
    public function searchByDniNie(Builder $query, string $dniNie): Builder
    {
        return $query->where('dni_nie', 'like', "%{$dniNie}%");
    }
    #[Scope]
    public function hasDisability(Builder $query, bool $disability): Builder
    {
        return $query->where('disability', $disability);
    }


    // Relaciones

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
