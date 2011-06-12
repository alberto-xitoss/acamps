<?php if($tipo=='p'){ ?>


<div id="participante">
    <h2>Etiquetas de Participantes</h2>
    <?php if($form): ?>
        <?php echo form_open('admin/etiqueta/p') ?>
            <p>Digite uma faixa de números de inscrições</p>
            <table class="center" style="margin:0 auto">
                <tr><td width="50">Inicial:</td><td><?php echo form_input('id_ini') ?></td></tr>
                <tr><td>Final:</td><td><?php echo form_input('id_fim') ?></td></tr>
            </table>
            <br/>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/p','target="_blank"') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="90">Família</th>
                <th width="130">Seminário</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70">Imprimir etiqueta?</th>
            </tr></thead><tbody>
            <?php $swap = false;
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_familia'] ?></td>
                    <td><?php echo $pessoa['ds_seminario'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
                        <span style="color: #039B03;">Sim</span>
                    <?php else: ?>
                        <span style="color: #D3120E;">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>


<?php }elseif($tipo=='s'){ ?>


<div id="servico">
    <h2>Etiquetas de Serviço</h2>
    <?php if($form): ?>
        <?php echo form_open('admin/etiqueta/s') ?>
            <p class="center">Serviço: <?php
                $servicos = $this->servico->listar();
                $servicos = array_merge(array('0'=>'Todos'), $servicos);
                echo form_dropdown('id_servico', $servicos);
            ?></p>
            <br/>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/s', 'target="_blank"') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="200">Servico</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70">Imprimir etiqueta?</th>
            </tr></thead><tbody>
            <?php $swap = false;
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_servico'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
                        <span style="color: #039B03;">Sim</span>
                    <?php else: ?>
                        <span style="color: #D3120E;">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>


<?php }elseif($tipo=='cv'){ ?>


<div id="cv">
    <h2>Etiquetas de Comunidade de Vida</h2>
    <?php if($form): ?>
        <?php echo form_open('admin/etiqueta/cv') ?>
            <p class="center">Setor: <?php
                $setores = $this->setor->listar();
                $setores = array_merge(array('0'=>'Todos'), $setores);
                echo form_dropdown('id_setor', $setores);
            ?></p>
            <br/>
            <p class="center"><?php echo form_submit('verificar', 'Listar') ?></p>
        <?php echo form_close() ?>
    <?php else: ?>
        <?php echo form_open('admin/etiqueta/cv', 'target="_blank"') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="180">Setor</th>
                <th width="180">Servico</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70">Imprimir etiqueta?</th>
            </tr></thead><tbody>
            <?php $swap = false;//$this->firephp->log($pessoas);
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_setor'] ?></td>
                    <td><?php echo $pessoa['nm_servico'] ?></td>
                    <td class="center"><?php if($pessoa['bl_cracha']):?>
                        <span style="color: #039B03;">Sim</span>
                    <?php else: ?>
                        <span style="color: #D3120E;">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
        <?php echo form_close() ?>
    <?php endif ?>
</div>


<?php }elseif($tipo=='amigos'){ ?>


<div id="amigos">
    <h2>Etiquetas - Amigos do Acamp's</h2>
    <?php echo form_open('admin/etiqueta/amigos', 'target="_blank"') ?>
        <table width="100%">
            <thead><tr>
                <th width="40">Inscr</th>
                <th>Nome</th>
                <th width="200">Família</th>
                <th class="center" width="70">Tem crachá?</th>
                <th class="center" width="70">Imprimir etiqueta?</th>
            </tr></thead><tbody>
            <?php $swap = false;//$this->firephp->log($pessoas);
                foreach($pessoas as $pessoa):?>
                <tr class='<?php
                    if($swap)
                        echo 'zebra ';
                    if(!$pessoa['bl_cracha'])
                        echo 'vermelho';
                    $swap = !$swap;
                ?>'>
                    <td class="center"><?php echo $pessoa['id_pessoa'] ?></td>
                    <td><?php echo $pessoa['nm_pessoa'] ?></td>
                    <td><?php
                        $familias = $this->familia->listar(true);
                        echo form_dropdown($pessoa['id_pessoa'], $familias);
                    ?></td>
                    <td class="center">
                    <?php if($pessoa['bl_cracha']):?>
                        <span style="color: #039B03;">Sim</span>
                    <?php else: ?>
                        <span style="color: #D3120E;">Não</span>
                    <?php endif ?>
                    </td>
                    <td class="center"><?php echo form_checkbox('imprimir[]', $pessoa['id_pessoa'], !$pessoa['bl_cracha']) ?></td>
                </tr>
            <?php endforeach ?></tbody>
        </table>
        <br/>
        <p class="center"><?php echo form_submit('gerar', 'Gerar Etiquetas') ?></p>
    <?php echo form_close() ?>
</div>


<?php }//endif ?>