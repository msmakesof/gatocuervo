<?php
include_once 'config/db.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link  rel="icon"   href="images/favicon.png" type="image/png" />
	<title>Gato Cuervo | Cierre</title>	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">	
	<link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="./dist/css/adminlte.min.css">
	<!-- jQuery -->
	<script src="./plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="./plugins/redirect/jquery.redirect.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	 <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<div class="modal fade" id="modal-warning">
								<div class="modal-dialog">
								  <div class="modal-content bg-warning">
									<div class="modal-header">
										<h4 class="modal-title">! Atención:</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Ha dejado sesiones abiertas, razón por la cual Todas las sesiones abiertas serán Cerradas.</p>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-outline-dark" data-dismiss="modal" id="cerrar">Cerrar</button>									  
									</div>
								  </div>
								  <!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</body>
</html>	
<?php
$tipocierre = 1;
if(isset($_GET['tipocierre']) && $_GET['tipocierre'] == 2)
{
	$tipocierre = $_GET['tipocierre'];	
}

if(isset($_SESSION['id']) && $_SESSION['id'] != "")
{
	$idusuario = $_SESSION['id'] ;

	// 1. Actualizar Registro
	$param = "idusuario=".$idusuario."&tipocierre=".$tipocierre ;
	$url = $urlServicios."api/accesousuario/update.php?$param";				
	include 'curl/curl.inc.php';	

	$mestado = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$data = json_decode($mestado, true);

	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);

	session_destroy();
}

if($tipocierre == 2)
{
	echo "<script>
	$( document ).ready(function() {
		$('#modal-warning').modal('toggle')
		
		$('#cerrar').on('click', function(){
			//$.redirect('indexcpanel.html')
			$.redirect('login.html')
		})
	});
	</script>";
}	
else
{
	//header("Location: indexcpanel.html");  //index.html
	//header("Location: login.php"); // Original
	header("Location: login.html");
	exit();
}	
?>