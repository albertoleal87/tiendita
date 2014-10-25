<?php

include ('header.php');
include ('scripts.php');

?>

<div id="cuerpo"> <!-- empieza div cuerpo-->

<div id="arriba"> <!-- empieza div arriba-->


<form action="articulos.php" method="post">


<table id="formulario"  align="left">  <!-- tabla insert-->
<tr><th colspan="2">Ingresa nuevo articulo</th></tr>
<tr><td>Unidad:</td><td><input type="text" name="unidad"></td></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre"></td></tr>
<tr><td>Precio:</td><td><input type="text" name="precio"></td></tr>
<tr><td></td><td id="submit"><input type="submit" name="guardar" value="Agrega Registro"></td></tr>
</table>  <!-- Termina tabla insert-->

<?php


@$unidad = $_POST['unidad'];
@$nombre = $_POST['nombre'];
@$precio = $_POST['precio'];


if (
	isset($_POST['unidad']) && !empty($_POST['unidad']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['precio']) && !empty($_POST['precio'])
	)

{	
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");

$insert = "INSERT INTO `tiendita`.`articulos` 
(`unidad` , `nombre` , `precio`)
VALUES ('$unidad', '$nombre', '$precio') " ;

if (mysql_query($insert))
{echo "<font color='#0000EE'><b>Articulo ingresado con exito!!!</b></font>";}

else {echo "<font color='#EE0000'><b>Error al insertar</b></font>";}
mysql_close($server);
}

?>



<table id="formulario"  align="right"> <!--tabla busqueda-->
<tr>
<td><input type="text" name="buscar"></td>
<td id="submit"><input type="submit" value="Busca articulo"></td>
</tr>
</table> <!-- termina tabla busqueda-->


<?php

@$buscar = $_POST['buscar'];

if  (isset($buscar) && !empty($buscar))

{
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
$sql = "SELECT * FROM `articulos` WHERE nombre LIKE '%$buscar%' ";
$resultado = mysql_query($sql);
$row = mysql_fetch_assoc($resultado);
mysql_close($server);
}

if(@$row)
{

echo<<<formulario
<table id="formulario" align="right">

<tr><td>ID:</td><td><input type="text" name="id" readonly="readonly" value="$row[id_art]"></td></tr>
<tr><td>Unidad:</td><td><input type="text" name="unidad2" value="$row[unidad]"></td></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre2" value="$row[nombre]"></td></tr>
<tr><td>Precio:</td><td><input type="text" name="precio2" value="$row[precio]"></td></tr>
<tr>
<td></td>
<td id="submit">
<select name="update">
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
@$precio2 = $_POST['precio2'];
@$unidad2 = $_POST['unidad2'];
@$id = $_POST['id'];

if((isset($id)) && (!empty($id)) && ($update == "Eliminar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$delete = "DELETE FROM `articulos` WHERE id_art='$id' ";
if(mysql_query($delete)){echo"<font color='#0000EE'><b>Articulo eliminado con exito!!!</b></font>";}

else {echo"No se pudo eliminar";}

mysql_close($server);

}

if(($update == "Actualizar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$actualizar = "UPDATE articulos SET unidad='$unidad2', nombre = '$nombre2' , precio = '$precio2' WHERE id_art='$id' ";



if(mysql_query($actualizar)){echo"<font color='#0000EE'><b>Articulo actualizado con exito!!!</b></font>";}

else {echo"No se pudo actualizar";}

mysql_close($server);

}

?>

</div>  <!-- cierra div arriba>-->


<div id="examinar"> <!-- empieza div abajo-->
<table cellspacing="0" align="left">
<tr><th colspan="4"><h3>Examinar tabla</h3></th></tr>


<?php
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
$sql = "SELECT * FROM articulos ORDER BY id_art ";
$resultado = mysql_query($sql);
$campos = mysql_num_fields($resultado);
$filas = mysql_num_rows($resultado);

echo<<<formulario
<tr>
formulario;

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
