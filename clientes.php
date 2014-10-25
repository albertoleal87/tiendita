<?php

include ('header.php');
include ('scripts.php');

?>


<div id="cuerpo"> <!-- empieza div cuerpo-->

<div id="arriba">


<form action="clientes.php" method="post">



<table id="formulario"  align="left">
<tr><th colspan="2" >Ingresa nuevo cliente</th></tr>
<tr><td>Rfc:</td><td><input type="text" name="rfc"></td></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre"></td></tr>
<tr><td>Calle:</td><td><input type="text" name="calle"></td></tr>
<tr><td>Colonia:</td><td><input type="text" name="colonia"></td></tr>
<tr><td>Municipio:</td><td><input type="text" name="municipio"></td></tr>
<tr><td>Estado:</td><td><input type="text" name="estado"></td></tr>
<tr><td>Pais:</td><td><input type="text" name="pais"></td></tr>
<tr><td>CP:</td><td><input type="text" name="cp"></td></tr>
<tr><td>Telefono:</td><td><input type="text" name="telefono"></td></tr>
<tr><td></td><td id="submit"><input type="submit" value="Agrega Registro"></td></tr>
</table>


<?php

@$rfc = $_POST['rfc'];
@$nombre = $_POST['nombre'];
@$calle = $_POST['calle'];
@$colonia = $_POST['colonia'];
@$municipio = $_POST['municipio'];
@$estado = $_POST['estado'];
@$pais = $_POST['pais'];
@$cp = $_POST['cp'];
@$telefono = $_POST['telefono'];




if (isset($rfc) && !empty($rfc))

{	
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");


$insert = "INSERT INTO `tiendita`.`clientes` 	(`rfc` ,
`nombre` ,
`calle` ,
`colonia` ,
`municipio` ,
`estado` ,
`pais` ,
`cp` ,
`telefono`)	VALUES ('$rfc',
'$nombre',
'$calle',
'$colonia',
'$municipio',
'$estado',
'$pais',
'$cp',
'$telefono') " ;


if (mysql_query($insert))
{echo "<font color='#0000EE'><b>Datos ingresados con exito</b></font>";}

else {echo "<font color='#EE0000'><b>Error al insertar</b></font>";}


}


?>

<table id="formulario"  align="right">
<tr>
<td><input type="text" name="buscar"></td>
<td id="submit"><input type="submit" value="buscar"></td>
</tr>
</table>
</div>


<?php

@$buscar = $_POST['buscar'];

if  (isset($buscar) && !empty($buscar))

{
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
$sql = "SELECT * FROM `clientes` WHERE nombre LIKE '%$buscar%' ";
$resultado = mysql_query($sql);
$row = mysql_fetch_assoc($resultado);
mysql_close($server);
}

if(@$row)
{

echo<<<formulario
<table id="formulario" align="right">

<tr><td>ID:</td><td><input type="text" name="id" readonly="readonly" value="$row[id]"></td></tr>
<tr><td>Rfc:</td><td><input type="text" name="rfc2" value="$row[rfc]"></td></tr>
<tr><td>Nombre:</td><td><input type="text" name="nombre2" value="$row[nombre]"></td></tr>
<tr><td>Calle:</td><td><input type="text" name="calle2" value="$row[calle]"></td></tr>
<tr><td>Colonia:</td><td><input type="text" name="colonia2" value="$row[colonia]"></td></tr>
<tr><td>Municipio:</td><td><input type="text" name="municipio2" value="$row[municipio]"></td></tr>
<tr><td>Estado:</td><td><input type="text" name="estado2" value="$row[estado]"></td></tr>
<tr><td>Pais:</td><td><input type="text" name="pais2" value="$row[pais]"></td></tr>
<tr><td>CP:</td><td><input type="text" name="cp2" value="$row[cp]"></td></tr>
<tr><td>Telefono:</td><td><input type="text" name="telefono2" value="$row[telefono]"></td></tr>

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


@$rfc2 = $_POST['rfc2'];
@$nombre2 = $_POST['nombre2'];
@$calle2 = $_POST['calle2'];
@$colonia2 = $_POST['colonia2'];
@$municipio2 = $_POST['municipio2'];
@$estado2 = $_POST['estado2'];
@$pais2 = $_POST['pais2'];
@$cp2 = $_POST['cp2'];
@$telefono2 = $_POST['telefono2'];

@$id = $_POST['id'];

if((isset($id)) && (!empty($id)) && ($update == "Eliminar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$delete = "DELETE FROM `clientes` WHERE id='$id' ";
if(mysql_query($delete)){echo"<font color='#0000EE'><b>Articulo eliminado con exito!!!</b></font>";}

else {echo"No se pudo eliminar";}

mysql_close($server);

}

if(($update == "Actualizar"))

{
$server = mysql_connect('localhost', 'root', '');
mysql_select_db('tiendita', $server) ;
$actualizar = "UPDATE clientes SET 
rfc='$rfc2',
nombre='$nombre2',
calle='$calle2',
colonia='$colonia2',
municipio='$municipio2',
estado='$estado2',
pais='$pais2',
cp='$cp2',
telefono='$telefono2'
WHERE id='$id' ";


if(mysql_query($actualizar)){echo"<font color='#0000EE'><b>Articulo actualizado con exito!!!</b></font>";}

else {echo"No se pudo actualizar";}

mysql_close($server);

}

?>


<div id="examinar">
<table cellspacing="0">

<tr><th colspan="10" ><h3>Examinar tabla</h3></th></tr>


<?php
$server = mysql_connect("localhost", "root", "") or die ("No se logro conectar al servidor");
mysql_select_db("tiendita", $server) or die ("No se logro conectar a la base de datos");
$sql = "SELECT * FROM clientes ORDER BY id ";
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
