<!DOCTYPE html>
<html lang="pt">
<head>
<title>rsrs</title>
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

<?Php
require "../config/config.php";
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$usuario = $_GET['usuario'];
$email = $_GET['email'];
$senha = $_GET['senha'];
$senha2 = $_GET['senha2'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));
$userCrypt = sha1(md5(sha1(base64_encode(md5($usuario)))));
$idCorretor = $_GET['corretor'];
$loja = $_GET['empresa'];
$pin = "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb";  /**** PIN */
$sqlMensagem = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$loja'");
$verMensagem = mysqli_fetch_array($sqlMensagem);
    $confirma = $verMensagem['logo_confirma'];
    $assunto = $verMensagem['logo_assunto'];
    $assunto1 = $verMensagem['logo_assunto2'];
    $emailsender = $verMensagem['logo_emailsender'];
	$favicon = $verMensagem['logo_favicon'];
	$nomeEmpresa = strtoupper($verMensagem['logo_fantasia']);
	$logotipo = $verMensagem['logo_imagem'];
	$site = $verMensagem['logo_site'];

$ip = $_SERVER['REMOTE_ADDR'];
$conexao2 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

date_default_timezone_set('Brazil/East');
$horario = date('H:i:s');
$dataCadastro = date('d/m/Y');

if($senha != $senha2){
    echo "<center><h1 class='w3-xlarge'>SENHAS DIFERENTES!</h1></center>";
}else{
	
/*** se usuario está cadastrado */
$sqlUser = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_usuario='$usuario' AND afiliado_empresa='$loja'");
$verUser = mysqli_fetch_array($sqlUser);
    $userCadastrado = $verUser['afiliado_usuario'];
    
if($usuario == $userCadastrado){
    echo "<center><h1 class='w3-xlarge'>USUÁRIO CADASTRADO! TENTE NOVAMENTE!</h1></center>";
}else{
    
/*** se email está cadastrado */
$sqlEmail = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_email='$email' AND afiliado_empresa='$loja'");
$verEmail = mysqli_fetch_array($sqlEmail);
    $EmailCadastrado = $verEmail['afiliado_email'];
    
if($email == $EmailCadastrado){
    echo "<center><h1 class='w3-xlarge'>E-MAIL JÁ VINCULADO EM OUTRO USUÁRIO! TENTE NOVAMENTE!</h1></center>";

}else{
    

$sql_numero = mysqli_query($conexao, "SELECT * FROM sps_afiliados ORDER BY afiliado_id DESC LIMIT 1");
$ver_numero = mysqli_fetch_array($sql_numero);
    $digito = $ver_numero['afiliado_codigo'];

if($digito == "9"){
    $arrendondamento = "0";
}else{
    $arrendondamento = $digito + 1;
}

date_default_timezone_set('Brazil/East');
$dataCompleta = date('d/m/Y H:i:s');
$data = date('d/m/Y');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$horario2 = date('H:i:s');

$inserir = mysqli_query($conexao, "INSERT INTO sps_afiliados(afiliado_codigo, afiliado_indicador, afiliado_reginal, afiliado_empresa, afiliado_teste, afiliado_credenciamento, afiliado_sistema, afiliado_bonus, afiliado_modo_loja, afiliado_segmento, afiliado_plano, afiliado_link, afiliado_comissao, afiliado_status, afiliado_usuario, afiliado_login, afiliado_senha, afiliado_pin, afiliado_email, afiliado_confirma, afiliado_data_cadastro, afiliado_hora_cadastro, afiliado_mensalidade, afiliado_ip, afiliado_computador, afiliado_conexao) VALUES ('$arrendondamento', '$idCorretor', '$loja', '$loja', 'Não', 'Não', 'BASIC', '0.00', 'DÉBITO', '0000', '1', 'Não', '0.00', 'Pendente', '$usuario', '$userCrypt', '$senhaCrypt', '$pin', '$email', '$confirma', '$dataCadastro', '$horario', '00/00/0000', '$ip', '$conexao2', '$conexao2')");


if($inserir == "1"){
    
$sqlNovoAfiliado = mysqli_query($conexao, "SELECT * FROM sps_afiliados ORDER BY afiliado_id DESC LIMIT 1");
$verNovoAfiliado = mysqli_fetch_array($sqlNovoAfiliado);
	$idNovoAfiliado = $verNovoAfiliado['afiliado_id'];
	$codigoVerificador = $verNovoAfiliado['afiliado_codigo'];

$numero1 = str_pad(11671489000140, 14, '0', STR_PAD_LEFT);
$numero2 = str_pad($id, 4, '0', STR_PAD_LEFT);
$numero3 = str_pad($idNovoAfiliado, 6, '0', STR_PAD_LEFT);

$numeroCartao = "$numero1$numero2$numero3";

$update = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_cartao='$numeroCartao' WHERE afiliado_id='$idNovoAfiliado'");


$sqlCorretor = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$verCorretor = mysqli_fetch_array($sqlCorretor);

if($verCorretor['afiliado_conta_modo'] == "Fisica"){
    $name = $verCorretor['afiliado_nome'];
}elseif($verCorretor['afiliado_conta_modo'] == "Juridica"){
    $name = $verCorretor['afiliado_fantasia'];
}     

$nome_todo = $name;
$nomes = explode(' ', $nome_todo); // separamos por espaços e fica: Array ( [0] => Eduardo [1] => da [2] => Silva [3] => Fernandes )
$nome = $nomes[0]; // primeiro nome
$sobrenome = $nomes[count($nomes) - 1]; // ultimo nome, total de nomes - 1 que é o ultimo elemento de $nomes

$nomeremetente = $usuario;
$nomeremetente1 = "SOUZA SISTEMAS";
$nomeremetente2 = "$name";

$emaildestinatario = trim(strtolower($email));
$emaildestinatario1 = trim(strtolower('diretoria@souzasistemas.com.br'));
$emaildestinatario2 = trim(strtolower($verCorretor['afiliado_email']));


$emailremetente = $emailsender;

$mensagemHTML = '

<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeremetente.'</strong>.<br><br>

<strong>Seus dados para entrar em sua conta</strong>:<br><br>

<div style="border: 1px solid #ccc; border-radius:10px; padding:10px 0 10px 20px;">
<strong>Agência:</strong> 0001 <br>
<strong>Conta:</strong> '.$idNovoAfiliado.'-'.$codigoVerificador.' <br>
<strong>Usuário:</strong> '.$usuario.' <br>
<strong>Senha:</strong>  '.$senha.'<br>
<strong>E-mail:</strong>  '.$email.'<br>
</div>
<br>
<strong>Data e Hora do Cadastro:</strong> '.$dataCadastro.' às '.$horario.'<br>
<br>


Atenciosamente<br><br>

Administração
</div>

';

$mensagemHTML1 = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$nomeremetente1.'</strong>.<br><br>

Nova Abertura de Conta:<br>
<strong>Nova Conta:</strong> '.$idNovoAfiliado.'-'.$codigoVerificador.': '.$usuario.'<br><br>

Atenciosamente<br><br>

Administração
</div>';


$mensagemHTML2 = '
<div style="font-family:arial; font-size:18px;">

Olá, <strong>'.$nomeremetente2.'</strong>.<br><br>

Nova Abertura de Conta:<br>
<strong>Nova Conta:</strong> '.$idNovoAfiliado.'-'.$codigoVerificador.': '.$usuario.'<br><br>

Atenciosamente<br><br>

Administração
</div>';






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
    
    echo "<center><h1 class='w3-xlarge'>Cadastro Realizado com sucesso!</h1></center>";

}else{
    echo "<center><h1 class='w3-xlarge'>Cadastro não realizado! Entrar em contato com a Administração e/ou suporte on-Line</h1></center>";

}}}}
?>




</body>
</html>