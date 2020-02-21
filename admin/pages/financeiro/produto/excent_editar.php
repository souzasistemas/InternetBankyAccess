<?Php
require "../../../../../config/config.php";
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

<h2 class="w3-xlarge">Editar Contrato Investteam</h2>

<table class="w3-table" width="100%">
    <tr>
        <td></td>
        
        
        <td style="text-align:right;">
            
                <div class="w3-tag w3-round w3-red" style="padding:3px">
                 <a href="excent.php"><button class="w3-tag w3-round w3-red w3-border w3-border-white" type="button"><i class="fa fa-money" aria-hidden="true"></i> Voltar</button></a>
                </div>
            
        </td>
    </tr>
</table>


    
<table class="w3-table-all w3-hoverable" width="100%">
   <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="17%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Investidor</th>
            <th width="20%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Plano</th>
            <th width="10%" colspan="8" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Aplicação</th>
            <th width="10%" rowspan="2" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">&nbsp;</th>
        </tr>
        <tr>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Bruto</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Taxa</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Líquido</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Rendim. Dia</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Ínicio</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Vencimento</th>
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Status</th>
        </tr>
    </thead>

<?Php
$id = $_GET['id'];
$emp = $_GET['emp'];
$sql = mysql_query("SELECT * FROM sps_excent WHERE excent_id='$id'"); 
$produto = mysql_fetch_array($sql);
?>

<form action="excent_editar_efetuar.php" method="post">
    <input name="id" type="hidden" value="<?php echo $id; ?>">
    <input name="emp" type="hidden" value="<?php echo $emp; ?>">
<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['excent_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;">
            <?php
                echo "<b>".$produto['excent_afiliado_id']."-";
                $idAssociado = $produto['excent_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                echo $verAssociado['afiliado_codigo_verificador']."</b><br>";
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
            }?>
        </td>
        <td style="text-align:center; vertical-align: middle;">
             <?Php
            $plano = $produto['excent_plano'];
            $sqlPlano = mysql_query("SELECT * FROM sps_planos_investimentos WHERE invest_id='$plano'");
            $verPlano = mysql_fetch_array($sqlPlano);
            
            echo "PLANO ".strtoupper($verPlano['invest_nome'])."<br>";
            echo number_format($verPlano['invest_rendimento']*100, 2, ',', '.')."% a.d. / ";
            echo number_format(($verPlano['invest_rendimento']*100)*20, 2, ',', '.')."% a.m. <br>";
            echo "<b>P: ".$produto['excent_protocolo']."</b>";
            ?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo number_format($produto['excent_valor_bruto'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo number_format($produto['excent_taxa_adm'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo number_format($produto['excent_valor_liquido'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo number_format($produto['excent_valor_residual'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['excent_data_contrato'];?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['excent_data_iniciar'];?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['excent_data_resgate'];?></td>
        <td style="text-align:center; vertical-align: middle;">
            <select class="w3-input w3-round w3-tag w3-white w3-border" name="status" required style="text-transform:uppercase; width:150px;">
                <option value="<?php echo strtoupper($produto['excent_status']); ?>"><?php echo strtoupper($produto['excent_status']); ?></option>
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