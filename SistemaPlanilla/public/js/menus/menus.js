$(document).on("click","tr td #edit",function(){ 
  //codigo

	var ident=   $(this).parents('tr').find('form.idelemento').text();
	var nombre  =  $(this).parents('tr').find('td.nombre').text();
	var idpadre  =  $(this).parents('tr').find('td.idpadre').text();

  	$('#ID_MENU').val(ident);
	$('#NOMBRE_MENU').val(nombre);
	//if(idpadre == "NINGUNO")
	document.getElementById("show-child").checked = true;
	$('.form-wrapper').show();
	$('#ID_MENU_PADRE').val(idpadre);

  	$("#menusModal").modal("show");

 });