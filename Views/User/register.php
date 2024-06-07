<div class="container mt-3" style="width:50rem;">

	<div class="">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title mb-4">Registrar Nueva Cuenta</h5>
				<form action="?controller=usuario&action=save" method="POST">
					<!-- 2 column grid layout with text inputs for the first and last names -->
					<div class="row mb-4">
						<div class="col">
							<div data-mdb-input-init class="form-outline">
								<input type="text" id="nombre" name="nombre" class="form-control" />
								<label class="form-label" for="nombre">Nombre</label>
							</div>
						</div>
						<div class="col">
							<div data-mdb-input-init class="form-outline">
								<input type="text" id="apellido" name="apellido" class="form-control" />
								<label class="form-label" for="apellido">Apellido</label>
							</div>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<div data-mdb-input-init class="form-outline">
								<input type="text" id="usuario" name="usuario" class="form-control" required />
								<label class="form-label" for="usuario">Usuario</label>
							</div>
						</div>
						<div class="col">
							<div data-mdb-input-init class="form-outline">
								<input type="text" id="tipoUsuario" name="tipoUsuario" class="form-control"
									value="Default" readonly />
								<label class="form-label" for="tipoUsuario">Tipo de Usuario</label>
							</div>
						</div>
					</div>

					<!-- Email input -->
					<div data-mdb-input-init class="form-outline mb-4">
						<input type="email" id="email" name="email" class="form-control" required />
						<label class="form-label" for="email">Correo</label>
					</div>

					<!-- Password input -->
					<div data-mdb-input-init class="form-outline mb-4">
						<input type="password" id="pwd" name="pwd" class="form-control" required />
						<label class="form-label" for="pwd">Contraseña</label>
					</div>

					<div data-mdb-input-init class="form-outline mb-4">
						<input type="password" id="pwd2" class="form-control" />
						<label class="form-label" for="pwd2">Repetir contraseña</label>
					</div>
					<div id="error-message" style="color: red; display: none;">Las contraseñas no coinciden.</div>

					<!-- Checkbox -->
					<div class="form-check d-flex justify-content-center mb-4">
						<input class="form-check-input me-2" type="checkbox" name="aceptaTerminos"
							id="aceptaTerminos" required />
						<label class="form-check-label" for="aceptaTerminos">Aceptar Terminos</label>
					</div>

					<!-- Submit button -->
					<button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Crear
						Cuenta</button>

				</form>
				<button type="button" class="btn btn-primary" data-mdb-ripple-init
					onclick="location.href='?controller=usuario&action=showLogin'">Regresar</button>
			</div>
		</div>

	</div>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

<script>
	document.getElementById('pwd2').addEventListener('keyup', function () {
		var pwd = document.getElementById('pwd').value;
		var pwd2 = document.getElementById('pwd2').value;
		var errorMessage = document.getElementById('error-message');

		if (pwd !== pwd2) {
			errorMessage.style.display = 'block';
		} else {
			errorMessage.style.display = 'none';
		}
	});
</script>