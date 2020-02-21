<meta HTTP-EQUIV='refresh' CONTENT='1'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?Php
require "../config/config.php";

$id = $_GET['id']; /** conta restrita */
$empresa = $_GET['empresa']; /** empresa parceira */

/***** saldo disponível */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;


/***** saldo parcial */
$sql_credito2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$ver_credito2 = mysqli_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysqli_query($conexao, "SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysqli_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;

/**** patrocinio inteligente */
$sqlPatrocinioPendente = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$verPatrocinioPendente = mysqli_fetch_array($sqlPatrocinioPendente);
	$valorPatrocinioPendente = $verPatrocinioPendente['sum(pi_afiliado_id_valor)'];
	
$sqlPatrocinioPago = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pago'");
$verPatrocinioPago = mysqli_fetch_array($sqlPatrocinioPago);
	$valorPatrocinioPago = $verPatrocinioPago['sum(pi_afiliado_id_valor)'];
	
$saldoPatrocinio = $valorPatrocinioPendente - $valorPatrocinioPago;


$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $saldoPatrocinio;

if($saldoGeral == "0.00"){
	echo "<div style='text-align:right;' class='w3-container-fluid w3-sand w3-text-black'><b>".number_format($saldoGeral,2,",",".")."</b></div>";
}elseif($saldoGeral < "0.00"){
	echo "<div style='text-align:right;'  class='w3-container-fluid w3-sand w3-text-red'><b>".number_format($saldoGeral,2,",",".")."</b></div>";
}elseif($saldoGeral > "0.00"){
	echo "<div style='text-align:right;'  class='w3-container-fluid w3-sand w3-text-green'><b>".number_format($saldoGeral,2,",",".")."</b></div>";
}
?>