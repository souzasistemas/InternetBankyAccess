<?Php
session_start();

$id = $_GET['id'];

require "../../../config/config.php";

$sqlAdmin = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$verAdmin = mysqli_fetch_array($sqlAdmin);
    $permissao = $verAdmin['admin_permissao'];
    $emp = $verAdmin['admin_empresa'];
    
    
$dias_de_prazo_para_pagamento2 = 32;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$dataExpira = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));

$afiliado = $_GET['afiliado_id'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$afiliado'");
$ver = mysqli_fetch_array($sql);

?>
<html lang="pt">
<head>
  <title>Administrativo</title>
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
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  	


<script src="../../js/mascara.js"></script>


  
 <style type="text/css">

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

@media only screen and (max-width: 687px) {
    #sumir {
        display:none;
    }
    
    
}

input, select{
    margin-bottom:2px;
}
  </style>

<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('empresa').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('empresa').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('id').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('id').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('nome').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('nome').disabled = true;
      }
    }
  </script>

</head>
<body id="principal" class="w3-light-grey">


<div class="w3-container-fluid w3-padding">
    
<div class="w3-border w3-padding w3-round w3-black w3-margin-bottom">
<h2 class="w3-large"><i class="fas fa-address-card"></i> Editar Associado Conta <?Php echo $afiliado; ?>-<?Php echo $ver['afiliado_codigo']; ?></h2></div>


<form action="editar_afiliado_edicao.php" method="post" name="form" enctype="multipart/form-data">


<div class="w3-third w3-padding ">
<input  readonly value="DADOS DA EMPRESA" class="w3-input w3-round w3-black">

<table class="w3-table">
<tr>
    <td width="32%" style="vertical-align:middle;"><b>Razão Social</b></td>
    <td><input class="w3-input w3-border w3-round"  type="text" name="razao" id="nome2" value="<?Php echo $ver['afiliado_razao']; ?>" style="text-transform:uppercase;" /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>Fantasia</b></td>
    <td><input class="w3-input w3-border w3-round"  type="text" name="fantasia" id="nome2" value="<?Php echo $ver['afiliado_fantasia']; ?>" style="text-transform:uppercase;"/></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>CNPJ</b></td>
    <td><input class="w3-input w3-border w3-round"  name="cnpj" type="text" onkeyup="Mascara('CNPJ',this,event)" value="<?Php echo $ver['afiliado_cnpj']; ?>" maxlength="18" style="text-transform:uppercase;" /></td>
  </tr>
  
  <tr>
    	<td style="vertical-align:middle;"><b>Docum./Insc</b></td>
        <td><input class="w3-input w3-border w3-round"  type="text" name="inscricao" id="rg" value="<?Php echo $ver['afiliado_insc']; ?>" /></td>
  </tr>
  <tr>
        <td style="vertical-align:middle;"><b>Abertura</b></td>
        <td><input class="w3-input w3-border w3-round"  type="text" name="abertura" value="<?Php echo $ver['afiliado_data_abertura']; ?>" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" style="text-transform:uppercase;" /></td>
    </tr>
</table>

<input  readonly value="DADOS PESSOAIS OU RESPONSÁVEL" class="w3-input w3-round w3-black">
<table class="w3-table">
<tr>
    <td style="vertical-align:middle;"><b>Nome</b></td>
    <td><input class="w3-input w3-border w3-round"  type="text" name="nome" id="nome2" value="<?Php echo $ver['afiliado_nome']; ?>" style="text-transform:uppercase;"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>CPF</b></td>
    <td><input class="w3-input w3-border w3-round"  name="cpf" type="text" onkeyup="Mascara('CPF',this,event)" value="<?Php echo $ver['afiliado_cpf']; ?>" maxlength="14" style="text-transform:uppercase;"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>RG</b></td>
    <td><input class="w3-input w3-border w3-round"  name="rg" type="text"  value="<?Php echo $ver['afiliado_rg']; ?>" style="text-transform:uppercase;"  /></td>
  </tr>
  
  <tr>
    	<td style="vertical-align:middle;"><b>Nascimento</b></td>
        <td><input class="w3-input w3-border w3-round"  type="text" name="nascimento" value="<?Php echo $ver['afiliado_nascimento']; ?>" maxlength="10" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" style="text-transform:uppercase;" /></td>
  </tr>
  <tr>
        <td style="vertical-align:middle;"><b>Sexo</b></td>
        <td>
        <select name="sexo" class="w3-input w3-border w3-round" id="inputdefault" style="text-transform:uppercase;" >
        <option value="<?Php echo $ver['afiliado_sexo']; ?>"><?Php echo $ver['afiliado_sexo']; ?></option>
      <option value=""></option>
      <option value="Masculino">Masculino</option>
      <option value="Feminino">Feminino</option>
    </select>
        </td>
    </tr>
</table>
</div>




<div class="w3-third w3-padding">
<input  readonly value="DADOS DE CONTATO" class="w3-input w3-round w3-black">

<table class="w3-table">
 <tr>
    <td width="32%" style="vertical-align:middle;"><b>Telefone</b></td>
    <td><input value="<?Php echo $ver['afiliado_telefone'];?>" class="w3-input w3-border w3-round"  name="telefone" type="text" onkeypress="return digitos(event, this)" style="text-transform:uppercase;"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>Celular</b></td>
    <td><input value="<?Php echo $ver['afiliado_celular'];?>" class="w3-input w3-border w3-round"  name="celular" type="text"  style="text-transform:uppercase;"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>E-mail</b></td>
    <td><input value="<?Php echo $ver['afiliado_email'];?>" class="w3-input w3-border w3-round"  type="text" name="email" id="email" value="" style="text-transform:lowercase;"  /></td>
  </tr> 
  
</table>

<input  readonly value="DADOS DE ENDEREÇO" class="w3-input w3-round w3-black">
<table class="w3-table">
<tr>
    <td width="32%" style="vertical-align:middle;"><b>CEP</b></td>
    <td><input value="<?Php echo $ver['afiliado_cep'];?>" name="cep" onkeyup="Mascara('CEP',this,event)" type="text" id="cep" class="w3-input w3-border w3-round" size="10" maxlength="9" onblur="pesquisacep(this.value);" style="text-transform:uppercase;" /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>Endereço</b></td>
    <td><input value="<?Php echo $ver['afiliado_endereco'];?>" name="rua" type="text" id="rua"  class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase;" /></td>
  </tr>
  
  <tr>
    <td style="vertical-align:middle;"><b>Bairro</b></td>
    <td ><input value="<?Php echo $ver['afiliado_bairro'];?>" name="bairro" type="text" id="bairro" class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase;"  /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>Cidade</b></td>
    <td ><input value="<?Php echo $ver['afiliado_cidade'];?>" name="cidade" type="text" id="cidade"  class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase;" /></td>
  </tr> 
  <tr>
    <td style="vertical-align:middle;"><b>Estado</b></td>
    <td ><input value="<?Php echo $ver['afiliado_estado'];?>" name="uf" type="text" id="uf"  class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase;" /></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><b>País</b></td>
    <td ><input value="<?Php echo $ver['afiliado_nacao'];?>" name="nacao" type="text"  class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase;" /></td>
  </tr>
  
</table>

</div>



<div class="w3-third w3-padding">
<input  readonly value="DADOS ADMINISTRATIVOS" class="w3-input w3-round w3-black"> 
<input name="id" value="<?php echo $afiliado; ?>" type="hidden">
<input name="adm" value="<?php echo $id; ?>" type="hidden">

<table class="w3-table">
    
    
    
    
<tr>
<td width="32%" style="vertical-align:middle;"><b>Corretor</b></td>
<td>
<select class="w3-input w3-border w3-round" name="patrocinador" style="text-transform:uppercase;"d>
<?php   
        $idCorrespondente = $ver['afiliado_indicador']; 
    $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idCorrespondente'");
    $verAssociado = mysqli_fetch_array($sqlAssociado);
    
    if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $nomeAssociado = $verAssociado['afiliado_nome'];
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $nomeAssociado = $verAssociado['afiliado_razao'];
                }
    ?>
          <option value="<?Php echo $idCorrespondente; ?>"> <?Php echo $idCorrespondente; ?> - <?Php echo $nomeAssociado; ?></option>
<option value=""></option>
<?Php
$sqlPat2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_link='Sim' AND afiliado_estabelecimento='$empresa' AND afiliado_id!='1386' ORDER BY afiliado_id");
while($verPat2 = mysqli_fetch_array($sqlPat2)){
$idPatSingle = $verPat2['afiliado_id'];
$modoAssociado = $verPat2['afiliado_conta_modo'];
	    
if($modoAssociado == "Fisica"){
    $nomeAssociado = $verPat2['afiliado_nome'];
}elseif($modoAssociado == "Juridica"){
    $nomeAssociado = $verPat2['afiliado_razao'];
}
?>
<option value="<?Php echo $idPatSingle; ?>"><?Php echo $idPatSingle."-".$verPat2['afiliado_codigo_verificador']." / ".strtoupper($nomeAssociado); ?></option>
<?Php
}
?>
</select>
</td>
</tr>





<tr>
<td style="vertical-align:middle;"><b>Liberar Link?</b></td>
<td> <select name="consultorLink" class="w3-input w3-border w3-round"  id="inputdefault" style="text-transform:uppercase;">
<option value="<?Php echo $ver['afiliado_link']; ?>"><?Php echo $ver['afiliado_link']; ?></option>
<option value=""></option>
<option value="Sim">Sim</option>
<option value="Não">Não</option>
</select>
</td>
</tr>


<tr>
<td style="vertical-align:middle;"><b>Comissão</b></td>
<td><select name="comissao" class="w3-input w3-border w3-round"  id="inputdefault" style="text-transform:uppercase;">
<option value="<?Php echo $ver['afiliado_comissao']; ?>"><?Php echo number_format(($ver['afiliado_comissao']*100), 2, ',', '.'); ?>%</option>
<option value=""></option>
<option value="0.000">0,00%</option>
<option value="0.001">0,10%</option>
<option value="0.002">0,20%</option>
<option value="0.003">0,30%</option>
<option value="0.004">0,40%</option>
<option value="0.005">0,50%</option>
<option value="0.006">0,60%</option>
<option value="0.007">0,70%</option>
<option value="0.008">0,80%</option>
<option value="0.009">0,90%</option>
<option value="0.010">1,00%</option>
</select></td>
</tr>


<tr>
<td style="vertical-align:middle;"><b>Tipo</b></td>
<td><select name="modo" class="w3-input w3-border w3-round"  id="inputdefault" style="text-transform:uppercase;">
<option value="<?Php echo $ver['afiliado_conta_modo']; ?>"><?Php echo $ver['afiliado_conta_modo']; ?></option>
<option value=""></option>
<option value="Fisica">FÍSICA</option>
<option value="Juridica">JURÍDICA</option>
</select></td>
</tr>   


<tr>
<td style="vertical-align:middle;"><b>Status</b></td>
<td><select name="status" class="w3-input w3-border w3-round" id="inputdefault" style="text-transform:uppercase;">
<option value="<?Php echo $ver['afiliado_status']; ?>"><?Php echo $ver['afiliado_status']; ?></option>
<option value=""></option>
<option value="Ativo">Ativo</option>
<option value="Bloqueado">Bloqueado</option>
<option value="Pendente">Pendente</option>
</select></td>
</tr>

<tr>
    <td style="vertical-align:middle;"><b>Login</b></td>
    <td><input name="usuarioAcesso" type="text" value="<?Php echo $ver['afiliado_usuario']; ?>" class="w3-input w3-border w3-round" style="text-transform:lowercase;" /></td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="obs" class="w3-input w3-border w3-round" style="text-transform:uppercase;" rows="5" placeholder="Informações Adicionais e Observações"><?Php echo $ver['afiliado_obs']; ?></textarea></td>
  </tr>


<tr>
<td colspan="2"><iframe src="resetar_senha_cartao.php?id=<?php echo $afiliado; ?>" style='width:100%; height:50px;' scrolling="no" frameborder="0"></iframe></td>
</tr>
<tr>
<td colspan="2"><button name="Submit" type="submit" class="btn btn-lg btn-success" style="width:100%; margin-bottom:5px;"><span class="glyphicon glyphicon-ok"></span> Editar Conta <?Php echo $afiliado; ?>-<?Php echo $ver['afiliado_codigo_verificador']; ?> </button>
</td>
</tr>
</table>
</div>


</form>



</div>    
</body>
</html>