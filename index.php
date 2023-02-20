<?php
include_once("pages/sesion.inc.php");
include_once './config/db.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
$titulo = "Tablero de Control" ;

/*
echo '<br/><br/><br/>';
echo '<br/>';
echo 'TimeZonePHP default: ', date_default_timezone_get();
echo '<br/>';
echo '<br/>';


echo '<br/>';
echo '<br/>';

//echo 'Fecha/hora actual: ', date('Y-m-d h:i:s', time());

echo '<br/>';
echo '<br/>';
*/
date_default_timezone_set('America/Bogota'); //configuro un nuevo timezone
setlocale(LC_TIME, 'es_CO.UTF-8');
//echo 'TimeZonePHP configurado: ', date_default_timezone_get();
//date_default_timezone_set('America/Argentina/Buenos_Aires'); //configuro un nuevo timezone

$fecha = new DateTime();
//echo $fecha->format('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link  rel="icon"   href="images/favicon.png" type="image/png" />
  <title>..:: <?php echo $_SESSION['company']; ?> | Admin ::..</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="index.php" class="nav-link">Inicio</a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="close.php" id="salir" class="nav-link">Salir</a>
			</li>
		</ul>

		<!-- SEARCH FORM -->
		<form class="form-inline ml-3">
			<div class="input-group input-group-sm">
				<input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
						<i class="fas fa-search"></i>
				  </button>
				</div>
			</div>
		</form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">9</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">5 Notificationes</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 3 Arriendos con Vencimientos
            <span class="float-right text-muted text-sm">12 horas</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 2 nuevos reportes
            <span class="float-right text-muted text-sm">2 días</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todas las Notificationes</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="images/logoGCO-mini.png" alt="GatoCuero Logo" width="128px" height="128px" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $_SESSION['company']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">
					<span style="font-size:13px !important;"><?php echo trim($_SESSION['nombreusuario']); ?></span>
				</a>
			</div>						
		</div>
		<div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">			
			<span style="font-size:13px !important; color: #D2CFCF;"><?php echo trim($_SESSION['email']); ?></span>			
		</div>
		<!-- Sidebar Menu -->
		<?php 
			$rutamenu = "";
			$submenu = "";
			$rutafile = basename(__DIR__);
			if(strtolower($rutafile) != "tables" )
			{
				$rutamenu = "pages/tables/";
			}
			$menu ="Administración";
			$file = __FILE__ ; 
			//include $urlServicios."menu/menu.php";
			include("menu/menu.php"); 
		?>
		<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark" style="text-shadow: #bbb 4px 4px 4px;"><?php echo $titulo; ?></h1>           
          </div><!-- /.col -->
          <div class="col-sm-4">
            <?php echo 'Fecha actual: ', $fecha->format('Y-m-d') ; //echo "<br>"; echo 'TimeZonePHP configurado: ', date_default_timezone_get(); 
            //echo "<br>"; //echo 'Fecha/hora actual 2: ', date('Y-m-d h:i:s', time());
            ?>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item"><a href="close.php">Salir</a></li>
              <li class="breadcrumb-item active"><?php echo $titulo; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="border-color:#FF5A5A;border-width: 1px; border-style: solid;">
              <div class="card-header" style="background-color:#FF5A5A">
                <h5 class="card-title" style="font-weight:bold; color:#fff; text-shadow: #000 4px 4px 4px;font-family: Verdana">Información del Mes Anterior.</h5>
              </div> 

              <!-- ./card-body -->
             <div class="card-tools" style="background-color:#f8f9fa">
                <br>
                <!-- Info boxes -->
                  <div class="row" style="margin-left:3px; margin-right:3px;">
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-music"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Música</span>
                          <span class="info-box-number">
                            <?php // include 'pages/panel/panel.php'; ?>
                            <small>%</small>
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-magic"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Emprendimiento</span>
                          <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-comments" aria-hidden="true"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Eventos</span>
                          <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-credit-card"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Recaudos del Mes</span>
                          <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" style="border-color:#4ED757;border-width: 1px; border-style: solid;">
              <div class="card-header" style="background-color:#4ED757">
                <h5 class="card-title" style="font-weight:bold; color:#fff; text-shadow: #000 4px 4px 4px;font-family: Verdana">Información para el Mes Actual.</h5>
				
                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
              </div>
              <!-- /.card-header -->
             
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">MÚSICA</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">EMPRENDIMIENTO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">EVENTOS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">RECAUDOS DEL MES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->

          <div class="col-md-12">
            <div class="card" style="border-color:#499EF4;border-width: 1px; border-style: solid;">
              <div class="card-header" style="background-color:#499EF4">
                <h5 class="card-title" style="font-weight:bold; color:#fff; text-shadow: #000 4px 4px 4px;font-family: Verdana">Información para el Próximo Mes.</h5>

                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
              </div>            
              <!-- /.card-header -->

              <div class="card-tools" style="background-color:#f8f9fa">
                <br>
                <div class="row" style="margin-left:3px; margin-right:3px;">
                  
                  <!-- /.col -->
                  <div class="col-md-3">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                      <span class="info-box-icon"><i class="fa fa-headphones" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Música</span>
                        <span class="info-box-number">5,200</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>

                  <div class="col-md-3">  
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                      <span class="info-box-icon"><i class="fa fa-cubes" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Emprendimiento</span>
                        <span class="info-box-number">92,050</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                      <span class="info-box-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Eventos</span>
                        <span class="info-box-number">114,381</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </div>
              
                  <div class="col-md-3">  
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                      <span class="info-box-icon"><i class="fa fa-inbox" aria-hidden="true"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Recaudo del Mes</span>
                        <span class="info-box-number">163,921</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

        <div class="row">  
        <div class="col-md-6">
            <!-- Inmuebles -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight:bold; color:#001; text-shadow: #bbb 4px 4px 4px;">Votaciones</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
				
				<?php /*
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/propiedad/read.php";
    //echo $url;
	$resultado = "";
	require('curl/curl.inc.php');	
	$mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
	$data = json_decode($mestado, true);
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);	
	
	foreach($data as $key => $row) {}
	
	if( $key == "message")
	{
		echo $data["message"];
	}
	else
	{
		if( $data["itemCount"] > 0)
		{		
			for($i=0; $i<count($data['body']); $i++)
			{
				$id = $data['body'][$i]['INM_IdInmueble'];
				$nom = strtoupper(trim($data['body'][$i]['INM_Nombre']));
				$tipopropiedad = trim($data['body'][$i]['TIP_Nombre']);
				$direccion = trim($data['body'][$i]['INM_Direccion']);
				$escritura = trim($data['body'][$i]['INM_Escritura']);
				$ubicacion = trim($data['body'][$i]['UBI_Nombre']);
				$direccion = trim($data['body'][$i]['UBI_Direccion']);
				$ciudad  = trim($data['body'][$i]['CIU_Nombre']);
				$chip = trim($data['body'][$i]['INM_Chip']);
				$nomestado = $data['body'][$i]['EST_Nombre'];
				$disponible = $data['body'][$i]['INM_Disponible'];				
				if($disponible != 2){
*/					
?>
				<li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
						<a href="javascript:void(0)" class="product-title">
							<span class="badge badge-warning float-right"><?php //echo $tipopropiedad ;?></span>
							<?php //echo ' '.$nom; ?>
                        </a>
                      <span class="product-description">
                        <?php //echo $ubicacion.' '.$direccion .', '.$ciudad; ?>
                      </span>
                    </div>
                </li>
<?php  /*      
				}
			}		
		}
	}	
}
else
{
	$soportecURL = "N";
	echo "No hay soporte para cURL";
}
*/								
?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Ver Todos</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <!-- Deudores -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight:bold; color:#001; text-shadow: #bbb 4px 4px 4px;">Playlist</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Nueve Zeta Uno
                        <span class="badge badge-danger float-right">Reproducciones 1.800.000</span></a>
                      <span class="product-description">
                        Canción: SILEO
                      </span>
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">MICHAEL JACKSON
                        <span class="badge badge-danger float-right">Reproducciones 5.700.000</span></a>
                      <span class="product-description">
                        Canción: Billie Jean
                      </span>
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">
                        Oasis <span class="badge badge-danger float-right">
                        Reproducciones 1.500.000
                      </span>
                      </a>
                      <span class="product-description">
                        Canción: Wonderwall
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">Green Day
                        <span class="badge badge-danger float-right">Reproducciones 3.990.000</span></a>
                      <span class="product-description">
                        Canción: Basket Case
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Ver Todos</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="http://msmakesof">MSMaKeSof</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0-pre
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
<script src="./plugins/redirect/jquery.redirect.js"></script>
<script>
$( document ).ready(function() {
	$("#salir").on('click', function(){
		$.redirect('close.php')
	})	
});
</script>
</body>
</html>
