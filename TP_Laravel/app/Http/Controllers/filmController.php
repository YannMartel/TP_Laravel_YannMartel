<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\filmRessource;
use App\Models\Film;
use App\Models\Critic;
use App\Http\Middleware\Admin;

class filmController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', '%');
        $rating = $request->input('rating');
        $maxLength = $request->input('max-length', 500);
        

        if(empty($rating))
        {
            return Film::where(function($query)use($keyword){
                $query->where('description', 'LIKE', '%'.$keyword.'%')
                ->orWhere('title', 'LIKE', '%'.$keyword.'%');
            })
            ->where('length', '<=', $maxLength) 
            ->paginate(20);                            
        }
        else{
            return Film::where(function($query)use($keyword){
                $query->Where('description', 'LIKE', '%'.$keyword.'%')
                ->orwhere('title', 'LIKE', '%'.$keyword.'%');
            })
            ->where('length', '<=', $maxLength)
            ->where('rating', '=', $rating)
            ->paginate(20); 
        }        
    }


    public function filmAvecCritique(int $id)
    {
        $film = Film::find($id);
        return [
            $film,
            $film->critics()->get()
        ];
    }

    public function acteurPourUnFilm(int $id){
        $film = Film::find($id);
        return $film->actors()->get();
    }

    public function ajoutFilm(Request $request)
    {
        $donnee = $request->all();
        $objet = new Film;

        $objet->title = $request['title'];
        $objet->release_year = $request['release_year'];
        $objet->length = $request['length'];
        $objet->description = $request['description'];
        $objet->rating = $request['rating'];
        $objet->language_id = $request['language_id'];

        $objet->save();
    }

    public function deleteFilm(int $id){
        $film = Film::find($id);
        $film->delete();
        return response()->json([
			'status' => 'Success',
			'message' => 'Film deleted',
		], 200);
    }
}
