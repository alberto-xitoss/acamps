<div id="onibus">
	<div class="coluna-esquerda">
		<div id="onibus-geral">
			<h3>Reservas dos Ônibus</h3>
			<p class="well well-small" id="onibus-reservados"></p>
		</div>
		<div id="onibus-busca" class="form-inline">
			<h3>Busca</h3>
			<p><input type="text" id="nome" name="nome" /><button id="buscar" type="button" class="btn" data-loading-text="Buscando..." >Buscar</button></p>
			<div class="well well-small">
				<p>
					<label class="checkbox inline"><input type="checkbox" id="check-status-concluidas" value="3">Apenas Concluídas</label>
					<label class="checkbox inline"><input type="checkbox" id="check-onibus" value="true">Não Tem Ônibus</label>
				</p>
				<p>
					<label class="checkbox inline"><input type="checkbox" id="check-tipo-p" value="p">Participante</label>
					<label class="checkbox inline"><input type="checkbox" id="check-tipo-s" value="s">Serviço</label>
					<label class="checkbox inline"><input type="checkbox" id="check-tipo-cv" value="v">Comunidade de Vida</label>
					<label class="checkbox inline"><input type="checkbox" id="check-tipo-e" value="e">Especial</label>
				</p>
			</div>
			<table class="table table-condensed table-bordered">
			</table>
		</div>
	</div>
	<div class="coluna-direita">
		<div id="onibus-lista">
			<div class="cabecalho">
				<span>Ônibus</span> <span id="onibus-numero">01</span>
				<button id="salvar-lista" class="btn btn-primary" data-loading-text="Salvando..." >Salvar</button>
				<div id="nova-lista" class="btn-group">
					<button class="btn dropdown-toggle" data-toggle="dropdown">Nova Lista <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#">Participantes</a></li>
						<li><a href="#">Serviço</a></li>
					</ul>
				</div>
			</div>
			<p class="obs">Este é o ônibus que sairá às 9:00 da manhã de segunda-feira</p>
			<table class="table table-condensed">
				<tbody>
					<tr><td>01</td><td></td><td></td><td><a href="#" class="icon-remove"></a></td></tr>
					<tr><td>02</td><td></td><td></td><td><a href="#" class="icon-remove"></a></td></tr>
					<?php for($i = 2; $i <= 49; $i++): ?><tr>
					<tr><td><?php printf("%02d",$i) ?></td><td></td><td></td><td><a href="#" class="icon-remove"></a></td></tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/html" id="template-reserva">
	<a class="onibus-alocado" href="" data-onibus="<%= this.nr_onibus %>"><span class="numero"><%= this.nr_onibus %></span><span class="vagas"><%= this.nr_pessoas %>/46</span></a>
</script>

<script type="text/html" id="template-busca">
	<tr>
		<td class="id-<%= this.cd_tipo %> status-<%= this.id_status %>"><%= this.id_pessoa %></td>
		<td><%= this.nm_pessoa %></td>
		<td><%= this.nr_rg %></td>
		<td><%= this.cd_tipo %></td>
		<td><%= this.nr_onibus %></td>
		<td><a href="#" class="icon-share-alt"></a></td>
	</tr>
</script>

<script type="text/javascript">

	//Usar Pub/Sub 
	function listar_onibus(){
		$.getJSON("onibus/listar_onibus", function(data, status){
			if(status === "success"){
				$("#onibus-reservados").html( $("#template-reserva").jqote(data) );
			}
		});
	}
	
	$(function(){
		listar_onibus();
		
		$('#buscar').click(function(event){
			$(this).button('loading');
			url = 'onibus/buscar_inscricao/'+$('#nome').val();
			
			checkstipo = $("#onibus-busca :checkbox[id*=tipo]:checked");
			if(checkstipo.length > 0){
				url += '/';
				checkstipo.each(function(index){
					url += this.value;
				});
			}else{
				url += '/psve';
			}

			checkstatus = $("#onibus-busca :checkbox[id*=status]:checked");
			if(checkstatus.length > 0){
				url += '/'+checkstatus.val();
			}else{
				url += '/0';
			}

			checkonibus = $("#onibus-busca :checkbox[id*=onibus]:checked");
			if(checkonibus.length > 0){
				url += '/'+checkonibus.val();
			}else{
				url += '/false';
			}
			
			$.getJSON(url, function(data, status){
				if(status === "success"){
					$("#onibus-busca > table").html( $("#template-busca").jqote(data) );
					$('#buscar').button('reset');
				}
			});
		});
	});
</script>