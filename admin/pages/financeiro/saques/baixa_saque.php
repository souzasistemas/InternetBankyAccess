<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

  <style media="print">
.botao {
display: none;
}
</style>

</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<div class="col-sm-12">

<h3>Solicita&ccedil;&otilde;es de Saques<br /></h3>

<?php 
require "../../../../config/config.php";  

$codigo = $_GET['codigo'];
$id = $_GET['id'];

date_default_timezone_set('Brazil/East');
$data = date('d/m/Y');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$hora = date('H:i:s');

$sql = mysql_query("SELECT * FROM sps_retiradas WHERE retirada_id='$codigo'");
$ver = mysql_fetch_array($sql);
    $protocolo = $ver['retirada_protocolo'];
    
$update = mysql_query("UPDATE sps_retiradas SET retirada_status='Pago' WHERE retirada_id='$codigo'");

if($update == "1"){
    $update2 = mysql_query("UPDATE sps_extrato SET extrato_status_saque='Pago' WHERE extrato_protocolo='$protocolo'");
    
	echo "<script>location.href='saques.php?id=".$id."';alert('Baixa efetuada com sucesso!');</script>";
}else{
	echo "<script>location.href='saques.php?id=".$id."';alert('Não foi possível dar baixa!');</script>";
}
?>



</div>
</body>
</html>
