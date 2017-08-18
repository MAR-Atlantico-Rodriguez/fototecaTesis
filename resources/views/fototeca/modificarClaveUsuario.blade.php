@extends('layouts.app')
@section('title','Cambio de Clave')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cambiar Clave de Acceso - <b>{{Auth::user()->name}}</b></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('reinicio_clave'))
                        <div class="alert alert-danger  fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{Session::get('reinicio_clave')}}
                        </div>
                        <hr>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('modificarClave') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Clave Nueva</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cambiar Clave
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
