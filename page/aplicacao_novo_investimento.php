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

<?Php

/***** saldo disponível */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;

$pacote = $_GET['pac'];

$sqlPlanos = mysqli_query($conexao, "SELECT * FROM sps_planos_investimentos WHERE invest_id='$pacote'");
$verPlanos = mysqli_fetch_array($sqlPlanos);

 $nomePacote = $verPlanos['invest_nome']. " <br>".number_format(($verPlanos['invest_rendimento']*100)*20,2,",",".")." A.M";

        
?>

<?Php
if($saldo_disponivel < "1000"){
    echo "<div class='col-sm-12' style='text-align:center;'>";
    echo "<br><br>";
    echo "<center>";
    echo "<h2>Desculpe! Você não possui saldo mínimo de R$ 1000,00 para realizar sua aplicação</h2>";
    echo "<br>";
    echo "<button class='btn btn-danger btn-lg' onClick='history.back(-1)'><i class='fa fa-reply' aria-hidden='true'></i> Voltar</button>";
    echo "</center>";
    echo "</div>";
}else{
?>

<div class="w3-container">

<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px; margin-top:10px;"><b>NOVO CONTRATO <br><?Php echo $nomeEmpresa; ?><br><br>Plano Escolhido</b><br>
<?Php echo $nomePacote; ?>
</div>
<div class="w3-container-fluid w3-white w3-round" style="font-size:14px; margin-top:10px;">
    
    <form action="aplicacao_novo_investimento_confirmar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" method="post" name="form">
            <input name="residual" type="hidden" value="<?Php echo $pacote; ?>">
            <input name="maxima" type="hidden" value="<?Php echo $saldo_disponivel; ?>">
            
            <script>
                document.getElementById("input").addEventListener("change", function(){
                    this.value = parseFloat(this.value).toFixed(2);
                });
            </script>
            
            <input name="valor" id="input" class="w3-input w3-border w3-round w3-padding-16" type="number" step="0.010"  placeholder="Valor da Aplicação?" autocomplete="off" style="font-size:18px; margin-bottom:5px; text-align:center;" required></center>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button type="button" onClick="history.back(-1);" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></td>
        <td style="width:50%; text-align:left;"><button name="reset" type="submit" class="btn-lg w3-teal w3-input w3-padding-16" style="border:none; width:100%;"><i class="fas fa-check"></i> Avançar</button></td>
        
    </tr>
</table>

            
        
        
    </form>
    </div>
</div>    
<?Php
}
?>


</body>
</html>

<?Php
}
}
?>