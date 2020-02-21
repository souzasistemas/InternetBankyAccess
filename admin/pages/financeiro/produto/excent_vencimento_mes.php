<?Php
require "../../../../../config/config.php";
$idPrincipal = $_GET['id'];

if($idPrincipal == ""){
    $id = $_POST['idValido'];
}else{
    $id = $idPrincipal;
}    
$sql = mysql_query("SELECT * FROM sps_admin WHERE admin_id='$id'");
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

 
</head>
<body id="principal">
<div class="container-fluid">
    <br>
<h2 class="w3-xlarge"><b>RELATÓRIO CONTRATOS COM VENCIMENTO MÊS ATUAL DA EMPRESA <?Php echo $nomeEmpresa; ?></b></h2><BR><BR>


<?Php

date_default_timezone_set('Brazil/East');
$mes = date('m');
$ano = date('Y');

$busca = "SELECT * FROM sps_excent WHERE excent_empresa='$emp' AND excent_data_resgate_mes='$mes' AND excent_data_resgate_ano='$ano' ORDER BY excent_id DESC"; 

$total_reg = "100";

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
?>

<table class="w3-table-all w3-hoverable" width="100%" style="font-size:11px;">
    <thead>
        <tr>
            <th width="1%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Contrato</th>
            <th width="17%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Investidor</th>
            <th width="22%" rowspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Plano</th>
            <th width="10%" colspan="11" style="background-color:#444; color:#fff; text-align:center; vertical-align: middle;">Aplicação</th>
            <th width="5%" rowspan="2" style="background-color:#444; color:#fff; text-align:right; vertical-align: middle;">&nbsp;</th>
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
            <th width="5,875%" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Total à Resgatar</th>
            <th width="20%" colspan="2" style="background-color:#444; color:#fff; text-align:center; vertical-align:middle;">Parceiros (Comissão)</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:center; vertical-align: middle;">#<?php echo $produto['excent_id']; ?></td>
        <td style="text-align:center; vertical-align: middle;">
             <?php
                echo "<b>".$produto['excent_afiliado_id']."-";
                $idAssociado = $produto['excent_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                    $idCorretor = $verAssociado['afiliado_indicador'];
                
                echo $verAssociado['afiliado_codigo_verificador']."</b><br>";
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    echo strtoupper($verAssociado['afiliado_nome']);
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    echo strtoupper($verAssociado['afiliado_razao']);
                }
                
                $sqlCorretor = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idCorretor'");
                $verCorretor = mysql_fetch_array($sqlCorretor);
                    $comissaoCoeficiente = $verCorretor['afiliado_comissao'];
                    
                if($verCorretor['afiliado_conta_modo'] == "Fisica"){
                    $nomeCorretor = strtoupper($verCorretor['afiliado_nome']);
                }elseif($verCorretor['afiliado_conta_modo'] == "Juridica"){
                    $nomeCorretor = strtoupper($verCorretor['afiliado_razao']);
                }
                
                
                ?>
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
        <td style="text-align:center; vertical-align: middle;"><?php echo strtoupper($produto['excent_status']); ?></td>
        <td style="text-align:right; vertical-align: middle;">
            <?Php
            $contrato = $produto['excent_id'];
$sqlExtrato2 = mysql_query("SELECT sum(residual_valor) FROM sps_excent_residual WHERE residual_afiliado_id='$idAssociado' AND residual_status='Bloqueado' AND residual_contrato='$contrato'");
$verExtrato2 = mysql_fetch_array($sqlExtrato2);
    $TotalContrato = $verExtrato2['sum(residual_valor)']; 
    $saldoResgate = $produto['excent_valor_liquido'] - $produto['excent_valor_bruto'] - $produto['excent_taxa_adm'] + $TotalContrato;
   echo  "<b>".number_format($saldoResgate,2,",",".")."</b>";
?>
        </td>
        <td colspan="2" style="text-align:center; vertical-align: middle;">
        <b><?Php echo $idCorretor."-".$verCorretor['afiliado_codigo_verificador']; ?></b><br>
        <?Php echo $nomeCorretor; ?><br>
        <b>Comissão: R$ <?php echo number_format($produto['excent_valor_bruto']*$comissaoCoeficiente,2,",",".");?></b>
        </td>
        <td style="text-align:right; vertical-align: middle;">
        <?Php
                if($permissao != "0"){
                     
                    if($permissao != "4"){
                        ?>
                        <a href="excent_extrato.php?id=<?php echo $produto['excent_id']; ?>&&emp=<?php echo $id; ?>" data-toggle="tooltip" title="Visualizar Rendimentos <?php echo $produto['excent_id']; ?>"><span class="glyphicon glyphicon-list-alt" style="font-size:25px;color:blue;"></span></a>
               <?Php
                    
                    }else{
                     ?>
               <a href="excent_extrato.php?id=<?php echo $produto['excent_id']; ?>&&emp=<?php echo $id; ?>" data-toggle="tooltip" title="Visualizar Rendimentos <?php echo $produto['excent_id']; ?>"><span class="glyphicon glyphicon-list-alt" style="font-size:25px;color:blue;"></span></a>
              
                <?Php   
                    }
                }else{
                ?>    
        <a href="excent_extrato.php?id=<?php echo $produto['excent_id']; ?>&&emp=<?php echo $id; ?>" data-toggle="tooltip" title="Visualizar Rendimentos <?php echo $produto['excent_id']; ?>"><span class="glyphicon glyphicon-list-alt" style="font-size:25px;color:blue;"></span></a>
        <a href="excent_excluir.php?id=<?php echo $produto['excent_id']; ?>&&emp=<?php echo $id; ?>" data-toggle="tooltip" title="Remover Contrato <?php echo $produto['excent_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
          <?Php
                }
                ?>
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
        <td colspan="8" style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td colspan="8" style="text-align:right;">
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
</table><BR><BR>

<h2 class="w3-xlarge"><b>RELATÓRIO COMISSIONAL CORRETORES COM VENCIMENTO MÊS ATUAL DA EMPRESA <?Php echo $nomeEmpresa; ?></b></h2><BR><BR>

</div>   
</body>
</html>   
