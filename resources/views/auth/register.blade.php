@extends('layouts.app')
@section('title','Usuarios')
@section('content')
<style type="text/css">
    .onoffswitchRepo{position:relative;width:140px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitch-checkboxRepo{display:none}.onoffswitch-labelRepo{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitch-innerRepo{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitch-innerRepo:before,.onoffswitch-innerRepo:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitch-innerRepo:before{content:"Administrador";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitch-innerRepo:after{content:"Usuario";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitch-switchRepo{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;right:105px;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-innerRepo{margin-left:0}.onoffswitch-checkboxRepo:checked + .onoffswitch-labelRepo .onoffswitch-switchRepo{right:0}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Usuario</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre y Apellido</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Calve</label>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Clave</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Permiso</label>
                            <div class="col-md-6">
                                <div class="onoffswitchRepo">
                                    <input type="checkbox" name="perfiles" value="1" class="onoffswitch-checkboxRepo" id="myonoffswitchRepo">
                                   
                                    <label class="onoffswitch-labelRepo" for="myonoffswitchRepo">
                                        <span class="onoffswitch-innerRepo"></span>
                                        <span class="onoffswitch-switchRepo"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <input id="perfil" type="hidden" class="form-control" name="perfil" vlaue="1" required>
                         

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
