<?php echo form_open('admin/pagar/'.$pessoa->id_pessoa) ?>

<div class="modal-header"><a class="close" href="#" data-dismiss="modal">×</a><h3>Pagamento</h3></div>

<div class="modal-body">
	<p><strong>Tipo do Pagamento</strong></p>
	<label for="tipo_d" class="radio"><input type="radio" id="tipo_d" value="d" name="cd_tipo_pgto" checked />Dinheiro</label>
	<label for="tipo_c" class="radio"><input type="radio" id="tipo_c" value="c" name="cd_tipo_pgto"/>Cheque</label>
	<label for="tipo_cp" class="radio"><input type="radio" id="tipo_cp" value="cp" name="cd_tipo_pgto"/>Cheque Pré-datado</label>
	<table class="table form-inline">
		<tr>
			<th width="100px">Valor a Pagar:</th>
			<td><span id='avista_apagar'class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
			<?php echo form_hidden('nr_a_pagar', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
		</tr>
		<?php if($this->session->userdata('permissao') & DESCONTO): // Verificando Permissão do usuário ?>
			<tr>
				<th>Desconto:</th>
				<td><input id="avista_desconto" name="nr_desconto" type="text" /></td>
			</tr>
			<tr>
				<th>Total:</th>
				<td><span id='avista_total' class="textfield"><?php printf('%.2f' ,$pessoa->nr_a_pagar) ?></span>
				<?php echo form_hidden('nr_pago', sprintf('%.2f' ,$pessoa->nr_a_pagar)) ?></td>
			</tr>
		<?php endif ?>
		<tr>
			<th>Valor Pago:</th>
			<td><input id="avista_pago" name="avista_pago" type="text" /></td>
		</tr>
		<tr>
			<th>Troco:</th>
			<td><span id="avista_troco" class="textfield">0.00</span></td>
		</tr>
	</table>
</div>

<div class="modal-footer">
	<p align="center"><input type="submit" id="pagar" class="btn btn-success" value="Efetuar Pagamento" name="pagar" /></p>
</div>

<?php echo form_close() ?>

<script>

    var Pagamento = {
		valor: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
		pago: 0.0,
		desconto: 0.0,
		total: parseFloat(<?php echo '"'.$pessoa->nr_a_pagar.'"' ?>),
		troco: 0.0
    }
    
    //$(function(){
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
        
    //});
    
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