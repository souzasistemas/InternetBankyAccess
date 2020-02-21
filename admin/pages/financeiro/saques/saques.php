<?php
$id = $_GET['id'];
?>
<!DOCTYPE html>
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

  </style>

 
</head>
<body id="principal">
    
<div class="w3-container">

<?Php 
require "../../../../config/config.php";
$id = $_GET['id'];

$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysql_fetch_array($sql);
    $empresa = $ver['admin_empresa'];
$sqlTotal = mysql_query("SELECT sum(extrato_valor), extrato_id FROM sps_extrato WHERE extrato_status_saque='Pendente' AND extrato_empresa='$empresa'");
$verTotal = mysql_fetch_array($sqlTotal);

if($verTotal['extrato_id'] == ""){
?>

<div class="w3-panel w3-cyan w3-center w3-text-white w3-round">
  <h3><b>MEUS PARABÉNS!</b></h3>
  <p>Não existe soliciação de DOC/TED!</p>
</div> 

<?Php
}else{
?>

<h2 class="w3-xlarge w3-center">Relatório Saques Pendentes</h2>
<hr class="w3-border-black">    

<div class="w3-quarter w3-padding"><b>Total </b>
    <div class="w3-tag w3-round w3-green w3-right" style="padding:3px">
        <div class="w3-tag w3-round w3-green w3-border w3-border-white">R$ <?Php echo number_format($verTotal['sum(extrato_valor)'],2,",","."); ?></div>
    </div>
</div>

<div class="w3-half w3-padding">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form">
<input type="hidden" name="numero" value="Pesquisar">
<div class="w3-threequarter" style="margin-bottom:10px;"><input type="text" name="codigo" class="w3-round w3-input w3-border" placeholder="Pesquisar por Conta (Sem Dígito) ..." style="padding:5px; width:99%;"></div>
<div class="w3-quarter w3-right">
<div class="w3-tag w3-round w3-green" style="padding:3px;width:100%;">
<button style="width:100%;" class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit">Buscar</button>
</div>
</div>

</form>
</div>

<div class="w3-quarter w3-padding">
    <div class="w3-tag w3-round w3-light-green" style="padding:3px;width:100%;">
        <a href="gerar_excel.php"><button style="width:100%;" class="w3-tag w3-round w3-light-green w3-border w3-border-white w3-text-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell</button></a>
    </div>
</div>            

<?Php


if(isset($_POST['numero'])){
}else{
?>




<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="50%" style="background-color:#444; color:#fff; text-align:left; vertical-align:middle;">Dados do DOC/TED</th>
            <th width="50%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Opções</th>
        </tr>
    </thead>
    
<?php
$busca = "SELECT * FROM sps_retiradas WHERE retirada_status='Pendente' AND retirada_empresa='$empresa' ORDER BY retirada_id ASC"; 

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
while ($produto = mysql_fetch_array($limite)) {
?> 

<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <?Php
            $idConta = $produto['retirada_afiliado_id'];
            $sqlConta = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idConta' AND afiliado_empresa='$empresa'");
            $verConta = mysql_fetch_array($sqlConta);

            if($verConta['afiliado_conta_modo'] == "Fisica"){
                $nome = strtoupper($verConta['afiliado_nome']);
                $documento = $verConta['afiliado_cpf'];
            }elseif($verConta['afiliado_conta_modo'] == "Juridica"){
                $nome = strtoupper($verConta['afiliado_razao']);
                $documento = $verConta['afiliado_cnpj'];
            }
            
            $idBanco = $verConta['afiliado_banco'];
		    $sqlbanco = mysql_query("SELECT * FROM sps_bancos WHERE banco_id='$idBanco'");
		    $verbanco = mysql_fetch_array($sqlbanco);
            
            if($produto['retirada_nacao'] == "BRASIL"){
                $nomeDocumento = "CPF/CNPJ: ";
                $dadosBancarios = "
                <b>Banco:</b> ".$verbanco['banco_codigo']." - ".$verbanco['banco_nome']."<br>
                <b>Tipo:</b> Conta ".$verConta['afiliado_tipo_conta']."<br>
                <b>Agência:</b> ".$verConta['afiliado_agencia']."<br>
                <b>Conta Bancária:</b> ".$verConta['afiliado_conta']."<br>
                ";
            }else{
                $nomeDocumento = "Documento Identificação / Passaporte: ";
                $dadosBancarios = "
                <b>Iban: </b>".$produto['retirada_iban']."<br>
                <b>Swift: </b>".$produto['retirada_swift']."<br>
                ";
            }
            
            ?>
            <b>Favorecido:</b> 
            <?Php echo $nome; ?> 
            <?Php echo "(".$idConta."-".$verConta['afiliado_codigo'].")<br>"; ?>
            <b><?Php echo $nomeDocumento; ?></b>
            <?Php echo $documento; ?><br>
            <?Php echo $dadosBancarios; ?>
            <b>Valor Solicitado: <span class="w3-text-red">R$ <?php echo number_format($produto['retirada_valor'],2,",",".");?></span></b><br>
            <b>Data para Repasse:  <span class="w3-text-red"><?php echo $produto['retirada_previsao'];?></span></b><br>
            <b>Solicitação em: </b> <?php echo $produto['retirada_dia'];?>/<?php echo $produto['retirada_mes'];?>/<?php echo $produto['retirada_ano'];?> às <?php echo $produto['retirada_hora'];?><br>
            
        </td>
        <td style="text-align:right; vertical-align: middle;">
            <a class="botao" href="baixa_saque.php?codigo=<?php echo $produto['retirada_id']; ?>&&id=<?Php echo $id; ?>" title="Dar Baixa Saque"><i class="fa fa-check-square" style="color:green; font-size:30px; padding-right:5px;" aria-hidden="true"></i></a>
            <a class="botao" href="cancelar_saque.php?codigo=<?php echo $produto['retirada_id']; ?>&&id=<?Php echo $id; ?>" title="Cancelar Saque"><i class="fa fa-window-close" style="color:red; font-size:30px;" aria-hidden="true"></i></a>
        </td>
    </tr>
</tbody>

<?Php
}
}
}
?>

</div><br><br>
</body>
</html>