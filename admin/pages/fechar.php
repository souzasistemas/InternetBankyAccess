<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Administrativo BGM</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <link rel="icon" href="../img/icone.png">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300&display=swap" rel="stylesheet">


</head>
<body>
    
<?php
session_start();

require "../../config/config.php";

$id = $_GET['id'];

$ip = $_SERVER['REMOTE_ADDR'];
$conexao2 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

date_default_timezone_set('Brazil/East');
$horario = date('H:i:s');
$dataCadastro = date('d/m/Y');

$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_conectado='Não', admin_hora_fechar='' WHERE admin_id='$id'");

if($update == "1"){
    
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);
    $nome = strtoupper($ver['admin_nome']);
    $empresa = $ver['admin_empresa'];

$inserir = mysqli_query($conexao, "INSERT INTO sps_admin_logs(
        acesso_admin_hora, 
        acesso_admin_data, 
        acesso_admin_login, 
        acesso_admin_empresa,
        acesso_admin_ip, 
        acesso_admin_conexao, 
        acesso_admin_mensagem) VALUES (
        '$horario',
        '$dataCadastro',
        '$nome',
        '$empresa',
        '$ip',
        '$conexao2',
        'Usuário saiu da conta')");    

session_unset();
session_destroy();
?>
<br><br>

<meta http-equiv="refresh" content="5; url=../index.htm">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

<?Php

}else{
    echo "Deu Erro!";
    /** echo "<script>history.back(-1);alert('!!!! ERROR !!!! Entrar em contato com o suporte!');</script>"; **/
}

?>
</body>
</html>