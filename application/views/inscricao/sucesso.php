<div id="sucesso">
<h2>Inscrição realizada com sucesso!</h2>
<?php if(isset($ds_foto)): ?>
    <img src="<?php echo $ds_foto ?>" alt="foto" title="<?php echo $nm_cracha ?>" />
<?php endif; ?>

<p><?php echo $nm_pessoa ?><br/>
Número de Inscrição: <span class="highlight success"><?php echo $id_pessoa ?></span></p>

<p class="alert-message"><strong>IMPORTANTE - Guarde o número de sua inscrição!</strong></p>

<?php if($cd_tipo != 'v'): ?>
	<p>Você receberá um e-mail confirmando sua inscrição. Este e-mail contém seu número de inscrição e o link para você imprimir o Boleto de Pagamento, caso não possa imprimir agora.</p>
	
	<p>O boleto deve ser pago no Estande do Acamp's, no Shalom da Paz, Rua Maria Tomásia, nº 72, Aldeota, Fortaleza.</p>
	
	<p class="alert-message block-message info">Quando for pagar sua inscrição é necessário que você leve um documento com foto.<br/>
	Ex: <em>Documento de Identidade</em>, <em>Carteira de Estudante</em></p>
	
	<p class="center"><a class="btn primary large" target="_blank" href="<?php echo site_url('/inscricao/boleto/').'/'.md5($id_pessoa.$ds_email) ?>">Imprimir Boleto</a></p>
<?php endif; ?>

</div>