<?Php
require "../config/config.php";
$id = $_GET['id'];
$modo = $_POST['modo'];
$empresa = $_POST['empresa'];
  
$razao = $_POST['razao'];
$fantasia = $_POST['fantasia'];
$cnpj = $_POST['cnpj'];
$abertura = $_POST['abertura'];
     
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
     
     
$status = $_POST['status'];
$dataExpira = $_POST['dataExpira'];

$telefone = $_POST['telefone'];
$celular  = $_POST['celular'];
$email  = strtolower($_POST['email']);

$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$nacao =  $_POST['nacao'];
$cep = $_POST['cep'];
$pin = $_POST['pin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>INTERNET BANKY ACCESS</title>

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

<style type="text/css">
	#imgpos {
		position:absolute;
		margin:auto;
		}
</style>

<meta http-equiv="refresh" content="5; 
url=cadastro_enviar.php?
id=<?Php echo $id; ?>&&
empresa=<?Php echo $empresa; ?>&&
modo=<?Php echo $modo; ?>&&
pin=<?Php echo $pin; ?>&&
razao=<?Php echo $razao; ?>&&
fantasia=<?Php echo $fantasia; ?>&&
cnpj=<?Php echo $cnpj; ?>&&
abertura=<?Php echo $abertura; ?>&&
nome=<?Php echo $nome; ?>&&
cpf=<?Php echo $cpf; ?>&&
rg=<?Php echo $rg; ?>&&
sexo=<?Php echo $sexo; ?>&&
nascimento=<?Php echo $nascimento; ?>&&
telefone=<?Php echo $telefone; ?>&&
celular=<?Php echo $celular; ?>&&
email=<?Php echo $email; ?>&&
endereco=<?Php echo $endereco; ?>&&
bairro=<?Php echo $bairro; ?>&&
cidade=<?Php echo $cidade; ?>&&
estado=<?Php echo $estado; ?>&&
nacao=<?Php echo $nacao; ?>&&
cep=<?Php echo $cep; ?>&&
status=<?Php echo $status; ?>" />
</head>

<body>

<center>
<div class="col-sm-12" style="text-align:center; font-family:arial; font-size:30px; color:#444; padding-top:15%;">
    <i class="fas fa-sync-alt w3-spin" style="font-size:150px;"></i><br>
    Aguarde... Processando...
</div>

</body>
</html>