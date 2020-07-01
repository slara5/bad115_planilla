$(document).on("click","tr td #delete",function(){ 
    //codigo
  
    var ident=   $(this).parents('tr').find('th.idelemento').text();
    var nombre  =  $(this).parents('tr').find('td.id_nombre_depto').text();
    console.log(ident);

        Swal.fire({
        title: '¿Esta seguro de eliminar el departamento '+' '+nombre+'?',
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
              console.log(this.responseText)
      
            
            }
          };
          xmlhttp.open("GET", "../Departamentos_empresa/delete/"+ident, true);
          xmlhttp.send();
        }
      })
      });


      $(document).on("click","#nuevo",function(ev){ 
        //codigo
        document.getElementById("formulario").reset(); 
      
      $("#unidadesModal").modal("show");

  
              });

function validador(input){

    patron = /^\d{3}$/;
    if(patron.test(input.value)&&input.value!=""){

        valido(input);
        $("#btn_submit").removeAttr('disabled');



    }else{
       invalido(input);
       $("#btn_submit").attr('disabled', 'disabled');
    }




}
function invalido(input) {
    $(input).removeClass("is-valid");
    $(input).addClass("is-invalid");
    $(input).next().css("display", "block");
}

function valido(input) {
  $(input).removeClass("is-invalid");
  $(input).addClass("is-valid");
  $(input).next().css("display", "none");
}







function Buscar() {


    var par = document.getElementById("busqueda").value;
    
   if (par === ""){
   
   
   
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../Departamentos_empresa/view/", true);
     xmlhttp.send();  
   
   }
   else{
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../Departamentos_empresa/view/"+par, true);
     xmlhttp.send();  
     
   }
   }




   $(document).on("submit","#formulario",function(ev){ 
         


    ev.preventDefault();
    //codigo
    $.ajax({
      url: "Departamentos_empresa/nuevo",
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

          
$(document).on("click","tr td #edit",function(){ 
  //codigo

  var ident=   $(this).parents('tr').find('th.idelemento').text();
  var nombre  =  $(this).parents('tr').find('td.id_nombre_depto').text();
  var ident2=   $(this).parents('tr').find('th.idelemento2').text();
  
  var centro=$(this).parents('tr').find('td.clase_centro_costo').text();


  console.log(ident2);

  $('#ID_DEPARTAMENTO_EMPRESA').val(ident);
    $('#NOMBRE_DEPARTAMENTO_EMPRESA').val(nombre);
    $('#ID_UNIDAD').val(ident2).change();
    
    $('#CODIGO_CENTRO_COSTO').val(centro);
    $("#btn_submit").removeAttr('disabled');
  $("#unidadesModal").modal("show");

 


    });

