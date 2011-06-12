<div class='clearfix'>
    
    <a href="<?php echo base_url().'admin/pessoa/'.$pessoa->id_pessoa ?>"><img id="foto" src="<?php echo (empty($pessoa->ds_foto) ? assets_url('image').'sem_foto.png' : $pessoa->ds_foto) ?>" alt="foto" title="<?php echo $pessoa->nm_cracha ?>" />
    <h2><?php echo $pessoa->id_pessoa; ?> - <?php echo $pessoa->nm_pessoa; ?></h2></a>
    <p>Tipo de inscrição: <?php switch($pessoa->cd_tipo){
        case 'p':
            echo 'Participante';
            break;
        case 's':
            echo 'Serviço';
            break;
    }
    ?></p>
</div>
<!--#########################################################################-->
<div id="avista">
    <h2>Tipo do Pagamento</h2>
    <?php echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>
	<?php //echo form_hidden('id_pessoa', $pessoa->id_pessoa) ?>
    <p><?php
        echo form_radio(array(
            'id'=>'tipo_d',
            'name'=>'cd_tipo_pgto',
            'value'=>'d',
            'checked'=>true
        ));
        echo form_label('Dinheiro','tipo_d')?></p>
    <p><?php
        echo form_radio(array(
            'id'=>'tipo_c',
            'name'=>'cd_tipo_pgto',
            'value'=>'c'
        ));
        echo form_label('Cheque','tipo_c')?></p>
    <p><?php
        echo form_radio(array(
            'id'=>'tipo_cp',
            'name'=>'cd_tipo_pgto',
            'value'=>'cp'
        ));
        echo form_label('Cheque Pré-datado','tipo_cp') ?>
    </p>
	<br/>
	<table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100px">Valor a Pagar:</td>
            <td><span id='avista_apagar'class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_a_pagar', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
		<?php if($this->session->userdata('permissao') & DESCONTO): // Verificando Permissão do usuário ?>
			<tr>
				<td>Desconto:</td>
				<td><input id="avista_desconto" name="nr_desconto" type="text" /></td>
			</tr>
			<tr>
				<td>Total:</td>
				<td><span id='avista_total' class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
				<?php echo form_hidden('nr_pago', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
			</tr>
		<?php endif ?>
        <tr>
            <td>Valor Pago:</td>
            <td><input id="avista_pago" name="avista_pago" type="text" /></td>
        </tr>
        <tr>
            <td>Troco:</td>
            <td><span id="avista_troco" class="textfield">0.00</span></td>
        </tr>
    </table>
	<p align="center" style="margin-top:30px"><?php echo form_submit('pagar', 'Efetuar Pagamento', 'id="pagar"'); ?></p>
    <?php echo form_close() ?>
</div>
<script>

    var Pagamento = {
	valor: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
	pago: 0.0,
	desconto: 0.0,
	total: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
	troco: 0.0
    }
    
    $(function(){
        $("#avista_pagar").click(function(){
			if(Pagamento.pago < Pagamento.total){
				alert("Verifique se todos os campos estão preenchidos corretamente!");
				return false;
			}
		});
        
        // Eventos do Desconto        
        <?php if($this->session->userdata('permissao') & DESCONTO): ?>
            $("#avista_desconto").keypress(function(){
                mascara($(this), dinheiro);
            });
            $("#avista_desconto").keyup(function(){
                Pagamento.desconto = parseFloat($(this).val());
                if(!Pagamento.desconto){Pagamento.desconto = 0;}
                Pagamento.total = Pagamento.valor - Pagamento.desconto;
                $("#avista_total").text(formataValor(Pagamento.total));
                $("input[name='nr_pago']", "#avista").val(formataValor(Pagamento.total));
            });
        <?php endif ?>
        
        $(".numero").keypress(function(){
            mascara($(this), numero);
		});
        $("#avista_pago").keypress(function(){
            mascara($(this), dinheiro);
		});
        $("#avista_pago").keyup(function(){
            Pagamento.pago = parseFloat($(this).val().replace(',','.'));
            if(!Pagamento.pago){ Pagamento.pago = 0; }
            
            //Aqui podia ser só [troco = pago - total] já que, sem desconto, o total é igual ao valor
            <?php if($this->session->userdata('permissao') & DESCONTO): ?>
                Pagamento.troco = Pagamento.pago - Pagamento.total;
            <?php else: ?>
                Pagamento.troco = Pagamento.pago - Pagamento.valor;
            <?php endif ?>
            
            if(Pagamento.troco > 0){
                $("#avista_troco").text(formataValor(Pagamento.troco));
            }else{
                Pagamento.troco = 0;
                $("#avista_troco").text(formataValor(Pagamento.troco));
            }
        });
        
    });
    
    // Funções auxiliares
    function formataValor(v){
        return v.toFixed(2);//.replace(".",".");
    }
    function mascara(o,f){
        v_obj=o;
        v_fun=f;
        setTimeout("execmascara()",1);
    }
    function execmascara(){
        $(v_obj).val(v_fun($(v_obj).val()));
    }
    function dinheiro(str){
        str=str.replace(/\D/g,"");
        str=str.replace(/(\d)(\d{2})$/g,"$1.$2");
        return str;
    }
    function numero(str){
        str=str.replace(/\D/g,"");
        return str;
    }
</script>