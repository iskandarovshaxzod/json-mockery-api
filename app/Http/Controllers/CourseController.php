<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::filter([
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
                'time' => 'required|date_format:H:i',
                'subject' => 'required',
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
    public function show(Course $course)
    {
        return $course;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        return response()->json([], 204);
    }

    public  function students(Course $course)
    {
        return $course->filterStudents([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ]);
    }
}
