<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];

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
				

</script>


<style>
    
    *#conteudo2, html, body, iframe#conteudo2 {        
		overflow:hidden;
    }
</style>
</head>
<body>


<div class="w3-half">
<div class="w3-container">
<h1 class="w3-xxlarge w3-text-khaki" style="text-shadow:1px 1px 0 #444"><b>DESBLOQUEAR SUA CONTA</b></h1>
<h1 class="w3-medium w3-text-gray">Preencha corretamente para que seu cadastro seja desbloqueado!<br><br>

<iframe id="conteudo2"  src="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" name="ver" marginheight="0" marginwidth="0" frameborder="0" width="100%" height="400px;" scrolling="auto"></iframe>


</div>

</div>



<div class="w3-half"><center><img src="../img/mulhercontato.jpg" width="75%"></center></div>



</body>
</html>


<?Php
}
?>