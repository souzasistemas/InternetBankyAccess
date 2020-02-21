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


<div class="container-fluid">

<h2 class="w3-jumbo">Editar Investmundi</h2>

<table class="w3-table" width="100%">
    <tr>
        <td></td>
        
        
        <td style="text-align:right;">
            
                <div class="w3-tag w3-round w3-red" style="padding:3px">
                 <a href="investmundi.php"><button class="w3-tag w3-round w3-red w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Voltar</button></a>
                </div>
            
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
            <th width="5%" rowspan="2"style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Opções</th>
        </tr>
        <tr>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">% diário</th>
            <th width="7.5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Valor</th>
        </tr>
    </thead>

<?Php
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM sps_rendimento WHERE rendimento_id='$id'"); 
$produto = mysql_fetch_array($sql);

if($produto['rendimento_investimento'] == ""){
?>


<form action="investimundi_editar_efetuar_valor.php" method="post">
    <input name="id" type="hidden" value="<?php echo $id; ?>">
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
        <td style="text-align:right; vertical-align: middle;"><input type="text" style="text-align:center;" class="w3-input w3-round w3-tag w3-white w3-border" onKeyPress="return(MascaraMoeda(this,'',',',event))" value="<?php echo number_format($produto['rendimento_valor'],2,",",".");?>" name="valor"></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;">
            <select class="w3-input w3-round w3-tag w3-white w3-border" name="status" required style="text-transform:uppercase; width:150px;">
                <option value="<?php echo strtoupper($produto['rendimento_status']); ?>"><?php echo strtoupper($produto['rendimento_status']); ?></option>
                <option value=""></option>
                <option value="Ativo">Ativo</option>
                <option value="Bloqueado">Bloqueado</option>
            </select>
            </td>
        <td style="text-align:right; vertical-align: middle;"><input type="submit" class="w3-input w3-green w3-round" value="Alterar" name="alterar"></td>
    </tr>
</tbody>
</form>  

<?Php
}else{
?>  




<form action="investimundi_editar_efetuar_rendimentos.php" method="post">
    <input name="id" type="hidden" value="<?php echo $id; ?>">
    
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
        <td style="text-align:right; vertical-align: middle;"><input type="text" style="text-align:center;" class="w3-input w3-round w3-tag w3-white w3-border" onKeyPress="return(MascaraMoeda(this,'',',',event))" value="<?php echo number_format($produto['rendimento_residual_afiliado_id'],2,",",".");?>" name="residual_investidor"></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor'],2,",",".");?></td>
        <td style="text-align:right; vertical-align: middle;"><input type="text" style="text-align:center;" class="w3-input w3-round w3-tag w3-white w3-border" onKeyPress="return(MascaraMoeda(this,'',',',event))" value="<?php echo number_format($produto['rendimento_residual_correspondente_id'],2,",",".");?>" name="residual_correspondente"></td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['rendimento_valor_correspondente'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;">
            <select class="w3-input w3-round w3-tag w3-white w3-border" name="status" required style="text-transform:uppercase; width:150px;">
                <option value="<?php echo strtoupper($produto['rendimento_status']); ?>"><?php echo strtoupper($produto['rendimento_status']); ?></option>
                <option value=""></option>
                <option value="Ativo">Ativo</option>
                <option value="Bloqueado">Bloqueado</option>
            </select>
        </td>
        <td style="text-align:right; vertical-align: middle;"><input type="submit" class="w3-input w3-green w3-round" value="Alterar" name="alterar"></td>
    </tr>
</tbody>
</form> 





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