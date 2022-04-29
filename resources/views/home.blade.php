@extends('layouts.app')

@section('content')
<style>
	.div_cuadrado{
		width: 300px;
		height: 300px;
		border: solid 2px blue;
		border-radius: 5px;
	}
    .card-body{
        text-align: center;
    }
</style>
<div class="container">
    <div class="row mt-2">
        <h1>Laravel Home</h1>
    </div>
    <div class="row mt-2">
        <h3>Bienvenido {{Auth::user()->name}}</h3>
    </div>
    @if(Auth::user()->acceso(1))
    
    <div class="row mt-4 justify-content-center">
        @if(Auth::user()->acceso(2))
        <div class="col-md-6">
        	<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Subir archivos</h5>
                    <h2><a href="/archivo"><i class="fa-solid fa-upload"></i></a></h2>
                </div>
            </div>
        </div>
        @endif
        @if(Auth::user()->acceso(3))
        <div class="col-md-6">
        	<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Mis archivos</h5>
                    <h2><a href="/historial"><i class="fa-solid fa-box-archive"></i></a></h2>
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
        <h3>Usted no posee ningún permiso, contacte a un administrador para solicitar permisos.</h3>
    @endif
</div>
@endsection
