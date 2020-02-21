<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Conta <?Php echo $id." - ".$nome; ?></title>
<link rel="icon" href="../img/favicon.png">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  


<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso não Autorizado!');}
    }
    document.onmousedown=protegercodigo
</script>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<body id="principal">

<?Php
$id                             = $_GET['id'];
$empresa                        = $_GET['empresa'];

$nomeImovel                     = $_POST['nomeImovel'];
$enderecoImovel                 = $_POST['enderecoImovel'];
$valorEntrada                   = $_POST['valorEntrada'];
$valorAluguel                   = $_POST['valorAluguel'];
$valorCondominio                = $_POST['valorCondominio'];
$valorIptu                      = $_POST['valorIptu'];
$descricaoImovel                = $_POST['descricaoImovel'];
$dataInicio                     = $_POST['dataInicio'];
$dataFim                        = $_POST['dataFim'];
$periodo                        = $_POST['periodo'];

$nomeProprietario               = $_POST['nomeProprietario'];
$cpfProprietario                = $_POST['cpfProprietario'];
$rgProprietario                 = $_POST['rgProprietario'];
$profissaoProprietario          = $_POST['profissaoProprietario'];
$estadocivilProprietario        = $_POST['estadocivilProprietario'];
$naturalidadeProprietario       = $_POST['naturalidadeProprietario'];
$nacionalidadeProprietario      = $_POST['nacionalidadeProprietario'];
$telefoneProprietario           = $_POST['telefoneProprietario'];
$celularProprietario            = $_POST['celularProprietario'];
$emailProprietario              = $_POST['emailProprietario'];
$enderecoProprietario           = $_POST['enderecoProprietario'];

$nomeLocatario                  = $_POST['nomeLocatario'];
$cpfLocatario                   = $_POST['cpfLocatario'];
$rgLocatario                    = $_POST['rgLocatario'];
$profissaoLocatario             = $_POST['profissaoLocatario'];
$estadocivilLocatario           = $_POST['estadocivilLocatario'];
$naturalidadeLocatario          = $_POST['naturalidadeLocatario'];
$nacionalidadeLocatario         = $_POST['nacionalidadeLocatario'];
$telefoneLocatario              = $_POST['telefoneLocatario'];
$celularLocatario               = $_POST['celularLocatario'];
$emailLocatario                 = $_POST['emailLocatario'];
$enderecoLocatario              = $_POST['enderecoLocatario'];
?>

<b>1. DADOS DO IMÓVEL</b>
<div class="w3-container w3-light-gray w3-padding w3-round" style="margin-top:5px; margin-bottom:5px;">
    <b>Nome do Imóvel: </b> <?Php echo $nomeImovel; ?><br>
    <b>Endereço: </b> <?Php echo $enderecoImovel; ?><br>
    <b>Descrição do Imóvel: </b> <?Php echo $descricaoImovel; ?><br>
    <b>Valor Entrada/Caução: </b> <?Php echo $valorEntrada; ?>&nbsp;&nbsp;
    <b>Valor Aluguel: <?Php echo $valorAluguel; ?></b> &nbsp;&nbsp;
    <b>Valor Condomínio: </b> <?Php echo $valorCondominio; ?>&nbsp;&nbsp;
    <b>Valor IPTU: </b> <?Php echo $valorIptu; ?><br>
    <b>Data Início Contrato: </b> <?Php echo $dataInicio; ?>&nbsp;&nbsp;
    <b>Data Fim Contrato: </b> <?Php echo $dataFim; ?>&nbsp;&nbsp;
    <b>Período: </b> <?Php echo $periodo; ?> meses
</div>

<b>2. DADOS DO PROPRIETÁRIO</b>
<div class="w3-container w3-light-gray w3-padding w3-round" style="margin-top:5px; margin-bottom:5px;">
    <b>Nome Completo: </b> <?Php echo $nomeProprietario; ?>&nbsp;&nbsp;
    <b>CPF: </b> <?Php echo $cpfProprietario; ?>&nbsp;&nbsp;
    <b>RG: </b> <?Php echo $rgProprietario; ?><br>
    <b>Endereço: </b> <?Php echo $enderecoProprietario; ?><br>
    <b>Profissão: </b> <?Php echo $profissaoProprietario; ?>&nbsp;&nbsp;
    <b>Estado Civil:</b> <?Php echo $estadocivilProprietario; ?>&nbsp;&nbsp;
    <b>Naturalidade: </b> <?Php echo $naturalidadeProprietario; ?>&nbsp;&nbsp;
    <b>Nacionalidade: </b> <?Php echo $nacionalidadeProprietario; ?><br>
    <b>Telefone: </b> <?Php echo $telefoneProprietario; ?>&nbsp;&nbsp;
    <b>Celular: </b> <?Php echo $celularProprietario; ?>&nbsp;&nbsp;
    <b>E-mail: </b> <?Php echo $emailProprietario; ?><br>
</div>

<b>3. DADOS DO LOCATÁRIO</b>
<div class="w3-container w3-light-gray w3-padding w3-round" style="margin-top:5px; margin-bottom:5px;">
    <b>Nome Completo: </b> <?Php echo $nomeLocatario; ?>&nbsp;&nbsp;
    <b>CPF: </b> <?Php echo $cpfLocatario; ?>&nbsp;&nbsp;
    <b>RG: </b> <?Php echo $rgLocatario; ?><br>
    <b>Endereço: </b> <?Php echo $enderecoLocatario; ?><br>
    <b>Profissão: </b> <?Php echo $profissaoLocatario; ?>&nbsp;&nbsp;
    <b>Estado Civil:</b> <?Php echo $estadocivilLocatario; ?>&nbsp;&nbsp;
    <b>Naturalidade: </b> <?Php echo $naturalidadeLocatario; ?>&nbsp;&nbsp;
    <b>Nacionalidade: </b> <?Php echo $nacionalidadeLocatario; ?><br>
    <b>Telefone: </b> <?Php echo $telefoneLocatario; ?>&nbsp;&nbsp;
    <b>Celular: </b> <?Php echo $celularLocatario; ?>&nbsp;&nbsp;
    <b>E-mail: </b> <?Php echo $emailLocatario; ?><br>
</div><br>

<center><b>Os dados acima estão corretos?</b></center>

<form name="form" action="caucao_carregar.php" method="post">
    <input type="hidden" name="id" value="<?Php echo $id; ?>">
    <input type="hidden" name="empresa" value="<?Php echo $empresa; ?>">
    
    <input type="hidden" name="nomeImovel" value="<?Php echo $nomeImovel; ?>">
    <input type="hidden" name="enderecoImovel" value="<?Php echo $enderecoImovel; ?>">
    <input type="hidden" name="descricaoImovel" value="<?Php echo $descricaoImovel; ?>">
    <input type="hidden" name="valorEntrada" value="<?Php echo $valorEntrada; ?>">
    <input type="hidden" name="valorAluguel" value="<?Php echo $valorAluguel; ?>">
    <input type="hidden" name="valorCondominio" value="<?Php echo $valorCondominio; ?>">
    <input type="hidden" name="valorIptu" value="<?Php echo $valorIptu; ?>">
    <input type="hidden" name="dataInicio" value="<?Php echo $dataInicio; ?>">
    <input type="hidden" name="dataFim" value="<?Php echo $dataFim; ?>">
    <input type="hidden" name="periodo" value="<?Php echo $periodo; ?>">
    
    <input type="hidden" name="nomeLocatario" value="<?Php echo $nomeLocatario; ?>">
    <input type="hidden" name="cpfLocatario" value="<?Php echo $cpfLocatario; ?>">
    <input type="hidden" name="rgLocatario" value="<?Php echo $rgLocatario; ?>">
    <input type="hidden" name="enderecoLocatario" value="<?Php echo $enderecoLocatario; ?>">
    <input type="hidden" name="profissaoLocatario" value="<?Php echo $profissaoLocatario; ?>">
    <input type="hidden" name="estadocivilLocatario" value="<?Php echo $estadocivilLocatario; ?>">
    <input type="hidden" name="naturalidadeLocatario" value="<?Php echo $naturalidadeLocatario; ?>">
    <input type="hidden" name="nacionalidadeLocatario" value="<?Php echo $nacionalidadeLocatario; ?>">
    <input type="hidden" name="telefoneLocatario" value="<?Php echo $telefoneLocatario; ?>">
    <input type="hidden" name="celularLocatario" value="<?Php echo $celularLocatario; ?>">
    <input type="hidden" name="emailLocatario" value="<?Php echo $emailLocatario; ?>">
    
    <input type="hidden" name="nomeProprietario" value="<?Php echo $nomeProprietario; ?>">
    <input type="hidden" name="cpfProprietario" value="<?Php echo $cpfProprietario; ?>">
    <input type="hidden" name="rgProprietario" value="<?Php echo $rgProprietario; ?>">
    <input type="hidden" name="enderecoProprietario" value="<?Php echo $enderecoProprietario; ?>">
    <input type="hidden" name="profissaoProprietario" value="<?Php echo $profissaoProprietario; ?>">
    <input type="hidden" name="estadocivilProprietario" value="<?Php echo $estadocivilProprietario; ?>">
    <input type="hidden" name="naturalidadeProprietario" value="<?Php echo $naturalidadeProprietario; ?>">
    <input type="hidden" name="nacionalidadeProprietario" value="<?Php echo $nacionalidadeProprietario; ?>">
    <input type="hidden" name="telefoneProprietario" value="<?Php echo $telefoneProprietario; ?>">
    <input type="hidden" name="celularProprietario" value="<?Php echo $celularProprietario; ?>">
    <input type="hidden" name="emailProprietario" value="<?Php echo $emailProprietario; ?>">
    
<div class="w3-container" style="margin-top:10px;">
    <div class="w3-half w3-center"><a href="caucao2.php?id=<?Php echo $id; ?>&&empresa=<?Php echo $empresa; ?>"><button style="width:99%; margin-bottom:5px;" type="button" class="w3-input w3-padding-16 w3-round-large w3-red w3-text-white">Não, Preencher Novamente</button></a></div>
    <div class="w3-half w3-left"><button style="width:99%; margin-bottom:5px;" type="submit" class="w3-input w3-padding-16 w3-round-large w3-teal">Sim, Gerar Contrato</button></div>
</div>
    
</form>

</body>
</html>