<!DOCTYPE html>
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
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Limite de Crédito</span></div>
<?php
require "../../../config/config.php"; 

$id = $_POST['id'];
$valorCrypt = $_POST['valor'];


$sqlCredito = mysql_query("SELECT * FROM sps_extrato_credito WHERE extrato_afiliado_id='$id' ORDER BY extrato_id ASC LIMIT 1");
$verCredito = mysql_fetch_array($sqlcredito);
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

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysql_fetch_array($sql);
	$nome = strtoupper($ver['afiliado_nome']);
?>

<strong>Dados do Afiliado</strong><br /><br />
<strong>Afiliado:</strong> <?Php echo "(".strtoupper($id).") ".$nome.""; ?><br />
<strong>Valor do Limite Aprovado:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br /><br>
<strong>Data Vencimento Fatura:</strong> <?Php echo "".$vencimento.""; ?><br />
<strong>Data Fechamento Fatura:</strong> <?Php echo "".$datalimite.""; ?><br />
<strong>Crédito Financiado?</strong> <?Php echo "".$tipo.""; ?><br /><br />

<strong>Os dados acima est&atilde;o Corretos?</strong><br /><br />

<form action="credito_limite_inserir.php" name="form" method="post">

<input type="hidden" name="id" value="<?Php echo $id; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="tipo" value="<?Php echo $tipo; ?>" />


    <button name="inserir" class="btn btn-success btn-sm" type="submit">Sim</button> | 
    <a href="javascript:location.href='credito.php';"><button name="limpar" class="btn btn-danger btn-sm" type="button">N&atilde;o</button></a>
    </td>
    </tr>
</table>

</form>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>