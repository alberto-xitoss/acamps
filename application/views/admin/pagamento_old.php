<div class='clearfix'>
    
    <a href="<?php echo base_url().'admin/pessoa/'.$pessoa->id_pessoa ?>"><img id="foto" src="<?php echo (empty($pessoa->ds_foto) ? base_url().'assets/image/sem_foto.png' : $pessoa->ds_foto) ?>" alt="foto" title="<?php echo $pessoa->nm_cracha ?>" />
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
<div>
    <h2>Tipo do Pagamento</h2>
    <?php //echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>
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
    <?php //echo form_close() ?>
</div>
<!--#########################################################################-->
<div id="avista">
    <h2>Pagamento à Vista</h2>
    <?php echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>
    <?php echo form_hidden('id_pessoa', $pessoa->id_pessoa) ?>
    <?php echo form_hidden('cd_tipo_pgto', 'd') ?>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="100px">Valor a Pagar:</td>
            <td><span id='avista_apagar'class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_a_pagar', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
    <?php if($this->session->userdata('permissao') & DESCONTO): ?>
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
    <p align="center" style="margin-top:30px"><?php echo form_submit('pagar', 'Efetuar Pagamento', 'id="avista_pagar"'); ?></p>
    <?php echo form_close() ?>
</div>
<!--#########################################################################-->
<div id="cheque" style='display:none'>
    <h2>Cheque</h2>
    <?php echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>
    <?php echo form_hidden('id_pessoa', $pessoa->id_pessoa) ?>
    <?php echo form_hidden('cd_tipo_pgto', 'c') ?>
    <?php echo form_hidden('nr_parcela', 1) ?>
    <table border="0" cellpadding="0" cellspacing="2">
        <tr>
            <td width="100px">Valor a Pagar:</td>
            <td><span id="cheque_valor" class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_a_pagar', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
    <?php if($this->session->userdata('permissao') & DESCONTO): ?>
        <tr>
            <td>Desconto:</td>
            <td><input id="cheque_desconto" name="nr_desconto" type="text" /></td>
        </tr>
        <tr>
            <td>Total:</td>
            <td><span id="cheque_total" class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_pago', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
    <?php endif ?>
    </table>
    <br/><br/>
    <div>Nome<br/><input id="cheque_nm_emitente" name="nm_emitente" type="text" /></div>
    <div>Telefone<br/><input id="cheque_nr_telefone" name="nr_telefone" type="text" class="numero" /></div>
    <div>Valor<br/><input id="cheque_nr_valor" name="nr_valor" type="text" /></div>
    <div>Cheque<br/><input id="cheque_nr_cheque" name="nr_cheque" type="text" class="numero" />-<input type="text" id="cheque_nr_cheque_dgt" name="nr_cheque_dgt" maxlength="1" class="numero" /></div>
    <div>Comp<br/><input id="cheque_nr_comp" name="nr_comp" type="text" class="numero" /></div>
    <div>Banco<br/><input id="cheque_nr_banco" name="nr_banco" type="text" class="numero" /></div>
    <div>Agência<br/><input id="cheque_nr_agencia" name="nr_agencia" type="text" class="numero" />-<input type="text" id="cheque_nr_agencia_dgt" name="nr_agencia_dgt" maxlength="1" class="numero" /></div>
    <div>Conta<br/><input id="cheque_nr_conta" name="nr_conta" type="text" class="numero" />-<input type="text" id="cheque_nr_conta_dgt" name="nr_conta_dgt" maxlength="1" class="numero" /></div>
    <div>Cidade<br/><input id="cheque_ds_cidade" name="ds_cidade" type="text" /></div>
    <div>UF<br/><input id="cheque_ds_estado" name="ds_estado" type="text" maxlength="2" /></div>
    <div>Obs<br/><input id="cheque_ds_obs" name="ds_obs" type="text" /></div>
    <p align="center" style="margin-top:30px"><?php echo form_submit('pagar', 'Efetuar Pagamento', 'id="cheque_pagar"'); ?></p>
    <?php echo form_close() ?>
</div>
<!--#########################################################################-->
<div id="chequepre" style='display:none'>
    <h2>Cheque Pré-datado</h2>
    <?php echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>
    <?php echo form_hidden('id_pessoa', $pessoa->id_pessoa) ?>
    <?php echo form_hidden('cd_tipo_pgto', 'cp') ?>
    <table border="0" cellpadding="0" cellspacing="2">
        <tr>
            <td width="100px">Valor a Pagar:</td>
            <td><span id="chequepre_valor" class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_a_pagar', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
    <?php if($this->session->userdata('permissao') & DESCONTO): ?>
        <tr>
            <td>Desconto:</td>
            <td><input id="chequepre_desconto" name="nr_desconto" type="text" /></td>
        </tr>
        <tr>
            <td>Total:</td>
            <td><span id="chequepre_total" class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
            <?php echo form_hidden('nr_pago', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
        </tr>
    <?php endif ?>
    </table>
    <br/><br/>
    <div>Nome<br/><input id="chequepre_nm_emitente" name="nm_emitente" type="text" /></div>
    <div>Telefone<br/><input id="chequepre_nr_telefone" name="nr_telefone" type="text" class="numero" /></div>
    
    <div>Comp<br/><input id="chequepre_nr_comp" name="nr_comp" type="text" class="numero" /></div>
    <div>Banco<br/><input id="chequepre_nr_banco" name="nr_banco" type="text" class="numero" /></div>
    <div>Agência<br/><input id="chequepre_nr_agencia" name="nr_agencia" type="text" class="numero" />-<input type="text" id="chequepre_nr_agencia_dgt" name="nr_agencia_dgt" maxlength="1" class="numero" /></div>
    <div>Conta<br/><input id="chequepre_nr_conta" name="nr_conta" type="text" class="numero" />-<input type="text" id="chequepre_nr_conta_dgt" name="nr_conta_dgt" maxlength="1" class="numero" /></div>
    <div>Cidade<br/><input id="chequepre_ds_cidade" name="ds_cidade" type="text" /></div>
    <div>UF<br/><input id="chequepre_ds_estado" name="ds_estado" type="text" maxlength="2" /></div>
    <div>Obs<br/><input id="chequepre_ds_obs" name="ds_obs" type="text" /></div>
    <br/><br/>
    <p>Quantas vezes: <?php echo form_dropdown('qnt_cp', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), '1', 'id="qnt_cp"') ?></p>
    <br/>
    <div class="cheque" id='cp1'>
        <div>Valor<br/><input class="chequepre_nr_valor" name="nr_valor1" type="text" class="numero" /></div>
        <div>Cheque<br/><input class="chequepre_nr_cheque" name="nr_cheque1" type="text" class="numero" />-<input type="text" class="chequepre_nr_cheque_dgt" name="nr_cheque_dgt1" maxlength="1" class="numero" /></div>
    </div>
    
    <div class="cheque" id='cp2'>
        <div>Valor<br/><input class="chequepre_nr_valor" name="nr_valor2" type="text" class="numero" /></div>
        <div>Cheque<br/><input class="chequepre_nr_cheque" name="nr_cheque2" type="text" class="numero" />-<input type="text" class="chequepre_nr_cheque_dgt" name="nr_cheque_dgt2" maxlength="1" class="numero" /></div>
    </div>
    
    <div class="cheque" id='cp3'>
        <div>Valor<br/><input class="chequepre_nr_valor" name="nr_valor3" type="text" class="numero" /></div>
        <div>Cheque<br/><input class="chequepre_nr_cheque" name="nr_cheque3" type="text" class="numero" />-<input type="text" class="chequepre_nr_cheque_dgt" name="nr_cheque_dgt3" maxlength="1" class="numero" /></div>
    </div>
    
    <div class="cheque" id='cp4'>
        <div>Valor<br/><input class="chequepre_nr_valor" name="nr_valor4" type="text" class="numero" /></div>
        <div>Cheque<br/><input class="chequepre_nr_cheque" name="nr_cheque4" type="text" class="numero" />-<input type="text" class="chequepre_nr_cheque_dgt" name="nr_cheque_dgt4" maxlength="1" class="numero" /></div>
    </div>
    
    <div class="cheque" id='cp5'>
        <div>Valor<br/><input class="chequepre_nr_valor" name="nr_valor5" type="text" class="numero" /></div>
        <div>Cheque<br/><input class="chequepre_nr_cheque" name="nr_cheque5" type="text" class="numero" />-<input type="text" class="chequepre_nr_cheque_dgt" name="nr_cheque_dgt5" maxlength="1" class="numero" /></div>
    </div>
    
    <p align="center" style="margin-top:30px"><?php echo form_submit('pagar', 'Efetuar Pagamento', 'id="cheque_pagar"'); ?></p>
    <?php echo form_close() ?>
</div>
<!--#########################################################################-->
<script>

    var Pagamento = {
	valor: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
	pago: 0.0,
	desconto: 0.0,
	total: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
	troco: 0.0
    }
    
    $(function(){
        
        // Escolhendo o tipo de pagamento
        $('#tipo_d').click(function(){
            $('#cheque, #chequepre').hide();
            $('#avista').show();
        });
        $('#tipo_c').click(function(){
            $('#avista, #chequepre').hide();
            $('#cheque').show();
        });
        $('#tipo_cp').click(function(){
            $('#cheque, #avista').hide();
            $('#chequepre').show();
        });
        
        // Mudando a quantidade de janelinhas dos cheques pré-datados
        $("#chequepre .cheque:gt(0)").hide();
        $("#qnt_cp").change(function(){
            $("#chequepre .cheque:lt("+( parseInt($(this).val()) )+")").show();
            $("#chequepre .cheque:gt("+( parseInt($(this).val()) - 1 )+")").hide();
	});
        
        $("#avista_pagar").click(function(){
		if(Pagamento.pago < Pagamento.total){
			alert("Verifique se todos os campos estão preenchidos corretamente!");
			return false;
		}
                
		// Pedindo Confirmação
		//$("#confirma").show();
		//return false;
	});
        
        $("#cheque_pagar").click(function(){
		if(parseFloat($("#cheque_nr_valor").val()) < Pagamento.total){
			alert("Verifique se todos os campos estão preenchidos corretamente!");
			return false;
		}
                
		inputs = $("#cheque :text:not(#cheque_ds_obs):not(#cheque_desconto)");
		for(i = 0; i < inputs.size(); i++){
			if(inputs.eq(i).val() == ""){
				alert("Verifique se todos os campos estão preenchidos corretamente!");
				return false;
			}
		}
                
		// Pedindo Confirmação
		//$("#confirma").show();
		//return false;
	});
        
        $("#chequepre_pagar").click(function(){
		/*var cheques = $(".cheque","#chequepre");
		var chequepre_total = 0.0;
		for( i=0; i<cheques.length; i++ ){
			chequepre_total += parseFloat(cheques.eq(i).find(".chequepre_valor").val());
		}
		if(chequepre_total < Pagamento.total){
			alert("Verifique se todos os campos estão preenchidos corretamente!");
			return false;
		}*/
		
		inputs = $("#chequepre :text:not(#chequepre_obs):not(#chequepre_desconto)");
		for(i = 0; i < inputs.length; i++){
			if(inputs.eq(i).val() == ""){
				alert("Verifique se todos os campos estão preenchidos corretamente!");
				return false;
			}
		}
		
		// Pedindo Confirmação
		//$("#confirma").show();
		//return false;
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
            //-----------------------------------------
            $("#cheque_desconto").keypress(function(){
                mascara($(this), dinheiro);
            });
            $("#cheque_desconto").keyup(function(){
                Pagamento.desconto = parseFloat($(this).val());
                if(!Pagamento.desconto){Pagamento.desconto = 0;}
                Pagamento.total = Pagamento.valor - Pagamento.desconto;
                $("#cheque_total").text(formataValor(Pagamento.total));
                $("input[name='nr_pago']", "#cheque").val(formataValor(Pagamento.total));
            });
            //----------------------------------------
            $("#chequepre_desconto").keypress(function(){
                mascara($(this), dinheiro);
            });
            $("#chequepre_desconto").keyup(function(){
                Pagamento.desconto = parseFloat($(this).val().replace(",","."));
                if(!Pagamento.desconto){Pagamento.desconto = 0;}
                Pagamento.total = Pagamento.valor - Pagamento.desconto;
                $("#chequepre_total").text(formataValor(Pagamento.total));
                $("input[name='nr_pago']", "#chequepre").val(formataValor(Pagamento.total));
            });
        <?php endif ?>
        
        $(".numero").keypress(function(){
            mascara($(this), numero);
	});
        $("#avista_pago, #cheque_nr_valor, #chequepre_nr_valor").keypress(function(){
            mascara($(this), dinheiro);
	});
        $("#avista_pago, #cheque_nr_valor, #chequepre_nr_valor").keyup(function(){
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