<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

  <style media="print">
.botao {
display: none;
}
</style>

</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<div class="col-sm-12">
<h2 class="w3-jumbo">Efetuar Baixa Pagamento de Contas</h2>  

<?php 
require '../../../../../config/config.php';

$codigo = $_GET['codigo'];

$sql = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_id='$codigo'");
$row_pagamento = mysqli_fetch_assoc($sql);
?>
<br>
<form name="form" action="baixa_pagamento_efetuar.php" method="post">

<input type="hidden" name="codigo" value="<?Php echo $codigo; ?>" />
 <table width="100%" border="0" cellspacing="5" cellpadding="2" class="table table-striped">
  <tr>
    <td width="20%" style="vertical-align: middle;"><strong>Solicitante</strong></td>
    <td width="80%" style="vertical-align: middle;">
        <?php 
        $idAfiliado123 = $row_pagamento['pag_afiliado_id'];
        
        $sqlAfiliado123 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAfiliado123'");
        $verAfiliado123 = mysqli_fetch_array($sqlAfiliado123);
        
        echo $idAfiliado123 ." - ".strtoupper($verAfiliado123['afiliado_nome']); ?></td>
  </tr>
  <tr>
    <td width="20%" style="vertical-align: middle;"><strong>Código de Barras</strong></td>
    <td width="80%" style="vertical-align: middle;"><?php echo $row_pagamento['pag_codigo']; ?></td>
  </tr>
  <tr>
    <td style="vertical-align: middle;"><strong>Tipo</strong></td>
    <td style="vertical-align: middle;"><?php echo $row_pagamento['pag_tipo']; ?></td>
  </tr>
  <tr>
    <td style="vertical-align: middle;"><strong>Vencimento</strong></td>
    <td style="vertical-align: middle;"><?php echo $row_pagamento['pag_vencimento']; ?></td>
  </tr>
  <tr>
    <td style="vertical-align: middle;"><strong>Valor à pagar</strong></td>
    <td style="vertical-align: middle;"><?Php echo number_format($row_pagamento['pag_valor'],2,",","."); ?></td>
  </tr>
  <tr>
    <td style="vertical-align: middle;"><strong>Descrição</strong></td>
    <td style="vertical-align: middle;"><?php echo $row_pagamento['pag_descricao']; ?></td>
  </tr>
  <tr>
    <td style="vertical-align: middle;"><strong>Autoriza&ccedil;&atilde;o</strong></td>
    <td style="vertical-align: middle;"><input  type="text" class="w3-input w3-white w3-border w3-round" name="autoriza" required="required" /> </td>
  </tr>
  <tr>
    <td colspan="2"><br />
    <button name="inserir" class="btn btn-success btn-lg" type="submit">Dar Baixa no Pagamento</button> | 
    <a href="javascript:location.href='boletos.php';"><button name="limpar" class="btn btn-danger btn-lg" type="button">Cancelar</button></a></td>
  </tr>
</table>
 </form>



</div>
</body>
</html>
