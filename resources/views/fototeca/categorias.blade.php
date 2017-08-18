<style type="text/css">
	.well{
		padding: 0px !important;
		background: #fff !important;
		border: 0px !important;
	}
    
    .well .ahref{
        float: right !important;
        padding-right: 0px;
    }
    .ahref .glyphicon-edit{
        padding-right: 0px;   
    }

    .well .nav > li {
        padding-top: 18px;
    }

    .well .nav > li > a{
        padding: 0px 4px !important;
    }
    
    .busquedaSwitchCategoria{position:relative;width:190px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.busquedaSwitchCategoria-checkbox{display:none}.busquedaSwitchCategoria-label{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.busquedaSwitchCategoria-inner{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.busquedaSwitchCategoria-inner:before,.busquedaSwitchCategoria-inner:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.busquedaSwitchCategoria-inner:before{content:"Búsqueda Simple";padding-left:10px;background-color:#666;color:#FFF}.busquedaSwitchCategoria-inner:after{content:"Búsqueda Avanzada";padding-right:10px;background-color:#666;color:#FFF;text-align:right}.busquedaSwitchCategoria-switch{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.busquedaSwitchCategoria-checkbox:checked + .busquedaSwitchCategoria-label .busquedaSwitchCategoria-inner{margin-left:0}.busquedaSwitchCategoria-checkbox:checked + .busquedaSwitchCategoria-label .busquedaSwitchCategoria-switch{right:0}

    .busquedaswitchBN{position:relative;width:90px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.busquedaswitchBN-checkboxBN{display:none}.busquedaswitchBN-labelBN{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.busquedaswitchBN-innerBN{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.busquedaswitchBN-innerBN:before,.busquedaswitchBN-innerBN:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.busquedaswitchBN-innerBN:before{content:"Color";padding-left:10px;background-color:#34C258;color:#FFF}.busquedaswitchBN-innerBN:after{content:"B/N";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.busquedaswitchBN-switchBN{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.busquedaswitchBN-checkboxBN:checked + .busquedaswitchBN-labelBN .busquedaswitchBN-innerBN{margin-left:0}.busquedaswitchBN-checkboxBN:checked + .busquedaswitchBN-labelBN .busquedaswitchBN-switchBN{right:0}


    .onoffswitchVH{position:relative;width:110px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none}.onoffswitch-checkboxVH{display:none}.onoffswitch-labelVH{display:block;overflow:hidden;cursor:pointer;border:2px solid #FFF;border-radius:27px}.onoffswitch-innerVH{display:block;width:200%;margin-left:-100%;transition:margin .3s ease-in 0}.onoffswitch-innerVH:before,.onoffswitch-innerVH:after{display:block;float:left;width:50%;height:34px;padding:0;line-height:34px;font-size:14px;color:#fff;font-family:Trebuchet,Arial,sans-serif;font-weight:700;box-sizing:border-box}.onoffswitch-innerVH:before{content:"Horizontal";padding-left:10px;background-color:#34C258;color:#FFF}.onoffswitch-innerVH:after{content:"Vertical";padding-right:10px;background-color:#D42F2F;color:#FFF;text-align:right}.onoffswitch-switchVH{display:block;width:14px;margin:10px;background:#FFF;position:absolute;top:0;bottom:0;border:2px solid #FFF;border-radius:27px;transition:all .3s ease-in 0}.onoffswitch-checkboxVH:checked + .onoffswitch-labelVH .onoffswitch-innerVH{margin-left:0}.onoffswitch-checkboxVH:checked + .onoffswitch-labelVH .onoffswitch-switchVH{right:0}
    
    #busquedaAvanzada {
        display: none;
        margin-top: 10px;
    }
    .busquedaAvanzadaInput{
        margin-top: 10px;
        width: 100%;
    }
</style>
<h3> Categorias </h3>

<hr>
    <div style="margin-bottom: 15px;">
        <div class="busquedaSwitchCategoria">
            <input type="checkbox" name="cob_n" class="busquedaSwitchCategoria-checkbox" id="myonoffswitch" checked value="1" onClick="$('#busquedaAvanzada').toggle();">
            <label class="busquedaSwitchCategoria-label" for="myonoffswitch">
                <span class="busquedaSwitchCategoria-inner"></span>
                <span class="busquedaSwitchCategoria-switch"></span>
            </label>
        </div>        
    </div>
    <div class="input-group">
        {!! Form::text('buscar',null,['class'=>'form-control', 'placeholder'=>'Por Titulo', 'id' => "buscar"]) !!}
        <div class="input-group-btn">    
            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>

    <div id="busquedaAvanzada">

        <select id="tag" name="BTag[]" class="busquedaAvanzadaInput" multiple style="width: 100%;"></select>
        
        {!! Form::text('BDescripcion',null,['class'=>'form-control busquedaAvanzadaInput', 'placeholder'=>'Por Descripción', 'id' => 'BDescripcion']) !!}

        
        <div class="input-group busquedaAvanzadaInput">
            <input type="text" class="form-control" id="datepickerBusqueda" name="BFecha" placeholder='Por Fecha'>
            <div class='text-danger'>{{$errors->first('fecha')}}</div>
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
       

        <div class="form-group col-sm-6">            
            <div class="busquedaswitchBN busquedaAvanzadaInput">
                <input type="checkbox" name="BBlancoNegro" class="busquedaswitchBN-checkboxBN" id="myonoffswitchBN" checked value="1">
                <label class="busquedaswitchBN-labelBN" for="myonoffswitchBN">
                    <span class="busquedaswitchBN-innerBN"></span>
                    <span class="busquedaswitchBN-switchBN"></span>
                </label>
            </div>                      
        </div>

        <div class="form-group col-sm-6">            
            <div class="onoffswitchVH busquedaAvanzadaInput">
                <input type="checkbox" name="BVerticalHorizontal" class="onoffswitch-checkboxVH" id="myonoffswitchVH" checked value="1">
                <label class="onoffswitch-labelVH" for="myonoffswitchVH">
                    <span class="onoffswitch-innerVH"></span>
                    <span class="onoffswitch-switchVH"></span>
                </label>
            </div>                      
        </div>
    </div>
<br>
    <button onclick="busquedas()" class='btn btn-warning' style="width: 100%">Buscar</button>

<hr>


<div class="well list-group">

        <ul class="nav nav-list ">
      	
      	
        @foreach ($categorias as $c) 
        	<li class="list-group-item ">
                
                <label class="tree-toggle nav-header" {{(count($c['children'])>0)?'style=cursor:pointer' :''}}>                    

                    @if(count($c['children']) > 0)
                        <span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;
                    @endif
                    {{ $c['item']->categoria }}
                     
                </label>                



                <a href="{{url('galeria/'.$c['item']->id)}}" class="ahref" title="Ver Galeria de Imagenes">
                    <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>


                <a href="{{url('newImage',['categoriaID'=>$c['item']->id])}}" class="ahref" title="Subir Imagen">
                    <span class="glyphicon glyphicon-picture"></span>
                </a>
            	
                @if(count($c['children'])>0)
                		<ul class="nav nav-list tree">
                	@foreach ($c['children'] as $cc)
                        	<li style="padding-left: 8px;">
                        		<label class="tree-toggle nav-header" {{(count($cc['children'])>0)?'style=cursor:pointer':''}}>
                        			@if(count($cc['children']) > 0)
                                        <span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;
                                    @endif
                                    {{ $cc['item']->categoria }}
                        		</label>
                                

                                <a href="{{url('galeria/'.$cc['item']->id)}}" class="ahref" title="Ver Galeria de Imagenes">
                                    <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                </a>

                                <a href="{{url('newImage',['categoriaID'=>$cc['item']->id])}}" class="ahref" title="Subir Imagen">
                                    <span class="glyphicon glyphicon-picture"></span>
                                </a>

                                @if(count($cc['children'])>0)
                            		<ul class="nav nav-list tree">
        	            				@foreach ($cc['children'] as $ccc)
        	            					<li style="padding-left: 15px;">
                                                <label class="tree-toggle nav-header" {{(count($ccc['children'])>0)?'style=cursor:pointer':''}}>
                                                    @if(count($ccc['children']) > 0)
                                                        <span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;
                                                    @endif
                                                    {{ $ccc['item']->categoria }}
                                                </label>


                                                <a href="{{url('galeria/'.$ccc['item']->id)}}" class="ahref" title="Ver Galeria de Imagenes">
                                                    <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                                </a>

                                                <a href="{{url('newImage',['categoriaID'=>$ccc['item']->id])}}" class="ahref" title="Subir Imagen">
                                                    <span class="glyphicon glyphicon-picture"></span>
                                                </a> 

                                                @if(count($ccc['children'])>0)
                                                    <ul class="nav nav-list tree">
                                                        @foreach ($ccc['children'] as $cccc)
                                                            <li style="padding-left: 15px;">
                                                                <label class="tree-toggle nav-header" {{(count($cccc['children'])>0)?'style=cursor:pointer':''}}>
                                                                    @if(count($cccc['children']) > 0)
                                                                        <span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp;
                                                                    @endif
                                                                    {{ $cccc['item']->categoria }}
                                                                </label>


                                                                <a href="{{url('galeria/'.$cccc['item']->id)}}" class="ahref" title="Ver Galeria de Imagenes">
                                                                    <span class="glyphicon glyphicon-circle-arrow-right"></span>
                                                                </a>

                                                                <a href="{{url('newImage',['categoriaID'=>$cccc['item']->id])}}" class="ahref" title="Subir Imagen">
                                                                    <span class="glyphicon glyphicon-picture"></span>
                                                                </a> 

                                                                
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
        	            				@endforeach
                    				</ul>
                                @endif
                        	</li>
                	@endforeach
                	</ul>
                @endif
            </li> 
		@endforeach
		</ul>
</div>