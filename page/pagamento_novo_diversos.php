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

<script>
jQuery(function($){
   $("#1").mask("99999.99999",{placeholder:""});
   $("#2").mask("99999.999999",{placeholder:""});
   $("#3").mask("99999.999999",{placeholder:""});
   $("#4").mask("9",{placeholder:""});
   $("#5").mask("99999999999999",{placeholder:""});
});
</script>

<script>
    function conta(obj){
    chr = obj.value.length;maxchr = obj.getAttribute("maxlength");
    document.getElementById("caracteres").value = chr;	
    if (chr == maxchr){	nextInput = parseInt(obj.id) + 1;	
    document.getElementById(nextInput).focus();	}}
    </script>
    
    
</head>

<body id="principal" class="w3-sand">
<br><br>

<div class="w3-container">

<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px; margin-top:10px; margin-bottom:10px;"><b>Olá <?Php echo $name; ?> </b><br>
<b>Tipo de Pagamento: </b>Cartão de Crédito ou Outros Pagamentos
</div>
<b>1º Passo:</b> Preencha o código de barras com atenção<br>


<form action="pagamento_novo_dados.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" method="POST" name="form">
<input type="hidden" value="3" name="tipo">

<input type="tel" id="1" onkeyup="conta(this)" maxlength="11" class="w3-input" name="linha1" placeholder="1ª Parte do Código" style="text-align:center; font-family:arial;"  />	
<input type="tel" id="2" onkeyup="conta(this)" maxlength="12" class="w3-input" name="linha2" placeholder="2ª Parte do Código" style="text-align:center; font-family:arial;"  />		
<input type="tel" id="3" onkeyup="conta(this)" maxlength="12" class="w3-input" name="linha3" placeholder="3ª Parte do Código" style="text-align:center; font-family:arial;"  />	
<input type="tel" id="4" onkeyup="conta(this)" maxlength="1" class="w3-input" name="linha4" placeholder="4ª Parte do Código" style="text-align:center; font-family:arial;"  />		
<input type="tel" id="5" maxlength="14" class="w3-input" name="linha5" placeholder="5ª Parte do Código" style="text-align:center; font-family:arial;"  />	
<input type="hidden" id="caracteres"  /><br>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button type="button" class="w3-input w3-red btn-lg w3-padding-8" onClick="history.back(-1);" style="margin-bottom:5px; width:98%;"><i class="fas fa-reply"></i> Voltar</button></td>
        <td style="width:50%; text-align:left;"><button type="submit" class="w3-input w3-teal btn-lg w3-padding-8" style="margin-bottom:5px;  width:100%;" /><i class="fas fa-check"></i> Avançar</button></td>
        
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