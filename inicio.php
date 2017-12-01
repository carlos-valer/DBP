<?php
    session_start();
        
    if(isset($_SESSION["usuario"]))
        header('Location: chat.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/inicio.css">
    <title>Inicio</title>
	
</head>
<body style="background-image:url(img/fondo1.jpg)">
   	<div class="registro">
   		<h1><strong>REGISTRARSE</strong></h1>
   		<form action="crear_usuario.php" method="post">
   			
			<strong>
			<label for="email">E-mail</label><br>
	   		<input id="email" type="email" name="email" placeholder="EMAIL" autocomplete="off" required><br>
	   		
	   		<label for="usuario">Usuario</label><br>
	   		<input id="usuario" type="text" name="usuario" placeholder="USUARIO" autocomplete="off" required><br>
	   		
	   		<label for="clave">Contraseña</label><br>
	   		<input id="clave" type="password" name="clave" placeholder="CLAVE" autocomplete="off" required><br>
	   		
	   		<input type="submit" name="registrarse" value="registrarse"></strong>
   			
   		</form>
   	</div>

		<!-- --------------------------------------------------------------- -->

   	<div class = "login">
   		<img src="img/avatar1.png" class="avatar_login">
   		<h1><strong>LOGIN</strong></h1>
   		<form action="verificar_usuario.php" method="post">
   			<strong>
   				<label for="email">Email</label><br>
   				<input type="text" name="email" placeholder="EMAIL" autocomplete="off" required><br>
				
				<label for="clave">Contraseña</label><br>
	   			<input id="clave" type="password" name="clave" placeholder="CLAVE" autocomplete="off" required><br>
	   		
	   			<input type="submit" name="registrarse" value="Login"></strong>
   			
   		</form>
   	</div>

	

</body>
</html>