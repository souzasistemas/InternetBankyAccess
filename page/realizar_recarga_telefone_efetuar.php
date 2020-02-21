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

<script type="application/javascript" src="../../js/mascara.js"></script>
<script type="application/javascript" src="../../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>


<script>
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

<body id="principal"><br>


<?Php

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);


$emailsender=$verEmpresa['logo_emailsender'];
$valor = $_POST['valor'];
$operadora = $_POST['operadora'];
$numero = $_POST['numero'];
$senha = $_POST['senha'];
$senhacrypt = sha1(md5(sha1(base64_encode(md5($senha)))));

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $correspondente = $ver['afiliado_indicador'];
    $senhaAtual = $ver['afiliado_pin'];
    
if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);    
}if($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_fantasia']);
}


if($operadora == "CLARO"){
			$simbolo = "<img src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo_claro.png' width='20px'>";
		}elseif($operadora == "TIM"){
			$simbolo = "<img src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo_tim.png' width='40px'>";
		}elseif($operadora == "VIVO"){
			$simbolo = "<img src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo_vivo.png' width='35px'>";
		}elseif($operadora == "OI"){
			$simbolo = "<img src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo_oi.png' width='20px'>";
		}elseif($operadora == "NEXTEL"){
			$simbolo = "<img src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo_nextel.png' width='50px'>";
		}
		
		
date_default_timezone_set('Brazil/East');
$dataCompleta = date('d/m/Y H:i:s');
$data = date('d/m/Y');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$horario = date('H:i:s');

if($senhaAtual == $senhacrypt){

	
  /***** saldo disponível */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;

/**** patrocinio inteligente */
$sqlPatrocinioPendente = mysqli_query($conexao, "SELECT sum(pi_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$verPatrocinioPendente = mysqli_fetch_array($sqlPatrocinioPendente);
	$valorPatrocinioPendente = $verPatrocinioPendente['sum(pi_valor)'];
	
$sqlPatrocinioPago = mysqli_query($conexao, "SELECT sum(pi_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pago'");
$verPatrocinioPago = mysqli_fetch_array($sqlPatrocinioPago);
	$valorPatrocinioPago = $verPatrocinioPago['sum(pi_valor)'];
	
$saldoPatrocinio = $valorPatrocinioPendente - $valorPatrocinioPago;


$saldoGeral = $saldo_disponivel - $saldoPatrocinio;


if($saldoGeral >= $valor){

/****INSERIR DADOS DO BOLETO */
$inserirBoleto = mysqli_query($conexao, "INSERT INTO sps_recarga_celular (recarga_afiliado_id, recarga_numero, recarga_operadora, recarga_valor, recarga_status, recarga_dia, recarga_mes, recarga_ano, recarga_hora) VALUES ('$id', '$numero', '$operadora', '$valor', 'Pendente', '$dia', '$mes', '$ano', '$horario')", $ellevar);

if($inserirBoleto == "1"){

$efetuarDebito = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$id', '$valor', 'Retirada', 'RECARGA DE CELULAR PARA O NUMERO $numero DA OPERADORA $operadora', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);

if($id == $contaTeste){
    
}else{

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
    $idParceiro = $verEmpresa['logo_taxa'];

$Reserva1 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$empresa', '$valor', 'Taxa', 'RESIDUAL DA RECARGA DE CELULAR PARA O NUMERO $numero DA OPERADORA $operadora PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);

$Reserva2 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$empresa', '$valor', 'Retirada', 'REPASSE DA RECARGA DE CELULAR PARA O NUMERO $numero DA OPERADORA $operadora PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);

$Reserva3 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$idParceiro', '$valor', 'Recarga', 'REPASSE DA RECARGA DE CELULAR PARA O NUMERO $numero DA OPERADORA $operadora PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);


$assunto = "Solicitação de Recarga de Celular";

$mensagemHTML = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$verEmpresa['logo_fantasia'].'</strong>,<br><br>

<font style="font-size:18px; font-family:Arial;">
Eu, <strong>'.$nome.' ('.$id.')</strong><br>
Solicito recarga de celular.<br><br>
Segue informações:<br><br>
'.$simbolo.'<br>

<strong>Número: </strong>'.$numero.' <br>
<strong>Valor: </strong>R$ '.number_format($valor,2,",",".").'<br><br>

<strong>Data de solicitação em</strong>: '.$dia.'/'.$mes.'/'.$ano.'</font><br><br>


Atenciosamente<br>

'.$nome.' ('.$id.')
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

mail($verEmpresa['logo_financeiro'], $assunto, $mensagemHTML, $headers, "-r". $emailsender);

}
?>


<div class="w3-container">
<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:14px;">Sua solicitação de recarga de Celular para o número <b><?Php echo $numero; ?></b>, da operadora <b><?Php echo $operadora; ?></b> e no valor de <b>R$ <?Php echo number_format($valor,2,",","."); ?></b>, foi solicitada com sucesso.<br><br>
Aguarde que seus créditos logo serão disponibilizados no celular solicitado.
</div>
<br><br>


<?Php

}else{
    echo "<script>location.href='recarga2.php?id=".$id."&&empresa=".$empresa."';alert('Desculpe, não foi possível realizar a sua recarga! <br>Tente novamente ou entre em contato com a administração!');</script>";
}

}else{
	echo "<script>location.href='recarga2.php?id=".$id."&&empresa=".$empresa."';alert('Desculpe, você não possui saldo suficiente para para fazer essa recarga!');</script>";
}
}else{
	echo "<script>location.href='recarga2.php?id=".$id."&&empresa=".$empresa."';alert('Senha Incorreta!');</script>";
}
?>

<center>
<a href="recarga2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button name="avancar" type="button" id="avancar" class="w3-blue w3-input btn-lg w3-padding-16" style="font-size:20px;"><i class="fas fa-mobile-alt"></i>  Nova Recarga</button></a>
</center>
    
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