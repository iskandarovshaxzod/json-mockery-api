<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Student::filter([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        if(strtolower(request('check')) === 'true') {
            $validator = Validator::make($data, [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function courses(Student $student)
    {
        return $student->filterCourses([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ]);
    }

    public function teachers(string $id)
    {
        $student = Student::with('courses.teachers')->find($id);

        $teachers = collect();

        foreach ($student->courses as $course) {
            $teachers = $teachers->merge($course->teachers);
        }

        if(request('limit') && !request('offset')) {
            $teachers = $teachers->take(request('limit'));
        }

        if(request('limit') && request('offset')) {
            $teachers = $teachers->forPage(request('offset'), request('limit'))->values();
        }

        return $teachers->unique('id')->values();
    }
}
