<?php
require "../../../../../config/config.php";
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'investteam_internetbank.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="18" style="color:#fff;" align="center" bgcolor="black"><b>Todos os Investidores</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Contrato</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Conta</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Investidor</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Bairro</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Cidade</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Estado</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Telefone</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Celular</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>E-mail</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Pacote</b></td>';
		$html .= '<td colspan="7" bgcolor="YELLOW"><b>Aplicação(R$)</b></td>';
		$html .= '<td rowspan="2" bgcolor="YELLOW"><b>Empresa</b></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td bgcolor="YELLOW"><b>Bruto</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Taxa</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Líquido</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Rendimento Dia</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Data Início</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Data Vendimento</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>Status</b></td>';
		$html .= '</tr>';
		
		
		//Selecionar todos os itens da tabela
		
		$resultado_msg_contatos = mysql_query("SELECT * FROM sps_excent ORDER BY excent_id DESC");
		
		while($row_msg_contatos = mysql_fetch_array($resultado_msg_contatos)){
		            
                    
                $idAssociado = $row_msg_contatos['excent_afiliado_id'];
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
                
                $idInvestimento = $row_msg_contatos['excent_plano'];
                $sqlPlano = mysql_query("SELECT * FROM sps_planos_investimentos WHERE invest_id='$idInvestimento'");
                $verPlano = mysql_fetch_array($sqlPlano);
                
                $produto = strtoupper($verPlano['invest_nome'])."<br>".number_format($verPlano['invest_rendimento']*100, 2, ',', '.')."% a.d. / ".number_format(($verPlano['invest_rendimento']*100)*20, 2, ',', '.')."% a.m.";
                
                
                $idEmpresa = $row_msg_contatos['excent_empresa'];
                $sqlEmpresa = mysql_query("SELECT * FROM sps_afiliados WHERE afiliado_id='$idEmpresa'");
                $verEmpresa = mysql_fetch_array($sqlEmpresa);
                
                if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
                    $nomeEmpresa = strtoupper($verEmpresa['afiliado_nome']);
                }elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
                    $nomeEmpresa = strtoupper($verEmpresa['afiliado_razao']);
                }
                
                $EmpresaInvestidor = $idEmpresa." - ".$nomeEmpresa;
            
                    
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos['excent_id'].'</td>';
			$html .= '<td>'.$row_msg_contatos['excent_afiliado_id'].'-'.$verAssociado["afiliado_codigo_verificador"].'</td>';
			$html .= '<td>'.$nomeCompleto.'</td>';
			$html .= '<td>'.$verAssociado["afiliado_bairro"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_cidade"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_estado"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_telefone"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_celular"].'</td>';
			$html .= '<td>'.$verAssociado["afiliado_email"].'</td>';
			$html .= '<td>'.$produto.'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['excent_valor_bruto'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['excent_taxa_adm'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['excent_valor_liquido'],2,",",".").'</td>';
			$html .= '<td>'.number_format($row_msg_contatos['excent_valor_residual'],2,",",".").'</td>';
			$html .= '<td>'.$row_msg_contatos['excent_data_iniciar'].'</td>';
			$html .= '<td>'.$row_msg_contatos['excent_data_resgate'].'</td>';
		    $html .= '<td>'.$row_msg_contatos['excent_status'].'</td>';
		    $html .= '<td>'.$EmpresaInvestidor.'</td>';
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