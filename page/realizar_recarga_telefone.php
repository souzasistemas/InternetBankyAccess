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

<script language="javascript">
function show_neutro()
{
	document.getElementById('neutro').style.display='block';
	document.getElementById('oi').style.display='none';
	document.getElementById('tim').style.display='none';
	document.getElementById('claro').style.display='none';
	document.getElementById('vivo').style.display='none';
	document.getElementById('nextel').style.display='none';
	
}
function show_oi()
{
	document.getElementById('neutro').style.display='none';
	document.getElementById('oi').style.display='block';
	document.getElementById('tim').style.display='none';
	document.getElementById('claro').style.display='none';
	document.getElementById('vivo').style.display='none';
	document.getElementById('nextel').style.display='none';
	
}
function show_tim()
{
	document.getElementById('neutro').style.display='none';
	document.getElementById('oi').style.display='none';
	document.getElementById('tim').style.display='block';
	document.getElementById('claro').style.display='none';
	document.getElementById('vivo').style.display='none';
	document.getElementById('nextel').style.display='none';
	
}
function show_claro()
{
	document.getElementById('neutro').style.display='none';
	document.getElementById('oi').style.display='none';
	document.getElementById('tim').style.display='none';
	document.getElementById('claro').style.display='block';
	document.getElementById('vivo').style.display='none';
	document.getElementById('nextel').style.display='none';
	
}
function show_vivo()
{
	document.getElementById('neutro').style.display='none';
	document.getElementById('oi').style.display='none';
	document.getElementById('tim').style.display='none';
	document.getElementById('claro').style.display='none';
	document.getElementById('vivo').style.display='block';
	document.getElementById('nextel').style.display='none';
	
}
function show_nextel()
{
	document.getElementById('neutro').style.display='none';
	document.getElementById('oi').style.display='none';
	document.getElementById('tim').style.display='none';
	document.getElementById('claro').style.display='none';
	document.getElementById('vivo').style.display='none';
	document.getElementById('nextel').style.display='block';
	
}
</script>
</head>

<body id="principal"><br>

<div class="w3-container">
<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px;"><b>Olá <?Php echo $name; ?>,</b><br><br>
Recargas realizadas entre 08:00hs até às 22:00hs, serão realizadas no mesmo dia;<br />
Após as 22:00hs, serão realizadas no próximo dia à partir das 08:00hs;
</div><br> 

<form action="realizar_recarga_telefone_confirmar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" method="post" name="form1">
    <input style="text-align:center; font-weight:normal;" name="celular" maxlength="15" id="celular" type="tel" class="form-control input-lg" onkeyup="Mascara('TEL',this,event)" required="required" autocomplete="off" placeholder="Digite o Número do Telefone"><br />
    
<table style="width:100%;">
    <tr>
        <td style="width:25%; text-align:center; vertical-align:middle;"><input type="radio" name="operadora" value="OI" onclick="show_oi()"  class="buttom2 " required="required" />
 <img src="../img/logo_oi.png" width="30" /></td>
        <td style="width:25%; text-align:center; vertical-align:middle;"><input type="radio" name="operadora" value="TIM" onclick="show_tim()" class="buttom2" required="required" />
 <img src="../img/logo_tim.png" width="60" /></td>
        <td style="width:25%; text-align:center; vertical-align:middle;"><input type="radio" name="operadora" value="CLARO" onclick="show_claro()" class="buttom2" required="required" />
 <img src="../img/logo_claro.png" width="40" /></td>
        <td style="width:25%; text-align:center; vertical-align:middle;"><input type="radio" name="operadora" value="VIVO" onclick="show_vivo()" class="buttom2" required="required" />
 <img src="../img/logo_vivo.png" width="40" /></td>
    </tr>
</table>

 <br />

<div id="neutro" style="display:block">
<select name="valor" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
</select><br />
</div> 

<div id="oi" style="display:none">
<select name="valorOi" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
    <option value="10"><strong>R$ 10,00</strong></option>
    <option value="14"><strong>R$ 14,00</strong></option>
    <option value="20"><strong>R$ 20,00</strong></option>
    <option value="25"><strong>R$ 25,00</strong></option>
    <option value="30"><strong>R$ 30,00</strong></option>
    <option value="35"><strong>R$ 35,00</strong></option>
    <option value="40"><strong>R$ 40,00</strong></option>
    <option value="50"><strong>R$ 50,00</strong></option>
    <option value="75"><strong>R$ 75,00</strong></option>
    <option value="100"><strong>R$ 100,00</strong></option>
</select><br />
</div> 

<div id="tim" style="display:none">
<select name="valorTim" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
    <option value="10"><strong>R$ 10,00</strong></option>
    <option value="14"><strong>R$ 14,00</strong></option>
    <option value="15"><strong>R$ 15,00</strong></option>
    <option value="18"><strong>R$ 18,00</strong></option>
    <option value="20"><strong>R$ 20,00</strong></option>
    <option value="30"><strong>R$ 30,00</strong></option>
    <option value="40"><strong>R$ 40,00</strong></option>
    <option value="50"><strong>R$ 50,00</strong></option>
    <option value="100"><strong>R$ 100,00</strong></option>
</select><br />
</div> 

<div id="claro" style="display:none">
<select name="valorClaro" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
    <option value="10"><strong>R$ 10,00</strong></option>
    <option value="13"><strong>R$ 13,00</strong></option>
    <option value="15"><strong>R$ 15,00</strong></option>
    <option value="20"><strong>R$ 20,00</strong></option>
    <option value="30"><strong>R$ 30,00</strong></option>
    <option value="40"><strong>R$ 40,00</strong></option>
    <option value="50"><strong>R$ 50,00</strong></option>
    <option value="100"><strong>R$ 100,00</strong></option>
</select><br />
</div> 

<div id="vivo" style="display:none">
<select name="valorVivo" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
	<option value="7"><strong>R$ 07,00</strong></option>
    <option value="12"><strong>R$ 12,00</strong></option>
    <option value="15"><strong>R$ 15,00</strong></option>
    <option value="20"><strong>R$ 20,00</strong></option>
    <option value="25"><strong>R$ 25,00</strong></option>
    <option value="35"><strong>R$ 35,00</strong></option>
    <option value="40"><strong>R$ 40,00</strong></option>
    <option value="50"><strong>R$ 50,00</strong></option>
    <option value="60"><strong>R$ 60,00</strong></option>
    <option value="100"><strong>R$ 100,00</strong></option>
</select><br />
</div> 

<div id="nextel" style="display:none">
<select name="valorNextel" class="form-control input-lg">
	<option value="">Escolha o Valor...</option>
    <option value="15"><strong>R$ 15,00</strong></option>
    <option value="25"><strong>R$ 25,00</strong></option>
    <option value="35"><strong>R$ 35,00</strong></option>
    <option value="55"><strong>R$ 55,00</strong></option>
    <option value="90"><strong>R$ 90,00</strong></option>
</select><br />
</div>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" onClick="history.back(-1);" style="margin-bottom:5px; width:98%;"><i class="fas fa-reply"></i> Voltar</button></td>
        <td style="width:50%; text-align:left;"><button type="submit" class="w3-input w3-teal btn-lg w3-padding-16" style="margin-bottom:5px;  width:100%;" /><i class="fas fa-check"></i> Avançar</button></td>
        
    </tr>
</table> 


</form>
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