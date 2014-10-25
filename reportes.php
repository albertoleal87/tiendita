<?php

include ('header.php');
include ('scripts.php');

?>

<div id="cuerpo"> <!-- empieza div cuerpo-->
<form action="reportes.php" method="post">

<table id="formulario"  align="left" >
<tr id="submit" style="text-align: center;">
<td>Fecha inicial</td>
<td>Fecha final</td>
</tr>
<tr id="submit">
<td><input name="date1" type="text" id="date1" value="2012-11-25" /></td>
<td><input name="date2" type="text" id="date2" value="<?php echo date('Y-m-d'); ?>"/></td>
</tr>	

<tr id="submit" style="text-align: center;">
<td>Articulo</td>
<td>Cliente</td>
<td>Usuario</td>
</tr>

<tr id="submit">

<td><select name="articulo">
<option></option>
<?php
require_once("conexion.php"); 
$selectarticulo = "SELECT nombre FROM articulos ORDER BY nombre ASC ";
$queryarticulo = mysql_query($selectarticulo);
while ($arrayarticulo = mysql_fetch_assoc($queryarticulo)) 
{echo "<option>$arrayarticulo[nombre]</option>";}
?>
</select></td>

<td><select name="cliente">
<option></option>
<?php
require_once("conexion.php"); 
$selectcliente = "SELECT rfc FROM clientes ORDER BY nombre ASC ";
$querycliente = mysql_query($selectcliente);
while ($arraycliente = mysql_fetch_assoc($querycliente)) 
{echo "<option>$arraycliente[rfc]</option>";}
?>
</select></td>

<td><select name="usuario">
<option></option>
<?php
require_once("conexion.php"); 
$selectusuario = "SELECT username FROM usuarios ORDER BY username ASC ";
$queryusuario = mysql_query($selectusuario);
while ($arrayusuario = mysql_fetch_assoc($queryusuario)) 
{echo "<option>$arrayusuario[username]</option>";}
?>
</select></td>

</tr>	

<tr>
<td id="submit"><input type="submit" value="Buscar"></td>
</tr>
</table>

<?php

@$date1 = $_POST['date1'];
@$date2 = $_POST['date2'];
@$articulo = $_POST['articulo'];
@$cliente = $_POST['cliente'];
@$usuario = $_POST['usuario'];

if($usuario)
{$andusuario = "AND usuario = '$usuario'";}
else{$andusuario = "";}

if($articulo)
{$andarticulo = "AND Articulo = '$articulo'";}
else{$andarticulo = "";}

if($cliente)
{$andcliente = "AND rfccliente = '$cliente'";}
else{$andcliente = "";}





if (isset($date1) && isset($date2) && !empty($date1) && !empty($date2) && $date2 > $date1 or $date2 = $date1  ) 
{
require_once("conexion.php"); 

echo<<<formulario
<div id="examinar">
<table cellspacing="0">
<tr><th colspan="10" ><h3>Examinar tabla</h3></th></tr>
formulario;



$sql = "SELECT numfac , fecha , rfccliente , ClaveArt , Unidad , Articulo , PrecioUnitario , CantidadArt , PrecioTotal , usuario FROM conceptos LEFT JOIN facturas ON numremision = numfac WHERE fecha >= '$date1' AND fecha <= '$date2' $andarticulo $andcliente $andusuario ";
$resultado = mysql_query($sql);
if(mysql_query($sql)or die(mysql_error())){}

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

echo<<<formulario
</table>
</div>
formulario;

} // termina if validacion fechas


elseif (isset($date1) && isset($date2) && !empty($date1) && !empty($date2) && $date1 > $date2){echo"fecha final debe ser mayor a la fecha menor ";}


?>

















</form>
</div> <!-- termina div cuerpo-->

</body>

</html>
