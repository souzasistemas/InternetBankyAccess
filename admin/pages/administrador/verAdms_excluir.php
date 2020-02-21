<?Php
session_start();

$id = $_GET['id'];

require "../../../config/config.php";  




?>

<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <title>Administrativo</title>
  
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

  

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      myIframe = $("#iframe1").attr("src","principal.php?id=<?Php echo $id; ?>");
      $(myIframe).load(function() {          
        var myDoc = (myIframe.get(0).contentDocument) ? myIframe.get(0).contentDocument : myIframe.get(0).contentWindow.document;
        myIframe.height(myDoc.body.scrollHeight+0);
      });
    });
  </script>
  
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
<h2 class="w3-xxlarge">Excluir Administrador</h2>


<?Php
$id = $_GET['id'];
$emp = $_GET['emp'];
$operador = $_GET['operador'];
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$operador'");
$ver = mysqli_fetch_array($sql);
?>
  <p>Deseja realmente excluir o Administrador 
  
  <h3><?Php echo strtoupper($ver['admin_nome']); ?></h3></p> 
  
  <a href="verAdms_exclusao.php?id=<?Php echo $id; ?>&&operador=<?php echo $operador; ?>&&emp=<?Php echo $emp;?>"><button type="button" class="btn btn-success">Sim</button></a> | 
  <a href="javascript:history.back(-1);"><button type="button" class="btn btn-danger">Não</button> </a> 
 </center> 
 
 
</div><br>


</body>
</html>
