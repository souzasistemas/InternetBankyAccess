<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];

if($id == ""){
    echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $nome = $ver['afiliado_nome'];
    $razao = $ver['afiliado_fantasia'];
    $primeiroRazao = explode(" ", $razao);
    $primeiroNome = explode(" ", $nome);
    $status = $ver['afiliado_status'];
    
if($ver['afiliado_modo_cadastro'] == "Fisica"){
    $nomeAfiliado = $primeiroNome;
}elseif($ver['afiliado_modo_cadastro'] == "Juridica"){
    $nomeAfiliado = $primeiroRazao;
}
    

if($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não autorizado!');</script>";
}else{

    $string2 = str_pad($ver['afiliado_id'], 7, '0', STR_PAD_LEFT);
    $string1 = str_pad(1, 4, '0', STR_PAD_LEFT);

require "../config/saldo.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>BackOffice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="icon" href="../img/icone.png" type="image/x-icon" />
  <link rel="shortcut icon" href="//img/icone.png" type="image/x-icon" />
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

<style>
html,body, iframe, div#conteudo {height:100%;}
</style>

</head>
<body>
    
<div class="w3-container">
<div class="w3-twothird">
    <div class="w3-container-fluid" style="margin-top:-15px;">
<h1 class="w3-margin-8 w3-text-gray"><b>Saldo e Extrato</b></h1>

<div class="w3-panel w3-display-container w3-row" style="margin-left:-15px;">
  
  <div class="w3-third w3-container w3-teal w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:50px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:25px;"><?Php echo number_format($saldo_disponivel,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4 class="w3-right">Saldo em Conta</h4>
      </div>
  </div>
  
  <div class="w3-third w3-container w3-cyan w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:50px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:25px;"> <?Php echo number_format($saldo_disponivel2,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4 class="w3-right">Limite Disponível</h4>
      </div>
  </div>
  
  
  <div class="w3-third w3-container w3-blue-gray w3-card w3-text-white w3-padding-16">
    <div class="w3-container w3-padding-16">
        <div class="w3-left"><i class="fa fa-credit-card" aria-hidden="true" style="font-size:50px;"></i></div>
        <div class="w3-right">
        <h1 style="font-weight:bold; font-size:25px;"> <?Php echo number_format($saldoGeral,2,",",".");?></h1>
        </div>
        <div class="w3-clear"></div>
        <h4 class="w3-right">Saldo Total Disponível</h4>
      </div>
  </div>
</div>






<h1 class="w3-medium"><b>Escolha o período</b></h1>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>" name="form" method="POST" class="botao w3-container">
<input name="escolha" type="hidden" value="branco">

<div class="w3-row">
    <div class="w3-col" style="width:50%;"><b>Data Início: </b><input name="inicio" type="date" class="w3-input w3-white w3-round w3-border" style="width:95%;" required></div>
    <div class="w3-rest"><b>Data Fim: </b><input name="fim" type="date" class="w3-input w3-white w3-round w3-border" style="width:100%;" required></div>
</div>
<br>
<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="home.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="margin-bottom:5px; width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button type="submit" class="w3-input w3-teal btn-lg w3-padding-16" style="margin-bottom:5px;  width:100%;" /><i class="fa fa-search"></i> Buscar</button></td>
    </tr>
</table> 

            
</form><br>

<?Php
$escolha = $_POST['escolha'];
$datainicio = $_POST['inicio'];
$datafim = $_POST['fim'];

$datainicio1 = str_replace('-', ' ', $datainicio);
$datas1 = explode(' ', $datainicio1);
$datainicioA1 = $datas1[2];
$datainicioB1 = $datas1[1];
$datainicioC1 = $datas1[0];

$datainicio2 = str_replace('-', ' ', $datafim);
$datas2 = explode(' ', $datainicio2);
$datainicioA2 = $datas2[2];
$datainicioB2 = $datas2[1];
$datainicioC2 = $datas2[0];

$inicio = "$datainicioA1/$datainicioB1/$datainicioC1";
$fim = "$datainicioA2/$datainicioB2/$datainicioC2";

$di = date('Y-m-d', strtotime($inicio)); 
$df = date('Y-m-d', strtotime($fim));   

if($escolha == ""){
}else{
?>



<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">EXTRATO DETALHADO</div>

<table style="width:100%;">
<tr>
                <td>
                    <div class="w3-panel w3-light-gray w3-border w3-padding w3-round" style="font-size:12px;">
                        <div class="w3-padding-8"><b>Legenda DOC/TED:</b></div> 
		                <i class="fa fa-thumbs-up w3-text-green" ></i> Efetuado &nbsp;&nbsp;
		                <i class="fa fa-hourglass-half w3-text-black"></i> Pendente &nbsp;&nbsp;
    	                <i class="fa fa-thumbs-down w3-text-red"></i> Cancelado  
    	           </div>
                </td>
            </tr>
        </table>





<table class="w3-table" style="font-size:12px;">
   
         <thead>
            <tr>
                <th style="width:79%; text-align:left; background-color:#666666; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:1%; text-align:right; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
        
        
<?Php       
$sqlExtrato = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_data BETWEEN '$inicio' AND '$fim'");
while($verExtrato = mysqli_fetch_array($sqlExtrato)){
?>

        <tbody>
            <tr>
                <td style="text-align:left; vertical-align:middle; width:69%;"><?Php echo strtoupper($verExtrato['extrato_descricao']); ?><br>
                <span class="w3-text-grey"><?Php echo $verExtrato['extrato_data']; ?> - 
                <?Php echo $verExtrato['extrato_hora']; ?></span>
                </td>
                <td style="text-align:right; vertical-align:middle; width:30%;">
                    <?Php
                    if($verExtrato['extrato_tipo'] == "Credito"){
                        echo "<span style='color:green'> + ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }elseif($verExtrato['extrato_tipo'] == "Debito"){
                        echo "<span style='color:red'> - ".number_format($verExtrato['extrato_valor'],2,",",".")."</span>";
                    }
                    ?>
                </td>
                <td style="text-align:center; vertical-align:middle;  width:1%;">
                    <?Php
							if($verExtrato['extrato_status_saque'] == "Pago"){
								echo "<i class='fa fa-thumbs-up w3-text-green' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Pendente"){
								echo "<i class='fa fa-hourglass-half w3-text-black' ></i>";
							}elseif($verExtrato['extrato_status_saque'] == "Cancelado"){
								echo "<i class='fa fa-thumbs-down w3-text-red' ></i>";
							}
						?>
                </td>
            </tr>
        </tbody>

<?Php }?>
            
</table>

<?Php
}
?>
</div>
</div>




<div class="w3-third"><center><img src="../img/saldo.png" width="100%"></center><br><br><br></div>

</div>

</body>
</html>

<?Php
}
}
?>
