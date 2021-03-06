﻿<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<script type="text/javascript" src="../js/mascara.js"></script>

<script language="javascript">
function show_credito()
{
	document.getElementById('credito').style.display='block';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='none';	
}
function show_limite()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='block';
	document.getElementById('comissao').style.display='none';	
}
function show_comissao()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='block';	
}
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

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<div class="col-sm-12" style="text-align:center;">
<h2>Entrada de Valores</h2><br>
</div>

<div class="col-sm-2">&nbsp;</div>


<div class="col-sm-8">
    <div class="well well-sm">
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Inserir Venda</span></div>
<?php
require "../../../config/config.php";

$idLoja = $_POST['idLoja'];
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$modo = $_POST['modo'];
$parcelaCredito = $_POST['parcelaCredito'];
$id = $_POST['id'];

if($modo == "1"){
	$arquivo = "debito_inserir_venda_credito.php";
	$nomeModo = "Crédito";
}elseif($modo == "2"){
	$arquivo = "debito_inserir_venda_debito.php";
	$nomeModo = "Débito";
}


$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysql_fetch_array($sql);
	$nome = strtoupper($ver['afiliado_nome']);
	$idAfiliado = strtoupper($ver['afiliado_id']);
	
$sqlLoja = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$idLoja'");
$verLoja = mysql_fetch_array($sqlLoja);
	$fantasia = strtoupper($verLoja['estabelecimento_fantasia']);
	$idCodigo = strtoupper($verLoja['estabelecimento_codigo']);
	
if($idCodigo != $idLoja){
	echo "<script>history.back(-1); alert('Estabelecimento não encontrado!');</script>";
}elseif($idAfiliado != $id){
	echo "<script>history.back(-1); alert('Afiliado Inexistente!');</script>";
}else{
?>

<strong>Dados da Venda</strong><br /><br />
<strong>Estabelecimento:</strong> <?Php echo " (".strtoupper($idCodigo).") ".$fantasia.""; ?><br />
<strong>Valor:</strong> <?Php echo " R$ ".number_format($valor,2,",",".").""; ?><br />
<strong>Modo:</strong> <?Php echo " ".$nomeModo.""; ?><br />
<strong>Parcela:</strong> <?Php echo " ".$parcelaCredito.""; ?><br /><br />

<strong>Conta:</strong> <?Php echo "(".strtoupper($id).") ".$nome.""; ?><br /><br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="<?php echo $arquivo; ?>" name="form" method="post">

<input type="hidden" name="loja" value="<?Php echo $idCodigo; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="parcela" value="<?Php echo $parcelaCredito; ?>" />
<input type="hidden" name="afiliado" value="<?Php echo $id; ?>" />
<input type="hidden" name="consultor" value="<?Php echo $ver['afiliado_indicador']; ?>" />



    <button name="inserir" class="btn btn-success btn-sm" type="submit">Sim</button> | 
    <a href="javascript:location.href='debito.php';"><button name="limpar" class="btn btn-danger btn-sm" type="button">N&atilde;o</button></a>
    </td>
    </tr>
</table>

</form>
<?Php
}
?>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>