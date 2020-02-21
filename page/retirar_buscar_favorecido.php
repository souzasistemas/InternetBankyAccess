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

$servico = $tarifaSaque;
$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto - $servico;

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

/** quantidade de saques solicitados */
$sqlSolicitacoes = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$solicitacoes = mysqli_num_rows($sqlSolicitacoes);
    $limiteSolicitacao = "3";
    $quatidadedisponivel = $limiteSolicitacao - $solicitacoes;


$sqlSolicitacoes2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data='$dia/$mes/$ano' AND extrato_tipo='Debito' AND extrato_tipo_modo='Retirada'");
$verSolicitacoes2 = mysqli_fetch_array($sqlSolicitacoes2);
    $totalSolicitado = $verSolicitacoes2['sum(extrato_valor)'];
    
if($saldoGeral > "5000"){
    $limite = 5000 - $totalSolicitado;
}elseif($saldoGeral <= "5000"){
    $limite = $saldoGeral;
}
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

input {
    z-index:-1;
}


</style>
</head>

<body id="principal">
<br><br>

<div class="w3-container">

<?Php
$limite = $_GET['limite'];
$limite2 = $_GET['limite2'];
$quantidade= $_GET['quantidade'];
$tarifa = $_GET['tarifa'];

$sqlFavorecido = mysqli_query($conexao, "SELECT * FROM sps_banco_favorecido WHERE favorecido_afiliado_id='$id' ORDER BY favorecido_id ASC");
$verFavorecido = mysqli_fetch_assoc($sqlFavorecido);
    $idFavorecido = $verFavorecido['favorecido_id'];

     
if($idFavorecido == ""){
?>
    <center><span class="w3-xlarge">Você não possui contas cadastradas!</span><br><br>
    <a href="javascript:history.back(-1);"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a>
    </center>

<?Php
}else{
?>
<h1 class="w3-large w3-center" style="margin-top:-5px;"><b>Contas Cadastradas</b></h1>
<table class="w3-table">
<?php
$sqlFavorecido2 = mysqli_query($conexao, "SELECT * FROM sps_banco_favorecido WHERE favorecido_afiliado_id='$id'");
while($resultado = mysqli_fetch_array($sqlFavorecido2)){
    $idSelecao = $resultado['favorecido_id'];
    $banco = $resultado['favorecido_banco'];
    $sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$banco'");
    $verBanco = mysqli_fetch_array($sqlBanco);
?>
    <tr style="border-top:1px solid #ccc;">
        <td>
            <?Php echo $resultado['favorecido_nome'];?><br>
            CPF/CNPJ: <?Php echo $resultado['favorecido_documento'];?><br>
            <?Php echo $verBanco['banco_nome'];?><br>
            Agência: <?Php echo $resultado['favorecido_agencia'];?> <br>
            Conta: <?Php echo $resultado['favorecido_conta'];?>
        </td>
        <td style="vertical-align:middle;"><a href="retirar_confirmar_saque.php?favorecido=<?Php echo $idSelecao; ?>&&id=<?Php echo $id; ?>&&limite=<?Php echo $limite; ?>&&limite2=<?Php echo '5000'; ?>&&quantidade=<?Php echo $quantidade; ?>&&tarifa=<?Php echo $servico; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-green w3-input w3-round"><i class="fas fa-check"></i> Selecionar</button></a><br> 
        <a style="margin-top:-10px;" href="retirar_apagar_conta.php?favorecido=<?Php echo $idSelecao; ?>&&id=<?Php echo $id; ?>&&limite=<?Php echo $limite; ?>&&limite2=<?Php echo '5000'; ?>&&quantidade=<?Php echo $quantidade; ?>&&tarifa=<?Php echo $servico; ?>&&empresa=<?Php echo $empresa; ?>"><button class="w3-red w3-input w3-round"><i class="fas fa-times"></i> Apagar</button></a> 
        </td>
    </tr>
<?Php
}
?>
</table>
<?Php
}
?>

</div>







<div id="sair" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-3 w3-shadow" style="height:150px; width:100px; border-radius:10px">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <center><h3>Deseja Realmente Sair?</h3>
        </header>
        <center><br>
        <table style="width:98%; margin-top:10px;">
<tr>
<td style="border:none; text-align:left; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-red w3-padding-16" onclick="document.getElementById('sair').style.display='none'"><i class="fa fa-times" aria-hidden="true"></i> NÃO</button></td>
<td style="border:none; text-align:right; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-green w3-padding-16" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>'"><i style="font-size:16px;" class="fa fa-check" aria-hidden="true"></i> SIM</button></td>
</tr>
</table></center>
    </div>
</div>
</body>
</html>

<?Php
}
?>