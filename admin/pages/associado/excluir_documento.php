<?Php 
require "../../../config/config.php";

$id = $_GET['adm'];
$doc = $_GET['doc'];
$tipo = $_GET['tipo'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_documentacao WHERE sis_doc_id='$doc'");
$ver = mysqli_fetch_array($sql);
    $idAfiliado = $ver['sis_doc_afiliado_id'];

if($tipo == "1"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_foto_status='Pendente', sis_doc_foto='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_foto'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "2"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_cpf_status='Pendente', sis_doc_cpf='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_cpf'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "3"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_rg_status='Pendente', sis_doc_rg='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_rg'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "4"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_criminal_status='Pendente', sis_doc_criminal='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_criminal'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "5"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_residencia_status='Pendente', sis_doc_residencia='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_residencia'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "6"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_habilitacao_status='Pendente', sis_doc_habilitacao='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_habilitacao'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "7"){
    
     $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_veiculo_status='Pendente', sis_doc_veiculo='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_veiculo'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "8"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_seguro_carro_status='Pendente', sis_doc_seguro_carro='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_seguro_carro'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}elseif($tipo == "9"){
    
    $update = mysqli_query($conexao, "UPDATE sps_documentacao SET sis_doc_selfie_status='Pendente', sis_doc_selfie='' WHERE sis_doc_id='$doc'");
    
    if($update == "1"){
        
        unlink('../../../../sisimg/fotos/'.$idAfiliado.'/'.$ver['sis_doc_selfie'].''); 
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Arquivo deletado com sucesso!');</script>";
    }else{
        echo "<script>location.href='verDocumentos.php?id=".$id."';alert('Erro de Sistema!');</script>";
    }
    
}
?>