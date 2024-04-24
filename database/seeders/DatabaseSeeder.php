<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CentreSeeder::class,
            CourseSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            TeacherCourseSeeder::class,
            StudentCourseSeeder::class,
            CentreTeacherSeeder::class,
        ]);
    }
}
