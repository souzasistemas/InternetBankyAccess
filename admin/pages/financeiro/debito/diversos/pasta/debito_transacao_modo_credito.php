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
	
/** ver segmento */
$sqlSegmento = mysql_query("SELECT * FROM sps_segmento WHERE segmento_mmc='$mcc'");
$verSegmento = mysql_fetch_array($sqlSegmento);

$sqlCoeficiente = mysql_query("SELECT * FROM sps_taxa_coeficiente");
$verCoeficiente = mysql_fetch_array($sqlCoeficiente);


if($parcela == "01"){
    
	$taxa = $verSegmento['segmento_avista'];
	$taxaParcela = $verCoeficiente['taxa_parcela1'];

/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
/*** fim parcela associado */

/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
/* FIM DATA REPASSE */


}elseif($parcela == "02"){
	$taxa = $verSegmento['segmento_P1'];
	$taxaParcela = $verCoeficiente['taxa_parcela2'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
/* FIM DATA REPASSE */




}elseif($parcela == "03"){
	$taxa = $verSegmento['segmento_P1'];
	$taxaParcela = $verCoeficiente['taxa_parcela3'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
/* FIM DATA REPASSE */





}elseif($parcela == "04"){
	$taxa = $verSegmento['segmento_P1'];
	$taxaParcela = $verCoeficiente['taxa_parcela4'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
/*** fim parcela associado */



/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
/* FIM DATA REPASSE */




}elseif($parcela == "05"){
	$taxa = $verSegmento['segmento_P1'];
	$taxaParcela = $verCoeficiente['taxa_parcela5'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
/*** fim parcela associado */



/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
/* FIM DATA REPASSE */




}elseif($parcela == "06"){
	$taxa = $verSegmento['segmento_P1'];
	$taxaParcela = $verCoeficiente['taxa_parcela6'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
/* FIM DATA REPASSE */






}elseif($parcela == "07"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela7'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
/*** fim parcela associado */



/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
/* FIM DATA REPASSE */





}elseif($parcela == "08"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela8'];
	
/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_dia_afiliado8 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 256;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
/* FIM DATA REPASSE */





}elseif($parcela == "09"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela9'];

/*** parcela associado */	
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_dia_afiliado8 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_dia_afiliado9 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 256;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 288;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
/* FIM DATA REPASSE */



}elseif($parcela == "10"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela10'];
	
/*** parcela associado */
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_dia_afiliado8 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_dia_afiliado9 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_dia_afiliado10 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));
/*** fim parcela associado */

/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 256;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 288;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 320;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
/* FIM DATA REPASSE */



}elseif($parcela == "11"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela11'];
	
/*** parcela associado */
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_dia_afiliado8 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_dia_afiliado9 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_dia_afiliado10 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 352;
$data_dia_afiliado11 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));
/*** fim parcela associado */

/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 256;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 288;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 320;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));

$dias_de_prazo_para_pagamento_loja11 = 352;
$data_dia_loja11  = date("d", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_mes_loja11  = date("m", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_ano_loja11  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
/* FIM DATA REPASSE */


}elseif($parcela == "12"){
	$taxa = $verSegmento['segmento_p2'];
	$taxaParcela = $verCoeficiente['taxa_parcela12'];
	
/*** parcela associado */
$dias_de_prazo_para_pagamento_afiliado1 = 32;
$data_dia_afiliado1 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_mes_afiliado1 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));
$data_ano_afiliado1 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = 64;
$data_dia_afiliado2 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_mes_afiliado2 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));
$data_ano_afiliado2 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$dias_de_prazo_para_pagamento_afiliado3 = 96;
$data_dia_afiliado3 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_mes_afiliado3 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));
$data_ano_afiliado3 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado3 * 86400));

$dias_de_prazo_para_pagamento_afiliado4 = 128;
$data_dia_afiliado4 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_mes_afiliado4 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));
$data_ano_afiliado4 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado4 * 86400));

$dias_de_prazo_para_pagamento_afiliado5 = 160;
$data_dia_afiliado5 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_mes_afiliado5 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));
$data_ano_afiliado5 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado5 * 86400));

$dias_de_prazo_para_pagamento_afiliado6 = 192;
$data_dia_afiliado6 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_mes_afiliado6 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));
$data_ano_afiliado6 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado6 * 86400));

$dias_de_prazo_para_pagamento_afiliado7 = 224;
$data_dia_afiliado7 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_mes_afiliado7 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));
$data_ano_afiliado7 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado7 * 86400));

$dias_de_prazo_para_pagamento_afiliado8 = 256;
$data_dia_afiliado8 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_mes_afiliado8 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));
$data_ano_afiliado8 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado8 * 86400));

$dias_de_prazo_para_pagamento_afiliado9 = 288;
$data_dia_afiliado9 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_mes_afiliado9 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));
$data_ano_afiliado9 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado9 * 86400));

$dias_de_prazo_para_pagamento_afiliado10  = 320;
$data_dia_afiliado10 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_mes_afiliado10  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado10 * 86400));
$data_ano_afiliado10  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado10  * 86400));

$dias_de_prazo_para_pagamento_afiliado11  = 352;
$data_dia_afiliado11 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_mes_afiliado11  = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado11 * 86400));
$data_ano_afiliado11  = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado11  * 86400));

$dias_de_prazo_para_pagamento_afiliado12 = 384;
$data_dia_afiliado12 = date("d", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));
$data_mes_afiliado12 = date("m", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));
$data_ano_afiliado12 = date("Y", time() + ($dias_de_prazo_para_pagamento_afiliado12 * 86400));

/*** fim parcela associado */


/*** repasse estabelecimento */
$dias_de_prazo_para_pagamento_loja1 = 32;
$data_dia_loja1 = date("d", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_mes_loja1 = date("m", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));
$data_ano_loja1 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja1 * 86400));

$dias_de_prazo_para_pagamento_loja2 = 64;
$data_dia_loja2 = date("d", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_mes_loja2 = date("m", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));
$data_ano_loja2 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja2 * 86400));

$dias_de_prazo_para_pagamento_loja3 = 96;
$data_dia_loja3 = date("d", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_mes_loja3 = date("m", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));
$data_ano_loja3 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja3 * 86400));

$dias_de_prazo_para_pagamento_loja4 = 128;
$data_dia_loja4 = date("d", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_mes_loja4 = date("m", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));
$data_ano_loja4 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja4 * 86400));

$dias_de_prazo_para_pagamento_loja5 = 160;
$data_dia_loja5 = date("d", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_mes_loja5 = date("m", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));
$data_ano_loja5 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja5 * 86400));

$dias_de_prazo_para_pagamento_loja6 = 192;
$data_dia_loja6 = date("d", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_mes_loja6 = date("m", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));
$data_ano_loja6 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja6 * 86400));

$dias_de_prazo_para_pagamento_loja7 = 224;
$data_dia_loja7 = date("d", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_mes_loja7 = date("m", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));
$data_ano_loja7 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja7 * 86400));

$dias_de_prazo_para_pagamento_loja8 = 256;
$data_dia_loja8 = date("d", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_mes_loja8 = date("m", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));
$data_ano_loja8 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja8 * 86400));

$dias_de_prazo_para_pagamento_loja9 = 288;
$data_dia_loja9 = date("d", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_mes_loja9 = date("m", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));
$data_ano_loja9 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja9 * 86400));

$dias_de_prazo_para_pagamento_loja10 = 320;
$data_dia_loja10 = date("d", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_mes_loja10 = date("m", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));
$data_ano_loja10 = date("Y", time() + ($dias_de_prazo_para_pagamento_loja10 * 86400));

$dias_de_prazo_para_pagamento_loja11 = 352;
$data_dia_loja11  = date("d", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_mes_loja11  = date("m", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));
$data_ano_loja11  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja11  * 86400));

$dias_de_prazo_para_pagamento_loja12 = 384;
$data_dia_loja12  = date("d", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
$data_mes_loja12  = date("m", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
$data_ano_loja12  = date("Y", time() + ($dias_de_prazo_para_pagamento_loja12  * 86400));
/* FIM DATA REPASSE */
}






/**** realizar as transações */

if($parcela == "01"){

/***base comissaoAfiliado */
$valorParcela = $valor / 1;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 1;

$bonusAfiliado1 = ($valor * $bonus) / 1;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 1) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 1;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);

if($inserirVenda1 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}




}elseif($parcela == "02"){

/***base comissaoAfiliado */
$valorParcela = $valor / 2;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 2;

$bonusAfiliado1 = ($valor * $bonus) / 2;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 2) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 2;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);

if($inserirVenda2 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}




}elseif($parcela == "03"){

/***base comissaoAfiliado */
$valorParcela = $valor / 3;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 3;

$bonusAfiliado1 = ($valor * $bonus) / 3;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 3) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 3;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);

if($inserirVenda3 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}


}elseif($parcela == "04"){

/***base comissaoAfiliado */
$valorParcela = $valor / 4;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 4;

$bonusAfiliado1 = ($valor * $bonus) / 4;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 4) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 4;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);

if($inserirVenda4 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}



}elseif($parcela == "05"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 5;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 5;

$bonusAfiliado1 = ($valor * $bonus) / 5;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 5) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 5;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);

if($inserirVenda5 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}





}elseif($parcela == "06"){

/***base comissaoAfiliado */
$valorParcela = $valor / 6;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 6;

$bonusAfiliado1 = ($valor * $bonus) / 6;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 6) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 6;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);

if($inserirVenda6 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}




}elseif($parcela == "07"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 7;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 7;

$bonusAfiliado1 = ($valor * $bonus) / 7;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 7) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 7;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);

if($inserirVenda7 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}



}elseif($parcela == "08"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 8;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 8;

$bonusAfiliado1 = ($valor * $bonus) / 8;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 8) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 8;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);
$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '08', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$data_dia_afiliado8', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);

if($inserirVenda8 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}



}elseif($parcela == "09"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 9;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 9;

$bonusAfiliado1 = ($valor * $bonus) / 9;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 9) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 9;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);
$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '08', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$data_dia_afiliado8', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);
$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '09', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$data_dia_afiliado9', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);

if($inserirVenda9 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}




}elseif($parcela == "10"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 10;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 10;

$bonusAfiliado1 = ($valor * $bonus) / 10;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 10) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 10;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);
$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '08', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$data_dia_afiliado8', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);
$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '09', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$data_dia_afiliado9', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);
$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$data_dia_afiliado10', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);

if($inserirVenda10 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}



}elseif($parcela == "11"){
    
/***base comissaoAfiliado */
$valorParcela = $valor / 11;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 11;

$bonusAfiliado1 = ($valor * $bonus) / 11;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 11) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 11;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);
$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '08', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$data_dia_afiliado8', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);
$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '09', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$data_dia_afiliado9', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);
$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$data_dia_afiliado10', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);
$inserirVenda11 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '11', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja11', '$data_mes_loja11', '$data_ano_loja11', '$horario', 'Pendente', '$data_dia_afiliado11', '$data_mes_afiliado11', '$data_ano_afiliado11')", $ellevar);

if($inserirVenda11 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}




}elseif($parcela == "12"){

/***base comissaoAfiliado */
$valorParcela = $valor / 12;
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = ($base1 + $base2) / 12;

$bonusAfiliado1 = ($valor * $bonus) / 12;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = ($bonusAfiliado1 * 12) + $bonusAfiliado2;

$valorRepasse = ($valor - $base3 - $bonusAfiliado1) / 12;
$parcelaAfiliado = $valor * $taxaParcela;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

$inserirVenda1 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '01', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja1', '$data_mes_loja1', '$data_ano_loja1', '$horario', 'Pendente', '$data_dia_afiliado1', '$data_mes_afiliado1', '$data_ano_afiliado1')", $ellevar);
$inserirVenda2 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '02', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja2', '$data_mes_loja2', '$data_ano_loja2', '$horario', 'Pendente', '$data_dia_afiliado2', '$data_mes_afiliado2', '$data_ano_afiliado2')", $ellevar);
$inserirVenda3 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '03', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja3', '$data_mes_loja3', '$data_ano_loja3', '$horario', 'Pendente', '$data_dia_afiliado3', '$data_mes_afiliado3', '$data_ano_afiliado3')", $ellevar);
$inserirVenda4 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '04', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja4', '$data_mes_loja4', '$data_ano_loja4', '$horario', 'Pendente', '$data_dia_afiliado4', '$data_mes_afiliado4', '$data_ano_afiliado4')", $ellevar);
$inserirVenda5 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '05', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja5', '$data_mes_loja5', '$data_ano_loja5', '$horario', 'Pendente', '$data_dia_afiliado5', '$data_mes_afiliado5', '$data_ano_afiliado5')", $ellevar);
$inserirVenda6 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '06', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja6', '$data_mes_loja6', '$data_ano_loja6', '$horario', 'Pendente', '$data_dia_afiliado6', '$data_mes_afiliado6', '$data_ano_afiliado6')", $ellevar);
$inserirVenda7 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '07', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja7', '$data_mes_loja7', '$data_ano_loja7', '$horario', 'Pendente', '$data_dia_afiliado7', '$data_mes_afiliado7', '$data_ano_afiliado7')", $ellevar);
$inserirVenda8 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '08', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja8', '$data_mes_loja8', '$data_ano_loja8', '$horario', 'Pendente', '$data_dia_afiliado8', '$data_mes_afiliado8', '$data_ano_afiliado8')", $ellevar);
$inserirVenda9 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '09', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja9', '$data_mes_loja9', '$data_ano_loja9', '$horario', 'Pendente', '$data_dia_afiliado9', '$data_mes_afiliado9', '$data_ano_afiliado9')", $ellevar);
$inserirVenda10 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '10', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja10', '$data_mes_loja10', '$data_ano_loja10', '$horario', 'Pendente', '$data_dia_afiliado10', '$data_mes_afiliado10', '$data_ano_afiliado10')", $ellevar);
$inserirVenda11 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '11', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja11', '$data_mes_loja11', '$data_ano_loja11', '$horario', 'Pendente', '$data_dia_afiliado11', '$data_mes_afiliado11', '$data_ano_afiliado11')", $ellevar);
$inserirVenda12 = mysql_query("INSERT INTO sps_movimentacao_credito(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_valor_afiliado, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano, movimento_pagamento_hora, movimento_status_afiliado, movimento_pagamento_dia_afiliado, movimento_pagamento_mes_afiliado, movimento_pagamento_ano_afiliado) VALUES ('$id', '$loja', '$pdv', 'Venda', '$dia', '$mes', '$ano', '$horario', '12', '$parcela', '$valorParcela', '$base3', '$bonusAfiliado1', '$valorRepasse', '$parcelaAfiliado', '$autorizacao', 'Em Aberto', '$data_dia_loja12', '$data_mes_loja12', '$data_ano_loja12', '$horario', 'Pendente', '$data_dia_afiliado12', '$data_mes_afiliado12', '$data_ano_afiliado12')", $ellevar);

if($inserirVenda12 == "1"){
    
    $inserirBonus = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Nao', 'Comissao', 'BONUS SOBRE A COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde1 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$consultor', '$comissaoCorrespondente1', 'Nao', 'Comissao', 'COMISSÃO SOBRE A VENDA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirCorresponde2 = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$indicador', '$comissaoCorrespondente2', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986284', '$comissaoDaniel', 'Nao', 'Comissao', 'COMISSÃO SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    $inserirAcessomundi = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('986281', '$comissaoAcessomundi', 'Nao', 'Taxa', 'TAXA ADMINISTRATIVA SOBRE COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia PELO ASSOCIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    
    echo "<h2>Transação realizada com sucesso!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}else{
    echo "<h2>Erro ao realizar essa transacao!</h2><br>";
	echo"<a href='debito_transacao.php'><button name='limpar' class='btn btn-primary btn-lg' type='button'>Realizar Nova Transação</button></a>";
}


}

?>

</div>
</body>
</html>