@extends('layouts.app')
@section('title','Lista de Categorias')

@section('content')

<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
</style>

	<div class="container">
  		<div class="row">
		    <div class="col-md-10 col-md-offset-1" >
		    	<div class="panel panel-default">
	                <div class="panel-heading">
	                	
	                	@if($categoriaPadre)
		                	<div class="pull-left" style="margin-right: 10px;">
		                		<a href="{{url('categorias/lista/'.$idCategoriaPadre)}}" class="btn btn-success btn-xs" title="Volver a la Categoria padre">
									<i class="glyphicon glyphicon-arrow-left"></i>
								</a>
		                	</div>
		                @endif

	                	Categoria <b>{{$categoriaPadre}}</b>

	                	<div class="pull-right">
	                		<a href="{{ url('categorias/formulario/'.$id) }}" class="btn btn-success btn-xs" title="Nueva Categoria">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
	                	</div>

	                </div>

	                <div class="panel-body">
	                	<div class="table-responsive">

					    	<table class="table table-hover">
								<thead>
									<tr>
										<th>#ID</th>
										<th>Categoria</th>										
										<th>Sub Categorias</th>
										<th>Imagenes</th>
										<th>Usuario</th>
										<!--th>Fecha Cración</th>
										<th>Fecha Modificación</th-->
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								
								@foreach ($categorias_padres as $c)
									<tr>
										<td>{{ $c->id }}</td>
										<td>
										@if($c->block)
											<a href="{{url('categorias/lista/'.$c->id)}}">
												<b>{{ $c->categoria }}</b>
											</a>
										@else
												{{ $c->categoria }}
										@endif
										</td>
										<td><center>{{$c->cantSubCat}}</center></td>
										<td><center>{{$c->cantImagen}}</center></td>
										<td>{{ $c->name }}</td>
										<!--td>{{ $c->created_at }}</td>
										<td>{{ $c->updated_at }}</td-->
										<td>
											
											
											<a href="{{url('categorias/formulario/'.$c->id_padre.'/'.$c->id)}}" class="btn btn-primary" title="Editar TAG">
												<i class="glyphicon glyphicon-edit"></i>
											</a>

											@if($c->block)
												<a href="#" onclick="event.preventDefault();document.getElementById('block{{ $c->id }}').submit();" class="btn btn-success" title="Bloquear TAG" >
													<i class="glyphicon glyphicon-thumbs-up"></i>
												</a>
												<form id="block{{ $c->id }}" action="{{ url('categorias/block') }}" method="POST" style="display: none;">
													<input type="hidden" name="block" value="0">
													<input type="hidden" name="idCategoria" value="{{ $c->id }}">
				                                    {{ csrf_field() }}
				                                </form>
											@else
												<a href="#" onclick="event.preventDefault();document.getElementById('block{{ $c->id }}').submit();" class="btn btn-danger" title="Desbloquear TAG">
													<i class="glyphicon glyphicon-thumbs-down"></i>
												</a>
												<form id="block{{ $c->id }}" action="{{ url('categorias/block') }}" method="POST" style="display: none;">
													<input type="hidden" name="block" value="1">
													<input type="hidden" name="idCategoria" value="{{ $c->id }}">
				                                    {{ csrf_field() }}
				                                </form>
											@endif	
										</td>
										
									</tr>
								@endforeach

								</tbody>
								
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>





	
@endsection
