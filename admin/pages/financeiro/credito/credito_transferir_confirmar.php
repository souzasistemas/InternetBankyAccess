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
 
</head>
<body id="principal">

<div class="w3-container">

<?php
require "../../../../config/config.php";

$id = $_POST['id'];
$empresa = $_POST['empresa'];
$contaDebito = $_POST['contaDebito'];
$contaCredito = $_POST['contaCredito'];
$valorCrypt = $_POST['valor'];

if($contaDebito == $contaCredito){
?>
<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Não é permitido realizar transferência para mesma conta!</p>
</div> 
    
<?Php
}else{
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

$sql1 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$contaDebito' AND afiliado_empresa='$empresa' AND afiliado_status='Ativo'");
$ver1 = mysqli_fetch_array($sql1);
    $id1 = $ver1['afiliado_id'];
    $codigo1 = $ver1['afiliado_codigo'];

if($ver1['afiliado_conta_modo'] == "Fisica"){
    $nome1 = strtoupper($ver1['afiliado_nome']);
}elseif($ver1['afiliado_conta_modo'] == "Juridica"){
    $nome1 = strtoupper($ver1['afiliado_razao']);
}
	
$sql2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$contaCredito' AND afiliado_empresa='$empresa' AND afiliado_status='Ativo'");
$ver2 = mysqli_fetch_array($sql2);
	$id2 = $ver2['afiliado_id'];
	$codigo2 = $ver2['afiliado_codigo'];
	
if($ver2['afiliado_conta_modo'] == "Fisica"){
    $nome2 = strtoupper($ver2['afiliado_nome']);
}elseif($ver2['afiliado_conta_modo'] == "Juridica"){
    $nome2 = strtoupper($ver2['afiliado_razao']);
}

$descricao1 = "TRANSFERENCIA REALIZADA PARA A CONTA $id2-$codigo2";
$descricao2 = "TRANSFERENCIA RECEBIDA DA CONTA $id1-$codigo1";

if($id1 == ""){
?>
<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Número da Conta onde será DEBITADO o valor está Incorreto e/ou Inexistente e/ou Pendente de Desbloqueio</p>
</div>
<?Php
}elseif($id2 == ""){
?>
<div class="w3-panel w3-red w3-center w3-round">
  <h3><b>DESCULPE!</b></h3>
  <p>Número da Conta onde será CREDITADO o valor está Incorreto e/ou Pendente de Desbloqueio</p>
</div>
<?Php
}else{
?>

<h2 class="w3-xlarge botao w3-center">Transferência entre contas</h2>
<hr class="w3-border-black">

<div class="w3-third">&nbsp;</div>
<div class="w3-third">
    
<strong>Conta à Debitar / Titular:</strong> <?Php echo "(".strtoupper($contaDebito)."-".$ver1['afiliado_codigo'].") ".$nome1.""; ?><br /><br>
<strong>Conta à Creditar / Titular:</strong> <?Php echo "(".strtoupper($contaCredito)."-".$ver2['afiliado_codigo'].") ".$nome2.""; ?><br /><br>
<strong>Valor da Transferência:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br /><br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="credito_transferir_efetuar.php" name="form" method="post">

<input type="hidden" name="id" value="<?Php echo $id; ?>" />
<input type="hidden" name="empresa" value="<?Php echo $empresa; ?>" />
<input type="hidden" name="contaDebito" value="<?Php echo $contaDebito; ?>" />
<input type="hidden" name="contaCredito" value="<?Php echo $contaCredito; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="descricao1" value="<?Php echo $descricao1; ?>" />
<input type="hidden" name="descricao2" value="<?Php echo $descricao2; ?>" />

<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" name="inserir" class="w3-input w3-padding-16 w3-button w3-green btn-lg" type="submit"><i class="glyphicon glyphicon-ok"></i> Sim</button></div>
<div class="w3-half" style="margin-bottom:10px;"><button style="width:99%" onClick="location.href='credito_transferir.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>'"  name="nao" class="w3-input w3-padding-16 w3-text-white w3-button w3-red btn-lg" type="reset"><i class="glyphicon glyphicon-ok"></i> Não</button></div>



</form>

</div>
<div class="w3-third">&nbsp;</div>
<?Php }} ?>

</div>
</body>
</html>