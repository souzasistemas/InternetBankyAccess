<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    
<?Php
require "../../../../../config/config.php";
date_default_timezone_set('Brazil/East');

$mes = date("m");
$ano = date("Y");
$sql = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes'");
$ver = mysql_fetch_array($sql);
$nomeMes = strtoupper($ver['mes_valor']);



$dias1 = -30;
$mes1 = date("m", time() + ($dias1 * 86400));
$ano1 = date("Y", time() + ($dias1 * 86400));
$sql1 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes1'");
$ver1 = mysql_fetch_array($sql1);
$nomeMes1 = strtoupper($ver1['mes_valor']);

$dias2 = -60;
$mes2 = date("m", time() + ($dias2 * 86400));
$ano2 = date("Y", time() + ($dias2 * 86400));
$sql2 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes2'");
$ver2 = mysql_fetch_array($sql2);
$nomeMes2 = strtoupper($ver2['mes_valor']);

$dias3 = -90;
$mes3 = date("m", time() + ($dias3 * 86400));
$ano3 = date("Y", time() + ($dias3 * 86400));
$sql3 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes3'");
$ver3 = mysql_fetch_array($sql3);
$nomeMes3 = strtoupper($ver3['mes_valor']);

$dias4 = -120;
$mes4 = date("m", time() + ($dias4 * 86400));
$ano4 = date("Y", time() + ($dias4 * 86400));
$sql4 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes4'");
$ver4 = mysql_fetch_array($sql4);
$nomeMes4 = strtoupper($ver4['mes_valor']);

$dias5 = -150;
$mes5 = date("m", time() + ($dias5 * 86400));
$ano5 = date("Y", time() + ($dias5 * 86400));
$sql5 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes5'");
$ver5 = mysql_fetch_array($sql5);
$nomeMes5 = strtoupper($ver5['mes_valor']);

$dias6 = -180;
$mes6 = date("m", time() + ($dias6 * 86400));
$ano6 = date("Y", time() + ($dias6 * 86400));
$sql6 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes6'");
$ver6 = mysql_fetch_array($sql6);
$nomeMes6 = strtoupper($ver6['mes_valor']);


$dias7 = -210;
$mes7 = date("m", time() + ($dias7 * 86400));
$ano7 = date("Y", time() + ($dias7 * 86400));
$sql7 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes7'");
$ver7 = mysql_fetch_array($sql7);
$nomeMes7 = strtoupper($ver7['mes_valor']);

$dias8 = -240;
$mes8 = date("m", time() + ($dias8 * 86400));
$ano8 = date("Y", time() + ($dias8 * 86400));
$sql8 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes8'");
$ver8 = mysql_fetch_array($sql8);
$nomeMes8 = strtoupper($ver8['mes_valor']);

$dias9 = -270;
$mes9 = date("m", time() + ($dias9 * 86400));
$ano9 = date("Y", time() + ($dias9 * 86400));
$sql9 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes9'");
$ver9 = mysql_fetch_array($sql9);
$nomeMes9 = strtoupper($ver9['mes_valor']);

$dias10 = -300;
$mes10 = date("m", time() + ($dias10 * 86400));
$ano10 = date("Y", time() + ($dias10 * 86400));
$sql10 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes10'");
$ver10 = mysql_fetch_array($sql10);
$nomeMes10 = strtoupper($ver10['mes_valor']);

$dias11 = -320;
$mes11 = date("m", time() + ($dias11 * 86400));
$ano11 = date("Y", time() + ($dias11 * 86400));
$sql11 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes11'");
$ver11 = mysql_fetch_array($sql11);
$nomeMes11 = strtoupper($ver11['mes_valor']);

$dias12 = -360;
$mes12 = date("m", time() + ($dias12 * 86400));
$ano12 = date("Y", time() + ($dias12 * 86400));
$sql12 = mysql_query("SELECT * FROM sps_mes WHERE mes_mm='$mes12'");
$ver12 = mysql_fetch_array($sql12);
$nomeMes12 = strtoupper($ver12['mes_valor']);

?>

<div class="col-sm-12">
    <h3><strong>Gerar Relatório por Estabelecimento</strong></h3><br>
    <form action="relatorio_estabelecimento_buscar.php" name="form" method="post">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td style="width:15%; vertical-align:middle;" >Código nº</td>
                <td colspan="3"><input type="text" name="id" class="form-control" placeholder="Cód de Estabelecimento" required></td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6"><input type="radio" name="tipo" value="1" required> Mês Atual
                                <input type="hidden" name="mes" value="<?Php echo $mes; ?>">
                                <input type="hidden" name="ano" value="<?Php echo $ano; ?>">
                </td>
            </tr>
            <tr>
                <td style="width:15%; vertical-align:middle;"><input type="radio" name="tipo" value="2" required> Período</td> 
                <td style="width:5%; vertical-align:middle;">Início:</td>
                <td style="width:10%; vertical-align:middle;"><input type="text" name="inicio" maxlength="2" class="form-control" /></td>
                <td style="width:5%; vertical-align:middle;">Fim:</td>
                <td style="width:10%; vertical-align:middle;"><input type="text" maxlength="2" name="fim" class="form-control" /></td>
                <td style="width:45%; vertical-align:middle;">
                                <input type="hidden" name="mes2" value="<?Php echo $mes; ?>">
                                <input type="hidden" name="ano2" value="<?Php echo $ano; ?>">
                </td>
            </tr>
            <tr>
                <td style="width:15%; vertical-align:middle;"><input type="radio" name="tipo" value="3" required> Outro Período</td> 
                <td colspan="3" style="width:5%; vertical-align:middle;">
                    <select name="periodo" class="form-control">
                        <option value=""></option>
                        <option value="1"><?Php echo $nomeMes1." / ".$ano1; ?></option>
                        <option value="2"><?Php echo $nomeMes2." / ".$ano2; ?></option>
                        <option value="3"><?Php echo $nomeMes3." / ".$ano3; ?></option>
                        <option value="4"><?Php echo $nomeMes4." / ".$ano4; ?></option>
                        <option value="5"><?Php echo $nomeMes5." / ".$ano5; ?></option>
                        <option value="6"><?Php echo $nomeMes6." / ".$ano6; ?></option>
                        <option value="7"><?Php echo $nomeMes7." / ".$ano7; ?></option>
                        <option value="8"><?Php echo $nomeMes8." / ".$ano8; ?></option>
                        <option value="9"><?Php echo $nomeMes9." / ".$ano9; ?></option>
                        <option value="10"><?Php echo $nomeMes10." / ".$ano10; ?></option>
                        <option value="11"><?Php echo $nomeMes11." / ".$ano11; ?></option>
                        <option value="12"><?Php echo $nomeMes12." / ".$ano12; ?></option>
                    </select>
                </td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr style="background:none;">
                <td colspan="6"><br><button class="btn btn-primary" type="submit"> <i class="glyphicon glyphicon-search"></i> Gerar Relatório</button>
                <button class="btn btn-warning" type="reset"> <i class="glyphicon glyphicon-trash"></i> Limpar</button></td>
            </tr>
        </tbody>
    </table>
    </form>
</div>
</body>
</html>

