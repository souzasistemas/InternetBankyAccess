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

<SCRIPT LANGUAGE="JavaScript">   

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

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);

$emailEmpresa4 = $verEmpresa['logo_financeiro'];

$emailsender = $verEmpresa['logo_emailsender'];
$tipo = $_POST['tipo'];
$codigo = $_POST['codigo'];
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$vencimento = $_POST['data'];
$descricao = $_POST['descricao'];
$senha = $_POST['senha'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));

if($tipo == "1"){
	$nomeBoleto = "Boleto Diversos";
	$nomeBoleto2 = "Boleto Diversos";
}elseif($tipo == "2"){
	$nomeBoleto = "Agua, Luz e Telefone";
	$nomeBoleto2 = "Água, Luz e Telefone";
}elseif($tipo == "3"){
	$nomeBoleto = "Cartao de Credito ou Outros Pagamentos";
	$nomeBoleto2 = "Cartão de Crédito ou Outros Pagamentos";
}

date_default_timezone_set('Brazil/East');
$dataCompleta = date('d/m/Y H:i:s');
$data = date('d/m/Y');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$horario = date('H:i:s');
$horario2 = date("His");

function makeRandomCartao3(){
	$salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789876543210";
	srand((double)microtime()*1000000);
	$i = 0;
	
	while($i <= 12){
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$cartao3 = makeRandomCartao3();

$protocolo = "$dia$mes$ano$horario2$cartao3";

if($hora < '22:00:00'){
	$dia_venc = $dia;
	$mes_venc = $mes;
	$ano_venc = $ano;
}else{
	$dias_de_prazo_para_pagamento = 1;
	$dia_venc = date("d", time() + ($dias_de_prazo_para_pagamento * 86400));
	$mes_venc = date("m", time() + ($dias_de_prazo_para_pagamento * 86400));
	$ano_venc = date("Y", time() + ($dias_de_prazo_para_pagamento * 86400));
}

if($senha == ""){
    echo "<script>history.back(-1);alert('Digite seu PIN!');</script>";
}elseif($ver['afiliado_pin'] == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
    echo "<script>location.href='pagamento.php?id=".$id."&&empresa=".$empresa."';alert('Você precisa cadastrar seu PIN para realizar essa transação!');</script>";
}elseif($senhaCrypt != $ver['afiliado_pin']){
    echo "<script>location.href='pagamento.php?id=".$id."&&empresa=".$empresa."';alert('Pin Incorreto!');</script>";
}elseif($valor > $saldoGeral){
    echo "<script>location.href='pagamento.php?id=".$id."&&empresa=".$empresa."';alert('Deculpe! Você não posssui saldo para realizar esse pagamento!');</script>";
}else{


$inserirBoleto = mysqli_query($conexao, "INSERT INTO sps_pagamentos (pag_afiliado_id, pag_tipo, pag_codigo, pag_vencimento, pag_valor, pag_dia_pagamento, pag_mes_pagamento, pag_ano_pagamento, pag_hora_pagamento, pag_descricao, pag_status, pag_status_operador, pag_autenticador, pag_obs) VALUES ('$id', '$nomeBoleto', '$codigo', '$vencimento', '$valor', '$dia_venc', '$mes_venc', '$ano_venc', '$horario', '$descricao', 'Realizado', 'Pendente', 'Aguardando Pagamento.........', '$protocolo')");



if($inserirBoleto == "1"){

/** Debitar boleto */
$Taxa1 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$id', '$valor', 'Retirada', 'PAGAMENTO DE CONTAS PESSOAIS', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')");

if($id == $contaTeste){
    
}else{

  
$Taxa2 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$idReservaBoletos', '$valor', 'Recarga', 'RESERVA SOBRE O PAGAMENTO DE CONTAS: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')");    

 

$assunto = "Solicitação de Pagamento de Contas";
$email = $ver['afiliado_email'];

$mensagemHTML = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$name.'</strong>,<br><br>

<strong>Seu pedido do pagamento de contas foi realizado com sucesso!</strong><br><br>
	Abaixo segue os dados de seu pedido:<br><br>
	<strong>Tipo de Boleto:</strong>&nbsp;&nbsp; '.$nomeBoleto2.'<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; '.$dia.'/'.$mes.'/'.$ano.'<br>
	<strong>Previsão para resposta: 48hs úteis <br><br>
	<strong>Valor do Boleto:</strong>&nbsp;&nbsp; '.number_format($valor,2,",",".").'<br>
	<strong>Vencimento:</strong>&nbsp;&nbsp; '.$vencimento.'<br><br>

Atenciosamente<br><br>

Departamento Financeiro
</div>
';


$mensagemHTML1 = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$verEmpresa['logo_fantasia'].'</strong>,<br><br>

<font style="font-size:18px; font-family:Arial;">
Eu, <strong>'.$name.' ('.$id.'-'.$ver['afiliado_codigo'].')</strong><br>
Solicito pagamento de minha Boleto solicitado pela conta '.$verEmpresa['logo_fantasia'].'.<br><br>
Segue informações:<br><br>
<strong>Tipo de Boleto:</strong>&nbsp;&nbsp; '.$nomeBoleto2.'<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; '.$dia.'/'.$mes.'/'.$ano.'<br>
	<strong>Previsão para resposta: 48hs úteis <br><br>
	<strong>Valor do Boleto:</strong>&nbsp;&nbsp; '.number_format($valor,2,",",".").'<br>
	<strong>Vencimento:</strong>&nbsp;&nbsp; '.$vencimento.'<br><br>

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

mail($emailEmpresa4, $assunto, $mensagemHTML1, $headers1, "-r". $emailsender);
}

?>


<div class="w3-container">
<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:14px;">
<?Php
echo '<strong>Seu pedido do pagamento de contas foi realizado com sucesso!</strong><br><br>
	Abaixo segue os dados de seu pedido:<br><br>
	<strong>Tipo de Boleto:</strong>&nbsp;&nbsp; '.$nomeBoleto2.'<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; '.$dia.'/'.$mes.'/'.$ano.'<br>
	<strong>Previsão para resposta: 48hs úteis <br><br>
	<strong>Valor do Boleto:</strong>&nbsp;&nbsp; '.number_format($valor,2,",",".").'<br>
	<strong>Vencimento:</strong>&nbsp;&nbsp; '.$vencimento.'
	';
echo '</div><br>';
?>    

<table style="width:100%;">
    
    <tr>
        <td style="width:50%; text-align:right;"><a href="pagamento_consultar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-input w3-blue btn-lg w3-padding-16" style="margin-bottom:5px; width:98%;"><i class="fa fa-barcode"></i> Consultar </button></a> </td>
        <td style="width:50%; text-align:left;"><a href="pagamento_novo.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-teal w3-input btn-lg w3-padding-16" style="margin-bottom:5px"><i class="fa fa-barcode"></i>  Novo</button></a></td>
        
    </tr>
</table> 
  
<?Php
}else{
    echo "<script>location.href='pagamento.php?id=".$id."&&empresa=".$empresa."';alert('Desculpe! Não foi possível realizar essa transação!');</script>";
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