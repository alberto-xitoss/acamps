<?php if($tipo == 'sintetico'): ?>
<div id="sintetico">
    
</div>
<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'pagamento'): ?>
<div id="pagamento">
    <h2>Relatório por Período</h2>
    <p>Lista todos os pagamentos efetuados no período escolhido e quem os realizou.</p>
    <?php echo form_open('admin/relatorio/pagamento', 'target="_blank"') ?>
        <table>
            <tr>
                <td>Data Inicial</td>
                <td>Data Final</td>
            </tr>
            <tr>
                <td><?php echo form_input(array(
                    'name'=>'dt_inicio',
                    'id'=>'dt_inicio'
                )) ?></td>
                <td><?php echo form_input(array(
                    'name'=>'dt_fim',
                    'id'=>'dt_fim'
                )) ?></td>
            </tr>
        </table>
        <p class='center'><?php echo form_submit('gerar_relatorio', 'Gerar Relatório') ?></p>
    <?php echo form_close() ?>
</div>

<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'servico'): ?>
<div id="servico">
    <h2>Relatório de Serviço</h2>
    <p>Lista todos os inscritos do serviço escolhido.</p>
    <?php echo form_open('admin/relatorio/servico','target="_blank"') ?>
    <br/>
    <p>Serviço: <?php
        $servicos = $this->servico->listar();
        $servicos = array_merge(array('0'=>'Todos'), $servicos);
        echo form_dropdown('id_servico', $servicos);
        echo nbs(3);
        echo form_submit('gerar_relatorio', 'Gerar Relatório');
    ?></p>
    <?php echo form_close() ?>
</div>
<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'cv'): ?>
<div id="cv">
    <h2>Relatório de Comunidade de Vida</h2>
    <p>Lista todos os inscritos da Comunidada de Vida.</p>
    <?php echo form_open('admin/relatorio/cv','target="_blank"') ?>
    <br/>
    <p>Setor: <?php
        $setores = $this->setor->listar();
        $setores = array_merge(array('0'=>'Todos'), $setores);
        echo form_dropdown('id_setor', $setores);
        echo nbs(3);
        echo form_submit('gerar_relatorio', 'Gerar Relatório');
    ?></p>
    <?php echo form_close() ?>
</div>
<?php endif //--------------------------------------------------------------- ?>

<?php if($tipo == 'familia'): ?>
<div id="familia">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'aniversario'): ?>
<div id="aniversario">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'alimentacao'): ?>
<div id="alimentacao">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'portaria'): ?>
<div id="portaria">
    
</div>
<?php endif //--------------------------------------------------------------- ?>
<?php if($tipo == 'custom'): ?>
<div id="custom">
    
</div>
<?php endif //--------------------------------------------------------------- ?>