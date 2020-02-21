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
    body {
        overflow:hidden;
    }
    *#conteudo2, html, body, iframe#conteudo2 {
        width:100%;
        height:80%;
    }
</style>
</head>
<body>


<div class="w3-container">
<b>1º Passo: Me informe sua nacionalidade.</b><br><br>

<form action="cadastro2.php?id=<?Php echo $id; ?>" method="post">
    <input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
    <select class="w3-input w3-padding-16 w3-border w3-round" name="nacao" required>
        <option value=""></option>
        <option value="BRASIL">BRASIL</option>
        
        <option value=""></option>
        <?Php
        $sqlPais = mysqli_query($conexao, "SELECT * FROM sps_nacao WHERE nacao_nome!='Brasil'");
        while($verPais = mysqli_fetch_array($sqlPais)){
        ?>
        <option value="<?Php echo preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($verPais['nacao_nome'])); ?>"><?Php echo preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","A A E E I I O O U U N N Ç Ç"),strtoupper($verPais['nacao_nome'])); ?></option>
        <?Php
        }
        ?>
       
    </select><BR>
    <button class="w3-teal w3-padding-16 w3-button w3-input w3-round btn-lg w3-hover-black" type="submit">Avançar</button>
</form>

</div>









</body>
</html>


<?Php
}
?>