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
        <h5 class="card-header">Historial de archivos</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Tamaño</td>
                        <td>Fecha</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($archivos as $a)
                    <tr>
                        <td>{{$a->nombre}}</td>
                        <td>{{$a->peso}}</td>
                        <td>{{$a->created_at}}</td>
                        <td><a href="/delete_file/{{$a->id}}">Eliminar</a></td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="paginas d-flex justify-content-center">
            {!! $archivos->links() !!}
        </div>
    </div>
@endsection