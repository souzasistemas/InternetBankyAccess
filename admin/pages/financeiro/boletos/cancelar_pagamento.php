<?Php require '../../../../../config/config.php';  ?>

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
<h2 class="w3-jumbo">Excluir Pagamento de Contas</h2>


<?Php
$id = $_GET['codigo'];
$sql = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_id='$id'");
$ver = mysqli_fetch_array($sql);

$idPag = $ver['pag_afiliado_id'];
$sql2= mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idPag'");
$ver2 = mysqli_fetch_array($sql2);

if($ver2['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver2['afiliado_nome']);
}elseif($ver2['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver2['afiliado_razao']);
}
?>
  <p>Deseja realmente excluir o boleto <b><?Php echo $id; ?></b> do Associado 
  
  <h3><?Php echo $idPag; ?> - <?Php echo $nome; ?><br> no valor de <?php echo number_format($ver['pag_valor'],2,",",".");?></h3></p> 
  
  <a href="cancelar_pagamento_exclusão.php?id=<?Php echo $id; ?>"><button type="button" class="btn btn-success btn-lg">Sim</button></a> | 
  <a href="javascript:history.back(-1);"><button type="button" class="btn btn-danger btn-lg">Não</button> </a> 
 </center> 
 
 
</div><br>


</body>
</html>
