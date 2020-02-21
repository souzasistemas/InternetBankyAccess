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

<script src="../js/mascara.js"></script>
<script src="../js/jquery.maskedinput.js"></script>  
      
<script language="JavaScript">
function protegercodigo() {
	if (event.button==2||event.button==3){
		alert('Desculpe! Acesso não Autorizado!');}
	}
	document.onmousedown=protegercodigo
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

</head>
<body>


<div class="w3-container">

<div class="w3-container" style="font-size:12px;">
<?Php
$modo = $_POST['modo'];
  
$razao = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['razao']));
$fantasia = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['fantasia']));
$cnpj = $_POST['cnpj'];
$insc = $_POST['inscricao'];
$abertura = $_POST['abertura'];
     
$nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nome']));
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
     
$pin = sha1(md5(sha1(base64_encode(md5($_POST['pin'])))));
     
$status = "Ativo";

$telefone = $_POST['telefone'];
$celular  = $_POST['celular'];
$email  = strtolower($_POST['email']);

$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['rua']));
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['bairro']));
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['cidade']));
$estado = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['uf']));
$nacao =  preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nacao']));
$cep = $_POST['cep'];

if($modo == "Fisica"){
?>


<div class="w3-container-fluid w3-padding alert alert-info" style=" font-size:12px; margin-top:10px;">
Pronto! Sr.(a) <b><?Php if($modo == "Fisica"){ echo $nome; } elseif($modo == "Juridica") { echo $fantasia; }?></b>, <br>
Confirme seus Dados antes de finalizar
</div>

<?Php
if($nacao == "BRASIL"){
?>
<div class="well">
<h5><strong>Dados Pessoais</strong></h5>
<strong>Nome Completo: </strong> <?Php echo $nome; ?><br />
<strong>CPF: </strong><?Php echo $cpf; ?> <br />
<strong>RG: </strong><?Php echo $rg; ?><br />
<strong>Data de Nascimento: </strong><?Php echo $nascimento; ?><br />
<strong>Sexo: </strong><?Php echo $sexo; ?><br />
</div>
<?Php    
}else{
?>
<div class="well">
<h5><strong>Dados Pessoais</strong></h5>
<strong>Nome Completo: </strong> <?Php echo $nome; ?><br />
<strong>Documento/Passaporte: </strong><?Php echo $cpf; ?> <br />
<strong>Data de Nascimento: </strong><?Php echo $nascimento; ?><br />
<strong>Sexo: </strong><?Php echo $sexo; ?><br />
</div>
<?Php
}
?>


<div class="well">
<h5><strong>Dados de Contato</strong></h5>
<strong>Telefone: </strong> <?Php echo $telefone; ?><br />
<strong>Celular: </strong><?Php echo $celular; ?> <br />
<strong>E-mail: </strong><?Php echo $email; ?><br />
</div>

<?Php
if($nacao == "BRASIL"){
?>
<div class="well">
<h5><strong>Dados de Correspondência</strong></h5>
<strong>Endereço: </strong> <?Php echo $endereco; ?> <br />
<strong>Bairro: </strong><?Php echo $bairro; ?><br />
<strong>Cidade: </strong><?Php echo $cidade; ?><br />
<strong>Estado: </strong><?Php echo $estado; ?><br />
<strong>CEP: </strong><?Php echo $cep; ?><br />
<strong>País: </strong><?Php echo $nacao; ?><br />
</div>
<?Php    
}else{
?>
<div class="well">
<h5><strong>Dados de Correspondência</strong></h5>
<strong>Endereço: </strong> <?Php echo $endereco; ?> <br />
<strong>Cidade: </strong><?Php echo $cidade; ?><br />
<strong>Estado/Província: </strong><?Php echo $estado; ?><br />
<strong>ZIP CODE: </strong><?Php echo $cep; ?><br />
<strong>País: </strong><?Php echo $nacao; ?><br />
</div>
<?Php
}
?>


<?Php
}elseif($modo == "Juridica"){
?>

<div class="w3-container-fluid w3-padding alert alert-info" style=" font-size:12px; margin-top:10px;">
Pronto! Sr.(a) <b><?Php if($modo == "Fisica"){ echo $nome; } elseif($modo == "Juridica") { echo $fantasia; }?></b>, <br>
Confirme seus Dados antes de finalizar
</div>

<div class="well">
<h5><strong>Dados da Empresa</strong></h5>
<strong>Razão Social: </strong> <?Php echo $razao; ?> <br>
<strong>Nome Fantasia: </strong><?Php echo $fantasia; ?> <br />
<strong>CNPJ: </strong><?Php echo $cnpj; ?><br>
<strong>Inscrição Estadual / Municipal: </strong><?Php echo $insc; ?><br>
<strong>Data de Abertura: </strong><?Php echo $abertura; ?><br />
</div>

<div class="well">
<h5><strong>Dados do Responsável</strong></h5>
<strong>Nome Completo: </strong> <?Php echo $nome; ?><br />
<strong>CPF: </strong><?Php echo $cpf; ?> &nbsp;&nbsp;&nbsp;
<strong>RG: </strong><?Php echo $rg; ?><br />
<strong>Data de Nascimento: </strong><?Php echo $nascimento; ?>&nbsp;&nbsp;&nbsp;
<strong>Sexo: </strong><?Php echo $sexo; ?><br />
</div>

<div class="well">
<h5><strong>Dados de Contato</strong></h5>
<strong>Telefone: </strong> <?Php echo $telefone; ?><br />
<strong>Celular: </strong><?Php echo $celular; ?> <br />
<strong>E-mail: </strong><?Php echo $email; ?><br />
</div>

<div class="well">
<h5><strong>Dados de Correspondência</strong></h5>
<strong>Endereço: </strong> <?Php echo $endereco; ?> <br />
<strong>Bairro: </strong><?Php echo $bairro; ?><br />
<strong>Cidade: </strong><?Php echo $cidade; ?><br />
<strong>Estado: </strong><?Php echo $estado; ?><br />
<strong>CEP: </strong><?Php echo $cep; ?><br />
<strong>País: </strong><?Php echo $nacao; ?><br />
</div>

<?Php
}
?>

<form action="cadastro_carregando.php?id=<?Php echo $id; ?>" method="post" name="form1" enctype="multipart/form-data">
    
     <input type="hidden" name="modo" value="<?Php echo $modo; ?>">
     <input type="hidden" name="empresa" value="<?Php echo $empresa; ?>">   
  
     <input type="hidden" name="razao" value="<?Php echo $razao; ?>">
     <input type="hidden" name="fantasia" value="<?Php echo $fantasia; ?>">
     <input type="hidden" name="cnpj" value="<?Php echo $cnpj; ?>">
     <input type="hidden" name="insc" value="<?Php echo $insc; ?>">
     <input type="hidden" name="abertura" value="<?Php echo $abertura; ?>">
     
     <input type="hidden" name="nome" value="<?Php echo $nome; ?>">
     <input type="hidden" name="cpf" value="<?Php echo $cpf; ?>">
     <input type="hidden" name="rg" value="<?Php echo $rg; ?>">
     <input type="hidden" name="nascimento" value="<?Php echo $nascimento; ?>">
     <input type="hidden" name="sexo" value="<?Php echo $sexo; ?>">
     
     <input type="hidden" name="pin" value="<?Php echo $pin; ?>">     
     
     <input type="hidden" name="status" value="<?Php echo $status; ?>">
     
     <input type="hidden" name="telefone" value="<?Php echo $telefone; ?>">
     <input type="hidden" name="celular" value="<?Php echo $celular; ?>">
     <input type="hidden" name="email" value="<?Php echo $email; ?>">
     
     <input type="hidden" name="endereco" value="<?Php echo $endereco; ?>">     
     <input type="hidden" name="bairro" value="<?Php echo $bairro; ?>">
     <input type="hidden" name="cidade" value="<?Php echo $cidade; ?>">
     <input type="hidden" name="estado" value="<?Php echo $estado; ?>">
     <input type="hidden" name="cep" value="<?Php echo $cep; ?>">
     <input type="hidden" name="nacao" value="<?Php echo $nacao; ?>">

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:50%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:50%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
 

     
</form>
</div>


</div>

</body>
</html>


<?Php
}
?>