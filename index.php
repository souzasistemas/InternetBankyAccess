<?Php 
$idSolicitado = $_GET['empresa'];
if($idSolicitado == ""){
	$empresa = "1";
}else{
	$empresa = $idSolicitado;
}
require "config/config.php";
require "config/topo.php";?>







<!---- conteudo da pagina  ---->

<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>

<?Php
if($empresa == "1001"){
?>
<button style="margin-top:5px;" onClick="location.href='cadastro.php?empresa=<?Php echo $empresa; ?>';"type="submit" class="form-control form-control-lg w3-blue w3-text-white"> NÃO TENHO CONTA</button>

<?Php
}else{
?>
<button style="margin-top:5px;" onClick="location.href='cadastro.php?empresa=<?Php echo $empresa; ?>';"type="submit" class="form-control form-control-lg w3-orange w3-text-white"> NÃO TENHO CONTA</button>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>

</div>
</div>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>