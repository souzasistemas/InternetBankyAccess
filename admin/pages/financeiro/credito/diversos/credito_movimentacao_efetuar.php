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
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Inserir Movimentação - STONE</span></div>
<?Php
require "../../../config/config.php"; 

$dia1 = $_POST['dia1'];
$mes1 = $_POST['mes1'];
$ano1 = $_POST['ano1'];
$dia2 = $_POST['dia2'];
$mes2 = $_POST['mes2'];
$ano2 = $_POST['ano2'];

/** CONFIGURAÇÃO DE HORA */
date_default_timezone_set('Brazil/East');
$segundo= date('s');
$hora1 = $_POST['hora'];
$hora = $hora1.":".$segundo;
$autorizacao = $_POST['protocolo'];

$cliente = $_POST['cliente'];
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$pos = $_POST['pos'];

$modo = $_POST['modo'];

$sql = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_afiliacao_stone_pos='$pos'");
$ver = mysql_fetch_array($sql);
    $codigo = $ver['estabelecimento_codigo'];
    $fantasia = $ver['$estabelecimento_fantasia'];
    $bonus = $ver['estabelecimento_bonus'];

if($codigo == ""){
   echo "Estabelecimento ou POS não localizado!<br><br>";
   echo"<a href='credito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Voltar</button></a>"; 
}else{   
$taxaDebito = $valor * 0.0238;
$taxaCredito = $valor * 0.0267;
$taxaBonus = $valor * $bonus;

$repasseDebito = $valor - $taxaDebito - $taxaBonus;
$repasseCredito = $valor - $taxaCredito - $taxaBonus;

if($modo == "1"){
    $modoNome = "Débito";
    $inserirVenda = mysql_query("INSERT INTO sps_movimentacao(
        movimento_afiliado_id, 
        movimento_estabelecimento_id, 
        movimento_pdv,  
        movimento_tipo, 
        movimento_dia, 
        movimento_mes, 
        movimento_ano, 
        movimento_hora, 
        movimento_parcela, 
        movimento_total_parcela, 
        movimento_valor, 
        movimento_taxa_adm, 
        movimento_taxa_bonus, 
        movimento_valor_repasse, 
        movimento_protocolo_venda, 
        movimento_status_estabelecimento, 
        movimento_pagamento_dia, 
        movimento_pagamento_mes, 
        movimento_pagamento_ano, 
        movimento_pagamento_hora) VALUES (
            '$cliente', 
            '$codigo', 
            'GPRS', 
            'Venda', 
            '$dia1', 
            '$mes1', 
            '$ano1', 
            '$hora', 
            '01', 
            '01', 
            '$valor', 
            '$taxaDebito', 
            '$taxaBonus', 
            '$repasseDebito', 
            '$autorizacao', 
            'Em Aberto', 
            '$dia2', 
            '$mes2', 
            '$ano2', 
            '$hora')", $ellevar);
}elseif($modo == "2"){
    $modoNome = "Crédito";
    $inserirVenda = mysql_query("INSERT INTO sps_movimentacao_credito(
        movimento_afiliado_id, 
        movimento_estabelecimento_id, 
        movimento_pdv, 
        movimento_tipo, 
        movimento_dia, 
        movimento_mes, 
        movimento_ano, 
        movimento_hora, 
        movimento_parcela, 
        movimento_total_parcela, 
        movimento_valor, 
        movimento_taxa_adm, 
        movimento_taxa_bonus, 
        movimento_valor_repasse, 
        movimento_valor_afiliado, 
        movimento_protocolo_venda, 
        movimento_status_estabelecimento, 
        movimento_pagamento_dia, 
        movimento_pagamento_mes, 
        movimento_pagamento_ano, 
        movimento_pagamento_hora, 
        movimento_status_afiliado, 
        movimento_pagamento_dia_afiliado, 
        movimento_pagamento_mes_afiliado, 
        movimento_pagamento_ano_afiliado) VALUES (
            '$cliente', 
            '$codigo', 
            'GPRS', 
            'Venda', 
            '$dia1', 
            '$mes1', 
            '$ano1', 
            '$hora', 
            '01', 
            '01', 
            '$valor', 
            '$taxaCredito', 
            '$taxaBonus', 
            '$repasseCredito', 
            '00', 
            '$autorizacao', 
            'Em Aberto', 
            '$dia2', 
            '$mes2', 
            '$ano2', 
            '$hora', 
            'Pago', 
            '0', 
            '0', 
            '0')", $ellevar);
}



if($inserirVenda == "1"){
    echo "Venda na modalidade ".$modoNome.", inserida com sucesso!<br><br>";
	echo"<a href='credito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Inserir Nova Movimentação</button></a>";
}else{
    echo "!!!ERRO!!! na modalidade ".$modoNome."!<br><br>";
	echo"<a href='credito.php'><button name='limpar' class='btn btn-primary btn-sm' type='button'>Voltar</button></a>";
}
}
?>

    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>