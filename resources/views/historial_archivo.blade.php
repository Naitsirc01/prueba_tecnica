@extends('layouts.app')
@section('content')
    <style>
        .card{
            margin-right: 2%;
        }
    </style>
    <div class="card">
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
                <tr>
                    <td>archivo 1</td>
                    <td>20 mb</td>
                    <td>Fecha</td>
                    <td>Eliminar</td>
                </tr>
            </table>
        </div>
    </div>
@endsection