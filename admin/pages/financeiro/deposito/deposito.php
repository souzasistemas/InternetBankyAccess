<?Php
require "../../../../config/config.php";
$idPrincipal = $_GET['id'];

$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$idPrincipal'");
$ver = mysql_fetch_array($sql);
    $permissao = $ver['admin_permissao'];
    $emp = $ver['admin_empresa'];

                $sqlEmpresa = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$emp'");
                $verEmpresa = mysql_fetch_array($sqlEmpresa);
                
                if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
                    $nomeEmpresa = strtoupper($verEmpresa['afiliado_nome']);
                }elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
                    $nomeEmpresa = strtoupper($verEmpresa['afiliado_razao']);
                }   

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>INTERNET BANK ACCESS</title>
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
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- 	
<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>
-->

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
<div class="w3-container">
   
<h2 class="w3-xlarge w3-center"><b>SOLICITAÇÃO DE DEPÓSITOS</b></h2>

<hr class="w3-border-black">

<div class="w3-container">
<div class="well w3-light-gray">
    <?Php
    $sqlDeposito1A = mysql_query("SELECT * FROM sps_deposito WHERE deposito_modo='Transferencia' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $totalDeposito1A = mysql_num_rows($sqlDeposito1A);
    
    $sqlDeposito1B = mysql_query("SELECT sum(deposito_valor) FROM sps_deposito WHERE deposito_modo='Transferencia' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $verDeposito1B = mysql_fetch_array($sqlDeposito1B);
    $totalValorDeposito1B = $verDeposito1B['sum(deposito_valor)'];
    
    $sqlDeposito2A = mysql_query("SELECT * FROM sps_deposito WHERE deposito_modo='Boleto' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $totalDeposito2A = mysql_num_rows($sqlDeposito2A);
    
    $sqlDeposito2B = mysql_query("SELECT sum(deposito_valor) FROM sps_deposito WHERE deposito_modo='Boleto' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $verDeposito2B = mysql_fetch_array($sqlDeposito2B);
    $totalValorDeposito2B = $verDeposito2B['sum(deposito_valor)'];
    
    $sqlDeposito3A = mysql_query("SELECT * FROM sps_deposito WHERE deposito_modo='Paypal' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $totalDeposito3A = mysql_num_rows($sqlDeposito3A);
    
    $sqlDeposito3B = mysql_query("SELECT sum(deposito_valor) FROM sps_deposito WHERE deposito_modo='Paypal' AND deposito_status='Pendente' AND deposito_empresa='$emp'");
    $verDeposito3B = mysql_fetch_array($sqlDeposito3B);
    $totalValorDeposito3B = $verDeposito3B['sum(deposito_valor)'];
    
    $sqlDeposito4A = mysql_query("SELECT sum(deposito_tarifa) FROM sps_deposito WHERE deposito_status='Pendente' AND deposito_empresa='$emp'");
    $verDeposito4A = mysql_fetch_array($sqlDeposito4A);
    $totalValorDeposito4A = $verDeposito4A['sum(deposito_tarifa)'];
    
    $saldo = $totalValorDeposito1B + $totalValorDeposito2B + $totalValorDeposito3B - $totalValorDeposito4A;
    ?>
    <table class="w3-table" style="width:100%">
        <tr>
            <td style="text-align:left; vertical-align:middle;"><b>Total Depósito (<?Php echo $totalDeposito1A; ?>)</b></td>
            <td style="text-align:right; vertical-align:middle;">R$ <?php echo number_format($totalValorDeposito1B,2,",",".");?></td>
        </tr>
        <!-- <tr>
            <td style="text-align:left; vertical-align:middle;"><b>Total Boleto (<?Php echo $totalDeposito2A; ?>)</b></td>
            <td style="text-align:right; vertical-align:middle;">R$ <?php echo number_format($totalValorDeposito2B,2,",",".");?></td>
        </tr>
        <tr>
            <td style="text-align:left; vertical-align:middle;"><b>Total PayPal (<?Php echo $totalDeposito3A; ?>)</b></td>
            <td style="text-align:right; vertical-align:middle;">R$ <?php echo number_format($totalValorDeposito3B,2,",",".");?></td>
        </tr>
        <tr>
            <td style="text-align:left; vertical-align:middle;"><b>Total Taxas</b></td>
            <td style="text-align:right; vertical-align:middle;">R$ <?php echo number_format($totalValorDeposito4A,2,",",".");?></td>
        </tr>
        <tr>
            <td style="text-align:left; vertical-align:middle;"><b>Saldo Pendente</b></td>
            <td style="text-align:right; vertical-align:middle;">R$ <?php echo number_format($saldo,2,",",".");?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left; vertical-align:middle;">&nbsp;</td>
        </tr>-->
        <tr>
            <td colspan="2" style="text-align:left; vertical-align:middle;">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
                    <input type="hidden" name="numero" value="Pesquisar">
                    <input type="hidden" name="idValido" value="<?Php echo $id; ?>">
                    
                    <div class="input-group input-group-lg" style="width:100%">
                        <input type="text" name="codigo" class="form-control" placeholder="Pesquisar Conta ...">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </table>
</div>
</div>

<div class="w3-container" style="margin-top: -10px;">

<?Php
if(isset($_POST['numero'])){
    $codigo = $_POST['codigo'];
    
if($codigo == ""){
?>
<div class="w3-panel w3-pale-red w3-border w3-border w3-display-container">
    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>Digite o Número da Conta</h3>
</div>
<?Php
}else{

$busca = "SELECT * FROM sps_deposito WHERE deposito_status='Pendente' AND deposito_afiliado_id='$codigo'";

$total_reg = "1000";

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
?>

<div class="w3-container-fluid" style="font-size: 12px; margin-top:10px;">

<table class="w3-table w3-striped w3-bordered w3-hoverable" style="width:100%;">
    <thead style="background-color:#000; color:#fff;">
        <tr>
            <th style="text-align:left; vertical-align: middle; width:80%;">Dados da Conta</th>
            <th style="text-align:center; vertical-align: middle; width:10%;">&nbsp;</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) { 

$empresa = $produto['deposito_empresa'];
$idAfiliado = $codigo;

$sqlEmpresa = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$empresa'");
$verEmpresa = mysql_fetch_array($sqlEmpresa);

if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
    $nomeEmpresa = $verEmpresa['afiliado_nome'];
}elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
    $nomeEmpresa = $verEmpresa['afiliado_razao'];
}

$sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
$verAfiliado = mysql_fetch_array($sqlAfiliado);

if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $verAfiliado['afiliado_nome'];
}elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $verAfiliado['afiliado_razao'];
}

$idDeposito = $produto['deposito_id'];
$sqlDeposito5A = mysql_query("SELECT * FROM sps_deposito WHERE deposito_id='$idDeposito'");
$verDeposito5A = mysql_fetch_array($sqlDeposito5A);
?>

<tbody style="font-size:12px;">
    <tr>
        <td style="text-align:left; vertical-align: middle; color:#444">
            <b>Pedido:</b> # <?Php echo $produto['deposito_id']; ?><br>
            <b>Conta: </b><?Php echo $idAfiliado; ?>-<?Php echo $verAfiliado['afiliado_codigo']; ?><br>
            <b>Favorecido: </b><?Php echo $nomeAfiliado; ?><br>
            <b>Valor à Creditar:</b> <?Php echo number_format($verDeposito5A['deposito_valor'],2,",",".");?>
        </td>
        
        <td style="text-align:center; vertical-align: middle;"><a href="deposito_baixa.php?deposito=<?Php echo $idDeposito; ?>&&id=<?Php echo $idPrincipal; ?>&&empresa=<?Php echo $emp; ?>"><button class="w3-green w3-padding w3-button w3-round w3-card" type="button"><i class="fas fa-check-square w3-text-white" style="font-size:20px;"></i> Creditar</button></a></td>
        
    </tr>
</tbody>
<?Php
    }
    
$anterior = $pc - 1;
$proximo = $pc + 1;

if($pc == "1"){
    
}else{
?>

    <tr>
        <td colspan="5" style="text-align:center; font-size:10px">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
    <?Php
}
?>
</table> 
<?Php
}
?>

<?Php
}else{

$busca = "SELECT * FROM sps_deposito WHERE deposito_status='Pendente' AND deposito_empresa='$emp'"; 

$total_reg = "1000";

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
?>

<div class="w3-container-fluid" style="font-size: 12px; margin-top:10px;">

<table class="w3-table w3-striped w3-bordered w3-hoverable" style="width:100%;">
    <thead style="background-color:#000; color:#fff;">
        <tr>
            <th style="text-align:left; vertical-align: middle; width:90%;">Dados da Conta</th>
            <th style="text-align:center; vertical-align: middle; width:10%;">&nbsp;</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) { 

$empresa = $produto['deposito_empresa'];
$idAfiliado = $produto['deposito_afiliado_id'];

$sqlEmpresa = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$empresa'");
$verEmpresa = mysql_fetch_array($sqlEmpresa);

if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
    $nomeEmpresa = $verEmpresa['afiliado_nome'];
}elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
    $nomeEmpresa = $verEmpresa['afiliado_razao'];
}

$sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
$verAfiliado = mysql_fetch_array($sqlAfiliado);

if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $verAfiliado['afiliado_nome'];
}elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $verAfiliado['afiliado_razao'];
}

$idDeposito = $produto['deposito_id'];
$sqlDeposito5A = mysql_query("SELECT * FROM sps_deposito WHERE deposito_id='$idDeposito'");
$verDeposito5A = mysql_fetch_array($sqlDeposito5A);
?>

<tbody style="font-size:12px;">
    <tr>
        <td style="text-align:left; vertical-align: middle; color:#444">
            <b>Pedido:</b> # <?Php echo $produto['deposito_id']; ?><br>
            <b>Conta: </b><?Php echo $idAfiliado; ?>-<?Php echo $verAfiliado['afiliado_codigo']; ?><br>
            <b>Favorecido: </b><?Php echo $nomeAfiliado; ?><br>
            <b>Valor à Creditar:</b> <?Php echo number_format($verDeposito5A['deposito_valor'],2,",",".");?>
        </td>
        
        <td style="text-align:center; vertical-align: middle;"><a href="deposito_baixa.php?deposito=<?Php echo $idDeposito; ?>&&id=<?Php echo $idPrincipal; ?>&&empresa=<?Php echo $emp; ?>"><button class="w3-green w3-padding w3-button w3-round w3-card" type="button"><i class="fas fa-check-square w3-text-white" style="font-size:20px;"></i> Creditar</button></a></td>
        
    </tr>
</tbody>
<?Php
    }
    
$anterior = $pc - 1;
$proximo = $pc + 1;

if($pc == "1"){
    
}else{
?>

    <tr>
        <td colspan="6" style="text-align:center; font-size:10px">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
    <?Php
}
?>
</table> 
<?Php
}
?>
<br><br>

</div>




</div>   
</body>
</html>   
