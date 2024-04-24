<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['pivot'];

    public function centres() {
        return $this->belongsToMany(Centre::class, 'centre_teachers');
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'teacher_courses');
    }

    public function scopeFilter($query, array $filters) {
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

    public function filterCourses(array $filters) {
        $query = $this->courses();

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
