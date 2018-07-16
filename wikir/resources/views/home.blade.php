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
                                <li class="breadcrumb-item active" aria-current="page">{{$endereco->cidade}} - {{$endereco->uf}}</li>
                              </ol>
                            </nav>
                        </div>


                        <div class="col-md-4">
                            <a href="{{route('new.post')}}" class="btn btn-success btn-lg col-12"><i class="fas fa-plus" style="size: 5x;"></i> Novo Post</a>
                            </br>
                        </div>
                        
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </br>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="card text-white bg-primary">
                                <div class="card-header"><b>Meus Posts</b></div>
                                <div class="card-body">
                                    <p class="card-text">Visualize suas publicações e respostas do editor.</p>
                                </div>
                                <div class="card-footer"><a href="{{route('posts.user')}}" class="card-link" style="color: white;"> <b>Visualizar</b> <i class="fas fa-angle-double-right"></i></a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card text-white bg-success">
                                <div class="card-header"><b>Posts de {{$endereco->cidade}}</b></div>
                                <div class="card-body">
                                    <p class="card-text">Veja os problemas a cerca {{$endereco->cidade}} e ajude fiscalizando!</p>
                                </div>
                                <div class="card-footer"><a href="{{route('posts')}}" class="card-link" style="color: white;"><b>Visualizar </b> <i class="fas fa-angle-double-right"></i></a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card text-white bg-danger">
                                <div class="card-header"><b>Meu perfil</b></div>
                                <div class="card-body">
                                   <p class="card-text">Verificar informações de perfil e editar informações</p>
                                </div>
                                <div class="card-footer"><a href="{{route('perfil')}}" class="card-link" style="color: white;"><b>Visualizar </b><i class="fas fa-angle-double-right"></i></a></div>
                            </div>
                        </div>

                    </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
    .card{
    }
</style>
