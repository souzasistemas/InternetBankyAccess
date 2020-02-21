<?Php
session_start();

$id = $_GET['id'];


require "../../../config/config.php";    




?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo</title>
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


<?Php
$id = $_GET['id'];
$emp = $_GET['emp'];
$operador = $_GET['operador'];

$deletar = mysqli_query($conexao, "DELETE FROM sps_admin WHERE admin_id='$operador'");

if($deletar == "1"){
	echo "<h2 class='w3-xxlarge'>Administrador Excluído com sucesso</h2>";
	echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info'>Ver Administradores</button></a>";
}else{
	echo "<h2 class='w3-xxlarge'>Não foi possível realizar a exclusão! Tente novamente!</h2><h1></h1>";
	echo "<a href='verAdm.php?id=".$id."; ?>'><button type='button' class='btn btn-info'>Ver Administradores</button></a>";
}
?>

 </center> 
 
 
</div><br>

</body>
</html>
