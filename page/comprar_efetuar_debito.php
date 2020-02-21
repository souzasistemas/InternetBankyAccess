<?Php
session_start();

$id = $_GET['id'];


require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];
    $pin = $ver['afiliado_pin'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     


if($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{
    


/***** saldo em conta */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$ver_credito2 = mysqli_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysqli_query($conexao, "SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysqli_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$ver_debito2 = mysqli_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];

$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;

date_default_timezone_set('Brazil/East');
$hora_do_dia = date('H');

if(($hora_do_dia >=6) && ($hora_do_dia <=12)){
	$saudacao = "Bom Dia!";
}elseif(($hora_do_dia >12) && ($hora_do_dia <=18)){
	$saudacao = "Bom Tarde!";
}elseif(($hora_do_dia >18) && ($hora_do_dia <=23)){
	$saudacao = "Boa Noite!";
}elseif(($hora_do_dia >=0) && ($hora_do_dia <6)){
	$saudacao = "Boa Madrugada!";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<title><?Php echo $nomeEmpresa; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
<link rel="icon" href="../img/<?Php echo $icone; ?>">
<link rel="shortcut icon" href="../img/<?Php echo $icone; ?>">
        
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>


<style type="text/css">
html, body, div{
	font-family: "Ubuntu", sans-serif;
	font-size:14px;
    background-repeat:no-repeat;
}
html, body{
    height:100%;
}
iframe#iframe{
    height:88%;
}

#principal::-webkit-scrollbar-track {
    background-color: #222;
}
#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
#principal::-webkit-scrollbar-thumb {
    background: #555;
}


</style>
</head>

<body id="principal">
<br><br>

<?Php
$loja = $_POST['loja'];
$senha = $_POST['senha'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));
$consultor = $_POST['corretor'];
$descricao = $_POST['descricao'];
$empresa = $_POST['empresa'];

$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

/*** identificar loja  */
$sqlLoja = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$loja'");
$verLoja = mysqli_fetch_array($sqlLoja);
	$mcc = $verLoja['afiliado_segmento'];
	$bonus = $verLoja['afiliado_bonus'];
	$fantasia = $verLoja['afiliado_fantasia'];
	
/** ver segmento */
$sqlSegmento = mysqli_query($conexao, "SELECT * FROM sps_segmento WHERE segmento_mmc='$mcc'");
$verSegmento = mysqli_fetch_array($sqlSegmento);
	$taxa = $verSegmento['segmento_debito'];
	
$bonusAfiliado = $valor * $bonus;

/***base comissaoAfiliado */
$base1 = $valor * $taxa;
$base2 = 0.12;
$comissaoAfiliado = ($base1 - $base2) * 0.3;

$totalTaxa = $base1 + $base2;

$valorRepasse = $valor - $totalTaxa - $bonusAfiliado;

$SaldoTaxa = $totalTaxa + $bonusAfiliado;

$comissaoAport = $totalTaxa * 0.010;


date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$autorizacao = "$loja$dia$mes$ano2$id$hora$min$seg";

/** PREVISÃO DE REPASSE */
$dias_de_prazo_para_pagamento2 = 1;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));



if($saldoGeral < $valor){
?>



<div class="w3-container">
    
<?Php
	echo "<br><br><center><h2>Você não possui saldo para realizar essa transação!</h2><br>
	<a href='comprar2.php?id=".$id."&&empresa=".$empresa."'><input size='14' type='button' name='enviar' value='Cancelar' /></a></center>";
}else{


$senhaMestre = sha1(md5(sha1(base64_encode(md5('5628')))));


if($pin != $senhaMestre){
	
if($senhaCrypt == $pin){
	
$inserirVenda = mysqli_query($conexao, "INSERT INTO sps_movimentacao(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano) VALUES ('$id', '$loja', 'TEFI', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '1', '$valor', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$autorizacao', 'Em Aberto', '$data_dia', '$data_mes', '$data_ano')");



if($inserirVenda == "1"){


$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
 $taxaEmpresa = $verEmpresa['logo_taxa'];
 
 
/*** venda afiliado **/
$DebitarVenda = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$id', '$valor', 'Retirada', '$descricao - estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Debito')");

$InserirVenda = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$taxaEmpresa', '$valor', 'Taxa', 'Venda $descricao - estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Credito')");


if($consultor == $empresa){
    
}else{
/*** Taxa Administrativa Corretor */
$inserirConsultor = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano',  'Credito')");
$DebitarConsultor = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$taxaEmpresa', '$comissaoAfiliado', 'Retirada', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Debito')");
}



/*** Taxa Administrativa Souza Sistemas */
$inserirConsultor = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$taxaEmpresa', '$comissaoAport', 'Taxa', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano',  'Credito')");
$DebitarConsultor = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$taxaEmpresa', '$comissaoAport', 'Retirada', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Debito')");

/*** cashBack Afiliado */
$inserirConsultor2 = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Comissao', 'CASHBACK estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Credito')");
$inserirConsultor22 = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_data, extrato_tipo) VALUES ('$taxaEmpresa', '$bonusAfiliado', 'Retirada', 'CASHBACK por movimentação no estabelecimento $loja - $fantasia para o afiliado $id', '$dia', '$mes', '$ano', '$horario', '$dia/$mes/$ano', 'Debito')");


/***** comprovante via estabelecimento */

$sqlVendas = mysqli_query($conexao, "SELECT * FROM sps_movimentacao WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysqli_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id_lojista'");
$row_loja = mysqli_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysqli_fetch_array($sqlUsuarios);


?>
<div class="w3-container" style="width:400px;">

<table width="100%" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td colspan="2" align="center" valign="middle"><b><?Php echo $fantasia; ?></b></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle" width="256" ><strong> <?Php echo $verLoja['afiliado_site']; ?></strong></td>
  </tr>

  <tr>
    <td colspan="2" align="center" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - DÉBITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  <tr>
    <td>Estabelecimento</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['afiliado_fantasia']; ?></strong></td>
  </tr>
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  <tr>
    <td>Valor</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconheço o débito acima realizado neste estabelcimento</td>
  </tr>
  
  
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
  
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
  
</table><br>

<a href="comprar2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-input w3-blue btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Realizar Nova Compra</button></a>  

</div>
<?Php		
		
}else{

	echo "<br><br><center><h2>Pagamento não realizada! Entrar em contato com a Administradora</h2><br>
	<a href='principal.php?id=".$id."&&empresa=".$empresa."'><input size='14' type='button' name='enviar' value='Cancelar' /></a></center>";
}



}else{
	echo "<br><br><center><h2>PIN Incorreto!</h2><br>
	<a href='principal.php?id=".$id."&&empresa=".$empresa."'><input size='14' type='button' name='enviar' value='Cancelar' /></a></center>";
}
}else{
    
	echo "<br><br><center><h2>Você ainda não cadastrou seu PIN para realizar essa operação!</h2><br>
	<a href='principal.php?id=".$id."&&empresa=".$empresa."'><input size='14' type='button' name='enviar' value='Cancelar' /></a></center>";
}

}
?>
 
</div>


</body>
</html>

<?Php
}
?>