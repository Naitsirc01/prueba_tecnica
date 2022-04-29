@extends('layouts.app')

@section('content')
    <div class="card">
        <h5 class="card-header">Permiso del usuario: {{$user->name}}</h5>
        <div class="card-body">
            <form action="/update_permisos" method="POST">
                @csrf
                <input name="user_id" value="{{$user->id}}" hidden>
                <input name="user_name" value="{{$user->name}}" hidden>
                <div class="row mb-2">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="permisos[]" id="permiso_1">
                            <label class="form-check-label" for="defaultCheck1">
                                Archivos
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="permisos[]" id="permiso_2">
                            <label class="form-check-label" for="defaultCheck1">
                                Subida de archivos
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" name="permisos[]" id="permiso_3">
                            <label class="form-check-label" for="defaultCheck1">
                                Historial de archivvos
                            </label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary"> Guardar</button>
            </form>
        </div>
    </div>
    <script>
        const permisos={!! $permisos !!};
        permisos.forEach(function(element){
            document.getElementById("permiso_"+element.acceso_id).checked = true;
        });
    </script>
@endsection