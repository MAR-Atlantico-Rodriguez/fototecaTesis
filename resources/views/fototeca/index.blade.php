@extends('layouts.app')

@section('title')
	{{ Auth::user()->name }} 
@endsection



@section('content')
	<div class="container">
	  	<div class="row">
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
			      
	    		@include('fototeca.categorias')

	    		@include('fototeca.espacioEnDisco')	    		


		    </div>
		    <div class="col-sm-8" id="inicio">
		    	<h3>Ultimas 12 imagenes archivadas</h3>
		    	<hr>
			
				@include('fototeca.listadoImagen')
		    	
		    </div>

		</div>
	</div>
@endsection