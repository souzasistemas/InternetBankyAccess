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
<h1 class="w3-large w3-text-gray">Recuperar Senha de Acesso</h1>
<p><b>1º Passo:</b> Digite sua conta e seu Login de Acesso</p>
<form action="recuperar_senha_token.php?empresa=<?Php echo $empresa; ?>" method="post">
<input type="text" class="form-control form-control-lg" placeholder="Conta sem o dígito" required name="conta" style="margin-bottom:10px; text-align:center;">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" required name="usuario" style="margin-bottom:10px; text-align:center;">
<button type="submit" name="Submit" class="form-control form-control-lg w3-teal">AVANÇAR</button>
<button style="margin-top:3px;" type="button" onClick="location.href='index.php?empresa=<?Php echo $empresa; ?>'" class="form-control form-control-lg w3-red ">VOLTAR</button>
</form>
</div>
</div>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>