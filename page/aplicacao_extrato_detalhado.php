<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];


if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     


if($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{
    


/***** saldo em conta */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$ver_credito2 = mysqli_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysqli_query($conexao, "SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysqli_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$ver_debito2 = mysqli_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];

$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;

date_default_timezone_set('Brazil/East');
$hora_do_dia = date('H');

if(($hora_do_dia >=6) && ($hora_do_dia <=12)){
	$saudacao = "Bom Dia!";
}elseif(($hora_do_dia >12) && ($hora_do_dia <=18)){
	$saudacao = "Bom Tarde!";
}elseif(($hora_do_dia >18) && ($hora_do_dia <=23)){
	$saudacao = "Boa Noite!";
}elseif(($hora_do_dia >=0) && ($hora_do_dia <6)){
	$saudacao = "Boa Madrugada!";
}

$sqlExcent = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent = mysqli_fetch_array($sqlExcent);
$totalExcent = mysqli_num_rows($sqlExcent);

$sqlExcent2 = mysqli_query($conexao, "SELECT sum(excent_valor_liquido) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent2 = mysqli_fetch_array($sqlExcent2);
    $totalValor2 = $verExcent2['sum(excent_valor_liquido)'];
    
$sqlExcent3 = mysqli_query($conexao, "SELECT sum(excent_valor_residual) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent3 = mysqli_fetch_array($sqlExcent3);
    $totalValor3 = $verExcent3['sum(excent_valor_residual)'] * 20;
    

$sqlExcent4= mysqli_query($conexao, "SELECT sum(residual_valor_pagar) FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_status!='Pago'");
$verExcent4 = mysqli_fetch_array($sqlExcent4);
    $totalValor4 = $verExcent4['sum(residual_valor_pagar)'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<title><?Php echo $nomeEmpresa; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
<link rel="icon" href="../img/<?Php echo $icone; ?>">
<link rel="shortcut icon" href="../img/<?Php echo $icone; ?>">
        
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

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



<style type="text/css">
html, body, div{
	font-family: "Ubuntu", sans-serif;
	font-size:14px;
    background-repeat:no-repeat;
}
html, body{
    height:100%;
}
iframe#iframe{
    height:88%;
}

#principal::-webkit-scrollbar-track {
    background-color: #222;
}
#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
#principal::-webkit-scrollbar-thumb {
    background: #555;
}


</style>
</head>

<body id="principal">



<div class="w3-black" style="height:52px;"></div>
<br>
<div class="w3-container w3-padding">
    <a href="aplicacao_extrato_detalhado.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-tag w3-round w3-green w3-padding-16" style="border:0; width:49%" type="button">Extrato Rendimentos</button></a>
    <a href="aplicacao_novo_iniciar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-tag w3-round w3-blue w3-padding-16" style="border:0; width:49%" type="button"> Nova Aplicação</button></a>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>" name="form" method="POST" class="botao">
        <input name="escolha" type="hidden" value="branco">
        <br>
        <select name="contrato" class="w3-input w3-white w3-padding-16 w3-round w3-border" style="font-size:18px; margin-bottom:10px;" required>
                    <option value="">Por Contrato...</option>
                    <?Php
                    $sqlExcent = mysql_query("SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo' ORDER BY excent_id");
                    while($verExcent = mysql_fetch_array($sqlExcent)){
                    ?>
                    <option value="<?Php echo $verExcent['excent_id']; ?>">#<?Php echo $verExcent['excent_id']; ?></option>
                    <?Php
                    }
                    ?>
                </select>
        <table style="width:100%;">
            
            <tr>
                <td><button class="w3-button w3-round w3-green btn-lg" style="width:100%;"><i class="fa fa-search"></i> Buscar</button></td>
                <td style="text-align:right;"><a href="aplicacao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-button w3-round w3-red btn-lg" style="width:98%;" type="button"><i class="fa fa-times"></i> Cancelar</button></a></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:5px;"><a href="aplicacao_extrato_completo.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-button w3-round w3-orange w3-text-white btn-lg" style="width:100%;" type="button"><i class="fa fa-search"></i> Extrato Completo</button></a></td>
            </tr>
            </table>
    </form>
<?Php
$escolha = $_POST['escolha'];
$contrato = $_POST['contrato'];

if($escolha == ""){
?>
<?Php
}else{
?>


<table class="w3-table" width="100%" style="font-size:12px;">
         
             <tr>
                 <td colspan="3">
<hr class="w3-border-black botao" id="extrato">  
    <b>Legenda:</b><br>
    B - Bloqueado &nbsp;&nbsp;
    R - Resgatado &nbsp;&nbsp;
    A - Aplicado </b>   
                 </td>
             </tr>
            <tr>
                <th style="width:79%; text-align:left; background-color:#000; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#000; color:#fff;">Valor</th>
                <th style="width:1%; text-align:right; background-color:#000; color:#fff;">&nbsp;</th>
            </tr>
        
<?Php
if($contrato == "0"){
$sqlExtrato = mysqli_query($contrato, "SELECT * FROM sps_excent_residual WHERE residual_afiliado_id='$id' GROUP BY residual_contrato ORDER BY residual_id DESC");
while($verExtrato = mysqli_fetch_array($sqlExtrato)){
    $idContrato = $verExtrato['residual_contrato'];

$sqlExtrato2 = mysqli_query($contrato, "SELECT * FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_contrato='$idContrato' ORDER BY residual_id DESC");
$verExtrato2 = mysqli_fetch_array($sqlExtrato2);

$sqlPac = mysqli_query($contrato, "SELECT * FROM sps_excent WHERE excent_id='$idContrato'");
$verPac = mysqli_fetch_array($sqlPac);

$pct = $verPac['excent_plano'];
$sqlPlanos1 = mysqli_query($contrato, "SELECT * FROM sps_planos_investimentos WHERE invest_id='$pct'");
$verPlanos1 = mysqli_fetch_array($sqlPlanos1);

$nomePacote = $verPlanos1['invest_nome']."<br>". number_format($verPlanos1['invest_rendimento']*100,2,",",".")."% a.d.u / ".number_format(($verPlanos1['invest_rendimento']*100)*20,2,",",".")."% a.m";


?>
<tbody>
    <tr>
        <td colspan="3" class="w3-yellow w3-center"><b>Contrato #</b><?Php echo $idContrato; ?> <br> <?Php echo $nomePacote; ?></td>
    </tr>
            <tr>
                <td style="vertical-align:middle; font-size:10px;">
                    RENDIMENTO DO DIA <br>
                    <b>Data:</b> <?Php echo $verExtrato['residual_dia']; ?>/<?Php echo $verExtrato['residual_mes']; ?>/<?Php echo $verExtrato['residual_ano']; ?> &nbsp;
                    <b>Horário:</b> <?Php echo $verExtrato['residual_hora']; ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:10px;"><?Php echo number_format($verExtrato['residual_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:10px;">
                    <?Php
                    if($verExtrato['residual_status'] == "Resgatado"){
                        echo "<b>R</b>";
                    }elseif($verExtrato['residual_status'] == "Aplicado"){
                        echo "<b>A</b>";
                    }elseif($verExtrato['residual_status'] == "Bloqueado"){
                        echo "<b>B</b>";
                    }
                    ?></td>
            </tr>
        </tbody>
<?Php
}
}else{

$sqlPac = mysqli_query($contrato, "SELECT * FROM sps_excent WHERE excent_id='$contrato'");
$verPac = mysqli_fetch_array($sqlPac);

$pct = $verPac['excent_plano'];
$sqlPlanos1 = mysqli_query($contrato, "SELECT * FROM sps_planos_investimentos WHERE invest_id='$pct'");
$verPlanos1 = mysqli_fetch_array($sqlPlanos1);

$nomePacote = $verPlanos1['invest_nome']."<br>". number_format($verPlanos1['invest_rendimento']*100,2,",",".")."% a.d.u / ".number_format(($verPlanos1['invest_rendimento']*100)*20,2,",",".")."% a.m";

?>

 <tr>
        <td colspan="3" class="w3-yellow w3-center"><b>Contrato #</b><?Php echo $contrato; ?> <br> <?Php echo $nomePacote; ?></td>
    </tr>
<?Php    
$sqlExtrato = mysqli_query($contrato, "SELECT * FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_contrato='$contrato'ORDER BY residual_id DESC");
while($verExtrato = mysqli_fetch_array($sqlExtrato)){
    $idContrato = $verExtrato['residual_contrato'];


?>
<tbody>
    
            <tr>
                <td style="vertical-align:middle; font-size:10px;">
                    RENDIMENTO DO DIA <br>
                    <b>Data:</b> <?Php echo $verExtrato['residual_dia']; ?>/<?Php echo $verExtrato['residual_mes']; ?>/<?Php echo $verExtrato['residual_ano']; ?> &nbsp;
                    <b>Horário:</b> <?Php echo $verExtrato['residual_hora']; ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:10px;"><?Php echo number_format($verExtrato['residual_valor'],2,",","."); ?></td>
                <td style="text-align:right; vertical-align:middle; font-size:10px;">
                    <?Php
                    if($verExtrato['residual_status'] == "Resgatado"){
                        echo "<b>R</b>";
                    }elseif($verExtrato['residual_status'] == "Aplicado"){
                        echo "<b>A</b>";
                    }elseif($verExtrato['residual_status'] == "Bloqueado"){
                        echo "<b>B</b>";
                    }
                    ?></td>
            </tr>
        </tbody>



<?Php
}   
}

?>
</table>
        
<table class="w3-table w3-light-gray">
<tr>
<td colspan="2" style="width:79%"><b>Total Rendimento</b></td>
<td style="text-align:right; font-weight:bold; width:20%">
<?Php
$sqlExtrato2 = mysqli_query($contrato, "SELECT sum(residual_valor) FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_contrato='$contrato'");
$verExtrato2 = mysqli_fetch_array($sqlExtrato2);
    $TotalContrato = $verExtrato2['sum(residual_valor)']; 
   echo  number_format($TotalContrato,2,",",".");
?></td>
<td style="width:1%">&nbsp;</td>
</tr>
</table>



<?Php
}
?>

</div>



</body>
</html>

<?Php
}
}
?>