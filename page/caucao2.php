<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);

$nome = $id." - ".$ver['afiliado_usuario'];


if($ver['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $ver['afiliado_fantasia'];
}

$sqlAcesso = mysqli_query($conexao, "SELECT * FROM sps_afiliado_logs WHERE acesso_admin_login='$nome' ORDER BY acesso_admin_id DESC LIMIT 1,1");
$verAcesso = mysqli_fetch_array($sqlAcesso);
    $idLogs = $verAcesso['acesso_admin_id'];
    
if($idLogs == ""){
    $echo = "Este é seu primeiro Acesso!";
}else{
    $echo = "Seu Último acesso foi no dia ".$verAcesso['acesso_admin_data']." às ".$verAcesso['acesso_admin_hora']." no IP: ".$verAcesso['acesso_admin_ip']."";
}


$idCorrespondente = $ver['afiliado_indicador'];
$sqlCorrespondente = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idCorrespondente'");
$verCorrespondente = mysqli_fetch_array($sqlCorrespondente);

$sqlAtivos = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_indicador='$id'");
$totalAtivos = mysqli_num_rows($sqlAtivos);

$sqlLojasAtivos = mysqli_query($conexao, "SELECT * FROM sps_estabelecimento WHERE estabelecimento_afiliado_id='$id'");
$lojaAtivos = mysqli_num_rows($sqlLojasAtivos);

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

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Conta <?Php echo $id." - ".$nome; ?></title>
<link rel="icon" href="../img/favicon.png">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  


<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

  

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<body id="principal">


<form action="caucao_confirmar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" method="post">
<BR>
 
    
<b>1. DADOS DO IMÓVEL</b>
<div class="w3-container" style="margin-top:5px; margin-bottom:5px;">

<div class="w3-half" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="nomeImovel" placeholder="Nome do Imóvel" required>
</div>

<div class="w3-half" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="enderecoImovel" placeholder="Endereço do Imóvel" required>
</div>


<div class="w3-quarter" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="valorEntrada" placeholder="Valor da Entrada/Caução" required>
</div>
<div class="w3-quarter" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="valorAluguel" placeholder="Valor do Aluguel" required>
</div>
<div class="w3-quarter" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="valorCondominio" placeholder="Valor do Condomínio" required>
</div>
<div class="w3-quarter" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="valorIptu" placeholder="Valor do IPTU" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="dataInicio" placeholder="Data Início do Contrato" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('DATA',this,event)" maxlength="10" required>
</div>
<div class="w3-third" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="dataFim" placeholder="Data Fim do Contrato" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('DATA',this,event)" maxlength="10" required>
</div>
<div class="w3-third" style="margin-bottom:5px;">
    <input class="w3-input w3-padding w3-border w3-round" type="text" name="periodo" placeholder="Total de Meses do Contrato" required>
</div>

<textarea name="descricaoImovel"  class="w3-input w3-padding w3-border w3-round" placeholder="Descreva aqui as informações do imóvel. Ex: sala, quarto, cozinha, varanda, etc...." required></textarea>

</div>




<b>2. DADOS DO PROPRIETÁRIO</b>
<div class="w3-container" style="margin-top:5px; margin-bottom:5px;">

<div class="w3-half" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="nomeProprietario" placeholder="Nome Completo" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="tel" name="cpfProprietario" placeholder="CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" required>
</div>


<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="rgProprietario" placeholder="RG" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="profissaoProprietario" placeholder="Profissão" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="estadocivilProprietario" placeholder="Estado Civil" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="naturalidadeProprietario" placeholder="Naturalidade" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="nacionalidadeProprietario" placeholder="Nacionalidade" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" maxlength="15" type="tel" autocomplete="off" name="telefoneProprietario" onkeyup="Mascara('TEL',this,event)" placeholder="Telefone Proprietário" maxlength="15" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" maxlength="15" type="tel" autocomplete="off" name="celularProprietario" onkeyup="Mascara('TEL',this,event)" placeholder="Celular Proprietário" maxlength="15" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="email" name="emailProprietario" placeholder="E-mail do Proprietário" required>
</div>

<input class="w3-input w3-padding w3-border w3-round" type="text" name="enderecoProprietario" placeholder="Endereço do Proprietário " required>

</div>


<b>3. DADOS DO LOCATÁRIO</b>
<div class="w3-container" style="margin-top:5px;">

<div class="w3-half" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="nomeLocatario" placeholder="Nome Completo" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="cpfLocatario" placeholder="CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="rgLocatario" placeholder="RG" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="profissaoLocatario" placeholder="Profissão" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="estadocivilLocatario" placeholder="Estado Civil" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="naturalidadeLocatario" placeholder="Naturalidade" required>
</div>

<div class="w3-quarter" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="text" name="nacionalidadeLocatario" placeholder="Nacionalidade" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" maxlength="15" type="tel" autocomplete="off" name="telefoneLocatario" onkeyup="Mascara('TEL',this,event)" placeholder="Telefone Locatario" maxlength="15" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" maxlength="15" type="tel" autocomplete="off" name="celularLocatario" onkeyup="Mascara('TEL',this,event)" placeholder="Celular Locatario" maxlength="15" required>
</div>

<div class="w3-third" style="margin-bottom:5px;">
<input class="w3-input w3-padding w3-border w3-round" type="email" name="emailLocatario" placeholder="E-mail do Locatario" required>
</div>

<input class="w3-input w3-padding w3-border w3-round" type="text" name="enderecoLocatario" placeholder="Endereço do Locatario" required>

</div>


<div class="w3-container" style="margin-top:10px;">
    <div class="w3-half w3-center"><button style="width:99%; margin-bottom:5px;" type="reset" class="w3-input w3-padding-16 w3-round-large w3-orange w3-text-white">LIMPAR FORMULÁRIO</button></div>
    <div class="w3-half w3-left"><button style="width:99%; margin-bottom:5px;" type="submit" class="w3-input w3-padding-16 w3-round-large w3-teal">AVANÇAR</button></div>
    
</div>

<div class="w3-container w3-center"><a href="caucao_pesquisar_contrato.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button style="width:99%; margin-bottom:5px;" type="button" class="w3-input w3-padding-16 w3-round-large w3-blue">PESQUISAR CONTRATOS</button></a></div>
</form>
</div>




</body>
</html>