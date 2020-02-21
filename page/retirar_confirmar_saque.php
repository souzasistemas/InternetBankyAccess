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
$favorecido = $_GET['favorecido'];
$limite = $_GET['limite'];
$limite2 = $_GET['limite2'];
$quantidade= $_GET['quantidade'];
$tarifa = $_GET['tarifa'];
$modalidade = "1";

if($quantidade == "1"){
    $nomeQuantidade = "1 Solicitação";
}elseif($quantidade == "2"){
    $nomeQuantidade = "2 Solicitações";
}elseif($quantidade == "3"){
    $nomeQuantidade = "3 Solicitações";
}

if($modalidade == "1"){
    $nomeModalidade = "DOC/TED";
}elseif($modalidade == "2"){
    $nomeModalidade = "CARTÃO ZENCARD";
}
?>
<div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px;">
Olá, <strong><?Php echo $name; ?></strong><br>
Vamos seguir o passo a passo para solicitar a sua retirada.<br>
Quantidade disponível dia: <strong> <?Php echo $nomeQuantidade ?> </strong>
</div><br>

<form action="retirar_confirmar_saque_dados.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" name="form" method="post">
   
  <input name="valorMaximoDia" type="hidden" value="<?Php echo $limite; ?>">
  <input name="quantidade" type="hidden" value="<?Php echo $quantidade; ?>">
  <input name="tarifa" type="hidden" value="<?Php echo $tarifa; ?>">
  <input name="modalidade" type="hidden" value="<?Php echo $modalidade; ?>">
  
  
  <input name="valor" class="w3-input w3-border w3-round w3-padding-8" size="30" type="number" step="0.010" placeholder="0,00" autocomplete="off" style="font-size:30px; text-align:center;margin-bottom:5px;" required>
 <br>
 
 
 
 
 
 <?Php
 if($ver['afiliado_nacao'] == "BRASIL"){
 ?>
 
 <center><a href="retirar_buscar_favorecido.php?id=<?Php echo $id; ?>&&limite=<?Php echo $limite; ?>&&limite2=<?Php echo '5000'; ?>&&quantidade=<?Php echo $quantidade; ?>&&tarifa=<?Php echo $tarifa; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-blue w3-round w3-padding"><i class="fas fa-users"></i> Buscar Favorecido</a></center>
 <br>
 <center><b>Dados Bancários</b></center>
 
 
 
 <?Php
 if($favorecido == "0"){
 ?>
 
 
 <select name="banco" class="w3-input w3-border w3-round w3-padding-8" require style="margin-bottom:5px;">
     <option value="">Selecione o banco</option>
     <option value="55">1 - BANCO DO BRASIL S.A</option>
     <option value="142">104 - CAIXA ECONÔMICA FEDERAL</option>
     <option value="22">237 - BANCO BRADESCO S.A</option>
     <option value="160">341 - BANCO ITAU UNIBANCO S.A</option>
     <option value="116">33 - BANCO SANTANDER (BRASIL) S.A</option>
     <option value="77">077-9 - BANCO INTER S.A</option>
     <option value="88">212 - BANCO ORIGINAL</option>
     <option value=""></option>
     <?Php
     $sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos ORDER BY banco_codigo ASC");
     while($verBanco = mysqli_fetch_array($sqlBanco)){
     ?>
        <option value="<?Php echo $verBanco['banco_id']; ?>"><?Php echo $verBanco['banco_codigo']; ?> - <?Php echo strtoupper($verBanco['banco_nome']); ?></option>
     <?Php
}
?>
 </select> 
 
 <input name="agencia" class="w3-input w3-border w3-round w3-padding-8" require type="tel" placeholder="Agência" maxlength="4" style="margin-bottom:5px;">
 <input name="conta" class="w3-input w3-border w3-round w3-padding-8" require type="tel" placeholder="Conta com dígito"  style="margin-bottom:5px;">
 <input name="favorecido" class="w3-input w3-border w3-round w3-padding-8" require type="text" placeholder="Nome do Favorecido" style="margin-bottom:5px;">
 <input name="documento" class="w3-input w3-border w3-round w3-padding-8" require type="tel" placeholder="CPF/CNPJ do Favorecido" maxlength="14" style="margin-bottom:5px;">
 
 <select name="servico" class="w3-input w3-border w3-round w3-padding-8" require style="margin-bottom:5px;">
     <option value="Crédito em Conta">Crédito em Conta</option>
     <option value="Pagamento de Dividendos">Pagamento de Dividendos</option>
     <option value="Pagamento de Salários">Pagamento de Salários</option>
 </select>
 
 <select name="tipo" class="w3-input w3-border w3-round w3-padding-8" require style="margin-bottom:5px;">
     <option value="Conta Corrente">Conta Corrente</option>
     <option value="Conta Poupança">Conta Poupança</option>
 </select>
 
 <textarea class="w3-input w3-border w3-round w3-padding-8" name="descricao" style="margin-bottom:5px;"placeholder="Descrição (opcional)" rows="2"></textarea>
 
 <input type="checkbox" value="Salvar" name="salvar_favorecido" checked> Salvar Conta  <br><br>
 
 
 <?Php
 }else{

$sqlFavorecido = mysqli_query($conexao, "SELECT * FROM sps_banco_favorecido WHERE favorecido_id='$favorecido'");
$verFavorecido = mysqli_fetch_array($sqlFavorecido);
    $idBanco = $verFavorecido['favorecido_banco'];
    
$sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$idBanco'");
$verBanco = mysqli_fetch_array($sqlBanco);
 ?>
 
 <input name="banco" value="<?Php echo $idBanco; ?>" class="w3-input w3-border w3-round w3-padding-8" require type="hidden" style="margin-bottom:5px;" readonly>
 <input name="banco2" value="<?Php echo $verBanco['banco_codigo']; ?> - <?Php echo strtoupper($verBanco['banco_nome']); ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="" style="margin-bottom:5px;" readonly>
 
 
 
 <input name="agencia" value="<?Php echo $verFavorecido['favorecido_agencia']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="Agência" maxlength="4" style="margin-bottom:5px;" readonly>
 <input name="conta" value="<?Php echo $verFavorecido['favorecido_conta']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="Conta com dígito"  style="margin-bottom:5px;" readonly>
 <input name="favorecido" value="<?Php echo $verFavorecido['favorecido_nome']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="text" placeholder="Nome do Favorecido" style="margin-bottom:5px;" readonly>
 <input name="documento" value="<?Php echo $verFavorecido['favorecido_documento']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="CPF/CNPJ do Favorecido" maxlength="14" style="margin-bottom:5px;" readonly>
 
 <input name="servico" value="<?Php echo $verFavorecido['favorecido_servicos']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="CPF/CNPJ do Favorecido" maxlength="14" style="margin-bottom:5px;" readonly>
 <input name="tipo" value="<?Php echo $verFavorecido['favorecido_tipo']; ?>" class="w3-input w3-border w3-round w3-padding-8 w3-light-gray" require type="tel" placeholder="CPF/CNPJ do Favorecido" maxlength="14" style="margin-bottom:5px;" readonly>
 
 
 <textarea class="w3-input w3-border w3-round w3-padding-8" name="descricao" style="margin-bottom:5px;"placeholder="Descrição (opcional)" rows="2"></textarea>
 
 <input type="hidden" value="Não Salvar" name="salvar_favorecido" checked> <br><br>
 
 
 <?Php
 }
 ?>
 
 
 
 
 <?Php
 }else{
 ?>
 <?Php    
 }
 ?>
 
 
 
 <table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="retirada.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="margin-bottom:5px; width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button type="submit" class="w3-input w3-teal btn-lg w3-padding-16" style="margin-bottom:5px;  width:100%;" /><i class="fas fa-check"></i> Avançar</button></td>
        
    </tr>
</table>


</form>
<br><br>
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