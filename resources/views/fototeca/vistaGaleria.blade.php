@extends('layouts.app')
@section('title',$nombreCategoria)

@section('content')



	<div class="container">
  		<div class="row">
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
			      
	    		@include('fototeca.categorias')

	    		@include('fototeca.espacioEnDisco')

		    </div>
		    <div class="col-sm-8" id="inicio">
		    	

		    	<h2>{{$nombreCategoria}}</h2>
		    	<hr>
		    	@if(Session::has('eliminacion_imagen'))
			    	<div class="alert alert-danger  fade in">
	  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{Session::get('eliminacion_imagen')}}
			    	</div>
			    	<hr>
				@endif

				@if(Session::has('up_imagen'))
			    	<div class="alert alert-success  fade in">
	  					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{Session::get('up_imagen')}}
			    	</div>
			    	<hr>
				@endif
			    <div class="row">
			    	@foreach ($galeria as $img)
				    	<div class="col-md-4">
				        	<div class="thumbnail">
				          		<a href="{{url('verImagen/'.$img->id)}}" title="{{$img->titulo}}">
				            		<img src="{{url(substr($img->url,0,-4).'_th.jpg')}}" alt="{{$img->titulo}}" class="img-rounded">
				            		
				          		</a>
				        	</div>
				      	</div>				        
				    @endforeach
				</div>
				<center style="border-top: 1px solid #aaa">{{ $galeria->links() }}</center>
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
    .row .col-md-4 .thumbnail a img{
    	max-height: 140px;
    }
</style>
@endsection
