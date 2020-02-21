<?Php
require "../config/config.php";

$id = $_GET['id']; /** conta restrita */
$empresa = $_GET['empresa']; /** empresa parceira */



if($id == ""){
	echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não Autorizado!');</script>";
}else{

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $name = $ver['afiliado_nome'];
    $razao = $ver['afiliado_fantasia'];
    $status = $ver['afiliado_status'];
    $link = $ver['afiliado_link'];
	$login23 = $ver['afiliado_usuario'];	
	
	

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $name;
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $razao;
}


if($nomeAfiliado == ""){
	$nome = strtoupper($login23);
}else{
	$nome = $nomeAfiliado;
}

if($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não autorizado!');</script>";
}else{

    $string2 = str_pad($ver['afiliado_id'], 7, '0', STR_PAD_LEFT);
    $string1 = str_pad(1, 4, '0', STR_PAD_LEFT);

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
	$favicon = $verEmpresa['logo_favicon'];
	$nomeEmpresa = strtoupper($verEmpresa['logo_fantasia']);
	$logotipo = $verEmpresa['logo_imagem'];

require "../config/saldo.php";
?>

<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<title>INTERNET BANKY ACCESS - <?Php echo $nomeEmpresa; ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="icon" href="img/favicon/<?php echo $favicon; ?>" />
  <link rel="shortcut icon" href="img/favicon/<?php echo $favicon; ?>" />
        
<script language="JavaScript">
function protegercodigo() {
	if (event.button==2||event.button==3){
		alert('Desculpe! Acesso não Autorizado!');}
	}
	document.onmousedown=protegercodigo
</script>

<SCRIPT LANGUAGE="JavaScript">
function disableselect(e){
	return false
}   

function reEnable(){
	return true
}
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
				
</script>

<style>
html,body, iframe, div#conteudo {height:100%;}
</style>


</head>
<body>

<div id="conteudo" class="w3-bar w3-top w3-light-gray w3-large" style="z-index:4;">

<?Php
$sqlLogo = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verLogo = mysqli_fetch_array($sqlLogo);
	$idLogo = $verLogo['logo_afiliado_id'];
	$logotipoEmpresa = $verLogo['logo_imagem'];

    
if($idLogo == ""){?>

<div class="w3-section">
  <div class="w3-col s4">
    <button style="margin:8px 0 0 5px; border:1px solid #ccc;" class="w3-left w3-bar-item w3-button w3-hide-large w3-hover-gray w3-hover-text-white w3-teal w3-round " onclick="w3_open();"><span style="font-size:18px;">»</span> Menu</button>
  </div>
  <div class="w3-col s4 w3-right" style="margin:0; padding:0;">
    <span class="w3-bar-item w3-right" style="margin-top:-15px;"><img src="../img/logo/internetbank.png" width="150px"></span>
  </div>
</div>


	
<?Php
}else{
?>

<div class="w3-section">
  <div class="w3-col s4">
    <button style="margin:-5px 0 0 5px; border:1px solid #ccc;" class="w3-left w3-bar-item w3-button w3-hide-large w3-hover-gray w3-hover-text-white w3-teal w3-round " onclick="w3_open();"><span style="font-size:18px;">»</span> Menu</button>
  </div>
  <div class="w3-col s4 w3-right" style="margin:0; padding:0;">
    <span class="w3-bar-item w3-right" style="margin-top:-15px;"><img src="../img/logo/<?Php echo $logotipoEmpresa; ?>" width="150px"></span>
  </div>
</div>


    
<?Php
}
?>       


<nav class="w3-sidebar w3-collapse w3-light-gray w3-animate-left" style="z-index:3;width:350px; padding-top:5px;" id="mySidebar"><br><br>






<?Php
if($ver['afiliado_status'] != "Ativo"){
?>

<div class="w3-container w3-white w3-padding w3-margin w3-card w3-round w3-text-gray" style=" font-size:12px;">
Olá, <strong><?Php echo $nome; ?></strong><br>
<b>Agência: </b><?Php echo $string1; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>Conta: </b><?Php echo $string2; ?>-<?Php echo $ver['afiliado_codigo']; ?>
</div>

<?Php
if($ver['afiliado_status'] == "Pendente"){
?>
<div class="w3-bar-block w3-center">
<a target="ver" href="principal_pendente.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" onclick="w3_close()" class="w3-round w3-card-4 w3-teal w3-button w3-padding w3-text-white w3-center w3-hover-black" style="width:91%; margin-bottom:5px;" onclick="w3_close()">DESBLOQUEAR CONTA</a>
</div>
<?Php
}
?>

<div class="w3-bar-block w3-center">
<a onclick="document.getElementById('sair').style.display='block'" class="w3-round w3-card-4 w3-red w3-button w3-padding w3-text-white w3-center w3-hover-black" style="width:91%;" onclick="w3_close()">SAIR DA CONTA</a>
</div>


 
<?Php
	}else{
?>

<center>
<?Php
if($ver['afiliado_foto'] == ""){
?>
	<a onclick="document.getElementById('alterar').style.display='block'"><img class="w3-border w3-round-large" src="../img/foto/avatar2.png" style="width:300px; height:300px; padding:8px; cursor:pointer;"></a>
<?Php
}else{
?>
	<a onclick="document.getElementById('alterar').style.display='block'"><img class="w3-border w3-round-large" src="../img/foto/<?Php echo $ver['afiliado_foto']; ?>" style="width:300px; height:300px; padding:8px; cursor:pointer;"></a>
<?Php
}
?>
</center>

<div class="w3-container w3-white w3-padding w3-card w3-round w3-text-gray" style=" font-size:12px; margin:5px 25px;">
Olá, <strong><?Php echo $nome; ?></strong><br>
<b>Agência: </b><?Php echo $string1; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>Conta: </b><?Php echo $string2; ?>-<?Php echo $ver['afiliado_codigo']; ?>
</div>

<div class="w3-container w3-sand w3-card w3-round" style="margin:5px 25px;">
<table class="w3-table w3-text-black" style="font-size:14px;">
<tr>
<td><b>Saldo</b></td>
<td><iframe src="../config/ver_saldo.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" style="height:20px; width:105%;" frameborder="0" scrolling="no"></iframe>

</td>
</tr>
</table>
</div>

<div class="w3-bar" style="padding-left:25px; margin-bottom:15px;">
<a target="ver" href="principal.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" onclick="w3_close()"><button class="w3-bar-item w3-button w3-green w3-hover-black" style="font-size:12px;width:31%; border-radius:3px 0 0 3px;">HOME</button></a>
<a target="ver" href="dados.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" onclick="w3_close()"><button class="w3-bar-item w3-button w3-text-white w3-orange w3-hover-black" style="font-size:12px;width:31%">PERFIL</button></a>
<a onclick="document.getElementById('sair').style.display='block'" onclick="w3_close()"><button class="w3-bar-item w3-button w3-red w3-hover-black" style="font-size:12px;width:30%; border-radius:0 3px 3px 0;">SAIR</button></a>
</div> 

<div class="w3-bar-block">

<div class="w3-bar-item w3-padding w3-teal w3-center">MENU PRINCIPAL</div>




<div class="w3-dropdown-hover">
  
  <?Php 
    if($empresa != "1091"){
  ?> 
  <button onclick="myFunction('Demo1')" class="w3-button w3-pale-green w3-button w3-hover-black" style="font-size:12px; border-bottom:1px solid #ccc;"><span style="font-size:18px;">»</span> MINHA CONTA <span class="w3-right">▼</span></button>
  
  <div id="Demo1" class="w3-hide w3-dropdown-content w3-bar-block w3-border w3-animate-zoom">  
    <a target="ver" href="saldo.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> SALDO E EXTRATO</a>    
    </div>
  
  <?Php 
    }else{
  ?>
  <a target="ver" href="saldo.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> SALDO E EXTRATO</a>    
    
  <?Php
    }
  ?>
</div>




<div class="w3-dropdown-hover">
    
<button onclick="myFunction('Demo2')" class="w3-button w3-pale-green w3-button w3-hover-black" style="font-size:12px; border-bottom:1px solid #ccc;"><span style="font-size:18px;">»</span> TRANSFERÊNCIA <span class="w3-right">▼</span></button>
  
  <div id="Demo2" class="w3-hide w3-dropdown-content w3-bar-block w3-border w3-animate-zoom">
    <a target="ver" href="transferir.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> ENTRE CONTAS</a>
    <a target="ver" href="retirada.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> DOC/TED</a>
  </div>
 
</div>








<div class="w3-dropdown-hover">
  
  <?Php 
    if($empresa != "1091"){
  ?> 
  <button onclick="myFunction('Demo3')" class="w3-button w3-pale-green w3-button w3-hover-black" style="font-size:12px; border-bottom:1px solid #ccc;"><span style="font-size:18px;">»</span> DEPOSITAR <span class="w3-right">▼</span></button>
  
  <div id="Demo3" class="w3-hide w3-dropdown-content w3-bar-block w3-border w3-animate-zoom">
    <a target="ver" href="deposito_banco.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> VIA TRANSFERENCIA BANCÁRIA</a>
    <!--- <a target="ver" href="deposito_boleto.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> VIA BOLETO BANCÁRIO</a>
    <a target="ver" href="deposito_cartao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> VIA PAYPAL</a> --->
  </div>
  
  <?Php 
    }else{
  ?>
  
  <a target="ver" href="deposito_banco.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> RECARREGAR CONTA</a>
  
  <?Php
    }
  ?>
</div>



<div class="w3-dropdown-hover">
  
  <?Php 
    if($empresa != "1091"){
  ?> 
  <button onclick="myFunction('Demo4')" class="w3-button w3-pale-green w3-button w3-hover-black" style="font-size:12px; border-bottom:1px solid #ccc;"><span style="font-size:18px;">»</span> SERVIÇOS PERSONALIZADOS <span class="w3-right">▼</span></button>
   
  <div id="Demo4" class="w3-hide w3-dropdown-content w3-bar-block w3-border w3-animate-zoom">
    <a target="ver" href="pagamento.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> PAGAMENTO DE CONTAS</a>
    <a target="ver" href="recarga.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> RECARGA DE CELULAR</a>
    <a target="ver" href="comprar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> TERMINAL PAG PAY</a>
    
    <?Php
    if($empresa == "1001"){
    ?>
    <a target="ver" href="produto.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&produto=1" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> SEJA UM CORRESPONDENTE</a>
    <a target="ver" href="produto.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&produto=2" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> CONSÓRCIO</a>
    <a target="ver" href="produto.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&produto=3" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> ACESSORIA JURÍDICA</a>
    <a target="ver" href="produto.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&produto=4" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> UNIVERSITY</a>
    <?Php
    }
    ?>
  </div>
  
  <?Php 
    }else{
  ?>
  
  <a target="ver" href="comprar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span>  TERMINAL PAG PAY</a>
  
  
  <?Php
    }
  ?>
</div>



<div class="w3-dropdown-hover">
  
  <?Php 
    if($empresa != "1091"){
  ?>
  
  <?Php
    if($empresa != "1001"){
    ?>
  <button onclick="myFunction('Demo5')" class="w3-button w3-pale-green w3-button w3-hover-black" style="font-size:12px; border-bottom:1px solid #ccc;"><span style="font-size:18px;">»</span> BENEFÍCIOS <span class="w3-right">▼</span></button>
  <?Php
    }
    ?>
    
  <div id="Demo5" class="w3-hide w3-dropdown-content w3-bar-block w3-border w3-animate-zoom">
   <?Php
   if($link == "Sim"){
       $menuAmigos = "MEUS CLIENTES";
   }elseif($empresa == "1091"){
       $menuAmigos = "MEUS CLIENTES";
   }else{
       $menuAmigos = "MEUS AMIGOS";
   }
   ?>
   
   <?Php
    if($empresa != "1001"){
    ?>
    <a target="ver" href="meusindicados.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class=" w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> <?Php echo $menuAmigos; ?></a>
   <?Php
    }
    ?>
  </div>
  
    
   <?Php
   if($link == "Sim"){
	   if($empresa == "1002"){
		?>
        <a target="ver" href="caucao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-hover-black w3-bar-item w3-button" style="padding-left:50px; font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">•</span> CAUÇÃO IMOBILIÁRIO</a>
        <a target="ver" href="aplicacao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> MINHAS APLICAÇÕES</a>
  
        <?Php
	   }
   }
   ?>   
   
   
   
       
  </div>
  
  <?Php 
    }else{
  ?>
  
  <a target="ver" href="meusindicados.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> MEUS CLIENTES</a>
  <a target="ver" href="aplicacao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> MINHAS APLICAÇÕES</a>
   
  
  <?Php
    }
  ?>
</div>



<?Php
if($empresa == "1002"){
?>

<div class="w3-dropdown-hover">
  
  <a target="ver" href="aplicacao.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" class="w3-pale-green w3-hover-black w3-bar-item w3-button" style="font-size:12px; display:block; text-align:left; border-bottom:1px solid #ccc;" onclick="w3_close()"><span style="font-size:18px;">»</span> MINHAS APLICAÇÕES</a>
  
</div>


<?Php
}
	}
	?>


<center><a target="ver" href="suporte.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" onclick="w3_close()"><img src="../img/faleconosco.png" width="250px" height="150px" class="w3-padding" ></a></center>
    
 
</nav>  



<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div id="conteudo" class="w3-main" style="margin-left:350px; height:91%;">
<?Php
if($ver['afiliado_status'] == "Pendente"){
?>
<iframe src="principal_pendente.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" frameborder="0" scrolling="auto" style="width:100%; padding-left:10px;padding-top:15px; background-color:#FFF;" name="ver"></iframe>
<?Php
}elseif($ver['afiliado_status'] == "Ativo"){
?>
<iframe src="principal.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" frameborder="0" scrolling="auto" style="width:100%; padding-left:10px;padding-top:15px;  background-color:#FFF;" name="ver"></iframe>
<?Php
}elseif($ver['afiliado_status'] == "Bloqueado"){
?> 
<iframe src="principal_bloqueado.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" frameborder="0" scrolling="auto" style="width:100%; padding-left:10px;padding-top:15px;  background-color:#FFF;" name="ver"></iframe>
<?Php
}
?>


  <!-- End page content -->
</div>








<!--- Alterar foto --->
<div id="alterar" class="w3-modal">
<div class="w3-modal-content w3-animate-top w3-card-4 w3-shadow" style="width:380px; border-radius:10px; margin-top:30px;">
<header class="w3-container w3-light-gray" style="border-radius:10px 10px 0 0">
<center><h3 class="w3-large">Alterar Imagem</h3></center>
</header>
<center><br>
<form method="post" name="form1" id="form1" enctype="multipart/form-data" action="alterar_foto.php">
<input name="id" type="hidden" value="<?Php echo $id; ?>" />
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>" />
<input name="arquivo" type="file" id="arquivo" class="w3-input w3-border w3-round-large" placeholder="Procurar imagem" style="width:90%;" required /><br>
<button class="w3-button w3-green w3-padding-16 w3-round w3-hover-black" name="upload" style="width:90%; margin:0px 10px 5px 10px" type="submit" >ALTERAR FOTO</button>
<button class="w3-button w3-red w3-padding-16 w3-round w3-hover-black" style="width:90%; margin:0px 10px 15px 10px" type="button" onclick="document.getElementById('alterar').style.display='none'" type="button">CANCELAR</button>
</form>
</center>
</div>
</div>





<div id="sair" class="w3-modal">
<div class="w3-modal-content w3-animate-top w3-card-4 w3-shadow" style="width:380px; border-radius:10px; margin-top:30px;">
<header class="w3-container w3-light-gray" style="border-radius:10px 10px 0 0">
<center><h2>Deseja Realmente Sair?</h2>
</header>
<center>
<button class="w3-button w3-green w3-padding-16 w3-round w3-hover-black" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>'" style="width:90%; margin:15px 10px 5px 10px" > SIM</button>
<button style="width:90%; margin:0px 10px 15px 10px"  class="w3-button w3-red w3-padding-16 w3-round w3-hover-black" onclick="document.getElementById('sair').style.display='none'"> NÃO</button>
</center>
</div>
</div>

</div>
</div>
</body>
</html>
<?Php	
}
}
?>



<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>