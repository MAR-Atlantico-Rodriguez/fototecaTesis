<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','default') - {{ config('app.name', '') }}</title>
   
    <link href="{{ asset('public/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/jquery-ui.css') }}">
    <link href="{{ asset('public/css/select2.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::guest())                         
                            
                            @if (Auth::user()->perfil)
                                <li>
                                    <a href="{{url('/')}}">Inicio</a>
                                </li>
                                <li>
                                    <a href="{{url('tags/lista')}}">Tags</a>
                                </li>
                                <li>
                                    <a href="{{url('categorias/lista/0')}}">Categorias</a>
                                </li>
                                <li>
                                    <a href="{{url('estadistica')}}">Estadisticas</a>
                                </li>
                                <li  class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li ><a href="{{ url('listaUser') }}">Lista de Usuarios</a></li>
                                        <li ><a href="{{ route('register') }}">Registrar Usuarios</a></li>
                                    </ul>
                                </li>
                            @endif

                             

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('modificarClave') }}">Modificar Clave</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li> 
                        @endif

                        
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts 
    <script src="{{ asset('js/jQuery3.1.1.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/Select2_4.0.3.min.js') }}"></script>-->

    <script src="{{ asset('public/js/jQueryv2.1.4.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/select2.js') }}"></script>

    <script src="{{ asset('public/js/jcrop/jquery.Jcrop.js') }}"></script>
    <script src="{{ asset('public/js/misJs.js') }}"></script>
    




    <!-- CATEGORIAS! -->
    <script type="text/javascript">
        $('#tags').select2({
            placeholder: "Seleccione los Tags para la imagen",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("tags/busqueda")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#tagsEdit').select2({
            placeholder: "Seleccione los Tags para la imagen",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("tags/busqueda")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term),
                        id: $("#id_imagen").val()
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#tag').select2({
            placeholder: "Por Tags",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("tags/busqueda")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });


        $('.tree-toggle').click(function () {
            $(this).parent().children('ul.tree').toggle(300);
        });
        $(function(){
            $('.tree-toggle').parent().children('ul.tree').toggle(300);
        })
    </script>

    <script src="{{asset('public/js/jQuery_ui.js')}}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                closeText: 'Cerrar',   
                prevText: 'Previo', 
                nextText: 'Próximo',  
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
  'Jul','Ago','Sep','Oct','Nov','Dic'],
                monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
                dateFormat: 'yy-mm-dd', firstDay: 0, 
                initStatus: 'Selecciona la fecha', isRTL: false});


            $( "#datepickerBusqueda" ).datepicker({
                closeText: 'Cerrar',   
                prevText: 'Previo', 
                nextText: 'Próximo',  
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
  'Jul','Ago','Sep','Oct','Nov','Dic'],
                monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
                dateFormat: 'yy-mm-dd', firstDay: 0, 
                initStatus: 'Selecciona la fecha', isRTL: false});
    
        });        
    </script>


<!-- JCROP FUNCIONES PARA RECORTAR-->
    <script type="text/javascript">
      $(function(){
        $('#cropbox').Jcrop({     
          onSelect: updateCoords
        });
      });

      function updateCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
      };

      function checkCoords(){
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
      };
    </script>


    <script src="{{ asset('public/js/categoria.js') }}"></script>
</body>
</html>
