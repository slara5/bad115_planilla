

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

  location.href="http://sispla.com.devel/unidades/view/";

  

}
else{
  location.href="http://sispla.com.devel/unidades/view/"+par;
    
  
}
}



</script>

 