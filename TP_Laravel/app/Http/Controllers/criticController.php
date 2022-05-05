<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Critic;

class criticController extends Controller
{
    public function store(Request $request)
    {
        $donnee = $request->all();
        $objet = new Critic;

        $objet->user_id = $request['user_id'];
        $objet->film_id = $request['film_id'];
        $objet->score = $request['score'];
        $objet->comment = $request['comment'];

        $objet->save();

        return response()->json([
			'status' => 'Success',
			'message' => 'critic created'
		], 201);
    }
}
