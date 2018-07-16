@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Posts</li>
                              </ol>
                            </nav>
                        </div>

                        <div class="col-md-4">
                            <a href="{{route('new.post')}}" class="btn btn-success btn-lg col-12"><i class="fas fa-plus" style="size: 5x;"></i> Novo Post</a>
                            </br>
                        </div>
                        
                    </div>
                    
                    <div>
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                               <h4>{{$info}} {{$endereco->cidade}} - {{$endereco->uf }}</h4> 
                            </div>
                        </div>
                        
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   

                    
                    <div class="row">

                        <div class="col-md-3">  
                            </br>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{$endereco->cidade}} - {{$endereco->uf }}</h4>
                                    <p class="card-text"><b>{{ auth()->user()->name }} </b></br>{{ auth()->user()->email }}</p>
                                    @if($img->img_user != null)
                                        <img class="img-fluid" src="{{asset('storage/users/'.$img->img_user)}}" style="width: 160px; height: 160px;"></br>
                                    @else
                                        <img class="img-fluid" src="{{asset('storage/users/blank.png')}}" style="width: 160px; height: 160px;"></br>
                                    @endif
                                </div>  
                            </div>

                        </div>
                        
                        
                        <div class="col-md-9"> 
                        </br>  
                        @include('includes.alerts')
                            
                        @if(isset($posts[0]))
                            @foreach($posts as $p)
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <p class="card-title">
                                            <img class="img-fluid" src="{{asset('storage/users/'.$p->img_user)}}" style="width: 40px; height: 40px;">
                                        
                                            <b> {{$p->name}}</b> notificou <b>{{$p->nome}} </b> em {{\Carbon\Carbon::parse($p->updated_at)->format('d-m-y')}}
                                        </p>   
                                    </div>
                                    
                                    <p class="card-text">{{$p->descricao}}</p>
                                    @if($p->image != null)
                                        <img id="img-post" src="{{asset('storage/posts/'.$p->image)}}" alt="Imagem do post" class="img-fluid"></br>
                                    @endif
                                    </br>
                                    @if($p->user_id == auth()->user()->id)
                                    <div class="links">
                                        <a id="a-editar" href="{{ action('PostController@editPost', $p->id) }}" class="card-link">Editar </a> 
                                        <a id="a-remover" href="{{ action('PostController@delete',$p->id) }}"> Remover </a> 
                                    </div>
                                    @endif
                                </div> 
                            </div>
                            </br>
                            @endforeach
                        @endif
                                                  

                        </div>

                    </div>
                    

            </div>
        </div>
    </div>
</div>


@endsection

<style type="text/css">
    #img-post{
        width: 820px;
        height: 312px;
        position: relative;
    } 

    .links{
        position:relative;
        float: right;
    }

    .links a{
        margin-right: 15px;
    }




</style>
