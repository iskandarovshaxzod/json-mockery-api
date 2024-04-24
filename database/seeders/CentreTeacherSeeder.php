<?php

namespace Database\Seeders;

use App\Models\Centre;
use App\Models\Centre_Teacher;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentreTeacherSeeder extends Seeder
{

    public function run(): void
    {
        $teachers = Teacher::all();

        foreach($teachers as $teacher) {
            Centre_Teacher::factory()->create([
                'teacher_id' => $teacher,
                'centre_id'  => Centre::inRandomOrder()->first()
            ]);
        }
    }
}
