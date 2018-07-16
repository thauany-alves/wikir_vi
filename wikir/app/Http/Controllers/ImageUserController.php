<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUserRequest;
use App\Models\ImageUser;

class ImageUserController extends Controller
{
    public function update(ImageUserRequest $request){
    	
    	$data = $request->only('img_user');
    	$id = auth()->user()->id;
    	if($request->hasFile('img_user') && $request->file('img_user')->isValid()){
			$name = $id.'-img';
			$extenstion = $request->img_user->extension();
			$nameFile = "{$name}.{$extenstion}";
			$data['img_user'] =  $nameFile;
			$upload = $request->img_user->storeAs('users',$nameFile);

			if (!$upload)
					return redirect()
							->back()
							->with('error','Falha ao fazer upload da imagem');

		}

		$img = auth()->user()->image()->update($data);


		return redirect()
			->route('perfil');
    }
}
