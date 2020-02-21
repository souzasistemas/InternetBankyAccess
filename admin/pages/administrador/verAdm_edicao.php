<?Php
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
$id = $_POST['id'];
$operador = $_POST['operador'];
$nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç)/","/(ç)/"),explode(" ","A A E E I I O O U U N N C C"),strtoupper($_POST['nome']));
$login = $_POST['login'];
$loginCrypt = sha1(md5(sha1(base64_encode(md5($login)))));
$senha = $_POST['senha'];
$senhacrypt = sha1(md5(sha1(base64_encode(md5($senha)))));
$loja = $_POST['empresa'];
$status = $_POST['status'];
$permissao = $_POST['permissao'];

if($login == "" && $senha == ""){
	$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_nome='$nome', admin_empresa='$loja', admin_permissao='$permissao', admin_status='$status', admin_conectado='Não' WHERE admin_id='$operador'");
	
	if($update == "1"){
		echo "<h1 class='w3-xxlarge'>Administrador Editado com sucesso!</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}else{
		echo "<h1 class='w3-xxlarge'>Erro ao Editar Administrador! Tente Novamente</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}
	
}elseif($login != "" && $senha == ""){
	
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);

if($login == $ver['admin_login']){
	echo "<script>history.back(-1); alert('Login já cadastrado! Tente novamente!');</script>";
}else{
	$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_nome='$nome', admin_empresa='$loja', admin_login='$loginCrypt', admin_permissao='$permissao', admin_status='$status', admin_conectado='Não' WHERE admin_id='$operador'");
	
	if($update == "1"){
		echo "<h1 class='w3-xxlarge'>Administrador Editado com sucesso!</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}else{
		echo "<h1 class='w3-xxlarge'>Erro ao Editar Administrador! Tente Novamente</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}
}


}elseif($login == "" && $senha != ""){
	$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_nome='$nome', admin_empresa='$loja', admin_senha='$senhacrypt', admin_permissao='$permissao', admin_status='$status', admin_conectado='Não' WHERE admin_id='$operador'");
	
	if($update == "1"){
		echo "<h1 class='w3-xxlarge'>Administrador Editado com sucesso!</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}else{
		echo "<h1 class='w3-xxlarge'>Erro ao Editar Administrador! Tente Novamente</h1>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}
}elseif($login != "" && $senha != ""){
	
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);

if($login == $ver['admin_login']){
	echo "<script>history.back(-1); alert('Login já cadastrado! Tente novamente!');</script>";
}else{

	$update = mysqli_query($conexao, "UPDATE sps_admin SET admin_nome='$nome', admin_empresa='$loja', admin_login='$loginCrypt', admin_senha='$senhacrypt', admin_permissao='$permissao', admin_status='$status' , admin_conectado='Não' WHERE admin_id='$operador'");
	
	if($update == "1"){
		echo "<h1 class='w3-xxlarge'>Administrador Editado com sucesso!</h1><br>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}else{
		echo "<h1 class='w3-xxlarge'>Erro ao Editar Administrador! Tente Novamente</h1><br>";
		echo "<a href='verAdm.php?id=".$id."'><button type='button' class='btn btn-info btn-lg'>Ver Administradores</button></a>";
	}
}
}
?>

 </center> 
 
 
</div><br>


</body>
</html>