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

<?php
require "../../../../config/config.php"; 

$id = $_POST['id'];
$empresa = $_POST['empresa'];
$conta = $_POST['conta'];
$taxa = "0.00";
$valorCrypt = $_POST['valor'];
$tipo = $_POST['tipo'];

$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$conta' AND afiliado_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);
    $banco = $ver['afiliado_banco'];
    $iban = $ver['afiliado_iban'];
    $nacao = $ver['afiliado_nacao'];
    
if($nacao == "BRASIL"){
    $dadosBanco = $banco;
}else{
    $dadosBanco = $iban;
}

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_razao']);
}

if($tipo == "Retirada"){
    $tipoNome = "SOLICITAÇÃO DE SAQUE";
}

if($taxa == "0"){
    $valorTaxa = "ISENTO";
}else{
    $valorTaxa = "R$ ".number_format($taxa,2,",",".");
}

if($ver['afiliado_id'] == ""){
?>

<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Conta não localizada ou Usuário Inexistente!</p>
</div> 

<?Php
}elseif($dadosBanco == ""){
?>

<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Esta Conta não possui dados bancários cadastrado!</p>
</div> 

<?Php
}else{
?>

<h2 class="w3-xlarge botao w3-center">Retirar Valor</h2>

<hr class="w3-border-black">   

<div class="w3-third">&nbsp;</div>
<div class="w3-third">
    
<strong>Conta:</strong> <?Php echo $conta."-".$ver['afiliado_codigo'].""; ?> <br>
<strong>Titular:</strong> <?Php echo $nome; ?> <br>
<strong>Valor solicitado:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br />
<br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="debito_solicitar_saque_efetuar.php" name="form" method="post">

<input type="hidden" name="id" value="<?Php echo $id; ?>" />
<input type="hidden" name="empresa" value="<?Php echo $empresa; ?>" />
<input type="hidden" name="conta" value="<?Php echo $conta; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="taxa" value="<?Php echo $taxa; ?>" />

<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" name="inserir" class="w3-input w3-padding-16 w3-button w3-green btn-lg" type="submit"><i class="glyphicon glyphicon-ok"></i> Sim</button></div>
<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" onClick="location.href='debito_solicitar_saque.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>'"  name="nao" class="w3-input w3-padding-16 w3-text-white w3-button w3-red btn-lg" type="reset"><i class="glyphicon glyphicon-ok"></i> Não</button></div>
    

</div>
<div class="w3-third">&nbsp;</div>


<?Php
}
?>

</form>
</div><br><br>
</body>
</html>