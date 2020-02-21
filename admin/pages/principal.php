<?Php
session_start();

$id = $_GET['id'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../../config/config.php";


$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);

$nome = $ver['admin_nome'];
$empresa = $ver['admin_empresa'];

$sqlAcesso = mysqli_query($conexao, "SELECT * FROM sps_admin_logs WHERE acesso_admin_login='$nome' ORDER BY acesso_admin_id DESC LIMIT 1,1");
$verAcesso = mysqli_fetch_array($sqlAcesso);
    $idLogs = $verAcesso['acesso_admin_id'];
    
if($idLogs == ""){
    $echo = "<h5>Este é seu primeiro Acesso!</h5>";
}else{
    $echo = "<h5>Seu Último acesso foi no dia ".$verAcesso['acesso_admin_data']." às ".$verAcesso['acesso_admin_hora']." no IP: ".$verAcesso['acesso_admin_ip']."</h5>";
}

$sqlCotacao = mysqli_query($conexao, "SELECT * FROM sps_cotacao");
$verCotacao = mysqli_fetch_array($sqlCotacao);

$sqlAtivos = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_status='Ativo'");
$totalAtivos = mysqli_num_rows($sqlAtivos);

$sqlPendente = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_status='Pendente'");
$totalPendente = mysqli_num_rows($sqlPendente);

$sqlBloqueado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_status='Bloqueado'");
$totalBloqueado = mysqli_num_rows($sqlBloqueado);

$total1 = $totalPendente + $totalBloqueado;

$sqlCorrespondente = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_link='Sim'");
$totalCorrespondente = mysqli_num_rows($sqlCorrespondente);


$sqlRendimento = mysqli_query($conexao, "SELECT * FROM sps_rendimento WHERE rendimento_status='Ativo'");
$totalRendimento = mysqli_num_rows($sqlRendimento);

$sqlRendimento2 = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_status='Ativo' GROUP BY excent_afiliado_id");
$totalRendimento2 = mysqli_num_rows($sqlRendimento2);

$saque = mysqli_query($conexao, "SELECT * FROM sps_extrato WHERE extrato_modulo='Retirada' AND extrato_status_saque='Pendente'");
$totalRows_saque = mysqli_num_rows($saque);

$recarga = mysqli_query($conexao, "SELECT * FROM sps_recarga_celular WHERE recarga_status='Pendente'");
$totalRows_recarga = mysqli_num_rows($recarga);

$boleto = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_status='Pendente'");
$totalRows_boleto = mysqli_num_rows($boleto);

date_default_timezone_set('Brazil/East');
$mes = date('m');
$ano = date('Y');
			
$sqlmovimentoDebito = mysqli_query($conexao, "SELECT * FROM sps_movimentacao WHERE movimento_status_estabelecimento='Em Aberto' AND movimento_pagamento_mes<='$mes' AND movimento_pagamento_ano<='$ano'");
$vermovimentoDebito = mysqli_fetch_array($sqlmovimentoDebito);
$totalRows_Debito = mysqli_num_rows($sqlmovimentoDebito);
			
$sqlmovimentoCredito = mysqli_query($conexao, "SELECT * FROM sps_movimentacao_credito WHERE movimento_status_estabelecimento='Em Aberto' AND movimento_pagamento_mes<='$mes' AND movimento_pagamento_ano<='$ano'");
$vermovimentoCredito = mysqli_fetch_array($sqlmovimentoCredito);
$totalRows_Credito = mysqli_num_rows($sqlmovimentoCredito);
			
$dois = $totalRows_Debito + $totalRows_Credito;

if($vermovimentoDebito['movimento_id'] == "" && $vermovimentoCredito['movimento_id'] == ""){
    $totalRepasse = "0";
}elseif($vermovimentoDebito['movimento_id'] != "" && $vermovimentoCredito['movimento_id'] == ""){
    $totalRepasse = $totalRows_Debito;
}elseif($vermovimentoDebito['movimento_id'] == "" && $vermovimentoCredito['movimento_id'] != ""){
    $totalRepasse = $totalRows_Credito;
}elseif($vermovimentoDebito['movimento_id'] != "" && $vermovimentoCredito['movimento_id'] != ""){
    $totalRepasse = $dois;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>ADMINISTRAÇÃO GERAL</title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  	
 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      myIframe = $("#iframe1").attr("src","principal.php?id=<?Php echo $id; ?>");
      $(myIframe).load(function() {          
        var myDoc = (myIframe.get(0).contentDocument) ? myIframe.get(0).contentDocument : myIframe.get(0).contentWindow.document;
        myIframe.height(myDoc.body.scrollHeight+0);
      });
    });
  </script>
  
 <style type="text/css">

.container {
    padding:10px 0;
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

 <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fas fa-home"></i> Visão Geral da Empresa</b></h5>
  </header>


<div class="w3-row-padding w3-margin-bottom"> 

<div class="w3-container" style="padding-left:10px; padding-right:10px; margin-bottom:5px;">

    <div class="w3-container w3-blue-gray w3-padding-16 w3-round">
        <div class="w3-left"><i class="fas fa-users w3-xxxlarge"></i></div>
        <div class="w3-right"><h4>Contas Abertas</h4></div>
        <div class="w3-clear"></div>
        <div class="w3-container-fluid">
            <table style="width:100%;">
                <tr>
                    <td class="w3-left"><h4>Ativas</h4></td>
                    <td class="w3-right"><h4>
                        <?Php
                        $sql1 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_empresa='$empresa' AND afiliado_status='Ativo'");
                        $total1 = mysqli_num_rows($sql1);
                            echo $total1;   
                        ?>
                    </h4></td>
                </tr>
                <tr>
                    <td class="w3-left"><h4>Pendentes</h4></td>
                    <td class="w3-right"><h4>
                        <?Php
                        $sql2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_empresa='$empresa' AND afiliado_status='Pendente'");
                        $total2 = mysqli_num_rows($sql2);
                            echo $total2;   
                        ?>
                    </h4></td>
                </tr>
                <tr>
                    <td class="w3-left"><h4>Bloqueadas</h4></td>
                    <td class="w3-right"><h4>
                        <?Php
                        $sql3 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_empresa='$empresa' AND afiliado_status='Bloqueado'");
                        $total3 = mysqli_num_rows($sql3);
                            echo $total3; 
                        ?>
                    </h4></td>
                </tr>
                <tr>
                    <td class="w3-left"><h4><b>Total</b></h4></td>
                    <td class="w3-right"><h4><b>
                        <?Php
                        $sql4 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_empresa='$empresa'");
                        $total4 = mysqli_num_rows($sql4);
                            echo $total4; 
                        ?></b>
                    </h4></td>
                </tr>
                
                
            </table>
        </div> 
    </div>
    
    
    
    
    
</div>


 <div class="w3-quarter"><div class="w3-container w3-red w3-padding-16 w3-round" style="margin-bottom:5px;">
        <div class="w3-left"><i class="fas fa-money-bill-alt w3-xxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?Php
            	$sqlAfiliadoPendente = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_modulo='Retirada' AND extrato_status_saque='Pendente' AND extrato_empresa='$empresa'");
            	$verAfiliadoPendente = mysqli_fetch_array($sqlAfiliadoPendente);
            	$totalSaquePendente = $verAfiliadoPendente['sum(extrato_valor)'];
            	$quantidadeSaquePendente = mysqli_num_rows($sqlAfiliadoPendente);
            	    echo number_format($totalSaquePendente,2,",",".");
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>DOC/TED</h4>
      </div>
</div>

<div class="w3-quarter"><div class="w3-container w3-deep-orange w3-padding-16 w3-round" style="margin-bottom:5px;">
        <div class="w3-left"><i class="fas fa-barcode w3-xxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?Php
            	$sqlBoletos = mysqli_query($conexao, "SELECT sum(boleto_valor) FROM sps_boletos WHERE boleto_status='Pendente' AND boleto_empresa='$empresa'");
            	$verBoletos = mysqli_fetch_array($sqlBoletos);
            	$totalBoletos = $verBoletos['sum(boleto_valor)'];
            	    echo number_format($totalBoletos,2,",",".");
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>BOLETOS À PAGAR</h4>
      </div>
</div>




<div class="w3-quarter"><div class="w3-container w3-orange w3-text-white w3-padding-16 w3-round" style="margin-bottom:5px;">
        <div class="w3-left"><i class="fas fa-mobile-alt w3-xxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?Php
            	$sqlCelular = mysqli_query($conexao, "SELECT sum(recarga_valor) FROM sps_recarga_celular WHERE recarga_status='Pendente' AND recarga_empresa='$empresa'");
            	$verCelular = mysqli_fetch_array($sqlCelular);
            	$totalCelular = $verCelular['sum(recarga_valor)'];
            	    echo number_format($totalCelular,2,",",".");
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>RECARGA DE CELULAR</h4>
      </div>
</div>




<div class="w3-quarter"><div class="w3-container w3-teal w3-padding-16 w3-round" style="margin-bottom:5px;">
        <div class="w3-left"><i class="fas fa-usd w3-xxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?Php
                $sqlSaldo1 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_tipo='Credito' AND extrato_empresa='$empresa'");
            	$verSaldo1 = mysqli_fetch_array($sqlSaldo1);
            	
            	$sqlSaldo2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_tipo='Debito' AND extrato_empresa='$empresa'");
            	$verSaldo2 = mysqli_fetch_array($sqlSaldo2);
            	
            	$saldo = $verSaldo1['sum(extrato_valor)'] - $verSaldo2['sum(extrato_valor)'];
            	
            	    echo number_format($saldo,2,",",".");
            ?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>SALDO EM CONTA</h4>
      </div>
</div> 











<br><br><br>

</div>  
    
    
</body>
</html>
<?Php
}
?>