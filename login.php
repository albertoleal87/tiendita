<?php

session_start();
@$_SESSION['user'] = $_POST['usuario'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formato.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Punto de venta</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div id="login" align="center">
<br>
<br>
<img src="imagenes/llave.png"/>
<br>
<table id="formulario">
<tr><th colspan="2">Control de accseso</th></tr>
<tr><td colspan="2" align="center">"Favor de ingresar Usuario y Contraseña"</td></tr>
<tr><td>Usuario:</td><td><input type="text" name="usuario"></td></tr>
<tr><td>Contraseña:</td><td><input type="password" name="pass"></td></tr>
<tr><td id="submit" colspan="2" align="center"><input  type="submit" value=" Enviar "></td></tr>
</table>

</form>
<br>
<?php


@$us = $_POST['usuario'];
@$pw = $_POST['pass'];

if (isset($us) && isset($pw) &&  !empty($us) && !empty($pw))
{
require_once("conexion.php"); 
$selectusuario = "SELECT pass FROM usuarios WHERE username = '$us' ";
$queryusuario = mysql_query($selectusuario);
$arrayusuario = mysql_fetch_assoc($queryusuario) or die (mysql_error());
$pass = $arrayusuario['pass'];

if($pass == $pw){header("Location: facturacion.php");}

else{echo "<script type='text/javascript'>alert('Datos incorrectos intente nuevamente!!!');</script>";}

}

elseif (isset($us) && isset($pw)) 
{echo "<script type='text/javascript'>alert('Datos incorrectos intente nuevamente!!!');</script>";}
	
?>


</div> <!--TERMINA DIV LOGIN-->
</body>

</html>
