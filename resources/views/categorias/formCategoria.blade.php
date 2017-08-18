@extends('layouts.app')

@section('title','Nueva Categoria')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1" >
        <div class="panel panel-default">
                <div class="panel-heading">
                  {{$n_e}} Categoria | Categoria Padre: <b>{{$catPadreNombre}}</b>
                </div>

                <div class="panel-body">
                  <div class="table-responsive">      
                    <form method="post" action="{{url('categorias/NuevaEditarCategoria')}}">
                      {{ csrf_field() }}
                      <div class="input-group">        
                          <label>Categoria</label>
                          <input type="text" 
                                 class="form-control" 
                                 placeholder="Nueva Categoria" 
                                 id="categoria" 
                                 name="categoria"
                                 maxlength=100,
                                 value="{{$texInput}}">
                      </div>

                      <input type="hidden" name="categoriaPadre" value="{{$id_padre}}">
                      <input type="hidden" name="id_categoria" value="{{$id_categoria}}">
                      
                      <div class="input-group">
                        <br>
                          <button class="btn btn-success">Guardar</button>
                      </div>
                    </form>
                </div>
              </div>   
            </div>
          </div>
        </div>
      </div>


      <script src="{{ asset('public/js/categoria.js') }}"></script>
      <!-- FIN DEL FORMULARIO DE CATEGORIAS -->
          
        
@endsection