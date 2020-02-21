<!DOCTYPE html>
<html>
    <head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="../../js/mascara.js" type="application/javascript"></script>
<script src="../../js/jquery.min.js" type="application/javascript"></script>
<script src="../../js/jquery.maskedinput.js" type="application/javascript"></script>


<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  alert('******Somente Números*******')
	return false;
    }
}
</script>


<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../../js/mascara.js"></script>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Arial", sans-serif}

* {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#444;
}
h1 {
	font-size:18px;
}
fieldset{
	border:1px solid #ccc;
	border-radius:4px;
}
legend {
	font-weight:bold;
	font-size:13px;
}
a {
	text-decoration:none;
}
a:hover {
	color:#777;
	text-decoration:underline;
}

#linha1, #linha2, #linha3 {
	border-bottom:1px solid #000;
	width:100%;
	height:20px;
}
</style>

<script>
function Impressao( preVisualizar ) 
{
	var CorpoMensagem = document.body.innerHTML;
	document.body.innerHTML = ImprimirConteudo.innerHTML;
	if( preVisualizar ) 
	{
		PreVisualizar();
	} 
	else 
	{
		window.print();
	}
	document.body.innerHTML = CorpoMensagem;
}
 
function PreVisualizar() 
{
	try 
	{
		 //Utilizando o componente WebBrowser1 registrado no MS Windows Server 2000/2003 ou XP/Vista
		 var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
		 document.body.insertAdjacentHTML('beforeEnd', WebBrowser); 
		 WebBrowser1.ExecWB( 7, 1 ); 
		 WebBrowser1.outerHTML = ""; 
	} 
	catch(e) 
	{
		alert("Para visualizar a impressão você precisa habilitar o uso de controles ActiveX na página.");
		return;
	}
}
</script>

</head>
<body>

<div class="col-sm-12" style="padding-top:20px;">

<?Php
require "../../../../../config/config.php";

$id = $_GET['codigo'];

mysql_select_db($database_ellevar, $ellevar);
$query_comprovante = "SELECT * FROM sps_pagamentos WHERE pag_id='$id'";
$comprovante = mysql_query($query_comprovante, $ellevar) or die(mysql_error());
$row_comprovante = mysql_fetch_assoc($comprovante);
$totalRows_comprovante = mysql_num_rows($comprovante);

$id_afiliado = $row_comprovante['pag_afiliado_id'];

mysql_select_db($database_ellevar, $ellevar);
$query_afiliado = "SELECT * FROM sps_afiliados WHERE afiliado_id='$id_afiliado'";
$afiliado = mysql_query($query_afiliado, $ellevar) or die(mysql_error());
$row_afiliado = mysql_fetch_assoc($afiliado);
$totalRows_afiliado = mysql_num_rows($afiliado);

?>


<div id="ImprimirConteudo" style="padding-left:20px; font-size:12px;">
    
    <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="26%" align="left" valign="middle"><img src="../../../img/marca.png" width="80%" /></td>
    <td width="74%" align="right" valign="middle"><h3>Comprovante de Pagamento</strong></h3>
  <h4>Via Conta Acessomundi</h4></td>
  </tr>
</table><br><br>
  
  <fieldset style="width:100%;">
  <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="26%"><strong>Nome:<br />
    </strong></td>
    <td width="74%">
        <?php
             
                $idAssociado = $row_afiliado['afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }
        
        ?></td>
  </tr>
  <tr>
    <td><strong>Número da Conta Acessomundi</strong></td>
    <td><?php echo $row_afiliado['afiliado_id']; ?></td>
  </tr>
</table>

  </fieldset><br />
  
  
  <fieldset style="width:100%;">
  <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td><strong>Representação númerica do código de Barras</strong></td>
  </tr>
  <tr>
    <td><?php echo $row_comprovante['pag_codigo']; ?></td>
  </tr>
</table>

  </fieldset><br />
  
  <fieldset style="width:100%;">
  <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="26%"><strong>Vencimento</strong></td>
    <td width="74%"><?php echo $row_comprovante['pag_vencimento']; ?></td>
  </tr>
  <tr>
    <td><strong>Valor</strong></td>
    <td><?php echo number_format($row_comprovante['pag_valor'],2,",","."); ?></td>
  </tr>
  <tr>
    <td><strong>Descri&ccedil;&atilde;o</strong></td>
    <td><?php echo $row_comprovante['pag_descricao']; ?></td>
  </tr>
</table>

  </fieldset><br />
  
  <fieldset style="width:100%;">
  <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="26%"><strong>Data Pagamento</strong></td>
    <td width="74%"><?php echo $row_comprovante['pag_dia_pagamento']; ?>/<?php echo $row_comprovante['pag_mes_pagamento']; ?>/<?php echo $row_comprovante['pag_ano_pagamento']; ?></td>
  </tr>
  <tr>
    <td width="26%"><strong>Hora Pagamento</strong></td>
    <td width="74%"><?php echo $row_comprovante['pag_hora_pagamento']; ?></td>
  </tr>
</table>

  </fieldset><br />
  
  <fieldset style="width:100%;">
   <table width="100%" border="0" cellspacing="5" cellpadding="2">
  <tr>
    <td width="26%"><strong>Autenticação Bancária</strong></td>
    <td width="74%"><?php echo $row_comprovante['pag_obs']; ?></td>
  </tr>
</table>    

  </fieldset><br />
  
  <h4>Operação realizada com sucesso</h4>
  
  <strong>Informações:</strong> financeiro@acessomundi.com<br />
  <strong>Atendimento On-Line:</strong> https://www.acessomundi.com</div>

<br>

<a href="javascript:Impressao( false );"><button name="imprimir" class="btn btn-primary" type="button"><i class="fa fa-print" style="color:#fff;"></i> Imprimir</button></a><br><br>
</div>


</body>
</html>