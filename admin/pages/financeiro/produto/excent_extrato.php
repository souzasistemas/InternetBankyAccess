<?Php
session_start();

$id = $_GET['id'];

require "../../../../../config/config.php";


$sql = mysql_query("SELECT * FROM sps_excent WHERE excent_id='$id'");
$ver = mysql_fetch_array($sql);
    $idAfiliado2 = $ver['excent_afiliado_id'];

if($idAfiliado2 == ""){
    $idAfiliado = $_POST['afiliado'];
}else{
    $idAfiliado = $idAfiliado2;
}

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
$ver = mysql_fetch_array($sql);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome2 = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome2 = $ver['afiliado_razao'];
}
?>

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

html, body, div, iframe {margin:0; padding:0;}
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

<br>

<table style="width:95%;">
    <tr>
        <td></td>
        <td align="right"><h2 class="w3-xxlarge">Relatório Rendimentos por Contrato</h2></td>
    </tr>
</table>
   

<div class="col-sm-12">
<hr class="w3-border-black">
    <b>Associado: </b> <?Php echo $idAfiliado; ?> - <?Php echo $nome2; ?><br>
    <b>Contrato:</b># <?Php echo $id;?><br><br>
    <b>Legenda:</b> &nbsp;&nbsp;A - Aplicado &nbsp;&nbsp;&nbsp; B - Bloqueado &nbsp;&nbsp;&nbsp; R- Resgatado<br><br>
<?Php
$sqlPac = mysql_query("SELECT * FROM sps_excent WHERE excent_id='$id'");
$verPac = mysql_fetch_array($sqlPac);

$pct = $verPac['excent_plano'];
$sqlPlanos1 = mysql_query("SELECT * FROM sps_planos_investimentos WHERE invest_id='$pct'");
$verPlanos1 = mysql_fetch_array($sqlPlanos1);

$nomePacote = $verPlanos1['invest_nome']." - ". number_format($verPlanos1['invest_rendimento']*100,2,",",".")."% a.d.u / ".number_format(($verPlanos1['invest_rendimento']*100)*20,2,",",".")."% a.m";
?>

<table class="w3-table" width="100%" style="font-size:14px;">
<tr>
<th colspan="3" class="w3-yellow w3-padding"><?Php echo $nomePacote; ?></th>
</tr>
<tr>
<th style="width:79%; text-align:left; background-color:#000; color:#fff;">Descrição</th>
<th style="width:20%; text-align:right; background-color:#000; color:#fff;">Valor</th>
<th style="width:1%; text-align:right; background-color:#000; color:#fff;">&nbsp;</th>
</tr>

<?Php
$sqlExtrato2 = mysql_query("SELECT * FROM sps_excent_residual WHERE residual_afiliado_id='$idAfiliado' AND residual_contrato='$id' ORDER BY residual_id DESC");
while($verExtrato2 = mysql_fetch_array($sqlExtrato2)){
?>

<tr>
                <td style="vertical-align:middle; font-size:14px;">
                    RENDIMENTO DO DIA <br>
                    <b>Data:</b> <?Php echo $verExtrato2['residual_dia']; ?>/<?Php echo $verExtrato2['residual_mes']; ?>/<?Php echo $verExtrato2['residual_ano']; ?> &nbsp;
                    <b>Horário:</b> <?Php echo $verExtrato2['residual_hora']; ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:14px;"><?Php echo number_format($verExtrato2['residual_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:14px;">
                    <?Php
                    if($verExtrato2['residual_status'] == "Resgatado"){
                        echo "<b>R</b>";
                    }elseif($verExtrato2['residual_status'] == "Aplicado"){
                        echo "<b>A</b>";
                    }elseif($verExtrato2['residual_status'] == "Bloqueado"){
                        echo "<b>B</b>";
                    }
                    ?></td>
            </tr>
<?Php
}
?>
</table>

<table class="w3-table w3-light-gray">
<tr>
<td colspan="2" style="width:79%"><b>Total Rendimento</b></td>
<td style="text-align:right; font-weight:bold; width:20%">
<?Php
$sqlExtrato2 = mysql_query("SELECT sum(residual_valor) FROM sps_excent_residual WHERE residual_afiliado_id='$idAfiliado' AND residual_contrato='$id'");
$verExtrato2 = mysql_fetch_array($sqlExtrato2);
    $TotalContrato = $verExtrato2['sum(residual_valor)']; 
   echo  number_format($TotalContrato,2,",",".");
?></td>
<td style="width:1%">&nbsp;</td>
</tr>
</table><br>
<br>

<button class="w3-red w3-input w3-padding-16 w3-round" onClick="history.back(-1);" style="font-size:18px;">Voltar</button>



</div>    
    
</body>
</html>
