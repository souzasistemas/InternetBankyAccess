<?Php
require "../../../../../config/config.php";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Administrativo Acessomundi</title>
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
  	
  	<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>

<SCRIPT LANGUAGE="JavaScript">   
<!-- Disable   
function disableselect(e){   
return false   
}   

function reEnable(){   
return true   
}   

//if IE4+   
document.onselectstart=new Function ("return false")   
document.oncontextmenu=new Function ("return false")   
//if NS6   
if (window.sidebar){   
document.onmousedown=disableselect   
document.onclick=reEnable   
}   
//-->   
</script>  
  

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

body#principal{
    background-color:#F4F4F4;
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

  </style>
  
 

<script language="javascript">
//-----------------------------------------------------
//Funcao: MascaraMoeda
//Sinopse: Mascara de preenchimento de moeda
//Parametro:
//   objTextBox : Objeto (TextBox)
//   SeparadorMilesimo : Caracter separador de milésimos
//   SeparadorDecimal : Caracter separador de decimais
//   e : Evento
//Retorno: Booleano
//Autor: Gabriel Fróes - www.codigofonte.com.br
//-----------------------------------------------------
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
</script>

 
</head>

<body id="principal">
<br><br><br><br>

<div class="container" style="text-align:left; width:600px;">
<center>

<?Php

$adm = $_POST['id'];
$valor = $_POST['valor'];
$taxa = $_POST['taxa'];
$aplicacao = $_POST['aplicacao'];
$permissao = $_POST['permissao'];
$percentual = $_POST['percentual'];
$plano = $_POST['plano'];
$emp = $_POST['emp'];
$id = $_POST['afiliado'];

date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$ano2 = date('y');
$hora = date('H');
$min = date('i');
$seg = date('s');
$horario = date('H:i:s');

function somar_data($data, $dias, $meses, $ano){
    $data = explode("/", $data);
    $resData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
    return $resData;
}

$sqlPlano = mysql_query("SELECT * FROM sps_planos_investimentos WHERE invest_empresa='$emp' AND invest_id='$plano'");
$verPlano = mysql_fetch_array($sqlPlano);
    $dataVencimento = $verPlano['invest_data_retirar'];
    $dataIniciar = $verPlano['invest_data_iniciar'];
    $dataAplicar = $verPlano['invest_data_aplicar'];
    
$sqlAfiliado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$emp'");
$verAfiliado = mysql_fetch_array($sqlAfiliado);

if($verAfiliado['afiliado_conta_modo'] == "Fisica"){
    $nome = $verAfiliado['afiliado_nome'];
}elseif($verAfiliado['afiliado_conta_modo'] == "Juridica"){
    $nome = $verAfiliado['afiliado_razao'];
}
    
$dias_de_prazo_para_pagamento_afiliado1 = $dataVencimento;
$vencimento = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado1 = $dataIniciar;
$dataIniciar = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado1 * 86400));

$dias_de_prazo_para_pagamento_afiliado2 = $dataAplicar;
$dataAplicar = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento_afiliado2 * 86400));

$protocolo = "$id$dia$mes$ano2$hora$min$seg";

$residual = $aplicacao * $percentual;

$insert = mysql_query("INSERT INTO sps_excent(excent_afiliado_id, excent_empresa, excent_plano, excent_valor_bruto, excent_taxa_adm, excent_valor_liquido, excent_percentual, excent_valor_residual, excent_status, excent_protocolo, excent_executar, excent_data_resgate, excent_iniciar,excent_data_contrato, excent_data_iniciar, excent_data_aplicar) VALUES ('$id', '$emp', '$plano', '$valor', '$taxa', '$aplicacao', '$percentual', '$residual', 'Ativo', '$protocolo', 'Feito', '$vencimento', 'Pendente', '$dia/$mes/$ano', '$dataIniciar', '$dataAplicar')", $ellevar);

if($insert == "1"){

$idAdm = "1000";
$idAplicacao = $emp;
$idEmpresa = "5";
$taxaEmpresa = $taxa * 0.50;

$credito = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$id', '$valor', 'Não', 'Recarga', 'RECARGA SOLICITADA', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito', 'Não')", $ellevar);
$debito = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$id', '$valor', 'Não', 'Retirada', 'APLICAÇÃO $nome', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', 'Não')", $ellevar);

$Ativacao = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$idAdm', '$valor', 'Não', 'Ativacao', 'APLICAÇÃO $nome DA CONTA $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito', 'Não')", $ellevar); 

/**Empresa */
$Empresa1 = mysql_query("INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$idAdm', '$taxaEmpresa', 'Não', 'Retirada', 'RESERVA EMPRESA SOBRE TARIFA DA APLICAÇÃO $nome DA CONTA: $id PARA CONTA $idEmpresa', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', 'Não')", $ellevar);
$Empresa2 = mysql_query("INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$idEmpresa', '$taxaEmpresa', 'Não', 'Recarga', 'RESERVA SOBRE TARIFA DA APLICAÇÃO $nome DA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito', 'Não')", $ellevar);

/**Aplicacao */
$Aplicacao1 = mysql_query("INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$idAdm', '$aplicacao', 'Não', 'Retirada', 'RETIRADA PARA RENDIMENTO DA APLICAÇÃO $nome DA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano',  '$horario', 'Debito', 'Não')", $ellevar);
$Aplicacao2 = mysql_query("INSERT INTO sps_extrato (extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_teste) VALUES ('$idAplicacao', '$aplicacao', 'Não', 'Taxa', 'APLICAÇÃO $nome DA CONTA: $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Credito', 'Não')", $ellevar);

$protocolo2 = "$idInvestteam$ano$mes$dia$hora$min$seg";

$Saque = mysql_query("INSERT INTO sps_extrato(extrato_afiliado_id, extrato_valor, extrato_acao, extrato_modulo, extrato_descricao, extrato_dia, extrato_mes, extrato_ano, extrato_data, extrato_hora, extrato_tipo, extrato_protocolo, extrato_status_saque, extrato_modo_saque, extrato_tipo_modo, extrato_teste) VALUES ('$idAplicacao', '$aplicacao', 'Não', 'Retirada', 'APLICAÇÃO $nome CLIENTE $id', '$dia', '$mes', '$ano', '$dia/$mes/$ano', '$horario', 'Debito', '$protocolo2', 'Pago', 'Transferência Bancária', 'Retirada', 'Não')", $ellevar);

if($permissao != "0"){
    echo "<h1 class='h3-jumbo'>Investidor cadastrado com sucesso.</h1><br><br>";
	echo "<a href='excent.php?id=".$adm."'><button type='button' class='btn btn-info btn-lg'>Ver Investidores</button></a>";  
}else{
    echo "<h1 class='h3-jumbo'>Investidor cadastrado com sucesso.</h1><br><br>";
	echo "<a href='excent_geral.php?id=".$adm."'><button type='button' class='btn btn-info btn-lg'>Ver Investidores</button></a>"; 
}
}else{
    echo "<script>history.back(-1);alert('Não foi possível realizar o Cadastro do Investidor! Entrar em contato com o Suporte!');</script>";
}    
   
?>



</body>
</html>