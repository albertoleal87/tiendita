<?php

include ('header.php');
include ('scripts.php');

?>



<div id="cuerpo"> <!-- empieza div cuerpo-->

<div id="arriba">

<form action="usuarios.php" method="post">

<table id="formulario" align="left">

<tr><th colspan="2">Ingresa nuevo usuario</th></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre"></td></tr>
<tr><td>User name:</td><td><input type="text" name="username"></td></tr>
<tr><td>pass:</td><td><input type="text" name="pass"></td></tr>
<tr><td>perfil:</td>

<td><select name="perfil">
<option>Administrador</option>
<option>Usuario</option>
</select></td>

</tr>
<tr><td></td><td id="submit"><input type="submit" value="Agrega Registro"></td></tr>
</table>


<?php



@$nombre = $_POST['nombre'];
@$username = $_POST['username'];
@$pass = $_POST['pass'];
@$perfil = $_POST['perfil'];


if(
isset($nombre) &&	!empty($nombre) &&
isset($username) &&	!empty($username) &&
isset($pass) &&	!empty($pass) &&
isset($perfil) &&	!empty($perfil)
) {
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");

$insert = "INSERT INTO tiendita . usuarios 	(nombre ,
username ,
pass ,
perfil)	VALUES (
'$nombre',
'$username',
'$pass',
'$perfil'
) " ;


if (mysql_query($insert))
{echo "<font color='#0000EE'><b>Datos ingresados con exito</b></font>";}

else {echo "<font color='#EE0000'><b>Error al insertar</b></font>";}


}



?>



<table id="formulario"  align="right">
<tr><td><input type="text" name="buscar"></td><td id="submit"><input type="submit" value="Buscar"></td></tr>
</table>
</div>

<?php

@$buscar = $_POST['buscar'];

if  (isset($buscar) && !empty($buscar))

{
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
$sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar%' ";
$resultado = mysql_query($sql);
$row = mysql_fetch_assoc($resultado);
mysql_close($server);
}

if(@$row)
{

echo<<<formulario
<table id="formulario" align="right">

<tr><td>ID:</td><td><input type="text" name="id" readonly="readonly" value="$row[iduser]"></td></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre2" value="$row[nombre]"></td></tr>
<tr><td>User name:</td><td><input type="text" name="username2" value="$row[username]"></td></tr>
<tr><td>pass:</td><td><input type="text" name="pass2" value="$row[pass]"></td></tr>
<tr><td>perfil:</td>
<td><select name="perfil2" value="">
<option>$row[perfil]</option>
formulario;
if(($row[perfil]) == "Administrador")
{echo"<option>Usuario</option>";}
else{echo"<option>Administrador</option>";}
echo<<<formulario
</select></td>
</tr>
<tr><td></td><td id="submit"><select name="update">
<option>Actualizar</option>
<option>Eliminar</option>
</select>
<input type="submit" name="actualizar" value="Aceptar">
</td>
</tr>
</table>
formulario;

}

@$update = $_POST['update'];

@$nombre2 = $_POST['nombre2'];
@$username2 = $_POST['username2'];
@$pass2 = $_POST['pass2'];
@$perfil2 = $_POST['perfil2'];

@$id = $_POST['id'];

if((isset($id)) && (!empty($id)) && ($update == "Eliminar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$delete = "DELETE FROM `usuarios` WHERE iduser='$id' ";
if(mysql_query($delete)){echo"<font color='#0000EE'><b>Articulo eliminado con exito!!!</b></font>";}

else {echo"No se pudo eliminar";}

mysql_close($server);

}

if(($update == "Actualizar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$actualizar = "UPDATE usuarios SET 
nombre='$nombre2',
username='$username2',
pass='$pass2',
perfil='$perfil2'
WHERE iduser='$id' ";

if(mysql_query($actualizar)or die("No se pudo ejecutar debido a ".mysql_error()))

{echo"<font color='#0000EE'><b>Articulo actualizado con exito!!!</b></font>";}

else {echo"No se pudo actualizar";}

mysql_close($server);


}

?>


	<div id="examinar">	
	<table cellspacing="0" align="left">
	<tr><th colspan="10" ><h3>Examinar tabla</h3></th></tr>


	<?php
	$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
	mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
	$sql = "SELECT * FROM usuarios ORDER BY iduser ";
	$resultado = mysql_query($sql);
	$campos = mysql_num_fields($resultado);
	$filas = mysql_num_rows($resultado);

	?>

	<tr>
	<?php
	for ($i = 0;$i < $campos;$i++) 
	{$nombrecampo = mysql_field_name($resultado, $i);
	echo "<th>$nombrecampo</th>";}

	echo "</tr>"; // Cerrar fila

	while ($row = mysql_fetch_assoc($resultado)) 
	{echo "<tr>"; // Crear fila

	foreach ($row as $key => $value) {
	echo "<td>$value&nbsp;</td>";} 
	echo "</tr>"; // Cerrar fila
	}

	mysql_close($server);


	?>

	</table>
</div> <!-- termina div abajo -->



</form>


</div> <!-- termina div cuerpo-->

</body>

</html>
