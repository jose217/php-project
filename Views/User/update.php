<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>


<div class="container">
	<h2 class="mt-2">Actualizar Cuenta</h2>

	<form action='?controller=usuario&action=update' method='post' enctype="multipart/form-data">
		<input type='hidden' name='id' value='<?php echo $usuario->getId(); ?>'>
						
		<div class="form-group">
	    	<label for="nombres">Nombres:</label>
	     	<input type="text" class="form-control" id="nombres" name="nombres" required="true"  value="<?php echo $usuario->getNombres(); ?>">
		</div>

		<div class="form-group">
		    <label for="apellidos">Apellidos:</label>
		    <input type="text" class="form-control" id="apellidos" name="apellidos" required="true" value='<?php echo utf8_decode($usuario->getApellidos()); ?>' autocomplete="off">
		</div>

		<div class="form-group">
		    <label for="email">Email:</label>
		    <input type="email" class="form-control" id="email" name="email" required="true" readonly="false" value='<?php echo $usuario->getEmail(); ?>'>
		</div>
		<label for="tipoVivienda" class="col-auto col-form-label">Tipo de Usuario:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Administrador" <?php echo is_checked($usuario->getAlias(), "Administrador") ?>> 
            <label class="form-check-label" for="inlineCheckbox1">Administrador</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Tecnico" <?php echo is_checked($usuario->getAlias(), "Tecnico") ?>>
            <label class="form-check-label" for="inlineCheckbox1">Tecnico</label>
          </div>
        </div>


		<div class="form-group">
		    <label for="pwd">Contraseña:</label>
		    <input type="password" class="form-control" id="pwd" name="pwd" value='' autocomplete="off">
		</div>

		 <div class="mt-3 d-flex justify-content-around">
		 	    <button type="submit" class="btn btn-success col-md-2"> <i class="fas fa-save"></i>  Guardar</button>
		 	    <button type="button" class="btn btn-danger col-md-2" onclick="location.href='?controller=usuario&action=showUsuarios'"><i class="fas fa-window-close"></i>Cancelar</button>
		 </div>
	</form>


</div>
<script>
//FUNCION PARA COMPARAR EL TIPO DE USUARIO Y CHECKAR EL RADIOBUTTON
<?php function is_checked($valor1, $valor2){
  					if($valor1 == $valor2){
    					return "checked";
  						}
  			else{
    		return "";
  			}
			}?>
			
</script>