<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<style type="text/css">
*{
	margin:0;
	padding:0;
}
#botao {
	padding:5px;
}

</style>
</head>

<body>

<?Php
require "../../../config/config.php";
$afiliado = $_POST['afiliado'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$afiliado'");
$ver = mysqli_fetch_array($sql);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $documento = $ver['afiliado_cpf'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $documento = $ver['afiliado_cnpj'];
}
    
if($documento == ""){
    echo "<script>location.href='resetar_login.php?id=".$afiliado."';alert('Usuário não possui CPF/CNPJ cadastrado! Tente Novamente!');</script>";
}else{
function makeRandomCartao1(){
	$salt = "0123456789012345678901234501234567890123456789012345";
	srand((double)microtime()*1000000);
	$i = 0;
	
	while($i <= 1){
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$cartao1 = makeRandomCartao1();


function makeRandomCartao2(){
	$salt = "0123456789012345678901234501234567890123456789012345";
	srand((double)microtime()*1000000);
	$i = 0;
	
	while($i <= 3){
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$cartao2 = makeRandomCartao2();

function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

$login = soNumero($documento);  /*** login gerado */

$loginCrypt = sha1(md5(sha1(base64_encode(md5($login)))));

date_default_timezone_set('Brazil/East');
$ano = date('Y');

$senha = "$afiliado$ano";
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));


$alterar = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_senha='$senhaCrypt' WHERE afiliado_id='$afiliado'");

if($alterar == "1"){
	echo "<script>location.href='resetar_login.php?id=".$afiliado."';alert('Login e Senha alterados com sucesso! Nova Senha: ".$senha."');</script>";
}else{
	echo "<script>location.href='resetar_login.php?id=".$afiliado."';alert('Não foi possível realizar a solicitação! Tente Novamente!');</script>";
}
}


?>

</body>
</html>