<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<?Php
require_once '../../../config/config.php';
$afiliado = $_POST['afiliado'];
$senha = "5628";
$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));

$alterar = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_pin='$senhaCrypt' WHERE afiliado_id='$afiliado'");

if($alterar == "1"){
	echo "<script>location.href='resetar_senha_cartao.php?id=".$afiliado."';alert('PIN alterado com sucesso!');</script>";
}else{
	echo "<script>location.href='resetar_senha_cartao.php?id=".$afiliado."';alert('Não foi possível alterar o PIN! Tente Novamente!');</script>";
}


?>

</body>
</html>