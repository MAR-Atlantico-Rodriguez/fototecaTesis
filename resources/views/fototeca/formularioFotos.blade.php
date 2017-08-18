@extends('layouts.app')
@section('title','Subir Imagen')

@section('content')
<style>
	.thumb {
	  	width: 200px;
		margin: 10px 5px 0 0;
	}

    .onoffswitchBlNeBlNe{position:relative;width:90px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitchBlNe-checkbox{display:none}.onoffswitchBlNe-label{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitchBlNe-inner{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitchBlNe-inner:before,.onoffswitchBlNe-inner:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitchBlNe-inner:before{content:"Color";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitchBlNe-inner:after{content:"B/N";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitchBlNe-switch{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;right:52px;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitchBlNe-checkbox:checked + .onoffswitchBlNe-label .onoffswitchBlNe-inner{margin-left:0}.onoffswitchBlNe-checkbox:checked + .onoffswitchBlNe-label .onoffswitchBlNe-switch{right:0}


    .onoffswitchRepo{position:relative;width:90px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitch-checkboxRepo{display:none}.onoffswitch-labelRepo{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitch-innerRepo{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitch-innerRepo:before,.onoffswitch-innerRepo:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitch-innerRepo:before{content:"SI";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitch-innerRepo:after{content:"NO";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitch-switchRepo{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;right:52px;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-innerRepo{margin-left:0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-switchRepo{right:0}
</style>

	<div class="container">
  		<div class="row">
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
			      
	    		@include('fototeca.categorias')

	    		@include('fototeca.espacioEnDisco')

		    </div>
		    <div class="col-sm-8"  id="inicio">

		    <h3>Cargar Imagen - Categoria: <b>{{$categoriaSeleccionada}}</b></h3>

		    @if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

		    <hr>			    
			    
			    <div class="col-sm-9">
			    	<form method='post' action='{{url("/subir_imagen_usuario")}}' enctype='multipart/form-data'>
						{{csrf_field()}}
						<div class="form-group col-sm-6">
						    <label for="ejemplo_email_1">Titulo</label>
						    <input type="text" class="form-control" id="titulo" name="titulo"
						           placeholder="Introduce el titulo de la imagen">
						    <div class='text-danger'>{{$errors->first('titulo')}}</div>
						</div>
						
						<div class="form-group  col-sm-6">
						    <label for="ejemplo_password_1">Fecha</label>
						    <div class="input-group">
							    <input type="text" class="form-control" id="datepicker" name="fecha" placeholder='{{date("Y-m-d")}}' value='{{date("Y-m-d")}}'>
							    <div class='text-danger'>{{$errors->first('fecha')}}</div>
						        <div class="input-group-addon">
	                                <span class="glyphicon glyphicon-th"></span>
	                            </div>
	                        </div>
						</div>
												
						
						<div class="form-group col-sm-12">
						    <label for="ejemplo_email_1">TAG's</label>
						    <select id="tags"  name="tags[]" class="form-control" multiple></select>
						</div>

						<div class="form-group col-sm-6">
						    <label for="ejemplo_email_1">Color o B/N</label>
					        <div class="onoffswitchBlNeBlNe">
						        <input type="checkbox" name="cob_n" class="onoffswitchBlNe-checkbox" id="myonoffswitchBlNe" checked value="1">
						        <label class="onoffswitchBlNe-label" for="myonoffswitchBlNe">
						            <span class="onoffswitchBlNe-inner"></span>
						            <span class="onoffswitchBlNe-switch"></span>
						        </label>
						    </div>					    
						</div>

						<div class="form-group col-sm-6">
						    <label for="ejemplo_email_1">Mostrar en repositorio</label>
					        <div class="onoffswitchRepo">
						        <input type="checkbox" name="repositorio" class="onoffswitch-checkboxRepo" id="myonoffswitchRepo"  value="1">
						        <label class="onoffswitch-labelRepo" for="myonoffswitchRepo">
						            <span class="onoffswitch-innerRepo"></span>
						            <span class="onoffswitch-switchRepo"></span>
						        </label>
						    </div>					    
						</div>

						<div class="form-group  col-sm-12">
						    <label for="ejemplo_email_1">Descripcion</label>
						    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Introduce la descripcion de la imagen">
						    <div class='text-danger'>{{$errors->first('descripcion')}}</div> 
						</div>
						

						<div class='form-group  col-sm-12'>							
							<label for='image'>Imagen </label>							
							<input type="file" name="image[]" id="image" class="btn btn-default" multiple="true"/>	
							<div class='text-danger'>{{$errors->first('image')}}</div>		
						</div>


						<input type="hidden" name="idCategoria" value="{{$idCategoria}}">
						<input type="hidden" name="categoriaSeleccionada" value="{{$categoriaSeleccionada}}">
						<button type='submit' class='btn btn-primary'>Subir Imagen al Servidor</button>
					</form>
			    </div>

			    <div class="col-sm-3">

					<output id="imgPreview"></output>

			    </div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
	    function archivo(evt) {              	
	        var files = evt.target.files; // FileList object             
	        // Obtenemos la imagen del campo "file".
	        for (var i = 0, f; f = files[i]; i++) {
	    	    //Solo admitimos imágenes.
	        	if (!f.type.match('image.*')) {
	            	continue;
	            }             
	            var reader = new FileReader();             
	            reader.onload = (function(theFile) {
	                return function(e) {
	                  // Insertamos la imagen
	                document.getElementById("imgPreview").innerHTML = ['<img class="thumb img-thumbnail" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
	                };
	            })(f);             
	            reader.readAsDataURL(f);
	        }
	    }             
	    document.getElementById('image').addEventListener('change', archivo, false);

	    var myImage = $("#image");
		var dominantColor = getDominantColor(myImage);
		var paletteArray = createPalette(myImage, 10);
	   	
    </script>
@endsection
