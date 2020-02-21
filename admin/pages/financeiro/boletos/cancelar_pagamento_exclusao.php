<?Php require '../../../../../config/config.php';  ?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo Acessomundi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  
  <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed" rel="stylesheet">
  
    <link rel="icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="shortcut icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="license" href="https://www.souzasistemas.com.br/">
  	<link rel="author" href="https://www.souzasistemas.com.br/">
  	
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	
  	<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<SCRIPT LANGUAGE="JavaScript">   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   
</script>  
  

<style type="text/css">

.container {
    padding:10px 0;
}

body#principal{
    background-color:#F4F4F4;
}
body#principal::-webkit-scrollbar-track {
    background-color: #222;
}
body#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
body#principal::-webkit-scrollbar-thumb {
    background: #555;
}

  </style>

 
</head>
<body id="principal">


<div class="container" style="padding:200px 0;">

<center>

<?Php
$id2 = $_GET['id'];
$deletar = mysqli_query($conexao, "UPDATE sps_pagamentos SET pag_status='Cancelado' WHERE pag_id='$id2'");

if($deletar == "1"){
    
$sql = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_id='$id2'");
$ver = mysqli_fetch_array($sql);

$idAssociado = $ver['pag_afiliado_id'];
$valor = $ver['pag_valor'];

/** CONFIGURAÇÃO DE HORA */
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y H:i:s');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$hora = date('H:i:s');

$insert = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAssociado', '$valor', 'Não', 'Recarga', 'EXTORNO PAGAMENTO DE CONTAS', '$dia', '$mes', '$ano', '$hora', 'Credito')", $ellevar);

	echo "<h1 class='w3-jumbo'>Boleto Excluído com sucesso</h1>";
}else{
	echo "<h1 class='w3-jumbo'>Não foi possível realizar a exclusão! Tente novamente!</h1>";
}
?>
 </center> 
 
 
</div><br>


</body>
</html>
