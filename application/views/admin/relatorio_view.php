<?php if($tipo == 'pagamento'): ?>
<h2>Relatório Financeiro - Por Período</h2>
<div class="wrap relatorio">
    <p class="well well-small">Lista todos os pagamentos efetuados no período escolhido.</p>
    <?php echo form_open('admin/relatorio/pagamento', 'target="_blank" class="form-inline"') ?>
        <table>
            <tr>
                <td><label for="dt_inicio">Data Inicial</label></td>
                <td><label for="dt_fim">Data Final</label></td>
				<td></td>
            </tr>
            <tr>
                <td><input type="text" id="dt_inicio" name="dt_inicio" placeholder="<?php echo date('d/m/Y') ?>"></td>
                <td><input type="text" id="dt_fim" name="dt_fim" placeholder="<?php echo date('d/m/Y') ?>"></td>
				<td><?php echo form_submit('gerar_relatorio', 'Gerar Relatório', 'class="btn"') ?></td>
            </tr>
        </table>
    <?php echo form_close() ?>
</div>
<script>
	$(function()
	{
		$('#dt_inicio').datepicker({
			yearRange: '2012',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo $this->config->item('img_url'); ?>calendar.png",
			buttonImageOnly: true
		});
		$('#dt_fim').datepicker({
			yearRange: '2012',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst){
				$(this).change();
			},
			showOn: "button",
			buttonImage: "<?php echo $this->config->item('img_url'); ?>calendar.png",
			buttonImageOnly: true
		});
	})
</script>

<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'servico'): ?>
<h2>Relatório de Serviço</h2>
<div class="wrap relatorio">
    <p class="well well-small">Lista os inscritos do serviço escolhido.</p>
    <?php echo form_open('admin/relatorio/servico','target="_blank" class="form-inline"') ?>
    <table>
		<tr>
			<td>Serviço:</td>
			<td><?php
				$servicos = $this->servico->listar();
				$servicos = array_merge(array('0'=>'Todos'), $servicos);
				echo form_dropdown('id_servico', $servicos);
			?></td>
			<td><?php echo form_submit('gerar_relatorio', 'Gerar Relatório', 'class="btn"') ?></td>
		</tr>
	</table>
    <?php echo form_close() ?>
</div>
<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'cv'): ?>
<h2>Relatório de Comunidade de Vida</h2>
<div class="wrap relatorio">
    <p class="well well-small">Lista os inscritos da Comunidada de Vida separados por setor.</p>
    <?php echo form_open('admin/relatorio/cv','target="_blank" class="form-inline"') ?>
    <table>
		<tr>
			<td>Setor:</td>
			<td><?php
				$setores = $this->setor->listar();
				$setores = array_merge(array('0'=>'Todos'), $setores);
				echo form_dropdown('id_setor', $setores);
			?></td>
			<td><?php echo form_submit('gerar_relatorio', 'Gerar Relatório', 'class="btn"') ?></td>
		</tr>
	</table>
    <?php echo form_close() ?>
</div>
<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'familia'): ?>
<div class="wrap relatorio">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'aniversario'): ?>
<div class="wrap relatorio">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'alimentacao'): ?>
<div class="wrap relatorio">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'portaria'): ?>
<div class="wrap relatorio">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'custom'): ?>
<div class="wrap relatorio">
    
</div>
<?php endif //--------------------------------------------------------------- ?>