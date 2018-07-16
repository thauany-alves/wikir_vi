<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
   	}

   	public function list(){

   		$categorias = Categoria::all();

   		return view('post.new-post')->withCategorias($categorias); 
   	}
}
