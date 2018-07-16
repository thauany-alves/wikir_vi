<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePerfilRequest;
use App\Models\Endereco;
use App\Models\ImageUser;

class UserController extends Controller
{
     public function __construct(){
        
        $this->middleware('auth');
   	}

   	public function perfil(){

   		$img = auth()->user()->image()->first();

   		$endereco = auth()->user()->endereco()->first();

		return view('user.perfil')
			->withEndereco($endereco)
			->withImg($img);
	}

	public function updateUser(UpdatePerfilRequest $request){
		
		$update = auth()->user()->update($request->all());

		if($update)
			return redirect()
				->route('perfil')
				->withSuccess('Sucesso ao editar');

		return redirect()
			->back()
			->withErro('Erro ao editar');
	}
}
