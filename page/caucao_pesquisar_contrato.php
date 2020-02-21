<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

?>

<!DOCTYPE html>
<html lang="pt">
<head>
<title><?Php echo $nomeEmpresa; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
<link rel="icon" href="../img/<?Php echo $icone; ?>">
<link rel="shortcut icon" href="../img/<?Php echo $icone; ?>">
        
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>




<style type="text/css">
html, body, div{
	font-family: "Ubuntu", sans-serif;
	font-size:14px;
    background-repeat:no-repeat;
}
html, body{
    height:100%;
}
iframe#iframe{
    height:88%;
}

#principal::-webkit-scrollbar-track {
    background-color: #222;
}
#principal::-webkit-scrollbar {
    width: 6px;
    background: #222;
}
#principal::-webkit-scrollbar-thumb {
    background: #555;
}


</style>

<script language="javascript">
    function habilitacao(){
      if(document.getElementById('radio1').checked == true){
        document.getElementById('contrato').disabled = false;
      }
      if(document.getElementById('radio1').checked == false){
        document.getElementById('contrato').disabled = true;
      }
      
      if(document.getElementById('radio2').checked == true){
        document.getElementById('proprietario').disabled = false;
      }
      if(document.getElementById('radio2').checked == false){
        document.getElementById('proprietario').disabled = true;
      }
      
      if(document.getElementById('radio3').checked == true){
        document.getElementById('locatario').disabled = false;
      }
      if(document.getElementById('radio3').checked == false){
        document.getElementById('locatario').disabled = true;
      }
      
      if(document.getElementById('radio4').checked == true){
        document.getElementById('cpf').disabled = false;
      }
      if(document.getElementById('radio4').checked == false){
        document.getElementById('cpf').disabled = true;
      }
      
      if(document.getElementById('radio5').checked == true){
        document.getElementById('todosContrato').disabled = false;
      }
      if(document.getElementById('radio5').checked == false){
        document.getElementById('todosContrato').disabled = true;
      }
      
    }
  </script>
  
</head>

<body>

<div class="w3-container">

<h2 class="w3-large"><b>Modo de Consulta</b></h2>

<form style="padding:0;" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>" method="post" name="form">
    <input name="busca" type="hidden" value="busca">
    
    <div class="w3-third">
        <table class="w3-table">
         <td style="width:10%;"><input type="radio" id="radio1" class='w3-radio' name="tipo" value="1" onClick="habilitacao()"></td>
         <td><input type="text" class="w3-right w3-border w3-round w3-input" name="contrato" id="contrato" placeholder="Por Contrato" disabled></td>
        </table>
    </div>
    <div class="w3-third">
        <table class="w3-table">
         <td style="width:10%;"><input type="radio" id="radio2" class='w3-radio' name="tipo" value="2" onClick="habilitacao()"></td>
         <td><input type="text" class="w3-right w3-border w3-round w3-input" name="nomeProprietario" id="proprietario" placeholder="Por Nome do Proprietário" disabled></td>
        </table>
    </div>
    <div class="w3-third">
        <table class="w3-table">
         <td style="width:10%;"><input type="radio" id="radio3" class='w3-radio' name="tipo" value="3" onClick="habilitacao()"></td>
         <td><input type="text" class="w3-right w3-border w3-round w3-input" name="nomeLocatario" id="locatario" placeholder="Por Nome do Locatario" disabled></td>
        </table>
    </div>
    <div class="w3-half">
        <table class="w3-table">
         <td style="width:10%;"><input type="radio" id="radio4" class='w3-radio' name="tipo" value="4" onClick="habilitacao()"></td>
         <td><input type="text" class="w3-right w3-border w3-round w3-input" name="cpf" id="cpf" placeholder="Por CPF" disabled></td>
        </table>
    </div>
    <div class="w3-half">
        <table class="w3-table">
         <td style="width:10%;"><input type="radio" id="radio5" class='w3-radio' name="tipo" value="5" onClick="habilitacao()"></td>
         <td><input style="background:none; border:none;" type="text" class="w3-right w3-round w3-input" value="Todos os Contratos" name="todosContrato" id="todosContrato" disabled readonly></td>
        </table>
    </div>
    
    <table class='w3-table'>
        <tr>
            <td><button class="w3-green w3-input input-lg"><i class="fa fa-search"></i> Buscar</button></td>
        </tr>
    </table>

</form>

<?Php
if(isset($_POST['busca'])){
    $tipo = $_POST['tipo'];
    
if($tipo == "1"){
}elseif($tipo == "2"){
}elseif($tipo == "3"){
}elseif($tipo == "4"){
}elseif($tipo == "5"){
?>
<hr>
<table class="w3-table w3-striped w3-bordered w3-hoverable" style="width:100%;">
    <thead class="w3-black">
        <tr>
            <th width="10%" style="text-align:center; vertical-align: middle;">Contrato</th>
            <th width="10%" style="text-align:center; vertical-align: middle;">Imóvel</th>
            <th width="35%" style="text-align:center; vertical-align: middle;">Proprietário</th>
            <th width="35%" style="text-align:center; vertical-align: middle;">Locatário</th>
            <th width="10%" style="text-align:center; vertical-align: middle;">&nbsp;</th>
        </tr>
    </thead>

<?Php
$sqlContratos = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_corretor_afiliado_id='$id' AND caucao_proprietario_afiliado_id!='' AND caucao_locatario_afiliado_id!=''");
while($verContratos = mysqli_fetch_array($sqlContratos)){
?>
    <tbody style="font-size:12px; cursor:pointer; color:#000;">
        <tr>
            <td style="text-align:center; vertical-align: middle;"><?php echo "<b>".$verContratos['caucao_contrato']."</b>";?></td>
            <td style="text-align:center; vertical-align: middle;"><?php echo $verContratos['caucao_imovel']; ?></td>
            <td style="text-align:center; vertical-align: middle;">
                <?php 
                    echo $verContratos['caucao_proprietario_afiliado_id']." - ";
                    echo $verContratos['caucao_proprietario'];
                    echo "<br>";
                    echo "<b>CPF: </b>".$verContratos['caucao_proprietario_cpf'];
                ?> 
            </td>
            <td style="text-align:center; vertical-align: middle;">
                <?php 
                    echo $verContratos['caucao_locatario_afiliado_id']." - ";
                    echo $verContratos['caucao_locatario'];
                    echo "<br>";
                    echo "<b>CPF: </b>".$verContratos['caucao_locatario_cpf'];
                ?> 
            </td>
            <td style="text-align:center; vertical-align: middle;"><a href="caucao_contrato.php?id=<?php echo $id; ?>&&empresa=<?Php echo $empresa; ?>&&contrato=<?Php echo $verContratos['caucao_contrato']; ?>" target="new" title="Imprimir Contrato"><img src="../img/icon_relatorio.png" width="20px" /></a> 
            </td>
        </tr>
    </tbody>
<?Php
}
?>
</table>

<?Php    
}    
}
?>
</div>

</body>
</html>

<?Php
}
?>