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
  
  <style media="print">
.botao {
display: none;
}
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
 
</head>
<body id="principal">

<div class="w3-container">
    
<div class="col-sm-12" style="height:100px; margin-top:10px;">
    <div class="w3-third"  style="padding:10px; vertical-align:middle; text-align:left;"><img src="../../../img/marca.png" width="350px" /></div>
    <div class="w3-twothird" style="padding:10px; vertical-align:middle; font-size:12px;">
        <h2 class="w3-xlarge"><center>BLOQUETOS DE ASSOCIADOS</center></h2> 
    </div>
</div>



<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form" method="POST" class="botao">
    <input name="numero" type="hidden" value="1">
<table class="w3-table" width="100%">
    <tr>
        <td>&nbsp;</td>
        <td width="150px" style="text-align:right; vertical-align:middle;"><b>Pesquisar </b></td>
        <td width="300px"><input name="id" type="text" placeholder="Nº Documento" class="w3-input w3-white w3-round w3-border"></td>
        <td width="100px"><button class="w3-button w3-round w3-green"><i class="fa fa-search"></i> Buscar</button>
        </td>
    </tr>
</table>
</form>

<br>

<?Php
require "../../../config/config.php";

$numero = $_POST['numero'];
$id = $_POST['id'];

if($numero == ""){
    
$busca = "SELECT * FROM sps_boletos WHERE boleto_status!='Pendente' ORDER BY boleto_id DESC"; 

$total_reg = "500";

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
?>

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Documento</th>
                <th colspan="2" class="w3-black" style="width:70%; text-align:left;">Avalista/Associado</th>
                <th class="w3-black" style="width:15%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:10%; text-align:right;">Status</th>
            </tr>
        </thead>
<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_documento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_afiliado_id']; ?></td>
                <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['boleto_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
            </td>
            <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['boleto_valor'],2,",",".");?></td>
            <td class="botao" style="text-align:right; vertical-align: middle;"><?Php echo $produto['boleto_status']; ?></td>
            </tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="2" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="3" style="text-align:right;">
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
</tbody>
</table><BR>
    
    <div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div><br>






<?Php
}elseif($id == ""){
$busca = "SELECT * FROM sps_boletos WHERE boleto_status != 'Pendente' ORDER BY boleto_id DESC"; 

$total_reg = "500";

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
?>

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Documento</th>
                <th colspan="2" class="w3-black" style="width:70%; text-align:left;">Avalista/Associado</th>
                <th class="w3-black" style="width:15%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:10%; text-align:right;">Status</th>
            </tr>
        </thead>
<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_documento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_afiliado_id']; ?></td>
                <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['boleto_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
            </td>
            <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['boleto_valor'],2,",",".");?></td>
            <td class="botao" style="text-align:right; vertical-align: middle;"><?Php echo $produto['boleto_status']; ?></td>
            </tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="2" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="3" style="text-align:right;">
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
</tbody>
</table><BR>
    
    <div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div><br>


<?Php
}else{
$busca = "SELECT * FROM sps_boletos WHERE boleto_status != 'Pendente' AND boleto_documento='$id' ORDER BY boleto_id DESC"; 

$total_reg = "500";

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
?>

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Documento</th>
                <th colspan="2" class="w3-black" style="width:70%; text-align:left;">Avalista/Associado</th>
                <th class="w3-black" style="width:15%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:10%; text-align:right;">Status</th>
            </tr>
        </thead>
<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_documento']; ?></td>
                <td style="text-align:center; vertical-align:middle;"><?Php echo $produto['boleto_afiliado_id']; ?></td>
                <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['boleto_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
            </td>
            <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['boleto_valor'],2,",",".");?></td>
            <td class="botao" style="text-align:right; vertical-align: middle;"><?Php echo $produto['boleto_status']; ?></td></tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="2" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="3" style="text-align:right;">
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
</tbody>
</table><BR>
    
    <div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div><br>


<?Php
}
?>
</div> 
 


</body>
</html>
