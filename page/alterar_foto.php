<?Php

require "../config/config.php";

$id = $_POST['id'];
$empresa = $_POST['empresa'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    unlink("../img/foto/".$ver['afiliado_foto']);

$foto = $_FILES['arquivo']['name'];
	
	$foto = str_replace(" ", "_", $foto);
	$foto = str_replace("á", "a", $foto);
	$foto = str_replace("à", "a", $foto);
	$foto = str_replace("ã", "a", $foto);
	$foto = str_replace("â", "a", $foto);
	$foto = str_replace("é", "e", $foto);
	$foto = str_replace("è", "e", $foto);
	$foto = str_replace("ê", "e", $foto);
	$foto = str_replace("í", "i", $foto);
	$foto = str_replace("ì", "i", $foto);
	$foto = str_replace("î", "i", $foto);
	$foto = str_replace("ó", "o", $foto);
	$foto = str_replace("ò", "o", $foto);
	$foto = str_replace("õ", "o", $foto);
	$foto = str_replace("ô", "o", $foto);
	$foto = str_replace("ú", "u", $foto);
	$foto = str_replace("ù", "u", $foto);
	$foto = str_replace("û", "u", $foto);
	$foto = str_replace("ç", "c", $foto);
	
	$foto = strtolower($foto);
	
	$tipos = array("image/jpeg","image/pjpeg","image/bmp","image/gif","image/png", "image/x-generic");
	$arqType = $_FILES['arquivo']['type'];
	if(array_search($arqType, $tipos) === false){
		echo "<script>alert('Formato Inválido de foto!'); history.back(-1);</script>";
	}else{
	
	if(file_exists("../img/foto/$foto")){
		$a = 1;
		while(file_exists("../img/foto/[$a]$foto")){
			$a++;
		}
		
		$foto = "[".$a."]$foto";				
	}
	
	
	if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], "../img/foto/".$foto)){
		echo "<script>alert('Erro ao enviar a foto!'); history.back(-1);</script>";
	}else{
		chmod ("../img/foto/".$foto, 0777);
	}
	
	
	    $sqlAtualizar = mysqli_query($conexao, "UPDATE sps_afiliados SET afiliado_foto='$foto' WHERE afiliado_id='$id'");
	
	
	echo "<script>alert('Imagem alterada com sucesso!'); location.href='home.php?id=".$id."&&empresa=".$empresa."';</script>";
}
?>