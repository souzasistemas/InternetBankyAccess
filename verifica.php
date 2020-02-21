<?Php 
$empresa = $_GET['empresa'];
require "config/config.php";
require "config/topo.php";?>







<!---- conteudo da pagina  ---->

<?Php
$senha1 = $_GET['secreto'];
$login1 = strtolower($_GET['login']);
$senha2 = $_POST['secreto'];
$login2 = strtolower($_POST['login']);

if($login1 == ""){
	$login = $login2;
}else{
	$login = $login1;
}

if($senha1 == ""){
	$senha = $senha2;
}else{
	$senha = $senha1;
}

$senhaCrypt = sha1(md5(sha1(base64_encode(md5($senha)))));
$loginCrypt = sha1(md5(sha1(base64_encode(md5($login)))));

$sqlTeste = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_login='$login' AND afiliado_empresa='$empresa'");
$verTeste = mysqli_fetch_array($sqlTeste);
    $idTeste = $verTeste['afiliado_teste'];
		
if($idTeste == "Sim"){
	
//*** conta teste */
$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idTeste'");
$ver = mysqli_fetch_array($sql);
    $id = $ver['afiliado_id'];   
    $senhaAfiliado = $ver['afiliado_senha'];
    $nome = strtoupper($ver['afiliado_nome']);
    


if($id == ""){
?>

<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert-danger w3-padding w3-round">Usuário não localizado</div>
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>

<?Php
if($empresa == "1001"){
}else{
?>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>
</div>
</div>

<?Php			
}elseif($senhaCrypt != $senhaAfiliado){
?>

<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert-danger w3-padding w3-round">Senha Incorreta</div>
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>


<?Php
if($empresa == "1001"){
}else{
?>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>

</div>
</div>



<?Php
}else{
?>

?>
<br><br>

<meta http-equiv="refresh" content="5; url=page/home.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

<?Php
}
//*** fim da conta teste */
}else{
    
/*** conta afiliado geral */
$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_usuario='$login' AND afiliado_empresa='$empresa'");
$ver = mysqli_fetch_array($sql);
    $id = $ver['afiliado_id'];   
    $senhaAfiliado = $ver['afiliado_senha'];
    



if($id == ""){
?>
<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">

<div class="alert-danger w3-padding w3-round">Usuário não localizado!</div>
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>


<?Php
if($empresa == "1001"){
}else{
?>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>

</div>
</div>
<?Php

}elseif($senhaCrypt != $senhaAfiliado){
?>
<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert-danger w3-padding w3-round">Senha Incorreta</div>
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>

<?Php
if($empresa == "1001"){
}else{
?>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>
</div>
</div>
<?Php
}else{
    
    $ip = $_SERVER['REMOTE_ADDR'];
    $conexao2 = gethostbyaddr($_SERVER['REMOTE_ADDR']);

    date_default_timezone_set('Brazil/East');
    $horario = date('H:i:s');
    $dataCadastro = date('d/m/Y');
    
    $horaNova = strtotime("$horario + 1000 minutes");

    $horaNovaFormatada = date("H:i",$horaNova);
    
    $update = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_status_acesso='Sim', afiliado_hora_acesso='$horaNovaFormatada' WHERE afiliado_id='$id'");
    
    if($update == "1"){
        $inserir = mysqli_query($conexao, "INSERT INTO sps_afiliado_logs(
        acesso_admin_hora, 
        acesso_admin_data, 
        acesso_admin_login,
        acesso_admin_empresa,
        acesso_admin_ip, 
        acesso_admin_conexao, 
        acesso_admin_mensagem) VALUES (
        '$horario',
        '$dataCadastro',
        '$id - $login',
        '$empresa',
        '$ip',
        '$conexao2',
        'Cliente acessou sua conta')");

?>
<br><br>

<meta http-equiv="refresh" content="5; url=page/home.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>">

<div class="spinner-border text-success" style="display:block; font-size:40px; padding:100px; margin:auto"></div>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

<?Php
}else{
?>

<div class="w3-container w3-padding" style="text-align:center">
<div class="w3-padding-32 w3-round w3-animate-bottom" style="width:320px; margin:auto;">
<img style="margin-bottom:10px; padding:10px;" src="img/logo/<?Php echo $logotipo; ?>" width="100%">
<div class="alert-danger w3-padding w3-round">Não foi possível acessar! Entre em contato com a administração</div>
<h1 class="w3-large w3-text-gray">Login de Acesso</h1>
<form action="verifica.php?empresa=<?Php echo $empresa; ?>" method="post" name="form">
<input type="text" id="login_fake" style="border:none; height:65px; display: none;" class="hidden" autocomplete="off" name="login">
<input type="text" class="form-control form-control-lg" placeholder="Usuário" name="login" style="margin-bottom:10px; text-align:center;">
<input type="password" id="secreto_fake" style="border:none; display: none; height:65px" class="hidden" autocomplete="off" name="secreto">
<input type="password" class="form-control form-control-lg" placeholder="Senha" name="secreto" style="margin-bottom:10px; text-align:center;">
<button type="submit" class="form-control form-control-lg w3-teal"> Entrar</button>
</form>
<h1 class="w3-medium"><a href="recuperar.php?empresa=<?Php echo $empresa; ?>">Esqueci a senha</a></h1>


<?Php
if($empresa == "1001"){
}else{
?>
<a href="<?Php echo $verEmpresa['logo_site']; ?>" target="new"><button style="margin-top:3px;" type="button" class="form-control form-control-lg w3-blue"> ACESSAR SITE</button></a>

<?Php    
}
?>

</div>
</div>
<?Php        
}
}
}
?>
<!--- fim conteudo da pagina  ---->












<?Php require "config/rodape.php";?>