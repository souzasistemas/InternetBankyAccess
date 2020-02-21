<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];


require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     

 


date_default_timezone_set('Brazil/East');
$dataCompleta = date('d/m/Y H:i:s');
$data = date('d/m/Y');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$horario2 = date('H:i:s');


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


</style>
</head>

<body id="principal">
<br>

<div class="w3-container">

<?Php
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

$dias_de_prazo_para_pagamento = 2;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento * 86400));
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));

$inserir = mysqli_query($conexao, "INSERT INTO sps_deposito(
deposito_afiliado_id,
deposito_empresa,
deposito_valor,
deposito_tarifa,
deposito_valor_liquido,
deposito_dia,
deposito_mes,
deposito_ano,
deposito_data,
deposito_vence_data,
deposito_descricao,
deposito_modo,
deposito_status,
deposito_remessa) VALUES (
        '$id',
        '$empresa',
        '$valor',
        '0',
        '$valor',
        '$dia',
        '$mes',
        '$ano',
        '$dia/$mes/$ano',
        '$data_venc',
        'RECARGA EM CONTA SOLICITADA',
        'Transferencia',
        'Pendente',
        'Registrado')");

?>

    <div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px; margin-top:10px;">Olá, <strong><?Php echo $name; ?></strong><br>
        Valor para depósito: <b>R$  <?Php echo number_format($valor,2,",","."); ?></b><br>
        <b style="color:gray;">* Após a realização do depósito, enviar o comprovante utilizando a opção abaixo</b>
    </div>
    <br>
    
    <?Php
    $sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
    $verEmpresa = mysqli_fetch_array($sqlEmpresa);
        $banco = $verEmpresa['logo_banco'];
        
    $sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$banco'");
    $verBanco = mysqli_fetch_array($sqlBanco);
    ?>
    
    
        <div class="w3-container" style="font-size:16px; margin-bottom:5px;">
            
            <div class="w3-twothird"><b>Código: <?Php echo $verBanco['banco_codigo']; ?>&nbsp;&nbsp;  <?Php echo strtoupper($verBanco['banco_nome']); ?></b> <br>
            <b>Agência:</b> <?Php echo $verEmpresa['logo_agencia']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            <b>Conta:</b> <?Php echo $verEmpresa['logo_conta']; ?><br>
            <b>Razão Social:</b> <?Php echo strtoupper($verEmpresa['logo_razao']); ?><br>
            <b>Empresa:</b> <?Php echo strtoupper($verEmpresa['logo_fantasia']); ?><br>
            <b>CNPJ:</b> <?Php echo $verEmpresa['logo_documento']; ?></b></div>
            
            <div class="w3-third" style="text-align:right"><img src="../img/banco/<?Php echo $verEmpresa['logo_imagem_banco']; ?>" width="100px"></div>
            
            
        </div><br>
<a href="deposito_enviar_comprovante_carregar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-input w3-blue btn-lg w3-padding-16" style="margin-bottom:5px;" /><i class="fas fa-angle-right"></i> Enviar Comprovante</button></a>
<a href="deposito_banco2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="margin-bottom:5px; width:100%;"><i class="fas fa-reply"></i> Início</button></a>

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