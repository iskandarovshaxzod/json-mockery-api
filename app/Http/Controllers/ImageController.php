<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index()
    {
        $filteredAges = (Centre::pluck('image_url')->merge(Teacher::pluck('image_url'))->merge(Student::pluck('image_url')))->shuffle();

        if(request('limit') && !request('offset')) {
            $filteredAges = $filteredAges->take(request('limit'));
        }

        if(request('limit') && request('offset')) {
            $filteredAges = (new Paginator($filteredAges->values()->all(),
                request('limit'), request('offset')))->toArray()['data'];
        }

        return $filteredAges;
    }

    public function store(Request $request)
    {
         $data = $request->all();

         $validator = Validator::make($data, [
            'image' => 'required|image|max:5120',
         ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json($data, 201);
    }
}
