$(document).on("click","tr td #delete",function(){ 
  //codigo

  var ruta = document.getElementById('ruta').value;
  var ident=   $(this).parents('tr').find('th.idelemento').text();
  var nombre  =  $(this).parents('tr').find('td.nombre').text();
      Swal.fire({
      title: '¿Esta seguro de eliminar el rol'+' '+nombre+'?',
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
          'Se elimino el rol exitosamente',
          'success'
        )




        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {


            document.getElementById("cambio").innerHTML = this.responseText;
    
          
          }
        };
        xmlhttp.open("GET", ruta+"/roles/eliminar/"+ident, true);
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
  xmlhttp.open("GET", "http://sispla.com.devel/roles/view/", true);
  xmlhttp.send();  

}
else{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {


      document.getElementById("cambio").innerHTML = this.responseText;

    
    }
  };
  xmlhttp.open("GET", "http://sispla.com.devel/roles/view/"+par, true);
  xmlhttp.send();  
  
}
}

$(document).on("click","tr td #edit",function(){ 
  //codigo

  var ident=   $(this).parents('tr').find('th.idelemento').text();
  var nombre  =  $(this).parents('tr').find('td').text();

  $('#ID_ROL').val(ident);
		$('#NOMBRE_ROL').val(nombre);


  $("#rolesModal").modal("show");

 


    });



$(document).on("click","#nuevo",function(ev){ 
  //codigo

$("#rolesModal").modal("show");

        });

  
  
        var ruta = document.getElementById('ruta').value;
        $(document).on("submit","#formulario",function(ev){ 
          
          ev.preventDefault();
          //codigo
          $.ajax({
            url: "roles/nuevo",
            type: "POST",
            data: $('#formulario').serialize(),
            success: function( response ) {
                console.log(response);
                Swal.fire(
                  'Agregado',
                  'Se agrego rol exitosamente',
                  'success'
                )
                $('#cambio').html(response);
                $("#rolesModal").modal("hide");
      
                document.getElementById("formulario").reset(); 
                
            },
            error: function( response ) {
              console.log(response);
              
              
              
          }
      
        })  

        
                });