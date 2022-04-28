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
            @if($usuarios and Auth::user()->hasRole('admin'))
            <div class="row mt-2">
                <div class="col">
                    <label>Seleccione un usuario</label>
                    <select id="select_user" class="form-control" name="user_id">
                        <option value=0 selected value> Todos </option>
                        @foreach($usuarios as $u)
                            @if(app('request')->input('user_id')==$u->id)
                                <option value="{{$u->id}}" selected>{{$u->id}} - {{$u->name}} </option>
                            @else
                                <option value="{{$u->id}}">{{$u->id}} - {{$u->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
            <div class="row mt-4">
                <div class="col">
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
                                <td>{{number_format($a->peso/1000000,2)}} MB</td>
                                <td>{{$a->created_at}}</td>
                                @if($usuarios)
                                    <td><a href="/delete_file/{{$a->id}}/1">Eliminar</a></td>
                                @else
                                    <td><a href="/delete_file/{{$a->id}}">Eliminar</a></td>
                                @endif
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <div class="paginas d-flex justify-content-center">
            {!! $archivos->links() !!}
        </div>
    </div>
    <script>
        /**
        * Revisa si se ha aplicado algun filtro, de ser asi manda la ruta correspondiente al filtro
        */
        const filtro=(user_id)=>{
            var filtro="?";
            if(user_id!=0){
                filtro+=`user_id=${user_id}`;
            }
            if(filtro.length>1){
                location.href = filtro;
            }else{
                location.href = "/historial_archivo_admin";
            }
        }

        document.getElementById("select_user").onchange=function(evt){
            const user_id = parseInt(evt.target.value);
            filtro(user_id);
        }
    </script>
@endsection