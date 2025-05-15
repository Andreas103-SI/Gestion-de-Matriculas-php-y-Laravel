<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni_nie',
        'phone',
        'birth_date',
        'disability',
        'address',
    ];

    protected $casts = [
        'disability' => 'boolean',
        'birth_date' => 'date',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
