<?Php
session_start();

$id = $_GET['id'];
$empresa = $_GET['empresa'];
$contrato = $_GET['contrato'];

if($id == ""){
    echo "<script>location.href='../index.htm';alert('Acesso não Autorizado!');</script>";
}else{

require "../config/config.php";

$sql = mysqli_query($conexao, "SELECT * FROM sps_caucao WHERE caucao_contrato='$contrato'");
$ver = mysqli_fetch_array($sql);

$sqlCorretor = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$id'");
$verCorretor = mysqli_fetch_array($sqlCorretor);

if($verCorretor['afiliado_conta_modo'] == "Fisica"){
    $nomeAfiliado = $verCorretor['afiliado_nome'];
    $documento1 = "<b>CPF:</b> ".$verCorretor['afiliado_cpf']."";
    $documento2 = "<b>RG:</b> ".$verCorretor['afiliado_rg']."";
}elseif($verCorretor['afiliado_conta_modo'] == "Juridica"){
    $nomeAfiliado = $verCorretor['afiliado_fantasia'];
    $documento1 = "<b>CNPJ:</b> ".$verCorretor['afiliado_cnpj']."";
    $documento2 = "<b>INSCRIÇÃO EST/MUN:</b> ".$verCorretor['afiliado_insc']."";
}
 
$variavel = $ver['caucao_tempo_locacao'];
$caracteres = strlen($variavel);
$numero;
$dezena;
$centena;
$milhar;
$milhoes;
$bilhoes;
// CONDIÇÕES PARA NUMERO POR EXTENSO
$indnumero=$caracteres - 1 ;
$numero = $variavel[$indnumero];
switch($numero){
case 1 : $exnumero = 'Um'; break;
case 2 : $exnumero = 'Dois'; break;
case 3 : $exnumero = 'Três'; break;
case 4 : $exnumero = 'Quatro'; break;
case 5 : $exnumero = 'Cinco'; break;
case 6 : $exnumero = 'Seis'; break;
case 7 : $exnumero = 'Sete'; break;
case 8 : $exnumero = 'Oito'; break;
case 9 : $exnumero = 'Nove'; break;
default : $exnumero = ' ';
}
// CONDIÇÕES PARA DEZENA POR EXTENSO
$indnumero=$caracteres - 2 ;
$dezena = $variavel[$indnumero];
if($dezena == 1){
	$exnumero = "";
	
	switch($numero){
case 1 : $exdezena = 'Onze'; break;
case 2 : $exdezena = 'Doze'; break;
case 3 : $exdezena = 'Treze'; break;
case 4 : $exdezena = 'Quatorze'; break;
case 5 : $exdezena = 'Quinze'; break;
case 6 : $exdezena = 'Dezesseis'; break;
case 7 : $exdezena = 'Dezessete'; break;
case 8 : $exdezena = 'Dezoito'; break;
case 9 : $exdezena = 'Noventa'; break;
default : $exdezena = 'Dez';
	}
}else{
	switch($dezena){
case 1 : $exdezena = ' '; break;
case 2 : $exdezena = 'Vinte'; break;
case 3 : $exdezena = 'Trinta'; break;
case 4 : $exdezena = 'Quarenta'; break;
case 5 : $exdezena = 'Cinquenta'; break;
case 6 : $exdezena = 'Sessenta'; break;
case 7 : $exdezena = 'Setenta'; break;
case 8 : $exdezena = 'Oitenta'; break;
case 9 : $exdezena = 'Noventa'; break;
default : $exdezena = ' ';
}
}
$indnumero=$caracteres - 3 ;
$centena = $variavel[$indnumero];
// CONDIÇÕES PARA CENTENA POR EXTENSO
if((($centena == 1) and ($dezena == 0) and ($numero ==0))){
	$excentena = "Cem";
}else{
	switch($centena){
case 1 : $excentena = 'Cento'; break;
case 2 : $excentena = 'Duzentos'; break;
case 3 : $excentena = 'Trezento'; break;
case 4 : $excentena = 'Quatrocentos'; break;
case 5 : $excentena = 'Quinhentos'; break;
case 6 : $excentena = 'Seiscentos'; break;
case 7 : $excentena = 'Setecentos'; break;
case 8 : $excentena = 'Oitocentos'; break;
case 9 : $excentena = 'Novecentos'; break;
default : $excentena = ' ';
	}
}
// CONDIÇÕES PARA MILHAR POR EXTENSO
$indnumero=$caracteres - 4 ;
$milhar = $variavel[$indnumero];
	switch($milhar){
case 1 : $exmilhar = 'Mil'; break;
case 2 : $exmilhar = 'Dois Mil'; break;
case 3 : $exmilhar = 'Três Mil'; break;
case 4 : $exmilhar = 'Quatro Mil'; break;
case 5 : $exmilhar = 'Cinco Mil'; break;
case 6 : $exmilhar = 'Seis Mil'; break;
case 7 : $exmilhar = 'Sete Mil'; break;
case 8 : $exmilhar = 'Oito Mil'; break;
case 9 : $exmilhar = 'Nove Mil'; break;
default : $exmilhar = ' ';
	}
// CONDIÇÕES PARA APLICAÇÃO DO 'E' POR EXTENSO
$separacao;
$separacao2;
$separacao3;
if(($dezena > 1) and ($numero > 0)){
	$separacao = " e ";
}
if(($variavel > 100) and(($exdezena != " ") or ($exnumero != " "))){
	$separacao2 = " e ";
}
if($excentena != " "){
	$separacao3 = " e ";
}


$extenso = "$exmilhar $separacao3 $excentena $separacao2 $exdezena $separacao $exnumero";
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

@media print { 
    #noprint { display:none; } 
}
</style>
</head>

<body onload="self.print();">

<div id="noprint" class="container w3-round"><br><center><button class="w3-teal w3-input w3-padding-8" onClick="window.print()">IMPRIMIR</button></center></div><br><br>

<div class="container w3-border w3-black w3-border-black w3-padding" style="margin-top:10px;">
<table class="w3-table">
    <tr>
        <td class="w3-white" style="width:130px;"><img src="../img/logo/amountcard.png" width="100px;"></td>
        <td class="w3-text-white" style="padding:20px; text-align:right;">LOCAÇÃO - VENDAS – ADMINISTRAÇÃO - CAUÇÃO</td>
        </tr>
</table>    
</div>



<div class="container" style="text-align:justify; font-size:12px;">
<br><b>CONTRATO Nº: </b>&nbsp;<?Php echo $contrato; ?> &nbsp;&nbsp; 
<b>CORRETOR: </b>&nbsp;<span class="w3-text-gray"><?Php echo $id; ?> - <?Php echo $nomeAfiliado; ?> - <?Php echo $verCorretor['afiliado_telefone']." / ".$verCorretor['afiliado_celular']." - ".$verCorretor['afiliado_email']; ?></span>
<br><br><b>IMÓVEL: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;"><?Php echo $ver['caucao_imovel']; ?>, localizado na <?Php echo $ver['caucao_endereco']; ?> com as seguintes características: <?Php echo $ver['caucao_descricao']; ?></span>
<br><br><b>PROPRIETÁRIO: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;"><?Php echo $ver['caucao_proprietario']; ?>, <?Php echo $ver['caucao_proprietario_nacional']; ?>, <?Php echo $ver['caucao_proprietario_estado_civil']; ?>, <?Php echo $ver['caucao_proprietario_profissao']; ?>, natural do <?Php echo $ver['caucao_proprietario_natural']; ?>, portadora da RG nº <?Php echo $ver['caucao_proprietario_rg']; ?>, inscrita no CPF/MF sob nº <?Php echo $ver['caucao_proprietario_cpf']; ?>, residente e domiciliada na <?Php echo $ver['caucao_proprietario_endereco']; ?> e com seu código de registro gerado com o nº <?Php echo $ver['caucao_proprietario_afiliado_id']; ?></span>
<br><br><b>LOCATÁRIO: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;"><?Php echo $ver['caucao_locatario']; ?>, <?Php echo $ver['caucao_locatario_nacional']; ?>, <?Php echo $ver['caucao_locatario_estado_civil']; ?>, <?Php echo $ver['caucao_locatario_profissao']; ?>, natural do <?Php echo $ver['caucao_locatario_natural']; ?>, portadora da RG nº <?Php echo $ver['caucao_locatario_rg']; ?>, inscrita no CPF/MF sob nº <?Php echo $ver['caucao_locatario_cpf']; ?>, residente e domiciliada na <?Php echo $ver['caucao_locatario_endereco']; ?> e com seu código de registro gerado com o nº <?Php echo $ver['caucao_locatario_afiliado_id']; ?></span>

<br><br><b>VALOR CAUÇÃO: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;">R$ <?Php echo $ver['caucao_valor_entrada']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

<b>VALOR ALUGUEL: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;">R$ <?Php echo $ver['caucao_valor_aluguel']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

<b>VALOR CONDOMÍNIO: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;">R$ <?Php echo $ver['caucao_valor_condominio']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

<b>VALOR IPTU: </b>&nbsp;<span class="w3-text-gray" style="text-transform:uppercase;">R$ <?Php echo $ver['caucao_valor_iptu']; ?></span>

<br><br><b>PRAZO DE LOCAÇÃO: </b>&nbsp;<span class="w3-text-gray">O prazo de locação será de <?Php echo $variavel; ?> (<?Php echo $extenso; ?>) meses, a começar no dia <?Php echo $ver['caucao_inicio_contrato']; ?>, e a terminar no dia <?Php echo $ver['caucao_fim_contrato']; ?>. Findo este prazo o locatário entregará o imóvel livre e desocupado de pessoas e coisas e no estado em que o recebeu.</span>

<br><br><b>VALOR DO ALUGUEL: </b> <span class="w3-text-gray">Conforme descrito acima,os valores mais os encartgos, será reajustado ANUALMENTE de acordo com a variação do IGPM/FGV, ou na extinção deste, terá como incidência o maior índice governamental vigente nos meses previstos, caso a periodicidade prevista pôr lei seja inferior ao anual, o reajuste será inferior.Se o aluguel não for pago até a data do vencimento, isto é, até o dia 10 (dez) de cada mês sofrerá uma multa de 10% (dez por cento) do aluguel e após o mês do vencimento terá juros de mora de 1%(um por cento) e correção monetária de acordo com a Lei do inquilinato n.º 8.245/91. O aluguel deverá ser pago somente através de Boleto Bancário emitido por Amount Card Administradora de Cartões de Crédito Ltda, e/ou na falta deste deverá ser pago na Administradora.</span> 

<br><br><b>UTILIZAÇÃO DO IMÓVEL: </b><span class="w3-text-gray">O imóvel ora locado será utilizado para fins residenciais, não podendo ser mudada a sua destinação sem o consentimento por escrito do locador, obrigando-se os locatários a usarem o imóvel deste contrato exclusivamente para moradia do locatário titular.

<BR><BR>Os signatários deste instrumento, devidamente qualificados, tem entre si, justo e contratados o presente contrato  de locação nos termos da Lei 8.245/91, e o disposto no Código Civil Brasileiro, mediante as clausulas e condições abaixo estipuladas:</span><br><br>

 
<legend class="w3-center w3-border-black">CLÁUSULAS CONTRATUAIS</legend>

    <b>PRIMEIRA:</b><span class="w3-text-gray"> O caução imobiliário contratado pelo <b>LOCADOR</b> junto a <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b>,  cuja  vigência  será  a data de protocolo da proposta e a vigencia final será a data do termino do contrato de locação ou a data do próximo reajuste do aluguel, seguida de renovações anuais obrigatórias, garantirá esta locação, nos termos do inciso III, do artigo 37 da Lei do Inquilinato, mediante pagamento de prêmio, ressalvadas as exceções previstas nas condições gerais. São de conhecimento do <b>LOCADOR e LOCATÁRIO(s)</b> as Condições Gerais do Caução Imobiliário. Para efeito desta garantia, os prêmios iniciais e renovações anuais do caução imobiliário, calculados conforme NORMAS VIGENTES, deverão ser pagos pelo <b>LOCATÁRIO</b>, de acordo com o inciso XI, do artigo 23 da lei do inquilinato, sob pena de rescisão desta locação, com o consequente despejo e cancelamento do contrato. O Contrato garantirá exclusivamente as cobertura especificadas na proposta de seguro: <b>ALUGUEL e MULTA (por rescisão contratual), CONDOMÍNIO, LUZ, IPTU, DANOS AO IMÓVEL E PINTURA INTERNA</b>. Eventuais débitos decorrentes do presente contrato, não pagos  pelos  Locatários  após regularmente instados a tanto serão  comunicados as entidades mantenedoras de  bancos de dados de  proteção ao crédito <b>(SERASA, SPC, etc)</b>, quer pelos Locadores quer  pela <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b>. Tais débitos incluem todas as despesas com as medidas judiciais cabíveis. Para exercer os direitos e dar cumprimento as obrigações deste contrato, os Locatários declaram-se solidários entre si, e constituem-se reciprocamente PROCURADORES, conferindo-se mutuamente poderes especiais para receber citações, notificações e intimações, confessar, desistir e assinar, tudo quanto se tornar necessário, transigir em Juízo ou fora dele, fazer acordos, firmar compromisos judiciais ou extrajudiciais, receber e dar quitação.<br><br>                                                                                                                                                                 
Na ocorrência de inadimplência garantida pelo caução imobiliário, o <b>LOCADOR</b> autoriza o <b>CORRETOR AUTORIZADO</b>, a receber e dar quitação para os valores apurados e indenizados pela <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b> <br>
Na qualidade de garantidora da locação e pelo exercício antecipado do direito de sub-rogação, por conta dos adiantamentos mensais da indenização ao Segurado/Locador, a <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b> poderá providenciar à ação de despejo, isentando o Segurado/Locador da franquia prevista nas condições gerais do seguro, salvo para cobertura de danos ao imóvel.</span>

<b>SEGUNDA:</b><span class="w3-text-gray"> O LOCATÁRIO declara para todos os fins e efeitos de direito, que recebe o imóvel locado no estado em que se encontra de conservação e uso, identificado no <b>LAUDO DE VISTORIA INICIAL</b> o qual é parte integrante deste contrato, assinado por todos os contratantes, obrigando-se e comprometendo-se a devolvê-lo nesse estado, independentemente de qualquer aviso ou notificação prévia, e qualquer que seja o motivo de devolução, sob pena de incorrer nas cominações previstas neste contrato ou estipuladas em lei, além da obrigação de indenizar por danos ou prejuizos decorrentes da inobservância dessa obrigação, salvo as deteriorações do uso normal do imóvel.</span><br><br>

<b>TERCEIRA:</b><span class="w3-text-gray"> <b>DECLARA O LOCATÁRIO</b> para todos os fins e efeitos de direito, que recebe o imóvel locado com <b>PINTURA INTERNA NOVA</b>, e assim obriga-se ao final da locação, a pintá-lo e devolve-lo no mesmo estado que recebeu, sob pena de incorrer nas cominações previstas neste contrato ou estipuladas em lei. O Locatário declara ainda estar ciente de que, não devolvendo o imóvel pintado internamente, a <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b> indenizará o Locador pelo ônus da pintura, e terá direito de reaver o valor que tiver sido pago.<br> 
O <b>Locatário</b> deverá comunicar o Sinistro a <b>AMOUNT CARD ADMINISTRADORA DE CARTÕES DE CRÉDITO LTDA</b> no prazo máximo de 15 (quinze) dias a contar da desocupação do imóvel.<br> 
O Locador declara para os devidos fins e efeitos, que até a data de assinatura desse instrumento, não há sinistro a reclamar quanto as coberturas garantidas pelo Caução Imobiliário. A declaração é prestada sob as penas previstas em lei, artigos 766 e 768 do Código Civil. </span><br><br>

<b>QUARTA:</b><span class="w3-text-gray"> O não pagamento do aluguel constituirá o locatário em mora, podendo a cobrança ser efetuada através de advogados, onde, além das multas, serão cobrados honorários advocatícios ou simplesmente será movida a competente ação de despejo por falta de pagamento independentemente de qualquer aviso.</span><br><br>

<b>QUINTA:</b><span class="w3-text-gray">  <b>SUBLOCAÇÃO</b> - Não é permitida ao locatário a sublocação do imóvel no todo ou em parte, cede-lo a terceiros, seja a título gratuito ou oneroso, transferir o contrato ou da destinação diversa do uso ou finalidade prevista neste instrumento, sem o prévio consentimento por escrito do locador.</span><br><br>

<b>SEXTA:</b><span class="w3-text-gray">  <b>BENFEITORIAS:</b> As benfeitorias que, por ventura sejam realizadas no imóvel pelo locatário, durante o curso da locação, quer sejam necessárias, úteis ou voluptuarias, se incorporam ao imóvel e rescindida a locação, reverterão em beneficio do locador, sem que por elas, tenha o locatário direito a qualquer reembolso, indenização ou pagamento. A introdução de tais benfeitorias, dependerá da autorização por escrito do locador.</span> <br><br>

<b>SÉTIMA:</b><span class="w3-text-gray">  <b>CONSERVAÇÃO DO IMÓVEL:</b> O locatário declara que, neste ato recebe o imóvel em perfeito estado de conservação, limpeza e de acordo com o  <b>LAUDO DE VISTORIA/FOTOS</b>  que faz parte integrante deste instrumento, devendo ser comunicado por escrito ao locador dentro de <b>30 (trinta) dias</b>, a contar da assinatura deste contrato, prováveis irregularidades. A falta dessa comunicação importará reconhecimento da inexistência de qualquer falha ou defeito e assume obrigação de:<br>
a) manter o imóvel locado em perfeito estado de conservação e higiene, bem como todas as instalações e serventias em perfeito estado de funcionamento restituindo-as quando findo ou rescindido este contrato, tal como o recebeu, sem o menor dano ou falta, inclusive  fechaduras, trincos, chaves, vidros,  torneiras, pintura nova na cor branca no teto e nas paredes, instalações elétricas, hidráulicas, esgotos, telhados, aparelhos sanitários e quaisquer outras pertencentes ao imóvel.<br>
b) Não modificar a estrutura e divisões do imóvel, salvo mediante prévio consentimento por escrito do locador ou seu representante legal, sob pena de rescisão contratual ser-lhe exigido a reposição em seu estado anterior.<br>
c) Autorizar o locador ou seu representante legal a vistoriar o imóvel quando julgar conveniente.<br>
Satisfazer a sua própria custa, todas as exigências dos poderes públicos sem direito a qualquer indenização pelas obras que executar as quais ficarão desde logo incorporadas ao imóvel.<br>
d) O <b>LOCATÁRIO</b> se obriga da obedecer e respeitar o Regulamento Interno estabelecido na Conveção Condominial, sob pena de não o fazendo ficar sujeito às sanções previstas na Convenção, bem como as previstas na legislação Civil, além de ocasionar a rescisão contratual do presente instrumento com a cominação da multa prevista na cláusula 10a. (decima) com a conseqüente decretação do despejo. <br>
e) O LOCATÁRIO declara que recebe o imóvel com pintura látex, na cor e estado (interna/externa) conforme o LAUDO DE VISTORIA/FOTOS, obrigando-se à devolvê-lo com pintura, da mesma forma que o recebe, inclusive as esquadrias metálicas, portas, e janelas na mesma cor.</span><br><br>

<b>OITAVA:</b><span class="w3-text-gray">  <b>DESPESA:</b> Durante o período de locação será de inteira responsabilidade do locatário todas as incidências tributarias, <b>IMPOSTO de IPTU, TAXAS, CONDOMÍNIO e demais encargos que recaírem sobre o imóvel</b>, bem como as despesas de luz , gás e água, CAUÇÃO IMOBILIÁRIO do imóvel, contra incêndio que o locador poderá fazer, se julgar necessário, em companhia a sua escolha, durante o prazo de locação, mediante a apresentação dos documentos comprobatórios de conformidade com a avaliação feita pela firma seguradora, sempre de acordo com o locador, assim como será de sua inteira responsabilidade o pagamento de eventual acréscimo da taxa em virtude da ocupação que o locatário der ao imóvel, constituindo mera liberalidade do locador insuspeitável de novar as condições ora convencionadas, a cobrança destas obrigações por qualquer outra forma.<br>
<b>Parágrafo primeiro:</b> O locatário será responsável pelas despesas e multas decorrentes de eventuais retenção dos avisos de impostos, taxas, condomínios e outros que já incidem ou venham a incidir sobre o imóvel objeto da  presente locação.<br>
<b>Parágrafo segundo:</b> Os recibos referentes aos demais encargos que recaiam sobre o imóvel devera ser apresentados devidamente quitados pelo locatário à requerente administradora ou proprietária por ocasião do pagamento do aluguel correspondente ao mês, fazendo parte integrante do mesmo, sua falta acarretará a recusa ao recebimento dos aluguéis por parte do locador ou seu representante legal, ate o cumprimento de tais pagamentos, sob pena de ação de despejo por falta de pagamento.<br>
<b>Parágrafo terceiro:</b> Obriga-se o locatário a transferir para seu nome, todas os <b>FORNECEDORES DE ENERGIA, GÁS, TELEFONIA E OUTROS</b> e levar ao conhecimento da administradora, para provar que realmente o fez e, desde já é de pleno conhecimento do locatário que a entrega de chaves ficará vinculada ao cumprimento desta. Fica terminantemente proibida a transferência de titularidade para o nome de terceiros.<br>
<b>Parágrafo quarto:</b> Se os encargos previstos nesta clausula forem cobrados em um mesmo lançamento, a parte que couber ao locatário será calculada proporcionalmente a parte ou unidade do imóvel que lhe é locado, obedecendo  ao  critério da área que possuir o objeto ou seu valor locativo.</span><br><br>

<b>NONA:</b><span class="w3-text-gray">  <b>DESAPROPRIAÇÃO:</b> Em caso de desapropriação que impeça a utilização do imóvel, o presente contrato ficara rescindido de pleno direito, não havendo multa ou outra penalidade para qualquer das partes. <br>
<b>Parágrafo único:</b> Ressalvada ao locador, tão somente, a faculdade de haver do poder desapropriante a indenização que por ventura tiver direito.</span><br><br>

<b>DÉCIMA:</b><span class="w3-text-gray">  <b>MULTA:</b> Fica estipulada a multa de 03 (três) alugueis vigente a época da infração, na qual incorrera a parte que infringir qualquer das clausulas deste contrato, ressalvada a parte inocente o direito de poder considerar rescindida a locação.<br>
<b>Parágrafo primeiro:</b> A multa será paga sempre integralmente, seja qual  for o prazo já decorrido do presente contrato, ficando claro que o pagamento dessa multa, não exime o pagamento dos alugueis atrasados, além  das despesas inerente ao caso.<br>                                                                                                                          <b>Parágrafo segundo:</b> Somente no caso de rescisão unilateral por parte da locatária (denúncia), a presente multa de 03 (três) aluguéis será cobrada proporcionalmente ao tempo restante, não cumprido do contrato.</span><br><br>

<b>DÉCIMA-PRIMEIRA:</b><span class="w3-text-gray">  <b>RECUO E DANOS:</b> O recuo de frente, bem como as passagens existentes servirão apenas de estacionamento para carros de passeio, ficando vedado a entrada ou estacionamento de qualquer outro tipo de veiculo que venha  sobrecarregar o piso existente.<br>
<b>Parágrafo único:</b> O locatário é responsável por si e por eventuais freqüentadores, caso venha ocorrer qualquer tipo de dano.</span><br><br>

<b>DÉCIMA-SEGUNDA:</b><span class="w3-text-gray"> <b>PODERES PÚBLICOS:</b> O locatário se obriga a responder, por conta exclusiva a todas e quaisquer exigências dos Poderes Públicos relativa  as atividades que for exercer no local, especialmente no concernente a  fiscalização e higiene do trabalho e sanitária.</span><br><br>

<b>DÉCIMA-TERCEIRA:</b><span class="w3-text-gray"> <b>CONTINUIDADE DA LOCAÇÃO:</b> O locatário se obriga, caso tenha interesse em continuar no imóvel, findo o prazo contratual, a dar conhecimento dessa resolução, por escrito, ao locador ou seu representante  legal, com antecedência mínima de 30 (trinta) dias, sob pena de pagar-lhe um aluguel da época, cobrável na forma da lei. Entretanto a referida disposição não implicará em renovação do presente contrato.</span><br><br>

<b>DÉCIMA-QUARTA:</b><span class="w3-text-gray"> <b>DA VENDA:</b> No caso de ser o imóvel posto a venda, o locatário  desde já autoriza a visita de interessados em horários a serem fixados.</span><br><br>

<b>DÉCIMA-QUINTA:</b><span class="w3-text-gray"> <b>ENTREGA DAS CHAVES:</b> É facultado ao locador recusar recebimento das chaves sem que esteja o imóvel em perfeitas condições, conforme vistoria feita por ocasião do inicio da locação.<br>
<b>Parágrafo único:</b> Caso o imóvel não esteja em perfeitas condições, o Locatário continuará pagando os alugueis e demais encargos do imóvel até que seja sanado tal irregularidade.</span><br><br>

<b>DÉCIMA-SEXTA:</b><span class="w3-text-gray"> <b>AÇÃO COMPETENTE:</b> Tudo quanto for devido em razão deste contrato e não comportar ação de despejo por falta de pagamento, será exigido em ação competente, ficando a cargo dos devedores, em  qualquer caso, os honorários do advogado que o credor constituir para ressalva dos seus direitos. Os honorários   advocaticios ficam arbitrados em <b>20% (vinte por cento)</b>.</span><br><br> 

<b>DÉCIMA-SÉTIMA:</b><span class="w3-text-gray"> <b>RESCISÃO DO CONTRATO:</b> O presente contrato considerar-se-a rescindido, independente de qualquer formalidade judicial ou extrajudicial,  nos seguintes casos: desapropriação, incêndio ou desabamento e força maior. Se ocorrer incêndio a responsabilidade pela indenização dos prejuízos  causados e mais perdas e danos, será do locatário, desde que seja constatada sua responsabilidade.<br>
<b>Parágrafo único:</b> Nenhuma intimação dos serviços públicos será  motivo para o locatário abandonar o imóvel ou pedir rescisão deste instrumento, salvo caso de vistoria judicial que apure esta a construção ameaçando ruir.</span><br><br>

<b>DÉCIMA-OITAVA:</b><span class="w3-text-gray"> <b>DA POSSE:</b> Fica desde já o locador autorizado a emitir-se na posse do imóvel independentemente de ação, sem qualquer formalidade e sem prejuízo das demais clausulas e cominações legais do imóvel objeto do presente contrato caso venha a ser abandonado pelo locatário, estando esse em mora com os alugueis.</span><br><br>                                                                                                                                             
<b>DÉCIMA-NONA:</b><span class="w3-text-gray"> O locatário declara expressamente que lido atentamente as clausulas expressas e dactilografadas neste contrato, principalmente as condições  e obrigações estipuladas, estão de pleno acordo em todos os seus termos.</span><br><br>

<b>VIGÉSIMA:</b><span class="w3-text-gray"> <b>OBRIGAÇÕES:</b> Será lícito ao locador deixar de receber os aluguéis, caso haja qualquer outra obrigação de pagamento por parte do locatário em atraso.</span><br><br>

<b>VIGÉSIMA-PRIMEIRA:</b><span class="w3-text-gray"> As hipóteses não previstas neste instrumento serão regidas pelas leis nacionais aplicáveis na época.<br><br>

E, por estarem assim justos e contratados, assinam este instrumento particular em 03 (tres) vias de igual teor e forma, ante duas testemunhas, para que produza os efeitos legais.</span><br><br>

<div class="w3-center">
    <?Php
    date_default_timezone_set('Brazil/East');
$horario = date('H:i:s');
$dataCadastro = date('d/m/Y');
?>
São Paulo, <?Php echo $dataCadastro; ?><br><br><br><br><br><br>




______________________________________________________________________________________<br>
<b>LOCATÁRIO:</b> <?Php echo $ver['caucao_locatario']; ?><br>
<b>CPF:</b> <?Php echo $ver['caucao_locatario_cpf']; ?><br>
<b>RG:</b> <?Php echo $ver['caucao_locatario_rg']; ?><br><br><br><br><br><br>



______________________________________________________________________________________<br>
<b>LOCADOR:</b> <?Php echo $ver['caucao_proprietario']; ?> (<b>CPF:</b> <?Php echo $ver['caucao_proprietario_cpf']; ?> e <b>RG:</b> <?Php echo $ver['caucao_proprietario_rg']; ?>)<br>
<b>REPRESENTADO PELO CORRETOR:</b> 
<?Php echo $nomeAfiliado; ?><br>
<?Php echo $documento1; ?> e <?Php echo $documento2; ?>
</div>



</div>






</body>
</html>

<?Php
}
?>