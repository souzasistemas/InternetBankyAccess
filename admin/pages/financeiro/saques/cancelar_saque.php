<?Php require "../../../../config/config.php";    ?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo Acessomundi</title>
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
  

<style type="text/css">

.container {
    padding:10px 0;
}

body#principal{
    background-color:#F4F4F4;
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
<h2 class="w3-jumbo">Excluir Solicitação de Saque</h2>


<?Php
$codigo = $_GET['codigo'];
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM sps_retiradas WHERE retirada_id='$codigo'");
$ver = mysql_fetch_array($sql);

$idPag = $ver['retirada_afiliado_id'];
$sql2= mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idPag'");
$ver2 = mysql_fetch_array($sql2);

if($ver2['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver2['afiliado_nome']);
}elseif($ver2['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver2['afiliado_razao']);
}
?>
  <p>Deseja realmente extornar a solicitação de DOC/TED da conta
  
  <h3><?Php echo $idPag; ?>-<?Php echo $ver2['afiliado_codigo']; ?> / <?Php echo $nome; ?> no valor de <?php echo number_format($ver['retirada_valor'],2,",",".");?></h3></p> 
  
  <a href="cancelar_saque_exclusao.php?id=<?Php echo $id; ?>&&codigo=<?Php echo $codigo; ?>"><button type="button" class="btn btn-success btn-lg">Sim</button></a> | 
  <a href="saques.php?id=<?Php echo $id; ?>"><button type="button" class="btn btn-danger btn-lg">Não</button> </a> 
 </center> 
 
 
</div><br>


</body>
</html>
