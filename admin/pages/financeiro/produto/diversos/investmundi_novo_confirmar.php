<?Php
require "../../../config/config.php";
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
  
 

<script language="javascript">
//-----------------------------------------------------
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>

 
</head>

<body id="principal">
<br><br><br><br>
<center><h2 class="w3-jumbo">Inserir Novo Contrato Investimundi</h2></center>

<div class="container" style="text-align:left; width:600px;">


<?php
require "../../../config/config.php"; 

$conta = $_POST['conta'];
$valorCrypt= $_POST['valor'];
$residualCrypt = $_POST['residual'];
$residualCrypt1 = $_POST['residual1'];

$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));
$residual = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($residualCrypt));
$residual1 = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($residualCrypt1));

$percentual = $residual / 100;
$percentual1 = $residual1 / 100;

$rendimento = $valor * $percentual;
$rendimento1 = $valor * $percentual1;

$descricao = "RESIDUAL INVESTIMUNDI / POUPBRASIL";

$sql = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$conta'");
$ver = mysql_fetch_array($sql);
    $id2 = $ver['afiliado_indicador'];
	
	if($ver['afiliado_conta_modo'] == "Fisica"){
       $nome = strtoupper($ver['afiliado_nome']);
    }elseif($ver['afiliado_conta_modo'] == "Juridica"){
       $nome = strtoupper($ver['afiliado_nome']);
    }
	
	
$sql2 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$id2'");
$ver2 = mysql_fetch_array($sql2);
	
	if($ver2['afiliado_conta_modo'] == "Fisica"){
       $nome2 = strtoupper($ver2['afiliado_nome']);
    }elseif($ver2['afiliado_conta_modo'] == "Juridica"){
       $nome2 = strtoupper($ver2['afiliado_nome']);
    }
    
?>

<strong>Dados do Investimento</strong><br /><br />
<strong>Investidor:</strong> <?Php echo "(".strtoupper($conta).") ".$nome.""; ?><br />
<strong>Correspondente:</strong> <?Php echo "(".strtoupper($id2).") ".$nome2.""; ?><br /><br />
<strong>Valor do Investimento:</strong> <?Php echo "R$ ".number_format($valor,2,",",".").""; ?><br /><br />
<strong>Residual Investidor:</strong> <?Php echo number_format($residual,2,",",".").""; ?>% - R$ <?Php echo number_format($rendimento,2,",",".").""; ?><br />
<strong>Residual Correspondente:</strong> <?Php echo number_format($residual1,2,",",".").""; ?>% - R$ <?Php echo number_format($rendimento1,2,",",".").""; ?><br /><br>

<strong>Descri&ccedil;&atilde;o:</strong> <?Php echo "".$descricao.""; ?><br /><br />

<strong>As Informações acima estão corretas ?</strong><br /><br />

<form action="investmundi_novo_efetuar.php" method="post" name="form">
<input type="hidden" name="id" value="<?Php echo $conta; ?>" />
<input type="hidden" name="id2" value="<?Php echo $id2; ?>" />
<input type="hidden" name="valor" value="<?Php echo $valor; ?>" />
<input type="hidden" name="residual" value="<?Php echo $residual; ?>" />
<input type="hidden" name="residual1" value="<?Php echo $residual1; ?>" />
<input type="hidden" name="rendimento" value="<?Php echo $rendimento; ?>" />
<input type="hidden" name="rendimento1" value="<?Php echo $rendimento1; ?>" />
<input type="hidden" name="descricao" value="<?Php echo $descricao; ?>" />

<button name="inserir" class="btn btn-success btn-lg" type="submit">Sim</button> | 
<a href="javascript:location.href='investmundi.php';"><button name="limpar" class="btn btn-danger btn-lg" type="button">N&atilde;o</button></a>
</form>



</body>
</html>