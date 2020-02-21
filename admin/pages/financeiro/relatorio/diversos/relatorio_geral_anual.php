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
 
</head>
<body id="principal">
    
<div class="w3-container">
    <h2 class="w3-xlarge botao">Gerar Relatório Anual</h2>
    
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form" method="POST" class="botao">
    <input name="numero" type="hidden" value="1">
    <table class="w3-table" style="width:800px">
        <tr>
            <td style="vertical-align:middle;"><b>Ano</b> </td>
            <td><input name="ano" type="text" class="w3-input w3-white w3-round w3-border" maxlength="4" style="width:100px"></td>
            <td style="vertical-align:middle;"><button class="w3-button w3-round w3-green"><i class="fa fa-search"></i> Buscar</button></td>
        </tr>
        
    </table>

</form>


<?Php
require "../../../../../config/config.php";

$numero = $_POST['numero'];
$ano = $_POST['ano'];

if($numero == ""){
}else{

if($ano != ""){
?>

<hr class="w3-border-black">

<table class="w3-table">
    <tr>
        <td></td>
        <td class="w3-right" style="text-transform:uppercase"><h2>Relatório Anual - REF: <?Php echo $ano; ?></h2></td>
    </tr>
</table>

<table class="w3-table w3-striped w3-bordered" style="font-size:10px;">
    <thead style="background-color:#000; color:#fff;">
        <tr>
            <td colspan="3">&nbsp;</td>
            <td style="text-align:center;0.5%;"> | </td>
            <td colspan="6" style="text-align:center;">ENTRADA</td>
            <td style="text-align:center;0.5%;"> | </td>
            <td colspan="6" style="text-align:center;">SAÍDAS</td>
            <td style="text-align:center;0.5%;"> | </td>
            
        </tr>
        <tr>
            <td style="text-align:center; width:1%;">Conta</td>
            <td style="text-align:left; width:63.5%;">Nome / Razão Social</td>
            <td style="text-align:center; width:20%;">CPF / CNPJ</td>
            <td style="text-align:center; width:0.5%;"> | </td>
            <td style="text-align:right; width:1%;">Ativação</td>
            <td style="text-align:right; width:1%;">Recargas</td>
            <td style="text-align:right; width:1%;">Comissões</td>
            <td style="text-align:right; width:1%;">Residual</td>
            <td style="text-align:right; width:1%;">Transferências</td>
            <td style="text-align:right; width:1%;">Taxas</td>
            <td style="text-align:center; width:0.5%;;"> | </td>
            <td style="text-align:right; width:1%;">Retiradas</td>
            <td style="text-align:right; width:1%;">Transferências</td>
            <td style="text-align:right; width:1%;">Boletos</td>
            <td style="text-align:right; width:1%;">Recargas</td>
            <td style="text-align:right; width:1%;">Compras</td>
            <td style="text-align:right; width:1%;">Diversos</td>
            <td style="text-align:center; width:0.5%;"> | </td>
        </tr>
    </thead>
    
    <?Php
    
    $sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id >= '1001' ORDER BY afiliado_id");
    while($ver = mysql_fetch_array($sql)){
        $id = $ver['afiliado_id'];
        $modo = $ver['afiliado_conta_modo'];
        $nome = strtoupper($ver['afiliado_nome']);
        $razao = strtoupper($ver['afiliado_razao']);
        $cpf = $ver['afiliado_cpf'];
        $cnpj = $ver['afiliado_cnpj'];
    ?>
    
    
    <tbody>
        <tr>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $id; ?></td> <!--NUMERO DA CONTA -->
                
            <?Php
            if($modo == "Fisica"){
            ?>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $nome; ?></td>  <!--NOME PESSOA FISICA -->
                <td style="text-align:center; vertical-align:middle;"><?Php echo $cpf; ?></td>   <!--CPF -->
            <?Php
            }elseif($modo == "Juridica"){
            ?>
                <td style="text-align:left; vertical-align:middle;"><?Php echo $razao; ?></td>  <!--RAZÃO SOCIAL -->
                <td style="text-align:center; vertical-align:middle;"><?Php echo $cnpj; ?></td>   <!--CNPJ -->
            <?Php
            }
            ?>
                <td style="text-align:center; vertical-align:middle;"> | </td>
                
                
                <!--ENTRADA ATIVAÇÕES -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada1 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Ativacao' AND extrato_tipo='Credito'");
                        $verEntrada1 = mysql_fetch_array($sqlEntrada1);
                            $totalAtivacao = $verEntrada1['sum(extrato_valor)'];
                            
                            echo number_format($totalAtivacao,2,",",".");
                    ?>
                </td>
                
                <!--ENTRADA RECARGAS -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada2 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Recarga' AND extrato_tipo='Credito'");
                        $verEntrada2 = mysql_fetch_array($sqlEntrada2);
                            $totalRecarga = $verEntrada2['sum(extrato_valor)'];
                            
                            echo number_format($totalRecarga,2,",",".");
                    ?>
                </td>
                
                
                <!--ENTRADA COMISSÕES -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada3 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Comissao' AND extrato_tipo='Credito'");
                        $verEntrada3 = mysql_fetch_array($sqlEntrada3);
                            $totalComissao = $verEntrada3['sum(extrato_valor)'];
                            
                            echo number_format($totalComissao,2,",",".");
                    ?>
                </td>
                
                <!--ENTRADA RESIDUAL -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada4 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Residual' AND extrato_tipo='Credito'");
                        $verEntrada4 = mysql_fetch_array($sqlEntrada4);
                            $totalResidual = $verEntrada4['sum(extrato_valor)'];
                            
                            echo number_format($totalResidual,2,",",".");
                    ?>
                </td>
                
                
                <!--ENTRADA TRANSFERÊNCIA -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada5 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Transferencia' AND extrato_tipo='Credito'");
                        $verEntrada5 = mysql_fetch_array($sqlEntrada5);
                            $totalTransferencia = $verEntrada5['sum(extrato_valor)'];
                            
                            echo number_format($totalTransferencia,2,",",".");
                    ?>
                </td>
                
                <!--ENTRADA TAXA -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlEntrada6 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Taxa' AND extrato_tipo='Credito'");
                        $verEntrada6 = mysql_fetch_array($sqlEntrada6);
                            $totalTaxas = $verEntrada6['sum(extrato_valor)'];
                            
                            echo number_format($totalTaxas,2,",",".");
                    ?>
                </td>
                
                <td style="text-align:center; vertical-align:middle;"> | </td>
                
                
                <!--SAÍDA RETIRADA -->
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                        $sqlSaida1 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Retirada' AND extrato_tipo='Debito' AND extrato_protocolo!=''");
                        $verSaida1 = mysql_fetch_array($sqlSaida1);
                            $totalRetirada2 = $verSaida1['sum(extrato_valor)'];
                        
                        $sqlSaida2 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_modulo='Transferencia' AND extrato_tipo='Debito'");
                        $verSaida2 = mysql_fetch_array($sqlSaida2);
                            $totalTransferencia2 = $verSaida2['sum(extrato_valor)'];
                            
                        $sqlSaida3 = mysql_query("SELECT sum(pag_valor) FROM sps_pagamentos WHERE pag_afiliado_id='$id' AND pag_ano_pagamento='$ano' AND pag_status!='Cancelado'");
                        $verSaida3 = mysql_fetch_array($sqlSaida3);
                            $totalBoleto = $verSaida3['sum(pag_valor)'];
                        
                        $sqlSaida4 = mysql_query("SELECT sum(recarga_valor) FROM sps_recarga_celular WHERE recarga_afiliado_id='$id' AND recarga_ano='$ano' AND recarga_status!='Cancelado'");
                        $verSaida4 = mysql_fetch_array($sqlSaida4);
                            $totalRecargaCelular = $verSaida4['sum(recarga_valor)'];
                            
                        $sqlSaida5 = mysql_query("SELECT sum(movimento_valor) FROM sps_movimentacao WHERE movimento_afiliado_id='$id' AND movimento_ano='$ano' AND movimento_tipo='Venda'");
                        $verSaida5 = mysql_fetch_array($sqlSaida5);
                            $totalMovimentacao1 = $verSaida5['sum(movimento_valor)'];
                            
                        $sqlSaida5a = mysql_query("SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_ano='$ano' AND movimento_tipo='Venda'");
                        $verSaida5a = mysql_fetch_array($sqlSaida5a);
                            $totalMovimentacao2 = $verSaida5a['sum(movimento_valor)'];
                            
                            $totalMovimentacao = $totalMovimentacao1 + $totalMovimentacao2;
                            
                        $sqlSaida6 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_ano='$ano' AND extrato_tipo='Debito'");
                        $verSaida6 = mysql_fetch_array($sqlSaida6);
                            $totalTaxa2 = $verSaida6['sum(extrato_valor)'];
                            
                            $totalTaxa3 = $totalTaxa2 - $totalRetirada2 - $totalTransferencia2 - $totalBoleto - $totalRecargaCelular - $totalMovimentacao1; 
                            
                            $totalTaxa23 = $totalTaxa1 + $totalTaxa3;
                            
                            echo number_format($totalRetirada2,2,",",".");
                    ?>
                </td>
                
                <!--SAÍDA TRASNFERENCIA -->
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($totalTransferencia2,2,",",".");?></td>
                
                <!--SAÍDA BOLETOS -->
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($totalBoleto,2,",",".");?></td>
                
                
                <!--SAÍDA RECARGAS -->
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($totalRecargaCelular,2,",",".");?></td>
                
                
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($totalMovimentacao,2,",",".");?></td>
                
                
                <!--SAÍDA TRASNFERENCIA -->
                <td style="text-align:right; vertical-align:middle;"><?Php echo number_format($totalTaxa23,2,",",".");?></td>
                
                <td style="text-align:center; vertical-align:middle;"> | </td>
                
                
        </tr>
    </tbody>
    
    <?Php
    }
    ?>
</table><br>

<div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>
<?Php
}elseif($ano == ""){
?>
<hr class="w3-border-black">
<center>
    <div class="w3-red w3-round" style="padding:10px 0">Pesquisa não localizada! É necessário preencher todos os campos!</div>
</center>
<?Php
}
}
?>



</div>
</body>
</html>