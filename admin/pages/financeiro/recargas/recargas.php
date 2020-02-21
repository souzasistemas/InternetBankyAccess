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

<h2 class="w3-xlarge">RELATÓRIO DE RECARGAS DE CELULARES PENDENTES</h2>    


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form" method="POST" class="botao">
    <input name="numero" type="hidden" value="1">
<table class="w3-table" width="100%">
    <tr>
        <td>&nbsp;</td>
        <td width="5%;" style="vertical-align:middle;"><b>Pesquisar </b></td>
        <td width="10%;"><input name="id" type="text" placeholder="Nº da Conta" class="w3-input w3-white w3-round w3-border"></td>
        <td width="10%;"style="vertical-align:middle;"><button class="w3-button w3-round w3-green"><i class="fa fa-search"></i> Buscar</button></td>
        <td width="75%;"style="vertical-align:middle;">&nbsp;</td>
    </tr>
</table>
</form>

<br>

<?Php
require "../../../../../config/config.php";

$numero = $_POST['numero'];
$id = $_POST['id'];

if($numero == ""){
    
$busca = "SELECT * FROM sps_recarga_celular WHERE recarga_status='Pendente' ORDER BY recarga_id ASC"; 

$total_reg = "500";

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

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Conta</th>
                <th class="w3-black" style="width:20%; text-align:left;">Nome Associado</th>
                <th class="w3-black" style="width:20%; text-align:center;">Data do Pedido</th>
                <th class="w3-black" style="width:15%; text-align:center;">Número do Telefone</th>
                <th class="w3-black" style="width:5%; text-align:center;">Operadora</th>
                <th class="w3-black" style="width:5%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:5%; text-align:right;">&nbsp;</th>
            </tr>
        </thead>
<?Php
while ($produto = mysqli_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_afiliado_id']; ?></td>
    <td style="text-align:left; vertical-align: middle;">
         <?php
             
                $idAssociado = $produto['recarga_afiliado_id'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_dia']; ?>/<?php echo $produto['recarga_mes']; ?>/<?php echo $produto['recarga_ano']; ?> às <?php echo $produto['recarga_hora']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_numero']; ?></td>
        <td style="text-align:center; vertical-align: middle;">
            <?Php
		if($produto['recarga_operadora'] == "CLARO"){
			echo "<img src='../../../img/logo_claro.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "TIM"){
			echo "<img src='../../../img/logo_tim.png' width='70px'>";
		}elseif($produto['recarga_operadora'] == "VIVO"){
			echo "<img src='../../../img/logo_vivo.png' width='65px'>";
		}elseif($produto['recarga_operadora'] == "OI"){
			echo "<img src='../../../img/logo_oi.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "NEXTEL"){
			echo "<img src='../../../img/logo_nextel.png' width='80px'>";
		}
		?>    
        </td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['recarga_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;">
            <a class="botao" href="baixa_recarga.php?codigo=<?php echo $produto['recarga_id']; ?>" title="Dar Baixa"><i class="fa fa-check-square" style="color:green; font-size:30px; padding-right:5px;" aria-hidden="true"></i></a>
            
            </td>
        
            </tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="4" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="4" style="text-align:right;">
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
$busca = "SELECT * FROM sps_recarga_celular WHERE recarga_status='Pendente' ORDER BY recarga_id ASC"; 

$total_reg = "500";

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

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Conta</th>
                <th class="w3-black" style="width:20%; text-align:left;">Nome Associado</th>
                <th class="w3-black" style="width:20%; text-align:center;">Data do Pedido</th>
                <th class="w3-black" style="width:15%; text-align:center;">Número do Telefone</th>
                <th class="w3-black" style="width:5%; text-align:center;">Operadora</th>
                <th class="w3-black" style="width:5%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:5%; text-align:right;">&nbsp;</th>
            </tr>
        </thead>
<?Php
while ($produto = mysqli_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_afiliado_id']; ?></td>
    <td style="text-align:left; vertical-align: middle;">
         <?php
             
                $idAssociado = $produto['recarga_afiliado_id'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_dia']; ?>/<?php echo $produto['recarga_mes']; ?>/<?php echo $produto['recarga_ano']; ?> às <?php echo $produto['recarga_hora']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_numero']; ?></td>
        <td style="text-align:center; vertical-align: middle;">
            <?Php
		if($produto['recarga_operadora'] == "CLARO"){
			echo "<img src='../../../img/logo_claro.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "TIM"){
			echo "<img src='../../../img/logo_tim.png' width='70px'>";
		}elseif($produto['recarga_operadora'] == "VIVO"){
			echo "<img src='../../../img/logo_vivo.png' width='65px'>";
		}elseif($produto['recarga_operadora'] == "OI"){
			echo "<img src='../../../img/logo_oi.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "NEXTEL"){
			echo "<img src='../../../img/logo_nextel.png' width='80px'>";
		}
		?>    
        </td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['recarga_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;">
            <a class="botao" href="baixa_recarga.php?codigo=<?php echo $produto['recarga_id']; ?>" title="Dar Baixa"><i class="fa fa-check-square" style="color:green; font-size:30px; padding-right:5px;" aria-hidden="true"></i></a>
            
            </td>
        
            </tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="4" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="4" style="text-align:right;">
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
$busca = "SELECT * FROM sps_recarga_celular WHERE recarga_status='Pendente' AND recarga_afiliado_id='$id' ORDER BY recarga_id ASC"; 

$total_reg = "500";

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

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:12px;">
        <thead>
            <tr>
                <th class="w3-black" style="width:5%; text-align:center;">Conta</th>
                <th class="w3-black" style="width:20%; text-align:left;">Nome Associado</th>
                <th class="w3-black" style="width:20%; text-align:center;">Data do Pedido</th>
                <th class="w3-black" style="width:15%; text-align:center;">Número do Telefone</th>
                <th class="w3-black" style="width:5%; text-align:center;">Operadora</th>
                <th class="w3-black" style="width:5%; text-align:right;">Valor</th>
                <th class="w3-black botao" style="width:5%; text-align:right;">&nbsp;</th>
            </tr>
        </thead>
<?Php
while ($produto = mysqli_fetch_array($limite)) {
?>


        <tbody>
            <tr>
                <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_afiliado_id']; ?></td>
    <td style="text-align:left; vertical-align: middle;">
         <?php
             
                $idAssociado = $produto['recarga_afiliado_id'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_dia']; ?>/<?php echo $produto['recarga_mes']; ?>/<?php echo $produto['recarga_ano']; ?> às <?php echo $produto['recarga_hora']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['recarga_numero']; ?></td>
        <td style="text-align:center; vertical-align: middle;">
            <?Php
		if($produto['recarga_operadora'] == "CLARO"){
			echo "<img src='../../../img/logo_claro.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "TIM"){
			echo "<img src='../../../img/logo_tim.png' width='70px'>";
		}elseif($produto['recarga_operadora'] == "VIVO"){
			echo "<img src='../../../img/logo_vivo.png' width='65px'>";
		}elseif($produto['recarga_operadora'] == "OI"){
			echo "<img src='../../../img/logo_oi.png' width='50px'>";
		}elseif($produto['recarga_operadora'] == "NEXTEL"){
			echo "<img src='../../../img/logo_nextel.png' width='80px'>";
		}
		?>    
        </td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['recarga_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;">
            <a class="botao" href="baixa_recarga.php?codigo=<?php echo $produto['recarga_id']; ?>" title="Dar Baixa"><i class="fa fa-check-square" style="color:green; font-size:30px; padding-right:5px;" aria-hidden="true"></i></a>
            
            </td>
        
            </tr>
        </tbody>
        
<?Php
}
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td colspan="4" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="4" style="text-align:right;">
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
