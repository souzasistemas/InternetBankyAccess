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

<?Php
$id = $_POST['id'];
$senha = $_POST['password'];
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
	$login = $ver['afiliado_usuario'];
	$nomeAfiliado = strtoupper($ver['afiliado_nome']);
    $email = $ver['afiliado_email'];
	
	if($nomeAfiliado== ""){
		$nome = $login;
	}else{
		$nome = $nomeAfiliado;
	}


$inserir = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_senha='$senhaCrypt', afiliado_token='' WHERE afiliado_id='$id'");

if($inserir == "1"){
?>

<div class="alert alert-success w3-small" style="margin-top:10px;text-align:center;">
<strong>MEUS PARABÉNS Sr(a) <b><?Php echo $nome; ?>!<br> SUA SENHA FOI ALTERADA COM SUCESSO! </strong>
</div>
            
<button type="button" onClick="location.href='verifica.php?login=<?Php echo $login; ?>&&secreto=<?Php echo $senha; ?>&&empresa=<?Php echo $empresa; ?>'" class="form-control form-control-lg w3-teal w3-text-white">Acessar Conta</button>

<?Php
}else{
    echo "<script>location.href='recuperar.php?empresa=".$empresa."'; alert('Não foi possível realizar a alteração!');</script>";
}
?>  
</div>
</div>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>