<?Php 
require "../../../config/config.php";

$id = $_GET['adm'];
$doc = $_GET['doc'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_documentacao WHERE sis_doc_id='$doc'");
$ver = mysqli_fetch_array($sql);
    $idAfiliado = $ver['sis_doc_afiliado_id'];
    
$pasta = "https://www.vite7.com/sisimg/fotos/".$idAfiliado;

$delete = mysqli_query($conexao, "DELETE FROM sps_afiliados WHERE afiliado_id='$idAfiliado'");

if($delete == "1"){
    $delete2 = mysqli_query($conexao, "DELETE FROM sps_documentacao WHERE sis_doc_id='$doc'");

function delTree($dir) { 
      $files = array_diff(scandir($dir), array('.','..')); 
      foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
      } 
      return rmdir($dir); 
    }

    delTree('../../../../sisimg/fotos/'.$idAfiliado.'');
    
    
    
    echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Usuário excluido com sucesso!');</script>";
}else{
    echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Não foi possível excluir!');</script>";
}


?>