<!DOCTYPE html>
<html lang="pt">
<head>
<title>rsrsr</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="application/javascript" src="../js/mascara.js"></script>
<script type="application/javascript" src="../js/jquery.maskedinput.js"></script>

<script language="JavaScript">
    function protegercodigo() {
    if (event.button==2||event.button==3){
        alert('Desculpe! Acesso n達o Autorizado!');}
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
</head>

<body id="principal">

<div class="w3-container">

<?Php
$id                             = $_POST['id'];
$empresa                        = $_POST['empresa'];

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
<br><br>
<meta http-equiv="refresh" content="5; url=caucao_enviar.php?
id=<?Php echo $id; ?>&&
empresa=<?Php echo $empresa; ?>&&
nomeImovel=<?Php echo $nomeImovel; ?>&&
enderecoImovel=<?Php echo $enderecoImovel; ?>&&
valorEntrada=<?Php echo $valorEntrada; ?>&&
valorAluguel=<?Php echo $valorAluguel; ?>&&
valorCondominio=<?Php echo $valorCondominio; ?>&&
valorIptu=<?Php echo $valorIptu; ?>&&
descricaoImovel=<?Php echo $descricaoImovel; ?>&&
dataInicio=<?Php echo $dataInicio; ?>&&
dataFim=<?Php echo $dataFim; ?>&&
periodo=<?Php echo $periodo; ?>&&
nomeProprietario=<?Php echo $nomeProprietario; ?>&&
cpfProprietario=<?Php echo $cpfProprietario; ?>&&
rgProprietario=<?Php echo $rgProprietario; ?>&&
profissaoProprietario=<?Php echo $profissaoProprietario; ?>&&
estadocivilProprietario=<?Php echo $estadocivilProprietario; ?>&&
naturalidadeProprietario=<?Php echo $naturalidadeProprietario; ?>&&
nacionalidadeProprietario=<?Php echo $nacionalidadeProprietario; ?>&&
telefoneProprietario=<?Php echo $telefoneProprietario; ?>&&
celularProprietario=<?Php echo $celularProprietario; ?>&&
emailProprietario=<?Php echo $emailProprietario; ?>&&
enderecoProprietario=<?Php echo $enderecoProprietario; ?>&&
nomeLocatario=<?Php echo $nomeLocatario; ?>&&
cpfLocatario=<?Php echo $cpfLocatario; ?>&&
rgLocatario=<?Php echo $rgLocatario; ?>&&
profissaoLocatario=<?Php echo $profissaoLocatario; ?>&&
estadocivilLocatario=<?Php echo $estadocivilLocatario; ?>&&
naturalidadeLocatario=<?Php echo $naturalidadeLocatario; ?>&&
nacionalidadeLocatario=<?Php echo $nacionalidadeLocatario; ?>&&
telefoneLocatario=<?Php echo $telefoneLocatario; ?>&&
celularLocatario=<?Php echo $celularLocatario; ?>&&
emailLocatario=<?Php echo $emailLocatario; ?>&&
enderecoLocatario=<?Php echo $enderecoLocatario; ?>">

<center><div class="spinner-border text-success" style="font-size:40px; padding:100px; margin:auto"></div></center>
<h1 class="w3-xlarge w3-center">Aguarde... carregando.....</a>

</div>

</body>
</html>