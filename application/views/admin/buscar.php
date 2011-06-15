<div id="buscar">
    <h2>Buscar Inscrição</h2>
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
    <p><small>Você pode procurar pelo nome ou pelo número de inscrição.</small></p>
</div>

<div id="resultado">
<?php if(is_array($resultado) && count($resultado) > 0): ?>
    <table align="center" width="100%">
        <thead>
            <tr>
                <th>Inscri&ccedil;&atilde;o</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>A&ccedil;&otilde;es</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach($resultado as $linha): ?>
                <tr>
                    <td><?php echo anchor('admin/pessoa/'.$linha->id_pessoa, '<span class="id-'.$linha->cd_tipo.' status-'.$linha->id_status.'">'.$linha->id_pessoa.'</span>'.$linha->nm_pessoa) ?></td>
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
	
</div>
