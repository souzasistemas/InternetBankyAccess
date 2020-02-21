<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];

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

$servico = $tarifaSaque;
$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto - $servico;

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

/** quantidade de saques solicitados */
$sqlSolicitacoes = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$solicitacoes = mysqli_num_rows($sqlSolicitacoes);
    $limiteSolicitacao = "3";
    $quatidadedisponivel = $limiteSolicitacao - $solicitacoes;


$sqlSolicitacoes2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$verSolicitacoes2 = mysqli_fetch_array($sqlSolicitacoes2);
    $totalSolicitado = $verSolicitacoes2['sum(extrato_valor)'];
    
if($saldoGeral > "5000"){
    $limite = 5000 - $totalSolicitado;
}elseif($saldoGeral <= "5000"){
    $limite = $saldoGeral;
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

<SCRIPT LANGUAGE="JavaScript">   

//-->   
$().ready(function(){
var xTriggered = 0;
$( "#passReal" ).keyup(function( event ) {
  $('#pass').val($('#passReal').val());
  console.log( event );
});
$( "#pass" ).focus(function() {
  $('#passReal').focus();
});
  
  });
</script>

<style type="text/css">
    input#passReal{
  width:1px;
  height:10px;
}
input#pass {
    position: absolute;
    width:91%;
}
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

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$valor = $_POST['valor'];
$senha = $_POST['senha'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));
$taxa = $_POST['taxa'];
$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$favorecido = strtoupper($_POST['favorecido']);
$documento = $_POST['documento'];
$servico = strtoupper($_POST['servico']);
$tipo = strtoupper($_POST['tipo']);
$descricao = strtoupper($_POST['descricao']);
$salvar = $_POST['salvar_favorecido'];

$sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$banco'");
$verBanco = mysqli_fetch_array($sqlBanco);

date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$dias_de_prazo_para_pagamento = 2;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento * 86400));

$protocolo = "$id$ano$mes$dia$hora$min$seg";

$modalidade = $_POST['modalidade'];


if($modalidade == "1"){
    $modoTransferencia = "Transferência Bancária";
    $descricaoModo = "DOC/TED PARA ".strtoupper($verBanco['banco_nome'])." AG: ".$agencia." CONTA: ".$conta." - ".$descricao."";
    $previsao = "Em até 48hs úteis";
}

if($senha == ""){
    echo "<script>history.back(-1);alert('Digite seu PIN!');</script>";
}elseif($senhaCartao == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
    echo "<script>location.href='retirada2.php?id=".$id."';alert('Você precisa cadastrar seu PIN para realizar essa transação!');</script>";
}elseif($senhaCrypt != $ver['afiliado_pin']){
    echo "<script>location.href='retirada2.php?id=".$id."';alert('Pin Incorreto!');</script>";
}else{


$sqlSolicitacoes = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$solicitacoes = mysqli_num_rows($sqlSolicitacoes);
    $limiteSolicitacao = "3";
    $quatidadedisponivel = $limiteSolicitacao - $solicitacoes;

$sqlSolicitacoes2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$verSolicitacoes2 = mysqli_fetch_array($sqlSolicitacoes2);
    $totalSolicitado = $verSolicitacoes2['sum(extrato_valor)'];

if($saldoGeral > "5000"){
    $limite = 5000 - $totalSolicitado;
}elseif($saldoGeral <= "5000"){
    $limite = $saldoGeral - $taxa;
}


if($solicitacoes >= $limiteSolicitacao){
    echo "<script>location.href='retirada2.php?id=".$id."';alert('DESCULPE! TOTAL MÁXIMO DE 3 SOLICITAÇÕES DIÁRIA');</script>";
}elseif($totalSolicitado >= "5000"){
    echo "<script>location.href='retirada2.php?id=".$id."';alert('DESCULPE! LIMITE DIÁRIO JÁ UTILIZADO!');</script>";
}else{
    


$efetuar = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_protocolo, extrato_status_saque, extrato_modo_saque, extrato_tipo_modo) VALUES ('$id', '$valor', 'Retirada', '$descricaoModo', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', '$protocolo', 'Pendente', '$modoTransferencia', 'Retirada')");
    

if($efetuar == "1"){
if($id == $contaTeste){

$inserir = mysqli_query($conexao, "INSERT INTO sps_retiradas(retirada_afiliado_id, retirada_protocolo, retirada_valor, retirada_banco, retirada_agencia, retirada_conta, retirada_tipo, retirada_modo, retirada_favorecido, retirada_documento, retirada_dia, retirada_mes, retirada_ano, retirada_data, retirada_hora, retirada_previsao, retirada_status) VALUES ('$id', '$protocolo', '$valor', '$banco', '$agencia', '$conta', '$tipo', '$servico', '$favorecido', '$documento', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', '$previsao', 'Pendente')");

}else{
/********************************* RELAÇÃO DE CONTAS ADM ***********************************************************/
  


/****************************************** FIM RELAÇÃO DE CONTAS ADM *************************************************************/

/** Debitar Taxa */
$Taxa1 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$id', '$taxa', 'Retirada', 'TARIFA SOBRE A SOLICITAÇÃO DE RETIRADA', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);
$Taxa2 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$empresa', '$taxa', 'Recarga', 'TARIFA SOBRE SOLICITAÇÃO DE RETIRADA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);


$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
    $idParceiro = $verEmpresa['logo_taxa'];
    
    $divisaoTaxa = $taxa * 0.5;

/** DIVIDIR TAXA */
$Taxa3 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$empresa', '$divisaoTaxa', 'Retirada', 'REPASSE TARIFA SOBRE A SOLICITAÇÃO DE RETIRADA', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);
$Taxa4 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$idParceiro', '$divisaoTaxa', 'Recarga', 'REPASSE TARIFA SOBRE SOLICITAÇÃO DE RETIRADA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);

$inserir = mysqli_query($conexao, "INSERT INTO sps_retiradas(retirada_afiliado_id, retirada_protocolo, retirada_valor, retirada_banco, retirada_agencia, retirada_conta, retirada_tipo, retirada_modo, retirada_favorecido, retirada_documento, retirada_dia, retirada_mes, retirada_ano, retirada_data, retirada_hora, retirada_previsao, retirada_status) VALUES ('$id', '$protocolo', '$valor', '$banco', '$agencia', '$conta', '$tipo', '$servico', '$favorecido', '$documento', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', '$previsao', 'Pendente')");

if($salvar == "Salvar"){
    $inserir2 = mysqli_query($conexao, "INSERT INTO sps_banco_favorecido(favorecido_afiliado_id, favorecido_nome, favorecido_documento, favorecido_banco, favorecido_agencia, favorecido_conta, favorecido_tipo, favorecido_servicos) VALUES ('$id', '$favorecido', '$documento', '$banco', '$agencia', '$conta', '$tipo', '$servico')");
}

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);

$emailsender = $verEmpresa['logo_emailsender'];
$emaildestinatario = $verEmpresa['logo_financeiro'];
$assunto = "Solicitação de DOC/TED";
$email = $ver['afiliado_email'];

$mensagemHTML = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$name.' ('.$id.'-'.$ver['afiliado_codigo'].'),<br><br>

<strong>Seu pedido de DOC/TED foi realizado com sucesso!</strong><br><br>
	Abaixo segue os dados de seu pedido:<br><br>
	<strong>Protocolo:</strong>&nbsp;&nbsp; '.$protocolo.'<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; '.$dia.'/'.$mes.'/'.$ano.'<br>
	<strong>Previsão para o repasse: '.$previsao.' <br><br>
	<strong>Valor solicitado: </strong>R$ '.number_format($valor,2,",",".").'<br><br>

<strong>Dados Bancários:</strong><br>
<strong>Banco: </strong>'.$verBanco['banco_codigo'].' - '.strtoupper($verBanco['banco_nome']).'<br>
<strong>Agência: </strong>'.$agencia.'<br>
<strong>Conta: </strong>'.$conta.'<br>
<strong>Tipo: </strong>'.$tipo.'<br>
<strong>Modo: </strong>'.$servico.'<br>
<strong>Favorecido: </strong>'.$favorecido.'<br>
<strong>CPF/CNPJ: </strong>'.$documento.'<br>
<strong>Descricao: </strong>'.$descricao.'<br><br>
Atenciosamente<br><br>

Departamento Financeiro
</div>
';


$mensagemHTML1 = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$verEmpresa['logo_fantasia'].'</strong>,<br><br>

<font style="font-size:18px; font-family:Arial;">
Eu, <strong>'.$name.' ('.$id.'-'.$ver['afiliado_codigo'].')</strong><br>
Solicito transferência via DOC/TED de minha conta '.$verEmpresa['logo_fantasia'].' para uma conta descrita abaixo.<br><br>
Segue informações:<br><br>
<strong>Valor solicitado: </strong>R$ '.number_format($valor,2,",",".").'<br><br>

<strong>Dados Bancários:</strong><br>
<strong>Banco: </strong>'.$verBanco['banco_codigo'].' - '.strtoupper($verBanco['banco_nome']).'<br>
<strong>Agência: </strong>'.$agencia.'<br>
<strong>Conta: </strong>'.$conta.'<br>
<strong>Tipo: </strong>'.$tipo.'<br>
<strong>Modo: </strong>'.$servico.'<br>
<strong>Favorecido: </strong>'.$favorecido.'<br>
<strong>CPF/CNPJ: </strong>'.$documento.'<br><br>

<strong>Protocolo:</strong>&nbsp;&nbsp; '.$protocolo.'<br><br>


<strong>Saque solicitado em</strong>: '.$dia.'/'.$mes.'/'.$ano.'</font>;<br>
<strong>Previsão para repasse</strong>: '.$previsao.'</font>;<br><br>

Atenciosamente<br><br>

'.$name.' ('.$id.'-'.$ver['afiliado_codigo'].')
</div>
';




/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers .= "Reply-To: ".$emailsender.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($email, $assunto, $mensagemHTML, $headers, "-r". $emailsender);


/* Montando o cabeçalho da mensagem */
$headers1 = "MIME-Version: 1.1".$quebra_linha;
$headers1 .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers1 .= "From: ".$emailsender.$quebra_linha;
$headers1 .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers1 .= "Reply-To: ".$emailsender.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario, $assunto, $mensagemHTML1, $headers1, "-r". $emailsender);

}

?>



<div class="w3-container">

<div class="w3-text-gray w3-light-gray w3-padding w3-round" style="font-size:12px;">

<?Php
echo "<strong>Seu pedido de retirada foi realizado com sucesso!</strong><br><br>
	Abaixo segue os dados de seu pedido:<br><br>
	<strong>Protocolo:</strong>&nbsp;&nbsp; ".$protocolo."<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; ".$dia."/".$mes."/".$ano."<br>
	<strong>Previsão para repasse:</strong>&nbsp;&nbsp; ".$previsao."<br><br>
	<strong>Valor Solicitado:</strong>&nbsp;&nbsp; ".number_format($valor,2,",",".")."<br><br>
	<strong>Dados Bancários:</strong><br>
<strong>Banco: </strong>".$verBanco['banco_codigo']." - ".strtoupper($verBanco['banco_nome'])."<br>
<strong>Agência: </strong>".$agencia."<br>
<strong>Conta: </strong>".$conta."<br>
<strong>Tipo: </strong>".$tipo."<br>
<strong>Modo: </strong>".$servico."<br>
<strong>Favorecido: </strong>".$favorecido."<br>
<strong>CPF/CNPJ: </strong>".$documento."<br>
<strong>Descricao: </strong>".$descricao."<br><br>
	";
?>    
</div><br>
<a href="retirada2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" name="avançar" class="w3-input w3-blue w3-padding-16 w3-round" style="margin-bottom:2px; font-size:18px;"><i class="fa fa-money-bill-wave"></i> Nova Retirada</button>
<?Php
}else{
    echo "<script>location.href='retirada2.php?id=".$id."&&id=".$empresa."';alert('Desculpe! Não foi possível realizar essa transação!');</script>";
}
}    
}
?>
</div>






<div id="sair" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-3 w3-shadow" style="height:150px; width:100px; border-radius:10px">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <center><h3>Deseja Realmente Sair?</h3>
        </header>
        <center><br>
        <table style="width:98%; margin-top:10px;">
<tr>
<td style="border:none; text-align:left; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-red w3-padding-16" onclick="document.getElementById('sair').style.display='none'"><i class="fa fa-times" aria-hidden="true"></i> NÃO</button></td>
<td style="border:none; text-align:right; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-green w3-padding-16" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>'"><i style="font-size:16px;" class="fa fa-check" aria-hidden="true"></i> SIM</button></td>
</tr>
</table></center>
    </div>
</div>
</body>
</html>

<?Php
}
}
?>