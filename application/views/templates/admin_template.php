<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt"> <!--<![endif]-->
<head>
	<meta charset=utf-8 />
	<title><?php echo $template['title'] ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo css_url() ?>admin.css" />
	<?php echo $template['meta'] ?>
	<?php echo $template['js'] ?>
</head>
<body>
        <div id="menu">
            <ul>
                <li><?php echo anchor('admin/buscar', 'Busca') ?></li>
                <li class="drop">Inscrições
                    <ul class="sub">
                        <li><?php echo anchor('admin/inscrever/participante', 'Inscrever Participante'); ?></li>
                        <li><?php echo anchor('admin/inscrever/servico', 'Inscrever Serviço'); ?></li>
                        <li><?php echo anchor('admin/inscrever/cv', 'Inscrever Comunidade de Vida'); ?></li>
                        <li><?php echo anchor('admin/inscrever/especial', 'Inscrição Especial'); ?></li>
                        <?php /*<li><?php echo anchor('admin/onibus', 'Gerenciar Ônibus'); ?></li>*/ ?>
                    </ul>
                </li>
                <li class="drop">Ônibus
                	<ul class="sub">
                		<li><?php echo anchor('admin/onibus/locais', 'Locais da saída/chegada'); ?></li>
                		<li><?php echo anchor('admin/onibus/listas', 'Listas dos ônibus'); ?></li>
                	</ul>
                </li>
                <?php if($this->session->userdata('permissao') & FINANCEIRO): ?>
					<li class="drop">Financeiro
						<ul class="sub">
							<li><?php echo anchor('admin/auditar','Auditar Inscrições') ?></li>
						</ul>
					</li>
                <?php endif ?>
                <?php if($this->session->userdata('permissao') & SECRETARIA): ?>
					<li class="drop">Secretaria
						<ul class="sub">
							<li><?php echo anchor('admin/etiqueta/p','Etiquetas - Participantes') ?></li>
							<li><?php echo anchor('admin/etiqueta/s','Etiquetas - Serviço') ?></li>
							<li><?php echo anchor('admin/etiqueta/cv','Etiquetas - Comunidade de Vida') ?></li>
							<li><?php echo anchor('admin/etiqueta/amigos',"Etiquetas - Amigos do Acamp's") ?></li>
							<li><?php echo anchor('admin/etiqueta/e',"Etiquetas - Especial") ?></li>
							<li><?php echo anchor('admin/etiqueta/visitante',"Etiquetas - Visitantes") ?></li>
							<li><?php echo anchor('admin/secretaria/historico', 'Histórico de Impressão'); ?></li>
						</ul>
					</li>
                <?php endif ?>
                <li class="drop">Relatórios
                    <ul class="sub">
						<li><?php echo anchor_popup('admin/relatorio/sintetico','Sintético') ?></li>
						<?php if($this->session->userdata('permissao') & CORRECAO|LIBERACAO): ?>
							<li><?php echo anchor('admin/relatorio/pagamento', 'Pagamentos por perído') ?></li>
						<?php endif ?>
						<li><?php echo anchor('admin/relatorio/servico', 'Serviço/Liberação') ?></li>
						<li><?php echo anchor('admin/relatorio/cv', 'Comunidade de Vida') ?></li>
						<li><?php echo anchor('admin/relatorio/familia', 'Participantes por Família') ?></li>
						<li><?php echo anchor_popup('admin/relatorio/pastoreio', 'Seminário por Idade') ?></li>
						<li><?php echo anchor_popup('admin/relatorio/divulgacao', 'Pesquisa sobre Divulgação') ?></li>
						<?php /*
						<li class="disabled">Aniversariantes da semana</li>
						<li class="disabled">Alimentação</li>
						<li class="disabled">Portaria</li>
						<?php if($this->session->userdata('permissao') & CORRECAO|LIBERACAO): ?>
							<li class="disabled"><strong>Relatório customizável</strong></li>
						<?php endif ?>*/ ?>
                    </ul>
                </li>
                <?php if($this->session->userdata('permissao') & DESENVOLVEDOR): ?>
					<li class="drop">Desenvolvedor
						<ul class="sub">
						  <?php /*<li class="disabled">Criar novo usuário</li>*/ ?>
						  <li><?php echo anchor('admin/dev/log', 'Log') ?></li>
						  <li><?php echo anchor('admin/dev/limpar/secretaria', 'Limpar Cache da Secretaria') ?></li>
						  <?php /*<li><?php echo anchor('admin/dev/limpar', 'Limpar inscrições') ?></li>*/ ?>
						</ul>
					</li>
                <?php endif ?>
            </ul>
            <span id="usuario"><?php echo $this->session->userdata('nm_usuario') ?> | <?php echo anchor('admin/logout', 'sair'); ?></span>
        </div>
        <?php echo $template['content'] ?>
</body>
</html>