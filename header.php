<?php
session_start();

if(!isset($_SESSION['user']))
{header("Location: login.php");}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formato.css" type="text/css" rel="stylesheet" />
<link href="css/ui-lightness/jquery-ui-1.8.20.custom.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="js/funciones.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Punto de venta</title>
</head>
<body>

<div id="absoluto">

<div id="encabezado">
<h1>Punto de venta</h1>

</div><!-- termina div encabezado-->


<div id="menu">   <!-- empieza div menu-->
<form name="reloj12">
<ul>
<li><a href="Facturacion.php"><input type="button" value="Facturacion" onmouseover='$("#menufacturacion").toggle(200);'></a></li>
<li><a href="Articulos.php"><input type="button" value="Articulos"></a></li>
<li><a href="Clientes.php"><input type="button" value="Clientes"></a></li>
<li><a href="Usuarios.php"><input type="button" value="Usuarios"></a></li>
<li><a href="Reportes.php"><input type="button" value="Reportes"></a></li>
<li><a href="login.php"><input type="button" value="Logout"></a></li>

<table align="right">	
<tr>
<td>
user:<?php echo $_SESSION['user']; ?>&nbsp;
</td>

<td id="reloj">
<input style="background-color:#FFF; margin:0px; pading:0" type="text" size="11" name="date" value="<?php echo date("d-m-Y"); ?>">
</td>

<td id="reloj">
<input style="background-color:#FFF; margin:0px; pading:0" type="text" size="11" name="digitos">  
</td>

</tr>


</table>



</form>
</ul>
</div> <!-- termina div menu-->
</div>