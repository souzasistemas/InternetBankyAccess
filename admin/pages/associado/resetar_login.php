<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<?Php
$afiliado = $_GET['id'];
?>

<form action="alterar_login_canal.php" method="post" name="form" style="text-align:right; margin-right:5px;">
<input name="afiliado" type="hidden" value="<?Php echo $afiliado; ?>" />
<input type="submit" class="btn w3-light-blue w3-input w3-text-white" name="alterar" value="Alterar Senha Conta" />
</form>
</body>
</html>