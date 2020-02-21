<?Php
session_start();

$id = $_GET['adm'];

require "../../../config/config.php";

$sqlAdmin = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$verAdmin = mysqli_fetch_array($sqlAdmin);
    $permissao = $verAdmin['admin_permissao'];
    $emp = $verAdmin['admin_empresa'];
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
  	

<script src="../../js/mascara.js"></script>

<script type="application/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
</script>
  
 <style type="text/css">

.container {
    padding:10px 0;
}

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


  </style>


<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('id').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('id').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('empresa').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('empresa').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('nome').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('nome').disabled = true;
      }
      
      if(document.getElementById('radio4').checked == true){
        document.getElementById('documento').disabled = false;
      }
      if(document.getElementById('radio4').checked == false){
        document.getElementById('documento').disabled = true;
      }
      
    }
  </script>


<script type="application/javascript">
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")

    }

    return v
}
</script>

</head>
<body id="principal" class="w3-light-grey">

<div class="w3-container-fluid w3-padding">


<?php
$corretor = $_GET['afiliado_id'];
$busca = "SELECT * FROM sps_afiliados WHERE afiliado_indicador='$corretor' AND afiliado_empresa='$emp' ORDER BY afiliado_status DESC"; 

$total_reg = "100";

$pagina = $_GET['pagina'];

if(!$pagina){
    $pc = "1";
}else{
    $pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

$limite = mysqli_query($conexao, "$busca LIMIT $inicio,$total_reg");
$todos = mysqli_query("$busca");

$tr = mysqli_num_rows($todos);
$tp = $tr/$total_reg;

$totalAdm = mysqli_num_rows($limite);

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$corretor'");
$ver = mysqli_fetch_array($sql);

if($ver['afiliado_conta_modo'] == "Fisica"){
    $nome = strtoupper($ver['afiliado_nome']);
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $nome = strtoupper($ver['afiliado_razao']);
}elseif($ver['afiliado_conta_modo'] == ""){
    $nome = $ver['afiliado_razao'];
}
?> 
<h2 class="w3-xlarge">Associados Cadastrados pelo Corretor <?Php echo $corretor; ?>-<?Php echo $ver['afiliado_codigo']; ?> / <?Php echo $nome; ?></h2>
<table class="w3-table" width="100%">
    <tr>
        <td><strong>Total Cadastros: </strong> 
            <div class="w3-tag w3-round w3-green" style="padding:3px">
                <div class="w3-tag w3-round w3-green w3-border w3-border-white"><?Php echo $totalAdm; ?></div>
            </div></td>
    </tr>
</table>


<table class="w3-table-all w3-hoverable" width="100%">
    <thead>
        <tr>
            <th width="80%" style="background-color:#444; color:#fff; text-align:left; vertical-align:middle;">Associado</th>
            <th width="20%" style="background-color:#444; color:#fff; text-align:right;">Opções</th>
        </tr>
    </thead>

<?Php
while ($produto = mysql_fetch_array($limite)) {
?>


<tbody style="font-size:12px; cursor:pointer;">
    <tr>
        <td style="text-align:left; vertical-align: middle;">
            <b>Conta:</b> <?php echo $produto['afiliado_id']; ?>-<?php echo $produto['afiliado_codigo']; ?><br>
            <?Php
                if($produto['afiliado_status'] != "Ativo"){
            ?>
            <span><b>Status: </b><?php echo strtoupper($produto['afiliado_status']); ?><br></span>
            <?Php    
                }else{
            ?>
            <?php
             
                $idAssociado = $produto['afiliado_indicador'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($produto['afiliado_conta_modo'] == "Fisica"){
                    echo "<b>Nome Completo:</b> ".strtoupper($produto['afiliado_nome'])."";
                }elseif($produto['afiliado_conta_modo'] == "Juridica"){
                    echo "<b>Razão Social:</b> ".strtoupper($produto['afiliado_razao'])."";
                }?><br>
                <span id="sumir"><b>Cidade/UF: </b><?php echo strtoupper($produto['afiliado_cidade']); ?>/<?php echo strtoupper($produto['afiliado_estado']); ?><br></span>
                <span><b>Status: </b><?php echo strtoupper($produto['afiliado_status']); ?><br></span>
                <span id="sumir"><b>Cadastrado em: </b><?php echo strtoupper($produto['afiliado_data_cadastro']); ?> às <?php echo strtoupper($produto['afiliado_hora_cadastro']); ?><br></span>
                <span id="sumir"><b>IP: </b><?php echo strtoupper($produto['afiliado_ip']); ?><br></span>
                <span id="sumir"><b>Conexão </b><?php echo strtoupper($produto['afiliado_conexao']); ?><br></span>
                
            <?Php
                }
            ?>
        </td>
        
        <td style="text-align:right; vertical-align: middle;">
            
        <a href="ver_indicados_cliente.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Ver Indicados <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-user" style="font-size:25px;color:blue;"></span></a>
        <a href="visualizar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Visualizar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-eye-open" style="font-size:25px;color:#4B0082;"></span></span></a> 
        <a href="editar_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Editar Afiliado <?php echo $produto['afiliado_id']; ?>"><span class="glyphicon glyphicon-file" style="font-size:25px;color:#FFA500;"></span></a>
        <a href="excluir_afiliado.php?afiliado_id=<?php echo $produto['afiliado_id']; ?>&&adm=<?Php echo $id; ?>" data-toggle="tooltip" title="Remover Afiliado <?php echo $produto['afiliado_id']; ?>" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" style="font-size:25px;color:red;"></span></a>
        
          
        
        
          </td>
    </tr>
</tbody>
  

<?Php
    }
    
$anterior = $pc - 1;
$proximo = $pc + 1;
?>

<tbody class="botao">
    <tr style="background-color:#fff">
        <td style="text-align:left;">
            <ul class="pager" style="text-align:left;">
                <?Php
                    if($pc > 1){
                        echo "<li><a href='?id=".$id."&&pagina=".$anterior."'>Voltar</a></li>";
                    }
                ?>
            </ul>
        </td>
        <td style="text-align:right;">
            <ul class="pager" style="text-align:right;">
                <?Php
                    if($pc < $tp){
                        echo "<li><a href='?id=".$id."&&pagina=".$proximo."'>Avançar</a></li>";
                    }
                ?>
            </ul>
        </td>
    </tr>
</tbody>
</table> 
<br><br>
   
</div>
</body>
</html>
