<?Php
session_start();
$id = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($_GET['id']))))))))));

if($id == ""){
    echo "<script>location.href='index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../../config/config.php";  

$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);
    $nome = $ver['admin_nome'];
    
 


?>

<html>
    <head>
<title>Administrativo <?Php echo $nomeEmpresa2; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="icon" href="https://www.vite7.com/img/favicon.ico" sizes="32x32" type="image/png">
  	<link rel="shortcut icon" href="https://www.vite7.com/img/favicon.ico" sizes="32x32" type="image/png">
  	<link rel="license" href="https://www.souzasistemas.com.br/">
  	<link rel="author" href="https://www.souzasistemas.com.br/">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
html, body {height:100%;}
body{
    overflow:hidden;
}
</style>




<head>
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4;">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
  <span class="w3-bar-item w3-right"><img src="../../../img/logo/internetbankBr.png" width="160px"></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;border-right:1px solid #ccc;" id="mySidebar"><br>
  <div class="w3-container ">
    <div class="w3-col s12" style="padding-top:30px;">
        <img src="../../../img/logo/<?Php echo $logotipo;?>" class="w3-margin-right w3-padding-16" style="width:100%"><br>
      <span>Seja Bem Vindo, <br><strong><?Php echo $nome; ?></strong></span>
      
    </div>
    
  </div>
  <hr>
 
  <div class="w3-bar-block">






<?Php
if($ver['admin_permissao'] == "0"){
?>
    <a href="principal.php?id=<?Php echo $ver['admin_id'];?>&&empresa=<?Php echo $empresa; ?>" target="ver" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-home"></i> HOME</a>
<?Php
}else{
?>
    <a href="escolha.htm" target="ver" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-home"></i> HOME</a>
<?Php
}
?>






<?Php
if($ver['admin_permissao'] == "0"){
?>

<div class="w3-bar-item w3-button" onclick="myAccFunc()">
    <i class="fas fa-users"></i> ADMINISTRADOR 
    <i class="fas fa-caret-down"></i>
</div>

<div id="demoAcc" class="w3-hide w3-white w3-card-4">
    <a href="administrador/verAdm.php?id=<?Php echo $id; ?>" target="ver" title="Ver Administrador" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>VER ADMINISTRADOR</b></a>

    <a href="administrador/novoAdm.php?id=<?Php echo $id; ?>" target="ver" title="Novo Administrador" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>NOVO ADMINISTRADOR</b></a>
</div>

<?Php
}else{
}
?>




<?Php
if($ver['admin_permissao'] == "0"){
?>
    <a href="associado/verAssociado.php?id=<?Php echo $id; ?>" target="ver" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-address-card"></i> ASSOCIADOS</a>
<?Php
}elseif($ver['admin_permissao'] == "1"){
?>
    <a href="associado/verAssociado.php?id=<?Php echo $id; ?>" target="ver" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-address-card"></i> ASSOCIADOS</a>
<?Php
}else{
}
?>








<?Php
if($ver['admin_permissao'] == "0"){
?>
    <div class="w3-bar-item w3-button" onclick="myAccFunc3()"><i class="fas fa-file-invoice-dollar"></i> FINANCEIRO <i class="fas fa-caret-down"></i></div>
          <div id="demoAcc3" class="w3-hide w3-light-gray w3-card-4">
            <!--- <a href="financeiro/ativacao/ativar.php?id=<?Php echo $id; ?>" target="ver" title="Ativação / Desbloqueio" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>ATIVAÇÃO/DESBLOQUEIO</b></a> --->
            <a href="financeiro/credito/credito.php?id=<?Php echo $id; ?>" target="ver" title="Inserir Crédito" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>CRÉDITO</b></a>
            <a href="financeiro/debito/debito.php?id=<?Php echo $id; ?>" target="ver" title="Inserir Débito" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DÉBITO</b></a>
            <a href="financeiro/deposito/deposito.php?id=<?Php echo $id; ?>" target="ver" title="Retiradas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DEPÓSITOS</b></a>
            <a href="financeiro/saques/saques.php?id=<?Php echo $id; ?>" target="ver" title="Retiradas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DOC/TED</b></a>
            <a href="financeiro/boletos/boletos.php?id=<?Php echo $id; ?>" target="ver" title="Pagamento de Contas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>PAGAMENTO DE CONTAS</b></a>
            <a href="financeiro/recargas/recargas.php?id=<?Php echo $id; ?>" target="ver" title="Recarga de Celular" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>RECARGA DE CELULAR</b></a>
            <!--- <a href="financeiro/bloquetos/relatorio_boletos.php?id=<?Php echo $id; ?>" target="ver" title="Bloquetos Associados Clientes" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>BOLETO ASSOCIADOS</b></a>--->
            <a href="financeiro/relatorio/relatorio.php?id=<?Php echo $id; ?>" target="ver" title="Relatório Geral" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>PESQUISAR EXTRATO</b></a>
        </div>




<?Php
}elseif($ver['admin_permissao'] == "1"){
}elseif($ver['admin_permissao'] == "2"){
?>


<div class="w3-bar-item w3-button" onclick="myAccFunc3()"><i class="fas fa-file-invoice-dollar"></i> FINANCEIRO <i class="fas fa-caret-down"></i></div>
          <div id="demoAcc3" class="w3-hide w3-light-gray w3-card-4">
            <!--- <a href="financeiro/ativacao/ativar.php?id=<?Php echo $id; ?>" target="ver" title="Ativação / Desbloqueio" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>ATIVAÇÃO/DESBLOQUEIO</b></a> --->
            <a href="financeiro/credito/credito.php?id=<?Php echo $id; ?>" target="ver" title="Inserir Crédito" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>CRÉDITO</b></a>
            <a href="financeiro/debito/debito.php?id=<?Php echo $id; ?>" target="ver" title="Inserir Débito" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DÉBITO</b></a>
            <a href="financeiro/deposito/deposito.php?id=<?Php echo $id; ?>" target="ver" title="Retiradas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DEPÓSITOS</b></a>
            <a href="financeiro/saques/saques.php?id=<?Php echo $id; ?>" target="ver" title="Retiradas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>DOC/TED</b></a>
            <a href="financeiro/boletos/boletos.php?id=<?Php echo $id; ?>" target="ver" title="Pagamento de Contas" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>PAGAMENTO DE CONTAS</b></a>
            <a href="financeiro/recargas/recargas.php?id=<?Php echo $id; ?>" target="ver" title="Recarga de Celular" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>RECARGA DE CELULAR</b></a>
            <!--- <a href="financeiro/bloquetos/relatorio_boletos.php?id=<?Php echo $id; ?>" target="ver" title="Bloquetos Associados Clientes" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>BOLETO ASSOCIADOS</b></a>--->
            <a href="financeiro/relatorio/relatorio.php?id=<?Php echo $id; ?>" target="ver" title="Relatório Geral" class="w3-bar-item w3-button w3-padding" onclick="w3_close()"><i class="fas fa-caret-right"></i> <b>PESQUISAR EXTRATO</b></a>
        </div>
<?Php
}
?>





<a data-toggle="modal" data-target="#myModal" style="cursor:pointer;" class="w3-bar-item w3-button w3-light-gray" onclick="w3_close()"><i class="fas fa-sign-out-alt"></i> FECHAR ADMIN</a><br><br>
    
  </div>
</nav>




<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;padding-top:20px;">

<?Php
if($ver['admin_permissao'] == "0"){
?>
    <iframe name="ver" src="principal.php?id=<?Php echo $ver['admin_id'];?>" frameborder="0" scrolling="auto" width="100%" height="95%"></iframe>
<?Php
}else{
?>
    <iframe name="ver" src="escolha.htm" frameborder="0" scrolling="auto" width="100%" height="95%"></iframe>
<?Php
}
?>


  <!-- End page content -->
</div>

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
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myAccFunc2() {
  var x = document.getElementById("demoAcc2");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myAccFunc3() {
  var x = document.getElementById("demoAcc3");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
</script>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="height:100%; padding:0 0 30px 0; overflow:hidden;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="border:none;">
          <h4 class="modal-title">&nbsp;</h4>
        </div>
        <div class="modal-body" style="text-align:center; ">
            <h3 class="modal-title" style="color:#000;">Deseja realmente sair?</h3><br>
          <input type="button" value="Sim" class="btn btn-success" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>'" /> | 
          <input type="button" value="Não" class="btn btn-danger" data-dismiss="modal" />
        </div>
        <div class="modal-footer" style="border:none;">&nbsp;</div>
      </div>
      
    </div>
  </div>

</body>
</html>

<?Php
}
?>