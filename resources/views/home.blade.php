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
    <div class="row mt-4 justify-content-center">
        <div class="col-md-6">
        	<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Subir archivos</h5>
                    <h2><a href="/archivo"><i class="fa-solid fa-upload"></i></a></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Mis archivos</h5>
                    <h2><a href="/historial"><i class="fa-solid fa-box-archive"></i></a></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
