<?Php require "../../../../config/config.php";    ?>

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
        alert('Desculpe! Acesso n達o Autorizado!');}
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
$id = $_GET['id'];
$codigo = $_GET['codigo'];

$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysql_fetch_array($sql);
    $empresa = $ver['admin_empresa'];

$sqlRetirada = mysql_query("SELECT * FROM sps_retiradas WHERE retirada_id='$codigo'");
$verRetirada = mysql_fetch_array($sqlRetirada);
    $protocolo = $verRetirada['retirada_protocolo'];
    $idAssociado = $verRetirada['retirada_afiliado_id'];
    $valor = $verRetirada['retirada_valor'];
    
$deletar = mysql_query("UPDATE sps_retiradas SET retirada_status='Cancelado' WHERE retirada_id='$codigo'");

if($deletar == "1"){

$update2 = mysql_query("UPDATE sps_extrato SET extrato_status_saque='Cancelado' WHERE extrato_protocolo='$protocolo'");

/** CONFIGURAÇÃO DE HORA */
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y H:i:s');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$hora = date('H:i:s');

$insert = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_empresa, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$idAssociado', '$empresa', '$valor', 'Recarga', 'EXTORNO SOLICITACAO DE DOC/TEC - PROTOCOLO: $protocolo', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$hora', 'Credito')", $ellevar);

	echo "<h1 class='w3-xxlarge'>DOC/TED Extornado com sucesso</h1>";
	echo "<a href='saques.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Solicitações de Saques</button></a>";
}else{
	echo "<h1 class='w3-xxlarge'>Não foi possível realizar a exclusão! Tente novamente!</h1>";
	echo "<a href='saques.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Solicitações de Saques</button></a>";
}
?>
 </center> 
 
 
</div><br>


</body>
</html>
