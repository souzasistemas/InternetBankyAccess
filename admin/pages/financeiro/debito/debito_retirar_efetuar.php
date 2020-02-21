<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo Acessomundi</title>
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
  	
  	<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>


<script src="../../js/mascara.js"></script>

<script type="application/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
</script>
  
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
  </style>
  
  <style media="print">
.botao {
display: none;
}
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
 
</head>
<body id="principal">

<div class="w3-container">

<h2 class="w3-xlarge botao w3-center">Retirar Valor</h2>

<hr class="w3-border-black">   

<div class="w3-third">&nbsp;</div>
<div class="w3-third">

<?php
require "../../../../config/config.php";   

$id = $_POST['id'];
$empresa = $_POST['empresa'];
$conta = $_POST['conta'];
$valor = $_POST['valor'];
$tipo = $_POST['tipo'];
$descricao = strtoupper($_POST['descricao']);

/** CONFIGURAÇÃO DE HORA */
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y H:i:s');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$hora = date('H:i:s');

$insertComissao = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_empresa, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo) VALUES ('$conta', '$empresa', '$valor', '$tipo', '$descricao', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$hora', 'Debito')", $ellevar);

if($insertComissao == '1'){

    echo "<h2 class='w3-xlarge w3-center'>Valor retirado com sucesso!</h2><br>";
	echo"<a href='debito_retirar_valor.php?id=".$id."&&empresa=".$empresa."'><button name='limpar' class='w3-round w3-input w3-button w3-blue w3-padding-16' type='button'>Inserir Valor</button></a>";
}else{
    echo "<h2 class='w3-xlarge w3-center'>Não foi possível retirar o valor solicitado</h2><br>";
	echo"<a href='debito_retirar_valor.php?id=".$id."&&empresa=".$empresa."'><button name='limpar' class='w3-round w3-input w3-button w3-blue w3-padding-16' type='button'>Tentar Novamente</button></a>";
}
?>
</div>
<div class="w3-third">&nbsp;</div>

</div><br>
</body>
</html>