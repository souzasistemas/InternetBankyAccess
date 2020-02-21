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

<?Php

$id = $_POST['id'];
$token = $_POST['token'];


$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id' AND afiliado_token='$token'");
$ver = mysqli_fetch_array($sql);
    $id = $ver['afiliado_id'];
    $nomeAfiliado = strtoupper($ver['afiliado_nome']);
    $email = $ver['afiliado_email'];
	$usuario = $ver['afiliado_usuario'];
	
	if($nomeAfiliado == ""){
		$nome = $usuario;
	}else{
		$nome = $nomeAfiliado;
	}
    
if($id == ""){
    echo "<script>history.back(-1); alert('Token Inválido!');</script>";
}else{
?>

<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<h1 class="w3-large w3-text-gray">Recuperar Senha de Acesso</h1>
<p>Pronto Sr(a) <b><?Php echo $nome; ?></b>
<b>3º Passo:</b> Cadastre uma nova senha</p>
<b class="w3-text-red">Não Utilizar caracteres especiais (Ex. !@#$%¨&*().... etc)</b><br><br>
<form action="recuperar_senha_enviar.php?empresa=<?Php echo $empresa; ?>" method="post">
<input name="id" type="hidden" value="<?Php echo $id; ?>">
<input type="password" class="form-control form-control-lg" name="password" placeholder="Digite sua nova senha" required style="margin-bottom:10px; text-align:center;">
<button type="submit" name="Submit" class="form-control form-control-lg w3-teal">AVANÇAR</button>
<button style="margin-top:3px;" type="button" onClick="location.href='index.php?empresa=<?Php echo $empresa; ?>'" class="form-control form-control-lg w3-red ">VOLTAR</button>
</form>
<?Php
}
?>            
</div>
</div>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>