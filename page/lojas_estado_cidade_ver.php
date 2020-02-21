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
    $link = $ver['afiliado_link'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     


if($status == "Pendente"){
    header ("Location: homePendente.php?id=$id");
}elseif($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Sessão Encerrada');</script>";
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

<body id="principal">
<br><br>


<div class="w3-container">

<?Php
   require "../config/config.php";
  
  $pais = $_POST['pais'];
  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  
  $sqlEstado = mysqli_query($conexao, "SELECT * FROM sps_estado WHERE estado_sigla='$estado'");
  $verEstado = mysqli_fetch_array($sqlEstado);
  
  echo "<strong>Região escolhida</strong><br>";
  echo " ".strtoupper($pais)." - ";
  echo "".strtoupper($verEstado['estado_nome'])." - ";
  echo "".strtoupper($cidade)."<br><br>";
  
  $sqlLojas = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_credenciamento='Sim' AND afiliado_nacao='$pais' AND afiliado_estado='$estado' AND afiliado_cidade='$cidade' AND afiliado_bairro != '' GROUP BY afiliado_bairro");
  while($verLojas = mysqli_fetch_array($sqlLojas)){
    $bairro = $verLojas['afiliado_bairro'];
  
  ?>
  
 <div class="w3-black w3-padding w3-round">
     <?Php echo strtoupper($bairro)."<br>"; ?>
 </div> 
 
 <div class="w3-sand w3-padding w3-round" style="margin-top:5px;">
 <?Php 

$sqlBairro = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_credenciamento='Sim' AND afiliado_nacao='$pais' AND afiliado_estado='$estado' AND afiliado_cidade='$cidade' AND afiliado_bairro='$bairro' ORDER BY afiliado_bairro ASC");
  while($verBairro = mysqli_fetch_array($sqlBairro)){
  ?>
  
  <div class="w3-panel w3-display-container w3-row" style="margin:0; padding:0;">
    
    <div class="w3-third w3-container w3-sand w3-card w3-padding-16" style="height:200px;">
        <div class="w3-container w3-padding-16" style="text-align:center; text-align:center; vertical-align:middle;">
            <?Php
            $idLoja = $verBairro['afiliado_id'];
            $sqlBairro2 = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$idLoja'");
            $verBairro2 = mysqli_fetch_array($sqlBairro2);
            
  	            if($verBairro2['logo_imagem'] == ""){
  		            echo "<img src='https://www.w3schools.com/w3images/avatar2.png' width='100px'/>";
  	            }else{
  		            echo "<img class='w3-round' src='https://www.souzasistemas.com.br/internetbankyaccess/img/logo/".$verBairro2['logo_imagem']."' width='100px'/>";
  	            }
            ?> <br><br>
            <?Php echo $verBairro['afiliado_tipo_negocio']; ?>
        </div>
    </div>
    
    <div class="w3-third w3-container w3-sand w3-card w3-padding-16" style="height:200px; ">
        <div class="w3-container w3-padding-16" style="text-align:center; vertical-align:middle;">
            <strong>Nome: </strong><?Php echo $verBairro['afiliado_fantasia']; ?><br>
            <strong>Código do Estabelecimento: </strong><?Php echo $verBairro['afiliado_id']; ?><br><br>
            <?Php echo $verBairro['afiliado_endereco']; ?><br>
            <?Php echo strtolower($verBairro['afiliado_email']); ?><br>
            <?Php echo strtolower($verBairro['afiliado_site']); ?> <br><br>
        </div>
    </div>
    
    <div class="w3-third w3-container w3-sand w3-card w3-padding-16" style="height:200px;">
        <div class="w3-container w3-padding-16" style=" text-align:center; vertical-align:middle;">
            <b>CASHBACK: </b> <?Php echo number_format($verBairro['afiliado_bonus']*100,2,",","."); ?> %<br><br>
            <div class="w3-col w3-center w3-border w3-dark-gray w3-text-white w3-padding w3-round" style="width:100%; font-size:14px; cursor:pointer;" onClick="location.href='comprar_loja.php?id=<?Php echo $id; ?>&&loja=<?Php echo $verBairro['afiliado_id']; ?>&&empresa=<?Php echo $empresa; ?>'"><i class="fa fa-credit-card w3-text-white" style="font-size:20px; width:25px;"></i> <br> Terminal  PAG PAY</div>
        </div>
    </div>
    
    
  </div>
  
  
  
  

  <?Php
  }
  ?>
 </div>
<?Php
  }
  ?>

<br>
<a href="lojas.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-blue btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Nova Pesquisa</button></a>  
 


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