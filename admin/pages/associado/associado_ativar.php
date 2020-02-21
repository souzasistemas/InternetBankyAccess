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

<body id="principal">
    
<?Php
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");


require "../../../config/config.php";
require "../../../config/config2.php";

$id = $_GET['adm'];
$doc = $_GET['doc'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_documentacao WHERE sis_doc_id='$doc'");
$ver = mysqli_fetch_array($sql);
    $idAfiliado = $ver['sis_doc_afiliado_id'];
    $foto_perfil = $ver['sis_doc_foto'];
    
$sqlAfiliado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");
$verAfiliado = mysqli_fetch_array($sqlAfiliado);
    $email = $verAfiliado['afiliado_email'];
    $nacao = $verAfiliado['afiliado_nacao'];
    $sexoAfiliado = $verAfiliado['afiliado_sexo'];
    $nascimento = $verAfiliado['afiliado_nascimento'];
    $idioma = $verAfiliado['afiliado_idioma'];
    $moeda = $verAfiliado['afiliado_moeda'];
    $tipo_conta_vite7 = $verAfiliado['afiliado_conta_vite7'];
    $endereco = $verAfiliado['afiliado_endereco'];
    $cidade = $verAfiliado['afiliado_cidade'];
    $estado = $verAfiliado['afiliado_estado'];
    $cep = $verAfiliado['afiliado_cep'];
    $senhaAfiliado = $verAfiliado['afiliado_senha_id'];
    
    
    $nome_todo = $verAfiliado['afiliado_nome'];
    $nomes = explode(' ', $nome_todo);
    $nomePrimeiro = ucwords($nomes[0]);
    $sobrenome = ucwords($nomes[count($nomes) - 1]);
    
    if($sexoAfiliado == "MASCULINO"){
        $sexo = "Male";
    }elseif($sexoAfiliado == "FEMININO"){
        $sexo = "Female";
    }

function soNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

$telefone = soNumero($verAfiliado['afiliado_celular']);
$cep = soNumero($cep);

$sqlNacao = mysqli_query($conexao1, "SELECT * FROM country WHERE vCountry='$nacao'");
$verNacao = mysqli_fetch_array($sqlNacao);
    $sigla = $verNacao['vCountryCode'];
    $ddi = $verNacao['vPhoneCode'];
    $timeZone = $verNacao['vTimeZone'];


$sqlIdioma = mysqli_query($conexao1, "SELECT * FROM language_master WHERE vTitle_EN='$idioma'");
$verIdioma = mysqli_fetch_array($sqlIdioma);
    $siglaIdioma = $verIdioma['vCode'];
    
$sqlEstado = mysqli_query($conexao1, "SELECT * FROM state WHERE vState='$estado'");
$verEstado = mysqli_fetch_array($sqlEstado);
    $idEstado = $verEstado['iStateId'];

/*** ativar no financeiro **/
$alterar = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_status='Ativo' WHERE afiliado_id='$idAfiliado'");

if($alterar == "1"){
    
    /*** dar ok nas verificações de documento **/
    $alterar2 = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_status='Verificado' WHERE sis_doc_id='$doc'");
    
    
    /*** inserir no passageiro **/
    $inserirPassageiro = mysqli_query($conexao1, "INSERT INTO register_user(iCompanyId, vRefCode, sisCadastro, eRefType, vName, vLastName, vEmail, vCountry, vPhone, eGender, dBirthDate, vImgName, vLang, vPhoneCode, vCurrencyPassenger, vTimeZone, tApiFileName) VALUES ('0', '$idAfiliado', '$idAfiliado', 'Driver', '$nomePrimeiro', '$sobrenome', '$email', '$sigla', '$telefone', '$sexo', '$nascimento', '$foto_perfil', '$siglaIdioma', '$ddi', '$moeda', '$timeZone', 'include_webservice_shark')");
    
    /** buscar o idRiver */
    $sqlNovoRider = mysqli_query($conexao1, "SELECT * FROM register_user ORDER BY iUserId DESC LIMIT 1");
    $verNovoRider = mysqli_fetch_array($sqlNovoRider);
	    $idNovoRider = $verNovoRider['iUserId'];
	
	/*** criar pasta para receber foto perfil **/
	mkdir(dirname(__FILE__).'../../../../../webimages/upload/Passenger/'.$idNovoRider.'/', 0777, true);
	
	
if($tipo_conta_vite7 == "MOTORISTA"){
    
    /*** inserir no MOTORISTA **/
    
    $inserirDriver = mysqli_query($conexao1, "INSERT INTO register_driver(iRefUserId, sisCadastro, vRefCode, eRefType, iCompanyId, vName, vLastName, vEmail, vLoginId, eGender, vCode, vPhone, vLang, vCaddress, vState, vZip, dBirthDate, eStatus, vCountry, vCurrencyDriver, vTimeZone) VALUES ('0', '$idAfiliado', '$idAfiliado', 'Driver', '2', '$nomePrimeiro', '$sobrenome', '$email', '$email', '$sexo', '$ddi', '$telefone', '$siglaIdioma', '$endereco', '$idEstado', '$cep', '$nascimento', 'active', '$sigla', '$moeda', '$timeZone')");
    
    /** buscar o idRiver */
    $sqlNovoDriver = mysqli_query($conexao1, "SELECT * FROM register_driver ORDER BY iDriverId DESC LIMIT 1");
    $verNovoDriver = mysqli_fetch_array($sqlNovoDriver);
	    $idNovoDriver = $verNovoDriver['iDriverId'];
	
	/*** criar pasta para receber foto perfil **/
	mkdir(dirname(__FILE__).'../../../../../webimages/upload/Driver/'.$idNovoDriver.'/', 0777, true);
}


$dest = "no-reply@vite7.com";
$email2 = $email;
$copia = "diretoria@souzasistemas.com.br";

$headers = "MIME-Version: 1.1\n";
$headers .= "From: ".$dest."\r\n". "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\n";
$headers .= "Return-Path: " . $nome . "<" .$email2 . ">\n";
$headers .= "Cco: diretoria@souzasistemas.com.br\n";
$headers .= "Reply-To: ".$dest."\n";
$to = $dest."\n";
$subject  = "Seu Cadastro Vite7 foi Aprovado";

$conteudo = '
<div style="font-family:arial; font-size:18px;">
<img src="https://www.vite7.com/assets/img/menu-logo.png" width="180px" height="55px"><br><br>
Olá, <strong>'.$nome_todo.'</strong>.<br><br>

Seja bem vindo a Vite7.<br>
Seu cadastro foi aprovado com sucesso!<br>
Segue sues dados de acesso:<br><br>

<hr>

<strong>Usuário:</strong> '.$email.' <br>
<strong>Senha:</strong>  '.$senhaAfiliado.'<br>
<strong>Financeiro:</strong> <a href="https://financeiro.vite7.com" target="new">https://financeiro.vite7.com</a><br>
<strong>Link divulgação:</strong> <a href="https://www.vite7.com/cadastro.php?codigoID='.$idAfiliado.'" targt="new">https://www.vite7.com/cadastro.php?codigoID='.$idAfiliado.'</a><br>
<strong>Código ID:</strong> '.$idAfiliado.'<br>

<hr>

Baixe agora em seu Smartphone ou Ios<br><br>

<strong>Passageiro</strong><br><br>

<a href="https://play.google.com/store/apps/details?id=com.vite7.passenger" target="new"><img src="https://www.vite7.com/assets/img/google-play_.png" width="155px" height="48"></a> &nbsp;&nbsp;

<a href="https://apps.apple.com/us/app/vite7-rider/id1490819980" target="new"><img src="https://www.vite7.com/assets/img/ios-store.png" width="155px" height="48"></a><br><br>

    <strong>Motorista</strong><br><br>

<a href="https://play.google.com/store/apps/details?id=com.vite7.passenger" target="new"><img src="https://www.vite7.com/assets/img/google-play_.png" width="155px" height="48"></a> &nbsp;&nbsp;

<a href="https://apps.apple.com/us/app/vite7-rider/id1490819980" target="new"><img src="https://www.vite7.com/assets/img/ios-store.png" width="155px" height="48"></a><br><br>

Atenciosamente <br><br>

Administração VITE7 LIMITED<br><br>
</div>

';

mail($email2, $subject, $conteudo, $headers, "-r". $to);
mail($copia, $subject, $conteudo, $headers, "-r". $to);



?>
<br><br><br>
<div class="w3-container w3-white" style="font-size:20px;text-align:center;">
<div class="w3-quarter">&nbsp;</div>
<div class="w3-half" style="height:500px;">  
        Ativação efetuada com sucesso!<br><br>
        
        <a href="verDocumentos.php?id=<?Php echo $id; ?>"><button type="button" onClick="location.href='veDocumentos.php?id=<?Php echo $id; ?>" class="w3-round w3-button w3-blue w3-text-white w3-padding-16">Nova Verificação</button></a><br>
    
</div>


</div>
<?Php   
}else{
    echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Não foi possível realizar a ativação!');</script>";
}
?>

</body>
</html