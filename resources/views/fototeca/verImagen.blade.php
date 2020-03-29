
@extends('layouts.app')
@section('title',$imagen->titulo)

@section('content')

<style type="text/css">
	.table-striped > tbody > tr:nth-of-type(2n+1) {
	    background-color: #e8e8e8 !important;
	}
</style>

	<div class="container">
  		<div class="row">
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
	    		@include('fototeca.categorias')

	    		@include('fototeca.espacioEnDisco')

		    </div>



		    <div class="col-sm-8"  id="inicio">
		    	@if(Session::has('edit_imagen'))
			    	<div class="alert alert-info  fade in">
	  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{Session::get('edit_imagen')}}
			    	</div>
			    	<hr>
				@endif
		    	<h2><a href="{{url('galeria/'.$imagen->id_categoria)}}" class="btn btn-success btn-xs" title="Volver a la Galeria"><i class="glyphicon glyphicon-arrow-left"></i></a> | {{$imagen->titulo}}</h2>
		    	<br>
		    	<div class="table-responsive">
					<table class="table">
						<tr>
							<td class="col-sm-7">
								<table class="table table-striped">
									<tr>
										<th>ID</th>
										<td>#{{$imagen->id}}</td>
									</tr>

									<tr>
										<th>Titulo</th>
										<td>{{$imagen->titulo}}</td>
									</tr>

									<tr>
										<th>Descripción</th>
										<td>{{$imagen->descripcion}}</td>
									</tr>

									<tr>
										<th>Fecha de carga</th>
										<td>{{Carbon\Carbon::parse($imagen->fecha)->format('d/m/Y')}}</td>
									</tr>

									<tr>
										<th>Categoria</th>
										<td>{{$imagen->categoria}} </td>
									</tr>
									@if(count($imagen->log))
									<tr>
										<th>Propietario</th>
										<td>{{$imagen->log[0]->name}}</td>
									</tr>
									@endif
									<tr>
										<th>Imagen Orientación</th>
										<td>{{ ($imagen->foto_orientacion)?'Vertical' : 'Horizontal'}}</td>

									</tr>
									<tr>
										<th>Imagen Color o B/N</th>
										<td>{{ ($imagen->foto_color)?'Color' : 'Blanco y Negro'}}</td>
									</tr>

									<tr>
										<th>Repositorio Institucional</th>
										<td>{{ ($imagen->repositorio)?'SI' : 'NO'}}</td>
									</tr>

									<tr>
										<th>Acciones</th>
										<td>


											<a href="#" class="btn btn-primary btn-md" title="Descargar imagen" onclick="abrirPopUp({{$imagen->id}},0)">
												<i class="glyphicon glyphicon-cloud-download"></i>
												Descarga
											</a>


											<a href="{{url('recortar/'.$imagen->id)}}" class="btn btn-info btn-md" title="Recortar Imagen">
												<i class="glyphicon glyphicon-scissors"></i>
												Recortar
											</a>
										</td>
									</tr>

									<tr>
										<th>Editar - Eliminar</th>
										<td>
											<a href="{{url('imagen/edit/'.$imagen->id)}}" class="btn btn-info btn-md" title="Editar Imagen">
												<i class="glyphicon glyphicon glyphicon-edit"></i>
											</a>
											@if (Auth::user()->perfil)
												<form action="{{url('destroy/'.$imagen->id)}}"
													  method="POST" style="float: left;margin-right: 5px; width: 40px;">
									            	{{ csrf_field() }}
									            	{{ method_field('DELETE') }}
										            <button class="glyphicon glyphicon-remove-circle btn btn-danger"
										            		title="Eliminar la imagen de la WEB">
										            </button>
									    	    </form>
								    	    @endif
										</td>
									</tr>




									<tr>
										<th>TAG's</th>
										<td>
											<ul style="margin-left: -30px">
												@foreach($tags as $v)
													<li><i>#{{ $v->tag }}</i></li>
												@endforeach
											</ul>
										</td>
									</tr>
								</table>
							</td>




							<td class="col-sm-5">

								<img src="../{{$imagen->urlImg}}_th.jpg" class="img-responsive img-thumbnail">

								<hr>

								@if($prevSig->anterior > 0)
									<a href="{{ url('verImagen/'.$prevSig->anterior) }}" class="btn btn-warning" title="Imagen Anterior">
										<i class="glyphicon glyphicon-hand-left"></i>
									</a>
								@endif
								@if($prevSig->posterior > 0)
									<a href="{{ url('verImagen/'.$prevSig->posterior) }}" class="btn btn-warning pull-right" title="Imagen Posterior">
										<i class="glyphicon glyphicon-hand-right"></i>
									</a>
								@endif



									<hr>
									@if(count($imagen->log) > 1)
									<h3>Ediciones</h3>
									<table class="table">
										<tr>
											<th>Nombre</th>
											<th>Fecha</th>
										</tr>

										@foreach($imagen->log as $v)
											@if($v->descripcion == 'Edicion')
												<tr>
													<td>{{$v->name}}</td>
													<td>{{$v->updated_at->format("d/m/yy")}}</td>
												</tr>
											@endif
										@endforeach
									</table>
									@endif
							</td>
						</tr>
					</table>

				</div>

				<div class="col-sm-12">
					@if(count($recortes))
						<h2>Recortes</h2>
						<hr>
						@foreach($recortes as $r)
							<div class="col-md-4">
								<a onclick="abrirPopUp({{$r->id}},1)" title="DESCARGAR IMAGEN RECORTADA" style="cursor:pointer">
				          			<img src="{{ url($r->url) }}"
				          				 width="150px"
				          				 height="120px"
				          				 alt=""
				          				 class="img-rounded">
				            		<div class="caption">
				              			<b>Usuario: </b>
				              			<br>
				              			<b>Fecha: {{Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i:s') }}</b>
				            		</div>
				            	</a>

					      	</div>

						@endforeach
					@endif
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






<!-- Modal DESCARGA DE IMAGEN DE AGUA-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Descargar Imagen Con Marca de Agua</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<table class="table table-striped table-responsive">
      			<tr id="selectFW">
      				<th>Tamaño de Imagen</th>
      				<td>
      					<select id="tamImg">
      						<option value="1">
      							Imagen Web
      						</option>
      						<option value="0">
      							Imagen Full
      						</option>
      					</select>
      				</td>
      			</tr>

      			<tr>
      				<th>Marca de Agua</th>
      				<td>
      					 <input type="checkbox"
				                id="checkImgAgua"
				                value="1"
				                onclick="$('#imgAgua').toggle()">
      				</td>
      			</tr>
      		</table>

      		<hr>

      		<table id="imgAgua" class="table table-striped table-responsive" style="display:none">
      			<tr>
      				<th>Seleccione la marca de agua</th>
      				<td>
      					<div class="col-sm-5">
	      					<select onchange="archivo(this.value)" id="logo">
	      						<option value="1">Logo 1</option>
	      						<option value="2">Logo 2</option>
	      						<option value="3">Logo 3</option>
	      						<option value="4">Logo 4</option>
	      						<option value="5">Logo 5</option>
	      					</select>
	      				</div>
	      				<div class="col-sm-7" style="background: #ccc">
      						<center><output id="imgPreview"></output></center>
      					</div>
      				</td>
      			</tr>
      			<tr>
      				<th>Gradue la opacidad</th>
      				<td>
      				<div class="col-sm-10">
      					<input type="range" name="opacidad" min="10" max="100" value="100" onchange="opacasion(this.value)" id="opacidad">
      				</div>
      				<div  class="col-sm-2">
      					<span id="range" class="label label-info">100</span>
      				</div>
      				</td>
      			</tr>
      			<tr>
      				<th>Posicion de la marca de agua</th>
      				<td>
      					<select id="posicion">
      						<option value="0">Arriba a la Izquierda</option>
      						<option value="1">Arriba al Centro</option>
      						<option value="2">Arriba a la Derecha</option>
      						<option value="3">Centro a la Izquierda</option>
      						<option value="4">Centro al Centro</option>
      						<option value="5">Centro a la Derecha</option>
      						<option value="6">Abajo a la Izquierda</option>
      						<option value="7">Abajo al Centro</option>
      						<option value="8" selected="">Abajo a la Derecha</option>
      					</select>
      				</td>
      			</tr>
      		</table>
      		<input type="hidden" id="url" value='{{ url("") }}'>
      		<input type="hidden" id="id">
      		<input type="hidden" id="imgRecorte">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button onclick="descargar()" class="btn btn-primary">Descargar!!!</button>
      </div>
    </div>
  </div>
</div>


<script>
	function archivo(img) {
		var array = ["","../public/img/logoUnne.png", "../public/img/logoUnneBlanco.png", "../public/img/logoUnneDescripcion.png", "../public/img/logoUnneNegro.png", "../public/img/marcaAguaUnne1.png"];
		document.getElementById("imgPreview").innerHTML = '<img src="'+array[img]+'" height="100px">';
	}
	archivo(1);

	function opacasion(op){
		$('#range').html(op);
		document.getElementById("imgPreview").style.opacity = op*0.01;
	}

	function descargar(){
		var id = $("#id").val();
		var imgRecorte = $("#imgRecorte").val();// 0 o 1... 0 Imagen   1 Recorte
		var posicion = ($("#checkImgAgua").is(':checked')?$("#posicion").val() : 0);
		var logo = ($("#checkImgAgua").is(':checked')?$("#logo").val() : 0);
		var opacity = ($("#checkImgAgua").is(':checked')?$("#opacidad").val() : 100);
		var url = $("#url").val();

		var imgAgua = ($("#checkImgAgua").is(':checked')?'1':'0');
		var tamImg = $("#tamImg").val(); //1 WEB - 0 FULL

		//console.log(posicion);

		location.href = url+"/descargarImagen/"+id+"/"+imgRecorte+"/"+posicion+"/"+logo+"/"+opacity+"/"+tamImg;
	}

	function abrirPopUp(id,imgRecorte){
		$('#checkImgAgua').prop('checked', false);
		$("#imgAgua").css('display','none');
		$("#myModal").modal("show");
		$("#id").val(id);
		$("#imgRecorte").val(imgRecorte);
		//Si es RECORTE, Entonces que esconda el Selector de si es Full o Web
		if(imgRecorte == 1){
			$("#selectFW").css('display','none');
		}else{
			$("#selectFW").css('display','');
		}
	}
</script>


@endsection
