<label for="busqueda">Buscar unidad</label>
<div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="busqueda">
        <div class="input-group-append">
          <button class="btn btn-navbar" onclick="Alerta()">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>

<div id="cambio">
<?php

echo view('empresa/unidades/busqueda');


?>
</div>
<script>

function Alerta() {
 var par = document.getElementById("busqueda").value;
if (par === ""){

  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("cambio").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "http://sispla.com.devel/unidades/view/", true);
    xmlhttp.send();


}
else{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("cambio").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "http://sispla.com.devel/unidades/view/"+par, true);
    xmlhttp.send();
  
}
}


function borrar(e) {
Swal.fire({
  title: '¿Esta seguro de eliminar la unidad ?',
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
        document.getElementById("cambio").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "http://sispla.com.devel/unidades/delete/"+e, true);
    xmlhttp.send();
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

  

}



</script>
