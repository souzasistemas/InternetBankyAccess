<?Php
session_start();

$id = $_GET['id'];

require "../../../config/config.php";

$sqlAdmin = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$verAdmin = mysqli_fetch_array($sqlAdmin);
    $permissao = $verAdmin['admin_permissao'];
    $emp = $verAdmin['admin_empresa'];
    
    
$dias_de_prazo_para_pagamento2 = 32;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$dataExpira = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
?>
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
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  	


<script src="../../js/mascara.js"></script>


  
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

@media only screen and (max-width: 687px) {
    #sumir {
        display:none;
    }
    
    
}

input, select{
    margin-bottom:2px;
}
  </style>

<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('empresa').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('empresa').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('id').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('id').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('nome').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('nome').disabled = true;
      }
    }
  </script>

</head>
<body id="principal">

<div class="w3-container-fluid w3-padding">
    
<div class="w3-border w3-padding w3-round w3-black w3-margin-bottom"><h2 class="w3-large"><i class="fas fa-address-card"></i> Pesquisar Associado</h2></div>  

<h2>Modo de Consulta</h2>

  
<form class="w3-container" style="padding:0;" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>" method="post" name="form">
    <input name="busca" type="hidden" value="busca">
    
    <div class="w3-quarter">
        <table class='w3-table'>
            <tr>
                <label for="radio1">
                    <td width="50px"><input type="radio" id="radio1" class='w3-radio' name="tipo" value="1" onClick="habilitacao()"> </td>
                    <td style="vertical-align:middle; margin-top:5px;"><input name="empresa" class="w3-right w3-input" id="empresa" type="hidden" value="<?Php echo $emp; ?>" disabled>
                    <input type="text" class="w3-right w3-input" value="Todos os Cadastros" style="background:none; border:none;" disabled></td>
                </label>
            </tr>
        </table>
    </div>
    
    <div class="w3-quarter">
        <table class='w3-table'>
            <tr>
                <label for="radio2">
                    <td width="50px"><input type="radio" id="radio2" class='w3-radio' name="tipo" value="2" onClick="habilitacao()"></td>
                    <td><input type="tel" class="w3-right w3-input" name="afiliado" id="id" placeholder="Por Conta sem dígito" disabled></td>
                </label>
            </tr>
        </table>
    </div>
   
    <div class="w3-quarter">
        <table class='w3-table'>
            <tr>
                <label for="radio3">
            <td width="50px"><input type="radio" id="radio3" class='w3-radio' name="tipo" value="3" onClick="habilitacao()"></td>
            <td><input type="text" class="w3-right w3-input" name="nome" id="nome" placeholder="Por Nome ou Usuário" disabled></td>
            </label>
            </tr>
        </table>
    </div>
    
    <div class="w3-quarter" >
        <table class='w3-table'>
        <tr>
            <td><button class="w3-green w3-input input-lg"><i class="fa fa-search"></i> Buscar</button></td>
        </tr>
    </table>
    </div>
    
</form>


<?Php
/*** buscar por opção **/
if(isset($_POST['busca'])){
$tipo = $_POST['tipo'];



/*** buscar todos por empresa */
if($tipo == "1"){
$empresa = $_POST['empresa'];

if($empresa == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> É necessário escolher uma empresa</div>";
}else{
$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_empresa='$empresa' ORDER BY afiliado_status DESC");
?>

<hr class='w3-border-gray'>

<div class="w3-tag w3-round w3-green sumir" style="padding:3px">
    <a href="gerar_excel_associado.php?emp=<?Php echo $empresa; ?>"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
</div><br><br>
<table class="w3-table-all w3-hoverable" width="90%">
<thead>
        <tr>
            <th width="80%" style="background-color:#444; color:#fff; text-align:left; vertical-align:middle;">Associado</th>
            <th width="20%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>


<?Php
while ($produto = mysqli_fetch_array($sqlEmpresa)) {
?>

   
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $produto['afiliado_id']; ?>-<?php echo $produto['afiliado_codigo']; ?><br>
            <b>Usuário:</b> <?php echo $produto['afiliado_usuario']; ?><br>
            <?Php
                if($produto['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($produto['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado = $produto['afiliado_indicador'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($produto['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($produto['afiliado_nome'])."";
                }elseif($produto['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($produto['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($produto['afiliado_cidade']); ?>/<?php echo strtoupper($produto['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($produto['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($produto['afiliado_data_cadastro']); ?> às <?php echo strtoupper($produto['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($produto['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($produto['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <!---
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto3['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        ---->
          
        
        
          </td>
    </tr>
</tbody>
<?Php
}
?>
</table> 

<?Php
}
/*** fim busca por empresa */









/*** busca por conta */
}elseif($tipo == "2"){
$conta = $_POST['afiliado'];

if($conta == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Digite o número da conta do Cliente</div>";
}else{

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$conta' AND afiliado_empresa='$emp'");
$ver = mysqli_fetch_array($sql);
    $idAfiliado = $ver['afiliado_id'];
    
if(!$idAfiliado){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Número de Conta não localizada</div>";
}else{
?>

<hr class='w3-border-gray'>

<table class="w3-table-all w3-hoverable" width="90%">
<thead>
        <tr>
            <th width="80%" style="background-color:#444; color:#fff; text-align:left; vertical-align:middle;">Associado</th>
            <th width="20%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>
    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $ver['afiliado_id']; ?>-<?php echo $ver['afiliado_codigo']; ?><br>
            <b>Usuário:</b> <?php echo $ver['afiliado_usuario']; ?><br>
            <?Php
                if($ver['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($ver['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado = $ver['afiliado_indicador'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($ver['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($ver['afiliado_nome'])."";
                }elseif($ver['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($ver['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($ver['afiliado_cidade']); ?>/<?php echo strtoupper($ver['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($ver['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($ver['afiliado_data_cadastro']); ?> às <?php echo strtoupper($ver['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($ver['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($ver['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <!---
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto3['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        ---->
          </td>
    </tr>
</tbody>
</table>
<?Php
}
}
/*** fim por conta */







/*** busca por nome */
}elseif($tipo == "3"){
$nome = $_POST['nome'];

if($nome == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> É necessário que digite pelo menos o nome do Associado</div>";
}else{

$sql1 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_razao LIKE '%$nome%' AND afiliado_conta_modo='Juridica' AND afiliado_empresa='$emp'");
$ver1 = mysqli_fetch_array($sql1);
    $idAfiliado1 = $ver1['afiliado_id'];

$sql2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_nome LIKE '%$nome%' AND afiliado_conta_modo='Fisica' AND afiliado_empresa='$emp'");
$ver2 = mysqli_fetch_array($sql2);
    $idAfiliado2 = $ver2['afiliado_id'];
    
$sql3 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_usuario LIKE '%$nome%' AND afiliado_empresa='$emp'");
$ver3 = mysqli_fetch_array($sql3);
    $idAfiliado3 = $ver3['afiliado_id'];

    
if(!$idAfiliado1 && !$idAfiliado2 && !$idAfiliado3){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Nome não localizado no sistema</div>";
}else{

?>

<hr class='w3-border-gray'>

<table class="w3-table-all w3-hoverable" width="90%">
    <thead>
        <tr>
            <th width="80%" style="background-color:#444; color:#fff; text-align:left; vertical-align:middle;">Associado</th>
            <th width="20%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>

<?Php
$sqlJur = mysqli_query("SELECT * FROM sps_afiliados WHERE afiliado_razao LIKE '%$nome%' AND afiliado_conta_modo='Juridica' AND afiliado_empresa='$emp'");
while ($produto1 = mysqli_fetch_array($sqlJur)) {
?>    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $produto1['afiliado_id']; ?>-<?php echo $produto1['afiliado_codigo']; ?><br>
            <b>Usuário:</b> <?php echo $produto1['afiliado_usuario']; ?><br>
            <?Php
                if($produto1['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($produto1['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado1 = $produto1['afiliado_indicador'];
                $sqlAssociado1 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado1'");
                $verAssociado1 = mysql_fetch_array($sqlAssociado1);
                
                if($produto1['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($produto1['afiliado_nome'])."";
                }elseif($produto1['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($produto1['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($produto1['afiliado_cidade']); ?>/<?php echo strtoupper($produto1['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($produto1['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($produto1['afiliado_data_cadastro']); ?> às <?php echo strtoupper($produto1['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($produto1['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($produto1['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <!---
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto3['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        ---->
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }
$sqlFis = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_nome LIKE '%$nome%' AND afiliado_conta_modo='Fisica' AND afiliado_empresa='$emp'");
while ($produto2 = mysqli_fetch_array($sqlFis)) {

?>    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $produto2['afiliado_id']; ?>-<?php echo $produto2['afiliado_codigo']; ?><br>
            <b>Usuário:</b> <?php echo $produto2['afiliado_usuario']; ?><br>
            <?Php
                if($produto2['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($produto2['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado2 = $produto2['afiliado_indicador'];
                $sqlAssociado2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado2'");
                $verAssociado2 = mysqli_fetch_array($sqlAssociado2);
                
                if($produto2['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($produto2['afiliado_nome'])."";
                }elseif($produto2['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($produto2['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($produto2['afiliado_cidade']); ?>/<?php echo strtoupper($produto2['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($produto2['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($produto2['afiliado_data_cadastro']); ?> às <?php echo strtoupper($produto2['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($produto2['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($produto2['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <!---
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto3['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        ---->
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }

if($produto1['afiliado_id'] == "" && $produto2['afiliado_id'] == ""){

$sqlLog = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_usuario LIKE '%$nome%' AND afiliado_empresa='$emp'");
while ($produto3 = mysqli_fetch_array($sqlLog)) {
?>    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $produto3['afiliado_id']; ?>-<?php echo $produto3['afiliado_codigo']; ?><br>
            <b>Usuário:</b> <?php echo $produto3['afiliado_usuario']; ?><br>
            <?Php
                if($produto3['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($produto3['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado3 = $produto3['afiliado_indicador'];
                $sqlAssociado3 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado3'");
                $verAssociado3 = mysqli_fetch_array($sqlAssociado3);
                
                if($produto3['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($produto3['afiliado_nome'])."";
                }elseif($produto3['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($produto3['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($produto3['afiliado_cidade']); ?>/<?php echo strtoupper($produto3['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($produto3['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($produto3['afiliado_data_cadastro']); ?> às <?php echo strtoupper($produto3['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($produto3['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($produto3['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto3['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <!---
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto3['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto3['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        ---->
          
        
        
          </td>
    </tr>
</tbody>
<?Php
}
}    
?>
</table>

<?Php
}
}
/** fim por busca por nome */
}


}/*** fim da buca por opção */
?>
</div>  <br><br><br>  
</body>
</html>
