<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\filmRessource;
use App\Models\Film;
use App\Models\Critic;
use App\Http\Middleware\Admin;

class filmController extends Controller
{


    public function index()
    {
        return Film::paginate(20);
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

}
