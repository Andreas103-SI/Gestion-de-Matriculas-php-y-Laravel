<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StudentAction;

class StudentLog extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'action',
    ];

    protected $casts = [
        'action' => StudentAction::class, // Convierte el valor de la base de datos al enum StudentAction.
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
