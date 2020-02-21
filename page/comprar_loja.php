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
</head>

<body id="principal" >
<br><br>


<div class="w3-container">

<?Php
$codigoLoja = $_POST['loja'];

if($codigoLoja == ""){
    $loja = $_GET['loja'];
}else{
    $loja = $codigoLoja;
}


$sqlLoja = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$loja' AND afiliado_credenciamento='Sim'");
$verLoja = mysqli_fetch_array($sqlLoja);
    $idLoja = $verLoja['afiliado_id'];
    
$sqlLoja2 = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$loja'");
$verLoja2 = mysqli_fetch_array($sqlLoja2);
    
if($idLoja != $loja){
?>

<h1 class="w3-large w3-center">Desculpe! Estabelecimento não localizado</h1><br>
  
  <a href="comprar2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a>
  
<?Php
}else{
?>

<table style="width:90%" style="text-align:center;">
      <tr>
          <td style="vertical-align:middle; width:100px;"><?Php
  	            if($verLoja2['logo_imagem'] == ""){
  		            echo "<img src='https://www.w3schools.com/w3images/avatar4.png' width='90px'/>";
  	            }else{
  		            echo "<img class='w3-round' src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo/".$verLoja2['logo_imagem']."' width='90px'/>";
  	            }
            ?></td>
          <td>
              <?Php echo $verLoja['afiliado_tipo_negocio']; ?><br>
              <?Php echo $verLoja['afiliado_fantasia']; ?><br>
              <strong>Código: </strong><?Php echo $verLoja['afiliado_id']; ?><br>
            <b>CASHBACK: </b><?Php echo number_format($verLoja['afiliado_bonus']*100,2,",","."); ?> %
              
              </td>
      </tr>
  </table>
  
  <div class="w3-container-fluid w3-round" style="margin:20px 0 0 0;">
  
  <form action="comprar_efetuar_debito.php?id=<?Php echo $id; ?>" method="post" name="form1" >
    <input type="hidden" name="loja" value="<?Php echo $loja; ?>" />
    <input type="hidden" name="empresa" value="<?Php echo $empresa; ?>" />
    <input type="hidden" name="corretor" value="<?Php echo $ver['afiliado_indicador']; ?>" />
    
    <input name="valor" class="w3-input w3-border w3-round w3-padding-8" size="30" type="number" step="0.010" placeholder="Valor da Compra" autocomplete="off" style="font-size:24px; text-align:center;margin-bottom:5px;" required>
    
    <input name="senha" placeholder="Digite seu PIN" autocomplete="off"  type="password" class="w3-input w3-border w3-round w3-padding-8" id="numero" maxlength="4" style="font-size:24px; text-align:center;margin-bottom:5px;" required="required" />
    <textarea placeholder="Descrição da compra" name="descricao" class="w3-input w3-border w3-round w3-padding-8" style="font-size:24px; text-align:center;margin-bottom:5px;"></textarea>
   </div>
   
    <table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="comprar2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button button name="submit" type="submit" class="btn-lg w3-teal w3-input w3-padding-16" style="border:none; width:100%;"><i class="fas fa-pencil-alt"></i> AVANÇAR</button></td>
    </tr>
</table>
</form>

<?Php
}
?>



 
</div>


</body>
</html>

<?Php
}
?>