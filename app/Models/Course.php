<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['pivot'];

    public function students() {
        return $this->belongsToMany(Student::class, 'student_courses');
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'teacher_courses');
    }

    public function scopeFilter($query, $filters) {
        if($filters['name']) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if($filters['offset'] && $filters['limit']) {
            $query->offset($filters['offset'])->limit($filters['limit']);
        }

        if($filters['limit'] && !$filters['offset']) {
            $query->limit($filters['limit']);
        }
    }

    public function filterStudents(array $filters) {
        $query = $this->students();

        if($filters['name']) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if($filters['offset'] && $filters['limit']) {
            $query->offset($filters['offset'])->limit($filters['limit']);
        }

        if($filters['limit'] && !$filters['offset']) {
            $query->limit($filters['limit']);
        }

        return $query->get();
    }

}
