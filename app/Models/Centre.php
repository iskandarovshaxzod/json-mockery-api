<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Command\HistoryCommand;

class Centre extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'centre_teachers');
    }

    public function scopeFilter($query, array $filters) 
    {
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

    public function filterCourses($filters)
    {
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

    public function filterTeachers($filters)
    {
        $query = $this->teachers();

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
