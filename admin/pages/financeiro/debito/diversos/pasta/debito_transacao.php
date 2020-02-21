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

<div class="w3-container">
    <h2 class="w3-xxx-large botao">Realizar Transação TEFI</h2>


<hr class="w3-border-black">    


<form action="debito_transacao_confirmar.php" name="form" method="post">
<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:6%; border:none;"><strong>Estabelecimento </strong></td>
    <td style="vertical-align:middle; width:28%; border:none;" colspan="3"><input type="text" class="w3-input w3-border w3-round w3-padding-16" name="idLoja" size="50" required="required"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Informe Valor</strong></td>
    <td style="vertical-align:middle;" colspan="3"><input class="w3-input w3-border w3-round w3-padding-16" type="text" name="valor" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Modo</strong></td>
    <td style="vertical-align:middle;"><input type="radio" name="modo" style="width:20px; padding:10px;" value="1"   class="w3-radio" required="required"   /> <span class="w3-large">Crédito</span>  
    <input type="radio" name="modo" style="width:20px; padding:10px;" value="2" required="required"    class="w3-radio" /> <span class="w3-large">Débito</span></td>
    <td style="vertical-align:middle; width:150px; "><strong>Quantas Parcelas?</strong></td>
    <td style="vertical-align:middle;"><select name="parcelaCredito" class="w3-input w3-border w3-round w3-padding-16" required="required" >
    	<option value="01">01 PARCELA</option>
    	<option value="02">02 PARCELAS</option>
    	<option value="03">03 PARCELAS</option>
    	<option value="04">04 PARCELAS</option>
    	<option value="05">05 PARCELAS</option>
    	<option value="06">06 PARCELAS</option>
    	<option value="07">07 PARCELAS</option>
    	<option value="08">08 PARCELAS</option>
    	<option value="09">09 PARCELAS</option>
    	<option value="10">10 PARCELAS</option>
    	<option value="11">11 PARCELAS</option>
    	<option value="12">12 PARCELAS</option>
    <select></td>
  
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;" colspan="3"><input class="w3-input w3-border w3-round w3-padding-16" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td colspan="4"><br />
    <button name="inserir" class="btn btn-primary btn-lg" type="submit"><i class="glyphicon glyphicon-ok"></i> Avançar</button>
    <button name="limpar" class="btn btn-warning btn-lg"type="reset"><i class="glyphicon glyphicon-ok"></i> Limpar</button>
    </td>
    </tr>
</table>
</form>

</div>
</body>
</html>