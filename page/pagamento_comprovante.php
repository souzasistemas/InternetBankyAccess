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
$().ready(function(){
var xTriggered = 0;
$( "#passReal" ).keyup(function( event ) {
  $('#pass').val($('#passReal').val());
  console.log( event );
});
$( "#pass" ).focus(function() {
  $('#passReal').focus();
});
  
  });
</script>

<style type="text/css">
    input#passReal{
  width:1px;
  height:10px;
}
input#pass {
    position: absolute;
    width:91%;
}
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

@media print
{
   a.botao{ display: none; }
}
@media screen
{
   a.botao{ display: block; }
}
</style>


</head>

<body id="principal">

<br><br>

<div class="w3-container w3-padding-32 " style="margin-top:-30px;">

<?Php
$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
    $emailEmpresa = $verEmpresa['logo_departamento'];
    $logotipo = $verEmpresa['logo_imagem'];

?>

<img src="https://www.souzasistemas.com.br/internetbankyaccess/img/logo/<?Php echo $logotipo; ?>" width="200px"><br>


<?Php
$idpag = $_GET['idpag'];

$sqlPag = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_id='$idpag'");
$verPag = mysqli_fetch_array($sqlPag);
?>

<h3 class="w3-medium" style="font-family:arial"><b>Comprovante de Pagamento</b><br>
Via Conta Corrente</h3>

<div style="font-size:13px; font-family:arial">
<b>Titular:</b> <?Php echo $name ?><br>
<b>Ag/Conta:</b> 0001 / <?Php echo $id; ?>-<?Php echo $ver['afiliado_codigo']; ?> <br><br>

<b>Representação númerica do código de Barras</b><br>
<?php echo $verPag['pag_codigo']; ?><br>
<b>Vencimento: </b><?php echo $verPag['pag_vencimento']; ?><br>
<b>Valor: </b> R$ <?php echo number_format($verPag['pag_valor'],2,",","."); ?><br>
<b>Descrição: </b><?php echo $verPag['pag_descricao']; ?><br>

<b>Data Pagamento: </b><?php echo $verPag['pag_dia_pagamento']; ?>/<?php echo $verPag['pag_mes_pagamento']; ?>/<?php echo $verPag['pag_ano_pagamento']; ?><br>
<b>Hora Pagamento: </b><?php echo $verPag['pag_hora_pagamento']; ?><br><br>

<b>Autenticação Bancária</b>: <b class="w3-text-blue" style="font-size:14px;"><?php echo $verPag['pag_obs']; ?></b>


</div>


  <h4 class="w3-large" style="font-family:arial"><b>Operação realizada com sucesso</b></h4>
  
  <span style="font-size:10px; font-family:arial">
  <strong>Informações:</strong> <?Php echo $verEmpresa['logo_departamento']; ?><br />
  </span>
<br>


<table style="width:100%;">
    <tr>
        <td style="width:100%; text-align:left;"><a href="javascript:window.print();" class="botao"><input name="avancar" type="button" id="avancar" class="w3-input btn-lg w3-green" value="Imprimir" style="font-size:16px; width:98%;"></a></td>
    </tr>
    <tr>    
        <td style="width:100%; text-align:left;"><br><a href="pagamento_consultar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="botao"><input name="avancar" type="button" id="avancar" class="w3-input btn-lg w3-blue" value="Ver Pagamentos" style="font-size:16px; width:98%;"></a></td>
    </tr>
</table>    


             
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
}
?>