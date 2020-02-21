<?Php
require "../config/config.php";

$id = $_GET['id'];
$razao = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['razao']));
$fantasia = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['fantasia']));
$cnpj = $_POST['cnpj'];
$inscricao = $_POST['inscricao'];
$abertura = $_POST['abertura'];
$nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nome']));
$usuario = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtolower($_POST['login']));
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$senhaNovaCartao = $_POST['senhanova'];
$senhaCartaoCrypt = sha1(md5(sha1(base64_encode(md5($senhaNovaCartao)))));
$endereco = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['rua']));
$bairro = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['bairro']));
$cidade = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['cidade']));
$estado = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['uf']));
$cep = $_POST['cep'];
$pais = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['nacao']));
$descricao = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","A A E E I I O O U U N N"),strtoupper($_POST['obs']));

$alterar = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_usuario='$usuario', afiliado_razao='$razao', afiliado_fantasia='$fantasia', afiliado_cnpj='$cnpj', afiliado_insc='$inscricao', afiliado_data_abertura='$abertura', afiliado_nome='$nome', afiliado_cpf='$cpf', afiliado_rg='$rg', afiliado_nascimento='$nascimento', afiliado_sexo='$sexo', afiliado_telefone='$telefone', afiliado_celular='$celular', afiliado_email='$email', afiliado_pin='$senhaCartaoCrypt', afiliado_endereco='$endereco', afiliado_bairro='$bairro', afiliado_cidade='$cidade', afiliado_estado='$estado', afiliado_cep='$cep', afiliado_nacao='$pais', afiliado_obs='$descricao' WHERE afiliado_id='$id'");
	
	if($alterar == '1'){
		echo "<script>location.href='dados.php?id=".$id."';alert('Dados Empresarias alterado com sucesso!');</script>";
	}else{
		echo "<script>location.href='dados.php?id=".$id."';alert('Solicitação não realizada! Entre em contato com a Administração!');</script>";
	}


?>
