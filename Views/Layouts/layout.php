<?php
ob_start();
?>
<?php if (!isset($_SESSION)) {
	session_start();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>

	<title>UTEC-PROJECT</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Librerias Boostrap-->
	<link rel="stylesheet" href="assets/bootstrap-5.3.3/css/bootstrap.css">
	<link rel="stylesheet" href="assets/bootstrap-5.3.3/css/mycss.css">

	<script src="assets/bootstrap-5.3.3/js/bootstrap.js"></script>
	<script src="assets/bootstrap-5.3.3/js/bootstrap.min.js"></script>
	<script src="assets/bootstrap-5.3.3/js/jquery-3.7.1.min.js" ></script>
	<script src="assets/bootstrap-5.3.3/js/bootstrap.bundle.min.js" ></script>

	<!-- graficos de google  -->
	<!-- loader -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php //error_reporting(0); ?>

</head>

<body>
	<header>
		<?php
		if (isset($_SESSION['usuario'])) {
			require_once ('cabecera.php');
		}
		?>
	</header>

	<section>

		<div class="" name="cuerpo">
			<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
				<div class="alert alert-success mt-3">
					<strong><?php echo $_SESSION['mensaje']; ?></strong>
				</div>
			<?php }
			unset($_SESSION['mensaje']);
			?>
			<?php require_once ('routing.php'); ?>
		</div>
	</section>

	<footer>
		<?php
		if (isset($_SESSION['usuario'])) {
			include_once ('footer.php');
		}
		?>
	</footer>
</body>

</html>
<?php
ob_end_flush();
?>