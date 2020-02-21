<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>rsrsr</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>



<style type="text/css">
html, body, div{
	font-family: "Ubuntu", sans-serif;
	font-size:14px;
    background-repeat:no-repeat;
}
html, body{
    height:100%;
}
iframe#iframe{
    height:88%;
}

#principal::-webkit-scrollbar-track {
    background-color: #222;
}
#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
#principal::-webkit-scrollbar-thumb {
    background: #555;
}


</style>
</head>

<body id="principal">

<div class="w3-container">

<?Php
require "../config/config.php";
$usuario = strtolower($_POST['usuario2']);
$email = strtolower($_POST['email']);
$senha = $_POST['senha3'];
$senha2 = $_POST['senha4'];
$idCorretor = $_POST['id'];
$loja = $_POST['empresa'];
$pin = "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb";  /**** PIN */
?>
<br><br>
<meta http-equiv="refresh" content="5; url=cadastro_novo_enviar.php?corretor=<?Php echo $idCorretor; ?>&&empresa=<?Php echo $loja; ?>&&senha=<?Php echo $senha; ?>&&senha2=<?Php echo $senha2; ?>&&email=<?Php echo $email; ?>&&usuario=<?Php echo $usuario; ?>">

<center><div class="spinner-border text-success" style="font-size:40px; padding:100px; margin:auto"></div></center>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

</div>

</body>
</html>