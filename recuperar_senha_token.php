<?Php 
$idSolicitado = $_GET['empresa'];
if($idSolicitado == ""){
	$empresa = "1";
}else{
	$empresa = $idSolicitado;
}
require "config/config.php";
require "config/topo.php";?>







<!---- conteudo da pagina  ---->

<?Php
error_reporting(0);

/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

$usuario = $_POST['usuario'];
$conta = $_POST['conta'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_usuario='$usuario' AND afiliado_id='$conta' AND afiliado_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);
    $id = $ver['afiliado_id'];
    $nomeAfiliado = strtoupper($ver['afiliado_nome']);
    $email = $ver['afiliado_email'];
	
	if($nomeAfiliado == ""){
		$nome = $usuario;
	}else{
		$nome = $nomeAfiliado;
	}

$sqlMensagem = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verMensagem = mysqli_fetch_array($sqlMensagem);
    $emailsender = $verMensagem['logo_emailsender'];    

function makeRandomCartao3(){
	$salt = "aBcDeFgHiJkLmNoPqRsTuVwXyZ0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	
	while($i <= 9){
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$cartao3 = makeRandomCartao3();


if($id == ""){
    echo "<script>history.back(-1); alert('Usuário não localizado!');</script>";
}else{
    $inserir = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_token='$cartao3' WHERE afiliado_id='$id'");

if($inserir == "1"){

$assunto = "Token Recuperação";


$emaildestinatario = trim(strtolower($email));
$emailremetente = $emailsender;
$resposta = $emailsender;


$mensagemHTML = '

<div style="font-family:arial; font-size:18px;">

Olá, <strong>Sr(a) '.$nome.'</strong>.<br><br>
<b>Login de Acesso:</b> '.strtolower($ver['afiliado_usuario']).'<br>
<b>Token de Recuperação de Senha:</b> 
<strong style="color:red">'.$cartao3.'</strong><br><br>

Atenciosamente,<br><br>

Administração
</div>

';



/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$resposta.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
$headers .= "Reply-To: ".$resposta.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);

?>
    
    	<div class="w3-container w3-padding" style="text-align:center">
        	<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
            <img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
            <h1 class="w3-large w3-text-gray">Recuperar Senha de Acesso</h1>
            <p>Olá Sr(a) <b><?Php echo $nome; ?></b><br>
            <b>2º Passo:</b> Preencha abaixo o Token que foi enviado para seu email <b><?Php echo $email; ?></b> para cadastrar uma nova senha</p>
            <form action="recuperar_senha_token_validar.php?empresa=<?Php echo $empresa; ?>" method="post">
                <input name="id" type="hidden" value="<?Php echo $id; ?>">
                <input type="text" class="form-control form-control-lg" name="token" placeholder="Digita aqui o Token" style="margin-bottom:10px; text-align:center;" required>
                <button type="submit" name="Submit" class="form-control form-control-lg w3-teal">AVANÇAR</button>
                <button style="margin-top:3px;" type="button" onClick="location.href='index.php?empresa=<?Php echo $empresa; ?>'" class="form-control form-control-lg w3-red ">VOLTAR</button>
                
            </form>
<?Php

}else{
    echo "<script>location.href='recuperar.php?empresa=".$empresa."'; alert('Não foi possível enviar o Token de atualização de Senha!');</script>";
    
}
}
?>            
            </div>
        </div>

<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>