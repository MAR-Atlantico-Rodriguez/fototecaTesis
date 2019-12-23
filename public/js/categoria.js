function guardarCategoria(){
	
	if($("#check").is(':checked')){
		variables = {'categoria':$("#categoria").val(), 
					 'categoriaPadre':$("#categoriaPadre").val(),
					 'id':$("#id").val()};
	}else{
		variables = {'categoria':$("#categoria").val(),
					 'id':$("#id").val()};
	}

	$.ajax({
          url: 'newCategoria',
          type: "get",
          data: variables,
           success: function(response){ // What to do if we succeed
               	if(response == 1){
               		location.reload();
               	}else{
               		alert('Se produjo un error!');
               	}
            },
            error: function(response){
                console.log('Error'+response);
                }
            });  
}


function busquedas(){
	var _token =  $("input[name='_token']").val();
  var atributos = {'_token': _token,
                   'buscar': $("#buscar").val(),
                   'cob_n': !$("#myonoffswitch").is(':checked'),
                   'BTag': $("#tag").val(),
                   'BDescripcion': $("#BDescripcion").val(),
                   'BFecha': $("#BFecha").val(),
                   'BBlancoNegro': $('#myonoffswitchBN').is(':checked'),
                   'BVerticalHorizontal': !$('#myonoffswitchVH').is(':checked'),
                   'BFecha': $('#datepickerBusqueda').val()
                 };
	
	$.ajax({
      url: 'http://localhost/Laravel/fototeca/search',
      type: "post",
      data: atributos,
       success: function(data){ // What to do if we succeed
           	$("#inicio").html(data);
        },
        error: function(response){
            console.log('Error'+response);
            }
        }); 
	
}

function verGaleria(id){
  $.ajax({
      url: 'http://localhost/Laravel/fototeca/galeria/'+id,
      type: "get",
      data: '',
       success: function(data){ // What to do if we succeed
            $("#inicio").html(data);
        },
        error: function(response){
            console.log('Error'+response);
            }
        }); 
}
