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
 
</head>

<body id="principal">
    
<div class="w3-container"><br>

<table class="w3-table">
    <tr>
        <td><img src="../../../img/marca.png" width="300px" /></td>
        <td style="text-align:right;"><h1 class="w3-xlarge">Extrato - Estabelecimento</h1><br></td>
    </tr>
</table>

<div class="well botao" style="height:410px;">
    <h1 class="w3-medium"><b>Escolha o período</b></h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form" method="POST" class="botao">
        <input name="escolha" type="hidden" value="branco">
        <input name="id" type="hidden" value="<?Php echo $id; ?>">
        
        <table class="w3-table">
            <tr>
                <td style="vertical-align:middle;"><b>Código</b></td>
                <td colspan="5" style="vertical-align:middle;"><input name="id" maxlength="2" type="number" class="w3-input w3-white w3-round w3-border" style="width:250px;" required></td>
            </tr>
            <tr>
                <td style="vertical-align:middle;"><input type="radio" name="tipo" value="1" class="w3-radio"  required> </td>
                <td colspan="5" style="vertical-align:middle;"> <b>Mês Atual</b></td>
            </tr>
            <tr>
                <td style="vertical-align:middle;"><input type="radio" name="tipo" value="2" class="w3-radio" required></td>
                <td style="vertical-align:middle;"><b>Início:</b></td>
                <td style="vertical-align:middle;"><input name="inicio" maxlength="2" type="number" class="w3-input w3-white w3-round w3-border" style="width:100px;"></td>
                <td style="vertical-align:middle;"><b>Fim:</b></td>
                <td style="vertical-align:middle;"><input name="fim" maxlength="2" type="number" class="w3-input w3-white w3-round w3-border" style="width:100px;"></td>
            </tr>
            <tr>
                <td style="vertical-align:middle;"><input type="radio" name="tipo" value="3" class="w3-radio"  required> </td>
                <td colspan="5" style="vertical-align:middle;"><b>Outros</b></td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align:middle;"><select name="mes" class="w3-input w3-white w3-round w3-border" style="width:100%;">
                    <option value=""></option>
                    <option value="01">JANEIRO</option>
                    <option value="02">FEVEREIRO</option>
                    <option value="03">MARÇO</option>
                    <option value="04">ABRIL</option>
                    <option value="05">MAIO</option>
                    <option value="06">JUNHO</option>
                    <option value="07">JULHO</option>
                    <option value="08">AGOSTO</option>
                    <option value="09">SETEMBRO</option>
                    <option value="10">OUTUBRO</option>
                    <option value="11">NOVEMBRO</option>
                    <option value="12">DEZEMBRO</option>
                </select></td>
                <td colspan="2" style="vertical-align:middle;">
                <select name="ano" class="w3-input w3-white w3-round w3-border" style="width:100%;">
                    <?Php
                    date_default_timezone_set('Brazil/East');
                    $ano1 = date('Y');
                    $ano2 = $ano1 - 1;
                    $ano3 = $ano2 - 1;
                    $ano4 = $ano3 - 1;
                    $ano5 = $ano4 - 1;
                    
                    ?>
                    <option value=""></option>
                    <option value="<?php echo $ano1; ?>"><?php echo $ano1; ?></option>
                    <option value="<?php echo $ano2; ?>"><?php echo $ano2; ?></option>
                    <option value="<?php echo $ano3; ?>"><?php echo $ano3; ?></option>
                    <option value="<?php echo $ano4; ?>"><?php echo $ano4; ?></option>
                    <option value="<?php echo $ano5; ?>"><?php echo $ano5; ?></option>
                </select></td>
            </tr>
            <tr>
                <td colspan="5"><button class="w3-button w3-round w3-green" style="width:100%;"><i class="fa fa-search"></i> Buscar</button></td>
            </tr>
            
        </table>
        
    </form>
</div>

<?Php
$id = $_POST['id'];
$escolha = $_POST['escolha'];
$tipo = $_POST['tipo'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

require "../../../../../config/config.php";


$sql = mysql_query("SELECT * FROM sps_estabelecimento WHERE estabelecimento_codigo='$id'");
$ver = mysql_fetch_array($sql);

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);

if($ver['estabelecimento_cadastro_tipo'] == "Fisica"){
    $documento = $ver['estabelecimento_cpf'];
    $nome = $ver['estabelecimento_nome'];
    $tipoConta = "afiliado_cpf";
}elseif($ver['estabelecimento_cadastro_tipo'] == "Juridica"){
    $documento = $ver['estabelecimento_cnpj'];
    $nome = $ver['estabelecimento_razao'];
    $tipoConta = "afiliado_cnpj";
}


$sqlConta = mysql_query("SELECT * FROM sps_afiliados WHERE $tipoConta='$documento'");
$verConta = mysql_fetch_array($sqlConta);
    $idConta = $verConta['afiliado_id'];

if($escolha == ""){
}else{
    
    
    
if($tipo == "1"){    
?>

<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:150px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>Nome Fantasia:</strong> <?Php echo strtoupper($ver['estabelecimento_fantasia']); ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <strong>Código de Estabelecimento:</strong> <?Php echo strtoupper($id); ?><br>
        <strong>Conta Acessomundi:</strong> <?Php echo strtoupper($idConta); ?>
    </div>



<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">TOTAL DE MOVIMENTAÇÕES</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
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


$taxas = $movimentoTaxaAdmin + $movimento2TaxaAdmin + $movimentoTaxaBonus + $movimento2TaxaBonus;
$saldoRepasse = $movimento + $movimento2 - $taxas;

?>

            
        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Débito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Crédito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Taxas e Bonificações</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($taxas,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo Total para Repasse</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br>


<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: DÉBITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');
$sqlmovimentacaoDebito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual' ORDER BY movimento_id ASC");
while($vermovimentacaoDebito = mysql_fetch_array($sqlmovimentacaoDebito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_afiliado_id']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoDebito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'] - ($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_protocolo_venda']; ?></td>
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
                    $sqlmovimentacaoDebito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual'");
                    $vermovimentacaoDebito1 = mysql_fetch_array($sqlmovimentacaoDebito1);
                    echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'] - ($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: CRÉDITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_afiliado_id']; ?></td>
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
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'] - ($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12" style="margin-top:10px; padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>






<?Php
}elseif($tipo == "2"){

if($inicio == "" && $fim == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA INÍCIO e DATA FIM!');</script>";
}elseif($inicio != "" && $fim == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA FIM!');</script>";
}elseif($inicio == "" && $fim != ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA INÍCIO!');</script>";
}else{
?>

<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:150px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>Nome Fantasia:</strong> <?Php echo strtoupper($ver['estabelecimento_fantasia']); ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <strong>Código de Estabelecimento:</strong> <?Php echo strtoupper($id); ?><br>
        <strong>Conta Acessomundi:</strong> <?Php echo strtoupper($idConta); ?>
    </div>



<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">TOTAL DE MOVIMENTAÇÕES</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
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


$taxas = $movimentoTaxaAdmin + $movimento2TaxaAdmin + $movimentoTaxaBonus + $movimento2TaxaBonus;
$saldoRepasse = $movimento + $movimento2 - $taxas;

?>

            
        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Débito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Crédito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Taxas e Bonificações</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($taxas,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo Total para Repasse</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br>


<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: DÉBITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');

$num = $inicio;
        if(strlen($num) == 1){
            $num = "0".$num;
        }
        
        $num2 = $fim;
        if(strlen($num2) == 1){
            $num2 = "0".$num2;
        }


$sqlmovimentacaoDebito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_dia >= '$num' AND movimento_dia <= '$num2' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual' ORDER BY movimento_id ASC");
while($vermovimentacaoDebito = mysql_fetch_array($sqlmovimentacaoDebito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_afiliado_id']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoDebito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'] - ($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_protocolo_venda']; ?></td>
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
                    $sqlmovimentacaoDebito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_dia >= '$num' AND movimento_dia <= '$num2' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual'");
                    $vermovimentacaoDebito1 = mysql_fetch_array($sqlmovimentacaoDebito1);
                    echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'] - ($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: CRÉDITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_dia >= '$num' AND movimento_dia <= '$num2' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_afiliado_id']; ?></td>
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
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_dia >= '$num' AND movimento_dia <= '$num2' AND movimento_mes='$mesAtual' AND movimento_ano='$anoAtual'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'] - ($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12" style="margin-top:10px; padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>









<?Php
}
}elseif($tipo == "3"){

if($mes == "" && $ano == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar MÊS e ANO!');</script>";
}elseif($mes != "" && $ano == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar ANO!');</script>";
}elseif($mes == "" && $ano != ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar MÊS!');</script>";
}else{
?>

<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:150px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>Nome Fantasia:</strong> <?Php echo strtoupper($ver['estabelecimento_fantasia']); ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['estabelecimento_endereco']); ?>, <?Php echo strtoupper($ver['estabelecimento_numero']); ?> - <?Php echo strtoupper($ver['estabelecimento_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['estabelecimento_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['estabelecimento_cidade']); ?>/<?Php echo strtoupper($ver['estabelecimento_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['estabelecimento_cep']); ?><br>
        <strong>Código de Estabelecimento:</strong> <?Php echo strtoupper($id); ?><br>
        <strong>Conta Acessomundi:</strong> <?Php echo strtoupper($idConta); ?>
    </div>



<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">TOTAL DE MOVIMENTAÇÕES</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
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


$taxas = $movimentoTaxaAdmin + $movimento2TaxaAdmin + $movimentoTaxaBonus + $movimento2TaxaBonus;
$saldoRepasse = $movimento + $movimento2 - $taxas;

?>

            
        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Débito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Total Vendas (Crédito)</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($movimento2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Taxas e Bonificações</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($taxas,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo Total para Repasse</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldoRepasse,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br>


<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: DÉBITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');

$num = $inicio;
        if(strlen($num) == 1){
            $num = "0".$num;
        }
        
        $num2 = $fim;
        if(strlen($num2) == 1){
            $num2 = "0".$num2;
        }


$sqlmovimentacaoDebito = mysql_query("SELECT * FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoDebito = mysql_fetch_array($sqlmovimentacaoDebito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_afiliado_id']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pdv']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_hora']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_parcela']; ?>/<?Php echo $vermovimentacaoDebito['movimento_total_parcela']; ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($vermovimentacaoDebito['movimento_valor'] - ($vermovimentacaoDebito['movimento_taxa_adm'] + $vermovimentacaoDebito['movimento_taxa_bonus']),2,",","."); ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_pagamento_dia']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_mes']; ?>/<?Php echo $vermovimentacaoDebito['movimento_pagamento_ano']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_status_estabelecimento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $vermovimentacaoDebito['movimento_protocolo_venda']; ?></td>
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
                    $sqlmovimentacaoDebito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoDebito1 = mysql_fetch_array($sqlmovimentacaoDebito1);
                    echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoDebito1['sum(movimento_valor)'] - ($vermovimentacaoDebito1['sum(movimento_taxa_adm)'] + $vermovimentacaoDebito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12 w3-black w3-round" style="margin-top:10px; height:40px; text-align:center; vertical-align:middle; padding:10px 0;">RELATÓRIO DETALHADO - MODALIDADE: CRÉDITO</div><br>

<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
    <thead>
            <tr>
                <th style="width:5%; text-align:left; background-color:#666666; color:#fff;">Conta</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">PDV</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Data</th>
                <th style="width:8%; text-align:center; background-color:#666666; color:#fff;">Hora</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Parcela</th>
                <th style="width:9%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Tarifas</th>
                <th style="width:10%; text-align:right; background-color:#666666; color:#fff;">Líquido</th>
                <th style="width:5%; text-align:center; background-color:#666666; color:#fff;">Repasse</th>
                <th style="width:10%; text-align:center; background-color:#666666; color:#fff;">Status</th>
                <th style="width:20%; text-align:center; background-color:#666666; color:#fff;">Autorização</th>
            </tr>
        </thead>
        
<?Php
$mesAtual = date('m');
$anoAtual = date('Y');
$sqlmovimentacaoCredito = mysql_query("SELECT * FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano' ORDER BY movimento_id ASC");
while($vermovimentacaoCredito = mysql_fetch_array($sqlmovimentacaoCredito)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $vermovimentacaoCredito['movimento_afiliado_id']; ?></td>
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
                    $sqlmovimentacaoCredito1 = mysql_query("SELECT sum(movimento_valor), sum(movimento_taxa_adm), sum(movimento_taxa_bonus) FROM sps_movimentacao_credito WHERE movimento_estabelecimento_id='$id' AND movimento_mes='$mes' AND movimento_ano='$ano'");
                    $vermovimentacaoCredito1 = mysql_fetch_array($sqlmovimentacaoCredito1);
                    echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'],2,",","."); ?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)'],2,",",".");?></th>
                <th style="text-align:right; background-color:#666666; color:#fff;"><?Php echo number_format($vermovimentacaoCredito1['sum(movimento_valor)'] - ($vermovimentacaoCredito1['sum(movimento_taxa_adm)'] + $vermovimentacaoCredito1['sum(movimento_taxa_bonus)']),2,",","."); ?></th>
                <th colspan="3" style="text-align:left; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
</table>
</div>

<div class="col-sm-12" style="margin-top:10px; padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>






<?Php
}
}
}



































?>