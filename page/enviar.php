<?Php
session_start();

$id = $_POST['id'];
$empresa = $_POST['empresa'];

if($id == ""){
        echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $name = $ver['afiliado_nome'];
    $telefone = $ver['afiliado_telefone'];
    $celular = $ver['afiliado_celular'];
    $email = strtolower($ver['afiliado_email']);
	
if($ver['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $name;
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $razao;
}

if($nomeAfiliado == ""){
	$nome = $login;
}else{
	$nome = $nomeAfiliado;
}
?>

<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<title>INTERNET BANKY ACCESS - <?Php echo $nomeEmpresa; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="icon" href="img/favicon/<?php echo $favicon; ?>" />
  <link rel="shortcut icon" href="img/favicon/<?php echo $favicon; ?>" />
        
<script language="JavaScript">
function protegercodigo() {
	if (event.button==2||event.button==3){
		alert('Desculpe! Acesso não Autorizado!');}
	}
	document.onmousedown=protegercodigo
</script>

<SCRIPT LANGUAGE="JavaScript">
function disableselect(e){
	return false
}   

function reEnable(){
	return true
}
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
				
if (window.sidebar){
	document.onmousedown=disableselect   
	document.onclick=reEnable   
}
</script>

<style>
html, body, iframe, div#conteudo{
	height:100%;
}

</style>
</head>
<body>

<?Php

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

require "../config/config.php";

$nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nome']));
$assunto = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['assunto']));
$telefone = $_POST['telefone'];
$texto = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['texto']));
$email = strtolower($_POST['email']);

$sqlMensagem = mysqli_query($conexao, "SELECT * FROM sps_logotipo WHERE logo_afiliado_id='$empresa'");
$verMensagem = mysqli_fetch_array($sqlMensagem);
    $NomeEmpresa = $verMensagem['logo_nome'];
    $emailsender = $verMensagem['logo_emailsender'];
    $departamento = "diretoria@souzasistemas.com.br";
    
date_default_timezone_set('Brazil/East');
$dataCompleta = date('d/m/Y H:i:s');


    
function validEmail($email){
		$dominio = "www.";
		$resultado = explode("@", $email);
			if ($resultado > 1) {
				$checaNome = $resultado[0];
				$usuario = "/([a-zA-Z0-9\._-])/";
				if(preg_match($usuario, $checaNome)) {
					$endereco2 = $dominio.$resultado[1];
					$fp = @fsockopen($endereco2,80);
					if($fp) {
						$isValid = true;
						fclose($fp);
					} else {
						$isValid = false;
					}
				}else{
					$isValid = false;
				}
			}else{
				$isValid = false;
			}
		return $isValid;
		}
//exemplo de aplicação
if (validEmail($email)){

$nomeremetente = $nome;
$emaildestinatario = trim($departamento);
$emailremetente = $emailsender;

$mensagemHTML = '
<div style="font-family:arial; font-size:18px;">
Olá, <strong>'.$NomeEmpresa.'</strong>.<br><br>
Uma mensagem para você de nossa página.<br><br>

<strong>Seus dados da mensagem</strong>:<br><br>
<strong>ID:</strong> '.$id.'<br>
<strong>Nome Completo:</strong> '.$nome.'<br>
<strong>Telefone:</strong> '.$telefone.'<br>
<strong>E-mail:</strong> '.$email.'<br><br>

<strong>Assunto:</strong> '.$assunto.'<br><br>

<div style="border-top:1px solid #ccc; border-botton:1px solid #ccc; border-radius:4px; width:400px; padding:10px 0">'.strtoupper($texto).'
</div><br><br>

<strong>Enviado no dia <font color="blue"></font>'.$dataCadastro.' às <font color="blue"></font>'.$horario.'</strong>


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
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
?>

<div class="w3-half">
<div class="w3-container">
<h1 class="w3-xxlarge w3-text-khaki" style="text-shadow:1px 1px 0 #444"><b>FALE CONOSCO</b></h1>
<h1 class="w3-medium w3-text-gray">Envie sua mensagem que em breve responderemos.<br>Horário de Atendimento: 09hs às 17hs<br><br>
Preencher corretamente o formulário abaixo</h1>

<div class="w3-panel w3-center w3-round w3-pale-green w3-text-green w3-padding">
  <b>Meus Parabéns!</b> Sua mensagem foi enviada com sucesso!
</div> 

<form action="enviar.php" method="post">
<div class="row">

<div class="col-sm-12 form-group">
<input type="hidden" value="<?Php echo $id;?>" name="id">
<input type="hidden" value="<?Php echo $empresa;?>" name="empresa">
<input class="w3-input w3-padding-16 w3-border w3-round-large w3-light-grey" id="name" name="nome" value="<?Php echo $nome; ?>" placeholder="Nome Completo" type="text" style="text-transform:uppercase;" readonly>
</div>

<div class="col-sm-12 form-group">
<input class="w3-input w3-padding-16 w3-border w3-round-large w3-light-grey" id="email" name="email" value="<?Php echo $email; ?>" placeholder="Email" type="email" style="text-transform:lowercase;" readonly>
</div>

<div class="col-sm-6 form-group">
<input name="telefone" style="text-transform:uppercase;" value="<?Php echo $telefone; ?>" placeholder="Telefone de Contato" class="w3-input w3-padding-16 w3-border w3-round-large w3-light-grey" maxlength="15" onkeypress="return digitos(event, this)" onkeyup="Mascara('TEL',this,event)" type="text" autocomplete="off" readonly>
</div>

<div class="col-sm-6 form-group">
<input name="celular" style="text-transform:uppercase;" value="<?Php echo $celular; ?>" placeholder="Celular de Contato" class="w3-input w3-padding-16 w3-border w3-round-large w3-light-grey" maxlength="15" onkeypress="return digitos(event, this)" onkeyup="Mascara('TEL',this,event)" type="text" autocomplete="off" readonly>
</div>

<div class="col-sm-12 form-group">
<input class="w3-input w3-padding-16 w3-border w3-round-large" id="email" name="assunto" placeholder="Assunto" type="text" style="text-transform:uppercase;" required>
</div>
</div>

<textarea class="w3-input w3-padding-16 w3-border w3-round-large" id="comments" name="texto" placeholder="Mensagem" rows="7" style="text-transform:uppercase;"></textarea>

<div class="row"><br>
<div class="col-sm-12 form-group">
<button style="margin-top:10px;" class="w3-input w3-padding-16 w3-round-large w3-teal" name="Submit" type="submit">Enviar Mensagem</button>
<button style="margin-top:5px;"  class="w3-input w3-padding-16 w3-round-large w3-red" name="reset" type="reset">Limpar Formulário</button>
</div>
</div> 
</form>
</div>

</div>



<div class="w3-half"><center><img src="../img/mulhercontato.jpg" width="75%"></center></div>

<?Php
}
?>

</body>
</html>


<?Php
}
?>