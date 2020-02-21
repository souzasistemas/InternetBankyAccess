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

<SCRIPT LANGUAGE="JavaScript">   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   
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

body#principal{
    background-color:#F4F4F4;
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

html, body, div, iframe {margin:0; padding:0; height:100%}
iframe {display:block; width:100%; border:none}

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
    <h2 class="w3-xxx-large botao">Realizar Transação TEFI</h2>


<hr class="w3-border-black">    

<?php
require "../../../../../config/config.php";  

$idLoja = $_POST['idLoja'];
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$modo = $_POST['modo'];
$parcelaCredito = $_POST['parcelaCredito'];
$id = $_POST['id'];

if($modo == "1"){
	$arquivo = "debito_transacao_modo_credito.php";
	$nomeModo = "Crédito";
}elseif($modo == "2"){
	$arquivo = "debito_transacao_modo_debito.php";
	$nomeModo = "Débito";
}

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysql_fetch_array($sql);
	$idAfiliado = strtoupper($ver['afiliado_id']);
	
$sqlLoja = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$idLoja'");
$verLoja = mysql_fetch_array($sqlLoja);
	$fantasia = strtoupper($verLoja['estabelecimento_fantasia']);
	$idCodigo = strtoupper($verLoja['estabelecimento_codigo']);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_razao']);
}

if($idCodigo != $idLoja){
	echo "<script>history.back(-1); alert('Estabelecimento não encontrado!');</script>";
}elseif($idAfiliado != $id){
	echo "<script>history.back(-1); alert('Afiliado Inexistente!');</script>";
}else{
    
$sqlCoeficiente = mysql_query("SELECT * FROM sps_taxa_coeficiente");
$verCoeficiente = mysql_fetch_array($sqlCoeficiente);

if($modo == "2"){
    $valorParcela = $valor;
}elseif($modo == "1"){
    if($parcelaCredito == "01"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela1'];
    }elseif($parcelaCredito == "02"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela2'];
    }elseif($parcelaCredito == "03"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela3'];
    }elseif($parcelaCredito == "04"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela4'];
    }elseif($parcelaCredito == "05"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela5'];
    }elseif($parcelaCredito == "06"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela6'];
    }elseif($parcelaCredito == "07"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela7'];
    }elseif($parcelaCredito == "08"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela8'];
    }elseif($parcelaCredito == "09"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela9'];
    }elseif($parcelaCredito == "10"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela10'];
    }elseif($parcelaCredito == "11"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela14'];
    }elseif($parcelaCredito == "12"){
        $valorParcela = $valor * $verCoeficiente['taxa_parcela12'];
    }
}

?>

<strong>Dados da Venda</strong><br /><br />
<strong>Estabelecimento:</strong> <?Php echo " (".strtoupper($idCodigo).") ".$fantasia.""; ?><br />
<strong>Valor:</strong> <?Php echo " R$ ".number_format($valor,2,",",".").""; ?><br />
<strong>Modo:</strong> <?Php echo " ".$nomeModo.""; ?><br />
<strong>Parcela:</strong> <?Php echo " ".$parcelaCredito.""; ?> Parcela(s)<br />
<strong>Valor por Parcela:</strong> <?Php echo " R$ ".number_format($valorParcela,2,",",".").""; ?><br /><br />

<strong>Conta:</strong> <?Php echo "(".strtoupper($id).") ".$nome.""; ?><br /><br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="<?php echo $arquivo; ?>" name="form" method="post">

<input type="hidden" name="loja" value="<?Php echo $idCodigo; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="parcela" value="<?Php echo $parcelaCredito; ?>" />
<input type="hidden" name="afiliado" value="<?Php echo $id; ?>" />
<input type="hidden" name="consultor" value="<?Php echo $ver['afiliado_indicador']; ?>" />



    <button name="inserir" class="btn btn-success btn-lg" type="submit">Sim</button> | 
    <a href="debito_transacao.php"><button name="limpar" class="btn btn-danger btn-lg" type="button">N&atilde;o</button></a>


<?Php
}
?>

</div>
</body>
</html>