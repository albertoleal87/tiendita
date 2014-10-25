<?php

include ('header.php');
include ('scripts.php');

?>

<form action="facturacion.php" method="POST">

<div id="cuerpo"> <!-- empieza div cuerpo-->



<table id="buscarfc"  align="left" style="background-color:#36648B; padding:3px ; margin: 1px;  border:1px solid#fff; border-radius:5px 0px 5px 0px">

<tr>
<td>RFC:</td>
<td><select name="rfc" >
<option><?php @$rfc = $_POST['rfc']; echo "$rfc" ?></option>
<?php
require_once("conexion.php"); 
$selectcliente = "SELECT rfc FROM clientes ORDER BY nombre ASC ";
$querycliente = mysql_query($selectcliente);
while ($arraycliente = mysql_fetch_assoc($querycliente)) 
{echo "<option>$arraycliente[rfc]</option>";}
?>
</select></td>
<td id="submit"><input type="submit" value="Buscar"></td>
</tr>
</table>

<table align="right" style="background-color:#36648B; padding:3px ; margin: 1px;  border:1px solid#fff ; border-radius:5px 0px 5px 0px;">
<tr>
	<td>
	# Remision&nbsp;<input align="right" readonly="readonly" type="text" name="numremision" value="
<?php

@$numremision = $_POST['numremision'];

if (isset($numremision) && !empty ($numremision))
{echo"$numremision";}

elseif(isset($_POST['rfc']) && !empty($_POST['rfc'])) 
{
$fp = fopen("idremision.txt", "r+") ;
$idremision = fgets($fp, 7) ;
$idremision++;
rewind($fp);
fputs($fp, "$idremision");
fclose($fp);
echo"$idremision";
}
?>
">
</td>
</tr>
</table>


<?php
@$rfc = $_POST['rfc'];

if  (isset($rfc) && !empty($rfc))
{
require_once("conexion.php");
$select1 = "SELECT * FROM clientes WHERE rfc='$rfc' ";
$query1 = mysql_query($select1) or die("No se pudo ejecutar debido a ".mysql_error()) ;
$row = mysql_fetch_assoc($query1);
}

if(@$query1)
{
echo<<<formulario
<table id="formulario" align="left">
<tr><th style="background-color:#DDD; color:#36648B" colspan="6"><h3>Datos Cliente</h3></th></tr>

<tr>
<td>Rfc:</td><td><input type="text" name="rfc2" value="$row[rfc]" readonly="readonly"></td>
<td>Nombre:</td><td><input type="text" name="nombre2" value="$row[nombre]" readonly="readonly"></td>
<td>Tel:</td><td><input type="text" name="telefono2" value="$row[telefono]" readonly="readonly"></td>
</tr>

<tr>
<td>Calle:</td><td><input type="text" name="calle2" value="$row[calle]" readonly="readonly"></td>
<td>Colonia:</td><td><input type="text" name="colonia2" value="$row[colonia]" readonly="readonly"></td>
<td>Mun:</td><td><input type="text" name="municipio2" value="$row[municipio]" readonly="readonly"></td>
</tr>

<tr>
<td>Edo:</td><td><input type="text" name="estado2" value="$row[estado]" readonly="readonly"></td>
<td>Pais:</td><td><input type="text" name="pais2" value="$row[pais]" readonly="readonly"></td>
<td>CP:</td><td><input type="text" name="cp2" value="$row[cp]" readonly="readonly"></td>
</tr>

</table>
formulario;
}
?>

<table id="conceptos"> 

<tr><th style="background-color:#DDD; color:#36648B" colspan="7"><h3>Agrega nuevo articulo</h3></th></tr>

<tr style="text-align: center;">
<td>Clave Art</td>
<td>Unidad</td>
<td>Articulo</td>
<td>Precio Unitario</td>
<td>Cantidad</td>
<td>Precio Total</td>
</tr>

<tr>
<td><select style="width: 50px" name="clave" onchange="syncSelects(this, this.form.articulo , this.form.unidad, this.form.precio); calcular()">
<option></option>
<?php
require_once("conexion.php"); 
$selectclave = "SELECT id_art FROM articulos ORDER BY id_art ASC ";
$queryclave = mysql_query($selectclave);
while ($arrayclave = mysql_fetch_assoc($queryclave)) 
{echo "<option>$arrayclave[id_art]</option>";}
?>
</select>
</td>

<td><select style="width: 150px" name="unidad" onchange="syncSelects(this, this.form.clave , this.form.articulo, this.form.precio); calcular()">
<option></option>
<?php
require_once("conexion.php"); 
$selectunidad = "SELECT unidad FROM articulos ORDER BY id_art ASC";
$queryunidad = mysql_query($selectunidad);
while ($arrayunidad = mysql_fetch_assoc($queryunidad)) 
{echo "<option>$arrayunidad[unidad]</option>";}
?>
</select>
</td>

<td><select style="width: 228px" name="articulo" onchange="syncSelects(this, this.form.clave , this.form.unidad, this.form.precio); calcular()">
<option></option>
<?php
require_once("conexion.php"); 
$selectnombre = "SELECT nombre FROM articulos ORDER BY id_art ASC";
$querynombre = mysql_query($selectnombre);
while ($arraynombre = mysql_fetch_assoc($querynombre)) 
{echo "<option>$arraynombre[nombre]</option>";}
?>
</select>
</td>

<td>$<select style="width: 90px" name="precio" id="precio" onchange="syncSelects(this, this.form.clave , this.form.unidad, this.form.articulo); calcular()" >
<option></option>
<?php
require_once("conexion.php"); 
$selectprecio = "SELECT precio FROM articulos ORDER BY id_art ASC";
$queryprecio = mysql_query($selectprecio);
while ($array2 = mysql_fetch_assoc($queryprecio)) 
{
echo "<option>$array2[precio]</option>";
}
?>
</select>
</td>

<td><input type="text" style="width: 80px" id="cantidad" name="cantidad" 
value="1
<?php
// @$cantidad = $_POST['cantidad'];
// if(isset($cantidad)){echo"$_POST[cantidad]";}
// else{echo"1";}
	?>"
onkeypress='javascript: calcular();'  onkeyup='javascript: calcular();'  onblur='javascript: calcular();' onfocus='javascript: calcular();'></td>

<td>$<input id="subtotal" type="text" style="width: 80px" name="preciototal" value="
<?php
// @$preciototal = $_POST['preciototal'];
// if(isset($preciototal)){echo"$_POST[preciototal]";}
//else{echo"0";}
    ?>"
onkeypress='javascript: calcular();'  onkeyup='javascript: calcular();'  onblur='javascript: calcular();' onfocus='javascript: calcular();'></td>

<td><input type="Submit" value="Agregar Articulo" onclick='$("#conceptos").toggle(0);'></td>
</tr>
</table>

<?php

@$rfc2 = $_POST['rfc2'];
@$clave = $_POST['clave'];
@$unidad = $_POST['unidad'];
@$articulo = $_POST['articulo'];
@$precio = $_POST['precio'];
@$cantidad = $_POST['cantidad'];
@$date = date('Y-m-d');
@$preciototal = $_POST['preciototal'];

if (
isset($rfc2) &&	!empty($rfc2) &&
isset($clave) &&	!empty($clave) &&
isset($unidad) &&	!empty($unidad) &&
isset($articulo) &&	!empty($articulo) &&
isset($precio) &&	!empty($precio) &&
isset($cantidad) &&	!empty($cantidad) && $cantidad >= 1 &&
isset($preciototal) &&	!empty($preciototal)
)

{

require_once("conexion.php");

$insert = "INSERT INTO `tiendita`.`facturas` 
(`fecha` , `rfccliente` , `usuario` , `numfac` )
VALUES ('$date', '$rfc2', '$_SESSION[user]' , '$_POST[numremision]' ) " ;

$insert2 = "INSERT INTO `tiendita`.`conceptos` 
(`numremision` , `ClaveArt` , `Unidad` , `Articulo` , `PrecioUnitario` , `CantidadArt` , `PrecioTotal` )
VALUES ('$numremision', '$clave' , '$unidad' , '$articulo', '$precio' , '$cantidad' , '$preciototal') " ;

if (mysql_query($insert)){}


if (mysql_query($insert2))
{echo "<script type='text/javascript'>alert('Articulo ingresado con exito!!!');</script>";}


echo<<<formulario
<table style="background-color:#36648B; border-radius:3px ; padding:3px ; margin: 1px;  border:1px solid#fff;" cellspacing="1px">
<tr><th style="background-color:#DDD; color:#36648B" colspan="6"><h3>Articulos Factura</h3></th></tr>
formulario;



$sql = "SELECT ClaveArt , Unidad , Articulo , PrecioUnitario , CantidadArt , PrecioTotal FROM conceptos WHERE numremision = '$numremision' ";
$resultado = mysql_query($sql);
$Subtotal = 0;

while ($row = mysql_fetch_assoc($resultado)) 
{
echo<<<formulario
<tr>
<td style="border:0px; margin:0px; pading:0px"><input style="width: 50px;" type="text" value="$row[ClaveArt]"></td>
<td style="border:0px; margin:0px; pading:0px"><input style="width: 140px" type="text" value="$row[Unidad]"</td>
<td style="border:0px; margin:0px; pading:0px"><input style="width: 218px" type="text" value="$row[Articulo]"</td>
$<td style="border:0px; margin:0px; pading:0px"><input style="width: 78px" type="text" value="$row[PrecioUnitario]"</td>
<td style="border:0px; margin:0px; pading:0px"><input style="width: 78px" type="text" value="$row[CantidadArt]"</td>
$<td style="border:0px; margin:0px; pading:0px"><input style="width: 80px" type="text" value="$row[PrecioTotal]"</td>
</tr>
formulario;

$Subtotal = $Subtotal + $row['PrecioTotal'];
}

mysql_close($con);

$iva = $Subtotal * .16 ;
$total = $Subtotal * 1.16;

echo<<<formulario
<tr><td colspan="5" style="border:0px; text-align:right">Subtotal</td><td style="border:0px; text-align:left"><input style="width: 80px" type="text" value="$Subtotal"></td></tr>
<tr><td colspan="5" style="border:0px; text-align:right">IVA</td><td style="border:0px; text-align:left"><input style="width: 80px" type="text" value="$iva"></td></tr>
<tr><td colspan="5" style="border:0px; text-align:right">Total</td><td style="border:0px; text-align:left"><input style="width: 80px" type="text" value="$total"></td></tr>
</table>

formulario;

}


?>






</form>
</div> <!-- termina div cuerpo-->

</body>

</html>
