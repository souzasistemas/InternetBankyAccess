<?Php
session_start();

$id = $_GET['id'];
$contrato = $_GET['contrato'];
$empresa = $_GET['empresa'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$ver = mysqli_fetch_array($sql);
    $status = $ver['afiliado_status'];

if($ver['afiliado_conta_modo'] == "Fisica"){
    $name = $ver['afiliado_nome'];
}elseif($ver['afiliado_conta_modo'] == "Juridica"){
    $name = $ver['afiliado_fantasia'];
}     

$sqlEmpresa2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$empresa'");
$verEmpresa2 = mysqli_fetch_array($sqlEmpresa2);

if($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{
    


if($ver['afiliado_conta_modo'] != "Fisica"){
    $nome = $ver['afiliado_nome'];
    $documento = $ver['afiliado_cpf'];
    $doc = "CPF";
}elseif($ver['afiliado_conta_modo'] != "Juridica"){
    $nome = $ver['afiliado_razao'];
    $documento = $ver['afiliado_cnpj'];
    $doc = "CNPJ";
}


$sqlExcent = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_id='$contrato'");
$verExcent = mysqli_fetch_array($sqlExcent);
    
date_default_timezone_set('Brazil/East');
$dia = date('d');
$mes = date('m');
$ano = date('Y');

if($mes == "01"){
    $nomeMes = "Janeiro";
}elseif($mes == "02"){
    $nomeMes = "Fevereiro";
}elseif($mes == "03"){
    $nomeMes = "Março";
}elseif($mes == "04"){
    $nomeMes = "Abril";
}elseif($mes == "05"){
    $nomeMes = "Maio";
}elseif($mes == "06"){
    $nomeMes = "Junho";
}elseif($mes == "07"){
    $nomeMes = "Julho";
}elseif($mes == "08"){
    $nomeMes = "Outubro";
}elseif($mes == "09"){
    $nomeMes = "Setembro";
}elseif($mes == "10"){
    $nomeMes = "Outubro";
}elseif($mes == "11"){
    $nomeMes = "Novembro";
}elseif($mes == "12"){
    $nomeMes = "Dezembro";
}

function extenso($valor = 0, $maiusculas = false) {
    if(!$maiusculas){
        $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
        $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
        $u = ["", "um", "dois", "três", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
    }else{
        $singular = ["CENTAVO", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUADRILHÃO"];
        $plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUADRILHÕES"];
        $u = ["", "um", "dois", "TRÊS", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
    }

    $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
    $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
    $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];

    $z = 0;
    $rt = "";

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    for($i=0;$i<count($inteiro);$i++)
    for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
    $inteiro[$i] = "0".$inteiro[$i];

    $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
    for ($i=0;$i<count($inteiro);$i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
        $ru) ? " e " : "").$ru;
        $t = count($inteiro)-1-$i;
        $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")$z++; elseif ($z > 0) $z--;
        if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
        if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    if(!$maiusculas){
        $return = $rt ? $rt : "zero";
    } else {
        if ($rt) $rt = ereg_replace(" E "," e ",ucwords($rt));
            $return = ($rt) ? ($rt) : "Zero" ;
    }

    if(!$maiusculas){
        return ereg_replace(" E "," e ",ucwords($return));
    }else{
        return strtoupper($return);
    }
}
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

<style media="print">
.botao {
display: none;
}

</style>
</head>

<body id="principal">

<div class="w3-container w3-padding">

<table style="width:100%" class="botao">
    <tr>
        <td style="width:50%"><a href="aplicacao_extrato_detalhado.php?id=<?Php echo $id; ?>"><button class="w3-tag w3-round w3-green w3-padding-16" style="border:0; width:98%" type="button">Extrato Rendimentos</button></a></td>
        <td style="width:50%"><a href="aplicacao_novo_iniciar.php?id=<?Php echo $id; ?>"><button class="w3-tag w3-round w3-blue w3-padding-16" style="border:0; width:100%" type="button"> Nova Aplicação</button></a></td>
    </tr>
    <tr>
        <td style="width:50%"><button class="w3-tag w3-round w3-red w3-padding-16" style="border:0; width:98%; margin-top:2px;" onClick="history.back(-1)" type="button"> <i class="fa fa-reply"></i> Voltar</button></td>
        <td style="width:50%"><a href="javascript:window.print()"><button class="w3-tag w3-round w3-orange w3-padding-16 w3-text-white" onClick="window.print()" style="border:0; width:100%; margin-top:2px;" type="button"><i class="far fa-file-pdf"></i> Gerar Contrato PDF</button></a></td>
    </tr>
</table>

<div class="w3-container" style="text-align:justify">
    <hr>
    <h1 class="w3-large w3-center"><b>CONTRATO DE PARTICIPAÇÃO DE INVESTIDOR N° <?Php echo $contrato; ?></b></h1>
    
    <?Php echo $verEmpresa2['afiliado_cidade']; ?>, <?Php echo $verExcent['excent_data_contrato']; ?><br><br>
Pelo presente instrumento particular e na melhor forma de direito, de um lado: <br><br>

<?Php echo $nome; ?>, <?Php echo $ver['afiliado_estado_civil'] ?>, <?Php echo $ver['afiliado_profissao']; ?>, residente e domiciliado na <?Php echo $ver['afiliado_endereco']; ?>, <?Php echo $ver['afiliado_bairro']; ?>, <?Php echo $ver['afiliado_cidade']; ?>, <?Php echo $ver['afiliado_estado']; ?>, <?Php echo $ver['afiliado_nacao']; ?>, portador da cédula de identidade RG <?Php echo $ver['afiliado_rg']; ?>,   inscrito no CPF/CNPJ sob o no <?Php echo $documento; ?>,  doravante denominado INVESTIDOR; e, de outro lado: <br><br>


BGM CONSULTORIA E INVESTIMENTO EIRELLI, inscrito no CNPJ de nº 33.200.941/0001-28, doravante denominado PRESTADOR; resolvem instituir o presente Contrato de Investimentos financeiros, regido pelas Seguintes Cláusulas: Investidor e Sociedade, denominados, em conjunto, “Partes” e, individualmente, “Parte”; <br><br>

CONSIDERANDO QUE os Sócios são titulares e possuidores legítimos de 100% (cem por cento) do capital social da Sociedade, e o Investidor têm intenção realizar um aporte especial de capital, não conversível em quotas ou ações representativas do capital social da Sociedade, RESOLVEM as Partes, de boa-fé, celebrar o presente “Contrato de Participação de Investidor” (“Contrato” ou “Instrumento”), que se regerá pelas disposições do preâmbulo e pelas cláusulas e condições a seguir enumeradas: <br><br>

1. Definições <br><br>


1.1. Sem prejuízo de outras definições atribuídas nas Cláusulas deste Contrato, as palavras abaixo, quando utilizadas no singular ou plural, terão os seguintes significados: <br><br>

(i) Aporte: R$ <?php echo number_format($verExcent['excent_valor_bruto'], 2, ',', '.'); ?>.<br>

(ii) Percentual de Referência: <?php echo number_format($verExcent['excent_percentual']*100, 2, ',', '.'); ?>.%. <br>

(iv) Desconto: 6% sobre o resultado mensal. <br>

(v) Piso do Evento de Liquidez: R$ <?php echo number_format($verExcent['excent_valor_bruto'] * $verExcent['excent_percentual'], 2, ',', '.'); ?>. <br>

(vi) Prazo Máximo para Resgate: <?php echo $verExcent['excent_data_resgate']; ?> . <br><br>


2. Objeto <br><br>

2.1. Aporte Especial. Por meio deste Contrato, o Investidor disponibiliza à Sociedade o Aporte, em parcela única, devida na data de assinatura deste Contrato. O valor do Aporte representa o valor total bruto, sujeito a eventuais retenções de tributos. O Aporte não integrará o capital social da Sociedade, devendo ser contabilizado em conta do passivo da Sociedade, e será corrigido monetariamente pelo IGP-M/FGV. <br><br>
2.2. Emprego dos Recursos. Os Sócios acordam que os recursos decorrentes do Aporte serão utilizados pela Sociedade para o ganho de capital até o limite correspondente ao limite de 50% (cinquenta por cento) das ações da Sociedade, cujas ações ficarão em tesouraria. <br><br>
Os Sócios comprometem-se e obrigam-se a fazer com que a Sociedade empregue a totalidade do Aporte para os fins aqui previstos, sob pena de responsabilizarem-se, pessoal e solidariamente, pelo ressarcimento integral do Aporte ao Investidor, devidamente corrigido, nos termos da Cláusula Terceira adiante. <br><br>

3. Características Específicas do Aporte <br><br>
3.1. Isenção de Responsabilidade. As Partes declaram e concordam que o Investidor não será considerado sócio nem terá qualquer direito a gerência ou voto na administração da Sociedade, bem como não responderá por qualquer dívida da empresa, inclusive em recuperação judicial, não se aplicando ao Investidor o art. 50 do Código Civil. <br><br>
3.2. Direito de Resgate. O Investidor poderá resgatar seu Aporte a qualquer tempo entre o 2o aniversário do presente Instrumento até o Prazo Máximo para Resgate (“Resgate”), mediante comunicação escrita a ser enviada à Sociedade e aos Sócios com, pelo menos, 60 (sessenta) dias de antecedência à data do Resgate (“Notificação de Resgate”). Caso o Investidor não se manifeste sobre o Resgate até o Prazo Máximo para o Resgate, a Sociedade deverá, independentemente de qualquer Notificação de Resgate, realizar o pagamento do Resgate ao Investidor, nos termos desta Cláusula. <br><br>
3.2.1. Em caso de Resgate, o Investidor fará jus ao recebimento do menor entre os seguintes valores: (i) o valor do Aporte, devidamente corrigido pelo IGP-M/FGV até a data do Resgate; ou (ii) o Percentual de Referência multiplicado pelo valor patrimonial da Sociedade, a ser apurado com base em balanço especialmente levantado até a data do Resgate. Caberá à Sociedade, após o recebimento da Notificação de Resgate, levantar balanço com observância das normas e práticas contábeis geralmente aceitas no Brasil (“Balanço”) para a determinação do seu valor patrimonial. Em caso de atraso no pagamento do Resgate, a Sociedade ficará sujeita, independentemente de notificação ou interpelação, em ao pagamento de multa de 10% (dez por cento) e juros moratórios de 1% ao mês, sem prejuízo da correção monetária pelo IGP-M/FGV, até a integral liquidação do Resgate. <br><br>
3.3. Remuneração do Aporte. A partir do segundo aniversário do presente Instrumento, o Investidor fará jus a remuneração do Aporte equivalente ao Percentual de Referência multiplicado pelo Lucro da Sociedade, com piso de 4% (quatro por cento), a ser paga. O saldo do Lucro da Sociedade (correspondente aos 50% - cinquenta por cento das ações em tesouraria), após o pagamento da remuneração do Aporte, poderá ser distribuído entre os Sócios. Para os fins do presente Instrumento, “Lucro” corresponde ao resultado da Sociedade a ser distribuído aos Sócios nos termos da legislação societária, com observância às disposições aplicáveis da legislação do Simples Nacional. <br><br>
3.4. Direito de Preferência e Tag Along. Caso os sócios decidam pela Venda da Empresa, o Investidor terá direito de preferência na aquisição, bem como direito de venda conjunta da sua titularidade do aporte de capital, nos mesmos termos e condições que forem ofertados aos Sócios e observado o Percentual de Referência. <br><br>
3.4.1. Para fins deste Contrato, considera-se “Venda da Empresa” a venda ou alienação, em uma ou em série de operações correlatas, da totalidade dos negócios e ativos da Sociedade, ou de quotas ou ações representativas do Controle da Sociedade; para fins desta Cláusula, será considerado “Controle” (a) a titularidade, direta ou indireta, de participações societárias com direito a voto que confiram ao(s) titular(es) o poder de orientar ou causar a orientação da administração ou políticas da Sociedade; ou (b) o poder de nomear a maioria dos administradores da Sociedade, seja por meio da participação societária, por meio de contrato ou de qualquer outra forma; ou (c) o direito de indicação e/ou eleição da maioria dos membros da administração da Sociedade <br><br>
3.5. Hipóteses de Resgate Imediato. O Investidor terá o direito de realizar o Resgate, imediatamente: (i) em caso de inadimplemento de qualquer das obrigações assumidas pela Sociedade e/ou pelos Sócios neste Contrato, sem prejuízo do Investidor ser indenizado por quaisquer perdas e danos decorrentes da violação dessas obrigações; ou (ii) em caso de falsidade, incorreção ou insuficiência de qualquer declaração prestada pela Sociedade e/ou pelos Sócios neste Contrato, sem prejuízo do Investidor ser indenizado por quaisquer perdas e danos decorrentes de falsidade, incorreção ou insuficiência de quaisquer dessas declarações. <br><br>
3.6. Vedação a Pagamento Antecipado. Exceto na Data Máxima de Resgate, em nenhuma hipótese poderá a Sociedade e/ou qualquer um dos Sócios decidir pelo pagamento do valor do Resgate sem a prévia e expressa anuência, por escrito, do Investidor. Qualquer ato praticado pela Sociedade e/ou qualquer um dos Sócios em violação a esta Cláusula será considerado nulo e ineficaz para todos os efeitos legais e sujeitará a Sociedade, independentemente de notificação ou interpelação, ao pagamento de multa de 100% (cem por cento) sobre o valor integral do Aporte. <br><br>
3.7. Resgate em decorrência do término da Sociedade. Na hipótese de (i) pedido de falência ou autofalência, decretação de falência, pedido de recuperação judicial ou extrajudicial, ou, ainda, qualquer procedimento judicial análogo, ou (ii) dissolução e/ou liquidação da Sociedade (um “Evento de Término da Sociedade”) até a Data de Vencimento, a Sociedade deverá realizar o pagamento do Aporte ao Investidor, com a maior prioridade permitida pela legislação em relação a outros débitos que a Sociedade possa ter na data do Evento de Término da Sociedade. Na hipótese de, imediatamente após o Evento de Término da Sociedade, a Sociedade não ter ativos suficientes para realizar o pagamento do Aporte, a totalidade dos ativos restantes da Sociedade deverá ser liquidada para pagamento ao Investidor, antes de qualquer distribuição aos Sócios. <br><br>
4. Direito de Conversão <br><br>
4.1. Conversão. Na ocorrência de um Evento de Liquidez ou na data do Prazo Máximo para Resgate, o Investidor não terá o direito de converter o Aporte em participação societária na Sociedade (“Conversão”), observado o disposto nesta Cláusula Quarta. <br><br>
5. Direitos do Investidor em Rodadas Futuras <br><br>
5.1. Futuras Rodadas. As Partes reconhecem que nada no presente Instrumento impede que a Sociedade e os Sócios possam buscar novos investidores para a Sociedade, desde que observado o seguinte: a) a celebração, pelos Sócios ou pela Sociedade, de quaisquer contratos ou acordos, orais ou escritos, que tenham por objeto a emissão, alienação ou transferência, a qualquer título, de quotas ou ações da Sociedade, ou a outorga de quaisquer opções de compra, direitos de subscrição ou direitos similares ou, ainda, qualquer forma de transferência de direitos de sócio a terceiros estará condicionada à anuência dos respectivos terceiros aos termos e condições do presente Contrato, de modo que tais terceiros concordem com e ratifiquem, expressamente, o aqui ajustado entre as Partes; b) a Sociedade e os Sócios, solidariamente, deverão garantir que futuros sócios da Sociedade irão renunciar, por escrito, a todo e qualquer direito de preferência sobre as ações em tesouraria de que sejam ou venham a ser titulares por disposição de lei ou regulamento ou a qualquer outro título, com relação à subscrição das ações alcançadas pela Conversão, concordando com a Conversão pelo Investidor e reconhecendo o Investidor como único titular do direito de adquirir a totalidade das ações alcançadas pela Conversão, conforme previsto no presente Instrumento; e c) salvo em caso de autorização expressa e por escrito do Investidor, nenhum termo, condição ou encargo assumido pela Sociedade e/ou Sócios no contexto de novos investimentos na Sociedade deverão restringir ou impedir o cumprimento das obrigações previstas neste Contrato. Em caso de divergência ou conflito entre o disposto neste Instrumento e em qualquer instrumento particular firmado entre os Sócios e a Sociedade ou, entre os Sócios, a Sociedade e terceiros, o disposto neste Instrumento deverá prevalecer.<br><br>

6. Disposições Gerais. <br><br>
6.1. Obrigação de Indenizar. Sem prejuízo (a) da aplicação das penalidades previstas na legislação cível e penal aplicável, e (b) da adoção de medidas cautelares ou preventivas proferidas por autoridade competente com o fim de restringir ou proibir atos que possam constituir ônus ou prejuízo para qualquer uma das Partes, cada uma das Partes obriga-se e compromete-se a indenizar a outra Parte de todas e quaisquer perdas, condenações, contingências, custos, despesas, multas e penalidades de qualquer natureza que porventura sejam incorridas pela outra Parte em decorrência de qualquer falsidade, omissão ou inexatidão das declarações e garantias prestadas neste Instrumento; ou qualquer infração ou violação a, ou omissão do cumprimento de, qualquer termo, compromisso ou obrigação assumida neste Contrato. <br><br>
6.2. Pagamento de Tributos. Cada uma das Partes será responsável pela apuração e pagamento dos impostos, taxas ou outros tributos pelos quais, segundo a legislação aplicável, seja responsável tributário. <br><br>
6.3. Acordo Integral. O presente Instrumento reflete a íntegra dos entendimentos e acordos assumidos entre as Partes em relação ao objeto deste Contrato. Sendo assim, revoga e substitui qualquer entendimento, acordo ou contrato, verbal ou escrito, celebrado anteriormente à assinatura deste Instrumento que se refira ao mesmo objeto aqui disposto, incluindo quaisquer memorandos, term-sheets e contratos preliminares. <br><br>
6.4. Confidencialidade. Cada uma das Partes compromete-se a manter em sigilo de todas as informações oriundas do objeto deste Contrato, bem como a própria existência deste, sob pena de rescisão imediata deste Instrumento, sem prejuízo da cobrança das perdas e danos a que der causa. <br><br>
6.5. Alteração. O presente Instrumento somente poderá ser validamente alterado, modificado ou aditado por manifestação expressa, mediante instrumento escrito devidamente assinado pelas Partes.<br><br>
6.6. Autonomia das Disposições. A invalidade parcial deste Instrumento não a afetará na parte considerada válida, desde que as obrigações sejam desmembráveis entre si. Ocorrendo o disposto nesta Cláusula, as Partes desde já se comprometem a negociar, no menor prazo possível, em substituição à cláusula invalidada, a inclusão de termos e condições válidos que reflitam os termos e condições da cláusula invalidada, observados a intenção e objetivo das Partes quando da negociação da cláusula invalidada e o contexto em que se insere. <br><br>
6.7. Notificações. Todas as notificações, consentimentos, solicitações e outras comunicações previstas neste Instrumento serão realizadas por escrito, e deverão ser entregues pessoalmente, por carta ou por e-mail, em qualquer hipótese, com comprovante de recebimento, nos endereços e para as pessoas indicadas no preâmbulo deste Instrumento, ou conforme de outra forma especificado por uma Parte à outra, por escrito. Qualquer Parte poderá mudar o endereço para o qual a notificação deverá ser enviada, mediante notificação prévia escrita às demais Partes. <br><br>
6.8. Efeito Vinculante. O presente Instrumento vincula as Partes e seus sucessores a qualquer título, em caráter irrevogável e irretratável, ao fiel cumprimento deste Instrumento. <br><br>
6.9. Tolerância e Renúncia. A tolerância de qualquer das Partes com relação à exigência do regular e tempestivo cumprimento das obrigações de outra Parte não constituirá desistência, alteração, modificação, ou novação de quaisquer dos direitos ou obrigações estabelecidas por meio deste Instrumento, constituindo mera liberdade, que não impedirá a Parte tolerante de exigir da outra o fiel e cabal cumprimento deste Instrumento, a qualquer tempo. Nenhuma renúncia a exercício de direito assegurado neste Instrumento será válida, exceto se formalizada por escrito pela Parte renunciante. <br><br>
6.10. Cessão. Nenhuma das Partes poderá ceder este Instrumento, no todo ou em parte, sem o consentimento escrito e prévio das outras Partes. <br><br>
6.11. Execução Específica. Sem prejuízo de outros recursos detidos pelas Partes, todas as disposições e obrigações assumidas neste Contrato são passíveis de execução específica, nos termos do Código de Processo Civil, sem prejuízo de eventuais perdas e danos para satisfação adequada do direito das Partes. <br><br>
6.12. Anexos. Todos os Anexos mencionados neste Contrato são parte integrante ao presente Contrato, para todos os efeitos de direito. Na hipótese de divergências entre as disposições contidas nos Anexos e no presente Instrumento, as disposições do Contrato deverão prevalecer. 6.13. Foro. Fica eleito o Foro da Comarca da sede da Sociedade como o único competente, renunciando-se a todos os outros, por mais especiais ou privilegiados que sejam. E por estarem assim, justas e contratadas, assinam as Partes o presente Instrumento em 3 (três) vias, de um só teor, juntamente com as 2 (duas) testemunhas abaixo. <br><br>

<?Php echo $nomeEmpresa; ?><br><br>

<center>ANEXO I OBRIGAÇÕES ADICIONAIS</center> <br><br>

No contexto de um investimento em fase inicial, é comum que investidores e empreendedores acordem em assumir obrigações contratuais adicionais, não necessariamente vinculadas com o escopo principal do investimento. Essas obrigações variam muito de investimento para investimento, mas podem incluir questões como não-concorrência, vedação à redução de capital, regras para apresentação de relatórios, direito de preferência para novos investimentos, entre outros temas. Em alguns casos, é comum, inclusive, prever a execução de um acordo de sócios, que será vigente logo após a conversão do investimento. Por se tratar de obrigações extremamente vinculadas ao caso concreto, recomendamos que os interessados em utilizar estruturas semelhantes a essas em seus investimentos procurem a assessoria e aconselhamento de advogados. De qualquer forma, os Documentos Modelo e o Guia de Investimento trazem importantes definições e modelos de cláusula que podem servir como referência. <br><br>

</div>






<div id="sair" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-3 w3-shadow" style="height:150px; width:100px; border-radius:10px">
        <header class="w3-container w3-black" style="border-radius:10px 10px 0 0">
            <center><h3>Deseja Realmente Sair?</h3>
        </header>
        <center><br>
        <table style="width:98%; margin-top:10px;">
<tr>
<td style="border:none; text-align:left; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-red w3-padding-16" onclick="document.getElementById('sair').style.display='none'"><i class="fa fa-times" aria-hidden="true"></i> NÃO</button></td>
<td style="border:none; text-align:right; width:50%"><button style="width:98%; border:none;" class="btn-lg w3-green w3-padding-16" onClick="javascript:location.href='fechar.php?id=<?Php echo $id; ?>'"><i style="font-size:16px;" class="fa fa-check" aria-hidden="true"></i> SIM</button></td>
</tr>
</table></center>
    </div>
</div>
</body>
</html>

<?Php
}
}
?>