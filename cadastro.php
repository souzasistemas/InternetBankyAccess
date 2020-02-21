<?Php 
$idSolicitado = $_GET['empresa'];
$idCorretor = $_GET['id'];
$idPlano = $_GET['plano'];

if($idSolicitado == ""){
	$empresa = "1";
}else{
	$empresa = $idSolicitado;
}
if($idCorretor == ""){
	$id = $empresa;
}else{
	$id = $idCorretor;
}

if($idPlano == ""){
	$plano = "1";
}else{
	$plano = $idPlano;
}

require "config/config.php";
require "config/topo.php";?>







<!---- conteudo da pagina  ---->

<?Php
$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id' AND afiliado_empresa='$empresa' AND afiliado_status='Ativo' AND afiliado_link='Sim'");
$ver = mysqli_fetch_array($sql);
    $idAfiliado = $ver['afiliado_id'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
} 



?>


<?Php
if($idAfiliado == ""){
?>
<div class="w3-container w3-padding">
<center><div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert alert-danger w3-small" style="margin-top:10px;text-align:center;">
<strong>CONTA NÃO AUTORIZADA A RECEBER CADASTRO</strong><br>
</div>
            
<h1 class="w3-large w3-text-gray">Entre com os dados de acesso</h1>
<form action="cadastro_carregar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&plano=<?Php echo $plano; ?>" method="post" name="form">
<input id="email" type="text" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="usuario" placeholder="Cadastre um login para acesso" required autocomplete="off">
<input id="email" type="email" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="email" placeholder="Cadastre seu E-mail" required autocomplete="off">
<input id="password" type="password" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="senha" placeholder="Cadastre uma senha" required autocomplete="off">
<input id="password" type="password" style="text-align:center;  margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="senha2" placeholder="Confirme sua Senha" required autocomplete="off">
<button style="margin-top:5px;" type="submit" class="form-control form-control-lg w3-teal"> CADASTRAR</button>
<button style="margin-top:3px;" onClick="location.href='index.php?empresa=<?Php echo $empresa; ?>';" type="button" class="form-control form-control-lg w3-red"> CANCELAR</button>
</form>
</div></center>
</div> 


<?Php
}else{
?>

<div class="w3-container w3-padding">
<center><div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert alert-success w3-small" style="margin-top:10px;text-align:center;">
<strong>INDICAÇÃO </strong><br> <?Php echo $idAfiliado; ?> - <?Php echo $name; ?><br>
</div>
<h1 class="w3-large w3-text-gray">Entre com os dados de acesso</h1>
<form action="cadastro_carregar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&plano=<?Php echo $plano; ?>" method="post" name="form">
<input id="email" type="text" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="usuario" placeholder="Cadastre um login para acesso" required autocomplete="off">
<input id="email" type="email" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="email" placeholder="Cadastre seu E-mail" required autocomplete="off">
<input id="password" type="password" style="text-align:center; margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="senha" placeholder="Cadastre uma senha" required autocomplete="off">
<input id="password" type="password" style="text-align:center;  margin-top:5px; text-transform:lowercase;" class="form-control form-control-lg" name="senha2" placeholder="Confirme sua Senha" required autocomplete="off">
<button style="margin-top:5px;" type="submit" class="form-control form-control-lg w3-teal"> CADASTRAR</button>
<button style="margin-top:3px;" onClick="location.href='index.php?empresa=<?Php echo $empresa; ?>';" type="button" class="form-control form-control-lg w3-red"> CANCELAR</button>
</form>
</div></center>
</div>    


<?Php
}
?>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>