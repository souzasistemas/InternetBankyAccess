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
    $emailEu = $ver['afiliado_email'];
    $senhaCartao = $ver['afiliado_pin'];
    $codigo = $ver['afiliado_codigo'];

    
if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
    $nomeEu = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
    $nomeEu = $ver['afiliado_fantasia'];
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

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$emailsender = $emailEmpresa3;
$afiliado = $_POST['afiliado'];
$valor = $_POST['valor'];
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

if($id == ""){
  	echo "<script>history.back(-1);alert('Digite o seu Código de Afiliado!');</script>";
}else{
    
$sqlID = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$afiliado'");
$verID = mysqli_fetch_array($sqlID);
    $email = $verID['afiliado_email'];
    $codigo1 = $verID['afiliado_codigo'];
    
    if($verID['afiliado_fantasia2'] == ""){
        $name2 = $verID['afiliado_nome'];
    }else{
        $name2 = $verID['afiliado_fantasia2'];
    }

$sqlAfiliado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$afiliado'");
$verAfiliado = mysqli_fetch_array($sqlAfiliado);
    
    if($verID['afiliado_conta_modo'] == "Fisica"){
        $name2 = $verID['afiliado_nome'];
    }elseif($verID['afiliado_conta_modo'] == "Juridica"){
        $name2 = $verID['afiliado_fantasia'];
    }  

$nome_todo2 = $name2;
$nomes2 = explode(' ', $nome_todo2); // separamos por espaços e fica: Array ( [0] => Eduardo [1] => da [2] => Silva [3] => Fernandes )
$nome2 = $nomes2[0]; // primeiro nome
$sobrenome2 = $nomes2[count($nomes2) - 1]; // ultimo nome, total de nomes - 1 que é o ultimo elemento de $nomes    
  
if($ver['afiliado_id'] == ""){
  	echo "<script>history.back(-1);alert('Código de Afiliado Inexistente!');</script>";
}elseif($ver['afiliado_status'] == "Pendente"){
    echo "<script>history.back(-1);alert('Você encontra-se Pendente de Desbloqueio!');</script>";
}elseif($ver['afiliado_status'] != "Ativo"){
  	echo "<script>history.back(-1);alert('Você está Bloqueado!');</script>";
}else{



if($senha == ""){
    echo "<script>history.back(-1);alert('Digite seu PIN!');</script>";
}elseif($senhaCartao == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
    echo "<script>location.href='transferir.php?id=".$id."';alert('Você precisa cadastrar seu PIN para realizar essa transação!');</script>";
}elseif($senhaCrypt != $senhaCartao){
    echo "<script>location.href='transferir.php?id=".$id."';alert('PIN Incorreto!');</script>";
}else{
  


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

if($saldoGeral <= $valor){
    echo "<br><br><br>";
    echo "<center>";
    echo "<h1 class='w3-large'>Desculpe! Saldo Indisponível</h1>";
    echo "<br><br>";
    echo "<a href='transferir2.php?id=$id'><button class='w3-input btn-lg w3-red' type='button'><i class='fa fa-reply' aria-hidden='true'></i> Voltar</button></a>";
    echo "</center>"; 
}else{


$efetuar = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_tipo_modo) VALUES ('$id', '$valor', 'Retirada', 'TRANSFERENCIA AUTORIZADA: $afiliado-$codigo1', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', 'Transferencia')", $ellevar);  

if($efetuar == "1"){
    
if($id == $contaTeste){
}else{
    
$InserirValor = mysqli_query($conexao, "INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$afiliado', '$valor', 'Transferencia', 'TRANSFERENCIA RECEBIDA: $id-$codigo', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito')", $ellevar);


$assunto = "TRANSFERÊNCIA RECEBIDA AUTORIZADA";
$assunto1 = "TRANSFERÊNCIA EFETUADA AUTORIZADA";

$nomeremetente = $name;
$nomeremetente1 = $nomeEu;

$emaildestinatario = trim($email);
$emaildestinatario1 = trim($emailEu);

$emailremetente = $emailsender;

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '

<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeremetente.'</strong>,<br><br>

Você recebeu uma transferência no valor de R$ '.number_format($valor,2,",",".").'<br>
Enviado pela conta '.$id.'-'.$codigo.' - '.$nomeremetente1.'<br><br>

Atenciosamente<br><br>

Departamento Financeiro 
</div>
';


$mensagemHTML1 = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeremetente1.'</strong>,<br><br>

Você realizou uma transferência no valor de R$ '.number_format($valor,2,",",".").'<br>
Para a conta '.$afiliado.'-'.$codigo1.' - '.$nomeremetente.'<br><br>

Atenciosamente<br><br>

Departamento Financeiro 
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
}
?>



<div class="w3-container">

<?Php
echo "<br>";
    echo "<center>";
    echo "<h1 class='w3-large'>Transferência realizada com sucesso!</h1>";
    echo "<br><br>";
    echo "</center>"; 
 

}else{
    echo "<script>location.href='transferir2.php?id=".$id."&&empresa=".$empresa."';alert('Desculpe! Não foi possível realizar sua transferência');</script>";
}
}
}
}   
}
?>
 
 <center><a href="transferir2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><input name="avancar" type="button" id="avancar" class="w3-input btn w3-teal w3-padding-16" value="Nova Transferência" style="font-size:20px;"></a></center>

    

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