<?Php
session_start();

$id = $_GET['id'];

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);

$nome = $id." - ".$ver['afiliado_usuario'];


if($ver['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $ver['afiliado_fantasia'];
}

$sqlAcesso = mysqli_query($conexao, "SELECT * FROM sps_afiliado_logs WHERE acesso_admin_login='$nome' ORDER BY acesso_admin_id DESC LIMIT 1,1");
$verAcesso = mysqli_fetch_array($sqlAcesso);
    $idLogs = $verAcesso['acesso_admin_id'];
    
if($idLogs == ""){
    $echo = "Este é seu primeiro Acesso!";
}else{
    $echo = "Seu Último acesso foi no dia ".$verAcesso['acesso_admin_data']." às ".$verAcesso['acesso_admin_hora']." no IP: ".$verAcesso['acesso_admin_ip']."";
}



require "../config/saldo.php";

?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Conta <?Php echo $id." - ".$nome; ?></title>
<link rel="icon" href="../img/favicon.png">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
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

<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>

<style type="text/css">

body#principal::-webkit-scrollbar-track {
    background-color: none;
}
body#principal::-webkit-scrollbar {
    width: 6px;
    background: none;
}
body#principal::-webkit-scrollbar-thumb {
    background: #483D8B;
}
  </style>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<body id="principal">



<div class="w3-container">



<div class=" w3-panel w3-display-container w3-purple w3-card w3-text-white w3-margin w3-padding-16">

   
    <?Php
date_default_timezone_set('Brazil/East');
$data = date('d/m/Y');
$hora = date('H');
$minutos = date('i');
$segundos = date('s');

if($hora>=12 && $hora<18){
    echo "<h5>Boa Tarde! <strong>".$nomeAfiliado."</strong>! Seja bem vindo!  - "; 
    echo $echo ."</h5>";
}elseif($hora>=18 && $hora<24){
    echo "<h5>Boa Noite! <strong>".$nomeAfiliado."</strong>! Seja bem vindo!  - ";
    echo $echo ."</h5>";
}elseif($hora>=0 && $hora<12){
    echo "<h5>Bom dia! <strong>".$nomeAfiliado."</strong>! Seja bem vindo!  - ";
    echo $echo ."</h5>";
}
      ?>
      
</div>


<div class="w3-panel w3-display-container w3-row">
  
  <div class="w3-third w3-container w3-teal w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:80px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:40px;"><?Php echo number_format($saldo_disponivel,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Saldo em Conta</h4>
      </div>
  </div>
  
  <div class="w3-third w3-container w3-cyan w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:80px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:40px;"> <?Php echo number_format($saldo_disponivel2,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Limite Disponível</h4>
      </div>
  </div>
  
  
  <div class="w3-third w3-container w3-blue-gray w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:80px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:40px;"> <?Php echo number_format($saldoGeral,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4>Saldo Total Disponível</h4>
      </div>
  </div>
</div>



</div>
</body>
</html>