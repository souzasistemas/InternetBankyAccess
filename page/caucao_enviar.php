<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Conta <?Php echo $id." - ".$nome; ?></title>
<link rel="icon" href="../img/favicon.png">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  


<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<body id="principal">
<?Php
require "../config/config.php";

$id                             = $_GET['id'];
$empresa                        = $_GET['empresa'];

$nomeImovel                     = $_GET['nomeImovel'];
$enderecoImovel                 = $_GET['enderecoImovel'];
$valorEntrada                   = $_GET['valorEntrada'];
$valorAluguel                   = $_GET['valorAluguel'];
$valorCondominio                = $_GET['valorCondominio'];
$valorIptu                      = $_GET['valorIptu'];
$descricaoImovel                = $_GET['descricaoImovel'];
$dataInicio                     = $_POST['dataInicio'];
$dataFim                        = $_POST['dataFim'];
$periodo                        = $_POST['periodo'];

$nomeProprietario               = $_GET['nomeProprietario'];
$cpfProprietario                = $_GET['cpfProprietario'];
$rgProprietario                 = $_GET['rgProprietario'];
$profissaoProprietario          = $_GET['profissaoProprietario'];
$estadocivilProprietario        = $_GET['estadocivilProprietario'];
$naturalidadeProprietario       = $_GET['naturalidadeProprietario'];
$nacionalidadeProprietario      = $_GET['nacionalidadeProprietario'];
$telefoneProprietario           = $_GET['telefoneProprietario'];
$celularProprietario            = $_GET['celularProprietario'];
$emailProprietario              = $_GET['emailProprietario'];
$enderecoProprietario           = $_GET['enderecoProprietario'];

$nomeLocatario                  = $_GET['nomeLocatario'];
$cpfLocatario                   = $_GET['cpfLocatario'];
$rgLocatario                    = $_GET['rgLocatario'];
$profissaoLocatario             = $_GET['profissaoLocatario'];
$estadocivilLocatario           = $_GET['estadocivilLocatario'];
$naturalidadeLocatario          = $_GET['naturalidadeLocatario'];
$nacionalidadeLocatario         = $_GET['nacionalidadeLocatario'];
$telefoneLocatario              = $_GET['telefoneLocatario'];
$celularLocatario               = $_GET['celularLocatario'];
$emailLocatario                 = $_GET['emailLocatario'];
$enderecoLocatario              = $_GET['enderecoLocatario'];

$ip = $_SERVER['REMOTE_ADDR'];
$conexao2 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

date_default_timezone_set('Brazil/East');
$horario = date('H:i:s');
$dataCadastro = date('d/m/Y');

$dias_de_prazo_para_pagamento2 = 32;
$dataExpira = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$minuto = date('i');
$segundo = date('s');

function makeRandomCartao1(){
	$salt = "0123456789876543210123456789876543210";
	srand((double)microtime()*1000000);
	$i = 0;
	
	while($i <= 5){
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$funcional = makeRandomCartao1();

$contrato = "$dia$mes$ano2$hora$minuto$segundo$funcional";

$pin = "9bbf0fa04ea5aa0ae5c562145c69dd1c2dc49fcb";

$inserir1 = mysqli_query($conexao, "INSERT INTO sps_caucao(caucao_corretor_afiliado_id, caucao_contrato, caucao_imovel, caucao_endereco, caucao_descricao, caucao_valor_entrada, caucao_valor_aluguel, caucao_valor_condominio, caucao_valor_iptu, caucao_proprietario, caucao_proprietario_cpf, caucao_proprietario_rg, caucao_proprietario_endereco, caucao_proprietario_profissao, caucao_proprietario_estado_civil, caucao_proprietario_natural, caucao_proprietario_nacional, caucao_proprietario_telefone, caucao_proprietario_celular, caucao_proprietario_email, caucao_proprietario_abertura_conta, caucao_locatario, caucao_locatario_cpf, caucao_locatario_rg, caucao_locatario_endereco, caucao_locatario_profissao, caucao_locatario_estado_civil, caucao_locatario_natural, caucao_locatario_nacional, caucao_locatario_telefone, caucao_locatario_celular, caucao_locatario_email, caucao_locatario_abertura_conta, caucao_data_cadastro, caucao_hora_cadastro) VALUES ('$id', '$contrato', '$nomeImovel', '$enderecoImovel', '$descricaoImovel', '$valorEntrada', '$valorAluguel', '$valorCondominio', '$valorIptu', '$nomeProprietario', '$cpfProprietario', '$rgProprietario', '$enderecoProprietario', '$profissaoProprietario', '$estadocivilProprietario', '$naturalidadeProprietario', '$nacionalidadeProprietario', '$telefoneProprietario','$celularProprietario', '$emailProprietario', 'Pendente', '$nomeLocatario', '$cpfLocatario', '$rgLocatario', '$enderecoLocatario', '$profissaoLocatario', '$estadocivilLocatario', '$naturalidadeLocatario', '$nacionalidadeLocatario', '$telefoneLocatario', '$celularLocatario', '$emailLocatario', 'Pendente',  '$dataCadastro', '$horario')");

if($inserir1 == "1"){
    
$sqlCaucao = mysqli_query($conexao, "SELECT * FROM sps_caucao ORDER BY caucao_id DESC LIMIT 1");
$verCaucao  = mysqli_fetch_array($sqlCaucao);
    $idCaucao = $verCaucao['caucao_id'];
    
?>

<h1 class="w3-center w3-xxlarge">Dados preenchidos com sucesso! Aguarde 3 minutos para gerar o contrato completo</h1><br>

<a href="caucao2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button style="width:99%; margin-bottom:5px;" type="button" class="w3-input w3-padding-16 w3-round-large w3-teal w3-text-white">Preencher Novo Formulário</button></a>
<?Php

    
}else{
    echo "<script>location.href='caucao2.php?id=".$id."&&empresa=".$empresa."';alert('Contrato não gerado! Entrar em contato com o suporte!');</script>!";
}
?>

</body>
</html>




<!---
afiliado_id
afiliado_codigo
afiliado_indicador
afiliado_reginal
afiliado_empresa
afiliado_teste
afiliado_cartao
afiliado_token
afiliado_credenciamento
afiliado_sistema
afiliado_bonus
afiliado_modo_loja
afiliado_segmento
afiliado_tipo_negocio
afiliado_site
afiliado_plano
afiliado_link
afiliado_comissao
afiliado_cargo
afiliado_conta_modo
afiliado_status
afiliado_usuario
afiliado_login
afiliado_senha
afiliado_pin
afiliado_foto
afiliado_imagens
afiliado_studio
afiliado_razao
afiliado_fantasia
afiliado_cnpj
afiliado_insc
afiliado_data_abertura
afiliado_nome
afiliado_cpf
afiliado_rg
afiliado_nascimento
afiliado_sexo
afiliado_endereco
afiliado_complemento
afiliado_bairro
afiliado_cidade
afiliado_estado
afiliado_cep
afiliado_nacao
afiliado_telefone
afiliado_celular
afiliado_email
afiliado_neteller_conta
afiliado_neteller_email
afiliado_obs
afiliado_confirma
afiliado_data_cadastro
afiliado_hora_cadastro
afiliado_mensalidade
afiliado_ip
afiliado_computador
afiliado_conexao
afiliado_status_acesso
afiliado_hora_acesso

--->
