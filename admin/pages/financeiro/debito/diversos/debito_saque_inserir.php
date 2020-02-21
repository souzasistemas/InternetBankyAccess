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
<h2>Saída de Valores</h2><br>
</div>

<div class="col-sm-2">&nbsp;</div>


<div class="col-sm-8">
    <div class="well well-sm">
        
        
    <div class="well" style="background-color:#cfcfcf;"><span style="font-size:20px;">Solicitação de Saque</span></div>
<?Php
require "../../../config/config.php";

$id = $_POST['id'];
$valor = $_POST['valor'];
$taxa = $_POST['taxa'];

date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

$dias_de_prazo_para_pagamento = 2;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento * 86400));

$protocolo = "$id$ano$mes$dia$hora$min$seg";


$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysql_fetch_array($sql);
    $correspondente = $ver['afiliado_indicador'];
    $cidade = $ver['afiliado_cidade'];
    $estado = $ver['afiliado_estado'];
    $nome = $ver['afiliado_nome'];
    $email = $ver['afiliado_email'];
    $banco = $ver['afiliado_banco'];

if($banco == ""){
    echo "<script>location.href='debito.php';alert('Desculpe!Cliente não possui Banco cadastrado');</script>";
    
}else{
    
$sqlBanco = mysql_query("SELECT * FROM sps_bancos WHERE banco_codigo='$banco'");
$verBanco = mysql_fetch_array($sqlBanco);
    $bancoNome = strtoupper($verBanco['banco_nome']);


$efetuar = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo, extrato_protocolo, extrato_status_saque, extrato_modo_saque) VALUES ('$id', '$valor', 'Não', 'Retirada', 'SOLICITAÇÃO DE SAQUE VIA TRANSFERENCIA BANCARIA - DATA LIMITE PARA REPASSE: $data_dia/$data_mes/$data_ano', '$dia', '$mes', '$ano', '$horario', 'Debito', '$protocolo', 'Pendente', 'Transferencia Bancaria')", $ellevar);

if($efetuar == "1"){

/********************************* RELAÇÃO DE CONTAS ADM ***********************************************************/
$idAdm = "1";
$idImposto = "2";
$idAport = "3";
$idDaniel = "100";
$idClaudio = "101";
$idCida = "245";
$idFloramar = "32";
$idComercial = "6649";

/************************ verificar se o patrocinador é single **************************************************/
$sqlSingle = mysql_query("SELECT * FROM sps_correspondente_single WHERE single_afiliado_id='$correspondente'");
$verSingle = mysql_fetch_array($sqlSingle);
    $Single = $verSingle['single_afiliado_id'];

if($Single == $correspondente){
    $idSingle = $Single;
}else{
    $idSingle = "6649";
}
/*********************** fim correspondente single *************************************************************/






/************************ verificar PA ********************************************************/
$sqlPASingle = mysql_query("SELECT * FROM sps_correspondente_single WHERE single_afiliado_id='$idSingle'");
$verPASingle = mysql_fetch_array($sqlPASingle);
    $PASingle = $verPASingle['single_pa_id'];
    
$sqlPA = mysql_query("SELECT * FROM sps_correspondente_pa WHERE pa_id='$PASingle'");
$verPA = mysql_fetch_array($sqlPA);
    $PA = $verPA['single_pa_id'];

if($PA == ""){
    $idPA = "100";
}else{
    $idPA = $verPA['pa_afiliado_id'];
}
/*********************** fim PA *************************************************************/




/************************ verificar MASTER **************************************************/
$sqlMaster = mysql_query("SELECT * FROM sps_correspondente_master WHERE master_cidade='$cidade'");
$verMaster = mysql_fetch_array($sqlMaster);
    $Master = $verMaster['master_afiliado_id'];

if($Master == ""){
    $idMaster = "101";
}else{
    $idMaster = $Master;
}
/*********************** fim MASTER *************************************************************/




/************************ verificar Corretor ********************************************************/
$sqlCorretorSingle = mysql_query("SELECT * FROM sps_correspondente_single WHERE single_afiliado_id='$idSingle'");
$verCorretorSingle = mysql_fetch_array($sqlCorretorSingle);
    $CorretorSingle = $verCorretorSingle['single_corretor_id'];
    
$sqlCorretor = mysql_query("SELECT * FROM sps_correspondente_corretor WHERE corretor_id='$CorretorSingle'");
$verCorretor = mysql_fetch_array($sqlCorretor);
    $Corretor = $verCorretor['corretor_afiliado_id'];

if($Corretor == ""){
    $idCorretor = "6649";
}else{
    $idCorretor = $Corretor;
}
/*********************** fim Corretor *************************************************************/




/************************ verificar GERENTE **************************************************/
$sqlGerente = mysql_query("SELECT * FROM sps_correspondente_gerente WHERE gerente_estado='$estado'");
$verGerente = mysql_fetch_array($sqlGerente);
    $Gerente = $verGerente['gerente_afiliado_id'];

if($Gerente == ""){
    $idGerente = "100";
}else{
    $idGerente = $Gerente;
}
/*********************** fim GERENTE *************************************************************/


$idJuridico = "28";
$idMarketing = "29";
$idCredito = "30";
$idInvestimento = "31";
$idTradeCard = "4";
/****************************************** FIM RELAÇÃO DE CONTAS ADM *************************************************************/

$txImposto = $taxa * 0.05;
$txAdm = $taxa * 0.02;
$valorComissao = $taxa - $txImposto - $txAdm;

$txAport = $valorComissao * 0.1;
$txDaniel = $valorComissao * 0.005;
$txClaudio = $valorComissao * 0.0025;
$txCida = $valorComissao * 0.0025;
$txFloramar = $valorComissao * 0.03;
$txComercial = $valorComissao * 0.113;
$txGerente = $valorComissao * 0.002;
$txCorretor = $valorComissao * 0.005;
$txMaster = $valorComissao * 0.01;
$txPA = $valorComissao * 0.05;
$txSingle = $valorComissao * 0.12;
$txJuridico = $valorComissao * 0.01;
$txMarketing = $valorComissao * 0.05;
$txCredito = $valorComissao * 0.05;
$txInvestimento = $valorComissao * 0.1;
$txTradecard = $valorComissao + $txAdm - $txAport - $txDaniel - $txClaudio - $txCida - $txFloramar - $txComercial - $txGerente - $txCorretor - $txMaster - $txPA - $txSingle - $txJuridico - $txMarketing - $txCredito - $txInvestimento;


/*** Adm */
$debitarTaxa = mysql_query("INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$id', '$taxa', 'Não', 'Retirada', 'TARIFA SOBRE A SOLICITAÇÃO DE SAQUE', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$Ativacao = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$taxa', 'Não', 'Transferencia', 'TARIFA SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Imposto */
$SairImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txImposto', 'Não', 'Transferencia', 'IMPOSTO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarImposto = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idImposto', '$txImposto', 'Não', 'Transferencia', 'RECOLHIMENTO PARA IMPOSTO DA SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Aport */
$SairAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txAport', 'Não', 'Transferencia', 'RESERVA PARA APORT SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarAport = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAport', '$txAport', 'Não', 'Transferencia', 'RECOLHIMENTO PARA APORT SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Daniel */
$SairDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txDaniel', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idDaniel SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarDaniel = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idDaniel', '$txDaniel', 'Não', 'Comissao', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Claudio */
$SairClaudio = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txClaudio', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idClaudio SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarClaudio = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idClaudio', '$txClaudio', 'Não', 'Comissao', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Cida */
$SairCida = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txCida', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idCida SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarCida = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idCida', '$txCida', 'Não', 'Comissao', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Floramar */
$SairFloramar = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txFloramar', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idFloramar SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarFloramar = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idFloramar', '$txFloramar', 'Não', 'Comissao', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Comercial */
$SairComercial = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txComercial', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idComercial SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarComercial = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idComercial', '$txComercial', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Gerente */
$SairGerente = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txGerente', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idGerente SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarGerente = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idGerente', '$txGerente', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Corretor */
$SairCorretor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txCorretor', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idCorretor SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarCorretor = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idCorretor', '$txCorretor', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Master */
$SairMaster = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txMaster', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idMaster SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarMaster = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idMaster', '$txMaster', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** PA */
$SairPA = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txPA', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idPA SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarPA = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idPA', '$txPA', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Single */
$SairSingle = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txSingle', 'Não', 'Transferencia', 'RESIDUAL PARA O AFILIADO $idSingle SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarSingle = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idSingle', '$txSingle', 'Não', 'Comissao', 'COMISSAO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Juridico */
$SairJuridico = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txJuridico', 'Não', 'Transferencia', 'RESIDUAL PARA O JURIDICO (CONTA: $idJuridico) SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarJuridico = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idJuridico', '$txJuridico', 'Não', 'Transferencia', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Marketing */
$SairMarketing = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txMarketing', 'Não', 'Transferencia', 'RESIDUAL PARA O MARKETING (CONTA: $idMarketing) SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarMarketing = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idMarketing', '$txMarketing', 'Não', 'Transferencia', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Credito */
$novoCredito = $txCredito + $txCredito1;
$SairCredito = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$novoCredito', 'Não', 'Transferencia', 'RESIDUAL PARA CREDITO (CONTA: $idCredito) SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarCredito = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idCredito', '$novoCredito', 'Não', 'Transferencia', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Investimento */
$SairInvestimento = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txInvestimento', 'Não', 'Transferencia', 'RESIDUAL PARA INVESTIMENTO (CONTA: $idInvestimento) SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarInvestimento = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idInvestimento', '$txInvestimento', 'Não', 'Transferencia', 'RESIDUAL SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);

/*** Trade Card */
$SairTradecard = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idAdm', '$txTradecard', 'Não', 'Transferencia', 'RESIDUAL LIQUIDO TRADE CARD (CONTA: $idTradeCard) SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Debito')", $ellevar);
$EntrarTradecard = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_hora, extrato_tipo) VALUES ('$idTradeCard', '$txTradecard', 'Não', 'Transferencia', 'RESIDUAL LIQUIDO SOBRE A SOLICITAÇÃO DE SAQUE DO AFILIADO $id', '$dia', '$mes', '$ano', '$horario', 'Credito')", $ellevar);
    

echo "<strong>Pedido do saque foi realizado com sucesso!</strong><br><br>
	Abaixo segue os dados de seu pedido:<br><br>
	<strong>Protocolo:</strong>&nbsp;&nbsp; ".$protocolo."<br>
	<strong>Data de Solicitação:</strong>&nbsp;&nbsp; ".$dia."/".$mes."/".$ano."<br>
	<strong>Data prévia para depósito:</strong>&nbsp;&nbsp; ".$data_dia."/".$data_mes."/".$data_ano."<br><br>
	<strong>Valor Solicitado:</strong>&nbsp;&nbsp; ".number_format($valor,2,",",".")."<br><br><br>
	";
echo '<a href="javascript:location.href="debito.php";"><button name="limpar" class="btn btn-danger btn-sm" type="button">Novo Saque</button></a>';

}else{
     echo "<script>location.href='debito.php';alert('Desculpe! Não foi possível realizar essa transação!');</script>";
}
}
?>
    </div>
</div>


<div class="col-sm-2">&nbsp;</div>
</body>
</html>