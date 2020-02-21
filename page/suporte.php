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


<div class="w3-half">
<div class="w3-container">
<h1 class="w3-xxlarge w3-text-khaki" style="text-shadow:1px 1px 0 #444"><b>FALE CONOSCO</b></h1>
<h1 class="w3-medium w3-text-gray">Envie sua mensagem que em breve responderemos.<br>Horário de Atendimento: 09hs às 17hs<br><br>
Preencher corretamente o formulário abaixo</h1>


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



</body>
</html>


<?Php
}
?>