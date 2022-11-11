<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::all();
        if(!$users)
        {
            return response()->json([
                'message' => 'empty list',
            ]);
        }
        return response()->json([
            'message' => 'All users',
            'users' => $users
        ]);
    }
    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if(!$users)
        {
            return response()->json([
                'message' => 'the user does not exist',
            ]);
        }
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->rol_id = $request->input('rol_id');
        $users->save();
        return response()->json([
            'message' => 'user successfully update',
            'user' => $users
        ], 201);
    }
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        if(!$users)
        {
            return response()->json([
                'message' => 'the user does not exist',
            ]);
        }
        $users->delete();
        return response()->json([
            'message' => 'user successfully delete',
            'user' => $users
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if(!$users)
        {
            return response()->json([
                'message' => 'the user does not exist',
            ]);
        }
        if($request->input('new_password') == $request->input('confirmar_password'))
        {
            $users->password = bcrypt($request->input('new_password'));
            $users->save();
            return response()->json([
                'message' => 'password successfully update',
            ]);

        }
        else
        {
            return response()->json([
                'message' => 'la contraseña no coinciden',
            ]);
        }

    }

    public function getUserByRol($id)
    {
        $users = DB::table('users')->join('rol','users.rol_id','=','rol.id')->select('users.*','rol.rol')
        ->where('rol.id','=',$id)->get();
        return $users;
    }

}
