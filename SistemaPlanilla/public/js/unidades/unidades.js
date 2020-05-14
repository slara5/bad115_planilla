(function(){
    $("tr td #delete").click(function (ev) {
        ev.preventDefault();
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




        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {


            
    
          
          }
        };
        xmlhttp.open("GET", "http://sispla.com.devel/unidades/delete/"+ident, true);
        xmlhttp.send();
      }
    })
    })
      
    
    
    }

    
    
    )();
    