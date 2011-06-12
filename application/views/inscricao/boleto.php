<?php 
switch($cd_tipo){
  case 'p':
    $valor = '180,00';
    $vencimento = '14/01/2010';
    break;
  case 's':
    $valor = '100,00';
    $vencimento = '14/01/2010';
    break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
	<meta http-equiv="content-language" content="pt-BR" />
	<meta http-equiv="cache-control" content="no-cache,no-store" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta name="description" content="Portal da Comunidade Católica Shalom, pagamento do Acamps." />
	<title>Boleto: Pagamento do Acamps - Comunidade Cat&oacute;lica Shalom</title>
	<link rel="Shortcut Icon" href="http://www.comshalom.org/favicon.ico" type="image/x-icon" />
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
	color: #000;
	background-color: #fff;
}
p {
	margin: 0;
	font-family: Arial, Helvetica, sans-serif;
}
table{
  border-collapse: collapse;
}
.borda, .borda td {	border: #888 solid 1px; }
.borda td { padding: 0 4px; }
</style>
</head>

<body>
<table width="640" border="0" cellspacing="0" cellpadding="1" style="border: #000 solid 1px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%" valign="bottom"><img src="<?php echo assets_url('image') ?>logo_boleto.jpg" alt="Shalom/PJJ" width="102" height="30" /></td>
        <td width="62%" valign="bottom" style="text-align: center; font-weight: bold; font-size: 16px;">Comunidade Cat&oacute;lica Shalom<span style="text-align: center"></span></td>
        <td width="22%" valign="bottom" style="text-align: right; font-weight: bold; font-size: 16px;">Recibo do Sacado</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="borda">
      <tr>
        <td colspan="3" rowspan="2" align="left"><p><span style="font-size: 10px">Cedente</span><br />
            <span style="font-size: 12px; font-weight: bold;">Comunidade Cat&oacute;lica Shalom</span></p></td>
        <td width="19%" valign="middle" style="font-size: 10px">Vencimento</td>
      </tr>
      <tr>
        <td align="right" style="font-size: 12px; font-weight: bold;"><?php echo $vencimento ?></td>
      </tr>
      <tr>
        <td width="44%" rowspan="2" align="left"><p><span style="font-size: 10px">Sacado</span><br />
            <span style="font-size: 12px; font-weight: bold;"><?php echo $nm_pessoa ?></span></td>
        <td width="20%" rowspan="2" align="center"><p><span style="font-size: 10px">N&uacute;mero do Documento</span><br />
            <span style="font-size: 12px; font-weight: bold;"><?php echo $id_pessoa ?></span></td>
        <td width="17%" rowspan="2" align="center"><p><span style="font-size: 10px">Data do Documento</span><br />
            <span style="font-size: 12px; font-weight: bold;"><?php echo date("d/m/Y"); ?></span></td>
        <td align="left" style="font-size: 10px">Valor do Documento</td>
      </tr>
      <tr>
        <td align="right" style="font-size: 12px; font-weight: bold;">R$ <?php echo $valor ?></td>
      </tr>
      <tr>
        <td colspan="4">
			<p><span style="font-size: 11px">Pagamento de Inscri&ccedil;&atilde;o do Acamp's<?php echo isset($nm_servico)? ' - '.$nm_servico : '' ; ?></span><br />
			<span style="font-size: 10px">===============================================================<br />
			* Este boleto somente vale para pagamento no estande do Acamp's do Centro de Evangeliza&ccedil;&atilde;o da Paz<br />
			* Endere&ccedil;o:<br />
			Rua Maria Tom&aacute;sia, 72, Aldeota, Fortaleza - telefone: 85-3268-9366 e 85-8690-1014<br />
			<?php //Rua Dom Sebasti&atilde;o Leme, 808, F&aacute;tima, Fortaleza - telefone: 3452-6141<br /> ?>
			===============================================================</span></p>
		</td>
      </tr>
    </table></td>
  </tr>
  
  
  
  <tr>
    <td><img src="<?php echo assets_url('image')?>tesoura.gif" alt="---------" width='640'  style="margin:10px 0;" /></td>
  </tr>

  
  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%" valign="bottom"><img src="<?php echo assets_url('image') ?>logo_boleto.jpg" alt="Shalom/PJJ" width="102" height="30" /></td>
        <td width="79%" valign="bottom" style="text-align: center; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">Comunidade Cat&oacute;lica Shalom<span style="text-align: center"> - Projeto Juventude para Jesus</span></td>
        <td width="5%" valign="bottom" style="text-align: right; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="borda">
      <tr>
        <td colspan="3" rowspan="2"><p><span style="font-size: 10px">Cedente</span><br />
          <span style="font-size: 12px; font-weight: bold;">Comunidade Cat&oacute;lica Shalom</span></p></td>
        <td width="21%" valign="middle" style="font-size: 10px">Vencimento</td>
        </tr>
      <tr>
        <td align="right" style="font-size: 12px; font-weight: bold;"><?php echo $vencimento ?></td>
        </tr>
      <tr>
        <td width="18%" rowspan="2" align="center"><p><span style="font-size: 10px">Data do Documento</span><br />
          <span style="font-size: 12px; font-weight: bold;"><?php echo date("d/m/Y"); ?></span></p></td>
        <td width="21%" rowspan="2" align="center">
			<p><span style="font-size: 10px">N&uacute;mero do Documento</span><br />
			<span style="font-size: 9px;"><span style="font-size: 12px; font-weight: bold;"><?php echo $id_pessoa ?></span></span></p>
		</td>
        <td width="40%" rowspan="2"><p>&nbsp;</p></td>
        <td align="left" style="font-size: 10px">Valor do Documento</td>
        </tr>
      <tr>
        <td align="right" style="font-size: 12px; font-weight: bold;">R$ <?php echo $valor ?></td>
        </tr>
      <tr>
        <td colspan="4">
			<p><span style="font-size: 11px">Pagamento de Inscri&ccedil;&atilde;o do Acamp's<?php echo isset($nm_servico)? ' - '.$nm_servico : '' ; ?></span><br />
			<span style="font-size: 10px">===============================================================<br />
			* Este boleto somente vale para pagamento no estande do Acamp's do Centro de Evangeliza&ccedil;&atilde;o da Paz<br />
			* Endere&ccedil;o:<br />
			Rua Maria Tom&aacute;sia, 72, Aldeota, Fortaleza - telefone: 85-3268-9366 e 85-8690-1014<br />
			<?php //Rua Dom Sebasti&atilde;o Leme, 808, F&aacute;tima, Fortaleza - telefone: 3452-6141<br /> ?>
			===============================================================</span></p>
		</td>
      <tr>
        <td colspan="2">
          <p style="font-size: 10px;">Sacado:<br/>
          <span style="font-size: 12px; font-weight: bold;"><?php echo $nm_pessoa ?></span><br />
          <span style="font-size: 12px; font-weight: bold;"><?php echo $ds_endereco ?></span><br />
          <span style="font-size: 12px; font-weight: bold;"><?php echo $ds_bairro ?></span></p></td>
        <td colspan="2" align="right" valign="bottom" style="font-weight: bold; font-size: 16px;">Ficha de Compensa&ccedil;&atilde;o</td>
        </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td><img src="<?php echo assets_url('image')?>tesoura.gif" alt="---------" width='640'  style="margin:10px 0;" /></td>
  </tr>
  
  
  
  <tr>
    <td height="32" align="center" style="font-size: 14px; font-weight: bold;">Termo de Responsabilidade</td>
  </tr>
  <tr>
    <td style="padding: 0 28px;"><p style="font-size: 12px; text-align: justify;">Eu, _______________________________________ estou ciente e em acordo com as normas de funcionamento do ACAMPAMENTO DE JOVENS SHALOM e por meio desta, declaro comprometer-me e cumpri-las.</p>
    <p style="font-size: 12px; text-align: right;"><br />
      ___________________________________<br />
      Assinatura do Participante</p><br/>
    <p style="font-size: 12px; text-align: justify;">Eu, _______________________________________ estou ciente da estrutura e das normas internas do ACAMPAMENTO DE JOVENS SHALOM e autorizo esta inscri&ccedil;&atilde;o.</p>
    <p style="font-size: 12px; text-align: right;"><br />
      ___________________________________<br />
    Assinatura do Pai ou Respons&aacute;vel</p><br/>
    <p style="font-size: 12px; text-align: right;">Fortaleza, ____ de _______________ de 2010</p>
    <br /></td>
  </tr>

  
  
</table>
</body>
</html>