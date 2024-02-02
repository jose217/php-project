<?php
ob_start();
?>
<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>
<!DOCTYPE html>
<html lang="es">
<head>

	<title>UTEC-PROJECT</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Librerias Boostrap-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/MBD5/css/mdb.min.css">
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/> -->
	<!-- jQuery library -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/ResponsiveMv.js"></script>
	<script src="asstes/MBD5/js/mdb.es.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/disableautofill/src/jquery.disableAutoFill.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> -->
	<!-- Latest compiled JavaScript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<!-- icons -->
	<script src="https://kit.fontawesome.com/73d7355b1c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Custom -->
	<script src="assets/custom/nick-test.js?1.1.0"></script>
	
	<script src="assets/charts/vendor/chart/Chart.min.js"></script>

	<!-- datepicker -->
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js" ></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css"  />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.min.js" ></script>
	<link rel="stylesheet" href="css/seac.css"  />

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
	
	<?php error_reporting(0); ?>

</head>
<body>
<header>
<?php
	if(!isset($_SESSION)){
		require_once('cabecera.php');
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
		<?php require_once('routing.php'); ?>
	</div>
</section>

<footer>
<?php
	if(!isset($_SESSION)){
		include_once('footer.php');
	}
?>
</footer>
</body>
</html>
<?php
ob_end_flush();
?>
