@extends('layouts.app')

@section('content')
    <style>
        .card{
            margin-right: 2%;
        }
        .paginas{
            margin-top:2%;
        }
    </style>
    <div class="card">
        @include('layouts.mensajes')
        <h5 class="card-header">Usuarios en el sistema</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Cantidad de archivos</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $u)
                    <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{count($u->archivos()->get())}}</td>
                        <td><a href="/archivo/{{$u->id}}">Subir un archivo</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="paginas d-flex justify-content-center">
            {!! $usuarios->links() !!}
        </div>
    </div>
@endsection