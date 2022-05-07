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

    public function logout() {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
        
        return response()->json('Successfully logged out');
    }
    //https://stackoverflow.com/questions/58280790/remove-a-laravel-passport-user-token

    public function profilUpdate(Request $request){

        $user =Auth::user();
        $user->email = $request['email'];
        $user->last_name = $request['last_name'];
        $user->first_name = $request['first_name'];
        $user->role_id = $request['role_id'];
        $user->save();

        return response()->json('Profil successfully updated');
    }

    public function passwordUpdate(Request $request){
        $user =Auth::user();
        $user->password = bcrypt($request['password']);
        $user->save();

        return response()->json('Password successfully updated');
    }
}