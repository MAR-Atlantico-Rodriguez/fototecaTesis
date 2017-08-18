@extends('layouts.app')
@section('title','Todos los Usuarios')

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
	                <div class="panel-heading">Todos los usuarios del Sistema - Fototeca</div>
	                <div class="panel-body">
	                	<div class="table-responsive">
					    	<table class="table table-hover">
								<thead>
									<tr>
										<th>Nombre y Apellido</th>
										<th>Usuario</th>
										<th>Correo</th>
										<th>Ultima modificación</th>
										<th>Rol</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($users as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->updated_at }}</td>
										<td>{{ ($user->perfil == 0)? 'Usuario' : 'Administrador' }}</td>
										<td></td>
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
