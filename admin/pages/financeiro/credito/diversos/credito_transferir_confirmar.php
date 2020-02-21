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
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Transferência entre Cartões</span></div>
<?php
require "../../../config/config.php"; 

$id = $_POST['id'];
$id2 = $_POST['id2'];
$valorCrypt = $_POST['valor'];

if($id == $id2){
    echo "<script>history.back(-1);alert('Não é permitido realizar transferência para mesma conta!');</script>";
}else{
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

$descricao = strtoupper($_POST['descricao']);

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysql_fetch_array($sql);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_razao']);
}

$sql2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id2'");
$ver2 = mysql_fetch_array($sql2);

if($ver2['afiliado_conta_modo'] == "Fisica"){
    $nome2 = strtoupper($ver2['afiliado_nome']);
}elseif($ver2['afiliado_conta_modo'] == "Juridica"){
    $nome2 = strtoupper($ver2['afiliado_razao']);
}
?>

<strong>Dados da Transferência</strong><br /><br />
<strong>Conta à Debitar:</strong> <?Php echo "(".strtoupper($id).") ".$nome.""; ?><br />
<strong>Conta à Creditar:</strong> <?Php echo "(".strtoupper($id2).") ".$nome2.""; ?><br /><br />
<strong>Valor da Transferência:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br /><br />
<strong>Descri&ccedil;&atilde;o:</strong> <?Php echo "".$descricao.""; ?><br /><br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="credito_transferir_inserir.php" name="form" method="post">

<input type="hidden" name="id" value="<?Php echo $id; ?>" />
<input type="hidden" name="id2" value="<?Php echo $id2; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="descricao" value="<?Php echo $descricao; ?>" />


    <button name="inserir" class="btn btn-success btn-sm" type="submit">Sim</button> | 
    <a href="javascript:location.href='credito.php';"><button name="limpar" class="btn btn-danger btn-sm" type="button">N&atilde;o</button></a>
    </td>
    </tr>
</table>

</form>
<?Php } ?>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>