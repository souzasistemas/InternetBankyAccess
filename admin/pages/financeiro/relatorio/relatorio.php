<?Php

$id = $_GET['id'];

require "../../../../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);
    $empresa = $ver['admin_empresa'];
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>BackOffice</title>
  <meta charset="utf8">
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



 <style media="print">
.botao {
display: none;
}
</style>


</head>
<body>
    
<div class="w3-container">
    
<h2 class="w3-xlarge w3-center"><b>Consultar Extrato</b></h1>

<hr class="w3-border-black">

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>" name="form" method="POST" class="botao w3-container">
<input name="escolha" type="hidden" value="branco">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">

<div class="w3-third"><b>Conta sem dígito</b> <input name="conta" type="number" class="w3-input w3-white w3-round w3-border" style="width:99%;" required></div>
<div class="w3-third"><b>Data Início: </b><input name="inicio" type="date" class="w3-input w3-white w3-round w3-border" style="width:99%;" required></div>
<div class="w3-third" style="margin-bottom:10px;"><b>Data Fim: </b><input name="fim" type="date" class="w3-input w3-white w3-round w3-border" style="width:99%;" required></div>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="home.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="margin-bottom:5px; width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button type="submit" class="w3-input w3-teal btn-lg w3-padding-16" style="margin-bottom:5px;  width:100%;" /><i class="fa fa-search"></i> Buscar</button></td>
    </tr>
</table> 

            
</form><br>

<?Php
$escolha = $_POST['escolha'];
$conta = $_POST['conta'];
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


$sqlAfiliado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$conta' AND afiliado_empresa='$empresa'");
$verAfiliado = mysqli_fetch_array($sqlAfiliado);

if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
    $documento = $verAfiliado['afiliado_cpf'];
    $nome = $verAfiliado['afiliado_nome'];
}elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
    $documento = $verAfiliado['afiliado_cnpj'];
    $nome = $verAfiliado['afiliado_razao'];
}
?>

<hr class="w3-border-black botao">

<div class="w3-container">

<div class="col-sm-12">
    <div class="w3-container" style="vertical-align:middle; font-size:12px;">
        <?Php
        if($verAfiliado['afiliado_nacao'] == "BRASIL"){
        ?>
        <strong>Nome/Razão Social:</strong> <?Php echo $nome; ?><br>
        <strong>CPF/CNPJ:</strong> <?Php echo $documento; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($verAfiliado['afiliado_endereco']); ?>&nbsp; &nbsp; &nbsp; <strong>Bairro:</strong> <?Php echo strtoupper($verAfiliado['afiliado_bairro']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($verAfiliado['afiliado_cidade']); ?>/<?Php echo strtoupper($verAfiliado['afiliado_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>CEP:</strong> <?Php echo strtoupper($verAfiliado['afiliado_cep']); ?>&nbsp; &nbsp; &nbsp; <strong>Conta:</strong> <?Php echo strtoupper($verAfiliado['afiliado_id']); ?>-<?Php echo $verAfiliado['afiliado_codigo']; ?>
        <strong>País ou Nação:</strong> <?Php echo strtoupper($verAfiliado['afiliado_nacao']); ?>
        <?Php
        }else{
        ?>
        <strong>Nome Completo:</strong> <?Php echo $verAfiliado['afiliado_nome']; ?><br>
        <strong>Documento de Identificação ou Passaporte:</strong> <?Php echo $verAfiliado['afiliado_cpf']; ?> <br>
        <strong>Endereço:</strong> <?Php echo strtoupper($verAfiliado['afiliado_endereco']); ?><br> 
        <strong>Cidade/UF:</strong> <?Php echo strtoupper($verAfiliado['afiliado_cidade']); ?>/<?Php echo strtoupper($verAfiliado['afiliado_estado']); ?> &nbsp; &nbsp; &nbsp;<strong>ZIP CODE:</strong> <?Php echo strtoupper($verAfiliado['afiliado_cep']); ?>&nbsp; &nbsp; &nbsp; <strong>Conta:</strong> <?Php echo strtoupper($verAfiliado['afiliado_id']); ?>-<?Php echo $verAfiliado['afiliado_codigo']; ?><br>
        <strong>País ou Nação:</strong> <?Php echo strtoupper($verAfiliado['afiliado_nacao']); ?>
        <?Php
        }
        ?>
    </div>
    
    
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




<div class="col-sm-12 w3-black w3-round" style="height:40px; text-align:center; vertical-align:middle; padding:10px 0;">EXTRATO DETALHADO</div>


<table class="w3-table" style="font-size:12px;">
   
         <thead>
            <tr>
                <th style="width:79%; text-align:left; background-color:#666666; color:#fff;">Descrição</th>
                <th style="width:20%; text-align:right; background-color:#666666; color:#fff;">Valor</th>
                <th style="width:1%; text-align:right; background-color:#666666; color:#fff;">&nbsp;</th>
            </tr>
        </thead>
        
        
<?Php       
$sqlExtrato = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_afiliado_id='$conta' AND extrato_data BETWEEN '$inicio' AND '$fim'");
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
<br>
<div class="col-sm-12" style="padding:0 0 20px 0;">
    <div class="col-sm-6" style="text-align:left;"><a name="print" href="javascript:self.print()" class="btn btn-info btn-lg botao"> <span class="glyphicon glyphicon-print"></span> Imprimir Demonstrativo </a></div>
</div>
<?Php
}
?>
</div>
</div>
</div>
<br><br>
</body>
</html>
