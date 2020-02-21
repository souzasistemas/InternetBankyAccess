<?Php
session_start();

$idadm = $_GET['id'];

require "../../../config/config.php";

$sqlAdmin = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$idadm'");
$verAdmin = mysqli_fetch_array($sqlAdmin);
    $permissao = $verAdmin['admin_permissao'];
    $emp = $verAdmin['admin_empresa'];
    
    
$dias_de_prazo_para_pagamento2 = 32;
$data_dia = date("d", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_mes = date("m", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$data_ano = date("Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
$dataExpira = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento2 * 86400));
?>
<html lang="pt">
<head>
  <title>Administrativo</title>
  <meta charset="utf-8">
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
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  	


<script src="../../js/mascara.js"></script>


  
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

@media only screen and (max-width: 687px) {
    #sumir {
        display:none;
    }
    
    
}

input, select{
    margin-bottom:2px;
}
  </style>

<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('empresa').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('empresa').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('id').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('id').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('nome').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('nome').disabled = true;
      }
    }
  </script>

</head>
<body id="principal">

<div class="w3-container-fluid w3-padding">
    
<div class="w3-border w3-padding w3-round w3-black w3-margin-bottom"><h2 class="w3-large"><i class="fas fa-address-card"></i> Documentação para Avaliação</h2></div>  

<h2>Detalhes das Imagens</h2>

<table class="w3-table">
    <tr class="w3-black">
        <td style="vertical-align:middle; text-align:left;">Dados da Conta</td>
        <td style="vertical-align:middle; text-align:center;">Perfil</td>
        <td style="vertical-align:middle; text-align:center;">Documento</td>
        <td style="vertical-align:middle; text-align:center;">RG</td>
        <td style="vertical-align:middle; text-align:center;">Criminal</td>
        <td style="vertical-align:middle; text-align:center;">Residência</td>
        <td style="vertical-align:middle; text-align:center;">Habilitação</td>
        <td style="vertical-align:middle; text-align:center;">Veículo</td>
        <td style="vertical-align:middle; text-align:center;">Seguro</td>
        <td style="vertical-align:middle; text-align:center;">Selfie</td>
        <td>&nbsp;</td>
    </tr>


<?Php
$result_docs = mysqli_query($conexao, "SELECT * FROM sps_documentacao WHERE sis_doc_status='Pendente'");
while($row_docs = mysqli_fetch_assoc($result_docs)){
    $id = $row_docs['sis_doc_afiliado_id'];
    $foto1 = $row_docs['sis_doc_foto'];
    $ext1 = end(explode(".", $foto1));
    $foto2 = $row_docs['sis_doc_cpf'];
    $ext2 = end(explode(".", $foto2));
    $foto3 = $row_docs['sis_doc_rg'];
    $ext3 = end(explode(".", $foto3));
    $foto4 = $row_docs['sis_doc_criminal'];
    $ext4 = end(explode(".", $foto4));
    $foto5 = $row_docs['sis_doc_residencia'];
    $ext5 = end(explode(".", $foto5));
    $foto6 = $row_docs['sis_doc_habilitacao'];
    $ext6 = end(explode(".", $foto6));
    $foto7 = $row_docs['sis_doc_veiculo'];
    $ext7 = end(explode(".", $foto7));
    $foto8 = $row_docs['sis_doc_seguro_carro'];
    $ext8 = end(explode(".", $foto8));
    $foto9 = $row_docs['sis_doc_selfie'];
    $ext9 = end(explode(".", $foto9));
    
    $sql_nome = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
    $ver_nome = mysqli_fetch_array($sql_nome);
        $nome = $ver_nome['afiliado_nome'];
        
    $partes = explode(' ', $nome);
    $primeiroNome = array_shift($partes);
    $ultimoNome = array_pop($partes);
    
    
   
?>



<tbody style="font-size:12px;">
   
   
    <td>
        <b>Conta: </b> <?Php echo $id."-".$ver_nome['afiliado_codigo'];?><br>
        <b>Código ID: </b> <?Php echo $ver_nome['afiliado_codigo_vite7']; ?><br>
        <b>Nome: </b> <?Php echo $primeiroNome."&nbsp".$ultimoNome; ?> <br>
        <b>E-mail: </b> <?Php echo $ver_nome['afiliado_email']; ?> <br>
        <b>Senha: </b> <?Php echo $ver_nome['afiliado_senha_id']; ?> <br>
        <b>Sexo: </b> <?Php echo $ver_nome['afiliado_sexo']; ?> <br>
        <b>País: </b> <?Php echo $ver_nome['afiliado_nacao']; ?> <br>
        <b>Estado: </b> <?Php echo $ver_nome['afiliado_estado']; ?> <br>
        <b>Endereço: </b> <?Php echo $ver_nome['afiliado_endereco']; ?> <br>
        <b>CEP/ZIPCODE: </b> <?Php echo $ver_nome['afiliado_cep']; ?> <br>
        <b>Celular: </b> +<?Php echo $ver_nome['afiliado_ddi']; ?>&nbsp;<?Php echo $ver_nome['afiliado_celular']; ?> <br>
        <b>Idioma: </b> <?Php echo $ver_nome['afiliado_idioma']; ?> <br>
        <b>Moeda: </b> <?Php echo $ver_nome['afiliado_moeda']; ?> <br>
    </td>
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto1 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext1 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto1; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto1; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto1; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
    
        <?Php 
        if($row_docs['sis_doc_foto_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_foto_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=1"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=1"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_foto_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
        
    </td>
    
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto2 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext2 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto2; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto2; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto2; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
    
        <?Php 
        if($row_docs['sis_doc_cpf_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_cpf_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=2"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=2"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_cpf_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
    </td>
    
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto3 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext3 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto3; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto3; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto3; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
    
        <?Php 
        if($row_docs['sis_doc_rg_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_rg_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=3"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=3"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_rg_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
    </td>
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto4 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext4 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto4; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto4; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto4; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
        
        <?Php 
        if($row_docs['sis_doc_criminal_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_criminal_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=4"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=4"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_criminal_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
        
    </td>
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto5 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext5 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto5; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto5; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto5; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?>
        <br>
        
        <?Php 
        if($row_docs['sis_doc_residencia_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_residencia_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=5"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=5"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_residencia_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
    </td>
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto6 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext6 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto6; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto6; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto6; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
        
         <?Php 
        if($row_docs['sis_doc_habilitacao_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_habilitacao_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=6"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=6"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_habilitacao_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
        
        
        
    </td>
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto7 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext7 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto7; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto7; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto7; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?>
        <br>
        
        <?Php 
        if($row_docs['sis_doc_veiculo_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_veiculo_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=7"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=7"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_veiculo_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
        
    </td>
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto8 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext8 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto8; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto8; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto8; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
        
        <?Php 
        if($row_docs['sis_doc_seguro_carro_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_seguro_carro_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=8"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=8"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_seguro_carro_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
       
    </td>
    
    
    
    
    
    <td style="vertical-align:middle; text-align:center;">
        <?Php
            if($foto9 == ""){
            ?>
            
            <img class="w3-opacity w3-border" style="padding:2px;" src="https://www.w3schools.com/w3css/img_avatar2.png" width="70px" height="80px">
            
            <?Php
            }elseif($ext9 == "pdf"){
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto9; ?>" target="new"><center><i class="far fa-file-pdf w3-xxxlarge"></i></center></a><br>
        <?Php
            }else{
        ?>
            <a href="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto9; ?>" target="new"><img class="w3-opacity w3-hover-opacity-off w3-border" style="padding:2px;" src="<?Php echo $site; ?>/sisimg/fotos/<?Php echo $id; ?>/<?Php echo $foto9; ?>" width="70px" height="80px"></a>
        <?Php
            }
        ?><br>
        
        <?Php 
        if($row_docs['sis_doc_selfie_status'] == "Pendente"){
        ?>
        <?Php
        }elseif($row_docs['sis_doc_selfie_status'] == "Analise"){
        ?>
        <br>
        
        <center><a href="editar_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=9"><button class="w3-green w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-check"></i></button></a>
        <a href="excluir_documento.php?id=<?Php echo $idadm; ?>&&doc=<?Php echo $row_docs['sis_doc_id']; ?>&&tipo=9"><button class="w3-red w3-padding w3-button w3-round w3-input" style="margin-bottom:1px; width:50px;"><i class="fas fa-times"></i></button></a></center>
        
        <?Php
        }elseif($row_docs['sis_doc_selfie_status'] == "Verificado"){
        ?>
        <i class="fas fa-check w3-text-teal" style="font-size:24px; padding:10px;"></i>
        <?Php
        }
        ?>
        
    </td>
    
    
    <td style="vertical-align:middle; text-align:center;">
        
    <?Php
    if($ver_nome['afiliado_nacao'] == "BRAZIL"){
        if($ver_nome['afiliado_conta_vite7'] == "PASSAGEIRO"){
            if($row_docs['sis_doc_foto_status'] == "Verificado" && $row_docs['sis_doc_cpf_status'] == "Verificado" && $row_docs['sis_doc_rg_status'] == "Verificado" && $row_docs['sis_doc_criminal_status'] == "Verificado" && $row_docs['sis_doc_residencia_status'] == "Verificado" && $row_docs['sis_doc_selfie_status'] == "Verificado"){
            ?>
            <a href="associado_ativar.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-teal w3-padding-32" style="margin-bottom:3px; width:100px;">Liberar</button></a><br>
            <a href="associado_excluir.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-red" style="margin-bottom:3px; width:100px;">Cancelar</button></a>
            <?Php
            }else{
            ?>
            <button class="w3-button w3-round w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Liberar</button> <br>
            <button class="w3-button w3-round w3-red w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Cancelar</button>
            <?Php
            }
        }elseif($ver_nome['afiliado_conta_vite7'] == "MOTORISTA"){
            if($row_docs['sis_doc_foto_status'] == "Verificado" && $row_docs['sis_doc_cpf_status'] == "Verificado" && $row_docs['sis_doc_rg_status'] == "Verificado" && $row_docs['sis_doc_criminal_status'] == "Verificado" && $row_docs['sis_doc_residencia_status'] == "Verificado" && $row_docs['sis_doc_veiculo_status'] == "Verificado" && $row_docs['sis_doc_seguro_carro_status'] == "Verificado" && $row_docs['sis_doc_habilitacao_status'] == "Verificado" && $row_docs['sis_doc_selfie_status'] == "Verificado"){
            ?>
            <a href="associado_ativar.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-teal w3-padding-32" style="margin-bottom:3px; width:100px;">Liberar</button></a><br>
            <a href="associado_excluir.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-red" style="margin-bottom:3px; width:100px;">Cancelar</button></a>
            <?Php
            }else{
            ?>
            <button class="w3-button w3-round w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Liberar</button> <br>
            <button class="w3-button w3-round w3-red w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Cancelar</button>
            <?Php
            }
        } 
        
        
        
        
        
        
    }elseif($ver_nome['afiliado_nacao'] != "BRAZIL"){
        if($ver_nome['afiliado_conta_vite7'] == "PASSAGEIRO"){
            if($row_docs['sis_doc_foto_status'] == "Verificado" && $row_docs['sis_doc_cpf_status'] == "Verificado" && $row_docs['sis_doc_criminal_status'] == "Verificado" && $row_docs['sis_doc_residencia_status'] == "Verificado" &&  $row_docs['sis_doc_selfie_status'] == "Verificado"){
            ?>
            <a href="associado_ativar.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-teal w3-padding-32" style="margin-bottom:3px; width:100px;">Liberar</button></a><br>
            <a href="associado_excluir.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-red" style="margin-bottom:3px; width:100px;">Cancelar</button></a>
            <?Php
            }else{
            ?>
            <button class="w3-button w3-round w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Liberar</button> <br>
            <button class="w3-button w3-round w3-red w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Cancelar</button>
            <?Php
            }
            
        }elseif($ver_nome['afiliado_conta_vite7'] == "MOTORISTA"){
           if($row_docs['sis_doc_foto_status'] == "Verificado" && $row_docs['sis_doc_cpf_status'] == "Verificado" && $row_docs['sis_doc_criminal_status'] == "Verificado" && $row_docs['sis_doc_residencia_status'] == "Verificado" && $row_docs['sis_doc_veiculo_status'] == "Verificado" && $row_docs['sis_doc_seguro_carro_status'] == "Verificado" && $row_docs['sis_doc_habilitacao_status'] == "Verificado" && $row_docs['sis_doc_selfie_status'] == "Verificado"){
            ?>
            <a href="associado_ativar.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-teal w3-padding-32" style="margin-bottom:3px; width:100px;">Liberar</button></a><br>
            <a href="associado_excluir.php?doc=<?Php echo $row_docs['sis_doc_id']; ?>&&adm=<?Php echo $idadm; ?>"><button class="w3-button w3-round w3-red" style="margin-bottom:3px; width:100px;">Cancelar</button></a>
            <?Php
            }else{
            ?>
            <button class="w3-button w3-round w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Liberar</button> <br>
            <button class="w3-button w3-round w3-red w3-light-gray w3-hover-light-gray" style="margin-bottom:3px; width:100px;">Cancelar</button>
            <?Php
            } 
        }  
    }
    ?>
        
        
        
    </td>
</tbody>

<?Php
}
?>
</table>


</div>  <br><br><br>  
</body>
</html>
