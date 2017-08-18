<h3>Se encontraron {{count($galeria)}} imágenes</h3>
<div class="row">
	@foreach ($galeria as $img)
    	<div class="col-md-4">
        	<div class="thumbnail">
          		<a href="{{url('verImagen/'.$img->id)}}">
            		<img src="{{url(substr($img->url,0,-4).'_th.jpg')}}" alt="{{$img->titulo}}" class="img-rounded">
            		
          		</a>
        	</div>
      	</div>
        
    @endforeach
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