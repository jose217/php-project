<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
	<div class="alert alert-success">
		<strong><?php echo $_SESSION['mensaje']; ?></strong>
	</div>
<?php } 
	unset($_SESSION['mensaje']);
?>	
<div class="container ">
	<h2 class="mt-5 mb-3 card-tittle">Ingresar</h2>
		<form  action="?controller=usuario&action=login" method="post">
			<div class="mb-3 mt-5">
				<label for="exampleInputEmail1" class="form-label">Email:</label>			
				<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required="true" autocomplete="off" aria-describedby="emailHelp">
			</div>
			<div class="mb-3">
				<label for="pwd" class="form-label"> Contraseña:</label>
				<input type="password"  class="form-control" id="pwd" name="pwd" placeholder="Ingrese su contraseña" required="true">
			</div>
			<div class="d-flex justify-content-center mt-5">
				<button type="submit" class="btn btn-success"><span class="p-1"><i class="fas fa-sign-in-alt"></i></i></span>Ingresar</button>
			</div>
		</form>
	<div>
		<form action="" method="post">
			<div class="mt-3">
				<a href="?controller=usuario&action=recovery" class="d-flex justify-content-center  text-decoration-none">Restablecer contraseña</a>	
			</div>
		</form>
	</div>
</div>