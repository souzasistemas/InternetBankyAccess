<?Php 
require "../../../config/config.php";

$id = $_GET['adm'];
$doc = $_GET['doc'];
$tipo = $_GET['tipo'];

if($tipo == "1"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_foto_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "2"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_cpf_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
       
}elseif($tipo == "3"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_rg_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}elseif($tipo == "4"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_criminal_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}elseif($tipo == "5"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_residencia_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}elseif($tipo == "6"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_habilitacao_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
    
    
           
}elseif($tipo == "7"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_veiculo_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}elseif($tipo == "8"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_seguro_carro_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}elseif($tipo == "9"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_selfie_status='Verificado' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo Aprovado com sucesso!');</script>";
    }else{
        echo "<script>history.back(-1);alert('Erro de Sistema!');</script>";
    }
           
}
?>