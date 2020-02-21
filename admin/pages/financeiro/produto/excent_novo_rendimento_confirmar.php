<?Php
require "../../../../../config/config.php";
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
<div class="container" style="text-align:left; width:600px;">
<center>

<?Php
$emp = $_POST['emp'];
$id = $_POST['id'];
$contrato = $_POST['contrato'];
$valorCrypt = $_POST['valor'];
$valor = preg_replace(array("/(,)/"),explode(" ","."),strtoupper($valorCrypt));

$dias = $_POST['dias'];
    
$total =  $valor * $dias;  

$sqlContrato = mysql_query("SELECT * FROM sps_excent WHERE excent_id='$contrato' AND excent_empresa='$emp'");
$verContrato = mysql_fetch_array($sqlContrato);
    $idAfiliado = $verContrato['excent_afiliado_id'];
    
$sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
$verAfiliado = mysql_fetch_array($sqlAfiliado);

if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
    $nome = $verAfiliado['afiliado_nome'];
}elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
    $nome = $verAfiliado['afiliado_razao'];
}

if($idAfiliado != ""){  
?>

<table class="table">
    <tr>
        <td><b>Contrato</b></td>
        <td>#<?Php echo $contrato; ?></td>
    </tr>
    <tr>
        <td><b>Conta</b></td>
        <td><?Php echo $idAfiliado; ?>-<?Php echo $verAfiliado['afiliado_codigo_verificador']; ?></td>
    </tr>
    <tr>
        <td><b>Nome</b></td>
        <td><?Php echo $nome; ?></td>
    </tr>
    <tr>
        <td><b>Valor Rendimento</b></td>
        <td>R$ <?php echo number_format($valor,2,",","."); ?></td>
    </tr>
    <tr>
        <td><b>Total dias para lancamento</b></td>
        <td><?php echo $dias; ?> dia(s)</td>
    </tr>
    <tr>
        <td><b>Valor Total para lancamento</b></td>
        <td>R$ <?php echo number_format($total,2,",","."); ?></td>
    </tr>
</table>

<br><br>
Os dados acima estão corretos? <br><br>

<center>
<form action="excent_novo_rendimento_efetuar.php" name="form" method="post">
    
  <input name="afiliado" type="hidden" value="<?Php echo $idAfiliado; ?>">
  <input name="id" type="hidden" value="<?Php echo $id; ?>">
  <input name="contrato" type="hidden" value="<?Php echo $contrato; ?>">
  <input name="emp" type="hidden" value="<?Php echo $emp; ?>">
  <input name="valor" type="hidden" value="<?Php echo $total; ?>">
  
   <center>
   <input name="avancar" type="button" id="avancar" onClick="history.back(-1);" class="btn btn-danger btn-lg" value="Não, Corrigir " style="font-size:20px;"> | 
   <input name="Submit" type="submit" id="avancar" class="btn btn-success btn-lg" value="Sim, Avançar" style="font-size:20px;">
   </center>
  </form>
</center>

<?Php
}else{
?>

<div class="alert alert-danger">
  <strong>Atenção!</strong> Contrato não localizado.
</div>

<center>
    <button class="w3-button w3-red w3-round w3-padding-16" onClick="history.back(-1)">Voltar</button>
</center>


<?Php
}
?>
</body>
</html>