<?php
require "../../../config/config.php";
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'investimundi_contrato_acessomundi_bank.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="16" align="center"><b>Relatório Investmundi - Todos os Investidores</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>Contrato</b></td>';
		$html .= '<td><b>Conta</b></td>';
		$html .= '<td><b>Investidor</b></td>';
		$html .= '<td><b>Bairro</b></td>';
		$html .= '<td><b>Cidade</b></td>';
		$html .= '<td><b>Estado</b></td>';
		$html .= '<td><b>Telefone</b></td>';
		$html .= '<td><b>Celular</b></td>';
		$html .= '<td><b>E-mail</b></td>';
		$html .= '<td><b>Investimento</b></td>';
		$html .= '<td><b>% diário Investidor</b></td>';
		$html .= '<td><b>R$ Valor Investidor</b></td>';
		$html .= '<td><b>Correspondente</b></td>';
		$html .= '<td><b>% diário Correspondente</b></td>';
		$html .= '<td><b>R$ Valor Correspondente</b></td>';
		$html .= '<td><b>Status</b></td>';
		$html .= '</tr>';
		
		
		//Selecionar todos os itens da tabela
		
		$contrato = $_GET['id'];
		$resultado_msg_contatos = mysql_query("SELECT * FROM sps_rendimento WHERE rendimento_id='$contrato' ORDER BY rendimento_id DESC");
		
		while($row_msg_contatos = mysql_fetch_array($resultado_msg_contatos)){
		            
                    
                $idAssociado = $row_msg_contatos['rendimento_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $nomeCompleto = $verAssociado['afiliado_nome'];
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $nomeCompleto = $verAssociado['afiliado_razao'];
                }
                
                $idAssociado1 = $verAssociado['afiliado_indicador'];
                $sqlAssociado1 = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado1'");
                $verAssociado1 = mysql_fetch_array($sqlAssociado1);
                
                if($verAssociado1['afiliado_conta_modo'] == "Fisica"){
                    $correspondente = $idAssociado1.' - '.$verAssociado1['afiliado_nome'];
                }elseif($verAssociado1['afiliado_conta_modo'] == "Juridica"){
                    $correspondente = $idAssociado1.' - '.$verAssociado1['afiliado_razao'];
                }
                    
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos['rendimento_id'].'</td>';
			$html .= '<td>'.$row_msg_contatos['rendimento_afiliado_id'].'</td>';
			$html .= '<td>'.$nomeCompleto.'</td>';
			$html .= '<td>'.$verAssociado["afiliado_bairro"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_cidade"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_estado"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_telefone"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_celular"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_email"].'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_investimento'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_residual_afiliado_id'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_valor'],2,",",".").'</td>';
			$html .= '<td>'.$correspondente.'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_residual_correspondente_id'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_valor_correspondente'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['rendimento_status'],2,",",".").'</td>';
			$html .= '</tr>';
			;
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