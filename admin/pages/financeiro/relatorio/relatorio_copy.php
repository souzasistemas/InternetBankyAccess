<?Php
require "../../../../config/config.php";

$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysql_fetch_array($sql);
    $permissao = $ver['admin_permissao'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>ADMINISTRATIVO INTERNET BANK ACCESS</title>
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

html, body, div, iframe {margin:0; padding:0; height:100%}
iframe {display:block; width:100%; border:none}

  </style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
 
</head>
<body id="principal">

<?Php
if($permissao != "0"){
?>
                
<div class="w3-sidebar w3-bar-block" style="width:20%"> 
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_afiliado_cliente.php?id=<?Php echo $id; ?>" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Associado</a>
 </div>

<?Php
}else{
?>
<div class="w3-sidebar w3-bar-block" style="width:20%">
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_afiliado.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Associado</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_saques.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Saques</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_recargas.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Recargas</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_pagamentos.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Pagamento de Boletos</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_estabelecimento.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Estabelecimentos</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_fatura.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Faturas</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_boletos.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Boletos Associados</a>
  <a class="w3-bar-item w3-button" style="display:block;" href="relatorio_geral.php" target="ver_relatorio"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Completo</a>
</div>
<?Php
}
?>
<div style="margin-left:20%">
<iframe src="escolha.htm" id="iframe1" name="ver_relatorio" scrolling="auto" style="top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0;  z-index:999999;"></iframe>
</div>
 
 


</body>
</html>
