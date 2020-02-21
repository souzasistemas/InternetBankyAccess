<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Administrativo Banco BM</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <link rel="icon" href="../img/icon.png">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300&display=swap" rel="stylesheet">
    
    <script language="JavaScript">
        function protegercodigo() {
            if (event.button==2||event.button==3){
            alert('Desculpe! Acesso não Autorizado!');}
        }
        document.onmousedown=protegercodigo
    </script>




</head>
<body>
<?Php
require "../config/config.php";

$usuario = strtolower($_POST['login']);
$senha = $_POST['password'];


if($usuario == "" && $senha == ""){
    echo "<script>location.href='index.htm'; alert('Os campos USUÁRIO e SENHA são obrigatórios!');</script>";
}elseif($usuario == "" && $senha != ""){
     echo "<script>location.href='index.htm'; alert('Os campo USUÁRIO é obrigatório!');</script>";
}elseif($usuario != "" && $senha == ""){
     echo "<script>location.href='index.htm'; alert('Os campo SENHA é obrigatório!');</script>";
}else{
    
$userCrypt = sha1(md5(sha1(base64_encode(md5($usuario)))));
$passCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));


$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_login='$userCrypt' AND admin_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);
	$senhaAdmin = $ver['admin_senha'];
	$nomeAdmin = $ver['admin_nome'];
	$conexao2 = $ver['admin_conectado'];
	$loginAdmin = $ver['admin_login'];
	$status = $ver['admin_status'];
	$id = $ver['admin_id'];

if($loginAdmin == ""){
    echo "<script>location.href='index.htm'; alert('Usuário incorreto ou não cadastrado!');</script>";
}elseif($senhaAdmin != $passCrypt){
    echo "<script>location.href='index.htm'; alert('Senha Incorreta!');</script>";
}elseif($status != "Ativo"){
    echo "<script>location.href='index.htm'; alert('Desculpe! Usuário com acesso bloqueado ou suspenso');</script>";
}else{

date_default_timezone_set('Brazil/East');
$data = date('d/m/Y');
$hora = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$horaSair = date('H:i:s', strtotime('+30 minute', strtotime($hora)));

$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_conectado='Sim', admin_hora_fechar='$horaSair' WHERE admin_id='$id'");


if($update == "1"){

$inserir = mysqli_query($conexao, "INSERT INTO sps_admin_logs(acesso_admin_hora, acesso_admin_data, acesso_admin_login, acesso_admin_empresa, acesso_admin_ip, acesso_admin_conexao, acesso_admin_mensagem) VALUES ('$hora', '$data', '$nomeAdmin', '$empresa', '$ip', '$host', 'Acesso bem sucedido')");

$idEntrar = base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($id))))))))));
?>
<br><br>

<meta http-equiv="refresh" content="5; url=pages/home.php?id=<?Php echo $idEntrar; ?>">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

<?Php
}else{
	echo "<script>location.href='index.htm'; alert('Erro ao se conectar! Tente novamente');</script>";
}
    
}
}
?>


</body>
</html>