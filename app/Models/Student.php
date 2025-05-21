<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni_nie',
        'email',
        'phone',
        'birth_date',
        'disability',
        'address',
    ];

    protected $casts = [
        'disability' => 'boolean',
        'birth_date' => 'date',
    ];

    

    // Ámbitos locales
    public function scopeSearchByFirstName(Builder $query, string $firstName): Builder
    {
        return $query->where('first_name', 'like', "%{$firstName}%");
    }

    public function scopeSearchByLastName(Builder $query, string $lastName): Builder
    {
        return $query->where('last_name', 'like', "%{$lastName}%");
    }

    public function scopeSearchByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', 'like', "%{$email}%");
    }

    public function scopeSearchByDniNie(Builder $query, string $dniNie): Builder
    {
        return $query->where('dni_nie', 'like', "%{$dniNie}%");
    }

    public function scopeHasDisability(Builder $query, bool $disability): Builder
    {
        return $query->where('disability', $disability);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
