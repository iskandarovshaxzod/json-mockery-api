<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CentreController extends Controller
{
    public function index()
    {
        return Centre::filter([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ])->get();
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();

        if(strtolower(request('check')) === 'true') {
            $validator = Validator::make($data, [
                'name' => 'required',
                'address' => 'required',
                'website' => 'required',
                'phone_number' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }

        return response()->json($data, 201);
    }

    public function show(Centre $centre)
    {
        return $centre;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Centre $centre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Centre $centre)
    {
        //
    }

    public function images()
    {
        return Centre::pluck('image_url');
    }

    public function courses(Centre $centre)
    {
        return $centre->filterCourses([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ]);
    }

    public function teachers(Centre $centre)
    {
        return $centre->filterTeachers([
            'name' => request('name'),
            'offset' => request('offset'),
            'limit' => request('limit')
        ]);
    }
}
