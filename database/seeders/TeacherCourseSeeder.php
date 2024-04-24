<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Teacher_Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach($courses as $course) {
            Teacher_Course::factory()->create([
                'teacher_id' => Teacher::inRandomOrder()->first(),
                'course_id' => $course
            ]);
        }
    }
}
