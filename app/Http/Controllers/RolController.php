<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rol;
use Validator;

class RolController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        $roles = rol::all();
        if(!$roles)
        {
            return response()->json([
                'message' => 'empty list',
            ]);
        }
        return $roles;
    }
    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required|string'
        ]);
        $roles = new rol();
        $roles->rol = $request->input('rol');
        $roles->save();
        return response()->json([
            'message' => 'Rol successfully registered',
            'rol' => $roles
        ], 201);

    }
    public function show($id)
    {
        $rol = rol::find($id);
        if(!$roles)
        {
            return response()->json([
                'message' => 'the role does not exist',
            ]);
        }
        return $rol;
    }
    public function update(Request $request, $id)
    {
        $roles = rol::findOrFail($id);
        if(!$roles)
        {
            return response()->json([
                'message' => 'the role does not exist',
            ]);
        }
        $roles->rol = $request->input('rol');
        $roles->save();
        return response()->json([
            'message' => 'Rol successfully update',
            'rol' => $roles
        ], 201);

    }
    public function destroy($id)
    {
        $roles = rol::find($id);
        if(!$roles)
        {
            return response()->json([
                'message' => 'the role does not exist',
            ]);
        }
        $roles->delete();
        return response()->json([
            'message' => 'Rol successfully delete',
            'rol' => $roles
        ]);
    }
}
