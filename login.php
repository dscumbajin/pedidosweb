<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: pedidos.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>BATERIAS ECUADOR | Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
   <link rel=icon href='img/favicon.ico' sizes="32x32" type="image/png">
   <link href="css/fontawesome.css" rel="stylesheet">
  	<link href="css/brands.css" rel="stylesheet">
  	<link href="css/solid.css" rel="stylesheet">
   <style>
	*{
		font-family:'Roboto',sans-serif;
	}
	input,button{
		font-weight:normal!important;
	}
	input{
		background:#f2f2f2!important;
		padding:10px 20px!important;
		border:none!important;
		height:40px!important;
		transition:all 300ms ease-in!important;
		border-bottom:1px solid #c3c3c3!important;
		
	}
	input:hover{
		border-bottom:1px solid #666666!important;
		
	}
	input:focus,button:focus{
		outline:none!important;
		box-shadow:none!important
	}
	label{
		color:#666666!important;
		font-size:15px!important;
		margin-bottom:15px;

	}
	i{
		cursor:pointer;
	}
	@media(max-width:600px){
		.card{
			min-width:400px!important;
		}
		.navbar-footer{
			float:none!important;
		}
		.acciones{
			flex-direction:column!important;
		}
		.acciones button{
			flex:0 1 100%!important;
		}
		button{
			margin-left:0!important;
		}
	}
	@media(max-width:450px){
		.card{
			min-width:300px!important;
		}
		
	}
	@media(max-width:400px){
		.card{
			min-width:200px!important;
			padding:40px 25px 40px 25px!important;
		}
		
	}
	@media(max-width:370px){
		.card{
			min-width:100%!important;
			width:100%!important;
		}
		
	}
	.acciones{
		display:flex;
		margin-top:40px;
		justify-content:space-between;
	}
	.acciones button{
		flex:0 1 46%!important;
		cursor:pointer;
		padding:10px 20px!important;
		width:100%;
	}
	.acciones .btn-signin{
		margin-top:0!important;
		height:40px;
	}
   </style>

  <script>
	function reset_password(){
		location.href="reset_password.php";
	}
  </script> 

</head>
<body style="background:#f2f2f2">
<nav class="navbar ">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" style="padding:10px;">
			<a href="pedidos.php">
			<!--<img width="25%" src="img/logobat.png" alt="Logo">-->
			</a>
		</div>
	</div>
</div>
 <div class="container">
        <div class="card card-container" style="background:#fff; min-width:400px;height:100%;">
			<svg id="profile-img"  data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 40"><defs><style>.cls-1{fill:#e11f28;}.cls-2{fill:#fff;}.cls-3{fill:#f7b917;}</style></defs><title>logo_bateriasec</title><rect class="cls-1" x="39.53" y="1.53" width="307.93" height="136.94"/><path class="cls-2" d="M47.3,9.43h2.53a1.83,1.83,0,0,1,1.35.45,1.13,1.13,0,0,1,.32.82h0a1.15,1.15,0,0,1-.77,1.12,1.22,1.22,0,0,1,1,1.23v0c0,.86-.7,1.38-1.87,1.38H47.3ZM50.15,11c0-.29-.22-.44-.62-.44h-.9v.89h.86c.42,0,.66-.14.66-.44Zm-.47,1.43h-1v.92h1.06c.42,0,.66-.16.66-.46h0c0-.27-.22-.45-.67-.45"/><path class="cls-2" d="M54.05,9.4h1.32l2.11,5.06H56l-.35-.9H53.74l-.35.9H52Zm1.2,3.07-.55-1.42-.55,1.42Z"/><polygon class="cls-2" points="58.53 10.65 57.05 10.65 57.05 9.43 61.38 9.43 61.38 10.65 59.9 10.65 59.9 14.46 58.53 14.46 58.53 10.65"/><polygon class="cls-2" points="61.98 9.43 65.96 9.43 65.96 10.61 63.34 10.61 63.34 11.38 65.71 11.38 65.71 12.48 63.34 12.48 63.34 13.28 65.99 13.28 65.99 14.46 61.98 14.46 61.98 9.43"/><path class="cls-2" d="M66.7,9.43H69a2.16,2.16,0,0,1,1.61.54,1.6,1.6,0,0,1,.44,1.17v0a1.61,1.61,0,0,1-1,1.55l1.18,1.75H69.67l-1-1.52h-.61v1.52H66.7ZM69,11.85c.46,0,.74-.23.74-.6h0c0-.41-.29-.61-.75-.61h-.9v1.22Z"/><rect class="cls-2" x="71.81" y="9.43" width="1.37" height="5.03"/><path class="cls-2" d="M75.8,9.4h1.32l2.1,5.06H77.75l-.35-.9H75.49l-.36.9H73.7ZM77,12.47l-.55-1.42-.56,1.42Z"/><path class="cls-2" d="M79.26,13.72l.76-.93a2.49,2.49,0,0,0,1.6.6c.38,0,.57-.13.57-.34v0c0-.21-.16-.32-.84-.49-1-.24-1.86-.54-1.86-1.57h0c0-.94.73-1.61,1.91-1.61a3.09,3.09,0,0,1,2,.67l-.69,1a2.39,2.39,0,0,0-1.38-.5c-.33,0-.5.14-.5.33h0c0,.23.17.33.87.49,1.12.25,1.83.62,1.83,1.57h0c0,1-.8,1.64-2,1.64a3.43,3.43,0,0,1-2.31-.83"/><polygon class="cls-2" points="47.3 15.52 58.19 15.52 58.19 19.05 51.35 19.05 51.35 21.34 57.45 21.34 57.45 24.64 51.35 24.64 51.35 27.02 58.3 27.02 58.3 30.57 47.3 30.57 47.3 15.52"/><path class="cls-2" d="M83.81,23.86V15.52H79.66V24c0,2.1-1.07,3.09-2.74,3.09s-2.72-1-2.72-3.2V15.52H70.06V24c0,4.71,2.64,6.88,6.82,6.88a9.38,9.38,0,0,0,2-.19l5-6.48c0-.11,0-.21,0-.32"/><path class="cls-2" d="M95.64,15.52h5.72c5.26,0,8.32,3.09,8.32,7.44v0c0,4.34-3.11,7.57-8.4,7.57H95.64Zm4.09,3.68v7.67h1.67c2.47,0,4.1-1.38,4.1-3.8V23c0-2.41-1.63-3.82-4.1-3.82Z"/><path class="cls-2" d="M110.17,23.09V23a8,8,0,0,1,15.92,0v0a8,8,0,0,1-15.92.05m11.72,0V23A3.85,3.85,0,0,0,118.11,19a3.81,3.81,0,0,0-3.76,4v0a3.89,3.89,0,0,0,3.8,4.07,3.81,3.81,0,0,0,3.74-4"/><path class="cls-2" d="M126.59,15.52h7a6.46,6.46,0,0,1,4.81,1.61,4.73,4.73,0,0,1,1.31,3.51v0a4.76,4.76,0,0,1-3,4.64l3.53,5.25h-4.71l-3-4.56h-1.82v4.56h-4.09Zm6.82,7.22c1.37,0,2.19-.68,2.19-1.78v-.05c0-1.2-.86-1.8-2.21-1.8h-2.71v3.63Z"/><path class="cls-2" d="M91.16,15.5l-11.49,15H84.6l2.12-2.77h4.21v2.77h4v-15Zm-3,9.44,3.09-4v4Z"/><path class="cls-2" d="M69.4,20.47a4.07,4.07,0,0,0-3.28-1.65,4,4,0,0,0-1.59.32,3.74,3.74,0,0,0-1.26.87,3.86,3.86,0,0,0-.83,1.3,4.34,4.34,0,0,0-.3,1.63,4.48,4.48,0,0,0,.3,1.65,3.92,3.92,0,0,0,2.1,2.18,3.69,3.69,0,0,0,1.56.32,4.41,4.41,0,0,0,3.3-1.59v4.61l-.39.14a11.58,11.58,0,0,1-1.64.47,7.78,7.78,0,0,1-1.5.15A7.47,7.47,0,0,1,63,30.28a7.6,7.6,0,0,1-2.46-1.65,8.25,8.25,0,0,1-1.71-2.52,7.87,7.87,0,0,1,4.16-10.48,7.58,7.58,0,0,1,3-.59,8.24,8.24,0,0,1,1.72.19,11,11,0,0,1,1.79.59Z"/><rect class="cls-3" x="2.54" y="1.53" width="36.31" height="38.94"/><path class="cls-1" d="M17.33,10.91c-.1,0-.17,0-.2-.07a.27.27,0,0,1,0-.21l.17-1a.29.29,0,0,1,.09-.21.42.42,0,0,1,.22-.05H30.68q.16,0,.21.06a.29.29,0,0,1,0,.22l-.16.94a.35.35,0,0,1-.11.21.28.28,0,0,1-.21.07Z"/><path class="cls-1" d="M16.85,13.71a.28.28,0,0,1-.21-.06.29.29,0,0,1,0-.22l.17-.95a.34.34,0,0,1,.09-.21.36.36,0,0,1,.23,0H30.2a.25.25,0,0,1,.2.06.29.29,0,0,1,0,.22l-.16.93a.35.35,0,0,1-.1.22.38.38,0,0,1-.22.06Z"/><path class="cls-1" d="M9.58,16.52a.25.25,0,0,1-.2-.06s0-.11,0-.22l.17-.95c0-.11.05-.18.1-.21A.32.32,0,0,1,9.84,15H22.93c.1,0,.17,0,.2.07s0,.11,0,.21l-.17.94a.3.3,0,0,1-.1.22.36.36,0,0,1-.22.06Z"/><path class="cls-1" d="M8.15,24.94a.27.27,0,0,1-.2-.06.29.29,0,0,1,0-.22l.17-.95a.29.29,0,0,1,.09-.21.34.34,0,0,1,.22-.05h13.1a.25.25,0,0,1,.2.06.29.29,0,0,1,0,.22l-.16.93a.31.31,0,0,1-.11.22.33.33,0,0,1-.21.06Z"/><path class="cls-1" d="M15.9,19.32a.25.25,0,0,1-.2-.06s0-.11,0-.22l.17-.95c0-.11.05-.18.1-.21a.33.33,0,0,1,.22-.05H29.25a.25.25,0,0,1,.2.06s0,.11,0,.21l-.16.94a.35.35,0,0,1-.11.22.38.38,0,0,1-.22.06Z"/><path class="cls-1" d="M12.63,22.26a.25.25,0,0,1-.2-.06.3.3,0,0,1,0-.22l.17-1a.34.34,0,0,1,.09-.21.44.44,0,0,1,.23,0H26a.27.27,0,0,1,.2.06.3.3,0,0,1,0,.22l-.16.94a.33.33,0,0,1-.11.22.34.34,0,0,1-.22.06Z"/><path class="cls-1" d="M14.46,27.74a.36.36,0,0,1-.21,0,.37.37,0,0,1,0-.22l.17-1c0-.11,0-.18.1-.21s.11-.05.22-.05H27.81a.25.25,0,0,1,.2.06s0,.11,0,.22l-.16.94a.41.41,0,0,1-.1.22.48.48,0,0,1-.22,0Z"/><path class="cls-1" d="M14,30.55a.25.25,0,0,1-.2-.06s0-.11,0-.22l.17-1a.29.29,0,0,1,.1-.2.33.33,0,0,1,.22-.05H27.32a.25.25,0,0,1,.2.06.23.23,0,0,1,0,.21l-.17.94a.3.3,0,0,1-.1.22.34.34,0,0,1-.22.06Z"/></svg>
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>
				<label for="user_name">Usuario</label>
                <input class="form-control" placeholder="Usuario (RUC)" name="user_name" id="user_name" type="text" value="" autofocus="" required>
                <label for="user_password" style="margin-top:10px;">Contraseña</label>
				<input class="form-control" placeholder="Contraseña" name="user_password" id="user_password" type="password" value="" autocomplete="off" required>
				<div class="acciones">
					<button type="submit"  class="btn btn-lg btn-success  btn-signin" name="login" id="submit">Iniciar Sesión</button>
					<button type="button" onclick="reset_password()" class="btn btn-lg btn-success btn-signin" style="margin-left:10px;" name="login" id="submit">Recuperar Contraseña</button>
				</div>
			</form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
	<div class="navbar navbar-footer navbar-fixed-bottom" style="display:flex;justify-content:center;padding:10px 20px; background:#f2f2f2; margin:auto">
    <div class="container" style="padding:10px;">
      <p class="navbar-footer pull-right" style="background:#f2f2f2; margin:auto; color:#666666">Copyright &copy <?php echo date('Y');?> - BATERIAS ECUADOR.
           <a href="http://bateriasecuador.com/" target="_blank" style="color: #666666; font-weigh:bold;">DERECHOS RESERVADOS</a>
           <div class="btn-group pull-left">
				
				<a href="http://bateriasecuador.com/" target="_blank" style="color: #666666; font-weigh:bold;margin-right:10px;">www.bateriasecuador.com  </a>
				<a href="https://web.facebook.com/bateriasecuador/" target="_blank"><i style="color:#666666" class="fab fa-facebook x-3"></i></a> |
                <a href="https://www.youtube.com/channel/UC_KkHecfX2JmOHLsFNkISTA" target="_blank"><i style="color:#666666" class="fab fa-youtube"></i></a> |
                <a  href="https://www.instagram.com/baterias_ecuador/" target="_blank"><i style="color:#666666" class="fab fa-instagram"></i></a>
            </div>
      </p>
   </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

	<?php
}


