<?Php
session_start();

$id = $_GET['id'];
$empresa = $_POST['empresa'];

if($id == ""){
        echo "<script>location.href='../index.php?empresa=".$empresa."';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $name = $ver['afiliado_nome'];
    $telefone = $ver['afiliado_telefone'];
    $celular = $ver['afiliado_celular'];
    $email = strtolower($ver['afiliado_email']);
	
if($ver['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $name;
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $razao;
}

if($nomeAfiliado == ""){
	$nome = $login;
}else{
	$nome = $nomeAfiliado;
}
?>

<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<title>INTERNET BANKY ACCESS - <?Php echo $nomeEmpresa; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="icon" href="img/favicon/<?php echo $favicon; ?>" />
  <link rel="shortcut icon" href="img/favicon/<?php echo $favicon; ?>" />

<script src="../js/mascara.js"></script>
<script src="../js/jquery.maskedinput.js"></script>  
      
<script language="JavaScript">
function protegercodigo() {
	if (event.button==2||event.button==3){
		alert('Desculpe! Acesso não Autorizado!');}
	}
	document.onmousedown=protegercodigo
</script>

<style>
   
    *#conteudo2, html, body, iframe#conteudo2 {
        width:100%;
        height:80%;
    }
</style>

<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
</script>

<script language="javascript">
function show_fisica()
{
	document.getElementById('fisica').style.display='block';
	document.getElementById('juridica').style.display='none';
}
function show_juridica()
{
	document.getElementById('juridica').style.display='block';
	document.getElementById('fisica').style.display='none';
}
</script>

</head>
<body>


<div class="w3-container">

<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Fisica">

<?Php
$nacao = $_POST['nacao'];
$email = $_POST['email'];
$tipo = $_POST['tipo'];
$cpfCnpj = $_POST['documento'];



//*** CADASTRO NACIONAL */
if($nacao == "BRASIL"){







//*** CADASTRO NACIONAL PESSOA FÍSICA */	
if($tipo == "Fisica"){
	
function validCPF($cpfCnpj){
  // determina um valor inicial para o digito $d1 e $d2
  // pra manter o respeito ;)
    $d1 = 0;
    $d2 = 0;
  // remove tudo que não seja número
  $cpfCnpj = preg_replace("/[^0-9]/", "", $cpfCnpj);
  // lista de cpf inválidos que serão ignorados
  $ignore_list = array(
    '00000000000',
    '01234567890',
    '11111111111',
    '22222222222',
    '33333333333',
    '44444444444',
    '55555555555',
    '66666666666',
    '77777777777',
    '88888888888',
    '99999999999'
  );
  // se o tamanho da string for dirente de 11 ou estiver
  // na lista de cpf ignorados já retorna false
  if(strlen($cpfCnpj) != 11 || in_array($cpfCnpj, $ignore_list)){
      return false;
  } else {
    // inicia o processo para achar o primeiro
    // número verificador usando os primeiros 9 dígitos
    for($i = 0; $i < 9; $i++){
      // inicialmente $d1 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
      $d1 += $cpfCnpj[$i] * (10 - $i);
    }
    // acha o resto da divisão da soma acima por 11
    $r1 = $d1 % 11;
    // se $r1 maior que 1 retorna 11 menos $r1 se não
    // retona o valor zero para $d1
    $d1 = ($r1 > 1) ? (11 - $r1) : 0;
    // inicia o processo para achar o segundo
    // número verificador usando os primeiros 9 dígitos
    for($i = 0; $i < 9; $i++) {
      // inicialmente $d2 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
      $d2 += $cpfCnpj[$i] * (11 - $i);
    }
    // $r2 será o resto da soma do cpf mais $d1 vezes 2
    // dividido por 11
    $r2 = ($d2 + ($d1 * 2)) % 11;
    // se $r2 mair que 1 retorna 11 menos $r2 se não
    // retorna o valor zeroa para $d2
    $d2 = ($r2 > 1) ? (11 - $r2) : 0;
    // retona true se os dois últimos dígitos do cpf
    // forem igual a concatenação de $d1 e $d2 e se não
    // deve retornar false.
    return (substr($cpfCnpj, -2) == $d1 . $d2) ? true : false;
  }
}


/*CPF VÁLIDO*/
if(validCPF($cpfCnpj)){


/*PESQUISAR SE O CPF ESTÁ CADASTRADO*/
$sqlCPF = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_cpf='$cpfCnpj' AND afiliado_conta_modo='$tipo' AND afiliado_empresa='$empresa'");
$verCPF = mysqli_fetch_array($sqlCPF);

if($cpfCnpj != $verCPF['afiliado_cpf']){

?>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:5px; margin-bottom:10px;">
        Dados Pessoais
    </div>
    
<form action="cadastro_confirmar.php" method="post" name="form1" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?Php echo $id; ?>">
     <input type="hidden" name="modo" value="<?Php echo $tipo; ?>">
     <input type="hidden" name="cpfLimpo" value="<?Php echo $cpfCnpj; ?>">
     <input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
     <input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
     
     <input name="razao" type="hidden" value="">
     <input name="fantasia" type="hidden" value="">
     <input name="cnpj" type="hidden" value="">
     <input name="inscricao" type="hidden" value="">
     <input name="abertura" type="hidden" value="">
     
     <input class="w3-input w3-padding-8 w3-border w3-round" placeholder="Nome Completo" id="name" name="nome" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required>

<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="cpf"  value="<?Php echo $cpfCnpj; ?>" class="w3-input w3-border w3-round w3-light-gray" id="inputdefault" style="text-transform:uppercase; margin-top:5px; font-family:Trebuchet MS, sans-serif; padding:7px 5px;" type="text"   autocomplete="off"  readonly="readonly">
    </div>
    <div class="w3-cell w3-mobile">
        <input class="w3-input w3-padding-8 w3-border w3-round" id="rg" name="rg" placeholder="RG"   type="tel" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;"  required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="nascimento"  class="w3-input w3-padding-8 w3-border w3-round" placeholder="Data de Nascimento" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" id="inputdefault" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" maxlength="10" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <select name="sexo" class="w3-input w3-border w3-round" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif; padding:9px 0px;" required>
                        <option value="">Sexo...</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMININO">FEMININO</option>
                    </select>
    </div>
</div>


<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Dados de Contato
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="telefone" placeholder="Telefone" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" onkeyup="Mascara('TEL',this,event)" onkeypress="return digitos(event, this)" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" maxlength="15" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="celular" placeholder="Celular" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" onkeyup="Mascara('TEL',this,event)" onkeypress="return digitos(event, this)" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" maxlength="15" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="email" placeholder="E-mail" value="<?Php echo $email; ?>"  class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" type="email" autocomplete="off" style="text-transform:lowercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" required>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Dados de Correspondência
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="cep" placeholder="CEP" onkeyup="Mascara('CEP',this,event)" type="tel" id="cep" class="w3-input w3-padding-8 w3-border w3-round" size="10" maxlength="9" onblur="pesquisacep(this.value);" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="rua" placeholder="ENDEREÇO" type="text" id="rua"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />
    </div>
</div>

<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="bairro" placeholder="BAIRRO" class="w3-input w3-padding-8 w3-border w3-round" id="bairro" type="text" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" >
    </div>
    <div class="w3-cell w3-mobile">
        <input name="cidade" type="text" id="cidade" placeholder="CIDADE"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  />
    </div>
    <div class="w3-cell w3-mobile">
        <select id="uf" name="uf" class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif; padding:9px 0;" required>
                        <option value="">ESTADO...</option>
			            <option value="AC">Acre</option>
			            <option value="AL">Alagoas</option>
			            <option value="AP">Amapá</option>
			            <option value="AM">Amazonas</option>
			            <option value="BA">Bahia</option>
			            <option value="CE">Ceará</option>
			            <option value="DF">Distrito Federal</option>
			            <option value="ES">Espírito Santo</option>
			            <option value="GO">Goiás</option>
			            <option value="MA">Maranhão</option>
			            <option value="MT">Mato Grosso</option>
			            <option value="MS">Mato Grosso do Sul</option>
			            <option value="MG">Minas Gerais</option>
			            <option value="PA">Pará</option>
			            <option value="PB">Paraíba</option>
			            <option value="PR">Paraná</option>
			            <option value="PE">Pernambuco</option>
			            <option value="PI">Piauí</option>
			            <option value="RJ">Rio de Janeiro</option>
			            <option value="RN">Rio Grande do Norte</option>
			            <option value="RS">Rio Grande do Sul</option>
			            <option value="RO">Rondônia</option>
			            <option value="RR">Roraima</option>
			            <option value="SC">Santa Catarina</option>
			            <option value="SP">São Paulo</option>
			            <option value="SE">Sergipe</option>
			            <option value="TO">Tocantins</option>
		            </select>
	</div>
    <div class="w3-cell w3-mobile">
        <input name="nacao" class="w3-input w3-border w3-round w3-light-gray" style="padding:7px 5px;" type="type" value="<?Php echo $nacao; ?>" readonly>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Cadastre seu PIN - Este código é necessário para efetuar e autorizar suas transações
    </div>


<div class="w3-cell-row" style="margin-bottom:25px;">
    <div class="w3-cell w3-mobile">
        <input name="pin" id="pass" type="password" class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" placeholder="PIN" required maxlength="4" style="font-size:20px; width:95%; text-align:center; background-color: #fff; position:absolute;">
  
  <input type="tel" class="form-control ng-valid-minlength ng-dirty ng-valid ng-valid-required" id="passReal" name="passReal"  data-ng-minlength="4" maxlength="4" data-display-error-onblur="" data-number-mask="telephone" tabindex="5" style="border:none; background:none;"></div>

</div>

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>

                   

</form> 










<?Php
//*** FIM CADASTRO NACIONAL PESSOA FÍSICA */

/*ALERTA CPF CADASTRADO*/
}else{
?>
<div class="w3-container">

<div class="alert-danger w3-padding w3-round">Desculpe! Este CPF <strong><?Php echo $cpfCnpj; ?></strong>, já encontra-se cadastrado em nossa empresa.</div><br>

<b>2º Passo:</b> INFORME UM NOVO CPF.<br><br>

<div id="fisica">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Fisica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="NOVO CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>


<?Php
}




/*ALERTA CPF INVÁLIDO*/
}else{
?>
<div class="w3-container">

<div class="alert-danger w3-padding w3-round w3-center">CPF INVÁLIDO!</div><br>

<b>2º Passo:</b> INFORME O CPF CORRETO.<br><br>

<div id="fisica">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Fisica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="SEU CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>
<?Php
}







//*** CADASTRO NACIONAL PESSOA JURIDICA */		
}elseif($tipo == "Juridica"){
	
function validar_cnpj($cpfCnpj){
	$cpfCnpj = preg_replace('/[^0-9]/', '', (string) $cpfCnpj);
	// Valida tamanho
	if (strlen($cpfCnpj) != 14)
		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cpfCnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cpfCnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cpfCnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cpfCnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

/* CNPJ VÁLIDO */
if(validar_cnpj($cpfCnpj)){


/*PESQUISAR SE O CNPJ ESTÁ CADASTRADO*/
$sqlCNPJ = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_cnpj='$cpfCnpj' AND afiliado_conta_modo='$tipo' AND afiliado_empresa='$empresa'");
$verCNPJ = mysqli_fetch_array($sqlCNPJ);

if($cpfCnpj != $verCNPJ['afiliado_cnpj']){
?>


<form action="cadastro_confirmar.php" method="post" name="form1" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?Php echo $id; ?>">
     <input type="hidden" name="modo" value="<?Php echo $tipo; ?>">
     <input type="hidden" name="cpfLimpo" value="<?Php echo $cpfCnpj; ?>">
     <input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
     <input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
     
<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:5px; margin-bottom:10px;">
        Dados Jurídicos
    </div> 
    
    <input class="form-control input-lg" placeholder="Razão Social" id="razao" name="razao" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required>     

<div class="w3-cell-row">
<div class="w3-cell w3-mobile"><input class="form-control input-lg" placeholder="Nome Fantasia" id="fantasia" name="fantasia" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required> </div>
<div class="w3-cell w3-mobile">
        <input name="cnpj"  value="<?Php echo $cpfCnpj; ?>" class="form-control input-lg" id="inputdefault" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" type="text"   autocomplete="off"  readonly="readonly">
    </div>
    
    <div class="w3-cell w3-mobile"><input class="form-control input-lg" placeholder="Inscrição Estadual" id="inscricao" name="inscricao" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required> </div>
    
    <div class="w3-cell w3-mobile">
        <input name="abertura"  class="form-control input-lg" placeholder="Data de Abertura" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" id="inputdefault" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" maxlength="10" type="tel" autocomplete="off" required>
    </div>
</div>     



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:5px; margin-bottom:10px;">
        Dados Pessoais
    </div>
     
     <input class="w3-input w3-padding-8 w3-border w3-round" placeholder="Nome Completo" id="name" name="nome" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required>

<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input class="w3-input w3-padding-8 w3-border w3-round" name="cpf" type="tel" placeholder="CPF" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CPF',this,event)" maxlength="14" required style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" />
    </div>
    <div class="w3-cell w3-mobile">
        <input class="w3-input w3-padding-8 w3-border w3-round" id="rg" name="rg" placeholder="RG"   type="tel" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;"  required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="nascimento"  class="w3-input w3-padding-8 w3-border w3-round" placeholder="Data de Nascimento" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" id="inputdefault" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" maxlength="10" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <select name="sexo" class="w3-input w3-border w3-round" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif; padding:9px 0px;"" required>
                        <option value="">Sexo...</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMININO">FEMININO</option>
                    </select>
    </div>
</div>


<div class="w3-container-fluid w3-padding w3-black w3-round" style="font-size:12px; margin-top:5px; margin-bottom:10px;">
        Dados de Contato
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="telefone" placeholder="Telefone" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" onkeyup="Mascara('TEL',this,event)" onkeypress="return digitos(event, this)" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" maxlength="15" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="celular" placeholder="Celular" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" onkeyup="Mascara('TEL',this,event)" onkeypress="return digitos(event, this)" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" maxlength="15" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="email" placeholder="E-mail" value="<?Php echo $email; ?>"  class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" type="email" autocomplete="off" style="text-transform:lowercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" required>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Dados de Correspondência
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="cep" placeholder="CEP" onkeyup="Mascara('CEP',this,event)" type="tel" id="cep" class="w3-input w3-padding-8 w3-border w3-round" size="10" maxlength="9" onblur="pesquisacep(this.value);" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="rua" placeholder="ENDEREÇO" type="text" id="rua"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />
    </div>
</div>

<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="bairro" placeholder="BAIRRO" class="w3-input w3-padding-8 w3-border w3-round" id="bairro" type="text" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" >
    </div>
    <div class="w3-cell w3-mobile">
        <input name="cidade" type="text" id="cidade" placeholder="CIDADE"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  />
    </div>
    <div class="w3-cell w3-mobile">
        <select id="uf" name="uf" class="w3-input w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif; padding:9px 0;" required>
                        <option value="">ESTADO...</option>
			            <option value="AC">Acre</option>
			            <option value="AL">Alagoas</option>
			            <option value="AP">Amapá</option>
			            <option value="AM">Amazonas</option>
			            <option value="BA">Bahia</option>
			            <option value="CE">Ceará</option>
			            <option value="DF">Distrito Federal</option>
			            <option value="ES">Espírito Santo</option>
			            <option value="GO">Goiás</option>
			            <option value="MA">Maranhão</option>
			            <option value="MT">Mato Grosso</option>
			            <option value="MS">Mato Grosso do Sul</option>
			            <option value="MG">Minas Gerais</option>
			            <option value="PA">Pará</option>
			            <option value="PB">Paraíba</option>
			            <option value="PR">Paraná</option>
			            <option value="PE">Pernambuco</option>
			            <option value="PI">Piauí</option>
			            <option value="RJ">Rio de Janeiro</option>
			            <option value="RN">Rio Grande do Norte</option>
			            <option value="RS">Rio Grande do Sul</option>
			            <option value="RO">Rondônia</option>
			            <option value="RR">Roraima</option>
			            <option value="SC">Santa Catarina</option>
			            <option value="SP">São Paulo</option>
			            <option value="SE">Sergipe</option>
			            <option value="TO">Tocantins</option>
		            </select>
	</div>
    <div class="w3-cell w3-mobile">
        <input name="nacao" class="w3-input w3-border w3-round w3-light-gray" style="padding:7px 5px;" type="type" value="<?Php echo $nacao; ?>" readonly>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Cadastre seu PIN - Este código é necessário para efetuar e autorizar suas transações
    </div>


<div class="w3-cell-row" style="margin-bottom:25px;">
    <div class="w3-cell w3-mobile">
        <input name="pin" id="pass" type="password" class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" placeholder="PIN" required maxlength="4" style="font-size:20px; width:95%; text-align:center; background-color: #fff; position:absolute;">
  
  <input type="tel" class="form-control ng-valid-minlength ng-dirty ng-valid ng-valid-required" id="passReal" name="passReal"  data-ng-minlength="4" maxlength="4" data-display-error-onblur="" data-number-mask="telephone" tabindex="5" style="border:none; background:none;"></div>

</div>

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>

                   

</form> 


<?Php
/*ALERTA CNPJ CADASTRADO*/
}else{
?>
<div class="w3-container">

<div class="alert-danger w3-padding w3-round">Desculpe! Este CNPJ <strong><?Php echo $cpfCnpj; ?></strong>, já encontra-se cadastrado em nossa empresa.</div><br>

<b>2º Passo:</b> INFORME UM NOVO CNPJ.<br><br>

<div id="juridica">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Juridica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="NOVO CNPJ" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CNPJ',this,event)" maxlength="18" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>
<?Php
}

/*CNPJ INVÁLIDO OU INCORRETO*/
}else{
?>
<div class="w3-container">

<div class="alert-danger w3-padding w3-round w3-center">CNPJ INVÁLIDO.</div><br>

<b>2º Passo:</b> INFORME O CNPJ CORRETO.<br><br>

<div id="juridica">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input name="tipo" type="hidden" value="Juridica">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="CNPJ CORRETO" onkeypress="return SomenteNumero(event);" onkeyup="Mascara('CNPJ',this,event)" maxlength="18" style="margin-bottom:5px; text-align:center;" /><br>

<div class="w3-bar">
<a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
<button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
<button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>
</form>
</div>
<?Php
}

//*** FIM CADASTRO NACIONAL PESSOA JURIDICA */	
}
//*** FIM CADASTRO NACIONAL */









//*** CADASTRO INTERNACIONAL */	
}elseif($nacao != "BRASIL"){

/*PESQUISAR SE O CNPJ ESTÁ CADASTRADO*/
$sqlCNPJ = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_cpf='$cpfCnpj' AND afiliado_conta_modo='$tipo' AND afiliado_empresa='$empresa'");
$verCNPJ = mysqli_fetch_array($sqlCNPJ);

if($cpfCnpj != $verCNPJ['afiliado_cnpj']){
?>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:5px; margin-bottom:10px;">
        Dados Pessoais
    </div>
    
<form action="cadastro_confirmar.php" method="post" name="form1" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?Php echo $id; ?>">
     <input type="hidden" name="modo" value="<?Php echo "Fisica"; ?>">
     <input type="hidden" name="cpfLimpo" value="<?Php echo $cpfCnpj; ?>">
     <input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
     <input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
     
     <input name="razao" type="hidden" value="">
     <input name="fantasia" type="hidden" value="">
     <input name="cnpj" type="hidden" value="">
     <input name="inscricao" type="hidden" value="">
     <input name="abertura" type="hidden" value="">
     
     <input class="w3-input w3-padding-8 w3-border w3-round" placeholder="Nome Completo" id="name" name="nome" type="text" style="text-transform:uppercase; font-family:Trebuchet MS, sans-serif;" required>

<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="cpf"  value="<?Php echo $cpfCnpj; ?>" class="w3-input w3-border w3-round w3-light-gray" id="inputdefault" style="text-transform:uppercase; margin-top:5px; font-family:Trebuchet MS, sans-serif; padding:7px 5px;" type="text"   autocomplete="off"  readonly="readonly">
    </div>    
    <div class="w3-cell w3-mobile">
    	<input name="rg" type="hidden" value="" >
        <input name="nascimento"  class="w3-input w3-padding-8 w3-border w3-round" placeholder="Data de Nascimento" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" id="inputdefault" onkeypress="return digitos(event, this)" onkeyup="Mascara('DATA',this,event)" maxlength="10" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <select name="sexo" class="w3-input w3-border w3-round" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif; padding:9px 0px;"" required>
                        <option value="">Sexo...</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMININO">FEMININO</option>
                    </select>
    </div>
</div>


<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Dados de Contato
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="telefone" placeholder="Telefone" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="celular" placeholder="Celular" class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" style="text-transform:uppercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" type="tel" autocomplete="off" required>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="email" placeholder="E-mail" value="<?Php echo $email; ?>"  class="w3-input w3-padding-8 w3-border w3-round" id="inputdefault" type="email" autocomplete="off" style="text-transform:lowercase; margin-top:5px;font-family:Trebuchet MS, sans-serif;" required>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Dados de Correspondência
    </div>


<div class="w3-cell-row">
    <div class="w3-cell w3-mobile">
        <input name="cep" placeholder="ZIP CODE" type="tel" id="cep" class="w3-input w3-padding-8 w3-border w3-round" size="10" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" autocomplete="off" required/>
    </div>
    <div class="w3-cell w3-mobile">
        <input name="rua" placeholder="ENDEREÇO" type="text" class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required />
    </div>
</div>

<div class="w3-cell-row">    
    <div class="w3-cell w3-mobile">
    	<input name="bairro" type="hidden" value="" >
        <input name="cidade" type="text" placeholder="CIDADE"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  />
    </div>
    <div class="w3-cell w3-mobile">
        <input name="uf" type="text" placeholder="ESTADO OU PROVÍNCIA"  class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" style="text-transform:uppercase; margin-top:2px;font-family:Trebuchet MS, sans-serif;" required  />
    </div>    
    <div class="w3-cell w3-mobile">
        <input name="nacao" class="w3-input w3-border w3-round w3-light-gray" style="padding:7px 5px;" type="type" value="<?Php echo $nacao; ?>" readonly>
    </div>
</div>



<div class="w3-container-fluid w3-padding w3-black w3-round" style=" font-size:12px; margin-top:10px; margin-bottom:5px;">
        Cadastre seu PIN - Este código é necessário para efetuar e autorizar suas transações
    </div>


<div class="w3-cell-row" style="margin-bottom:25px;">
    <div class="w3-cell w3-mobile">
        <input name="pin" id="pass" type="password" class="w3-input w3-padding-8 w3-border w3-round" autocomplete="off" placeholder="PIN" required maxlength="4" style="font-size:20px; width:95%; text-align:center; background-color: #fff; position:absolute;">
  
  <input type="tel" class="form-control ng-valid-minlength ng-dirty ng-valid ng-valid-required" id="passReal" name="passReal"  data-ng-minlength="4" maxlength="4" data-display-error-onblur="" data-number-mask="telephone" tabindex="5" style="border:none; background:none;"></div>

</div>

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>

                   

</form> 
<?Php
/*ALERTA DOCUMENTO/PASSAPORTE CADASTRADO*/
}else{
?>
<div class="w3-container">

<div class="alert-danger w3-padding w3-round">Desculpe! Este Documento/Passaporte <strong><?Php echo $cpfCnpj; ?></strong>, já encontra-se cadastrado em nossa empresa.</div><br>

<b>2º Passo:</b> INFORME UM NOVO DOCUMENTO DE IDENTIFICAÇÃO/PASSAPORTE.<br><br>

<div id="juridica">
<form action="cadastro3.php?id=<?Php echo $id; ?>" method="post">
<input name="nacao" type="hidden" value="<?Php echo $nacao; ?>">
<input name="empresa" type="hidden" value="<?Php echo $empresa; ?>">
<input name="email" type="hidden" value="<?Php echo $email; ?>">
<input class="w3-input w3-padding-16 w3-border w3-round" name="documento" type="tel" placeholder="DOCUMENTO DE IDENTIFICAÇÃO E/OU PASSAPORTE" onkeypress="return SomenteNumero(event);" style="margin-bottom:5px; text-align:center;" required /><br>

<div class="w3-bar">
  <a href="cadastro1.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button type="button" class="w3-bar-item w3-button w3-red w3-hover-black w3-padding-16" style="width:33.3%; border-radius:5px 0 0 5px;">CANCELAR</button></a>
  <button type="reset" class="w3-bar-item w3-button w3-amber w3-hover-black w3-text-white w3-padding-16" style="width:33.3%">LIMPAR</button>
  <button type="submit" class="w3-bar-item w3-button w3-teal w3-hover-black w3-padding-16" style="width:33.3%; border-radius:0 5px 5px 0;">AVANÇAR</button>
</div>


</form>
</div>
<?Php
}
//*** FIM CADASTRO INTERNACIONAL */	
}
?>

</div>

</body>
</html>


<?Php
}
?>