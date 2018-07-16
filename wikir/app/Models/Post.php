<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Post extends Model
{
    protected $table = 'posts';
	
	public $timestamps = true;
    
    protected $fillable = array('descricao','status','image','categoria_id','user_id');

    protected $guarded = ['id'];

    public function categoria(){
    	return $this->belongsTo(Categoria::Class);
    }

    public function userList(){
    	$endereco = auth()->user()->endereco()->get()->first();
    	$user_id = auth()->user()->id;
    	$posts = DB::table('users')
            ->join('enderecos', 'users.id', '=', 'enderecos.user_id')
            ->join('images_user','users.id','=','images_user.user_id')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
            ->select('users.name','users.email', 'enderecos.cidade','enderecos.uf','categorias.nome','posts.*','images_user.img_user')
            ->where('enderecos.cep', '=', $endereco->cep)
            ->where('enderecos.cidade', '=', $endereco->cidade)
            ->where('users.id', '=', $user_id)
            ->latest()
            ->get();
          
            return $posts;
    }


    public function list(){
    	$endereco = auth()->user()->endereco()->get()->first();
    	$posts = DB::table('users')
            ->join('enderecos', 'users.id', '=', 'enderecos.user_id')
            ->join('images_user','users.id','=','images_user.user_id')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->join('categorias', 'posts.categoria_id', '=', 'categorias.id')
            ->select('users.name','users.email', 'enderecos.cidade','enderecos.uf','categorias.nome','posts.*','images_user.img_user')
            ->where('enderecos.cep', '=', $endereco->cep)
            ->where('enderecos.cidade', '=', $endereco->cidade)
            ->latest()
            ->get();

            return $posts;

    }
}
