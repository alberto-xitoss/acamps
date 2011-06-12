<div id="buscar">
    <?php
    echo form_open('admin/buscar');
    echo form_input(array(
            'name'        => 'consulta',
            'id'          => 'consulta',
            'maxlength'   => '20'
        ));
    
    echo form_submit('buscar', 'Buscar');
    echo form_close();
    ?>
</div>

<div id="resultado">
<?php if(is_array($resultado) && count($resultado) > 0): ?>
    <table align="center" width="100%">
        <tbody>
        	<?php foreach($resultado as $linha): ?>
                <tr>
                    <td><?php echo anchor('admin/pessoa/'.$linha->id_pessoa, '<span class="id_pessoa status-'.$linha->id_status.'">'.$linha->id_pessoa.'</span>'.$linha->nm_pessoa) ?></td>
                    <td width="180">
                    <?php if($linha->cd_tipo == 'p'): ?>
	                    	<span class="tipo-p familia-<?php echo strtolower($linha->cd_familia) ?>"><?php echo $linha->nm_familia ?></span>
	                    <?php elseif($linha->cd_tipo == 's'):  ?>
	                    	<span class="tipo-<?php echo $linha->cd_tipo ?>">Serviço</span>
	                    <?php elseif($linha->cd_tipo == 'v'):  ?>
	                    	<span class="tipo-<?php echo $linha->cd_tipo ?>">Comunidade de Vida</span>
	                <?php endif; ?>	               
	                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif(is_array($resultado) && count($resultado) == 0): ?>
    Não foi encontrado nenhum resultado.
<?php endif; ?>
</div>
<div id="detalhes-min">
	detalhes-min
</div>
<script>
	
</script>