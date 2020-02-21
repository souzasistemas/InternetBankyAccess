<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<?Php
$afiliado = $_GET['id'];
?>

<form action="alterar_senha_cartao.php" method="post" name="form">
<input name="afiliado" type="hidden" value="<?Php echo $afiliado; ?>" />
<input type="submit" id="botao" name="alterar" style="padding:15px;"  class="btn w3-orange w3-input w3-text-white" value="Alterar PIN" />

</form>
</body>
</html>