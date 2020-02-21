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
	$taxa = $verSegmento['segmento_debito'];
	
/***base comissaoAfiliado */
$base1 = $valor * $taxa;
$base2 = 0.30;
$base3 = $base1 + $base2;

$bonusAfiliado1 = $valor * $bonus;
$bonusAfiliado2 = $base1 * 0.01;
$bonusAfiliado = $bonusAfiliado1 + $bonusAfiliado2;

$valorRepasse = $valor - $base3 - $bonusAfiliado1;

$comissaoCorrespondente1 = $base1 * 0.1;
$comissaoCorrespondente2 = $base1 * 0.05;
$comissaoDaniel = ($base1 * 0.3) + 0.15;
$comissaoAcessomundi = ($base1 * 0.54) + 0.15;

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

/** PREVISÃO DE REPASSE */
$dias_de_prazo_para_pagamento2 = 3;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));


$inserirDebito = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$valor', 'Nao', 'Retirada', 'COMPRA REALIZADA NO ESTABELECIMENTO $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);

if($inserirDebito == "1"){
    
$inserirVenda = mysql_query("INSERT INTO sps_movimentacao(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano) VALUES ('$id', '$loja', 'Adm', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '1', '$valor', '$base3', '$bonusAfiliado1', '$valorRepasse', '$autorizacao', 'Em Aberto', '$data_dia', '$data_mes', '$data_ano')", $ellevar);

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
?>

</div>
</body>
</html>