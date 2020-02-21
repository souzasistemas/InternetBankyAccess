<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];


require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];
    $link = $ver['afiliado_link'];
    

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     



/***** saldo em conta */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$ver_credito2 = mysqli_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysqli_query($conexao, "SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysqli_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$ver_debito2 = mysqli_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];

$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;

date_default_timezone_set('Brazil/East');
$hora_do_dia = date('H');

if(($hora_do_dia >=6) && ($hora_do_dia <=12)){
	$saudacao = "Bom Dia!";
}elseif(($hora_do_dia >12) && ($hora_do_dia <=18)){
	$saudacao = "Bom Tarde!";
}elseif(($hora_do_dia >18) && ($hora_do_dia <=23)){
	$saudacao = "Boa Noite!";
}elseif(($hora_do_dia >=0) && ($hora_do_dia <6)){
	$saudacao = "Boa Madrugada!";
}

$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
 $site = $verEmpresa['logo_site'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<title><?Php echo $nomeEmpresa; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
<link rel="icon" href="../img/<?Php echo $icone; ?>">
<link rel="shortcut icon" href="../img/<?Php echo $icone; ?>">
        
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>



<style type="text/css">
html, body, div{
	font-family: "Ubuntu", sans-serif;
	font-size:14px;
    background-repeat:no-repeat;
}
html, body{
    height:100%;
}
iframe#iframe{
    height:88%;
}

#principal::-webkit-scrollbar-track {
    background-color: #222;
}
#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
#principal::-webkit-scrollbar-thumb {
    background: #555;
}


</style>
</head>

<body id="principal">

<div class="w3-container">

<!--
<div class="well" >
    
<!---
    <strong>Link para abertura de contas: <br></strong> 
    <div class="w3-small"><?Php echo $linkCadastro; ?>?id=<?Php echo base64_encode($id); ?></div><br>
    <?Php
  function soNumero($str) {
            return preg_replace("/[^0-9]/", "", $str);
        }
        
        $meuCelular = soNumero($ver['afiliado_celular']);
        ?>
        ---->
        <center>
            <!-- <a href="whatsapp://send?text=Olá. Tudo Bem? Meu nome é <?Php echo $name; ?> e estou lhe apresentando a <?php echo $nomeApp; ?>! Através da empresa, você poderá pagar suas contas, fazer transferências, recarga em celular, ter acesso aos produtos, serviços e benefícios. O tempo é Agora! Acesse o link <?Php echo $site; ?>?id=<?Php echo base64_encode($id); ?> e faça seu cadastro gratuitamente.">
                <button class="w3-button w3-green w3-round"><i class="fab fa-whatsapp"></i> Compartilhar</button></a>
            
                <br>
        
        </center>

</div>
--->

<?php

if($link == "Sim" && $ver['afiliado_empresa'] == "1002"){

$sqlIndicados1 = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_corretor_afiliado_id='$id' GROUP BY caucao_proprietario_afiliado_id");
$totalIndicados1 = mysqli_num_rows($sqlIndicados1);

$sqlIndicados2 = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_corretor_afiliado_id='$id' GROUP BY caucao_locatario_afiliado_id");
$totalIndicados2 = mysqli_num_rows($sqlIndicados2);

$totalIndicados = $totalIndicados1 + $totalIndicados2;

if($totalIndicados <= "0"){
    echo "<h1 class='w3-xlarge w3-center w3-padding-32'>Você não possui contatos cadastrados</h1>";
}else{
?>

<div class="w3-black w3-padding w3-center">Meus Clientes (<?Php echo $totalIndicados; ?>)</div> 

<table class="w3-table w3-striped w3-bordered w3-hoverable" style="width:100%;">
    <thead style="color:#000;">
        <tr>
            <th width="10%" style="text-align:left; vertical-align: middle;">Conta</th>
            <th width="40%" style="text-align:left; vertical-align: middle;">Usuário</th>
            <th width="40%" style="text-align:left; vertical-align: middle;">Titular</th>
            <th width="10%" style="text-align:left; vertical-align: middle;">Status</th>
        </tr>
    </thead> 
 
 
 

<?Php
$sqlIndicados1 = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_corretor_afiliado_id='$id' GROUP BY caucao_proprietario_afiliado_id");
while ($verIndicados1 = mysqli_fetch_array($sqlIndicados1)) {
    $idProprietario = $verIndicados1['caucao_proprietario_afiliado_id'];

$sqlAfiliado1 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idProprietario'");
$produto1 = mysqli_fetch_array($sqlAfiliado1);
?>

<tbody style="font-size:11px;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b><?php 
            echo $produto1['afiliado_id']; ?>-<?php echo $produto1['afiliado_codigo'];?></b>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto1['afiliado_usuario']; ?><br><a href="mailto:<?php echo $produto1['afiliado_email']; ?>"><?php echo $produto1['afiliado_email']; ?></a>
        </td>
        <td style="text-align:left; vertical-align: middle;">
            <?php
            if($produto1['afiliado_conta_modo'] == ""){
            }else{
                if($produto1['afiliado_conta_modo'] == "Fisica"){
                    echo $produto1['afiliado_nome'];
                }elseif($produto1['afiliado_conta_modo'] == "Juridica"){
                    echo $produto1['afiliado_fantasia'];
                }
            ?>
            <br><?php echo $produto1['afiliado_telefone']; ?>/<?php echo $produto1['afiliado_celular']; ?></a>
            <?Php } ?>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto1['afiliado_status']; ?>
        </td>
        
        
        
        
    </tr>
</tbody>
<?Php
}
?>






<?Php
$sqlIndicados2 = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_corretor_afiliado_id='$id' GROUP BY caucao_locatario_afiliado_id");
while ($verIndicados2 = mysqli_fetch_array($sqlIndicados2)) {
    $idLocatario = $verIndicados2['caucao_locatario_afiliado_id'];

$sqlAfiliado2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idLocatario'");
$produto2 = mysqli_fetch_array($sqlAfiliado2);
?>

<tbody style="font-size:11px;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b><?php 
            echo $produto2['afiliado_id']; ?>-<?php echo $produto2['afiliado_codigo'];?></b>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto2['afiliado_usuario']; ?><br><a href="mailto:<?php echo $produto2['afiliado_email']; ?>"><?php echo $produto2['afiliado_email']; ?></a>
        </td>
        <td style="text-align:left; vertical-align: middle;">
            <?php
            if($produto2['afiliado_conta_modo'] == ""){
            }else{
                if($produto2['afiliado_conta_modo'] == "Fisica"){
                    echo $produto2['afiliado_nome'];
                }elseif($produto2['afiliado_conta_modo'] == "Juridica"){
                    echo $produto2['afiliado_fantasia'];
                }
            ?>
            <br><?php echo $produto2['afiliado_telefone']; ?>/<?php echo $produto2['afiliado_celular']; ?></a>
            <?Php } ?>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto2['afiliado_status']; ?>
        </td>
        
        
        
        
    </tr>
</tbody>
<?Php
}
?>
</table> 









    
<?Php    
}

}else{

$sqlIndicados = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_indicador='$id'");
$totalIndicados = mysqli_num_rows($sqlIndicados);

if($totalIndicados <= "0"){
    echo "<h1 class='w3-xlarge w3-center w3-padding-32'>Você não possui contatos cadastrados</h1>";
}else{
?>

<div class="w3-black w3-padding w3-center">Minha lista de contatos (<?Php echo $totalIndicados; ?>)</div>
<table class="w3-table w3-striped w3-bordered w3-hoverable" style="width:100%;">
    <thead style="color:#000;">
        <tr>
            <th width="10%" style="text-align:left; vertical-align: middle;">Conta</th>
            <th width="40%" style="text-align:left; vertical-align: middle;">Usuário</th>
            <th width="40%" style="text-align:left; vertical-align: middle;">Titular</th>
            <th width="10%" style="text-align:left; vertical-align: middle;">Status</th>
        </tr>
    </thead>

<?Php
$sqlIndicados1 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_indicador='$id' ORDER BY afiliado_id DESC");
while ($produto = mysqli_fetch_array($sqlIndicados1)) {
?>


<tbody style="font-size:11px;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b><?php 
            echo $produto['afiliado_id']; ?>-<?php echo $produto['afiliado_codigo'];?></b>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto['afiliado_usuario']; ?><br><a href="mailto:<?php echo $produto['afiliado_email']; ?>"><?php echo $produto['afiliado_email']; ?></a>
        </td>
        <td style="text-align:left; vertical-align: middle;">
            <?php
            if($produto['afiliado_conta_modo'] == ""){
            }else{
                if($produto['afiliado_conta_modo'] == "Fisica"){
                    echo $produto['afiliado_nome'];
                }elseif($produto['afiliado_conta_modo'] == "Juridica"){
                    echo $produto['afiliado_fantasia'];
                }
            ?>
            <br><?php echo $produto['afiliado_telefone']; ?>/<?php echo $produto['afiliado_celular']; ?></a>
            <?Php } ?>
        </td>
        <td style="text-align:left; vertical-align: middle;"><?php echo $produto['afiliado_status']; ?>
        </td>
        
        
        
        
    </tr>
</tbody>
<?Php
}
?>
</table>
<?Php }} ?>    















</div>




</body>
</html>