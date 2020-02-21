<?Php
session_start();

$id = $_GET['id'];
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


if($status == "Bloqueado"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}elseif($ver['afiliado_status_acesso'] != "Sim"){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{
    


/***** saldo em conta */
$sql_credito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Credito'");
$ver_credito = mysqli_fetch_assoc($sql_credito);
$credito = $ver_credito['sum(extrato_valor)'];

$sql_debito = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato WHERE extrato_afiliado_id='$id' AND extrato_tipo='Debito'");
$ver_debito = mysqli_fetch_assoc($sql_debito);
$debito = $ver_debito['sum(extrato_valor)'];

$saldo_disponivel = $credito - $debito;



/***** limite aprovado  */
$sql_credito2 = mysqli_query($conexao, "SELECT sum(extrato_valor) FROM sps_extrato_credito WHERE extrato_afiliado_id='$id'");
$ver_credito2 = mysqli_fetch_assoc($sql_credito2);
$credito2 = $ver_credito2['sum(extrato_valor)'];

$sql_movimento2 = mysqli_query($conexao, "SELECT sum(movimento_valor) FROM sps_movimentacao_credito WHERE movimento_afiliado_id='$id' AND movimento_status_afiliado='Pendente'");
$ver_movimento2 = mysqli_fetch_assoc($sql_movimento2);
$movimento2 = $ver_movimento2['sum(movimento_valor)'];

$saldo_disponivel2 = $credito2 - $movimento2;


/***** Débito em Aberto  */
$sql_debito2 = mysqli_query($conexao, "SELECT sum(pi_afiliado_id_valor) FROM sps_patrocinio WHERE pi_afiliado_id='$id' AND pi_status='Pendente'");
$ver_debito2 = mysqli_fetch_assoc($sql_debito2);
$debitoAberto = $ver_debito2['sum(pi_afiliado_id_valor)'];

$saldoGeral = $saldo_disponivel + $saldo_disponivel2 - $debitoAberto;

date_default_timezone_set('Brazil/East');
$hora_do_dia = date('H');

if(($hora_do_dia >=6) && ($hora_do_dia <=12)){
	$saudacao = "Bom Dia!";
}elseif(($hora_do_dia >12) && ($hora_do_dia <=18)){
	$saudacao = "Bom Tarde!";
}elseif(($hora_do_dia >18) && ($hora_do_dia <=23)){
	$saudacao = "Boa Noite!";
}elseif(($hora_do_dia >=0) && ($hora_do_dia <6)){
	$saudacao = "Boa Madrugada!";
}

$sqlExcent = mysqli_query($conexao, "SELECT * FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent = mysqli_fetch_array($sqlExcent);
$totalExcent = mysqli_num_rows($sqlExcent);

$sqlExcent2 = mysqli_query($conexao, "SELECT sum(excent_valor_liquido) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent2 = mysqli_fetch_array($sqlExcent2);
    $totalValor2 = $verExcent2['sum(excent_valor_liquido)'];
    
$sqlExcent3 = mysqli_query($conexao, "SELECT sum(excent_valor_residual) FROM sps_excent WHERE excent_afiliado_id='$id' AND excent_status='Ativo'");
$verExcent3 = mysqli_fetch_array($sqlExcent3);
    $totalValor3 = $verExcent3['sum(excent_valor_residual)'] * 20;
    

$sqlExcent4= mysqli_query($conexao, "SELECT sum(residual_valor_pagar) FROM sps_excent_residual WHERE residual_afiliado_id='$id' AND residual_status!='Pago'");
$verExcent4 = mysqli_fetch_array($sqlExcent4);
    $totalValor4 = $verExcent4['sum(residual_valor_pagar)'];
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
</head>

<body id="principal">


<div class="w3-container">
    <div class="w3-text-gray w3-light-gray w3-padding w3-round w3-border" style="font-size:12px; margin-top:10px;"><b>REGRAS PARA NOVAS APLICAÇÕES</b><br><br>
    Aplicação Inicial a partir de <b>R$ 1000,00 (Mil Reais)</b>.<br>
    Basta escolher um de nossos pacotes e o valor para iniciar sua aplicação.</div>
    
    
    <?Php 
    $sqlPlanos = mysqli_query($conexao, "SELECT * FROM sps_planos_investimentos WHERE invest_empresa='$empresa'");
    while($verPlanos = mysqli_fetch_array($sqlPlanos)){
    ?>
    
    <a href="aplicacao_novo_investimento.php?id=<?Php echo $id; ?>&&pac=<?Php echo $verPlanos['invest_id']; ?>&&empresa=<?Php echo $empresa; ?>">
        <div class="w3-padding w3-blue-gray w3-border-bottom w3-border-top w3-round" style="width:100%; text-align:left; margin-top:2px;">
            <table class="w3-table">
                <tr>
                    <td style="width:10%; text-align:center; vertical-align:middle;"><i class="fas fa-chart-line" style="font-size:40px;"></i></td>
                    <td style="width:90%; font-size:14px; text-align:center; vertical-align:middle;"><b style="font-size:18px;"><?Php echo $verPlanos['invest_nome']; ?></b><br><?Php echo number_format(($verPlanos['invest_rendimento']*100)*20,2,",",".");?>% A.M</td>
                </tr>
            </table>
        </div>
    </a>
    
    
    <?Php
    }
    ?>
    
    
    <a href="aplicacao2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><div class="w3-padding-16 w3-red w3-round w3-text-white w3-center" style="width:100%; text-align:left; margin-top:2px;"><i class="fa fa-reply" style="font-size:20px;"></i> <b style="font-size:18px;">VOLTAR</b>
    </div></a>
    <br>
    <div class="x3-small w3-center w3-text-gray"><a onclick="document.getElementById('id01').style.display='block'">Visualizar Contrato</a></div>
    
    <br><br>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4 w3-round" style="margin-bottom:20px;">
      <header class="w3-container w3-black" style="border-radius:5px 5px 0 0;"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-round">&times;</span>
        <h2 class="w3-medium w3-center">POLÍTICA DE PRIVACIDADE<br> DO CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE INVESTIMENTOS</h2>
      </header>
    
    
    
    <div class="w3-container" style="text-align:justify">
    <hr>
    
    
    <b>Usuário, doravante denominado <b>PARCEIRO</b> e por outro lado, <b>a EMPRESA, doravante denominado <b>INVESTIDOR</b>; resolvem instituir o presente Contrato de Investimentos financeiros, regido pelas Seguintes Cláusulas: :<br><br>

<b>CLÁUSULA PRIMEIRA: DO OBJETO</b> <br><br>
1.1 - O contrato, tal como aqui definido, tem o objetivo de administrar o relacionamento entre o PRESTADOR e INVESTIDOR, em relação a gestão ao Contrato Serviços de consultoria em investimentos, bem como os rendimentos em dias úteis com resgate de acordo com o pacote adquirido, automáticos disponível em sua conta via APP após o INVESTIDOR declarar aceitação dos termos e condições deste contrato. <br><br>
<b>CLÁUSULA SEGUNDA – DAS CONDIÇÕES DE CONTRATAÇÃO </b> <br><br>
2.1 – O PRESTADOR prestará serviços de Investimentos principalmente o de TRADER no mercado mundial, para a realização de Operação Financeira, conforme o conhecimento do INVESTIDOR/PRESTADOR. <br><br>
2.2 – Nas operações permitidas pela legislação brasileira o PRESTADOR poderá operar em nome do INVESTIDOR, com as condições seguintes: <br><br>
- o capital social da empresa está em tesouraria em 50% (cinquenta por cento); <br><br>
- o valor reservado serve para pagamento do INVESTIDOR, na proporção do investimento, de acordo com o capital social; <br><br>
- o INVESTIDOR não tem participação societária, mas tem prioridade no recebimento dos dividendos na proporção de seus investimentos. <br><br>
2.3 – O INVESTIDOR, deverá observar todas as normas adiantes estabelecidos bem como fazer o investimento sobre a modalidade de INVESTIDOR, conforme cláusulas e condições seguintes. <br><br>
2.4 - Integram-se este contrato, no que couber, e aos interessados obrigam-se a cumprir integralmente, naquilo que lhes competirem, a legislação em vigor, as normas e os procedimentos definidos em Estatuto Social, Regulamentos, Manuais e Ofícios Circulares e as Regras e Parâmetros de atuação da , observadas, adicionalmente, as regras especificas das autoridades governamentais que possam afetar os termos neles contidos, bem como os termos do Mútuo adiante expostos. <br><br>
2.5 - As operações a serem executadas pela sujeitam-se às seguintes normas e práticas que o Investidor declara conhecer e concordar: <br><br>
2.5.1 - Disposições legais e regulamentares aplicáveis, editadas pelos órgãos de regulação e pelas demais autoridades competentes; <br><br>
2.5.2 - Normas expedidas e práticas adotadas pelas entidades administradoras de mercados organizados; <br><br>
2.5.3 - Regras e parâmetros de atuação da; <br><br>
2.5.4 - Uso, práticas e costumes adotados e geralmente aceitos pelo mercado. <br><br>
2.6 - O Investidor deverá manter seu cadastro permanentemente atualizado perante a, fornecendo as informações e os documentos necessários para tanto. <br><br>
2.7 - À reserva-se o direito de não agir em instruções fornecidas pelo Investidor caso não esteja satisfeita quanto à sua autenticidade. A não será responsável pelas consequências de qualquer atraso ou qualquer perda que surja como resultado de ser incapaz de entrar em contato com o Investidor para concluir as verificações de segurança. <br><br>
2.8 – O PRESTADOR não fornecerá qualquer plataforma de negociação nem se envolverá em qualquer processo de abertura de conta de negociação em nome do Investidor. <br><br>
2.9 - Os recursos financeiros encaminhados pelo INVESTIDOR somente serão considerados após a confirmação por parte da empresa da efetiva disponibilidade dos mesmos. <br><br>
2.10 - O INVESTIDOR, em caso de inobservância de qualquer das obrigações regulamentares ou daquelas previstas neste contrato, estará sujeito ao pagamento de multas impostas pelos órgãos reguladores ou entidades administradoras de mercados, sendo o responsável por todos os ônus e despesas a que seu inadimplemento deu causa ou que forem necessários para dar cumprimento às obrigações que lhe competem. <br><br>
2.11 - O INVESTIDOR declara assumir integral responsabilidade civil e criminal pela veracidade dos dados e informações prestados ao PRESTADOR. <br><br>
2.12 - O ALUNO INVESTIDOR/MUTUÁRIO declara conhecer e aceitar como válidas e obrigatórias, para reger todas e quaisquer operações por sua conta e ordem realizadas pela PRESTADORA, as disposições contidas nas normas legais e regulamentares mencionadas neste instrumento, e suas ulteriores alterações, que serão aplicáveis imediatamente. <br><br>
2.13 - Qualquer omissão ou tolerância da em relação aos direitos que lhe são conferidos neste contrato ou pelas normas e regulamentos aplicáveis, não importará em renúncia a tais direitos nem tampouco constituirá novação ou modificação das obrigações do Investidor, podendo a exercê-las plenamente a qualquer tempo. <br><br>
2.14 - Os interessados não poderão ceder ou transferir os direitos e obrigações previstos neste termo para terceiros sem a prévia anuência da PRESTADORA. <br><br>
2.15 - - Este Contrato e todas as transações estão sujeitos aos regulamentos aplicáveis, de forma que: <br><br>
2.15.1 – Se houverem conflitos entre este contrato e os regulamentos aplicáveis, o último prevalecerá; <br><br>
2.15.2 – A poderá ou não tomar medidas que considerar necessárias para assegurar os regulamentos aplicáveis; <br><br>
2.15.3 – Todos os regulamentos aplicáveis e os que a fizer ou não para cumpri-los, envolverão o Cliente; <br><br>
2.15.4 - A não será responsável pela tomada ou não de medidas para o cumprimento dos regulamentos aplicáveis. <br><br>
2.16 – É de responsabilidade do INVESTIDOR em manter a senha do seu Escritório Virtual segura e confidencial. O INVESTIDOR não deve compartilhar os dados de sua senha com outras partes. Se o Cliente repassou sua senha ou dados de login a outra pessoa, ou suspeita que alguém possa saber, é de responsabilidade do INVESTIDOR comunicar ao PRESTADOR, solicitando a alteração. <br><br>
2.17 – Ao assinar este Contrato, o Cliente concorda em fornecer a todos os dados de contatos relevantes, de forma que a possa contatar o INVESTIDOR por escrito, por e-mail, fax e/ou telefone, conforme o caso. É de responsabilidade do Cliente informar a imediatamente, caso quaisquer dos dados do Contrato forem alterados. <br><br>
2.18 – O INVESTIDOR declara ser capaz e está plenamente apto a confirmar este contrato. <br><br>
2.19 - INVESTIDOR declara possuir toda autoridade, poderes, consentimentos, licenças, se necessário, e autorizações necessárias, e que tomou todas as medidas necessárias para estar legalmente capacitado para confirmar e executar este Contrato e os investimentos pertinentes, e para outorgar os direitos reais de garantia e poderes mencionados neste contrato. <br><br>
2.20 - O INVESTIDOR declara estar agindo em seu próprio nome e não como fideicomissário ao assinar este Contrato e cada investimento. <br><br>
2.21 – O INVESTIDOR se compromete a tomar todas as medidas razoáveis e cumprir com todos os regulamentos aplicáveis referentes a este contrato, desde que sejam pertinentes ao INVESTIDOR. <br><br>
2.22 – A não será responsável por qualquer prejuízo ou despesa que o INVESTIDOR incorrer direta ou indiretamente em relação a: <br><br>
2.22.1 – Qualquer erro ou falha na operação do Escritório Virtual ou qualquer atraso causado pela plataforma; <br><br>
2.22.2 – Transações efetuadas por meio do Escritório Virtual; <br><br>
2.22.3 – O não cumprimento por parte da de quaisquer de suas obrigações previstas neste contrato, decorrente de causa além de seu controle; ou 
2.22.4 – Atos, omissões ou negligência de qualquer agente autorizado. <br><br>
2.23 – O INVESTIDOR é responsável por arcar com quaisquer prejuízos que a possa incorrer devido ao não desempenho de suas obrigações, previstas neste contrato ou de seu uso do Escritório Virtual. <br><br>
2.24 O gerenciamento da conta dar-se-á por meio do INTERNET BANKY ACCESS, na qual tem autonomia de gestão e para a cobrança de tarifas, nas quais se vinculam a este contrato e são de responsabilidade do emissor. <br><br>
2.25 - O emissor da Conta, possui regras próprias de gestão e de utilização da plataforma que devem ser consultadas pelo INVESTIDOR através do site: www.bgmconsultoriaeminvest.com.br<br><br> 
2.26 – O INVESTIDOR declara estar ciente de que está sujeito às condições contratuais do gestor da conta virtual e de que é conhecedor das condições e instruções para o seu uso. <br><br>
<b>CLÁUSULA TERCEIRA: DOS DETALHES OPERACIONAIS </b> <br><br>
3.1 O INVESTIDOR abrirá uma conta na , por meio do APP Investteam. Neste momento, será gerado um número de identificação único e este passará a ser utilizado internamente para identificar o INVESTIDOR. <br><br>
3.2 - Para iniciar suas operações, o INVESTIDOR creditará fundos por meio de depósito ou transferência bancária na conta ou utilizando-se das opções de pagamento disponibilizadas, onde esse valor será convertido em créditos para a realização do investimento. <br><br>
3.3 – O cliente terá a opção de escolher dentre os pacotes de investimentos com rendimentos distintos de acordo com o pacote escolhido. <br><br>
3.4 - Os rendimentos começarão a ser auferidos em dias úteis a partir do décimo dia da contratação ao pacote de investimento escolhido. O lucro esperado em base diária será creditado em sua conta, de forma automática, sem a necessidade de solicitações de resgate, enquanto o valor principal do pacote de investimentos continuar aplicado. <br><br>
3.6 - O INVESTIDOR poderá utilizar o rendimento/saldo dentro de suas contas através dos serviços disponíveis ou realizar compras na Rede Credenciada, conforme as condições e instruções do APP. <br><br>
3.7 – Caso queira efetuar o cancelamento de seu pacote de investimentos, o INVESTIDOR terá 10 dias após o vencimento do contrato e deverá realizar solicitação pelos meios de atendimento disponibilizados pela, a qual terá o prazo máximo de 30 dias para disponibilizar o valor principal investido em sua conta BGM. <br><br>
3.8 - O Investidor poderá utilizar o seu saldo da Conta Cartão para auferir benefícios e descontos oriundos da rede credenciada da PRESTADORA. <br><br>
3.9 - À reserva-se ao direito de entrar em contato com o Investidor sobre pedidos de levantamento ou sobre outras operações, a m de executar verificações de segurança. <br><br>
3.10 - O INVESTIDOR entende e concorda que é de sua responsabilidade cumprir com quaisquer leis ou regulamentos relativos ao estabelecimento de uma conta de investimento e que quaisquer rendimentos retirados são sujeitos às leis do domicílio do PRESTADOR ou jurisdição legal. <br><br>
3.11 - O INVESTIDOR não possui nenhuma subordinação ou vinculo de qualquer natureza com a PRESTADORA ou outras empresas participantes do grupo a não ser a estabelecida por este contrato. <br><br>
3.12 A empresa se reserva ao direito de encerrar o contrato de investimento por sua livre e espontânea vontade, a qualquer tempo, garantindo o ressarcimento apenas quanto ao valor que foi investido pelo mesmo, ou seja, sem causar qualquer prejuízo ao investidor. <br><br>
<b>CLÁUSULA QUARTA: DOS RISCOS INERENTES AO INVESTIMENTO </b> <br><br>
4.1 – O INVESTIDOR tem consciência de que este é um investimento de risco e inadequado a alguns investidores. <br><br>
4.2 – O INVESTIDOR aceita os riscos associados ao presente investimento, porém este contrato pode não explicar todos os riscos nem a forma como esses riscos se relacionam às suas circunstâncias pessoais. Caso o INVESTIDOR tenha qualquer dúvida, deve procurar obter aconselhamento profissional. É importante que compreenda na integra os riscos antes de tomar uma decisão de investimento. <br><br>
4.3 – Todos os produtos negociados com margem possuem um grau de risco para o seu capital que pode resultar em perdas ou ganhos. O investimento descrito neste contrato não é adequado para todos os clientes e é projetado para clientes que são conhecedores e experientes no mercado de serviços financeiros e nos tipos de operações descritas no presente contrato. <br><br>
<b>CLÁUSULA QUINTA: DAS LIMITAÇÕES DE RESPONSABILIDADE </b> <br><br>
5.1 - A PRESTADORA não se responsabiliza por eventuais prejuízos decorrentes de atraso na transmissão dos fundos devido a causas fora de seu controle, caso fortuito ou de força maior. <br><br>
5.2 - A não se responsabiliza por quaisquer perdas ou danos que ocorrerem como resultado da força militar, intervenção política e às prescrições das autoridades nacionais ou estrangeiras ou eventos que ocorrerem como resultado de uma catástrofe ou força maior. <br><br>
<b>CLÁUSULA SEXTA: DAS DISPOSIÇÕES GERAIS </b> <br><br>
6.1 - O INVESTIDOR reserva o direito de notificar a administração do pedido de encerramento de sua conta a qualquer momento. Neste caso, a liquidação e remoção de todos os dados pessoais especificados no momento da inscrição ocorrem depois de terminada a identificação da personalidade dos requerentes e sua seleção para verificação se há conformidade com a personalidade da Pessoa Física ou agente autorizado que efetuou o registro da conta. <br><br>
6.2 - No caso de quaisquer atividades de fraude, as contas serão encerradas e os fundos serão congelados. <br><br>
6.3 - Este termo permanecerá válido e produzirá seus efeitos até que todas as operações do INVESTIDOR estejam liquidadas e mesmo depois de cumpridas todas obrigações vencidas ou vincendas. <br><br>
6.4 - Os direitos decorrentes deste contrato somente poderão ser cedidos ou transferidos com autorização expressa da PRESTADORA. <br><br>
6.5 - As partes concordam que este contrato contém a totalidade de seus entendimentos, perdendo a validade todos e quais outros entendimentos previamente acordados, sejam estes orais, escritos ou de que naturezas forem. <br><br>
6.6 - Este contrato foi redigido dentro dos princípios de boa-fé e probidade, sem nenhum vício de consentimento. As partes declaram para todos os efeitos legais que: <br><br>
a) as prestações, obrigações e riscos aqui assumidos estão dentro de suas condições econômicas/financeiras; <br><br>
b) estão habituadas a este tipo de operação; <br><br>
 c) este contrato espelha fielmente a tudo o que foi ajustado; <br><br>
 d) tiveram conhecimento prévio do conteúdo deste contrato e entenderam perfeitamente todas as obrigações e riscos nele contidos. <br><br>
6.7 - A PRESTADORA, ocasionalmente, poderá fornecer informações ao INVESTIDOR por meio de circulares, que serão disponibilizados através dos canais de atendimento. A PRESTADORA envidará os esforços necessários a fim de assegurar a precisão e a integralidade dessa informação, mas isso não deve ser interpretado como consultoria. Caso o INVESTIDOR tenha dúvidas em relação ao efeito ou consequência das informações deverá recorrer a PRESTADORA. <br><br>
6.8 - A PRESTADORA terá o direito de, sem aviso prévio, efetuar conversões cambiais que considerar necessária ou desejável ao cumprimento de suas obrigações ou para o exercício de seus direitos previstos neste contrato ou em qualquer transação. Qualquer conversão cambial será efetuada pela PRESTADORA nas cotações que determinar serem adequadas, considerando-se as cotações cambiais atuais. <br><br>
6.9 - Ocasionalmente a PRESTADORA poderá contatar o INVESTIDOR acerca da administração do investimento acaso entregue pelo INVESTIDOR nos termos deste Contrato, ou para oferecer-lhe outros serviços ou produtos financeiros nos quais possa ter interesse, em cursar ou aplicar. A PRESTADORA poderá contatar o INVESTIDOR por telefone, e-mail ou outros meios de comunicação, sendo que o INVESTIDOR consente esse contato. <br><br>
6.10 - O INVESTIDOR deverá avisar por escrito se não desejar ser comunicado sobre outros serviços ou cursos/produtos financeiros. <br><br>
6.11 - As informações que a mantiver sobre o INVESTIDOR são confidenciais e não serão usadas para qualquer outro objetivo que não esteja relacionado com a prestação dos serviços. Informações de natureza confidencial serão tratadas como tal, desde que essas informações não sejam de domínio público. <br><br>
6.12 - Este contrato compreende o acordo integral entre as partes em relação ao objeto deste, e cada uma das partes reconhece que não concordou com estes termos com base em qualquer declaração ou acordo, verbal ou por escrito, que não esteja expressamente incorporado a estes termos. <br><br>
6.13 - Se, a qualquer tempo, qualquer disposição deste contrato for ou se tornar ilegal, invalidada ou inaplicável, sob qualquer aspecto, nos termos da lei de qualquer jurisdição, a legalidade, validade ou aplicabilidade das disposições remanescentes desde contrato, ou a legalidade, validade ou aplicabilidade da disposição em questão, conforme a lei de qualquer outra jurisdição, não serão afetadas ou prejudicadas de qualquer forma. <br><br>
<b>CLÁUSULA SÉTIMA: DA IRREVOGABILIDADE</b> <br><br> 
7.1 - O presente termo é celebrado em caráter irrevogável e irretratável e obriga os interessados, bem como seus sucessores, herdeiros e legatários a qualquer título. <br><br>
 <b>CLÁUSULA OITAVA – DO INVESTIMENTO</b> <br><br> 
8.1 - O INVESTIDOR empenha o valor escolhido, aimportância que entrega na data de assinatura deste contrato, que se compromete a quitá-lo dentro das normas do pacote escolhido pelo INVESTIDOR. <br><br>
8.2 - Será devido pela o pagamento de juros remuneratórios em razão do empréstimo, que incidirão sobre o valor descrito na Cláusula anterior, na forma simples, no percentual do pacote por dia útil, durante a vigência do contrato. <br><br>
8.3 - O prazo de vigência do presente contrato é determinado com o pacote escolhido a contar da data de assinatura e sua prorrogação está sujeita a manifestação expressa das partes, com consentimento mútuo. <br><br>
8.4 - Fica facultada à saldar a dívida antes da data de seu vencimento, hipótese em que os encargos devidos serão calculados proporcionalmente (pró-rata). <br><br>
8.5 - Na hipótese do INVESTIDOR requerer a antecipação do pagamento do empréstimo e estando a de acordo com a antecipação, a PRESTADORA poderá reter 40% (quarenta por cento) do valor do contrato a título de indenização por perdas e danos e, em caso de instauração de procedimento judicial ou extrajudicial, ficando acordado que o INVESTIDOR arcará com honorários advocatícios na ordem de 30% sobre o valor total da dívida apurada e custas judiciais devidas. <br><br>
<b>CLÁUSULA NONA: DA RESPONSABILIDADE TRIBUTÁRIA </b> <br><br>
As partes arcarão com os impostos devidos na forma da legislação tributária. <br><br>
<b>CLÁUSULA DÉCIMA: DA SUCESSÃO</b> <br><br>
Pelo falecimento de qualquer uma das partes, não caberá desobrigação a qualquer título dos contratantes, obrigando-se a cumpri-lo por seus respectivos herdeiros e sucessores. <br><br>
<b>CLÁUSULA DÉCIMA PRIMEIRA: DA LIBERDADE CONTRATUAL</b> <br><br>
 As partes contratantes declaram expressamente que firmam o presente de acordo com a mais livre manifestação de suas vontades, vedando-se toda e qualquer arguição posterior relativa à validade de quaisquer das cláusulas ou condições aqui inscritas, sendo firmado em caráter irrevogável e irretratável, sem direito de arrependimento. <br><br>
<b>CLÁUSULA DÉCIMA SEGUNDA: DO FORO DA ARBITRAGEM </b> <br><br>
12.1 - Qualquer disputa ou controvérsia relativa à interpretação ou execução deste Contrato, ou de qualquer forma oriunda ou associada a ele, e que não seja dirimida amigavelmente entre as partes, deverá ser resolvida de forma definitiva por arbitragem. <br><br>
12.2 - O Tribunal Arbitral será constituído de 03 (três) árbitros, cabendo a cada uma das Partes a escolha de um árbitro. Os árbitros indicados pelas Partes deverão escolher em conjunto o terceiro árbitro, a quem caberá a Presidência do Tribunal Arbitral. Caso não haja acordo quanto à escolha do terceiro árbitro, este será escolhido na forma do Regulamento. <br><br>
12.3 - A sede da Arbitragem e da prolação da Sentença será a cidade de São Paulo. <br><br>
12.4 – As Partes concordam expressamente com a previsão do instituto da Arbitragem em caso de disputa ou controvérsia relativa à execução deste contrato, sendo assim ratificam o descrito nos itens 12.1, 12.2 e 12.3. <br><br>
<b>CLÁUSULA DÉCIMA TERCEIRA: DA RESOLUÇÃO DE CONFLITOS </b> <br><br>
13 – Fica expressa e irrevogavelmente avençado que a abstenção do exercício, por qualquer das partes, de direito ou faculdade que lhes assistam em razão do contrato, ou a tolerância com o atraso no cumprimento das obrigações, não implicará em novação. <br><br>
13.1 - As Partes elegem o Foro de para quaisquer medidas judiciais necessárias, incluindo a execução da Sentença Arbitral. A eventual propositura de medidas judiciais pelas Partes deverá ser imediatamente comunicada ao Tribunal Arbitral, caso já constituído, e não implica nem deverá ser interpretada como renúncia à Arbitragem, nem afetará a existência, validade e ecácia da Cláusula Arbitral, renunciando-se a qualquer outro, por mais privilegiado ou especial que seja. <br><br>
E por estarem justos e contratados, as partes assinam o presente instrumento particular<br><br>
</p>
      </div>
      <footer class="w3-container w3-black" style="border-radius:0 0 5px 5px">
        <p class="w3-padding-16 w3-center" onclick="document.getElementById('id01').style.display='none'"><i class="fa fa-times"></i> FECHAR</p>
      </footer>
      
    </div>
  </div>
</div>    


</body>
</html>

<?Php
}
}
?>