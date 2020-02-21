<?Php require "../../../config/config.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>Administrativo Souza Sistemas</title>
  
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


<div class="w3-container" style="padding:200px 0 0 0; text-align:left;">


<center>
<?Php
$id = $_POST['id'];
$adm = $_POST['adm'];
$consultor = $_POST['patrocinador'];
$consultorLink = $_POST['consultorLink'];
$modo = $_POST['modo'];
$comissao = $_POST['comissao'];
$status = $_POST['status'];

$razao = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['razao']));
$fantasia = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['fantasia']));
$cnpj = $_POST['cnpj'];
$inscricao = $_POST['inscricao'];
$abertura = $_POST['abertura'];

$nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nome']));
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$sexo = $_POST['sexo'];
$nascimento = $_POST['nascimento'];


$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = strtolower($_POST['email']);
$whatsapp = $_POST['whatsapp'];
$skype = strtolower($_POST['skype']);

$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['rua']));
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['bairro']));
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['cidade']));
$estado = strtoupper($_POST['uf']);
$nacao = strtoupper($_POST['nacao']);
$cep = $_POST['cep'];

$banco = $_POST['nome_banco'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$iban = $_POST['iban'];
$swift = $_POST['swift'];


$obs = $_POST['obs'];
$usuarioAcesso = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtolower($_POST['usuarioAcesso']));

$update = mysqli_query($conexao, "
UPDATE sps_afiliados SET 
afiliado_indicador='$consultor', 
afiliado_link='$consultorLink',
afiliado_comissao='$comissao',
afiliado_conta_modo='$modo', 
afiliado_status='$status',
afiliado_usuario='$usuarioAcesso',
afiliado_razao='$razao', 
afiliado_fantasia='$fantasia',
afiliado_cnpj='$cnpj', 
afiliado_insc='$inscricao',
afiliado_data_abertura='$abertura',
afiliado_nome='$nome', 
afiliado_cpf='$cpf', 
afiliado_rg='$rg', 
afiliado_nascimento='$nascimento', 
afiliado_sexo='$sexo',
afiliado_endereco='$endereco', 
afiliado_bairro='$bairro', 
afiliado_cidade='$cidade', 
afiliado_estado='$estado', 
afiliado_cep='$cep',
afiliado_nacao='$nacao',
afiliado_telefone='$telefone', 
afiliado_celular='$celular', 
afiliado_email='$email',
afiliado_obs='$obs' WHERE afiliado_id='$id'");


if($update == "1"){

	echo "<h1 class='h3-xlarge'>Associado editado com sucesso.</h1><br>";
	echo "<a href='verAssociado.php?id=$adm'><button type='button' class='btn btn-info btn-lg'>Pesquisar Associados</button></a>";
	
}else{
    echo "Deu erro!!!"; 
} 
?>

  

 </center> 
 
 
</div>



</body>
</html>