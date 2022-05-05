<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{

    public function register(Request $request)
    {
        try {
            $user = User::create([
                'password' => bcrypt($request['password']),
                'email' => $request['email'],
                'last_name' => $request['last_name'],
                'first_name' => $request['first_name'],
                'role_id' => $request['role_id']
            ]);
        }
        catch(Exception $e){
            abort(422,'Problème de validation');
        }
        

        return response()->json([
			'status' => 'Success',
			'message' => 'User created'
		], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->toArray())) {
            return $this->error('Mauvais login et/ou mot de passe', 401);
        }

        return response()->json([
			'status' => 'Success',
			'message' => 'Logged in',
			'data' => [
                'token' => Auth::user()->createToken('API Token')->plainTextToken
            ]
		], 200);
    }

    public function show() {
        return auth()->user();
        // Auth::user()
    }
}