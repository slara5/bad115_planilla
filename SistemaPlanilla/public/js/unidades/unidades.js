$(document).on("click","tr td #delete",function(){ 
  //codigo

  var ident=   $(this).parents('tr').find('th.idelemento').text();
  var nombre  =  $(this).parents('tr').find('td').text();
      Swal.fire({
      title: '¿Esta seguro de eliminar la unidad'+' '+nombre+'?',
      text: "Esta accion no se puede revertir",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {

        Swal.fire(
          'Eliminado',
          'Se ha eliminado unidad con exitos',
          'success'
        )




        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {


            document.getElementById("cambio").innerHTML = this.responseText;
    
          
          }
        };
        xmlhttp.open("GET", "../unidades/delete/"+ident, true);
        xmlhttp.send();
      }
    })
    });




function Alerta() {


 var par = document.getElementById("busqueda").value;
 
if (par === ""){



  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {


      document.getElementById("cambio").innerHTML = this.responseText;

    
    }
  };
  xmlhttp.open("GET", "../unidades/view/", true);
  xmlhttp.send();  

}
else{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {


      document.getElementById("cambio").innerHTML = this.responseText;

    
    }
  };
  xmlhttp.open("GET", "../unidades/view/"+par, true);
  xmlhttp.send();  
  
}
}

$(document).on("click","tr td #edit",function(){ 
  //codigo

  var ident=   $(this).parents('tr').find('th.idelemento').text();
  var nombre  =  $(this).parents('tr').find('td').text();

  $('#ID_UNIDAD').val(ident);
		$('#NOMBRE_UNIDAD').val(nombre);


  $("#unidadesModal").modal("show");

 


    });



$(document).on("click","#nuevo",function(ev){ 
  //codigo
  document.getElementById("formulario").reset(); 

$("#unidadesModal").modal("show");


        });

  
  
  
        $(document).on("submit","#formulario",function(ev){ 
          
          ev.preventDefault();
          //codigo
          $.ajax({
            url: "unidades/nuevo",
            type: "POST",
            data: $('#formulario').serialize(),
            success: function( response ) {
                console.log(response);
                Swal.fire(
                  'Agregado',
                  'Se ha agregado unidad con exitos',
                  'success'
                )
                $('#cambio').html(response);
                $("#unidadesModal").modal("hide");
      
                document.getElementById("formulario").reset(); 
                
            },
            error: function( response ) {
              console.log(response);
              
              
              
          }
      
        })  

        
                });
