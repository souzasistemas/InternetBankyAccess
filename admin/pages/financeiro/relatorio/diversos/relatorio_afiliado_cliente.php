<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo InternetBank Access</title>
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
 
<?Php
require "../../../../../config/config.php";
$idAdm = $_GET['id'];
$sqlAdm = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$idAdm'");
$verAdm = mysql_fetch_array($sqlAdm);
    $loja = $verAdm['admin_empresa'];
    
?>
<div class="w3-container"><br>

<table class="w3-table">
    <tr>
        <td><img src="../../../img/marca.png" width="300px" /></td>
        <td style="text-align:right;"><h1 class="w3-xlarge">Extrato Detalhado - Associados</h1><br></td>
    </tr>
</table>

<div class="well botao" style="height:410px;">
    <h1 class="w3-medium"><b>Escolha o período</b></h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $idAdm; ?>" name="form" method="POST" class="botao">
        <input name="escolha" type="hidden" value="branco">
        <input name="id" type="hidden" value="<?Php echo $idAdm; ?>">
        
        
        <table class="w3-table">
            <tr>
                <td style="vertical-align:middle;"><b>Nº Conta</b></td>
                <td colspan="5" style="vertical-align:middle;"><input name="idAfiliado" type="number" class="w3-input w3-white w3-round w3-border" style="width:250px;" required></td>
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
            <tr>
                <td colspan="5">
                    <div style="font-size:12px;">
                        <b>Legenda Saques:</b>&nbsp;
		                <i class="fa fa-thumbs-up w3-text-green" ></i> Efetuado &nbsp;&nbsp;&nbsp;
		                <i class="fa fa-hourglass-half w3-text-black"></i> Pendente &nbsp;&nbsp;&nbsp;
    	                <i class="fa fa-thumbs-down w3-text-red"></i> Cancelado 
	                </div>
                </td>
            </tr>
        </table>
        
    </form>
</div>


<?Php
$idAfiliado = $_POST['idAfiliado'];
$escolha = $_POST['escolha'];
$tipo = $_POST['tipo'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado' AND afiliado_estabelecimento='$loja'");
$ver = mysql_fetch_array($sql);
$idAfiliadoConta = $ver['afiliado_id'];

if($idAfiliadoConta == ""){
 ?>

<div class="w3-panel w3-pale-yellow w3-border">
  <h3 class="w3-center w3-xxlarge">Conta não localizada</h3>
 
</div>

 <?Php
}else{

if($escolha == ""){
}else{
    if($tipo == "1"){




$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $documento = $ver['afiliado_cpf'];
    $nome = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $documento = $ver['afiliado_cnpj'];
    $nome = $ver['afiliado_razao'];
}
?>
<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:100px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_numero']); ?> - <?Php echo strtoupper($ver['afiliado_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['afiliado_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?>/<?Php echo strtoupper($ver['afiliado_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>&nbsp; &nbsp; &nbsp; <strong>Conta:</strong> <?Php echo strtoupper($ver['afiliado_id']); ?>-<?Php echo $ver['afiliado_codigo_verificador']; ?>
    </div>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">SALDO DE SUA CONTA</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
        <?Php

/***** saldo em conta */
$sql_credito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Credito'");
$ver_credito = mysql_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Debito'");
$ver_debito = mysql_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$idAfiliadoConta'");
$ver_credito2 = mysql_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysql_query("SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$idAfiliadoConta' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysql_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysql_query("SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$idAfiliadoConta' AND pi_status='Pendente'");
$ver_debito2 = mysql_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];
?>

        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Limite</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Débitos</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($debitoAberto,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">EXTRATO DETALHADO</div><br>


<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
   
         <thead>
            <tr>
                <th style="width:75%; text-align:left; background-color:#666666; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:5%; text-align:right; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
        
        <?Php
        $mesAtual = date('m');
        $anoAtual = date('Y');
$sqlExtrato = mysql_query("SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_mes='$mesAtual' AND extrato_ano='$anoAtual' ORDER BY extrato_id DESC");
while($verExtrato = mysql_fetch_array($sqlExtrato)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo strtoupper($verExtrato['extrato_descricao']); ?><br>
                <span class="w3-text-grey"><?Php echo $verExtrato['extrato_dia']; ?>/<?Php echo $verExtrato['extrato_mes']; ?>/<?Php echo $verExtrato['extrato_ano']; ?> - 
                <?Php echo $verExtrato['extrato_hora']; ?></span>
                </td>
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                    if($verExtrato['extrato_tipo'] == "Credito"){
                        echo "<span style='color:green'> + ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }elseif($verExtrato['extrato_tipo'] == "Debito"){
                        echo "<span style='color:red'> - ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }
                    ?>
                </td>
                <td style="text-align:center; vertical-align:middle;">
                    <?Php
							if($verExtrato['extrato_status_saque'] == "Pago"){
								echo "<i class='fa fa-thumbs-up w3-text-green' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Pendente"){
								echo "<i class='fa fa-hourglass-half w3-text-black' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Cancelado"){
								echo "<i class='fa fa-thumbs-down w3-text-red' ></i>";
							}
						?>
                </td>
            </tr>
        </tbody>

<?Php }?>
            
</table><br>

<div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>

</div>
</div><br><br>
      
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
<?Php        
    }elseif($tipo == "2"){

if($inicio == "" && $fim == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA INÍCIO e DATA FIM!');</script>";
}elseif($inicio != "" && $fim == ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA FIM!');</script>";
}elseif($inicio == "" && $fim != ""){
    echo "<script>history.back(-1); alert('Obrigatório selecionar DATA INÍCIO!');</script>";
}else{

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado' AND afiliado_estabelecimento='$loja'");
$ver = mysql_fetch_array($sql);
$idAfiliadoConta = $ver['afiliado_id'];

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $documento = $ver['afiliado_cpf'];
    $nome = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $documento = $ver['afiliado_cnpj'];
    $nome = $ver['afiliado_razao'];
}
?>
<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:100px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_numero']); ?> - <?Php echo strtoupper($ver['afiliado_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['afiliado_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?>/<?Php echo strtoupper($ver['afiliado_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>&nbsp; &nbsp; &nbsp; <strong>Conta:</strong> <?Php echo strtoupper($ver['afiliado_id']); ?>-<?Php echo $ver['afiliado_codigo_verificador']; ?>
    </div>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">SALDO DE SUA CONTA</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
        <?Php

/***** saldo em conta */
$sql_credito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Credito'");
$ver_credito = mysql_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Debito'");
$ver_debito = mysql_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$idAfiliadoConta'");
$ver_credito2 = mysql_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysql_query("SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$idAfiliadoConta' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysql_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysql_query("SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$idAfiliadoConta' AND pi_status='Pendente'");
$ver_debito2 = mysql_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];
?>

        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Limite</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Débitos</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($debitoAberto,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br><br>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">EXTRATO DETALHADO</div><br>


<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
   
         <thead>
            <tr>
                <th style="width:75%; text-align:left; background-color:#666666; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:5%; text-align:right; background-color:#666666; color:#fff;">&nbsp;</th>
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
        
$sqlExtrato = mysql_query("SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_dia >= '$num' AND extrato_dia <= '$num2' AND  extrato_mes='$mesAtual' AND extrato_ano='$anoAtual' ORDER BY extrato_id DESC");
while($verExtrato = mysql_fetch_array($sqlExtrato)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo strtoupper($verExtrato['extrato_descricao']); ?><br>
                <span class="w3-text-grey"><?Php echo $verExtrato['extrato_dia']; ?>/<?Php echo $verExtrato['extrato_mes']; ?>/<?Php echo $verExtrato['extrato_ano']; ?> - 
                <?Php echo $verExtrato['extrato_hora']; ?></span>
                </td>
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                    if($verExtrato['extrato_tipo'] == "Credito"){
                        echo "<span style='color:green'> + ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }elseif($verExtrato['extrato_tipo'] == "Debito"){
                        echo "<span style='color:red'> - ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }
                    ?>
                </td>
                <td style="text-align:center; vertical-align:middle;">
                    <?Php
							if($verExtrato['extrato_status_saque'] == "Pago"){
								echo "<i class='fa fa-thumbs-up w3-text-green' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Pendente"){
								echo "<i class='fa fa-hourglass-half w3-text-black' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Cancelado"){
								echo "<i class='fa fa-thumbs-down w3-text-red' ></i>";
							}
						?>
                </td>
            </tr>
        </tbody>

<?Php }?>
            
</table><br>

<div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>

</div>
</div><br><br>



























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

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado' AND afiliado_estabelecimento='$loja'");
$ver = mysql_fetch_array($sql);
$idAfiliadoConta = $ver['afiliado_id'];

$sqlMes = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$verMes = mysql_fetch_array($sqlMes);
$nomeMes = strtoupper($verMes['mes_valor']);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $documento = $ver['afiliado_cpf'];
    $nome = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $documento = $ver['afiliado_cnpj'];
    $nome = $ver['afiliado_razao'];
}
?>
<hr class="w3-border-black botao">    
        
<div class="col-sm-12">
    <div class="well" style="padding:10px; vertical-align:middle; font-size:12px; height:100px;">
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_numero']); ?> - <?Php echo strtoupper($ver['afiliado_complemento']); ?> &nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($ver['afiliado_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?>/<?Php echo strtoupper($ver['afiliado_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>&nbsp; &nbsp; &nbsp; <strong>Conta:</strong> <?Php echo strtoupper($ver['afiliado_id']); ?>-<?Php echo $ver['afiliado_codigo_verificador']; ?>
    </div>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">SALDO DE SUA CONTA</div><br>


<div class="col-sm-12" style="height:220px; padding:0;">
    <div class="well w3-light-grey">
        
        <?Php

/***** saldo em conta */
$sql_credito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Credito'");
$ver_credito = mysql_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_tipo='Debito'");
$ver_debito = mysql_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysql_query("SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$idAfiliadoConta'");
$ver_credito2 = mysql_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysql_query("SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$idAfiliadoConta' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysql_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysql_query("SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$idAfiliadoConta' AND pi_status='Pendente'");
$ver_debito2 = mysql_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];
?>

        <table class="w3-table" style="width:100%;">
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Limite</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($saldo_disponivel2,2,",",".");?></td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Débitos</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;"><?Php echo number_format($debitoAberto,2,",",".");?></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; vertical-align:middle;"><b>Saldo</b></td>
                <td style="width:50%; text-align:right; vertical-align:middle;">
                    <?Php 
                        $saldoReal = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;
                        
                        if($saldoReal < "0"){
                            echo "<span style='color:red; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal > "0"){
                            echo "<span style='color:green; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }elseif($saldoReal == "0"){
                            echo "<span style='color:black; font-weight:bold; font-size:18px;'>".number_format($saldo_disponivel + $saldo_disponivel2 - $debitoAberto,2,",",".")."</span>";
                        }
                        ?>
                </td>
            </tr>
        </table>
    </div>
</div><br>


<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">EXTRATO DETALHADO</div><br>


<div class="col-sm-12" style="padding:0;">
<table class="w3-table" style="font-size:12px;">
   
         <thead>
            <tr>
                <th style="width:75%; text-align:left; background-color:#666666; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:5%; text-align:right; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
        
        <?Php
$sqlExtrato = mysql_query("SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$idAfiliadoConta' AND extrato_mes='$mes' AND extrato_ano='$ano' ORDER BY extrato_id DESC");
while($verExtrato = mysql_fetch_array($sqlExtrato)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle;"><?Php echo strtoupper($verExtrato['extrato_descricao']); ?><br>
                <span class="w3-text-grey"><?Php echo $verExtrato['extrato_dia']; ?>/<?Php echo $verExtrato['extrato_mes']; ?>/<?Php echo $verExtrato['extrato_ano']; ?> - 
                <?Php echo $verExtrato['extrato_hora']; ?></span>
                </td>
                <td style="text-align:right; vertical-align:middle;">
                    <?Php
                    if($verExtrato['extrato_tipo'] == "Credito"){
                        echo "<span style='color:green'> + ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }elseif($verExtrato['extrato_tipo'] == "Debito"){
                        echo "<span style='color:red'> - ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }
                    ?>
                </td>
                <td style="text-align:center; vertical-align:middle;">
                    <?Php
							if($verExtrato['extrato_status_saque'] == "Pago"){
								echo "<i class='fa fa-thumbs-up w3-text-green' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Pendente"){
								echo "<i class='fa fa-hourglass-half w3-text-black' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Cancelado"){
								echo "<i class='fa fa-thumbs-down w3-text-red' ></i>";
							}
						?>
                </td>
            </tr>
        </tbody>

<?Php }?>

</table><br>

<div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>

</div>
</div><br><br>




<?Php
}
}
    }
}
?>

</body>
</html>