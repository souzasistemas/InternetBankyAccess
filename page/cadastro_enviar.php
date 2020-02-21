<?Php
require "../config/config.php";
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

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

</head>
<body class="w3-white">

    
<div class="w3-container-fluid w3-padding" style=" font-size:18px; margin-top:10px;">
        
<?Php

$id = $_GET['id'];
$modo = $_GET['modo'];
$pin = $_GET['pin'];
$empresa = $_GET['empresa'];

$razao = $_GET['razao'];
$fantasia = $_GET['fantasia'];
$cnpj = $_GET['cnpj'];
$abertura = $_GET['abertura'];
     
$nome = $_GET['nome'];
$cpf = $_GET['cpf'];
$rg = $_GET['rg'];
$nascimento = $_GET['nascimento'];
$sexo = $_GET['sexo'];
     
$status = $_GET['status'];

$telefone = $_GET['telefone'];
$celular  = $_GET['celular'];
$email  = strtolower($_GET['email']);

$endereco = $_GET['endereco'];
$bairro = $_GET['bairro'];
$cidade = $_GET['cidade'];
$estado = $_GET['estado'];
$nacao =  $_GET['nacao'];
$cep = $_GET['cep'];

date_default_timezone_set('Brazil/East');
$dias_de_prazo_para_pagamento2 = 32;
$dataExpira = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));

$inserir = mysqli_query($conexao, "UPDATE sps_afiliados SET 
afiliado_conta_modo='$modo',
afiliado_status='$status',
afiliado_pin='$pin',
afiliado_razao='$razao',
afiliado_fantasia='$fantasia',
afiliado_cnpj='$cnpj',
afiliado_insc='',
afiliado_data_abertura='$abertura',
afiliado_nome='$nome',
afiliado_cpf='$cpf',
afiliado_rg='$rg',
afiliado_nascimento='$nascimento',
afiliado_sexo='$sexo',
afiliado_endereco='$endereco',
afiliado_bairro='$bairro',
afiliado_cidade='$cidade',
afiliado_estado='$estado',
afiliado_cep='$cep',
afiliado_nacao='$nacao',
afiliado_telefone='$telefone',
afiliado_celular='$celular',
afiliado_email='$email',
afiliado_mensalidade='$dataExpira' WHERE afiliado_id='$id'");


if($inserir == "1"){
?>

Meus Parabéns! Sr(a) <b><?Php if($modo == "Fisica"){ echo $nome; } elseif($modo == "Juridica") { echo $fantasia; }?></b>,<br><br>
    Obrigado por preencher seus dados. <br>
    Agora seu acesso está desbloqueado.<br>
    Pressione <span class="w3-text-red"><b>F5</b></span> para acessar todos os recursos de sua conta<br><br></h1><br>
    

<?Php
}else{
?>

Infelizmente não conseguimos finalizar seu cadastro!<br> Entre em contato com a administração para maiores informações</h1><br>
    
<button name="reset" type="button" class="btn-lg w3-red w3-input" style="border:none;" onclick="location.href='cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>'"><span class="glyphicon glyphicon-ok"></span> Tentar Novamente</button>

<?Php
}
?>

</div>
</div>
</body>
</html>
