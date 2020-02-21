<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<script type="text/javascript" src="../js/mascara.js"></script>

<script language="javascript">
function show_credito()
{
	document.getElementById('credito').style.display='block';
	document.getElementById('limite').style.display='none';
	document.getElementById('loja').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('saque').style.display='none';
}
function show_limite()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='block';
	document.getElementById('loja').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('saque').style.display='none';
}
function show_loja()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('loja').style.display='block';
	document.getElementById('vazio').style.display='none';
	document.getElementById('saque').style.display='none';
}
function show_saque()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('loja').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('saque').style.display='block';
}
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

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<div class="col-sm-12" style="text-align:center;">
<h2>Saída de Valores</h2>
</div>

<div class="col-sm-3">

<ul class="list-group">
  <li class="list-group-item list-group-item-success" onclick="show_credito()" style="cursor:pointer;"><i class="glyphicon glyphicon-minus-sign" aria-hidden="true"></i> Retirar Valor</button></li>
  <li class="list-group-item list-group-item-success" onclick="show_saque()" style="cursor:pointer;"><i class="glyphicon glyphicon-minus-sign" aria-hidden="true"></i> Realizar Saque</button></li>
  <li class="list-group-item list-group-item-info" onclick="show_limite()" style="cursor:pointer;"><i class="glyphicon glyphicon-minus-sign" aria-hidden="true"></i> Débito Programado</button></li>
  <li class="list-group-item list-group-item-warning" onclick="show_loja()" style="cursor:pointer;"><i class="glyphicon glyphicon-minus-sign" aria-hidden="true"></i> Terminal TEFI</button></li>
</ul>
</div>


<div class="col-sm-9">
    
<div id="vazio" style="display:block;">
    <div class="well well-sm"><h3>Escolha a função</h3></div>
</div>

<div id="credito" style="display:none">
<div class="well well-sm">
<h3>Retirar Saldo</h3>
<form action="debito_retirar_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="valor" required="required" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle; width:30%;"><textarea class="form-control" name="descricao" cols="40" rows="2" style="text-transform:uppercase;" required="required"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><br />
    <button name="inserir" class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-ok"></i> Avançar</button>
    <button name="limpar" class="btn btn-default btn-sm"type="reset"><i class="glyphicon glyphicon-ok"></i> Limpar</button>
    </td>
    </tr>
</table>
</form>
</div>
</div>






<div id="saque" style="display:none">
<div class="well well-sm">
<h3>Solicitação de Saque</h3>
<form action="debito_saque_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="valor" required="required" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
   <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Taxa</strong></td>
    <td style="vertical-align:middle; width:30%;">
        <input type="radio" name="taxa" required="required" placeholder="" value="10" autocomplete="off" onfocus="f_barra()" required="required"> R$ 10,00
        <input type="radio" name="taxa" required="required" placeholder="" value="15" autocomplete="off" onfocus="f_barra()" required="required"> R$ 15,00
    </td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle; width:30%;">SOLICITAÇÃO DE SAQUE</textarea></td>
  </tr>
  <tr>
    <td colspan="2"><br />
    <button name="inserir" class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-ok"></i> Avançar</button>
    <button name="limpar" class="btn btn-default btn-sm"type="reset"><i class="glyphicon glyphicon-ok"></i> Limpar</button>
    </td>
    </tr>
</table>
</form>
</div>
</div>









<div id="limite" style="display:none">
<div class="well well-sm">
<h3>Débito Programado</h3>
<form action="debito_programado_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" required="required" type="text" name="valor" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle; width:30%;"><textarea class="form-control" style="text-transform:uppercase;" name="descricao" cols="40" rows="2" required="required"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><br />
    <button name="inserir" class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-ok"></i> Avançar</button>
    <button name="limpar" class="btn btn-default btn-sm"type="reset"><i class="glyphicon glyphicon-ok"></i> Limpar</button>
    </td>
    </tr>
</table>
</form>
</div>
</div>



<div id="loja" style="display:none">
<div class="well well-sm">
<h3>Inserir Venda</h3>
<form action="debito_venda_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
    
  <tr>
    <td style="vertical-align:middle; width:6%;"><strong>Estabelecimento </strong></td>
    <td style="vertical-align:middle; width:28%;" colspan="3"><input type="text" class="form-control" name="idLoja" size="50" required="required"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Informe Valor</strong></td>
    <td style="vertical-align:middle;"><input class="form-control" type="text" name="valor" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
    <td style="vertical-align:middle;"><strong>Modo</strong></td>
    <td style="vertical-align:middle;"><input type="radio" name="modo" style="width:20px; padding:10px;" value="1"   class="buttom2" required="required"   />Crédito  <input type="radio" name="modo" style="width:20px; padding:10px;" value="2" required="required"    class="buttom2" />Débito</td>
  </tr>
   <tr>
    <td style="vertical-align:middle;"><strong>Parcela</strong></td>
    <td style="vertical-align:middle;" colspan="3"><select name="parcelaCredito" class="form-control" required="required" >
    	<option value="1">01 X</option>
    	<option value="2">02 X</option>
    	<option value="3">03 X</option>
    	<option value="4">04 X</option>
    	<option value="5">05 X</option>
    	<option value="6">06 X</option>
    <select></td>
  
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;" colspan="3"><input class="form-control" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td colspan="4"><br />
    <button name="inserir" class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-ok"></i> Avançar</button>
    <button name="limpar" class="btn btn-default btn-sm"type="reset"><i class="glyphicon glyphicon-ok"></i> Limpar</button>
    </td>
    </tr>
</table>

</form>
</div>
</div>

</div>
</body>
</html>