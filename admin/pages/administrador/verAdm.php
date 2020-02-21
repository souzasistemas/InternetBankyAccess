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
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	


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

@media only screen and (max-width: 687px) {
    #sumir {
        display:none;
    }
    
    
}



  </style>

 
</head>
<body id="principal">

<div class="container-fluid">
<h2 class="w3-xxlarge">Administradores</h2>   

<?Php
require "../../../config/config.php";

$id = $_GET['id'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);

$emp = $ver['admin_empresa'];

$sqlAfiliado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$emp'");
$verAfiliado = mysqli_fetch_array($sqlAfiliado);

                if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
	                $nomeLoja = $verAfiliado['afiliado_nome'];
	            }elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
	                $nomeLoja = $verAfiliado['afiliado_razao'];
	            }
	            

 
$busca = "SELECT * FROM sps_admin WHERE admin_empresa='$empresa'"; 

$total_reg = "9";

$pagina = $_GET['pagina'];

if(!$pagina){
    $pc = "1";
}else{
    $pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

$limite = mysqli_query($conexao, "$busca LIMIT $inicio,$total_reg");
$todos = mysqli_query("$busca");

$tr = mysqli_num_rows($todos);
$tp = $tr/$total_reg;

$totalAdm = mysqli_num_rows($limite);
?>


<b>Empresa: </b> <?Php echo $emp."-".$verAfiliado['afiliado_codigo']; ?> / <?Php echo $nomeLoja; ?>  &nbsp;
<div id="sumir" class="w3-tag w3-round w3-green w3-right" style="padding:3px">
    <a href="gerar_excel_admin.php?id=<?Php echo $emp; ?>"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar XLS</button></a>
</div><br><br>




<table class="w3-table-all w3-hoverable" width="100%">
        <tr>
            <th width="50%" style="background-color:#444; color:#fff; text-align:left;">Nome</th>
            <th width="50%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    
<?Php
while ($produto = mysqli_fetch_array($limite)) {
?>

<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align:middle;"><?php echo $produto['admin_nome']; ?><br>
        <b>Permissão: </b><?Php 
		$idPermissao = $produto['admin_permissao'];
		if($idPermissao == "0"){
			echo "Acesso Geral";
		}elseif($idPermissao == "1"){
			echo "Administrativo";
		}elseif($idPermissao == "2"){
			echo "Financeiro";
		}
		?><br>
		<b>Status: </b><?php echo $produto['admin_status']; ?>
        </td>
        
        <td style="text-align:right; vertical-align:middle;">
        
        <a href="gerar_excell_acessos.php?id=<?Php echo $produto['admin_id']; ?>&&empresa=<?Php echo $emp;?>" data-toggle="tooltip" title="Gerar Acessos" style="cursor:pointer;">
          <span class="glyphicon glyphicon-th-list" style="font-size:25px;color:#1E90FF;"></span>
        </a>
        
          <a href="verAdms_editar.php?id=<?Php echo $id; ?>&&operador=<?php echo $produto['admin_id']; ?>&&emp=<?Php echo $emp;?>" data-toggle="tooltip" title="Editar Administrador" style="cursor:pointer;">
          <span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span>
        </a> 
        
        <a href="verAdms_excluir.php?id=<?Php echo $id; ?>&&operador=<?php echo $produto['admin_id']; ?>&&emp=<?Php echo $emp;?>" data-toggle="tooltip" title="Remover Administrador" style="cursor:pointer;">
          <span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span>
        </a>
        
          </td>
    </tr>
</tbody>

<?Php
}
?>
</table>

</div>   
    
</body>
</html>