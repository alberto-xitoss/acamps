<div class="container">
	<div id="header" class="clearfix">
		<img class="logo" src="<?php echo $this->config->item('img_url') ?>logo_boleto.jpg" alt="Shalom/PJJ" width="202" height="50" />
		<img class="acamps" src="<?php echo $this->config->item('img_url') ?>acamps_boleto.jpg" alt="Acamp's" width="149" height="40" />
		<p class="title" align="center">Acampamento de Jovens Shalom</p>
		<p class="title" align="center">Comprovante de Inscrição</p>
	</div>
	<div>
		<table>
			<tbody>
				<tr>
					<td class="span1">
						<p class="small">Inscrição</p>
						<p align="center"><?php echo $dados['id_pessoa'] ?></p>
					</td>
					<td>
						<p class="small">Nome</p>
						<p><?php echo $dados['nm_pessoa'] ?></p>
					</td>
					<td class="span2">
						<p class="small">Valor do Pagamento</p>
						<p>R$ <?php echo ( isset($dados['nr_pago']) ? $dados['nr_pago'] : $valor ) ?></p>
					</td>
					<td class="span2">
						<p class="small">Data do Pagamento</p>
						<p><?php echo ( isset($dados['dt_pgto']) ? date_create($dados['dt_pgto'])->format('j/n/Y') : '&nbsp;' ) ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p>O Acamp's acontecerá dos dias <?php echo $periodo ?></p>
						<p>O transporte para a fazenda sairá da Praça do Cristo Rei, Rua Nogueira Acioli</p>
						<p>Dia <?php echo $inicio ?>, segunda-feira, às 14:00</p>
					</td>
					<td colspan="2">
						<p class="small">Autenticação</p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr/>
	<div>
		<img class="acamps" src="<?php echo $this->config->item('img_url') ?>acamps_boleto.jpg" alt="Acamp's" width="149" height="40" />
		<p class="title">Inscrição do Acampamento de Jovens Shalom</p>
		<table>
			<tbody>
				<tr>
					<td class="span1">
						<p class="small">Inscrição</p>
						<p align="center"><?php echo $dados['id_pessoa'] ?></p>
					</td>
					<td>
						<p class="small">Nome</p>
						<p><?php echo $dados['nm_pessoa'] ?></p>
					</td>
					<td class="span2">
						<p class="small">Valor do Pagamento</p>
						<p>R$ <?php echo ( isset($dados['nr_pago']) ? $dados['nr_pago'] : $valor ) ?></p>
					</td>
					<td class="span2">
						<p class="small">Data do Pagamento</p>
						<p><?php echo ( isset($dados['dt_pgto']) ? date_create($dados['dt_pgto'])->format('j/n/Y') : '&nbsp;' ) ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p><strong><?php echo $dados['nm_tipo'] . (isset($dados['nm_servico']) ? ' - '.$dados['nm_servico'] : '') ?></strong></p>
						<p>Telefone: <?php echo $dados['nr_telefone'] ?></p>
						<p>Endereço: <?php echo $dados['ds_endereco'].', '.$dados['ds_bairro'].', '.$dados['nm_cidade'] ?></p>
					</td>
					<td colspan="2">
						<p class="small">Autenticação</p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="box">
		<p>Este boleto pode ser pago somente no estande do Acamp's do Centro de Evangeliza&ccedil;&atilde;o Shalom da Paz</p>
		<p>Endere&ccedil;o:</p>
		<p>Rua Maria Tom&aacute;sia, 72, Aldeota, Fortaleza - telefone: 85-3268-9366 e 85-8690-1014</p>
	</div>
	<hr/>
	<div id="termo">
		<p class="title" align="center">Termo de Responsabilidade</p>
		<p>Eu, ___________________________________ estou ciente e em acordo com as normas de funcionamento do ACAMPAMENTO DE JOVENS SHALOM e por meio desta, declaro comprometer-me e cumpri-las.</p>
		<p align="right"><span class="assinatura">Assinatura do Participante</span></p>
		<p>Eu, ___________________________________ estou ciente da estrutura e das normas internas do ACAMPAMENTO DE JOVENS SHALOM e autorizo esta inscri&ccedil;&atilde;o.</p>
		<p align="right"><span class="assinatura">Assinatura do Pai ou Respons&aacute;vel</span></p>
		<p >Fortaleza, ____ de _______________ de <?php echo date("Y") ?></p>
	</div>
	
</div>