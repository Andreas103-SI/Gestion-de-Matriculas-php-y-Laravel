<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'capacity',
        'location',
        'price',
        
    ];
   
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
    ];
   
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
   
}
