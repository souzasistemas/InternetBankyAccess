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

$sqlExcent = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent = mysqli_fetch_array($sqlExcent);
$totalExcent = mysqli_num_rows($sqlExcent);

$sqlExcent2 = mysqli_query($conexao, "SELECT sum(excent_valor_liquido) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent2 = mysqli_fetch_array($sqlExcent2);
    $totalValor2 = $verExcent2['sum(excent_valor_liquido)'];
    
$sqlExcent3 = mysqli_query($conexao, "SELECT sum(excent_valor_residual) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent3 = mysqli_fetch_array($sqlExcent3);
    $totalValor3 = $verExcent3['sum(excent_valor_residual)'] * 20;

$sqlExcent4= mysqli_query($conexao, "SELECT sum(residual_valor_pagar) FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_status!='Pago'");
$verExcent4 = mysqli_fetch_array($sqlExcent4);
    $totalValor4 = $verExcent4['sum(residual_valor_pagar)'];
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

<style>
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


<div class="w3-container">

<?Php
error_reporting(0);

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$emailsender = $verEmpresa['logo_emailsender'];
$valor = $_POST['aplicacao'];
$pacote = $_POST['pacote'];
$senha = $_POST['senha'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));

date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$protocolo = "$id$dia$mes$ano2$hora$min$seg";

$sqlPlanos = mysqli_query($conexao, "SELECT * FROM sps_planos_investimentos WHERE invest_id='$pacote'");
$verPlanos = mysqli_fetch_array($sqlPlanos);

$nomePacote = $verPlanos['invest_nome']. " - ".number_format(($verPlanos['invest_rendimento_mes']*100),2,",",".")." A.M";
$percentual = $verPlanos['invest_rendimento_mes'];

$taxaComissao = $verPlanos['invest_taxa_adm'];
$comissao = $valor * $taxaComissao;

if($empresa == "1091"){
    $taxa = "0";
}else{
    $taxa = $verPlanos['invest_taxa_adm'];
}

$aplicacao = $valor - ($valor * $taxa);

/** data retirada */
$dias_de_prazo_para_pagamento_afiliado1 = $verPlanos['invest_data_retirar'];
$vencimento = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

/** data início */
$dias_de_prazo_para_pagamento_afiliado2 = $verPlanos['invest_data_iniciar'];
$dataIniciar = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = $verPlanos['invest_data_aplicar'];
$dataAplicar = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$diario = $aplicacao * $percentual;
  
$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $correspondente = $ver['afiliado_indicador'];
    $email = $ver['afiliado_email'];
    $senhaCartao = $ver['afiliado_pin'];
    
if($ver['afiliado_conta_modo'] == "Fisica"){
    $documento = $ver['afiliado_cpf'];
    $nAme = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $documento = $ver['afiliado_cnpj'];
    $name = $ver['afiliado_fantasia'];
}

$nome_todo = $name;
$nomes = explode(' ', $nome_todo); // separamos por espaços e fica: Array ( [0] => Eduardo [1] => da [2] => Silva [3] => Fernandes )
$nome = $nomes[0]; // primeiro nome
$sobrenome = $nomes[count($nomes) - 1]; // ultimo nome, total de nomes - 1 que é o ultimo elemento de $nomes

if($senha == ""){
    echo "<script>history.back(-1);alert('Digite seu PIN!');</script>";
}elseif($senhaCartao == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
    echo "<script>location.href='aplicacao2.php?id=".$id."';alert('Você precisa cadastrar seu PIN para ter essa informação!');</script>";
}elseif($senhaCartao != $senhaCrypt){
    echo "<script>history.back(-1);alert('PIN Incorreto!');</script>";
}else{


$efetuar = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$id', '$valor', 'Retirada', 'APLICAÇÃO $nomeEmpresa', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);  

if($efetuar == "1"){

if($id != $contaTeste){


$Ativacao = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$empresa', '$valor', 'Ativacao', 'APLICAÇÃO $nomeEmpresa DA CONTA $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar); 


/**Empresa */
$Empresa1 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$empresa', '$comissao', 'Retirada', 'COMISSÃO DA APLICAÇÃO $nomeEmpresa DA CONTA: $id PARA CONTA $correspondente', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito')", $ellevar);
$Empresa2 = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$correspondente', '$comissao', 'Comissao', 'COMISSÃO DA APLICAÇÃO $nomeEmpresa DA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);


$aplicacao = mysqli_query($conexao, "INSERT INTO sps_excent(excent_afiliado_id, excent_empresa, excent_plano, excent_valor_bruto, excent_taxa_adm, excent_valor_liquido, excent_percentual, excent_valor_residual, excent_status, excent_protocolo, excent_executar, excent_data_resgate, excent_iniciar, excent_data_contrato, excent_data_iniciar, excent_data_aplicar) VALUES ('$id', '$empresa', '$pacote', '$valor', '$taxa', '$aplicacao', '$percentual', '$diario', 'Ativo', '$protocolo', 'Feito', '$vencimento', 'Pendente', '$dia/$mes/$ano', '$dataIniciar', '$dataAplicar')", $ellevar);


$assunto = "APLICAÇÃO $nomeEmpresa";
$assunto1 = "NOVA APLICAÇÃO $nomeEmpresa";

$nomeremetente = $name;


$emaildestinatario = trim($email);
$emaildestinatario1 = trim($emailEmpresa1);
$emaildestinatario2 = trim($emailEmpresa2);

$emailremetente = $emailsender;

$sqlContrato = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' ORDER BY excent_id DESC LIMIT 1");
$verContrato = mysqli_fetch_array($sqlContrato);
    $idContrato = $verContrato['excent_id'];
    
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeremetente.'</strong>,<br><br>

Sua Aplicação foi realizada com sucesso!<br><br>
<b>Protocolo: </b> '.$protocolo.'<br>
<b>Número do Contrato: </b> #'.$idContrato.'<br>
<b>Valor Aplicado: </b> R$ '.number_format($valor,2,",",".").'<br>
<b>Pacote: </b> '. $nomePacote.'<br>
<b>Data Início: </b> '. $dataIniciar.'<br>
<b>Data Fim: </b> '. $vencimento.'<br><br>
Atenciosamente<br><br>

Administração '.$verEmpresa['logo_nome'].'
</div>
';


$mensagemHTML1 = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeEmpresa.'</strong>,<br><br>

Uma Aplicação realizada!<br><br>
<b>Protocolo: </b> '.$protocolo.'<br>
<b>Número do Contrato: </b> #'.$idContrato.'<br>
<b>Valor Aplicado: </b> R$ '.number_format($valor,2,",",".").'<br>
<b>Pacote: </b> '. $nomePacote.'<br>
<b>Data Início: </b> '. $dataIniciar.'<br>
<b>Data Fim: </b> '. $vencimento.'<br><br><br>

Atenciosamente<br><br>

Administração '.$verEmpresa['logo_nome'].'
</div>';

$mensagemHTML2 = '
<div style="font-family:arial; font-size:18px;">
<img src='.$linkLogo.' width="150px;"><br><br>
Olá, <strong>SOUZA SISTEMAS</strong>,<br><br>

Uma Aplicação realizada pelo APP!<br><br>
<b>Protocolo: </b> '.$protocolo.'<br>
<b>Número do Contrato: </b> #'.$idContrato.'<br>
<b>Valor Aplicado: </b> R$ '.number_format($valor,2,",",".").'<br>
<b>Pacote: </b> '. $nomePacote.'<br>
<b>Data Início: </b> '. $dataIniciar.'<br>
<b>Data Fim: </b> '. $vencimento.'<br><br><br>

Atenciosamente<br><br>

Administração '.$verEmpresa['logo_nome'].'
</div>';


/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);



/* Montando o cabeçalho da mensagem */
$headers1 = "MIME-Version: 1.1".$quebra_linha;
$headers1 .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers1 .= "From: ".$emailsender.$quebra_linha;
$headers1 .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers1 .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario1, $assunto1, $mensagemHTML1, $headers1, "-r". $emailsender);



/* Montando o cabeçalho da mensagem */
$headers2 = "MIME-Version: 1.1".$quebra_linha;
$headers2 .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers2 .= "From: ".$emailsender.$quebra_linha;
$headers2 .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers2 .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario2, $assunto1, $mensagemHTML2, $headers2, "-r". $emailsender);

}else{
    $aplicacao = mysqli_query($conexao, "INSERT INTO sps_excent(excent_afiliado_id, excent_plano, excent_valor_bruto, excent_taxa_adm, excent_valor_liquido, excent_percentual, excent_valor_residual, excent_status, excent_protocolo, excent_executar, excent_data_resgate, excent_iniciar, excent_data_contrato, excent_data_iniciar) VALUES ('$id', '$pacote', '$valor', '$taxa', '$aplicacao', '$percentual', '$diario', 'Ativo', '$protocolo', 'Feito', '$vencimento', 'Pendente', '$dia/$mes/$ano', '$dataIniciar')", $ellevar);
}

$sqlContrato2 = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' ORDER BY excent_id DESC LIMIT 1");
$verContrato2 = mysqli_fetch_array($sqlContrato2);
    $idContrato2 = $verContrato2['excent_id'];
    
echo '<div style="font-family:arial; font-size:16px;"><br>
<b>Sua Aplicação foi realizada com sucesso!</b><br><br>
<b>Protocolo: </b> '.$protocolo.'<br>
<b>Número do Contrato: </b> #'.$idContrato2.'<br>
<b>Valor Aplicado: </b> R$ '.number_format($valor,2,",",".").'<br>
<b>Pacote: </b> '. $nomePacote.'<br>
<b>Data Início: </b> '. $dataIniciar.'<br>
<b>Data Fim: </b> '. $vencimento.'<br><br>
Protocolo enviado para o email <b>'.$email.'</b><br><br></div>';
echo "<div class='w3-container-fluid'>
<a href='aplicacao2.php?id=$id&&empresa=$empresa'><button type='button' class='w3-input w3-blue btn-lg w3-padding-16' /><i class='fas fa-search'></i> Minhas aplicações</button></a>
</div>";

}else{
    echo "<script>location.href='aplicacao2.php?id=".$id."';alert('Desculpe! Não foi possível realizar sua aplicação');</script>";

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