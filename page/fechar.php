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
				
</script>

<style>
html,body, iframe, div#conteudo {height:100%;}
</style>


</head>
<body>

<?php
session_start();

require "../config/config.php";

$id = $_GET['id'];
$empresa = $_GET['empresa'];

$ip = $_SERVER['REMOTE_ADDR'];
$conexao2 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

date_default_timezone_set('Brazil/East');
$horario = date('H:i:s');
$dataCadastro = date('d/m/Y');

$update = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_status_acesso='Não', afiliado_hora_acesso='' WHERE afiliado_id='$id'");

if($update == "1"){
    
$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $nome = $ver['afiliado_usuario'];

$inserir = mysqli_query($conexao, "INSERT INTO sps_afiliado_logs(
        acesso_admin_hora, 
        acesso_admin_data, 
        acesso_admin_login, 
        acesso_admin_empresa,
        acesso_admin_ip, 
        acesso_admin_conexao, 
        acesso_admin_mensagem) VALUES (
        '$horario',
        '$dataCadastro',
        '$id - $nome',
        '$empresa',
        '$ip',
        '$conexao2',
        'Cliente saiu de sua conta')");    

session_unset();
session_destroy();

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
 $site = $verEmpresa['logo_site'];
?>
<br><br>
<meta http-equiv="refresh" content="5; url=../index.php?empresa=<?Php echo $empresa; ?>">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... estamos encerrando.....</a>

<?Php

}else{
    echo "<script>history.back(-1);alert('!!!! ERROR !!!! Entrar em contato com o suporte!');</script>";
}

?>

</body>
</html>