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
            <?php
                $alterna = true;
                foreach($resultado as $linha):
                $alterna = !$alterna;
            ?>
                <tr <?php if($alterna) echo 'class="zebra"' ?> >
                    <td><?php echo $linha->id_pessoa ?></td>
                    <td><?php echo $linha->nm_pessoa ?></td>
                    <td><?php echo strtoupper($linha->cd_tipo) ?></td>
                    <td><?php echo $linha->ds_status ?></td>
                    <td><?php
						echo anchor('admin/pessoa/'.$linha->id_pessoa, 'D');
                        if($linha->id_status == '2' && ($this->session->userdata('permissao') & LIBERACAO)){
                            echo ' | '.anchor('admin/liberar/'.$linha->id_pessoa, 'L');
                        }else{
                            echo ' | L'; // Desabilitado
                        }
                        if($linha->id_status == '1' && ($this->session->userdata('permissao') & PAGAMENTO)){
                            echo ' | '.anchor('admin/pagar/'.$linha->id_pessoa, 'P');
                        }else{
                            echo ' | P'; // Desabilitado
                        }
                    ?></td>
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