<?Php
require "../../../config/config.php";

$id = $_GET['afiliado_id'];
$adm = $_GET['adm'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  
  <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed" rel="stylesheet">
  
    <link rel="icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="shortcut icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="license" href="https://www.souzasistemas.com.br/">
  	<link rel="author" href="https://www.souzasistemas.com.br/">
  	
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
 	
	
  


 <style type="text/css">

.container {
    padding:10px 0;
}

body#principal::-webkit-scrollbar-track {
    background-color: #222;
}
body#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
body#principal::-webkit-scrollbar-thumb {
    background: #555;
}

@media print{
    .botao {
        display:none;
    }
}

  </style>

 
</head>
<body id="principal" class="w3-light-grey">


<div class="container" style="font-size:12px;">

<h2 class="w3-xxlarge"><b>Conta Nº <?Php echo $id; ?>-<?Php echo $ver['afiliado_codigo_verificador']; ?></b></h2>

<hr class="w3-grey w3-border">

<div class="w3-row">
  <div class="w3-third w3-container">
    <?Php
    if($ver['afiliado_foto'] == ""){
    ?>
        <center><img src="https://www.bancobm.com.br/img/icon.png" width="200px"><br><br> <b>SEM IMAGEM</b></center>
    <?Php
    }else{
    ?>
        <center><img src="https://www.souzasistemas.com.br/internetbank/pages/fotos/img/<?Php echo $ver['afiliado_foto']; ?>" width="200px"></center>
    <?Php    
    }
    ?><br><br>
    
    <a class="botao" href="editar_afiliado.php?afiliado_id=<?php echo $ver['afiliado_id']; ?>&&adm=<?Php echo $adm; ?>" d ata-toggle="tooltip" title="Editar Associado"><button class="btn btn-lg btn-primary" type="button" style="width:100%; margin:2px;"><i class="fa fa-pencil"></i> Editar Associado</button></a><br>
    
    <button class="btn btn-lg btn-success botao" type="button" onClick="window.print()" data-toggle="tooltip" title="Imprimir" style="cursor:pointer; width:100%; margin:2px;"><i class="fa fa-print"></i> Imprimir</button>
 <br><br>
 
  </div>
  
  
  
  
  
  <div class="w3-twothird w3-container">
    <b>Corretor:</b> 
    <?Php
    $idCorrespondente = $ver['afiliado_indicador']; 
    $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idCorrespondente'");
    $verAssociado = mysqli_fetch_array($sqlAssociado);
    
    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $nomeAssociado = $verAssociado['afiliado_nome'];
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $nomeAssociado = $verAssociado['afiliado_razao'];
                }
                
    echo $idCorrespondente." - ".$nomeAssociado;
    ?> <br>
    
    
    <b>Tipo de Cadastro:</b> <?Php echo $ver['afiliado_conta_modo']; ?><br>
    
    <b>Empresa:</b>  
    <?Php
     $idPlano2 = $ver['afiliado_estabelecimento']; 
    $sqlPlano2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idPlano2'");
    $verPlano2 = mysqli_fetch_array($sqlPlano2);
    
    if($verPlano2['afiliado_conta_modo'] == "Fisica"){
                    $nomeEmpresa = $verPlano2['afiliado_nome'];
                }elseif($verPlano2['afiliado_conta_modo'] == "Juridica"){
                    $nomeEmpresa = $verPlano2['afiliado_razao'];
                }

    echo $idPlano2 ." - ".$nomeEmpresa;
    ?><br>
    
    
    <b>Status:</b> <?Php echo $ver['afiliado_status']; ?> &nbsp; &nbsp;
    
    
    
   
    
    <b>Comissão:</b> <?Php echo number_format($ver['afiliado_comissao'], 2, ',', '.'); ?>% <br>
    
    <b>Data Cadastro:</b> <?Php echo $ver['afiliado_data_cadastro']; ?> às <?Php echo $ver['afiliado_hora_cadastro']; ?><br>
    <b>IP Cadastro:</b> <?Php echo $ver['afiliado_ip']; ?><br>
    <b>Conexão Cadastro:</b> <?Php echo $ver['afiliado_conexao']; ?>
    
    
    <hr class="w3-grey w3-border">
    
    <?Php
    if($ver['afiliado_conta_modo'] == "Juridica"){
    ?>
    <b>Login de Acesso:</b> <?Php echo $ver['afiliado_nick']; ?><br>
    <b>Razão Social:</b> <?Php echo $ver['afiliado_razao']; ?><br>
    <b>Nome Fantasia:</b> <?Php echo $ver['afiliado_fantasia']; ?> <br>
    <b>CNPJ/CPF:</b> <?Php echo $ver['afiliado_cnpj']; ?> &nbsp;&nbsp;&nbsp;
    <b>Inscrição Estadual:</b> <?Php echo $ver['afiliado_insc']; ?> &nbsp;&nbsp;&nbsp;
    <b>Data de Abertura:</b> <?Php echo $ver['afiliado_data_abertura']; ?><br>
    <b>Responsável:</b> <?Php echo $ver['afiliado_nome']; ?>&nbsp;&nbsp;&nbsp;
    <b>CPF:</b> <?Php echo $ver['afiliado_cpf']; ?>&nbsp;&nbsp;&nbsp;
    <b>RG:</b> <?Php echo $ver['afiliado_rg']; ?><br>
    <b>Nascimento:</b> <?Php echo $ver['afiliado_nascimento']; ?>&nbsp;&nbsp;&nbsp;
    <b>Sexo:</b> <?Php echo $ver['afiliado_sexo']; ?><br>
    <?Php
    }elseif($ver['afiliado_conta_modo'] == "Fisica"){
    ?>
    <b>Login de Acesso:</b> <?Php echo $ver['afiliado_nick']; ?><br>
    <b>Nome Completo:</b> <?Php echo $ver['afiliado_nome']; ?>&nbsp;&nbsp;&nbsp;
    <b>CPF:</b> <?Php echo $ver['afiliado_cpf']; ?><br>
    <b>RG:</b> <?Php echo $ver['afiliado_rg']; ?>&nbsp;&nbsp;&nbsp;
    <b>Nascimento:</b> <?Php echo $ver['afiliado_nascimento']; ?>&nbsp;&nbsp;&nbsp;
    <b>Sexo:</b> <?Php echo $ver['afiliado_sexo']; ?><br>
    <?Php
    }
    ?>
    <b>Telefone:</b> <?Php echo $ver['afiliado_telefone']; ?>&nbsp;&nbsp;&nbsp;
    <b>Celular:</b> <?Php echo $ver['afiliado_celular']; ?><br>
    <b>E-mail:</b> <?Php echo $ver['afiliado_email']; ?><br>
    
    
    
    <b>Endereço:</b> <?Php echo $ver['afiliado_endereco']; ?>, <?Php echo $ver['afiliado_numero']; ?> - <?Php echo $ver['afiliado_complemento']; ?>&nbsp;&nbsp;&nbsp;
    <b>Bairro:</b> <?Php echo $ver['afiliado_bairro']; ?> <br>
    <b>Cidade/UF:</b> <?Php echo $ver['afiliado_cidade']; ?>/<?Php echo $ver['afiliado_estado']; ?> &nbsp;&nbsp;&nbsp;
    <b>CEP:</b> <?Php echo $ver['afiliado_cep']; ?><br>
    
    <b>Banco:</b> 
    <?Php
    $idBanco = $ver['afiliado_banco'];
	$sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_codigo='$idBanco'");
	$verBanco = mysqli_fetch_array($sqlBanco);
	echo strtoupper($verBanco['banco_nome'])." (".$idBanco.")";
	?>
    <br>
    <b>Tipo de Conta:</b> <?Php echo $ver['afiliado_tipoconta']; ?>&nbsp;&nbsp;&nbsp;
    <b>Agência:</b> <?Php echo $ver['afiliado_agencia_banco']; ?>&nbsp;&nbsp;&nbsp;
    <b>Conta:</b> <?Php echo $ver['afiliado_conta']; ?><br>
    <b>Observações:</b><br> <?Php echo $ver['afiliado_obs']; ?><br>
    
    
    
    
  </div>
</div>



</body>
</html>
