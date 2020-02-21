<?php
require "../../../../../config/config.php";  
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'saques_associado_acessomundi_bank.xls';
		$id = $_GET['id'];
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="8" align="center"><b>Relatório de Saques Pendente - Solicitante '.$id.'</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>Conta</b></td>';
		$html .= '<td><b>Nome Associado</b></td>';
		$html .= '<td><b>CPF/CNPJ</b></td>';
		$html .= '<td><b>Modo de Recebimento</b></td>';
		$html .= '<td><b>Valor</b></td>';
		$html .= '<td><b>Data de Solicitação</b></td>';
		$html .= '<td><b>Hora da Solicitação</b></td>';
		$html .= '<td><b>Data Prevista para Repasse</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela
		
		function somar_data($data, $dias, $meses, $ano){
                $data = explode("/", $data);
                $resData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
                return $resData;
            }
            
		$resultado_msg_contatos = mysql_query("SELECT * FROM sps_extrato WHERE extrato_status_saque='Pendente' AND extrato_afiliado_id='$id' ORDER BY extrato_id ASC");
		
		while($row_msg_contatos = mysql_fetch_array($resultado_msg_contatos)){
		       
		        $dia = $row_msg_contatos['extrato_dia'];
                $mes = $row_msg_contatos['extrato_mes'];
                $ano = $row_msg_contatos['extrato_ano'];     
                    
                $idAssociado = $row_msg_contatos['extrato_afiliado_id'];
                $sqlAssociado = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idAssociado'");
                $verAssociado = mysql_fetch_array($sqlAssociado);
                
                if($verAssociado['afiliado_conta_modo'] == "Fisica"){
                    $nomeCompleto = $verAssociado['afiliado_nome'];
                    $documento = $verAssociado['afiliado_cpf'];
                }elseif($verAssociado['afiliado_conta_modo'] == "Juridica"){
                    $nomeCompleto = $verAssociado['afiliado_razao'];
                    $documento = $verAssociado['afiliado_cnpj'];
                }
                
            
            
            $idBanco = $verAssociado['afiliado_banco'];
		    $sqlbanco = mysql_query("SELECT * FROM sps_bancos WHERE banco_codigo='$idBanco'");
	    	$verbanco = mysql_fetch_array($sqlbanco);
            
            if($row_msg_contatos['extrato_modo_saque'] == "Transferência Bancária" ){
                $vencimento = somar_data("$dia/$mes/$ano", 10, 0, 0);
                $modoSaque = " <b>Banco: </b> ".$verbanco['banco_nome']." (".$idBanco.") - CONTA ".$verAssociado['afiliado_tipoconta']." &nbsp;&nbsp;&nbsp;&nbsp;
                <b>Agência:</b> ".$verAssociado['afiliado_agencia']."&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Conta:</b> ".$verAssociado['afiliado_conta']."";
            }elseif($row_msg_contatos['extrato_modo_saque'] == "Zencard" ){
                $vencimento = somar_data("$dia/$mes/$ano", 5, 0, 0);
                $modoSaque = "<b>ZENCARD: </b> ".$verAssociado['afiliado_zencard']."";
            }
                    
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos['extrato_afiliado_id'].'</td>';
			$html .= '<td>'.$nomeCompleto.'</td>';
			$html .= '<td>'.$documento.'</td>';
			$html .= '<td>'.$modoSaque.'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['extrato_valor'],2,",",".").'</td>';
			$html .= '<td>'.$dia.'/'.$mes.'/'.$ano.'</td>';
			$html .= '<td>'.$row_msg_contatos['extrato_hora'].'</td>';
			$html .= '<td>'.$vencimento.'</td>';
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