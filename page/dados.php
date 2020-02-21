<?Php
session_start();

$id = $_GET['id'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

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


if($status == "Pendente"){
    header ("Location: homePendente.php?id=$id");
}elseif($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Sessão Encerrada');</script>";
}else{
    


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

<?Php
/*** cadastro nacional ***/
if($ver['afiliado_nacao'] == "BRASIL"){
/*** cadastro pessoa física ***/
if($ver['afiliado_conta_modo'] == "Fisica"){
?>    

<h1 class="w3-margin-8 w3-text-gray"><b>Meus Dados Pessoais</b></h1><br>

<div class="w3-container w3-light-gray w3-round w3-padding" style="margin-bottom:2px; margin-top:-10px;">
  
  <strong>Usuário:</strong> <?Php echo strtolower($ver['afiliado_usuario']); ?><br>
  <strong>Nome Completo:</strong> <?Php echo strtoupper($ver['afiliado_nome']); ?><br>
  <strong>CPF:</strong> <?Php echo strtoupper($ver['afiliado_cpf']); ?> &nbsp;&nbsp;&nbsp;
  <strong>RG:</strong> <?Php echo strtoupper($ver['afiliado_rg']); ?> <br>
  <strong>Data de Nascimento:</strong> <?Php echo strtoupper($ver['afiliado_nascimento']); ?><br>
  <strong>Sexo:</strong> <?Php echo strtoupper($ver['afiliado_sexo']); ?>
  <strong>Estado Civil:</strong> <?Php echo strtoupper($ver['afiliado_estado_civil']); ?>
  <strong>Profissão:</strong> <?Php echo strtoupper($ver['afiliado_profissao']); ?>
</div>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
  <strong>Tel.:</strong> <?Php echo strtoupper($ver['afiliado_telefone']); ?>&nbsp;&nbsp;&nbsp;
  <strong>Cel.:</strong> <?Php echo strtoupper($ver['afiliado_celular']); ?><br>
  <strong>E-mail:</strong> <?Php echo strtolower($ver['afiliado_email']); ?>
</div> 

<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
 <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_bairro']); ?><br>
  
  <strong>Cidade:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?>&nbsp;&nbsp;&nbsp;
  <strong>UF:</strong> <?Php echo strtoupper($ver['afiliado_estado']); ?><br>
  <strong>País:</strong> <?Php echo strtoupper($ver['afiliado_nacao']); ?>&nbsp;&nbsp;&nbsp;
  <strong>CEP:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>
</div> 

<?Php 
if($ver['afiliado_credenciamento'] == "Sim"){
    $segmento = $ver['afiliado_segmento'];
    $sqlSegmento = mysqli_query($conexao, "SELECT * FROM sps_segmento WHERE segmento_mmc='$segmento'");
    $verSegmento = mysqli_fetch_array($sqlSegmento);
?>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
    <strong>Nome da Loja:</strong> <?Php echo strtoupper($ver['afiliado_fantasia']); ?><br>
    <strong>Tipo de Loja:</strong> <?Php echo strtoupper($ver['afiliado_tipo_negocio']); ?><br>
    <strong>Taxa Adm:</strong> <?Php echo number_format($verSegmento['segmento_debito']*100,2,",","."); ?>%&nbsp;&nbsp;&nbsp;
    <strong>Desconto:</strong> <?Php echo number_format($ver['afiliado_bonus']*100,2,",","."); ?>%<br>
    <strong>Site:</strong> <?Php echo strtolower($ver['afiliado_site']); ?>
</div> 
<?Php    
}
?> 

<table style="width:100%; margin-top:5px;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="principal.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button name="reset" type="button" class="btn-lg w3-teal w3-input w3-padding-16" style="border:none; width:100%;" onclick="document.getElementById('alterarDados').style.display='block'"><i class="fas fa-pencil-alt"></i> EDITAR</button></td>
        
    </tr>
</table>   
    
<?Php    
/*** fim do cadastro pessoa física ***/
/*** cadastro pessoa juridica ***/
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
?>






<h1 class="w3-margin-8 w3-text-gray"><b>Meus Dados Empresarias</b></h1><br>

<div class="w3-container w3-light-gray w3-round w3-padding" style="margin-bottom:2px; margin-top:-10px;">
  
  <strong>Usuário:</strong> <?Php echo strtolower($ver['afiliado_usuario']); ?><br><br>
  <strong>Razão Social:</strong> <?Php echo strtoupper($ver['afiliado_razao']); ?><br>
  <strong>Nome Fantasia:</strong> <?Php echo strtoupper($ver['afiliado_fantasia']); ?> <br>
  <strong>CNPJ:</strong> <?Php echo strtoupper($ver['afiliado_rg']); ?> &nbsp;&nbsp;&nbsp;
  <strong>Inscriçaõ Estadual/Municipal:</strong> <?Php echo strtoupper($ver['afiliado_insc']); ?><br>
  <strong>Data de Abertura:</strong> <?Php echo strtoupper($ver['afiliado_data_abertura']); ?>
</div>

<div class="w3-container w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
  
  <strong>Nome Completo:</strong> <?Php echo strtoupper($ver['afiliado_nome']); ?><br>
  <strong>CPF:</strong> <?Php echo strtoupper($ver['afiliado_cpf']); ?> &nbsp;&nbsp;&nbsp;
  <strong>RG:</strong> <?Php echo strtoupper($ver['afiliado_rg']); ?> <br>
  <strong>Data de Nascimento:</strong> <?Php echo strtoupper($ver['afiliado_nascimento']); ?><br>
  <strong>Sexo:</strong> <?Php echo strtoupper($ver['afiliado_sexo']); ?>
  <strong>Estado Civil:</strong> <?Php echo strtoupper($ver['afiliado_estado_civil']); ?>
  <strong>Profissão:</strong> <?Php echo strtoupper($ver['afiliado_profissao']); ?>
</div>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
  <strong>Tel.:</strong> <?Php echo strtoupper($ver['afiliado_telefone']); ?>&nbsp;&nbsp;&nbsp;
  <strong>Cel.:</strong> <?Php echo strtoupper($ver['afiliado_celular']); ?><br>
  <strong>E-mail:</strong> <?Php echo strtolower($ver['afiliado_email']); ?>
</div> 

<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
 <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_bairro']); ?><br>
  
  <strong>Cidade:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?>&nbsp;&nbsp;&nbsp;
  <strong>UF:</strong> <?Php echo strtoupper($ver['afiliado_estado']); ?><br>
  <strong>País:</strong> <?Php echo strtoupper($ver['afiliado_nacao']); ?>&nbsp;&nbsp;&nbsp;
  <strong>CEP:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>
</div> 

<?Php 
if($ver['afiliado_credenciamento'] == "Sim"){
    $segmento = $ver['afiliado_segmento'];
    $sqlSegmento = mysqli_query($conexao, "SELECT * FROM sps_segmento WHERE segmento_mmc='$segmento'");
    $verSegmento = mysqli_fetch_array($sqlSegmento);
?>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
    <strong>Nome da Loja:</strong> <?Php echo strtoupper($ver['afiliado_fantasia']); ?><br>
    <strong>Tipo de Loja:</strong> <?Php echo strtoupper($ver['afiliado_tipo_negocio']); ?><br>
    <strong>Taxa Adm:</strong> <?Php echo number_format($verSegmento['segmento_debito']*100,2,",","."); ?>%&nbsp;&nbsp;&nbsp;
    <strong>Desconto:</strong> <?Php echo number_format($ver['afiliado_bonus']*100,2,",","."); ?>%<br>
    <strong>Site:</strong> <?Php echo strtolower($ver['afiliado_site']); ?>
</div> 
<?Php    
}
?> 

<table style="width:100%; margin-top:5px;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="principal.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button name="reset" type="button" class="btn-lg w3-teal w3-input w3-padding-16" style="border:none; width:100%;" onclick="document.getElementById('alterarDados2').style.display='block'"><i class="fas fa-pencil-alt"></i> EDITAR</button></td>
        
    </tr>
</table> 





<?Php
/*** fim do cadastro pessoa juridica  ***/    
}
/*** fim do cadastro nacional
/*** cadastro internacional ***/
}else{
?>



<h1 class="w3-margin-8 w3-text-gray"><b>Meus Dados Pessoais</b></h1><br>

<div class="w3-container w3-light-gray w3-round w3-padding" style="margin-bottom:2px; margin-top:-10px;">
  
  <strong>Usuário:</strong> <?Php echo strtolower($ver['afiliado_usuario']); ?><br><br>
  <strong>Nome Completo:</strong> <?Php echo strtoupper($ver['afiliado_nome']); ?><br>
  <strong>Documento/Passaporte:</strong> <?Php echo strtoupper($ver['afiliado_cpf']); ?><br>
  <strong>Data de Nascimento:</strong> <?Php echo strtoupper($ver['afiliado_nascimento']); ?><br>
  <strong>Sexo:</strong> <?Php echo strtoupper($ver['afiliado_sexo']); ?>
  <strong>Estado Civil:</strong> <?Php echo strtoupper($ver['afiliado_estado_civil']); ?>
  <strong>Profissão:</strong> <?Php echo strtoupper($ver['afiliado_profissao']); ?>
</div>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
  <strong>Tel.:</strong> <?Php echo strtoupper($ver['afiliado_telefone']); ?><br>
  <strong>Cel.:</strong> <?Php echo strtoupper($ver['afiliado_celular']); ?><br>
  <strong>E-mail:</strong> <?Php echo strtolower($ver['afiliado_email']); ?>
</div> 

<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
 <strong>Endereço:</strong> <?Php echo strtoupper($ver['afiliado_endereco']); ?>, <?Php echo strtoupper($ver['afiliado_bairro']); ?><br>
  
  <strong>Cidade:</strong> <?Php echo strtoupper($ver['afiliado_cidade']); ?><br>
  <strong>Estado ou Província:</strong> <?Php echo strtoupper($ver['afiliado_estado']); ?><br>
  <strong>País:</strong> <?Php echo strtoupper($ver['afiliado_nacao']); ?><br>
  <strong>ZIP CODE:</strong> <?Php echo strtoupper($ver['afiliado_cep']); ?>
</div> 

<?Php 
if($ver['afiliado_credenciamento'] == "Sim"){
    $segmento = $ver['afiliado_segmento'];
    $sqlSegmento = mysqli_query($conexao, "SELECT * FROM sps_segmento WHERE segmento_mmc='$segmento'");
    $verSegmento = mysqli_fetch_array($sqlSegmento);
?>
<div class="w3-light-gray w3-round w3-padding" style="margin-bottom:2px;">
    <strong>Nome da Loja:</strong> <?Php echo strtoupper($ver['afiliado_fantasia']); ?><br>
    <strong>Tipo de Loja:</strong> <?Php echo strtoupper($ver['afiliado_tipo_negocio']); ?><br>
    <strong>Taxa Adm:</strong> <?Php echo number_format($verSegmento['segmento_debito']*100,2,",","."); ?>%&nbsp;&nbsp;&nbsp;
    <strong>Desconto:</strong> <?Php echo number_format($ver['afiliado_bonus']*100,2,",","."); ?>%<br>
    <strong>Site:</strong> <?Php echo strtolower($ver['afiliado_site']); ?>
</div> 
<?Php    
}
?> 

<table style="width:100%; margin-top:5px;">
    <tr>
        <td style="width:50%; text-align:right;"><a href="principal.php?id=<?Php echo $id; ?>"><button type="button" class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;"><i class="fas fa-reply"></i> Voltar</button></a></td>
        <td style="width:50%; text-align:left;"><button name="reset" type="button" class="btn-lg w3-teal w3-input w3-padding-16" style="border:none; width:100%;" onclick="document.getElementById('alterarDados3').style.display='block'"><i class="fas fa-pencil-alt"></i> EDITAR</button></td>
        
    </tr>
</table> 




<?Php    
}
/*** fim do cadastro internacional ***/
?>
    
    
    
</div>





<!---- modais de alterações --->






<!--- modal pessoa física --->
<div id="alterarDados" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-shadow" style="width:50%; border-radius:10px; padding-bottom:10px; margin-bottom:20px;">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <h4><i class="fa fa-id-card" aria-hidden="true"></i> Alterar Dados</h4>
        </header><br>
        
        <form action="dados_editar_fisica.php?id=<?Php echo $id; ?>" method="post" name="form1" class="w3-container">
            
            <table class="table w3-bordered">
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Login de Acesso</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Usuário</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="login" value="<?php echo $ver['afiliado_usuario']; ?>" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados Pessoais</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_nome'] == ""){
                        ?>
                            <input class="w3-input w3-border w3-round-large" name="nome" type="text" value="" required />
                        <?Php  
                            }else{
                        ?>
                            <input class="w3-input w3-border w3-round-large w3-light-grey" name="nome" type="text" value="<?php echo $ver['afiliado_nome']; ?>" readonly />
                        <?Php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>CPF</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_cpf'] == ""){
                        ?>
                            <input name="cpf" class="w3-input w3-border w3-round-large" id="inputdefault" type="text"  autocomplete="off" required>
                        <?Php
                            }else{
                        ?>
                            <input name="cpf" value="<?php echo $ver['afiliado_cpf']; ?>" class="w3-input w3-border w3-round-large w3-light-grey" type="text" autocomplete="off"  readonly="readonly">
                        <?Php    
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>RG</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="rg" value="<?php echo $ver['afiliado_rg']; ?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nascimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="nascimento" type="text" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" value="<?php echo $ver['afiliado_nascimento']; ?>" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Sexo</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_sexo'];?>"><?php echo strtoupper($ver['afiliado_sexo']);?></option>
            	            <option value=""></option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMININO">FEMININO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado Civil</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_estado_civil'];?>"><?php echo strtoupper($ver['afiliado_estado_civil']);?></option>'Solteiro (a)','Casado (a)','Viúvo (a)','Divorciado (a)','União Estável'
            	            <option value=""></option>
                            <option value="Solteiro (a)">Solteiro (a)</option>
                            <option value="Casado (a)">Casado (a)</option>
                            <option value="Viúvo (a)">Viúvo (a)</option>
                            <option value="Divorciado (a)">Divorciado (a)</option>
                            <option value="União Estável">União Estável</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Profissão</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="rg" value="<?php echo $ver['afiliado_profissao']; ?>" required /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Contato</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle;"><label><b>Telefone</b></label></td>
                    <td><input type="hidden" name="id" value="<?Php echo $id; ?>" />
                    <input class="w3-input w3-border w3-round-large" name="telefone" type="text" size="20" value="<?php echo $ver['afiliado_telefone'];?>" /></td>
                </tr>	
                <tr>
                    <td style="vertical-align:middle;"><label><b>Celular</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="celular" type="text" size="20" value="<?php echo $ver['afiliado_celular'];?>" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>E-mail</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large w3-light-grey" size="40" name="email" style="text-transform:lowercase;"value="<?php echo $ver['afiliado_email'];?>" readonly /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Correspondência</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle; "><label><b>CEP</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cep'];?>" name="cep" onkeyup="Mascara('CEP',this,event)" type="text" id="cep" class="w3-input w3-border w3-round-large" size="10" onblur="pesquisacep(this.value);" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Endereço</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_endereco'];?>" name="rua" type="text" id="rua"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />     </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Bairro</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_bairro'];?>" name="bairro" id="bairro" class="w3-input w3-border w3-round-large" id="inputdefault" type="text" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" ></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Cidade</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cidade'];?>" name="cidade" type="text" id="cidade"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_estado'];?>" name="uf" type="text" id="uf"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>País</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_nacao'];?>" name="nacao" type="text" id="nacao"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                
                <?Php
                    if($ver['afiliado_pin'] == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
                ?>
                <tr class="w3-teal w3-round-large">
                    <td colspan="2">Cadastrar PIN</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Novo PIN</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" placeholder="Somente Números (4 Números)" name="senhanova" type="password" size="20" maxlength="4" onkeypress='return SomenteNumero(event)' required /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="senhanova" type="hidden" value="<?Php echo $pin; ?>" />
                <?Php
                    }
                ?>
                
                
                <?Php
                    if($ver['afiliado_credenciamento'] == "Sim"){
                ?>
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados do Estabelecimento</div>
                    <input name="credenciamento" type="hidden" value="Sim" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome Fantasia</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="fantasia" type="text" value="<?php echo $ver['afiliado_fantasia'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Tipo de Estabelecimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="tipoLoja" type="text" value="<?php echo $ver['afiliado_tipo_negocio'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Site</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="site" type="text" value="<?php echo $ver['afiliado_site'];?>" /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="credenciamento" type="hidden" value="Não" />
                <?Php
                    }
                ?>
                
                
            </table>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;" onclick="document.getElementById('alterarDados').style.display='none'" type="button"><i class="fa fa-times" style="font-size:16px;" aria-hidden="true"></i> Cancelar</button></td>
        <td style="width:50%; text-align:left;"><button class="btn-lg w3-teal w3-input w3-padding-16" type="submit" style="width:100%;" ><i style="font-size:16px;" class="fa fa-check" aria-hidden="true" ></i> Alterar</button></td>
        
    </tr>
</table> 
            
    
        </form>
        
    </div>
</div>
<!--- fim modal pessoa física --->






<!--- modal pessoa juridica --->
<div id="alterarDados2" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-shadow" style="width:50%; border-radius:10px; padding-bottom:10px; margin-bottom:20px;">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <h4><i class="fa fa-id-card" aria-hidden="true"></i> Alterar Dados</h4>
        </header><br>
        
        <form action="dados_editar_juridica.php?id=<?Php echo $id; ?>" method="post" name="form1" class="w3-container">
            
            <table class="table w3-bordered">
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Login de Acesso</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Usuário</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="login" value="<?php echo $ver['afiliado_usuario']; ?>" required /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados da Empresa</div></td>
                </tr>
                
                <tr>
                    <td style="vertical-align:middle;"><label><b>Razão Social</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large w3-light-gray" name="razao" type="text" value="<?php echo $ver['afiliado_razao'];?>" readonly /></td>
                </tr>
                
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome Fantasia</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="fantasia" type="text" value="<?php echo $ver['afiliado_fantasia'];?>" required /></td>
                </tr>
                
                <tr>
                    <td style="vertical-align:middle;"><label><b>CNPJ</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_cnpj'] == ""){
                        ?>
                            <input name="cnpj" class="w3-input w3-border w3-round-large" id="inputdefault" type="text"  autocomplete="off" required>
                        <?Php
                            }else{
                        ?>
                            <input name="cnpj" value="<?php echo $ver['afiliado_cnpj']; ?>" class="w3-input w3-border w3-round-large w3-light-grey" type="text" autocomplete="off"  readonly="readonly">
                        <?Php    
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Inscrição Estadual/Municipal</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="inscricao" value="<?php echo $ver['afiliado_insc']; ?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Abertura</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="abertura" type="text" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" value="<?php echo $ver['afiliado_data_abertura']; ?>" /></td>
                </tr>
                
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados Pessoais</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_nome'] == ""){
                        ?>
                            <input class="w3-input w3-border w3-round-large" name="nome" type="text" value="" required />
                        <?Php  
                            }else{
                        ?>
                            <input class="w3-input w3-border w3-round-large w3-light-grey" name="nome" type="text" value="<?php echo $ver['afiliado_nome']; ?>" readonly />
                        <?Php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>CPF</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_cpf'] == ""){
                        ?>
                            <input name="cpf" class="w3-input w3-border w3-round-large" id="inputdefault" type="text"  autocomplete="off" required>
                        <?Php
                            }else{
                        ?>
                            <input name="cpf" value="<?php echo $ver['afiliado_cpf']; ?>" class="w3-input w3-border w3-round-large w3-light-grey" type="text" autocomplete="off"  readonly="readonly">
                        <?Php    
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>RG</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="rg" value="<?php echo $ver['afiliado_rg']; ?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nascimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="nascimento" type="text" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" value="<?php echo $ver['afiliado_nascimento']; ?>" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Sexo</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_sexo'];?>"><?php echo strtoupper($ver['afiliado_sexo']);?></option>
            	            <option value=""></option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMININO">FEMININO</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado Civil</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_estado_civil'];?>"><?php echo strtoupper($ver['afiliado_estado_civil']);?></option>'Solteiro (a)','Casado (a)','Viúvo (a)','Divorciado (a)','União Estável'
            	            <option value=""></option>
                            <option value="Solteiro (a)">Solteiro (a)</option>
                            <option value="Casado (a)">Casado (a)</option>
                            <option value="Viúvo (a)">Viúvo (a)</option>
                            <option value="Divorciado (a)">Divorciado (a)</option>
                            <option value="União Estável">União Estável</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Profissão</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="rg" value="<?php echo $ver['afiliado_profissao']; ?>" required /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Contato</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle;"><label><b>Telefone</b></label></td>
                    <td><input type="hidden" name="id" value="<?Php echo $id; ?>" />
                    <input class="w3-input w3-border w3-round-large" name="telefone" type="text" size="20" value="<?php echo $ver['afiliado_telefone'];?>" required /></td>
                </tr>	
                <tr>
                    <td style="vertical-align:middle;"><label><b>Celular</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="celular" type="text" size="20" value="<?php echo $ver['afiliado_celular'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>E-mail</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large w3-light-grey" size="40" name="email" style="text-transform:lowercase;"value="<?php echo $ver['afiliado_email'];?>" required /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Correspondência</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle; "><label><b>CEP</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cep'];?>" name="cep" onkeyup="Mascara('CEP',this,event)" type="text" id="cep" class="w3-input w3-border w3-round-large" size="10" onblur="pesquisacep(this.value);" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Endereço</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_endereco'];?>" name="rua" type="text" id="rua"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />     </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Bairro</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_bairro'];?>" name="bairro" id="bairro" class="w3-input w3-border w3-round-large" id="inputdefault" type="text" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" ></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Cidade</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cidade'];?>" name="cidade" type="text" id="cidade"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_estado'];?>" name="uf" type="text" id="uf"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>País</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_nacao'];?>" name="nacao" type="text" id="nacao"  class="w3-input w3-border w3-round-large w3-light-gray" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" readonly  /> </td>
                </tr>
                
                <?Php
                    if($ver['afiliado_pin'] == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
                ?>
                <tr class="w3-teal w3-round-large">
                    <td colspan="2">Cadastrar PIN</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Novo PIN</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" placeholder="Somente Números (4 Números)" name="senhanova" type="password" size="20" maxlength="4" onkeypress='return SomenteNumero(event)' required /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="senhanova" type="hidden" value="<?Php echo $pin; ?>" />
                <?Php
                    }
                ?>
                
                
                <?Php
                    if($ver['afiliado_credenciamento'] == "Sim"){
                ?>
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados do Estabelecimento</div>
                    <input name="credenciamento" type="hidden" value="Sim" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Tipo de Estabelecimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="tipoLoja" type="text" value="<?php echo $ver['afiliado_tipo_negocio'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Site</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="site" type="text" value="<?php echo $ver['afiliado_site'];?>" /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="credenciamento" type="hidden" value="Não" />
                <?Php
                    }
                ?>
                
                
            </table>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;" onclick="document.getElementById('alterarDados2').style.display='none'" type="button"><i class="fa fa-times" style="font-size:16px;" aria-hidden="true"></i> Cancelar</button></td>
        <td style="width:50%; text-align:left;"><button class="btn-lg w3-teal w3-input w3-padding-16" type="submit" style="width:100%;" ><i style="font-size:16px;" class="fa fa-check" aria-hidden="true" ></i> Alterar</button></td>
        
    </tr>
</table> 
            
    
        </form>
        
    </div>
</div>
<!--- fim modal pessoa juridica --->







<!--- modal pessoa física internacional --->

<div id="alterarDados3" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-shadow" style="width:50%; border-radius:10px; padding-bottom:10px; margin-bottom:20px;">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <h4><i class="fa fa-id-card" aria-hidden="true"></i> Alterar Dados</h4>
        </header><br>
        
        <form action="dados_editar_internacional.php?id=<?Php echo $id; ?>" method="post" name="form1" class="w3-container">
            
            <table class="table w3-bordered">
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Login de Acesso</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Usuário</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="login" value="<?php echo $ver['afiliado_usuario']; ?>" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados Pessoais</div></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_nome'] == ""){
                        ?>
                            <input class="w3-input w3-border w3-round-large" name="nome" type="text" value="" required />
                        <?Php  
                            }else{
                        ?>
                            <input class="w3-input w3-border w3-round-large w3-light-grey" name="nome" type="text" value="<?php echo $ver['afiliado_nome']; ?>" readonly />
                        <?Php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Documento/Passaporte</b></label></td>
                    <td>
                        <?Php
                            if($ver['afiliado_cpf'] == ""){
                        ?>
                            <input name="cpf" class="w3-input w3-border w3-round-large" id="inputdefault" type="text"  autocomplete="off" required>
                        <?Php
                            }else{
                        ?>
                            <input name="cpf" value="<?php echo $ver['afiliado_cpf']; ?>" class="w3-input w3-border w3-round-large w3-light-grey" type="text" autocomplete="off"  readonly="readonly">
                        <?Php    
                            }
                        ?>
                        <input name="rg" value="" type="hidden" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nascimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="nascimento" type="text" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" value="<?php echo $ver['afiliado_nascimento']; ?>" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Sexo</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_sexo'];?>"><?php echo strtoupper($ver['afiliado_sexo']);?></option>
            	            <option value=""></option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMININO">FEMININO</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado Civil</b></label></td>
                    <td><select class="w3-input w3-border w3-round-large" name="sexo">
            	            <option value="<?php echo $ver['afiliado_estado_civil'];?>"><?php echo strtoupper($ver['afiliado_estado_civil']);?></option>'Solteiro (a)','Casado (a)','Viúvo (a)','Divorciado (a)','União Estável'
            	            <option value=""></option>
                            <option value="Solteiro (a)">Solteiro (a)</option>
                            <option value="Casado (a)">Casado (a)</option>
                            <option value="Viúvo (a)">Viúvo (a)</option>
                            <option value="Divorciado (a)">Divorciado (a)</option>
                            <option value="União Estável">União Estável</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Profissão</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="rg" value="<?php echo $ver['afiliado_profissao']; ?>" required /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Contato</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle;"><label><b>Telefone</b></label></td>
                    <td><input type="hidden" name="id" value="<?Php echo $id; ?>" />
                    <input class="w3-input w3-border w3-round-large" name="telefone" type="text" size="20" value="<?php echo $ver['afiliado_telefone'];?>" /></td>
                </tr>	
                <tr>
                    <td style="vertical-align:middle;"><label><b>Celular</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="celular" type="text" size="20" value="<?php echo $ver['afiliado_celular'];?>" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>E-mail</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large w3-light-grey" size="40" name="email" style="text-transform:lowercase;"value="<?php echo $ver['afiliado_email'];?>" readonly /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados de Correspondência</div></td>
                </tr>
  
                <tr>
                    <td style="vertical-align:middle; "><label><b>ZIP CODE</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cep'];?>" name="cep" type="text" class="w3-input w3-border w3-round-large" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Endereço</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_endereco'];?>" name="rua" type="text" id="rua"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />
                    <input value="" name="bairro" type="hidden"></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Cidade</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_cidade'];?>" name="cidade" type="text" class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Estado ou Província</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_estado'];?>" name="uf" type="text"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>País</b></label></td>
                    <td><input value="<?php echo $ver['afiliado_nacao'];?>" name="nacao" type="text" id="nacao"  class="w3-input w3-border w3-round-large" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  /> </td>
                </tr>
                
                <?Php
                    if($ver['afiliado_pin'] == "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb"){
                ?>
                <tr class="w3-teal w3-round-large">
                    <td colspan="2">Cadastrar PIN</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Novo PIN</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" placeholder="Somente Números (4 Números)" name="senhanova" type="password" size="20" maxlength="4" onkeypress='return SomenteNumero(event)' required /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="senhanova" type="hidden" value="<?Php echo $pin; ?>" />
                <?Php
                    }
                ?>
                
                
                <?Php
                    if($ver['afiliado_credenciamento'] == "Sim"){
                ?>
                <tr>
                    <td colspan="2"><div class="w3-black w3-round w3-padding">Dados do Estabelecimento</div>
                    <input name="credenciamento" type="hidden" value="Sim" /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Nome Fantasia</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="fantasia" type="text" value="<?php echo $ver['afiliado_fantasia'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Tipo de Estabelecimento</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="tipoLoja" type="text" value="<?php echo $ver['afiliado_tipo_negocio'];?>" required /></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;"><label><b>Site</b></label></td>
                    <td><input class="w3-input w3-border w3-round-large" name="site" type="text" value="<?php echo $ver['afiliado_site'];?>" /></td>
                </tr>
                <?Php
                    }else{
                ?>
                    <input name="credenciamento" type="hidden" value="Não" />
                <?Php
                    }
                ?>
                
                
            </table>

<table style="width:100%;">
    <tr>
        <td style="width:50%; text-align:right;"><button class="w3-input w3-red btn-lg w3-padding-16" style="width:98%;" onclick="document.getElementById('alterarDados3').style.display='none'" type="button"><i class="fa fa-times" style="font-size:16px;" aria-hidden="true"></i> Cancelar</button></td>
        <td style="width:50%; text-align:left;"><button class="btn-lg w3-teal w3-input w3-padding-16" type="submit" style="width:100%;" ><i style="font-size:16px;" class="fa fa-check" aria-hidden="true" ></i> Alterar</button></td>
        
    </tr>
</table> 
            
    
        </form>
        
    </div>
</div>
<!--- fim modal pessoa física internacional--->

<!---- fim modais de alterações --->







<div id="sair" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-3 w3-shadow" style="height:150px; width:100px; border-radius:10px">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <center><h3>Deseja Realmente Sair?</h3>
        </header>
        <center><br>
        <table style="width:98%; margin-top:10px;">
<tr>
<td style="border:none; text-align:left; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-red w3-padding-16" onclick="document.getElementById('sair').style.display='none'"><i class="fa fa-times" aria-hidden="true"></i> NÃO</button></td>
<td style="border:none; text-align:right; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-green w3-padding-16" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>'"><i style="font-size:16px;" class="fa fa-check" aria-hidden="true"></i> SIM</button></td>
</tr>
</table></center>
    </div>
</div>
</body>
</html>
<?Php
}
}
?>
