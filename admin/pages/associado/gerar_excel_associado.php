<?php
require "../../../config/config.php";
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'Meus_Clientes_Cadastrados.xls';
		
		$empresa = $_GET['emp'];
		
		$sql = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$empresa'");
		$ver = mysqli_fetch_array($sql);
		    if($ver['afiliado_conta_modo'] == "Fisica"){
		        $nome = $ver['afiliado_nome'];
		    }if($ver['afiliado_conta_modo'] == "Juridica"){
		        $nome = $ver['afiliado_razao'];
		    }
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="34" style="color:#fff;" align="center" bgcolor="black"><b>ASSOCIADOS DA EMPRESA '.$empresa.'-'.$ver['afiliado_codigo'].' / '.$nome.'</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td bgcolor="YELLOW"><b>CONTA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>TIPO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>STATUS</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>RAZÃO SOCIAL</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>FANTASIA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CNPJ</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>INSC EST / DOCUMENTAÇÃO EMPRESA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>ABERTURA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>NOME COMPLETO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CPF OU DOCUMENTO PESSOAL OU PASSAPORTE</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>RG</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>DATA NASCIMENTO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>SEXO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>TELEFONE</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CELULAR</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>WHATSAPP</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>SKYPE</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>E-MAIL</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>BANCO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>TIPO DE CONTA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>AGÊNCIA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CONTA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>IBAN</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>SWIFT BANK</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>ENDEREÇO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>BAIRRO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CIDADE OU PROVÍNCIA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>ESTADO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CEP OU ZIP CODE</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>PAÍS</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>DATA DE CADASTRO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>IP</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CONEXÃO</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CORRETOR</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$resultado_msg_contatos = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_status='Ativo' AND afiliado_empresa='$empresa' ORDER BY afiliado_id ASC");
		
		while($row_msg_contatos = mysqli_fetch_array($resultado_msg_contatos)){
		    
		    $corretor = $row_msg_contatos['afiliado_indicador'];
		    $sqlCorretor = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$corretor'");
		    $verCorretor = mysqli_fetch_array($sqlCorretor);
		    
		    if($verCorretor['afiliado_conta_modo'] == "Fisica"){
		        $nomeCorretor = $verCorretor['afiliado_nome'];
		    }if($verCorretor['afiliado_conta_modo'] == "Juridica"){
		        $nomeCorretor = $verCorretor['afiliado_razao'];
		    }
		    
		    $codigo = $row_msg_contatos['afiliado_banco'];
		    $sqlBanco = mysqli_query($conexao, "SELECT * FROM sps_bancos WHERE banco_id='$codigo'");
		    $verBanco = mysqli_fetch_array($sqlBanco);
		        $idBanco = $verBanco['banco_codigo'];
		        $nomeBanco = $verBanco['banco_nome'];
		
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos['afiliado_id'].'-'.$row_msg_contatos['afiliado_codigo'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_conta_modo'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_status'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_razao'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_fantasia'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_cnpj'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_insc'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_data_abertura'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_nome'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_cpf'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_rg'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_nascimento'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_sexo'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_telefone'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_celular'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_whatsapp'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_skype'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_email'].'</td>';
			$html .= '<td>'.$idBanco.' - '.$nomeBanco.'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_tipo_conta'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_agencia'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_conta'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_iban'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_swift'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_endereco'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_bairro'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_cidade'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_estado'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_cep'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_nacao'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_data_cadastro'].' às '.$row_msg_contatos['afiliado_hora_cadastro'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_ip'].'</td>';
			$html .= '<td>'.$row_msg_contatos['afiliado_conexao'].'</td>';
			$html .= '<td>'.$corretor.'-'.$verCorretor['afiliado_codigo'].' / '.$nomeCorretor.'</td>';
			$html .= '</tr>';
			
		}
		
		//Selecionar todos os itens da tabela 
		$resultado_msg_contatos2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_status!='Ativo' AND afiliado_estabelecimento='$empresa' ORDER BY afiliado_id ASC");
		
		while($row_msg_contatos2 = mysqli_fetch_array($resultado_msg_contatos2)){
		    
		    $corretor2 = $row_msg_contatos2['afiliado_indicador'];
		    $sqlCorretor2 = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$corretor2'");
		    $verCorretor2 = mysqli_fetch_array($sqlCorretor2);
		    
		    if($verCorretor2['afiliado_conta_modo'] == "Fisica"){
		        $nomeCorretor2 = $verCorretor2['afiliado_nome'];
		    }if($verCorretor2['afiliado_conta_modo'] == "Juridica"){
		        $nomeCorretor2 = $verCorretor2['afiliado_razao'];
		    }
		
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_id'].'-'.$row_msg_contatos2['afiliado_codigo_verificador'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_conta_modo'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_status'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_razao'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_fantasia'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_cnpj'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_insc'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_data_abertura'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_nome'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_cpf'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_rg'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_nascimento'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_sexo'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_telefone'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_celular'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_email'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_endereco'].', '.$row_msg_contatos2['afiliado_numero'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_complemento'].'- '.$row_msg_contatos2['afiliado_bairro'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_cidade'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_estado'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_nacao'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_data_cadastro'].' às '.$row_msg_contatos2['afiliado_hora_cadastro'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_ip'].'</td>';
			$html .= '<td>'.$row_msg_contatos2['afiliado_conexao'].'</td>';
			$html .= '<td>'.$corretor2.'-'.$verCorretor2['afiliado_codigo_verificador'].' / '.$nomeCorretor2.'</td>';
			$html .= '</tr>';
			
		}
		
		
		$html .= '</table>';
		// Configurações header para forçar o download
		header ("Expires: Lun, 01 Jan 2018 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>