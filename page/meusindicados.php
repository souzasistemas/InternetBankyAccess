<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];


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

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
 $site = $verEmpresa['logo_site'];
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

<div class="w3-container">

<h1 class="w3-xxlarge w3-text-khaki" style="text-shadow:1px 1px 0 #444"><b>MEUS CONTATOS E ABERTURA DE CONTA</b></h1>

<br>
<div class="w3-third">

<div class="w3-container-fluid">

<div class="well" >
    

    <strong>Link para abertura de contas: <br></strong> 
    <div class="w3-small"><a href="https://www.bgmconsultoriaeminvest.com.br/cadastro.php?id=<?Php echo $id; ?>" target="new">https://www.bgmconsultoriaeminvest.com.br/cadastro.php?id=<?Php echo $id; ?></a></div><br>
    <?Php
  function soNumero($str) {
            return preg_replace("/[^0-9]/", "", $str);
        }
        
        $meuCelular = soNumero($ver['afiliado_celular']);
        ?>
        
        <center>
            <a href="whatsapp://send?text=Olá. Tudo Bem? Meu nome é <?Php echo $name; ?> e estou lhe apresentando a BGM MÓBILE! Através do App você poderá ter aplicações com segurança e zelo a todos os nossos clientes. O tempo é Agora! Acesse o link https://www.bgmconsultoriaeminvest.com.br/cadastro.php?id=<?Php echo $id; ?> e faça seu cadastro gratuitamente.">
                <button class="w3-button w3-green w3-round"><i class="fab fa-whatsapp"></i> Compartilhar</button></a>
                <br>
        
        </center>

</div>


<h1 class="w3-large w3-text-gray w3-center">Entre com os dados de acesso para novo cadastro</h1>
<div class="w3-round w3-animate-bottom" style="width:98%; margin:auto; padding-right:10px;">
<div class="alert alert-success w3-small" style="margin-top:10px;text-align:center;">
<strong>INDICAÇÃO </strong><br> <?Php echo $id; ?> - <?Php echo $name; ?><br>
</div>

<form action="cadastro_novo_carregar.php" method="post" name="form">
<input name="id" type="hidden" value="<?Php echo $id; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input type="text" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="w3-input w3-round w3-border w3-padding-16" name="usuario2" placeholder="Digite aqui o Login de Acesso" required autocomplete="off">
<input type="email" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="w3-input w3-round w3-border w3-padding-16" name="email" placeholder="Digite seu E-mail" required autocomplete="off">
<input type="password" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="w3-input w3-round w3-border w3-padding-16" name="senha3" placeholder="Digite uma senha" required autocomplete="off">
<input type="password" style="text-align:center;  margin-top:5px; text-transform:lowercase;" class="w3-input w3-round w3-border w3-padding-16" name="senha4" placeholder="Confirme sua Senha" required autocomplete="off">
<button style="margin-top:5px;" type="submit" class="w3-input w3-round w3-border w3-padding-16 w3-teal"> CADASTRAR</button>
</form>
</div>
</div> 

</div>

<div class="w3-twothird"><iframe src="meusindicados_lista.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" style="width:100%; height:750px;" frameborder="0" scrolling="no"></iframe></div>



</div>




</body>
</html>