<h2>Buscar dados de inscrição antiga</h2>
<div id="buscar-inscricao">
    <p>Se você participou do último Acamp's, em julho deste ano, você pode aproveitar os dados da sua inscrição.
    Digite seu RG no campo abaixo e se encontrarmos sua inscrição o formulário já estará parcialmente preenchido.</p>
    <br/>
    <?php echo form_open('/inscricao/'.$tipo) ?>
    <p class="center"><?php
        echo form_label('RG','nr_rg',array('class'=>'campo'));
        echo form_input(array(
            'name'=>'nr_rg',
            'id'=>'nr_rg'
        ));
    ?></p>
    <br/>
    <p class="center"><?php echo form_submit('buscar_inscricao', 'Procurar') ?></p>
    <br/>
    <br/>
    <p class="right"><?php echo anchor('/inscricao/'.$tipo, 'Continuar sem procurar &raquo;') ?></p>
    <br/>
</div>