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

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

  <style media="print">
.botao {
display: none;
}
</style>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
<br><br>    
<?Php
require "../../../../../config/config.php";
date_default_timezone_set('Brazil/East');

$tipo = $_POST['tipo'];

if($tipo == "1"){

$id = $_POST['id'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];


$sql = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id'");
$ver = mysql_fetch_array($sql);

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);

?>

<div class="col-sm-12">
    <div class="col-sm-2"  style="padding:10px; vertical-align:middle; text-align:left;"></div>
    <div class="col-sm-8" style="padding:10px; vertical-align:middle; font-size:12px;">
        <strong>Razão Social:</strong> <?Php echo strtoupper($ver['estabelecimento_razao']); ?> &nbsp; &nbsp; &nbsp; <strong>CNPJ:</strong> <?Php echo strtoupper($ver['estabelecimento_cnpj']); ?><br>
        <strong>Insc.:</strong> <?Php echo strtoupper($ver['estabelecimento_insc']); ?> &nbsp; &nbsp; &nbsp; <strong>Código:</strong> <?Php echo strtoupper($ver['estabelecimento_codigo']); ?>
         &nbsp; &nbsp; &nbsp; <strong>Segmento (MCC):</strong> <?Php echo strtoupper($ver['estabelecimento_segmento']); ?> - 
         <?Php
         $idSeg = $ver['estabelecimento_segmento'];
         $sqlSeg = mysql_query("SELECT * FROM sps_segmento WHERE segmento_mmc='$idSeg'");
         $verSeg = mysql_fetch_array($sqlSeg);
         
         echo strtoupper($verSeg['segmento_nome']);
         ?>
         <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?><br>
        <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?> &nbsp; &nbsp; &nbsp; <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <br>
    </div>
    <div class="col-sm-2" style="padding:10px; border:1px solid #ccc; vertical-align:middle; text-align:center; border-radius:4px;"><strong>REF.:</strong> <br><?Php echo $nomeMes." / ".$ano ; ?></div>
</div>


<div class="col-sm-12">
    <div class="well">
        <table class="table table-condensed" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:24%; text-align:center; vertical-align:middle;">Total Vendas (Débito)</th>
                    <th style="width:1%; text-align:center; vertical-align:middle;">&nbsp;</th>
                    <th style="width:24%; text-align:center; vertical-align:middle;">Total Vendas (Crédito)</th>
                    <th style="width:1%; text-align:center; vertical-align:middle;">&nbsp;</th>
                    <th style="width:24%; text-align:center; vertical-align:middle;">Taxas e Bonificações</th>
                    <th style="width:1%; text-align:center; vertical-align:middle;">&nbsp;</th>
                    <th style="width:25%; text-align:center; vertical-align:middle;">Saldo Pendente para Repasse</th>
                </tr>
            </thead>

<?Php

/***** saldo em conta */
$sql_movimento = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_status_estabelecimento='Em Aberto'");
$ver_movimento = mysql_fetch_assoc($sql_movimento);
$movimento = $ver_movimento['sum(movimento_valor)'];
$movimentoTaxaAdmin = $ver_movimento['sum(movimento_taxa_adm)'];
$movimentoTaxaBonus = $ver_movimento['sum(movimento_taxa_bonus)'];



/***** limite aprovado  */

$sql_movimento2 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_status_estabelecimento='Em Aberto'");
$ver_movimento2 = mysql_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];
$movimento2TaxaAdmin = $ver_movimento2['sum(movimento_taxa_adm)'];
$movimento2TaxaBonus = $ver_movimento2['sum(movimento_taxa_bonus)'];


/***** Débito em Aberto  */
$sql_debito2 = mysql_query("SELECT sum(pi_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$ver_debito2 = mysql_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_valor)'];
?>
             <thead>
                <tr>
                    <td style="text-align:center;"><?Php echo number_format($movimento,2,",",".");?></td>
                    <td style="text-align:center;"><span class="badge">+</span></span></td>
                    <td style="text-align:center;"><?Php echo number_format($movimento2,2,",",".");?></td>
                    <td style="text-align:center;"><span class="badge">-</span></span></td>
                    <td style="text-align:center;"><?Php echo number_format($movimentoTaxaAdmin + $movimento2TaxaAdmin + $movimentoTaxaBonus + $movimento2TaxaBonus,2,",",".");?></td>
                    <td style="text-align:center;"><span class="badge">=</span></span></td>
                    <td style="text-align:center;">
                        <?Php 
                        $saldoReal = $movimento + $movimento2 - ($movimentoTaxaAdmin + $movimento2TaxaAdmin + $movimentoTaxaBonus + $movimento2TaxaBonus);
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldoReal,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldoReal,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldoReal,2,",",".")."</span>";
                        }
                        ?>
                    </td>
                </tr>
             </thead>
        </table>
    </div>
</div>
 





<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO DÉBITO ====================<br><br>
</div>


<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>








<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO CRÉDITO ====================<br><br>
</div>

<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito2 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito2 = mysql_fetch_array($sqlmovimentacaoCredito2);
                    echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>


<div class="col-sm-12" style="padding-bottom:20px;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>














<?Php
}elseif($tipo == "2"){
    
$id = $_POST['id'];
$mes = $_POST['mes2'];
$ano = $_POST['ano2'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];


if($inicio == "" && $fim == ""){
    echo "<script>history.back(-1); alert('Escolha um Período para sua pesquisa!');</script>";
}elseif($inicio != "" && $fim == ""){
    echo "<script>history.back(-1); alert('Escolha uma Data Final para sua pesquisa!');</script>";
}elseif($inicio == "" && $fim != ""){
    echo "<script>history.back(-1); alert('Escolha uma Data de Início para sua pesquisa!');</script>";
}elseif($inicio != "" && $fim != ""){
    
$sql = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id'");
$ver = mysql_fetch_array($sql);

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);


?>

<div class="col-sm-12">
    <div class="col-sm-2"  style="padding:10px; vertical-align:middle; text-align:left;"><img src="https://www.redetradecard.com.br/img/logo.png" width="105px" /></div>
    <div class="col-sm-7" style="padding:10px; vertical-align:middle; font-size:12px;">
        <strong>Razão Social:</strong> <?Php echo strtoupper($ver['estabelecimento_razao']); ?> &nbsp; &nbsp; &nbsp; <strong>CNPJ:</strong> <?Php echo strtoupper($ver['estabelecimento_cnpj']); ?><br>
        <strong>Insc.:</strong> <?Php echo strtoupper($ver['estabelecimento_insc']); ?> &nbsp; &nbsp; &nbsp; <strong>Código:</strong> <?Php echo strtoupper($ver['estabelecimento_codigo']); ?>
         &nbsp; &nbsp; &nbsp; <strong>Segmento (MCC):</strong> <?Php echo strtoupper($ver['estabelecimento_segmento']); ?> - 
         <?Php
         $idSeg = $ver['estabelecimento_segmento'];
         $sqlSeg = mysql_query("SELECT * FROM sps_segmento WHERE segmento_mmc='$idSeg'");
         $verSeg = mysql_fetch_array($sqlSeg);
         
         echo strtoupper($verSeg['segmento_nome']);
         ?>
         <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?><br>
        <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?> &nbsp; &nbsp; &nbsp; <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <br>
    </div>
    <div class="col-sm-3" style="padding:10px; border:1px solid #ccc; vertical-align:middle; text-align:center; border-radius:4px;"><strong>Período.:</strong> <br><?Php echo $inicio."/".$mes."/".$ano ; ?> à <?Php echo $fim."/".$mes."/".$ano ; ?></div>
</div>





<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO DÉBITO ====================<br><br>
</div>


<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_dia>='$inicio' AND movimento_dia<='$fim' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_dia>='$inicio' AND movimento_dia<='$fim' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>








<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO CRÉDITO ====================<br><br>
</div>

<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_dia>='$inicio' AND movimento_dia<='$fim' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito2 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_dia>='$inicio' AND movimento_dia<='$fim' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito2 = mysql_fetch_array($sqlmovimentacaoCredito2);
                    echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>


<div class="col-sm-12" style="padding-bottom:20px;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>




<?Php
}    
}elseif($tipo == "3"){

$id = $_POST['id'];
$periodo = $_POST['periodo'];


if($periodo == ""){
    echo "<script>history.back(-1); alert('Escolha um Período para sua pesquisa!');</script>";
}else{
    
$sql = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id'");
$ver = mysql_fetch_array($sql);

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);


date_default_timezone_set('Brazil/East');

if($periodo == "1"){
    $dias = -30;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "2"){
    $dias = -60;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "3"){
    $dias = -90;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "4"){
    $dias = -120;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "5"){
    $dias = -150;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "6"){
    $dias = -180;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "7"){
    $dias = -210;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "8"){
    $dias = -240;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "9"){
    $dias = -270;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "10"){
    $dias = -300;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "11"){
    $dias = -330;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}elseif($periodo == "12"){
    $dias = -360;
    $mes = date("m", time() + ($dias * 86400));
    $ano = date("Y", time() + ($dias * 86400));
    
    $sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
    $verMes = mysql_fetch_array($sqlMes);
        $nomeMes = strtoupper($verMes['mes_valor']);
}

?>

<div class="col-sm-12">
    <div class="col-sm-2"  style="padding:10px; vertical-align:middle; text-align:left;"><img src="https://www.redetradecard.com.br/img/logo.png" width="105px" /></div>
    <div class="col-sm-8" style="padding:10px; vertical-align:middle; font-size:12px;">
        <strong>Razão Social:</strong> <?Php echo strtoupper($ver['estabelecimento_razao']); ?> &nbsp; &nbsp; &nbsp; <strong>CNPJ:</strong> <?Php echo strtoupper($ver['estabelecimento_cnpj']); ?><br>
        <strong>Insc.:</strong> <?Php echo strtoupper($ver['estabelecimento_insc']); ?> &nbsp; &nbsp; &nbsp; <strong>Código:</strong> <?Php echo strtoupper($ver['estabelecimento_codigo']); ?>
         &nbsp; &nbsp; &nbsp; <strong>Segmento (MCC):</strong> <?Php echo strtoupper($ver['estabelecimento_segmento']); ?> - 
         <?Php
         $idSeg = $ver['estabelecimento_segmento'];
         $sqlSeg = mysql_query("SELECT * FROM sps_segmento WHERE segmento_mmc='$idSeg'");
         $verSeg = mysql_fetch_array($sqlSeg);
         
         echo strtoupper($verSeg['segmento_nome']);
         ?>
         <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?><br>
        <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?> &nbsp; &nbsp; &nbsp; <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <br>
    </div>
    <div class="col-sm-2" style="padding:10px; border:1px solid #ccc; vertical-align:middle; text-align:center; border-radius:4px;"><strong>REF.:</strong> <br><?Php echo $nomeMes." / ".$ano ; ?></div>
</div>





<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO DÉBITO ====================<br><br>
</div>


<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>








<div class="col-sm-12" style="text-align:center;">
    =================== RELATÓRIO MOVIMENTAÇÃO POR MODO CRÉDITO ====================<br><br>
</div>

<div class="col-sm-12">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;">
                    <?Php 
                    $idAfiliado = $vermovimentacaoCredito['movimento_afiliado_id'];
                    $sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
                    $verAfiliado = mysql_fetch_array($sqlAfiliado);
                    ?>
                    <a href="visualizar_afiliado.php?afiliado_id=<?php echo $idAfiliado; ?>" data-toggle="tooltip" title="<?php echo strtoupper($verAfiliado['afiliado_nome']); ?>" target="visualizar"><?Php echo $idAfiliado; ?></a> 
                </td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoCredito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoCredito['movimento_valor'] - ($vermovimentacaoCredito['movimento_taxa_adm'] + $vermovimentacaoCredito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoCredito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_protocolo_venda']; ?></td>
            </tr>
        </tbody>
<?Php
}
?>



        

        <thead>
            <tr>
                <th colspan="4" style="text-align:left; background-color:#666666; color:#fff;">Subtotal</th>
                <th colspan="2" style="text-align:right; background-color:#666666; color:#fff;">
                    <?Php 
                    $sqlmovimentacaoCredito2 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito2 = mysql_fetch_array($sqlmovimentacaoCredito2);
                    echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito2['sum(movimento_valor)'] - ($vermovimentacaoCredito2['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito2['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
    </table>
</div>


<div class="col-sm-12" style="padding-bottom:20px;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>







<?Php
}      
}
?>


</body>
</html>

