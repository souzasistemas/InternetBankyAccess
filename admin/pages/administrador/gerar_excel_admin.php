<?php
require "../../../config/config.php";
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'administradores_internetbanky_access_empresa.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5" align="center" bgcolor="#000" color="#fff"><b>ADMINISTRADORES INTERNET BANKY ACCESS EMPRESA</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td bgcolor="YELLOW"><b>NOME</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>CONTA EMPRESA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>NOME EMPRESA</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>STATUS</b></td>';
		$html .= '<td bgcolor="YELLOW"><b>NÍVEL PERMISSÃO</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela
		$emp = $_GET['id'];
		$resultado_msg_contatos = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_empresa='$emp'");
		
		while($row_msg_contatos = mysqli_fetch_array($resultado_msg_contatos)){
		    
		    $idPermissao = $row_msg_contatos['admin_permissao'];
		    
		if($idPermissao == "0"){
			$permissao = "Acesso Geral";
		}elseif($idPermissao == "1"){
			$permissao = "Administrativo";
		}elseif($idPermissao == "2"){
			$permissao = "Financeiro";
		}
		
		 
            
            $sqlEmpresa = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$emp'");
            $verEmpresa = mysqli_fetch_array($sqlEmpresa);
                
                if($verEmpresa['afiliado_conta_modo'] == "Fisica"){
	                $nomeLoja = $verEmpresa['afiliado_nome'];
	            }elseif($verEmpresa['afiliado_conta_modo'] == "Juridica"){
	                $nomeLoja = $verEmpresa['afiliado_razao'];
	            }
	            $codigo = $verEmpresa['afiliado_codigo_verificador'];
	            
	            $empresa2 = "$idEmpresa-$codigo";
            
		
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos["admin_nome"].'</td>';
			$html .= '<td>'.$emp.'-'.$verEmpresa['afiliado_codigo'].'</td>';
			$html .= '<td>'.$nomeLoja.'</td>';
			$html .= '<td>'.$row_msg_contatos["admin_status"].'</td>';
			$html .= '<td>'.$permissao.'</td>';
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