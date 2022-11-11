<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $categorys = Category::all();
        if(!$categorys)
        {
            return response()->json([
                'message' => 'empty list',
            ]);
        }
        return response()->json([
            'message' => 'All categorys',
            'categorys' => $categorys
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $categorys = Category::create(array_merge(
            $validator->validated()
        ));
        return response()->json([
            'message' => 'category successfully registered',
            'category' => $categorys
        ], 201);
    }
    public function show($id)
    {
        $categorys = Category::findOrFail($id);
        if(!$categorys)
        {
            return response()->json([
                'message' => 'category does not exist',
            ]);
        }
        return response()->json([
            'message' => 'categorys',
            'category' => $categorys
        ]);
    }
    public function update(Request $request, $id)
    {
        $categorys = Category::findOrFail($id);
        if(!$categorys)
        {
            return response()->json([
                'message' => 'category does not exist',
            ]);
        }
        $categorys->name = $request->input('name');
        $categorys->save();
        return response()->json([
            'message' => 'category successfully update',
            'category' => $categorys
        ], 201);
    }
    public function destroy($id)
    {
        $categorys = Category::findOrFail($id);
        if(!$categorys)
        {
            return response()->json([
                'message' => 'the user does not exist',
            ]);
        }
        $categorys->delete();
        return response()->json([
            'message' => 'category successfully delete',
            'category' => $categorys
        ]);
    }
}
