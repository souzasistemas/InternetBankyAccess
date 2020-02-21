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

<div class="col-sm-2">&nbsp;</div>


<div class="col-sm-8">
    <div class="well well-sm">
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Inserir Venda</span></div>
<?php
require "../../../config/config.php";

$loja = $_POST['loja'];
$id = $_POST['afiliado'];
$valor = $_POST['valor'];
$indicador = $_POST['consultor'];

$parcela = $_POST['parcela'];

$pdv = "Adm";


date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$autorizacao = "$loja$dia$mes$ano2$id$hora$min$seg";






/*** identificar loja  */
$sqlLoja = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$loja'");
$verLoja = mysql_fetch_array($sqlLoja);
	$mcc = $verLoja['estabelecimento_segmento'];
	$bonus = $verLoja['estabelecimento_bonus'];
	$consultor = $verLoja['estabelecimento_afiliado_id'];
	$fantasia = $verLoja['estabelecimento_fantasia'];





	
/** ver segmento e taxa */
$sqlSegmento = mysql_query("SELECT * FROM sps_segmento WHERE segmento_mmc='$mcc'");
$verSegmento = mysql_fetch_array($sqlSegmento);

if($parcela == "1"){
	$taxa = $verSegmento['segmento_avista'];
}elseif($parcela == "2"){
	$taxa = $verSegmento['segmento_P1'];
}elseif($parcela == "3"){
	$taxa = $verSegmento['segmento_P1'];
}elseif($parcela == "4"){
	$taxa = $verSegmento['segmento_P1'];
}elseif($parcela == "5"){
	$taxa = $verSegmento['segmento_P1'];
}elseif($parcela == "6"){
	$taxa = $verSegmento['segmento_P1'];
}elseif($parcela == "7"){
	$taxa = $verSegmento['segmento_p2'];
}elseif($parcela == "8"){
	$taxa = $verSegmento['segmento_p2'];
}elseif($parcela == "9"){
	$taxa = $verSegmento['segmento_p2'];
}elseif($parcela == "10"){
	$taxa = $verSegmento['segmento_p2'];
}elseif($parcela == "11"){
	$taxa = $verSegmento['segmento_p2'];
}elseif($parcela == "12"){
	$taxa = $verSegmento['segmento_p2'];
}
	

$sqlCoeficiente = mysql_query("SELECT * FROM sps_taxa_coeficiente");
$verCoeficiente = mysql_fetch_array($sqlCoeficiente);

/*** coeficiente das parcelas */

$parcela1 = $verCoeficiente['taxa_parcela1'];
$parcela2 = $verCoeficiente['taxa_parcela2'];
$parcela3 = $verCoeficiente['taxa_parcela3'];
$parcela4 = $verCoeficiente['taxa_parcela4'];
$parcela5 = $verCoeficiente['taxa_parcela5'];
$parcela6 = $verCoeficiente['taxa_parcela6'];
$parcela7 = $verCoeficiente['taxa_parcela7'];
$parcela8 = $verCoeficiente['taxa_parcela8'];
$parcela9 = $verCoeficiente['taxa_parcela9'];
$parcela10 = $verCoeficiente['taxa_parcela10'];
$parcela11 = $verCoeficiente['taxa_parcela11'];
$parcela12 = $verCoeficiente['taxa_parcela12'];




/**VENCIMENTO AFILIADO */
$sqlAfiliadoVencimento = mysql_query("SELECT * FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$verAfiliadoVencimento = mysql_fetch_array($sqlAfiliadoVencimento);
	$dataAfiliado = $verAfiliadoVencimento['extrato_data_vencimento'];
	$dataLimite = $verAfiliadoVencimento['extrato_data_limite'];
	

if($dataAfiliado == ""){
	$dataVencimento = "05";
}else{
	$dataVencimento = $dataAfiliado;
}
	
	


if($dia  > $dataLimite){

if($parcela == "1"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

}elseif($parcela == "2"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

}elseif($parcela == "3"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

}elseif($parcela == "4"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

}elseif($parcela == "5"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

}elseif($parcela == "6"){

$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

}elseif($parcela == "7"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

}elseif($parcela == "8"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 288;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

}elseif($parcela == "9"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 288;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 320;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

}elseif($parcela == "10"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 288;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 320;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 352;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

}elseif($parcela == "11"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 288;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 320;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 352;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 384;
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));




}elseif($parcela == "12"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 45;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 96;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 128;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 160;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 192;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 224;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 256;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 288;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 320;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 352;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 384;
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));

$dias_de_prazo_para_pagamento_afiliado12 = 416;
$data_mes_afiliado12 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));
$data_ano_afiliado12 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));

}

}elseif($dia  <= $dataLimite){


if($parcela == "1"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

}elseif($parcela == "2"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date($data_mes_afiliado1, time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

}elseif($parcela == "3"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

}elseif($parcela == "4"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

}elseif($parcela == "5"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

}elseif($parcela == "6"){

$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

}elseif($parcela == "7"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

}elseif($parcela == "8"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

}elseif($parcela == "9"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

}elseif($parcela == "10"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

}elseif($parcela == "11"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 352;
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));


}elseif($parcela == "12"){
	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 352;
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));

$dias_de_prazo_para_pagamento_afiliado12 = 384;
$data_mes_afiliado12 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));
$data_ano_afiliado12 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));

}
}










/* DATA REPASSE */
if($parcela == "1"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

}elseif($parcela == "2"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

}elseif($parcela == "3"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

}elseif($parcela == "4"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

}elseif($parcela == "5"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

}elseif($parcela == "6"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));


}elseif($parcela == "7"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

}elseif($parcela == "8"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 248;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

}elseif($parcela == "9"){

$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 248;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 279;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));


}elseif($parcela == "10"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 248;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 279;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 310;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));

}elseif($parcela == "11"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 248;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 279;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 310;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));

$dias_de_prazo_para_pagamento_loja11 = 341;
$data_dia_loja11  = date("d", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_mes_loja11  = date("m", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_ano_loja11  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));


}elseif($parcela == "12"){
	
$dias_de_prazo_para_pagamento_loja1 = 31;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 62;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 93;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 124;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 155;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 186;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 217;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 248;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 279;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 310;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));

$dias_de_prazo_para_pagamento_loja11 = 341;
$data_dia_loja11  = date("d", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_mes_loja11  = date("m", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_ano_loja11  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));

$dias_de_prazo_para_pagamento_loja12 = 372;
$data_dia_loja12  = date("d", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
$data_mes_loja12  = date("m", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
$data_ano_loja12  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
}
/* FIM DATA REPASSE */




if($parcela == "1"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela1;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */

$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";
	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);



if($inserirVenda1 == "1"){
	
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  

  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}



}elseif($parcela == "2"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela2;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";

	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);


if($inserirVenda2 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>

<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}


}elseif($parcela == "3"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela3;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


if($inserirVenda3 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}


}elseif($parcela == "4"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela4;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


if($inserirVenda4 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}


}elseif($parcela == "5"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela5;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";

	

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


if($inserirVenda5 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<strong><?php echo $row_vendas['movimento_dia']; ?></strong>
<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}

}elseif($parcela == "6"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela6;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);



if($inserirVenda6 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}

}elseif($parcela == "7"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela7;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


if($inserirVenda7 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}

}elseif($parcela == "8"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela8;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '8', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);


if($inserirVenda8 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}


}elseif($parcela == "9"){
	
$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela9;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '8', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);

$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '9', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);


if($inserirVenda9 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);




/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}


}elseif($parcela == "10"){


$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela10;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '8', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);

$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '9', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);


$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);



if($inserirVenda10 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





	/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>

    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}	
	
	
}elseif($parcela == "11"){


$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela11;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";

	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '8', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);

$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '9', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);


$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);


$inserirVenda11 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '11', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja11', '$data_mes_loja11', '$data_ano_loja11', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado11', '$data_ano_afiliado11')", $ellevar);



if($inserirVenda11 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





	/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

	<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>/<?php echo $row_vendas['movimento_mes']; ?>/<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
   <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
</table>
</div>
<?Php		
		
}else{
	echo "<h1>Venda não realizada! Tentar novamente</h1>";
}	

}elseif($parcela == "12"){

$valorParcela = $valor / $parcela;
$parcelaAfiliado = $valor * $parcela12;
$bonusAfiliado = $valorParcela * $bonus;/***base comissaoAfiliado */
$bonusAfiliado2 = $valor * $bonus;/***base comissaoAfiliado */
$base1 = $valorParcela * $taxa;
$base2 = 0.12 / $parcela;
$comissaoAfiliado = ($base1 - $base2) * 0.125;

$totalTaxa = $base1 + $base2;


$base12 = $valor * $taxa;
$base22 = 0.12 ;
$comissaoAfiliado2 = ($base12 - $base22) * 0.125;

$totalTaxa2 = $base12 + $base22;


$valorRepasse = $valorParcela - $totalTaxa - $bonusAfiliado;


$comissaoAport = $totalTaxa2 * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa2 * 0.005;
$idImposto = "2";


	
$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);


$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '2', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '3', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);


$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '4', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);


$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '5', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);


$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '6', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '7', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);


$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '8', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);

$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '9', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);


$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);


$inserirVenda11 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '11', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja11', '$data_mes_loja11', '$data_ano_loja11', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado11', '$data_ano_afiliado11')", $ellevar);


$inserirVenda12 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '12', '$parcela', '$valorParcela', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja12', '$data_mes_loja12', '$data_ano_loja12', '$horario', 'Pendente', '$dataVencimento', '$data_mes_afiliado12', '$data_ano_afiliado12')", $ellevar);


if($inserirVenda12 == "1"){/*** cashBack Afiliado */
/*** cashBack Afiliado */

/*** Taxa Administrativa Empresa */
$inserirLucro = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$totalTaxa', 'Taxa', 'Taxa Administrativa sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);



/*** Imposto */
$inserirImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$comissaoImposto', 'Taxa', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Imposto sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);





/*** Aport */

$inserirAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$comissaoAport', 'Taxa', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAport', 'Saque', 'Recolhimento Aport sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);



/*** comissao Consultor */

$sqlConsultor2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$consultor'");
$verConsultor2 = mysql_fetch_array($sqlConsultor2);
	$idPatrocinador2 = $verConsultor2['afiliado_indicador'];
	
if($idPatrocinador2 == "247"){

$inserirConsultor1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('247', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$inserirConsultor2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$afiliadoAcesso', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

}else{
	
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoAfiliado', 'Comissao', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

$DebitarConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('4', '$comissaoAfiliado', 'Saque', 'Comissão sobre movimentação no estabelecimento $loja - $fantasia para o Consultor $consultor', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
}


/*** cashBack Afiliado */
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado2', 'Transferencia', 'Bonificação na movimentação no Estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);






/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_protocolo_venda='$autorizacao'");
$row_vendas = mysql_fetch_array($sqlVendas);

$id_lojista = $row_vendas['movimento_estabelecimento_id'];
$sqlLojas = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id_lojista'");
$row_loja = mysql_fetch_array($sqlLojas);

$id_usuario = $row_vendas['movimento_afiliado_id'];
$sqlUsuarios = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id_usuario'");
$row_usuario = mysql_fetch_array($sqlUsuarios);


?>


<table width="400" border="0" cellspacing="1" cellpadding="0" style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">

<tr>
    <td rowspan="4" align="center" valign="middle"><img src="https://www.redetradecard.com.br/img/logo.png" width="80" /></td>
    <td height="15" width="141" valign="middle"><strong> TRADE CARD</strong></td>
  </tr>
  
  <tr>
    <td valign="middle" width="256" ><strong> https://redetradecard.com.br</strong></td>
  </tr>
  
  <tr>
    <td valign="middle"><strong>atendimento@redetradecard.com.br</strong></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><strong><em> "Obrigado e volte sempre"</em></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - CRÉDITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Estab.</td>
    <td><strong><?php echo $row_vendas['movimento_estabelecimento_id']; ?></strong> - <strong><?php echo $row_loja['estabelecimento_fantasia']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Data</td>
    <td><strong><?php echo $row_vendas['movimento_dia']; ?>//<?php echo $row_vendas['movimento_ano']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Hora</td>
    <td><strong><?php echo $row_vendas['movimento_hora']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Parcela</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td>Quanti.</td>
    <td><strong><?php echo $row_vendas['movimento_total_parcela']; ?></strong></td>
  </tr>
  
  <tr>
    <td>Total</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor']*$row_vendas['movimento_total_parcela'],2,",",".").''; ?></strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>N&uacute;mero Cart&atilde;o</td>
    <td><strong>6298 47** **** ****</strong></td>
  </tr>
  
   <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle">Reconhe&ccedil;o e pagarei a import&acirc;ncia acima</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  
  
 
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" valign="middle"><strong>ESTE COMPROVANTE N&Atilde;O &Eacute; V&Aacute;LIDO COMO <BR />NOTA FISCAL</strong></td>
  </tr>
  

  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"> <a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Realizar Nova Venda</button></a></td>
  </tr>
  
  
  
  
</table>

</div>
<?Php		
		
}else{
    echo "<font size='2'>Venda não realizada</font><br>";
	echo"<a href='debito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Tentar Novamente</button></a>";
}
}
?>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>