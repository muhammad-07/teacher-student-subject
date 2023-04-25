<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }
}
