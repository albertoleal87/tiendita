<script type="text/javascript">
//CALCULAR
	function calcular()
        {	
        var cantidad = document.getElementById('cantidad').value;
        var precio = document.getElementById('precio').value;
        var subtotal = cantidad*precio;
       document.getElementById('subtotal').value = subtotal; 
                }
  </script>

<script type="text/javascript">
// COMBOS DINAMICOS
function syncSelects (padre , hijo1, hijo2, hijo3) 
{
hijo1.selectedIndex = padre.selectedIndex;
hijo2.selectedIndex = padre.selectedIndex;
hijo3.selectedIndex = padre.selectedIndex;
}
</script>

<script language="javascript" type="text/javascript">  
//RELOJ 12 HORAS  
  
var RelojID12 = null  
var RelojEjecutandose12 = false  
  
function DetenerReloj12 () {  
    if(RelojEjecutandose12)  
        clearTimeout(RelojID12)  
    RelojEjecutandose12 = false  
}  
  
function MostrarHora12 () {  
    var ahora = new Date()  
    var horas = ahora.getHours()  
    var minutos = ahora.getMinutes()  
    var segundos = ahora.getSeconds()  
    var meridiano  
  
    //ajusta las horas  
    if (horas > 12) {  
        horas -= 12  
        meridiano = " P.M."  
    } else {  
        meridiano = " A.M."  
        }  
              
    //establece las horas  
    if (horas < 10)  
        ValorHora = "0" + horas  
    else  
        ValorHora = "" + horas  
  
    //establece los minutos  
    if (minutos < 10)  
        ValorHora += ":0" + minutos  
    else  
        ValorHora += ":" + minutos  
              
    //establece los segundos  
    if (segundos < 10)  
        ValorHora += ":0" + segundos  
    else  
        ValorHora += ":" + segundos  
          
    ValorHora += meridiano  
    document.reloj12.digitos.value = ValorHora  
  
    //si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta  
    //window.status = ValorHora  
  
    RelojID12 = setTimeout("MostrarHora12()",1000)  
    RelojEjecutandose12 = true  
}  
  
function IniciarReloj12 () {  
    DetenerReloj12()  
    MostrarHora12()  
}  
  
window.onload = IniciarReloj12;  
if (document.captureEvents) {           //N4 requiere invocar la funcion captureEvents  
    document.captureEvents(Event.LOAD)  
}    

</script>

    <script type="text/javascript" >
    $(document).ready(function(){
    $('#date1').datepicker({
        showOn: 'both',
        buttonText: 'Selecciona una fecha',
        buttonImage: 'imagenes/calendar.png',
        buttonImageOnly: true,
        showButtonPanel: false,
    });
$('#date2').datepicker({
        showOn: 'both',
        buttonText: 'Selecciona una fecha',
        buttonImage: 'imagenes/calendar.png',
        buttonImageOnly: true,
        showButtonPanel: false,
    });
    
});
    </script>
