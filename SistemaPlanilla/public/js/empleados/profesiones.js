function Alerta() {


    var par = document.getElementById("busqueda").value;
    
   if (par === ""){
   
   
   
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../Profesiones/view/", true);
     xmlhttp.send();  
   
   }
   else{
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../Profesiones/view/"+par, true);
     xmlhttp.send();  
     
   }
   }
   



   $(document).on("click","tr td #delete",function(){ 
    //codigo
  
    var ident=   $(this).parents('tr').find('th.idelemento').text();
    var nombre  =  $(this).parents('tr').find('td.id_nombre_profesion').text();
    console.log(nombre);
        Swal.fire({
        title: '¿Esta seguro de eliminar la profesion'+' '+nombre+'?',
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
            'Se ha eliminado la profesion con exitos',
            'success'
          )
  
  
  
  
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
  
  
              document.getElementById("cambio").innerHTML = this.responseText;
      
            
            }
          };
          xmlhttp.open("GET", "../profesiones/delete/"+ident, true);
          xmlhttp.send();
        }
      })
      });
  




      $(document).on("click","#nuevo",function(ev){ 
        //codigo
      
      $("#unidadesModal").modal("show");
      document.getElementById("formulario").reset(); 
  
              });
      
        
        
        
              $(document).on("submit","#formulario",function(ev){ 
                
                ev.preventDefault();
                //codigo
                $.ajax({
                  url: "profesiones/nuevo",
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
                      $("#btn_submit").attr('disabled', 'disabled');
            
                      $('#formulario').trigger("reset");
                 
                  },
                  error: function( response ) {
                    console.log(response);
                    
                    
                    
                }
            
              })  
      
              
                      });
      




                      $(document).on("click","tr td #edit",function(){ 
                        //codigo
                      var numero;
                        var ident=   $(this).parents('tr').find('th.idelemento').text();
                        var nombre  =  $(this).parents('tr').find('td.id_nombre_profesion').text();
                        
                        var centro=$(this).parents('tr').find('td.esoficio').text();
                        console.log(centro);
                          if(centro.trim() === "si"){

                                      numero="1"
                                              }
                                          else{

                                           numero="0"

                                          }


                      
                      console.log(numero);

                        $('#ID_PROFESION_OFICIO').val(ident);
                          $('#NOMBRE_PROFESION').val(nombre);
                          $('#ES_OFICIO').val(numero).change();

                        $("#unidadesModal").modal("show");
                      
                       
                      
                      
                          });