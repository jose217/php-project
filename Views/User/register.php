<div class="container">
	<h2 class="mt-3">Registro de Usuario</h2>

	<!-- < ?php //echo date('Y-m-d H:i:s'); ?> -->
	  <form id="form" action='?controller=usuario&action=save' method='post'>
	  	
		<div class="form-group">
			<label class="mt-3" for="nombres">Nombres:</label>
		    <input type="text" class="form-control" id="nombres" name="nombres" required="true" placeholder="Ingrese sus nombres" autocomplete="off">
		</div>

		<div class="form-group">
			<label class="mt-3" for="apellidos">Apellidos:</label>
		    <input type="text" class="form-control" id="apellidos" name="apellidos" required="true" placeholder="Ingrese sus apellidos" autocomplete="off">
		</div>

		<label for="tipoVivienda" class="col-auto col-form-label">Tipo de Usuario:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Administrador" checked>
            <label class="form-check-label" for="inlineCheckbox1">Administrador</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Tecnico">
            <label class="form-check-label" for="inlineCheckbox1">Tecnico</label>
          </div>
        </div>
      
		<div class="form-group">
		    <label class="mt-3" for="email">Email:</label>
		    <input type="email" class="form-control" id="email" name="email" required="true" placeholder="Ingrese su email" autocomplete="off">
		</div>

		<div class="form-group">
			<label class="mt-3" for="pregunta">Pregunta</label>
		    <input type="text" class="form-control" id="pregunta" name="pregunta" required="true" placeholder="Ingrese una pregunta" autocomplete="off">
		</div>

		<div class="form-group">
			<label class="mt-3" for="respuesta">Respuesta:</label>
		    <input type="text" class="form-control" id="respuesta" name="respuesta" required="true" placeholder="Ingrese una respuesta" autocomplete="off">
		</div>

		<div class="form-group">
		    <label class="mt-3" for="pwd">Contraseña</label>
		    <input type="password" class="form-control" id="pwd" name="pwd" required="true" placeholder="Ingrese su contraseña">
		</div>
		<div class="form-group">
			<label class="mt-3" for="pwd2">Confirmar Contraseña</label>
			<input type="password" class="form-control" id="pwd2" name="pwd2" required="true" placeholder="Confirme su contraseña">
		</div>
		<div id="error" class="alert ocultar alert-danger mt-3" role="alert">Las contraseñas no coinciden, verifique si son correctas !!</div>
		<script>$(".ocultar").hide();</script>

		<!-- prd -->
		<!-- <div class="g-recaptcha mt-3" data-sitekey="6Lftf_caAAAAAA63ZpucM85TZ6ilfu5OOA2ZBsfU"></div> -->
		<!-- devlocal -->
		<!-- <div class="g-recaptcha mt-3" data-sitekey="6Le1qVEdAAAAAIfyXxddWFvKxRoiOsFz0cBeMJDp"></div> -->
		<!-- devonline -->
		<div class="d-flex justify-content-center">
		    <button type="submit" id="submit" name="guardar" class="btn btn-success mt-3 col-md-2"><i class="fas fa-save"></i> Guardar</button>
      </div>
	</form>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script>
$("#form").validate({rules:{pwd:{minlength:4,maxlength:25,},pwd2:{equalTo:"#pwd",minlength:4,maxlength:25}},
messages:{pwd:{minlength:"<div class='mt-3 alert alert-danger' role='alert'>La contraseña no puede ser menor de 4 caracteres</div>",maxlength:"<div class='alert alert-danger' role='alert'>La contraseña no puede ser mayor de 25 caracteres</div>" },
pwd2:{equalTo:"<div class='mt-3 alert alert-danger' role='danger'>La contraseña debe ser igual a la anterior",minlength:"<div class='mt-3 alert alert-danger' role='alert'>La contraseña no puede ser menor de 4 caracteres</div>", maxlength:"<div class='alert alert-danger' role='alert'>La contraseña no puede ser mayor de 25 caracteres</div>" }}});
</script>