<?php
require '../../../../../config/config.php';
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'pagamento_contas.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="8" align="center"><b>Relatório de Pagamentos de Contas Pendentes</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>Boleto</b></td>';
		$html .= '<td><b>Conta</b></td>';
		$html .= '<td><b>Nome Associado</b></td>';
		$html .= '<td><b>Código de Barras</b></td>';
		$html .= '<td><b>Tipo</b></td>';
		$html .= '<td><b>Descrição</b></td>';
		$html .= '<td><b>Vencimento</b></td>';
		$html .= '<td><b>Valor</b></td>';
		$html .= '</tr>';
		
                
		//Selecionar todos os itens da tabela
		
            
		$resultado_msg_contatos = mysqli_query($conexao, "SELECT * FROM sps_pagamentos WHERE pag_status='Pendente' ORDER BY pag_id DESC");
		
		while($row_msg_contatos = mysqli_fetch_array($resultado_msg_contatos)){
		          
                    
                $idAssociado = $row_msg_contatos['pag_afiliado_id'];
                $sqlAssociado = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysqli_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $nomeCompleto = $verAssociado['afiliado_nome'];
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $nomeCompleto = $verAssociado['afiliado_razao'];
                }
                
            
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos['pag_id'].'</td>';
			$html .= '<td>'.$row_msg_contatos['pag_afiliado_id'].'</td>';
			$html .= '<td>'.$nomeCompleto.'</td>';
			$html .= '<td>'.$row_msg_contatos['pag_codigo'].'</td>';
			$html .= '<td>'.$row_msg_contatos['pag_tipo'].'</td>';
			$html .= '<td>'.$row_msg_contatos['pag_descricao'].'</td>';
			$html .= '<td>'.$row_msg_contatos['pag_vencimento'].'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['pag_valor'],2,",",".").'</td>';
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