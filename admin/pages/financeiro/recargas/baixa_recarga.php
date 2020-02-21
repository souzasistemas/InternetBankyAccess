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


<?php 
require "../../../../../config/config.php";

$codigo = $_GET['codigo'];

$update = mysqli_query($conexao, "UPDATE sps_recarga_celular SET recarga_status='Realizado' WHERE recarga_id='$codigo'");

if($update == "1"){
	echo "<h1 class='w3-jumbo'>Baixa efetuada com sucesso!</h1>";
}else{
	echo "<h1 class='w3-jumbo'>Não foi possível dar baixa!</h1>";
}
?>



</div>
</body>
</html>
