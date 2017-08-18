@extends('layouts.app')
@section('title','Lista de Tags')

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
	                	
	                		TAGS - Fototeca
	                	
	                	<div class="pull-right">
	                		<a href="{{ url('tags/newTag') }}" class="btn btn-success btn-xs" title="Nuevo TAG">
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
										<th>Tags</th>
										
										<th>Usuario</th>
										<th>Fecha Cración</th>
										<th>Fecha Modificación</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($tags as $tag)
									<tr>
										<td>{{ $tag->id }}</td>
										<td>{{ $tag->tag }}</td>
										<td>{{ $tag->users->name }}</td>
										<td>{{ $tag->created_at }}</td>
										<td>{{ $tag->updated_at }}</td>
										<td>
											<a href="{{url('tags/editTag/'.$tag->id)}}" class="btn btn-primary" title="Editar TAG">
												<span class="glyphicon glyphicon-edit"></span>
											</a>

											@if($tag->block)
												<a href="#" onclick="event.preventDefault();document.getElementById('block{{ $tag->id }}').submit();" class="btn btn-success" title="Bloquear TAG" >
													<span class="glyphicon glyphicon-thumbs-up"></span>
												</a>
												<form id="block{{ $tag->id }}" action="{{ url('tags/block') }}" method="POST" style="display: none;">
													<input type="hidden" name="block" value="0">
													<input type="hidden" name="idTag" value="{{ $tag->id }}">
				                                    {{ csrf_field() }}
				                                </form>
											@else
												<a href="#" onclick="event.preventDefault();document.getElementById('block{{ $tag->id }}').submit();" class="btn btn-danger" title="Desbloquear TAG">
													<span class="glyphicon glyphicon-thumbs-down"></span>
												</a>
												<form id="block{{ $tag->id }}" action="{{ url('tags/block') }}" method="POST" style="display: none;">
													<input type="hidden" name="block" value="1">
													<input type="hidden" name="idTag" value="{{ $tag->id }}">
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
