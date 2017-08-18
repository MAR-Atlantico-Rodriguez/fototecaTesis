@extends('layouts.app')
@section('title','Formulario de Tags')

@section('content')


	 <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1" >
        <div class="panel panel-default">
                <div class="panel-heading">
                	Nuevo Tags
		    	</div>

                <div class="panel-body">
                  <div class="table-responsive">  
			    	<form method='post' action='{{url("tags/newTag")}}'>
						{{csrf_field()}}
						<div class="form-group">
						    <label for="ejemplo_email_1">Tag</label>
						    <input type="text" class="form-control" id="tag" name="tag"
						           placeholder="Introduce el Tag" value="{{ $tag->tag }}">
						</div>
												
						<input type="hidden" name="id" value="{{ $id }}">
						
						<button type='submit' class='btn btn-primary'>Nuevo Tag</button>
					</form>
			     </div>
              </div>   
            </div>
          </div>
        </div>
      </div>
	
@endsection
