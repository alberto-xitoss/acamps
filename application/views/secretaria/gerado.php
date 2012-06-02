<h2>Etiquetas <?php

	switch($cd_tipo) {
		case 'p':
			echo 'de Participante';
			break;
		case 's':
			echo 'de Serviço';
			break;
		case 'v':
			echo 'da Comunidade de Vida';
			break;
		case 'e':
			echo 'de Inscrições Especiais';
			break;
		case 'p':
			echo 'de Visitantes';
			break;
		default:
			
	}
	
?></h2>
<div class="wrap well">

	<p>Etiquetas geradas: <?php echo $nr_etiquetas ?></p>
	<p><strong><?php echo anchor(base_url().'cache/secretaria/'.$etiquetas, 'Baixar etiquetas', 'target="_blank"'); ?></strong></p>
	<?php if(ENVIRONMENT != 'acamps' && $cd_tipo != 'e' && $cd_tipo != 'visitante'): ?>
		<p><strong><?php echo anchor(base_url().'cache/secretaria/'.$fotos, 'Baixar fotos', 'target="_blank"'); ?></strong></p>
	<?php endif ?>
	
</div>
