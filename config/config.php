<?php

$host = "localhost";
$user = "pws7shop_bd";
$pass = "bd2020#@!";
$bd = "pws7shop_bd";

$conexao = mysqli_connect($host,$user,$pass, $bd);
$banco = mysqli_select_db($conexao,$bd);
mysqli_set_charset($conexao,'utf8');

if($conexao->connect_error){
    die("Connection failed: ".$conexao->connect_error);
}

$idReservaCelular = "2"; /** não alterar **/
$idReservaBoletos = "3"; /** não alterar **/
$idReservaImposto = "4"; /** não alterar **/
$idReservaEmprestimo = "5"; /** não alterar **/
$idReservaEmpresa = "6"; /** não alterar **/
$idAdm = "1"; /** não alterar **/

$tarifaSaque = "5";


$sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_logotipos WHERE logo_afiliado_id='$empresa'");
$verEmpresa = mysqli_fetch_array($sqlEmpresa);
	$favicon = $verEmpresa['logo_favicon'];
	$nomeEmpresa = strtoupper($verEmpresa['logo_fantasia']);
	$logotipo = $verEmpresa['logo_imagem'];

?>