<div id="sucesso">
<h2>Inscrição realizada com sucesso!</h2>
<?php if(isset($ds_foto)): ?>
    <img id="foto" src="<?php echo $ds_foto ?>" alt="foto" title="<?php echo $nm_cracha ?>" />
<?php endif; ?>
<p style="font-size:1.3em;line-height:40px;padding: 10px 0">
 <?php echo $nm_cracha ?><br/>Número de Inscrição: <span class="destaque3"><?php echo $id_pessoa ?></span></p>
<p class="aviso"><strong>IMPORTANTE - Guarde o número de sua inscrição!</strong></p>
<br/>
<?php if($cd_tipo != 'v'): ?>
<p>Você receberá um e-mail confirmando sua inscrição. Este e-mail contém seu número de inscrição
e o link para você imprimir o Boleto de Pagamento, caso queira imprimir depois.</p><br/>
<br/>
<p class="info">Quando for pagar sua inscrição é necessário que você leve um documento com foto.<br/>
Exemplos: <em>Documento de Identidade</em>, <em>Carteira de Estudante</em></p>
<br/>
<p class="center" style="font-size:1.1em">Pagar via Boleto no Shalom da Paz, Rua Maria Tomásia, nº 72, Aldeota, Fortaleza:</p>
<p class="center"><a class="button" style="display: inline-block;margin: 20px 0 0" class="botao" target="_blank" href="<?php echo site_url('/inscricao/boleto/').'/'.md5($id_pessoa.$ds_email) ?>">Imprimir Boleto</a></p>
<?php endif; ?>
</div>