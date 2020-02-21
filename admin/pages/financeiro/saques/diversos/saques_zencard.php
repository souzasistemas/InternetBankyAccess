<?Php require "../../../../../config/config.php";   ?>

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

<h2 class="w3-jumbo">Relatório de Saques Pendentes</h2>
<?php

$busca = "SELECT * FROM sps_extrato WHERE extrato_status_saque='Pendente' AND extrato_modo_saque='Zencard' ORDER BY extrato_id ASC"; 

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

$sqlTotal = mysql_query("SELECT sum(extrato_valor), extrato_id FROM sps_extrato WHERE extrato_status_saque='Pendente' AND extrato_modo_saque='Zencard'");
$verTotal = mysql_fetch_array($sqlTotal);

function somar_data($data, $dias, $meses, $ano){
    $data = explode("/", $data);
    $resData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
    return $resData;
}

?> 

<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total de Saques Pendentes: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white">R$ <?Php echo number_format($verTotal['sum(extrato_valor)'],2,",","."); ?></div>
            </div></td>
        
        
        <td style="text-align:right;">
            
            <form action="saques.php" method="post" name="form">
                <strong>Pesquisar:</strong> &nbsp;
                <input type="hidden" name="numero" value="Pesquisar">
                <input type="text" name="codigo" class="w3-round" placeholder="Por Conta ..." style="width:20%; border:none; padding:5px;">
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                  <button class="w3-tag w3-round w3-green w3-border w3-border-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                <div class="w3-tag w3-round w3-green" style="padding:3px">
                 <a href="gerar_excel_zencard.php"><button class="w3-tag w3-round w3-green w3-border w3-border-white" type="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Gerar Excell Zencard</button></a>
                </div>
                <div class="w3-tag w3-round w3-deep-orange" style="padding:3px">
                 <a href="saques_banco.php"><button class="w3-tag w3-round w3-deep-orange w3-border w3-border-white" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i> Filtrar por Banco</button></a>
                </div>
                <div class="w3-tag w3-round w3-deep-orange" style="padding:3px">
                 <a href="saques_zencard.php"><button class="w3-tag w3-round w3-deep-orange w3-border w3-border-white" type="button"><i class="fa fa-bullseye" aria-hidden="true"></i> Filtrar por Zencard</button></a>
                </div>
                
            </form>
            
        </td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Conta</th>
            <th width="25%" style="background-color:#444; color:#fff; text-align:left; vertical-align: middle;">Associado</th>
            <th width="10%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">CPF/CNPJ</th>
            <th width="30%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Modo de Recebimento</th>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Valor</th>
            <th width="15%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Solicitado</th>
            <th width="5%" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Previsão</th>
            <th width="5%" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">Opções</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
    
                $dia = $produto['extrato_dia'];
                $mes = $produto['extrato_mes'];
                $ano = $produto['extrato_ano'];
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['extrato_afiliado_id']; ?></td>
        <td style="text-align:left; vertical-align: middle;">
             <?php
             
                $idAssociado = $produto['extrato_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $documento = $verAssociado['afiliado_cpf'];
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $documento = $verAssociado['afiliado_cnpj'];
                    echo strtoupper($verAssociado['afiliado_razao']);
                }?>
        </td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $documento; ?><br></td>
        <td style="text-align:center; vertical-align: middle;">
            <?Php
        
        $idAfiliadoBanco = $produto['extrato_afiliado_id'];
        
       
		$sqlSaqueAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliadoBanco'");
		$verSaqueAfiliado = mysql_fetch_array($sqlSaqueAfiliado);
		
		    $vencimento = somar_data("$dia/$mes/$ano", 5, 0, 0);
		?>
        <strong>ZENCARD</strong> <br><?php echo $verSaqueAfiliado['afiliado_zencard']; ?><br />
		<?Php
        
        
		?>
        </td>
        <td style="text-align:right; vertical-align: middle;"><?php echo number_format($produto['extrato_valor'],2,",",".");?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $produto['extrato_dia'];?>/<?php echo $produto['extrato_mes'];?>/<?php echo $produto['extrato_ano'];?> às <?php echo $produto['extrato_hora'];?></td>
        <td style="text-align:center; vertical-align: middle;"><?php echo $vencimento;?></td>
        <td style="text-align:right; vertical-align: middle;">
        <a class="botao" href="baixa_saque.php?codigo=<?php echo $produto['extrato_id']; ?>" title="Dar Baixa Saque"><i class="fa fa-check-square" style="color:green; font-size:30px; padding-right:5px;" aria-hidden="true"></i></a>
        <a class="botao" href="cancelar_saque.php?codigo=<?php echo $produto['extrato_id']; ?>" title="Cancelar Saque"><i class="fa fa-window-close" style="color:red; font-size:30px;" aria-hidden="true"></i></a>  
        </a>
        
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
 
 
 
 
  
</div><br><br><br><br>


</body>
</html>
