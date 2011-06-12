<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>{title}</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup,
  menu, nav, section { display: block; }
</style>
<?php
if(ENVIRONMENT == 'production'){
	echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
	echo '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>';
	echo '<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>';
}else{
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.min.js"></script>';
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery-ui.min.js"></script>';
    echo '<script src="http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/js/jquery.ui.datepicker-pt-BR.js"></script>';
}
?>
{css}
{js}
</head>
<body>
        <menu class="clearfix">
            <ul>
                <li><?php echo anchor('admin/buscar', 'Busca') ?></li>
                <li class="drop">Inscrições
                    <ul class="sub">
                        <li><?php echo anchor('admin/inscrever/participante', 'Inscrever Participante'); ?></li>
                        <li><?php echo anchor('admin/inscrever/servico', 'Inscrever Serviço'); ?></li>
                        <li><?php echo anchor('admin/inscrever/cv', 'Inscrever Comunidade de Vida'); ?></li>
                        <li>Serviço/Liberação</li>
                        <li>Caravanas</li>
                    </ul>
                </li>
                <?php if($this->session->userdata('permissao') & SECRETARIA): ?>
					<li class="drop">Secretaria
						<ul class="sub">
							<li><?php echo anchor('admin/etiqueta/p','Etiquetas - Participantes') ?></li>
							<li><?php echo anchor('admin/etiqueta/s','Etiquetas - Serviço') ?></li>
							<li><?php echo anchor('admin/etiqueta/cv','Etiquetas - Comunidade de Vida') ?></li>
							<li><?php echo anchor('admin/etiqueta/amigos',"Etiquetas - Amigos do Acamp's") ?></li>
							<li><?php echo anchor('admin/secretaria/historico', 'Histórico de Impressão'); ?></li>
							<!--<li><?php echo anchor('admin/secretaria/fotos', 'Baixar Fotos', 'target="_blank"') ?></li>-->
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
						<li>Participantes por família</li>
						<li>Aniversariantes da semana</li>
						<li>Alimentação</li>
						<li>Portaria</li>
						<?php if($this->session->userdata('permissao') & CORRECAO|LIBERACAO): ?>
							<li><strong>Relatório customizável</strong></li>
						<?php endif ?>
                    </ul>
                </li>
                <?php if($this->session->userdata('permissao') & DESENVOLVEDOR): ?>
					<li class="drop">Desenvolvedor
						<ul class="sub">
						  <li>Criar novo usuário</li>
						  <li><?php echo anchor('admin/dev/log', 'Log') ?></li>
						  <!--<li><?php echo anchor('admin/dev/limpar', 'Limpar inscrições') ?></li>-->
						</ul>
					</li>
                <?php endif ?>
                <li class="right"><?php echo anchor('admin/logout', 'Sair'); ?></li>
                <li class="right">Ajuda</li>
            </ul>
            <span id="usuario"><?php echo $this->session->userdata('nm_usuario') ?></span>
        </menu>
        {conteudo}
</body>
<script>
    $(function(){
      $(".drop").hover(function(){
        $(".sub", $(this)).stop().attr('style','').animate({
            height: 'show',
            opacity: 1
        },150);
      },function(){
        $(".sub", $(this)).stop().attr('style','').animate({
            height: 'hide',
            opacity: 0
        },150);
      });
    });
</script>
</html>