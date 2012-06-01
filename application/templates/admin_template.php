<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>{title}</title>
{css}
{js}
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
                    </ul>
                </li>
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
						<?php /*<li class="disabled">Participantes por família</li>
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
        {conteudo}
</body>
</html>