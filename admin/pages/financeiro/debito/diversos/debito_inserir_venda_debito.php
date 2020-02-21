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
	
$bonusAfiliado = $valor * $bonus;

/***base comissaoAfiliado */
$base1 = $valor * $taxa;
$base2 = 0.12;
$comissaoAfiliado = ($base1 - $base2) * 0.125;
$afiliadoAcesso = $comissaoAfiliado / 2;

$totalTaxa = $base1 + $base2;

$valorRepasse = $valor - $totalTaxa - $bonusAfiliado;

$comissaoAport = $totalTaxa * 0.005;
$idAport = "3";

$comissaoImposto = $totalTaxa * 0.005;
$idImposto = "2";


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



	
$inserirVenda = mysql_query("INSERT INTO sps_movimentacao(movimento_afiliado_id, movimento_estabelecimento_id, movimento_pdv, movimento_tipo, movimento_dia, movimento_mes, movimento_ano, movimento_hora, movimento_parcela, movimento_total_parcela, movimento_valor, movimento_taxa_adm, movimento_taxa_bonus, movimento_valor_repasse, movimento_protocolo_venda, movimento_status_estabelecimento, movimento_pagamento_dia, movimento_pagamento_mes, movimento_pagamento_ano) VALUES ('$id', '$loja', 'Adm', 'Venda', '$dia', '$mes', '$ano', '$horario', '1', '1', '$valor', '$totalTaxa', '$bonusAfiliado', '$valorRepasse', '$autorizacao', 'Em Aberto', '$data_dia', '$data_mes', '$data_ano')", $ellevar);



if($inserirVenda == "1"){


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
$inserirConsultor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$bonusAfiliado', 'Comissao', 'Bonificação sobre movimentação no estabelecimento $loja - $fantasia', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);





/***** comprovante via estabelecimento */

$sqlVendas = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_protocolo_venda='$autorizacao'");
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
    <td colspan="2" align="center" valign="middle"><strong>COMPROVANTE DE PAGAMENTO - DÉBITO</strong></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="middle"><BR /></td>
  </tr>
  
  <tr>
    <td>Autoriza&ccedil;&atilde;o</td>
    <td><strong><?php echo $row_vendas['movimento_protocolo_venda']; ?></strong></td>
  </tr>
  <tr>
    <td>Estabelecimento</td>
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
    <td>Valor</td>
    <td><strong><?php echo 'R$ '.number_format($row_vendas['movimento_valor'],2,",",".").''; ?></strong></td>
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

?>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>