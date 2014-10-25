

<?php 

$con = mysql_connect("localhost","root","")or die (mysql_error()); /* nos conectamos a nuestra base de datos,  
poner su nombre de usario y contraeña( en mi caso no tengo, por eso el espacio en blanco) 
y si estan es un hosting los datos que les dio este 
*/ 
mysql_select_db("tiendita" , $con) or die (mysql_error());//aca seleccionamo el nombre de nuestra base de datos 

?>  