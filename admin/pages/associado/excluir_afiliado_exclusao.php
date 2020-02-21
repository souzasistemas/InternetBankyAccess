<?Php require "../../../config/config.php";  ?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo Souza Sistemas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  
  <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed" rel="stylesheet">
  
    <link rel="icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="shortcut icon" href="../img/favicon.png" sizes="32x32" type="image/png">
  	<link rel="license" href="https://www.souzasistemas.com.br/">
  	<link rel="author" href="https://www.souzasistemas.com.br/">
  	
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	
  
<style type="text/css">

.container {
    padding:10px 0;
}

body#principal::-webkit-scrollbar-track {
    background-color: #222;
}
body#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
body#principal::-webkit-scrollbar-thumb {
    background: #555;
}

  </style>

 
</head>
<body id="principal">

<div class="container" style="padding:200px 0;">

<center>

<?Php
$id2 = $_GET['id'];
$adm = $_GET['adm'];

$deletar = mysqli_query($conexao, "DELETE FROM sps_afiliados WHERE afiliado_id='$id2'");

if($deletar == "1"){
	echo "<h1 class='w3-xlarge'>Associado Excluído com sucesso</h1>";
	echo "<a href='verAssociado_cliente.php?id=".$adm."'><button type='button' class='btn btn-info btn-lg'>Ver Associados</button></a>";
}else{
	echo "<h1 class='w3-xlarge'>Não foi possível realizar a exclusão! Tente novamente!</h1>";
	echo "<a href='verAssociado_cliente.php?id=".$adm."'><button type='button' class='btn btn-info btn-lg'>Ver Associados</button></a>";
}
?>

</body>
</html>
