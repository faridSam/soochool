<?php

namespace App\Http\Controllers\Admin;

use App\Cycle;
use App\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NiveauController extends Controller
{
    public  function index(){
        return view('espaces.admin.niveaux');
    }
    public function loadNiveau(){
        $niveau=Niveau::with('classes','matieres')->get();

       // dd($niveau->classes);
        $dd=Cycle::get();
        return(compact('niveau','dd'));

    }

    public function updateNiveau(Request $request,$id){
        $niveau=Niveau::find($id);
        $niveau->update($request->input());
        return 'ok';

    }

    public function destroy($id){
        Niveau::destroy($id);
        return 'ok';
    }

    public function store(Request $request){

        $niveau=  Niveau::create( $request->input());
        return compact("niveau");



    }
}
