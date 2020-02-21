<?Php require "../../../config/config.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	
  	<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<SCRIPT LANGUAGE="JavaScript">   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   
</script>  
  

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
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);
	$loja = $ver['admin_empresa'];
	$permissao = $ver['admin_permissao'];
?>

<div class="col-sm-6">
<h2 class="w3-xlarge"><b>Cadastrar Administrador</b></h2> 

<form class="form-horizontal" action="novoAdm_cadastrar.php" method="post" name="form">
    
    <input type="hidden" name="id" value="<?Php echo $id; ?>">
    <input type="hidden" name="emp" value="<?Php echo $loja; ?>">
    <input type="hidden" name="permitir" value="<?Php echo $permissao; ?>">
    <input class="form-control w3-input input-lg w3-border" id="focusedInput" type="text" name="nome" autocomplete="off" style="text-transform:uppercase; margin-bottom:2px;" placeholder="Nome Administrador" value="" required>
    <input type="login" name="login" id="login_fake" class="hidden" autocomplete="off" style="display: none;">
    <input class="form-control w3-input input-lg w3-border" id="focusedInput" type="text" name="login" autocomplete="off" placeholder="Login" style="text-transform:lowercase; margin-bottom:2px;" required>
    <input type="password" name="password" id="password_fake" class="hidden" autocomplete="off" style="display: none;">
    <input class="form-control w3-input input-lg w3-border" id="focusedInput" type="password" name="senha" autocomplete="off" placeholder="Senha" style="text-transform:lowercase; margin-bottom:2px;" required>
    
    <select class="form-control  w3-input input-lg w3-border" id="focusedInput" name="permissao" style="text-transform:uppercase; margin-bottom:2px;" required>
        <option value="">Nível de Permissão...</option>
        <option value=""></option>
        <option value="0">Acesso Geral</option>
        <option value="1">Administrativo</option>
        <option value="2">Financeiro</option>
    </select>
    
    
    <select class="form-control w3-input input-lg w3-border" id="focusedInput" name="status" style="text-transform:uppercase; margin-bottom:5px;" required>
        <option value="">Status...</option>
        <option value=""></option>
        <option value="Ativo">Ativo</option>
        <option value="Bloqueado">Bloqueado</option>
      </select>
     
    
    
   
    <input type="hidden" name="empresa" value="<?Php echo $loja; ?>">
  
   
    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Cadastrar</button>
    <button type="reset" class="btn btn-danger btn-lg"><i class="fa fa-close"></i> Limpar</button>
  
    
    
  </form>
</div>
</div>


<br>



</body>
</html>