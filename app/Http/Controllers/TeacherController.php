<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Teacher::filter([
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
    public function show(Teacher $teacher)
    {
        return $teacher;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        return response()->json([], 204);
    }

    public function courses(Teacher $teacher)
    {
        return $teacher->filterCourses([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ]);
    }

    public function students(string $id) {
        $teacher = Teacher::with('courses.students')->find($id);

        $students = collect();

        foreach ($teacher->courses as $course) {
            $students = $students->merge($course->students);
        }

        if(request('limit') && !request('offset')) {
            $students = $students->take(request('limit'));
        }

        if(request('limit') && request('offset')) {
            $students = $students->forPage(request('offset'), request('limit'))->values();
        }

        return $students->unique('id')->values();
    }
}
