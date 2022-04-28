@extends('layouts.app')

@section('content')
	<style>
		.contenedor{
			padding: 10%;
			
		}
		.formulario{
			padding: 2%;
			border: 1px solid;
			border-radius: 10px;
		}
	</style>
	<div class="contenedor">
		@include('layouts.mensajes')
        <div class="formulario">
			<h3>Subir archivo</h3>
			<form action="/upload_file" method="POST" enctype ="multipart/form-data">
				@csrf
				<div class="custom-file">
					<input type="file" name="file" class="custom-file-input" id="customFile" required>
					<label class="custom-file-label" for="customFile">Buscar archivo</label>
				</div>
				<button type="submit" class="btn btn-primary mt-4">Subir</button>
			</form>
		</div>
	</div>
	
	<script>
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
@endsection