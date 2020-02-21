<?Php
require "../config/config.php";

$id = $_GET['id']; /** conta restrita */
$empresa = $_GET['empresa']; /** empresa parceira */

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
	$favicon = $verEmpresa['logo_favicon'];
	$nomeEmpresa = strtoupper($verEmpresa['logo_fantasia']);
	$logotipo = $verEmpresa['logo_imagem'];
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
</head>
<body>

<!-- !PAGE CONTENT! -->
<div class="w3-container w3-center" style="padding-top:30px;">

<h1>Desculpe! Acesso Bloqueado!<br>
Entrar em contato com a Administração!</h1>


  <!-- End page content -->
</div>


</body>
</html>