<?Php
require "../../../config/config.php";


$idPrincipal = $_GET['id'];

if($idPrincipal == ""){
    $id = $_POST['idValido'];
}else{
    $id = $idPrincipal;
}    

$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysql_fetch_array($sql);
    $permissao = $ver['admin_permissao'];
    
if(isset($_POST['numero'])){
?>

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

  </style>

 
</head>
<body id="principal">
    
<div class="container-fluid">

<h2 class="w3-jumbo">Relatório Investmundi</h2>

<?Php
$contrato = $_POST['contrato'];
$conta = $_POST['codigo'];

if($contrato == "" && $conta == ""){

$busca = "SELECT * FROM sps_rendimento ORDER BY rendimento_id DESC"; 

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

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Investidores: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                <strong>Procurar Investidor:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                <input type="text" name="contrato" class="w3-round" placeholder="Por Contrato ..." style="width:20%; border:none; padding:5px;">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_investimundi_geral.php"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
                </div>
                <div class="w3-tag w3-round w3-blue" style="padding:3px">
                 <a href="investmundi_novo.php"><button class="w3-tag w3-round w3-blue w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Novo Contrato</button></a>
                </div>
                
                <?Php
                }
                ?>
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="19%" rowspan="2"style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Investidor</th>
            <th width="15%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Localidade</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Contatos</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Investimento</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Investidor</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Correspondente</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Status</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['rendimento_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['rendimento_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_bairro']); ?><br><?php echo strtoupper($verAssociado['afiliado_cidade']); ?>/<?php echo strtoupper($verAssociado['afiliado_estado']); ?><br></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_telefone']); ?> / <?php echo strtoupper($verAssociado['afiliado_celular']); ?><br><a href="mailto:<?php echo strtolower($verAssociado['afiliado_email']); ?>" style="text-decoration:none; cursor:pointer; color:blue"><?php echo strtolower($verAssociado['afiliado_email']); ?></a></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_investimento'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['rendimento_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
        <?Php
                if($permissao != "0"){
                    
                }else{
                ?>    
        <a href="investmundi_editar.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Editar Contrato <?php echo $produto['rendimento_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="investmundi_excluir.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['rendimento_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
         </a>
         <?Php
                }
                ?>
        
        
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
        <td colspan="6" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="6" style="text-align:right;">
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
</table> 
 
 
 
 
  
</div><br>


</body>
</html>


<?Php
}elseif($contrato != "" && $conta == ""){
$busca = "SELECT * FROM sps_rendimento WHERE rendimento_id='$contrato' ORDER BY rendimento_id DESC";

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

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Investidores: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                <strong>Procurar Investidor:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                <input type="text" name="contrato" class="w3-round" placeholder="Por Contrato ..." style="width:20%; border:none; padding:5px;">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                
                <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_investimundi_contrato.php?id=<?Php echo $contrato; ?>"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
                </div>
                <div class="w3-tag w3-round w3-blue" style="padding:3px">
                 <a href="investmundi_novo.php"><button class="w3-tag w3-round w3-blue w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Novo Contrato</button></a>
                </div>
                
                <?Php
                }
                ?>
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="19%" rowspan="2"style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Investidor</th>
            <th width="15%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Localidade</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Contatos</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Investimento</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Investidor</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Correspondente</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Status</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['rendimento_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['rendimento_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_bairro']); ?><br><?php echo strtoupper($verAssociado['afiliado_cidade']); ?>/<?php echo strtoupper($verAssociado['afiliado_estado']); ?><br></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_telefone']); ?> / <?php echo strtoupper($verAssociado['afiliado_celular']); ?><br><a href="mailto:<?php echo strtolower($verAssociado['afiliado_email']); ?>" style="text-decoration:none; cursor:pointer; color:blue"><?php echo strtolower($verAssociado['afiliado_email']); ?></a></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_investimento'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['rendimento_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
        
        <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
        <a href="investmundi_editar.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Editar Contrato <?php echo $produto['rendimento_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="investmundi_excluir.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['rendimento_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
       </a>
        <?Php
                }
                ?>
                
        
        
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
        <td colspan="6" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="6" style="text-align:right;">
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
</table> 
 
 
 
 
  
</div><br>


</body>
</html>


<?Php    
}elseif($contrato != "" && $conta != ""){

$busca = "SELECT * FROM sps_rendimento WHERE rendimento_id='$contrato' ORDER BY rendimento_id DESC"; 

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

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Investidores: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                <strong>Procurar Investidor:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                <input type="text" name="contrato" class="w3-round" placeholder="Por Contrato ..." style="width:20%; border:none; padding:5px;">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                
                <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_investimundi_contrato.php?id=<?Php echo $contrato; ?>"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
                </div>
                <div class="w3-tag w3-round w3-blue" style="padding:3px">
                 <a href="investmundi_novo.php"><button class="w3-tag w3-round w3-blue w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Novo Contrato</button></a>
                </div>
                
                <?Php
                }
                ?>
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="19%" rowspan="2"style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Investidor</th>
            <th width="15%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Localidade</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Contatos</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Investimento</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Investidor</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Correspondente</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Status</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['rendimento_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['rendimento_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_bairro']); ?><br><?php echo strtoupper($verAssociado['afiliado_cidade']); ?>/<?php echo strtoupper($verAssociado['afiliado_estado']); ?><br></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_telefone']); ?> / <?php echo strtoupper($verAssociado['afiliado_celular']); ?><br><a href="mailto:<?php echo strtolower($verAssociado['afiliado_email']); ?>" style="text-decoration:none; cursor:pointer; color:blue"><?php echo strtolower($verAssociado['afiliado_email']); ?></a></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_investimento'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['rendimento_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
        
        <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
        <a href="investmundi_editar.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Editar Contrato <?php echo $produto['rendimento_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="investmundi_excluir.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['rendimento_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        </a>
        <?Php
                }
                ?>
      
        
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
        <td colspan="6" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="6" style="text-align:right;">
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
</table> 
 
 
 
 
  
</div><br>


</body>
</html>


<?Php    
}elseif($contrato == "" && $conta != ""){


$busca = "SELECT * FROM sps_rendimento WHERE rendimento_afiliado_id='$conta' ORDER BY rendimento_id DESC"; 

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

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Investidores: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                <strong>Procurar Investidor:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                <input type="text" name="contrato" class="w3-round" placeholder="Por Contrato ..." style="width:20%; border:none; padding:5px;">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                
                <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_investimundi_conta.php?id=<?Php echo $conta;?>"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
                </div>
                <div class="w3-tag w3-round w3-blue" style="padding:3px">
                 <a href="investmundi_novo.php"><button class="w3-tag w3-round w3-blue w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Novo Contrato</button></a>
                </div>
                
                <?Php
                }
                ?>
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="19%" rowspan="2"style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Investidor</th>
            <th width="15%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Localidade</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Contatos</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Investimento</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Investidor</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Correspondente</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Status</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['rendimento_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['rendimento_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_bairro']); ?><br><?php echo strtoupper($verAssociado['afiliado_cidade']); ?>/<?php echo strtoupper($verAssociado['afiliado_estado']); ?><br></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_telefone']); ?> / <?php echo strtoupper($verAssociado['afiliado_celular']); ?><br><a href="mailto:<?php echo strtolower($verAssociado['afiliado_email']); ?>" style="text-decoration:none; cursor:pointer; color:blue"><?php echo strtolower($verAssociado['afiliado_email']); ?></a></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_investimento'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['rendimento_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
        
        <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
        <a href="investmundi_editar.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Editar Contrato <?php echo $produto['rendimento_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="investmundi_excluir.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['rendimento_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
         
        </a>
        
        <?Php
                }
                ?>
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
        <td colspan="6" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="6" style="text-align:right;">
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
</table> 
 
 
 
 
  
</div><br>


</body>
</html>
<?Php    
}
?>

</body>
</html>

<?Php
}else{
?>

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

  </style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
 
</head>
<body id="principal">


<div class="container-fluid">

<h2 class="w3-jumbo">Relatório Investmundi</h2>
<?php
$busca = "SELECT * FROM sps_rendimento ORDER BY rendimento_id DESC"; 

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

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Investidores: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                <strong>Procurar Investidor:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                <input type="text" name="contrato" class="w3-round" placeholder="Por Contrato ..." style="width:20%; border:none; padding:5px;">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                
                <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_investimundi_geral.php"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
                </div>
                <div class="w3-tag w3-round w3-blue" style="padding:3px">
                 <a href="investmundi_novo.php"><button class="w3-tag w3-round w3-blue w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Novo Contrato</button></a>
                </div>
                
                <?Php
                }
                ?>
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="19%" rowspan="2"style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Investidor</th>
            <th width="15%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Localidade</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Contatos</th>
            <th width="10%" rowspan="2"style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Investimento</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Investidor</th>
            <th colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Correspondente</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Status</th>
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['rendimento_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['rendimento_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_bairro']); ?><br><?php echo strtoupper($verAssociado['afiliado_cidade']); ?>/<?php echo strtoupper($verAssociado['afiliado_estado']); ?><br></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($verAssociado['afiliado_telefone']); ?> / <?php echo strtoupper($verAssociado['afiliado_celular']); ?><br><a href="mailto:<?php echo strtolower($verAssociado['afiliado_email']); ?>" style="text-decoration:none; cursor:pointer; color:blue"><?php echo strtolower($verAssociado['afiliado_email']); ?></a></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_investimento'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['rendimento_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
        
        <?Php
                if($permissao != "0"){
                    
                }else{
                ?>
                
        <a href="investmundi_editar.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Editar Contrato <?php echo $produto['rendimento_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="investmundi_excluir.php?id=<?php echo $produto['rendimento_id']; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['rendimento_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
          
        </a>
        
        <?Php
                }
                ?>
        
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
        <td colspan="6" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="6" style="text-align:right;">
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
</table> 
 
 
 
 
  
</div><br>


</body>
</html>
<?Php
}
?>