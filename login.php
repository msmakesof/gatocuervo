<?php
include('config/config1.php');
$claveKey = encryptor('encrypt', trim($secret_key));
//$key = trim($claveKey);
$cipher = "AES-256-ECB";
$txt = uniqid().sha1(time());
$chiperRaw = openssl_encrypt($txt, $cipher, $claveKey, OPENSSL_RAW_DATA);
$ciphertext = trim(base64_encode($chiperRaw));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>...:::  Control  Inmobiliario  :::...</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  
  <link rel="stylesheet" href="./toast/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="text-shadow: #bbb 4px 4px 4px;">
    <b>Control Inmobiliario</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg" style="text-shadow: #bbb 4px 4px 4px;">Bienvenido</p>
		<!-- ../../index3.html -->
      <form id="form1" action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id ="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id ="pass" placeholder="Clave">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>		
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="ingresar" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
		<!-- 
      <div class="social-auth-links text-center mb-3">
        <p>- O -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Ingresar usando Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Ingresar usando Google+
        </a>
      </div>  -->
      <!-- /.social-auth-links -->
	  
		<div class="row">		
		</div><hr>
		

      <div  style="width:100%">
		  <div class="mb-1" style="float:left; width:50%">
			<a href="./reg/recovery.html"><i class="fa fa-key mr-2"></i> Olvidé mi Clave</a>
		  </div>
		  <div class="mb-0" style="float:left; width:50%; text-align: right">
			<a href="./reg/register.html" class="text-center"><i class="fa fa-address-card mr-2"></i> Registrarme</a>
		  </div>
	  </div>
	  
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="./toast/toastr.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<script src="./plugins/redirect/jquery.redirect.js"></script>
<script src="./CryptoJSv3.1.2/rollups/aes.js"></script>
<script>
$( document ).ready(function() {
    $("#ingresar").on('click', function(e){
		console.log( "ready!" );
		let email = $("#email").val();
		let pass = $("#pass").val();
		var KeyObj = CryptoJS.enc.Utf8.parse("<?=$claveKey?>")
		var random = CryptoJS.AES.encrypt(pass, "<?=$claveKey?>").toString()
		if(email == "" || pass == "")
		{			
			toastr["error"]("Debe digitar Email y/o Clave.", "Atención: ")
		}
		else
		{
			e.preventDefault()
			//$.redirect('./pages/render.php', {'email': email, 'pass': pass});
			var jqxhr = $.ajax({
				method: "POST",
				url: "./pages/render.php",
				data: { 'email': email, 'random': random, 'pubk': "<?php echo $ciphertext; ?>", 'prik': "<?php echo $claveKey; ?>" }
			})
			.done(function(msg) {
				if(msg == "N"){
					toastr["error"]("Email y/o Clave incorrectas.", "Atención: ")
					$("#email").val('')
					$("#pass").val('')
				}
				else{
					window.location = "./index.php"
				}
			})
			.fail(function(jqXHR, textStatus) {
			  console.log("Petición al servidor Falla " + textStatus)
			})
		}
	});	

	toastr.options = {
	  "closeButton": false,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-center",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}	
});
</script>
</body>
</html>