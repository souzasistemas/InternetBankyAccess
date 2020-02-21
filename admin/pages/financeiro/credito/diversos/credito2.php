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
	document.getElementById('comissao').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='none';
	document.getElementById('repasse').style.display='none';
	document.getElementById('movimentacao').style.display='none';
}
function show_limite()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='block';
	document.getElementById('comissao').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='none';
	document.getElementById('repasse').style.display='none';
	document.getElementById('movimentacao').style.display='none';
}
function show_comissao()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='block';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='none';
	document.getElementById('repasse').style.display='none';
	document.getElementById('movimentacao').style.display='none';
}
function show_transferencia()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='block';
	document.getElementById('repasse').style.display='none';
	document.getElementById('movimentacao').style.display='none';
}
function show_repasse()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='none';
	document.getElementById('repasse').style.display='block';
	document.getElementById('movimentacao').style.display='none';
}
function show_movimentacao()
{
	document.getElementById('credito').style.display='none';
	document.getElementById('limite').style.display='none';
	document.getElementById('comissao').style.display='none';
	document.getElementById('vazio').style.display='none';
	document.getElementById('transferencia').style.display='none';
	document.getElementById('repasse').style.display='none';
	document.getElementById('movimentacao').style.display='block';
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
<h2>Entrada de Valores</h2>
</div>

<div class="col-sm-3">

<ul class="list-group">
  <li class="list-group-item list-group-item-success" onclick="show_comissao()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Comissão</li>    
  <li class="list-group-item list-group-item-success" onclick="show_credito()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Recarregar Cartão</li>
  <li class="list-group-item list-group-item-info" onclick="show_limite()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Limite Crédito</li>
  <li class="list-group-item list-group-item-warning" onclick="show_transferencia()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Transfererência entre Cartões</li>
  <li class="list-group-item list-group-item-default" onclick="show_movimentacao()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Inserir Movimentação - STONE</li>
  <li class="list-group-item list-group-item-default" onclick="show_repasse()" style="cursor:pointer;"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Repasse Estabelecimento</li>
</ul>


</div>


<div class="col-sm-9">
    
<div id="vazio" style="display:block;">
    <div class="well well-sm"><h3>Escolha a função</h3></div>
</div>


<div id="comissao" style="display:none">
<div class="well well-sm">
<h3>Comissão</h3>
<form action="credito_comissao_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"   /></td>
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

<div id="credito" style="display:none">
<div class="well well-sm">
<h3>Cr&eacute;dito/Recarga</h3>
<form action="credito_recarga_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"   /></td>
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









<div id="limite" style="display:none">
<div class="well well-sm">
<h3>Limite de Crédito</h3>
<form action="credito_limite_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;" colspan="3"><input class="form-control" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;" colspan="3"><input class="form-control" type="text" name="valor" required="required" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="hidden" name="descricao"  value="Disponibilizar Limite"/>Disponibilizar Limite</td>
    <td style="vertical-align:middle; width:5%;"><strong>Financiado?</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="radio" name="tipo" value="Sim" required />Sim <input type="radio" name="tipo" value="Não" required />Não</td>
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



<div id="transferencia" style="display:none">
<div class="well well-sm">
<h3>Realizar Transferência entre Cartões</h3>
<form action="credito_transferir_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:6%;"><strong>Nº da Conta à Debitar</strong></td>
    <td style="vertical-align:middle; width:28%;"><input class="form-control" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Nº da Conta à Creditar</strong></td>
    <td style="vertical-align:middle;"><input class="form-control" type="text" name="id2" size="50" required="required"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Informe Valor</strong></td>
    <td style="vertical-align:middle;"><input class="form-control" type="text" name="valor" required="required" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle;"><input class="form-control" type="hidden" name="descricao"  value="Transferencia entre Cartoes"/>Transferência entre Cartões</td>
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





<div id="repasse" style="display:none">
<div class="well well-sm">
<h3>Repasse Estabelecimento</h3>
<form action="credito_repasse_confirmar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Estabelecimento </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="loja" required="required"   /></td>
  </tr>    
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Nº da Conta </strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="id" required="required"   /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="valor" required="required" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Descri&ccedil;&atilde;o</strong></td>
    <td style="vertical-align:middle; width:30%;">Repasse Estabelecimento</td>
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






<div id="movimentacao" style="display:none">
<div class="well well-sm">
<h3>Inserir Movimentação - STONE</h3>
<form action="credito_movimentacao_efetuar.php" name="form" method="post">

<table border="0" cellspacing="5" cellpadding="2" class="table table-hover">
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Data da Venda</strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="dia1" required="required" maxlength="2" style="width:200px"/></td>
    <td style="vertical-align:middle; width:30%;"><select name="mes1" required="required" class="form-control" style="width:200px">
            <option value=""></option>
            <option value="01">JANEIRO</option>
            <option value="02">FEVEREIRO</option>
            <option value="03">MARÇO</option>
            <option value="04">ABRIL</option>
            <option value="05">MAIO</option>
            <option value="06">JUNHO</option>
            <option value="07">JULHO</option>
            <option value="08">AGOSTO</option>
            <option value="09">SETEMBRO</option>
            <option value="10">OUTUBRO</option>
            <option value="11">NOVEMBRO</option>
            <option value="12">DEZEMBRO</option>
        </select></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="ano1" required="required" maxlength="4"  style="width:200px"/></td>
    </td>
  </tr>
   <td style="vertical-align:middle; width:5%;"><strong>Data da Venda</strong></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="dia2" required="required" maxlength="2" style="width:200px"/></td>
    <td style="vertical-align:middle; width:30%;"><select name="mes2" required="required" class="form-control" style="width:200px">
            <option value=""></option>
            <option value="01">JANEIRO</option>
            <option value="02">FEVEREIRO</option>
            <option value="03">MARÇO</option>
            <option value="04">ABRIL</option>
            <option value="05">MAIO</option>
            <option value="06">JUNHO</option>
            <option value="07">JULHO</option>
            <option value="08">AGOSTO</option>
            <option value="09">SETEMBRO</option>
            <option value="10">OUTUBRO</option>
            <option value="11">NOVEMBRO</option>
            <option value="12">DEZEMBRO</option>
        </select></td>
    <td style="vertical-align:middle; width:30%;"><input class="form-control" type="text" name="ano2" required="required" maxlength="4"  style="width:200px" /></td>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Horario</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="time" class="form-control" name="hora" required="required" placeholder="" value="" autocomplete="off"  required="required" maxlength="8" style="width:200px"></td>
    <td style="vertical-align:middle; width:5%;"><strong>Autorização</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="protocolo" required="required" placeholder="" value="" autocomplete="off"  required="required" style="width:200px"></td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Modo</strong></td>
    <td style="vertical-align:middle; width:30%;">
        <select name="modo" required="required" class="form-control" style="width:200px">
            <option value=""></option>
            <option value="01">DÉBITO</option>
            <option value="02">CRÉDITO</option>
        </select>
    </td>
    <td style="vertical-align:middle; width:5%;"><strong>Cliente</strong></td>
    <td style="vertical-align:middle; width:30%;">
        <select name="cliente" required="required" class="form-control" style="width:200px">
            <option value=""></option>
            <option value="50">CLIENTE VISA</option>
            <option value="51">CLIENTE MASTER</option>
            <option value="52">CLIENTE ELO</option>
        </select>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:middle; width:5%;"><strong>Valor</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="valor" required="required" placeholder="" value="" autocomplete="off"  onKeyPress="return(MascaraMoeda(this,'',',',event))" onfocus="f_barra()" required="required" style="width:200px"></td>
    <td style="vertical-align:middle; width:5%;"><strong>POS</strong></td>
    <td style="vertical-align:middle; width:30%;"><input type="text" class="form-control" name="pos" required="required" placeholder="" value="" autocomplete="off"  required="required" style="width:200px"></td>
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