<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
//use Illuminate\Support\Facades\Request;
use App\Models\Categoria;
use App\Models\Post;
use App\Models\ImageUser;
use App\Policies\PostPolicy;

class PostController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
   	}

   	/**
     * O metodo posts faz a listagem dos 
     * posts publicados na cidade do usuario logado.
     * 
     */
   	public function posts(){
   		$post = new Post();
   		$posts = $post->list();
   		$endereco = auth()->user()->endereco()->first();
  
   		$img = auth()->user()->image()->first();
   		$message = 'Não há publicações! Publique algo e colabore com sua cidade!';

   		$info = 'Publicações em';

   		if(empty($posts[0]))
			return view('posts.posts',compact('message','endereco','img','info'));
				//->withMessage($message)
				//->withEndereco($endereco);


		return view('posts.posts',compact('posts','endereco','img','info'));
			//->withPosts($posts)
			//->withEndereco($endereco);
	}

	/**
     * O metodo postsUser faz a listagem apenas dos  
     * posts publicados pelo proprio usuario logado. 
     */
	public function postsUser(){

		$post = new Post();

		$posts = $post->userList();
		$endereco = auth()->user()->endereco()->first();
		$message = 'Não há publicações suas! Publique algo!';
		$img = auth()->user()->image()->first();

		$info = 'Suas publicações em';

		
		if(empty($posts[0]))
			return view('posts.posts',compact('message','endereco','img','info'));

		return view('posts.posts',compact('posts','endereco','img','info'));

	}

	//metodo responsavel por direcionar a pagina de edição de post
	public function newPost(){
		$categoria = Categoria::all();
		return view('posts.new-post')
			->withCategorias($categoria);
	}


	public function postStore(PostRequest $request){
		$data = $request->all();
		$date = date('ymd_H_i');
		//tratar a validação e o upload da foto
		if($request->hasFile('image') && $request->file('image')->isValid()){
			$name = $date.'-img';
			$extenstion = $request->image->extension();
			$nameFile = "{$name}.{$extenstion}";
			$data['image'] =  $nameFile;
			$upload = $request->image->storeAs('posts',$nameFile);

			if (!$upload)
					return redirect()
							->back()
							->with('error','Falha ao fazer upload da imagem');

		}
		//salva no banco
		$post = auth()->user()->posts()->create($data);

		if($post)
			return redirect()
				->route('posts')
				->withSuccess('Sucesso ao publicar');

		return redirect()
				->back()
				->withError('Problema ao publicar');

	}

	public function delete($id){
		$post = Post::find($id);

		$delete = $post->delete();		
			
		if($delete)
			return redirect()
					->back()
					->withSuccess('Sucesso ao remover publicação');
		
		return redirect()
				->back()
				->withError('Erro ao excluir publicação');
	}

	public function editPost($id, PostPolicy $policy){
		$post = Post::Where('id', $id)->get()->first();

		$categoria = $post->categoria;
		$categorias = Categoria::all();

		if(!$policy->updatePost($post)){

			abort('403', 'Sem autorização');
		}
		return view('posts.new-post')
				->withPost($post)
				->withCategorias($categorias);
	}

	public function editPostStore (PostRequest $req, $id, PostPolicy $policy){
		$request = $req->all();
		$post = Post::Where('id',$id)->get()->first();

		if(!$policy->updatePost($post)){

			abort('403', 'Sem autorização');
		}

		$date = date('ymd_H_i');
		//tratar a validação e o upload da foto
		if($req->hasFile('image') && $req->file('image')->isValid()){
			$name = $date.'-img';
			$extenstion = $req->image->extension();
			$nameFile = "{$name}.{$extenstion}";
			$request['image'] =  $nameFile;
			$upload = $req->image->storeAs('posts',$nameFile);

			$post->image = $request['image'];
			if (!$upload)
					return redirect()
							->back()
							->with('error','Falha ao fazer upload da imagem');

		}
		
		$post->descricao = $req->descricao;
		$post->categoria_id = $req->categoria_id;

		$post->save();

		return redirect()
			->route('posts')
			->withSuccess('Sucesso ao editar');



	}


}
