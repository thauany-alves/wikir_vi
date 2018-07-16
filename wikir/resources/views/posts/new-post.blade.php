
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">

                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('posts')}}">Posts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                          </ol>
                        </nav>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}   
                        </div>
                    @endif


                    <div class="col-md-12">
                        @include('includes.alerts')

                        @if(isset($post->id))
                            <form method="POST" action="/post/edit/{{$post->id}}" enctype="multipart/form-data" > 
                        @else
                            <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data" >
                        @endif
                            @csrf


                            <div class="form-group row">
                                <label for="Categoria" class="col-md-2 col-form-label text-md-right">Categoria</label>

                                <div class="col-md-10">
                                @if(isset($post->categoria->id))    
                                    <select  name="categoria_id" class="selectpicker form-control" data-live-search="true" title="Categoria">
                                        <option value="{{$post->categoria->id}}">{{$post->categoria->nome}}</option>
                                        @foreach($categorias as $c)
                                            <option value="{{$c->id}}">{{$c->nome}}</option>
                                        @endforeach    
                                    </select> 
                                @else
                                    <select name="categoria_id" class="selectpicker form-control" data-live-search="true" title="Categoria">
                                        <option value="">Selecione</option>
                                        @foreach($categorias as $c)
                                            <option value="{{$c->id}}">{{$c->nome}}</option>
                                        @endforeach
                                           
                                    </select> 
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descricao" class="col-md-2 col-form-label text-md-right">Descrição</label>

                                <div class="col-md-10">
                                    <textarea id="descricao" type="text" class="form-control" name="descricao">{{isset($post->descricao) ? $post->descricao : ''}}</textarea> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-2 col-form-label text-md-right">Status</label>

                                <div class="col-md-10">
                                    <input id="status" type="text" class="form-control" name="status" value="{{isset($post->status) ? $post->status : 'Aguardando resposta'}}" disabled>
                                </div>
                            </div>
 
                            
                            <div class="form-group row">
                                <label for="image" class="col-md-2 col-form-label text-md-right">Foto</label>

                                <div class="col-md-10">
                                     <input id="image" type="file" class="form-control" name="image">                         
                                </div>
                            </div>

                            @if(isset($post->image) && ($post->image != null) )
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Imagem</label>
                                <div class="col-md-6">
                                    <img id='img-post' class="img-fluid" src="{{asset('storage/posts/'.$post->image)}}"> 
                                </div>
                            </div>
                                
                            @endif 


                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Publicar
                                    </button>
                                </div>
                            </div>
                    </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
    #img-post{
        width: 286;
        height: 180;
    }
</style>

