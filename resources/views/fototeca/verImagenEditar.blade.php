@extends('layouts.app')
@section('title',$imagen->titulo)

@section('content')

<style type="text/css">
	.table-striped > tbody > tr:nth-of-type(2n+1) {
	    background-color: #e8e8e8 !important;
	}
	.onoffswitchBlNeBlNe{position:relative;width:90px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitchBlNe-checkbox{display:none}.onoffswitchBlNe-label{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitchBlNe-innerBN{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitchBlNe-innerBN:before,.onoffswitchBlNe-innerBN:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitchBlNe-innerBN:before{content:"Color";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitchBlNe-innerBN:after{content:"B/N";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitchBlNe-switchBN{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;right:52px;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitchBlNe-checkbox:checked + .onoffswitchBlNe-label .onoffswitchBlNe-innerBN{margin-left:0}.onoffswitchBlNe-checkbox:checked + .onoffswitchBlNe-label .onoffswitchBlNe-switchBN{right:0}
	.onoffswitchRepo{position:relative;width:90px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitch-checkboxRepo{display:none}.onoffswitch-labelRepo{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitch-innerRepo{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitch-innerRepo:before,.onoffswitch-innerRepo:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitch-innerRepo:before{content:"SI";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitch-innerRepo:after{content:"NO";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitch-switchRepo{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;right:52px;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-innerRepo{margin-left:0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-switchRepo{right:0}

</style>

	<div class="container">
  		<div class="row">
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
			      
	    		@include('fototeca.categorias')

	    		@include('fototeca.espacioEnDisco')

		    </div>

		    <div class="col-sm-8"  id="inicio">
		    	<div class="col-sm-12">
			    	<h2>
			    		<a href="{{url('verImagen/'.$imagen->id)}}" class="btn btn-success btn-xs" title="Volver a la Imagen">
			    			<i class="glyphicon glyphicon-arrow-left"></i>
			    		</a> | {{$imagen->titulo}}
			    	</h2>
		    	</div>
		    	
				
				<div class="col-sm-8">
					<form method='post' action='{{url("/imagen/edit")}}' enctype='multipart/form-data'>
					{{csrf_field()}}

						<table class="table table-striped">
							<tr>
								<th>ID</th>
								<td>#{{$imagen->id}}</td>
							</tr>
							
							<tr>
								<th>Titulo</th>
								<td>
									<input type="text" class="form-control" id="titulo" name="titulo" value="{{$imagen->titulo}}">
								</td>
							</tr>
							<tr>
								<th>Descripción</th>
								<td>
									<input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$imagen->descripcion}}">
								</td>
							</tr>

							<tr>
								<th>Fecha de carga</th>
								<td>
									 <input type="text" class="form-control" id="datepicker" name="fecha" value='{{$imagen->fecha}}'>
								</td>
							</tr>

							<tr>										
								<th>Imagen Color o B/N</th>
								<td>
									<div class="onoffswitchBlNeBlNe">
								        <input type="checkbox" 
								         	   name="cob_n" 
								        	   class="onoffswitchBlNe-checkbox" 
									       	   id="myonoffswitchBlNe"
									       	   value="1"
									       	   {{ ($imagen->foto_color)?'checked' : ''}}>
									    <label class="onoffswitchBlNe-label" for="myonoffswitchBlNe">
									        <span class="onoffswitchBlNe-innerBN"></span>
									        <span class="onoffswitchBlNe-switchBN"></span>
									    </label>
									</div>

								</td>
							</tr>

							<tr>										
								<th>Repositorio Institucional</th>
								<td>
									<div class="onoffswitchRepo">
								        <input  type="checkbox" 
								        		name="repositorio" 
								        		class="onoffswitch-checkboxRepo" 
								        		id="myonoffswitchRepo" 
								        		value="1"
									        	{{ ($imagen->repositorio)?'checked' : ''}}>
									    <label  class="onoffswitch-labelRepo" 
									       		for="myonoffswitchRepo">
									        <span class="onoffswitch-innerRepo"></span>
									        <span class="onoffswitch-switchRepo"></span>
									    </label>
									</div>	
								</td>
							</tr>

							<tr>										
								<th>TAG's</th>
								<td>
									<select id="tagsEdit"  name="tags[]" class="form-control" multiple></select>
									<hr>
									<ul style="margin-left: -30px">
										@foreach($tags as $v)
											<li id="tag{{$v->id_imagen}}{{$v->id_tag}}">
												<i>#{{ $v->tag }} 
													<span class="glyphicon glyphicon-trash" style="cursor:pointer; float:right;" onclick="EliminarTag('{{$v->id_imagen}}','{{$v->id_tag}}')">				
													</span>
												</i>
											</li>
										@endforeach
									</ul>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input 	type="hidden" 
											name="id_imagen" 
										   	value="{{$imagen->id}}"
										   	id="id_imagen">
									<button type='submit' 
										    class='btn btn-primary'>
									    Editar Datos de Imagen
									</button>
								</td>
							</tr>
						</table>
					</div>

					<div class="col-sm-4">
						<img src="../../{{$imagen->urlImg}}_th.jpg" class="img-responsive img-thumbnail">
					</div>
			</div>	
    	
		</div>
	</div>
</div>

<style type="text/css">
    div.col-md-4 {
        min-height: 200px!important;
    }
    div.caption{
        font-size: 12px;
    }
</style>



<script>
	function EliminarTag(id_imagen, id_tag) {
		if (confirm('Quiere eliminar este Tag???')) {
		    var _token =  $("input[name='_token']").val();
		    var atributos = {'_token': _token,
		                   'id_imagen': id_imagen,
		                   'id_tag': id_tag
		                 };			
			$.ajax({
		      url: 'http://fototeca.unne.edu.ar/eliminarTag',
		      type: "post",
		      data: atributos,
		       success: function(data){ // What to do if we succeed
		       		if(data){
		           		$("#tag"+id_imagen+id_tag).remove();
		           	}else{
		           		alert('Ocurrio un error, no se pudo eliminar el TAG!!!');
		           	}
		        },
		        error: function(response){
		            console.log('Error'+response);
		            }
		        }); 
		}
	}	
</script>


@endsection
