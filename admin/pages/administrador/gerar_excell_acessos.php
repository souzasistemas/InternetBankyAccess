<?php
require "../../../config/config.php";

$id = $_GET['id'];
$empresa = $_GET['empresa'];
$sql = mysqli_query($conexao, "SELECT * FROM sps_admin WHERE admin_id='$id'");
$ver = mysqli_fetch_array($sql);
    $nome = $ver['admin_nome'];

$sqlAcesso = mysqli_query($conexao, "SELECT * FROM sps_afiliados WHERE afiliado_id='$empresa'");
$verAcesso = mysqli_fetch_array($sqlAcesso);

                if($verAcesso['afiliado_conta_modo'] == "Fisica"){
	                $nomeLoja = $verAcesso['afiliado_nome'];
	            }elseif($verAcesso['afiliado_conta_modo'] == "Juridica"){
	                $nomeLoja = $verAcesso['afiliado_razao'];
	            }

		// Definimos o nome do arquivo que será exportado
		$arquivo = 'Acessos Administrativos por Usuarios.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '<meta charset="utf-8">';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="6" align="center" bgcolor="yellow"><b>Acessos Registrados</b></tr>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td colspan="6" align="left" bgcolor="black">&nbsp;</tr>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td colspan="6" align="left"><b>Usuário: </b>'.$nome.'</tr>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td colspan="6" align="left"><b>Empresa: </b>'.$empresa.'-'.$verAcesso['afiliado_codigo'].' / '.$nomeLoja.'</tr>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td colspan="6" align="left" bgcolor="black">&nbsp;</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td bgcolor="orange"><b>Registro</b></td>';
		$html .= '<td bgcolor="orange"><b>Data</b></td>';
		$html .= '<td bgcolor="orange"><b>Hora</b></td>';
		$html .= '<td bgcolor="orange"><b>IP</b></td>';
		$html .= '<td bgcolor="orange"><b>Conexão</b></td>';
		$html .= '<td bgcolor="orange"><b>Descrição</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela
		
		$resultado_msg_contatos = mysqli_query($conexao, "SELECT * FROM sps_admin_logs WHERE acesso_admin_login='$nome'");
		
		while($row_msg_contatos = mysqli_fetch_array($resultado_msg_contatos)){
		 
		
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_id"].'</td>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_data"].'</td>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_hora"].'</td>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_ip"].'</td>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_conexao"].'</td>';
			$html .= '<td>'.$row_msg_contatos["acesso_admin_mensagem"].'</td>';
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