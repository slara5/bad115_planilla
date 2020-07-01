function Buscar() {


    var par = document.getElementById("busqueda").value;
    
   if (par === ""){
   
   
   
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../subsecciones/view/", true);
     xmlhttp.send();  
   
   }
   else{
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../subsecciones/view/"+par, true);
     xmlhttp.send();  
     
   }
   }
   $(document).on("click","#nuevo",function(ev){ 
    //codigo
  
  $("#unidadesModal").modal("show");
  document.getElementById("formulario").reset(); 
  
          });


          $(document).on("submit","#formulario",function(ev){ 
         


            ev.preventDefault();
            //codigo
            $.ajax({
              url: "subsecciones/nuevo",
              type: "POST",
              data: $('#formulario').serialize(),
              success: function( response ) {
                  console.log(response);
                  Swal.fire(
                    'Agregado',
                    'Se ha agregado nueva subseccion con exito',
                    'success'
                  )
                  $('#cambio').html(response);
                  $("#unidadesModal").modal("hide");
        
//                      document.getElementById("formulario").reset(); 
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
                  
                    var ident=   $(this).parents('tr').find('th.idelemento').text();
                    var nombre  =  $(this).parents('tr').find('td.id_nombre_depto').text();
                    var ident2=   $(this).parents('tr').find('th.idelemento2').text();
                    
                   
                  
                    console.log(ident2);
                  
                    $('#ID_SUB_SECCION').val(ident);
                      $('#NOMBRE_SUB_SECCION').val(nombre);
                      $('#ID_SECCION').val(ident2).change();
                      
                      
                      $("#btn_submit").removeAttr('disabled');
                    $("#unidadesModal").modal("show");
                  
                   
                  
                  
                      });


                      $(document).on("click","tr td #delete",function(){ 
                        //codigo
                      
                        var ident=   $(this).parents('tr').find('th.idelemento').text();
                        var nombre  =  $(this).parents('tr').find('td.id_nombre_depto').text();
                        console.log(ident);
                    
                            Swal.fire({
                            title: '¿Esta seguro de eliminar la subseccion '+' '+nombre+'?',
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
                                'Se ha eliminado el area con exito',
                                'success'
                              )  
                      
                              var xmlhttp = new XMLHttpRequest();
                              xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                      
                      
                                  document.getElementById("cambio").innerHTML = this.responseText;
                                  console.log(this.responseText)
                          
                                
                                }
                              };
                              xmlhttp.open("GET", "../subsecciones/delete/"+ident, true);
                              xmlhttp.send();
                            }
                          })
                          });