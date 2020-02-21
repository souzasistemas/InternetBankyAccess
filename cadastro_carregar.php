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
$usuario = strtolower($_POST['usuario']);
$email = strtolower($_POST['email']);
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$pin = "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb";  /**** PIN */
?>


<br><br>
<meta http-equiv="refresh" content="5; url=cadastro_enviar.php?corretor=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&senha=<?Php echo $senha; ?>&&senha2=<?Php echo $senha2; ?>&&email=<?Php echo $email; ?>&&usuario=<?Php echo $usuario; ?>&&plano=<?Php echo $plano; ?>">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>


<!--- fim conteudo da pagina  ---->



<?Php require "config/rodape.php";?>