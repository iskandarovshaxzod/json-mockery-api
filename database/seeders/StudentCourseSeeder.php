<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\Student_Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courses  = Course::all();
        $students = Student::all();

        foreach ($students as $student) {
            $numCourses = rand(1, 7);

            $randomCourses = $courses->shuffle()->take($numCourses);

            $randomCourses->each(function ($course) use ($student) {
                if (!$student->courses->contains($course)) {
                    Student_Course::factory()->create([
                        'student_id' => $student->id,
                        'course_id'  => $course->id
                    ]);
                }
            });
        }
    }
}
