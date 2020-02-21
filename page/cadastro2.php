<?Php
session_start();

$id = $_GET['id'];
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

<script src="../js/mascara.js"></script>
<script src="../js/jquery.maskedinput.js"></script>  
      
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
        width:100%;
        height:80%;
    }
</style>

<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
</script>

<script language="javascript">
function show_fisica()
{
	document.getElementById('fisica').style.display='block';
	document.getElementById('juridica').style.display='none';
}
function show_juridica()
{
	document.getElementById('juridica').style.display='block';
	document.getElementById('fisica').style.display='none';
}
</script>

</head>
<body>


<div class="w3-container">
<?Php
$nacao = $_POST['nacao'];

if($nacao == "BRASIL"){
?>
<b>2º Passo:</b> Tipo de Cadastro.<br><br>

<div class="w3-bar">
  <button onClick="show_fisica()" type="button" class="w3-bar-item w3-button w3-blue w3-hover-black w3-padding-16" style="width:50%; border-radius:5px 0 0 5px;">PESSOA <br>FÍSICA</button></a>
  <button onClick="show_juridica()" type="reset" class="w3-bar-item w3-button w3-indigo w3-hover-black w3-text-white w3-padding-16" style="width:50%; border-radius:0 5px 5px 0;">PESSOA <br>JURÍDICA</button>
</div><br><br>


<div id="fisica" style="display:none">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Fisica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="INFORME SEU CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>



<div id="juridica" style="display:none">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Juridica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="INFORME SEU CNPJ" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CNPJ',this,event)" maxlength="18" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>


<?Php
}else{
?>
<b>2º Passo:</b> Informe seu Documento de Identificação ou Passaporte.<br><br>
<h4 class="w3-text-red">O documento abaixo tem que ser do titular para que as operações sejam validadas.</h4>
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="DOCUMENTO DE IDENTIFICAÇÃO E/OU PASSAPORTE" style="margin-bottom:5px; text-align:center;" required /><br>

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>


</form>






<?Php
}
?>


</div>









</body>
</html>


<?Php
}
?>