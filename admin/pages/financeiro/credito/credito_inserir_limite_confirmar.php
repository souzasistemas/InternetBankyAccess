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

<!--  	
<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>
-->

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

<script language="javascript">
//-----------------------------------------------------
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>


<script language="javascript">
function show_loja1()
{
	document.getElementById('loja1').style.display='block';
	document.getElementById('loja2').style.display='none';
}
function show_loja2()
{
	document.getElementById('loja1').style.display='none';
	document.getElementById('loja2').style.display='block';
}
</script>
 
</head>
<body id="principal">

<div class="w3-container">

<?php
require "../../../../config/config.php";

$id = $_POST['id'];
$empresa = $_POST['empresa'];
$conta = $_POST['conta'];
$valorCrypt = $_POST['valor'];


$sqlCredito = mysqli_query($conexao, "SELECT * FROM sps_extrato_credito WHERE extrato_afiliado_id='$conta' ORDER BY extrato_id ASC LIMIT 1");
$verCredito = mysqli_fetch_array($sqlcredito);
	$idCredito = $verCredito['extrato_afiliado_id'];
	
if($idCredito == ""){
	$vencimento = "05";
	$datalimite = "25";
}else{
	$vencimento = $verCredito['extrato_data_vencimento'];
	$datalimite = $verCredito['extrato_data_limite'];
}

$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$descricao = strtoupper($_POST['descricao']);
$tipo = $_POST['tipo'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$conta' AND afiliado_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_razao']);
}

$loja = $_POST['loja'];

if($loja == ""){
    $idLoja = $empresa;
}else{
    $idLoja = $loja;
}

$sql2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idLoja'");
$ver2 = mysqli_fetch_array($sql2);
    $fantasia = $ver2['afiliado_fantasia'];

if($ver['afiliado_id'] == ""){
?>

<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Conta não localizada ou Usuário Inexistente!</p>
</div> 

<?Php
}else{
?>
    <h2 class="w3-xlarge w3-center">Inserir Limite de Crédito</h2>


<hr class="w3-border-black">    

<div class="w3-third">&nbsp;</div>
<div class="w3-third">

<strong>Conta:</strong> <?Php echo $conta."-".$ver['afiliado_codigo'].""; ?> <br>
<strong>Titular:</strong> <?Php echo $nome; ?> <br>
<strong>Valor do Limite Aprovado:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br />
<strong>Data Vencimento Fatura:</strong> <?Php echo "".$vencimento.""; ?><br />
<strong>Data Fechamento Fatura:</strong> <?Php echo "".$datalimite.""; ?><br />

<?Php
if($tipo == "Nao"){
}else{
?>
<strong>Crédito Financiado?</strong> <?Php echo "".$tipo.""; ?><br />
<strong>Financiador: </strong> <?Php echo "".$idLoja." - ".$fantasia.""; ?>
<br />
<?Php
}
?>
<br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="credito_inserir_limite_efetuar.php" name="form" method="post">

<input type="hidden" name="id" value="<?Php echo $id; ?>" />
<input type="hidden" name="empresa" value="<?Php echo $empresa; ?>" />
<input type="hidden" name="conta" value="<?Php echo $conta; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="tipo" value="<?Php echo $tipo; ?>" />
<input type="hidden" name="loja" value="<?Php echo $idLoja; ?>" />

<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" name="inserir" class="w3-input w3-padding-16 w3-button w3-green btn-lg" type="submit"><i class="glyphicon glyphicon-ok"></i> Sim</button></div>
<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" onClick="location.href='credito_inserir_limite.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>'"  name="nao" class="w3-input w3-padding-16 w3-text-white w3-button w3-red btn-lg" type="reset"><i class="glyphicon glyphicon-ok"></i> Não</button></div>

</form>
</div>

<div class="w3-third">&nbsp;</div>

<?Php
}
?>

</div>
</body>
</html>