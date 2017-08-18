@extends('layouts.app')
@section('title','Recortar Imagen')

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
	    	<div class="col-sm-4" style="border: 1px solid #ccc">
				    
					<table class="table">
						<tr>
							<th>
								Titulo
							</th>
							<td>
								{{$img->titulo}}
							</td>
						</tr>
						<tr>
							<th>
								Autor	
							</th>
							<td>
								{{$img->name}}
							</td>
						</tr>
						<tr>
							<th>
								Categoria
							</th>
							<td>
								{{$img->categoria}}
							</td>
						</tr>
						<tr>
							<th>
								Fecha
							</th>
							<td>
								{{$img->fecha}}
							</td>
						</tr>
						<tr>
							<th>
								Rocortar
							</th>
							<td>
								<form action="{{url('recorte')}}" method="post" onsubmit="return checkCoords();">
							    	{{csrf_field()}}
							    	<input type="hidden" name="id" value="{{$img->id}}">
							    	<input type="hidden" name="src" value="{{url(substr($img->url,0,-4).'_we.jpg')}}">
									<input type="hidden" id="x" name="x" />
									<input type="hidden" id="y" name="y" />
									<input type="hidden" id="w" name="w" />
									<input type="hidden" id="h" name="h" />
									<input type="submit" value="Recortar Imagen" class="btn btn-danger" />
								</form>
							</td>
						</tr>
					</table>
						    		

	    		@include('fototeca.espacioEnDisco')

		    </div>
		    <div class="col-sm-8" >

			  
					<img src="{{url(substr($img->url,0,-4).'_we.jpg')}}" id="cropbox" class="img-responsive"/>
				
				
			</div>
		</div>
	</div>





	
@endsection
