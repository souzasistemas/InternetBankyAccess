<?Php require "../../../config/config.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
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


<div class='w3-container-fluid' style="padding-left:10px;">

<?Php
$id = $_GET['id'];
$empresa = $_GET['emp'];
$operador = $_GET['operador'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$operador'");
$ver = mysqli_fetch_array($sql);
	

?>

<div class="col-sm-6">
<h2 class="w3-xlarge"><b>Editar Administrador</b></h2> 


<form class="form-horizontal" action="verAdm_edicao.php" method="post" name="form">

<input type="hidden" name="id" value="<?Php echo $id; ?>">
<input type="hidden" name="empresa" value="<?Php echo $empresa; ?>">
<input type="hidden" name="operador" value="<?Php echo $operador; ?>">
<input class="form-control  w3-input input-lg w3-border" id="focusedInput" type="text" placeholder="Nome Completo" name="nome" autocomplete="off" style="text-transform:uppercase; margin-bottom:2px;" value="<?Php echo strtoupper($ver['admin_nome']); ?>">
<input type="login" name="login" id="login_fake" class="hidden" autocomplete="off" style="display: none;">
<input class="form-control  w3-input input-lg w3-border" id="focusedInput" type="text" placeholder="Login" style="text-transform:lowercase; margin-bottom:2px;" name="login" autocomplete="off">
<input type="password" name="password" id="password_fake" class="hidden" autocomplete="off" style="display: none;">
<input class="form-control  w3-input input-lg w3-border" id="focusedInput" type="password" placeholder="Senha" style="text-transform:lowercase; margin-bottom:2px;" name="senha" autocomplete="off">
<select class="form-control  w3-input input-lg w3-border" id="focusedInput" name="permissao" style="text-transform:uppercase; margin-bottom:2px;">
      	<option value="<?Php echo $ver['admin_permissao']; ?>">
		<?Php 
		$idPermissao = $ver['admin_permissao'];
		if($idPermissao == "0"){
			echo "Acesso Geral";
		}elseif($idPermissao == "1"){
			echo "Administrativo";
		}elseif($idPermissao == "2"){
			echo "Financeiro";
		}
		?>
        </option>
        <option value=""></option>
        <option value="0">Acesso Geral</option>
        <option value="1">Administrativo</option>
        <option value="2">Financeiro</option>
</select>
<select class="form-control  w3-input input-lg w3-border" id="focusedInput" name="status" style="text-transform:uppercase; margin-bottom:5px;">
      	<option value="<?Php echo $ver['admin_status']; ?>"><?Php echo $ver['admin_status']; ?></option>
        <option value=""></option>
        <option value="Ativo">Ativo</option>
        <option value="Bloqueado">Bloqueado</option>
      </select>
<?Php
            $idEmpresa = $ver['admin_empresa'];
            $sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idEmpresa'");
            $verEmpresa = mysqli_fetch_array($sqlEmpresa);
                
                if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
	                $nomeLoja1 = $verEmpresa['afiliado_nome'];
	            }elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
	                $nomeLoja1= $verEmpresa['afiliado_razao'];
	            }
	  ?>
<input type="hidden" name="empresa" value="<?Php echo $empresa; ?>">
     
    <button type="submit" class="btn btn-success btn-lg">Editar Administrador</button>
    
   
    
  </form>
  
</div>
 
 
 
</div><br>



</body>
</html>