<?Php
session_start();

$id = $_GET['id'];

if($id == ""){
    echo "<script>location.href='https://admin.internetbank.souzasistemas.com.br';alert('Acesso não Autorizado!');</script>";
}else{

require "../../../../config/config.php";

$sqlAdmin = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
$verAdmin = mysql_fetch_array($sqlAdmin);
    $permissao = $verAdmin['admin_permissao'];
    $emp = $verAdmin['admin_empresa'];
?>
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
  

<script src="../../js/mascara.js"></script>

<script type="application/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
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


<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('id').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('id').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('empresa').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('empresa').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('nome').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('nome').disabled = true;
      }
      
      if(document.getElementById('radio4').checked == true){
        document.getElementById('documento').disabled = false;
      }
      if(document.getElementById('radio4').checked == false){
        document.getElementById('documento').disabled = true;
      }
      
    }
  </script>


<script type="application/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
</script>

</head>
<body id="principal" class="w3-light-grey">

<div class="w3-container-fluid w3-padding">
<h2>Modo de Consulta</h2>

  
<form class="w3-container" style="padding:0;" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>" method="post" name="form">
    <input name="busca" type="hidden" value="busca">
    
    <div class="w3-quarter">
        <table class='w3-table'>
            <tr>
                <label for="radio2">
            <td width="50px"><input type="radio" id="radio2" class='w3-radio' name="tipo" value="2" onClick="habilitacao()"> </td>
            <td style="vertical-align:middle; margin-top:5px;"><input name="empresa" class="w3-right w3-input" id="empresa" type="hidden" value="<?Php echo $emp; ?>" disabled>
            <input type="text" class="w3-right w3-input" value="Todos os Cadastros" style="background:none; border:none;" disabled></td>
            </label>
            </tr>
        </table>
    </div>
    
    <div class="w3-quarter">
        <table class="w3-table">
            <tr>
                <label for="radio1">
                    <td width="50px"><input type="radio" id="radio1" class='w3-radio' name="tipo" value="1" onClick="habilitacao()"></td>
                    <td><input type="text" class="w3-right w3-input" name="afiliado" id="id" placeholder="Por Conta" disabled></td>
                </label>
            </tr>
        </table>
    </div>
   
    <div class="w3-quarter">
        <table class='w3-table'>
            <tr>
                <label for="radio3">
            <td width="50px"><input type="radio" id="radio3" class='w3-radio' name="tipo" value="3" onClick="habilitacao()"></td>
            <td><input type="text" class="w3-right w3-input" name="nome" id="nome" placeholder="Por Nome" disabled></td>
            </label>
            </tr>
        </table>
    </div>
    <div class="w3-quarter" id="sumir">
        <table class='w3-table'>
            <tr>
                <label for="radio4">
            <td width="50px"><input type="radio" id="radio4" class='w3-radio' name="tipo" value="4" onClick="habilitacao()"> </td>
            <td><input type="text" onkeypress='mascaraMutuario(this,cpfCnpj)' maxlength="18" class="w3-right w3-input" name="documento" id="documento" placeholder="Por CPF/CNPJ" disabled></td>
            </label>
            </tr>
        </table>
    </div>
    <table class='w3-table'>
        <tr>
            <td><button class="w3-green w3-input input-lg"><i class="fa fa-search"></i> Buscar</button></td>
        </tr>
    </table>
</form>




<?Php
if(isset($_POST['busca'])){
    
$tipo = $_POST['tipo'];








/** BUSCA POR NUMERO DA CONTA */
if($tipo == "1"){
$conta = $_POST['afiliado'];

if($conta == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Digite o número da conta do Cliente</div>";
}else{

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$conta' AND afiliado_estabelecimento='$emp'");
$ver = mysql_fetch_array($sql);
    $idAfiliado = $ver['afiliado_id'];
    
if(!$idAfiliado){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Número de Conta não localizada</div>";
}else{
?>

<hr class='w3-border-gray'>

<div class="w3-black w3-center w3-padding w3-large"><b>Resultado da Pesquisa</b></div>

<table class="w3-table-all w3-hoverable" width="90%">
<thead>
        <tr>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="35%" style="background-color:#444; color:#fff; text-align:left;">Nome / Razão Social</th>
            <th id="sumir" width="30%" style="background-color:#444; color:#fff; text-align:center;">Cidade/UF</th>
            <th id="sumir" width="5%" style="background-color:#444; color:#fff; text-align:center;">Status</th>
            <th width="25%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>
    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $ver['afiliado_id']; ?>-<?php echo $ver['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $ver['afiliado_indicador'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($ver['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Atendente: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($ver['afiliado_nome'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Atendente: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($ver['afiliado_nome'])."</a>";
                    }
                }elseif($ver['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Atendente: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($ver['afiliado_razao'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Atendente: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($ver['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($ver['afiliado_cidade']); ?>/<?php echo strtoupper($ver['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($ver['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $ver['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $ver['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $ver['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $ver['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $ver['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $ver['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
          </td>
    </tr>
</tbody>
</table>












<?Php
}
}
/** FIM DA BUSCA POR NUMERO DA CONTA */








/** BUSCA POR EMPRESA */
}elseif($tipo == "2"){
$empresa = $_POST['empresa'];

if($empresa == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> É necessário escolher uma empresa</div>";
}else{

$busca = "SELECT * FROM sps_afiliados WHERE afiliado_estabelecimento='$emp' AND afiliado_id!='1386' ORDER BY afiliado_id ASC"; 

$total_reg = "10";

$pagina = $_GET['pagina'];

if(!$pagina){
    $pc = "1";
}else{
    $pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

$limite = mysql_query("$busca LIMIT $inicio,$total_reg");
$todos = mysql_query("$busca");

$tr = mysql_num_rows($todos);
$tp = $tr/$total_reg;

$totalAdm = mysql_num_rows($limite);
}

$idAfiliado = $todos['afiliado_id'];
    
if(!$idAfiliado){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Está empresa não possui associados cadastrados</div>";
}else{
?>

<hr class='w3-border-gray'>

<div class="w3-black w3-center w3-padding w3-large"><b>Resultado da Pesquisa - Empresa: <span class="w3-text-yellow"><?Php echo $empresa; ?>-<?Php echo $verLoja['afiliado_codigo_verificador']; ?> / <?Php echo $nomeLoja23; ?></span> </b></div>

<table class="w3-table-all w3-hoverable" width="90%">
<thead>
        <tr>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="35%" style="background-color:#444; color:#fff; text-align:left;">Nome / Razão Social</th>
            <th id="sumir" width="30%" style="background-color:#444; color:#fff; text-align:center;">Cidade/UF</th>
            <th id="sumir" width="5%" style="background-color:#444; color:#fff; text-align:center;">Status</th>
            <th width="25%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>


<?Php
while ($produto = mysql_fetch_array($limite)) {
?>

   
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['afiliado_id']; ?>-<?php echo $produto['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['afiliado_indicador'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($produto['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto['afiliado_nome'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto['afiliado_nome'])."</a>";
                    }
                }elseif($produto['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto['afiliado_razao'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['afiliado_cidade']); ?>/<?php echo strtoupper($produto['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
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
/*** FIM DA BUSCA POR EMPRESA **/








/** BUSCA PELO NOME DO CORRENTISTA */
}elseif($tipo == "3"){
$nome = $_POST['nome'];

if($nome == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> É necessário que digite pelo menos o nome do Associado</div>";
}else{

$sql1 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_razao LIKE '%$nome%' AND afiliado_conta_modo='Juridica' AND afiliado_estabelecimento='$emp' AND afiliado_id!='1386'");
$ver1 = mysql_fetch_array($sql1);
    $idAfiliado1 = $ver1['afiliado_id'];

$sql2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_nome LIKE '%$nome%' AND afiliado_conta_modo='Fisica' AND afiliado_estabelecimento='$emp' AND afiliado_id!='1386'");
$ver2 = mysql_fetch_array($sql2);
    $idAfiliado2 = $ver2['afiliado_id'];

    
if(!$idAfiliado1 && !$idAfiliado2){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> Nome não localizado no sistema</div>";
}else{
?>

<hr class='w3-border-gray'>

<div class="w3-black w3-center w3-padding w3-large"><b>Resultado da Pesquisa - Nome: <span class="w3-text-yellow"><?Php echo strtoupper($nome); ?></span> </b></div>

<table class="w3-table-all w3-hoverable" width="90%">
    <thead>
        <tr>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="30%" style="background-color:#444; color:#fff; text-align:left;">Nome / Razão Social</th>
            <th id="sumir" width="10%" style="background-color:#444; color:#fff; text-align:left;">Tipo Cadastro</th>
            <th id="sumir" width="30%" style="background-color:#444; color:#fff; text-align:center;">Cidade/UF</th>
            <th id="sumir" width="5%" style="background-color:#444; color:#fff; text-align:center;">Status</th>
            <th width="20%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>

<?Php
$sqlJur = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_razao LIKE '%$nome%' AND afiliado_conta_modo='Juridica' AND afiliado_estabelecimento='$emp' AND afiliado_id!='1386'");
while ($produto1 = mysql_fetch_array($sqlJur)) {
?>    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto1['afiliado_id']; ?>-<?php echo $produto1['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto1['afiliado_indicador'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($produto1['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto1['afiliado_nome'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto1['afiliado_nome'])."</a>";
                    }
                }elseif($produto1['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto1['afiliado_razao'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto1['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto1['afiliado_conta_modo']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto1['afiliado_cidade']); ?>/<?php echo strtoupper($produto1['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto1['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto1['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto1['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto1['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto1['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }
$sqlFis = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_nome LIKE '%$nome%' AND afiliado_conta_modo='Fisica' AND afiliado_estabelecimento='$emp' AND afiliado_id!='1386'");
while ($produto2 = mysql_fetch_array($sqlFis)) {
?>    
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto2['afiliado_id']; ?>-<?php echo $produto2['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto2['afiliado_indicador'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($produto2['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto2['afiliado_nome'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto2['afiliado_nome'])."</a>";
                    }
                }elseif($produto2['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto2['afiliado_razao'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto2['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto2['afiliado_conta_modo']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto2['afiliado_cidade']); ?>/<?php echo strtoupper($produto2['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto2['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto2['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto2['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto2['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }
?>
</table>

<?Php
}
}
/*** FIM DA BUSCA PELO NOME DO CORRENTISTA **/ 



/** BUSCA POR NUMERO DE DOCUMENTO **/
}elseif($tipo == "4"){

$documento = $_POST['documento'];

if($documento == ""){
    echo "<hr class='w3-border-gray'>";
    echo "<div class='alert alert-danger w3-center w3-xlarge'><strong>Atenção!</strong> É necessário digitar o número do CPF/CNPJ para pesquisar</div>";
}else{

?>

<hr class='w3-border-gray'>

<div class="w3-black w3-center w3-padding w3-large"><b>Resultado da Pesquisa - Documento: <span class="w3-text-yellow"><?Php echo $documento; ?></span> </b></div>

<table class="w3-table-all w3-hoverable" width="90%">
<thead>
        <tr>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="35%" style="background-color:#444; color:#fff; text-align:left;">Nome / Razão Social</th>
            <th id="sumir" width="30%" style="background-color:#444; color:#fff; text-align:center;">Cidade/UF</th>
            <th id="sumir" width="5%" style="background-color:#444; color:#fff; text-align:center;">Status</th>
            <th width="25%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>


<?Php
$sqlDocumento = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_cnpj='$documento' AND afiliado_conta_modo='Juridica' AND afiliado_estabelecimento='$emp'");
while ($produto = mysql_fetch_array($sqlDocumento)){
?>

   
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['afiliado_id']; ?>-<?php echo $produto['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['afiliado_indicador'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($produto['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto['afiliado_nome'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto['afiliado_nome'])."</a>";
                    }
                }elseif($produto['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_nome']."'>".strtoupper($produto['afiliado_razao'])."</a>";
                    }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado." - ".$verAssociado['afiliado_razao']."'>".strtoupper($produto['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['afiliado_cidade']); ?>/<?php echo strtoupper($produto['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }
?>


<?Php
$sqlDocumento2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_cpf='$documento' AND afiliado_conta_modo='Fisica' AND afiliado_estabelecimento='$emp'");
while ($produto2 = mysql_fetch_array($sqlDocumento2)){
?>

   
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto2['afiliado_id']; ?>-<?php echo $produto2['afiliado_codigo_verificador']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado2 = $produto2['afiliado_indicador'];
                $sqlAssociado2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado2'");
                $verAssociado2 = mysql_fetch_array($sqlAssociado2);
                
                if($produto2['afiliado_conta_modo'] == "Fisica"){
                    if($verAssociado2['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado2." - ".$verAssociado2['afiliado_nome']."'>".strtoupper($produto2['afiliado_nome'])."</a>";
                    }elseif($verAssociado2['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado2." - ".$verAssociado2['afiliado_razao']."'>".strtoupper($produto2['afiliado_nome'])."</a>";
                    }
                }elseif($produto2['afiliado_conta_modo'] == "Juridica"){
                    if($verAssociado2['afiliado_conta_modo'] == "Fisica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado2." - ".$verAssociado2['afiliado_nome']."'>".strtoupper($produto2['afiliado_razao'])."</a>";
                    }elseif($verAssociado2['afiliado_conta_modo'] == "Juridica"){
                        echo "<a style='cursor:pointer;' data-toggle='tooltip' title='Empresa: ".$idAssociado2." - ".$verAssociado2['afiliado_razao']."'>".strtoupper($produto2['afiliado_razao'])."</a>";
                    }
                }?>
        </td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto2['afiliado_cidade']); ?>/<?php echo strtoupper($produto2['afiliado_estado']); ?></td>
        <td id="sumir" style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto2['afiliado_status']); ?></td>
        <td style="text-align:right;">
            
        <a href="visualizar_afiliado_cliente.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto2['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado_cliente.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto2['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        
        <?Php
        if($permissao == "0"){
        ?>
            <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto2['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto2['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        <?Php
        }
        ?>
          
        
        
          </td>
    </tr>
</tbody>

<?Php
    }
?>
</table>

<?Php
}
/** FIM DA BUSCA POR NUMERO DE DOCUMENTO **/
}
}
?>

<br><br><br><br>
   
</div>
</body>
</html>

<?Php
}
?>