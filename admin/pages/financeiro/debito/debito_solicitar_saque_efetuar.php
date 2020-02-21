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
$contaAfiliado = $_POST['conta'];
$valor = $_POST['valor'];
$taxa = $_POST['taxa'];



date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$protocolo = "$id$ano$mes$dia$hora$min$seg";

$dias_de_prazo_para_pagamento = 2;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento * 86400));

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$contaAfiliado'");
$ver = mysqli_fetch_array($sql);
    $nacao = $ver['afiliado_nacao'];
    $banco = $ver['afiliado_banco'];

$sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$banco'");
$verBanco = mysqli_fetch_array($sqlBanco);    

if($nacao == "BRASIL"){
    $descricaoModo = "DOC/TED PARA ".$verBanco['banco_codigo']."-".strtoupper($verBanco['banco_nome'])." - AG: ".$ver['afiliado_agencia']." CONTA: ".$ver['afiliado_conta']."";
    $idBanco = $banco;
    $agencia = $ver['afiliado_agencia'];
    $conta = $ver['afiliado_conta'];
    $iban = "";
    $swift = "";
}else{
    $descricaoModo = "DOC/TED PARA IBAN: ".$ver['afiliado_iban']." - SWIFT: ".$ver['afiliado_swift']."";
    $idBanco = "";
    $agencia = "";
    $conta = "";
    $iban = $ver['afiliado_iban'];
    $swift = $ver['afiliado_swift'];
}

$modoTransferencia = "Transferencia Bancaria";

if($ver['afiliado_conta_modo'] == "Fisica"){
    $favorecido = strtoupper($ver['afiliado_nome']);
    $documento = $ver['afiliado_cpf'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $favorecido = strtoupper($ver['afiliado_razao']);
    $documento = $ver['afiliado_cnpj'];
}


$insertComissao = mysqli_query($conexao, "INSERT INTO sps_extrato(extrato_afiliado_id, extrato_empresa, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_protocolo, extrato_status_saque, extrato_data_deposito, extrato_modo_saque, extrato_tipo_modo) VALUES ('$contaAfiliado', '$empresa', '$valor', 'Retirada', '$descricaoModo', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', '$protocolo', 'Pendente', '$data_dia/$data_mes/$data_ano', '$modoTransferencia', 'Retirada')", $ellevar);

if($insertComissao == '1'){

$inserir = mysqli_query($conexao, "INSERT INTO sps_retiradas(retirada_afiliado_id, retirada_empresa, retirada_nacao, retirada_protocolo, retirada_valor, retirada_banco, retirada_agencia, retirada_conta, retirada_iban, retirada_swift, retirada_tipo, retirada_modo, retirada_favorecido, retirada_documento, retirada_dia, retirada_mes, retirada_ano, retirada_data, retirada_hora, retirada_previsao, retirada_status) VALUES ('$contaAfiliado', '$empresa', '$nacao', '$protocolo', '$valor', '$idBanco', '$agencia', '$conta', '$iban', '$swift', 'Conta Corrente', 'Credito em Conta', '$favorecido', '$documento', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', '$data_dia/$data_mes/$data_ano', 'Pendente')", $ellevar);


 echo "<h2 class='w3-xlarge w3-center'>Solicitação de Saque efetuada com sucesso!</h2><br>";
	echo"<a href='debito_solicitar_saque.php?id=".$id."&&empresa=".$empresa."'><button name='limpar' class='w3-round w3-input w3-button w3-blue w3-padding-16' type='button'>Solicitar Saque</button></a>";
    

}else{
	echo "<h2 class='w3-xlarge w3-center'>Erro ao solicitar o saque!</h2><br>";
	echo"<a href='debito_solicitar_saque.php?id=".$id."&&empresa=".$empresa."'><button name='limpar' class='w3-round w3-input w3-button w3-blue w3-padding-16' type='button'>Solicitar Saque</button></a>";
}
?>
</div>
<div class="w3-third">&nbsp;</div>
</div><br>

</body>
</html>