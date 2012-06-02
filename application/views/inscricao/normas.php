<div id="conteudo" class="container clearfix">
<div id="info">
<h2>Informações Gerais</h2>
<p>O <strong>Acampamento de Jovens Shalom</strong> é um evento promovido pelo <strong>Projeto Juventude para Jesus</strong> da <strong>Comunidade Católica Shalom</strong> que tem como objetivo a evangelização e uma opção sadia de lazer para a juventude. Contamos com uma intensa programação de atividades de lazer, cursos formativos e noites descontraídas de diversão.</p>
<p>A <strong><?php echo $edicao ?>&ordf; edição do Acamp's</strong> acontecerá dos dias <strong><?php echo $periodo ?></strong>, na <strong>fazenda Guarany em Pacajus</strong>, a 50km de Fortaleza.</p>
<?php if($tipo=='servico'): ?>
<p class="alert alert-block">Esta é uma <strong>pré-inscrição</strong>. Antes de pagar e concluir sua inscrição será necessária a <strong>aprovação do coordenador</strong> da equipe na qual você se inscrever.</p>
<?php endif; ?>
<p class="alert">Não deixe de ler atentamente<strong> TODAS </strong>as informações abaixo</p>
<h3>O que preciso para me inscrever?</h3>
<ul>
	<li>Você irá preencher seus dados no formulário da página a seguir, imprimir o boleto e pagar no estande do Acamp's, na rua Maria Tomásia, n&ordm; 72, Aldeota, Fortaleza, Ceará.</li>
	<li>Quem não se inscrever pela internet deve levar uma fotografia 3x4 recente (para o crachá).</li>
	<li>Apresentar a carteira de identidade ou certidão de nascimento do participante.</li>
	<li>Valor correspondente à taxa de inscrição.</li>
</ul>
<div class='alert alert-block alert-success'><p>O valor da inscrição é <strong>R$ <?php echo $valor ?></strong> (À vista ou cheque).</p>
<p>O prazo para se inscrever é até o dia <strong><?php echo $prazo_inscricao ?></strong>.</p></div>
<?php if($tipo=='participante'): ?>
<p class="alert">Só pode participar do Acamp's quem tem entre 14 e 28 anos!</p>
<?php endif; ?>
<h3>O que levar?</h3>
<ul>
	<li>Bíblia, caderno, caneta, terço, copo, prato e talheres;</li>
	<li>Barraca (opcional), lanterna, cadeado, colchonete, travesseiro, lençól;</li>
	<li>Trajes esportivos e de banho, tênis;</li>
	<li>Roupa para a missa (calça comprida);</li>
	<li>Toalha, sabonete, xampu, creme dental, escova de dente, protetor solar, repelente, etc.</li>
</ul>
<p class="alert alert-info">Marque seus objetos com seu nome.<p/>
<p class="alert">Não  leve objetos de valor (celular, câmera, jóias, etc.), pois não nos responsabilizamos por eventuais extravios.</p>

<h3>Saída</h3>

<p><strong>Local:</strong> Praça do Cristo Rei, Rua Nogueira Acioli, ao lado do Colégio Militar (Av. Santos Dumont)</p>

<p><strong>Data de saída: </strong><?php echo $inicio ?> às 14:00</p>

<p><strong>Data de retorno: </strong><?php echo $fim ?> às 18:30</p>

<h3>Normas</h3>
<ol>
	<li>Rapazes e moças ficarão em alojamento separados, em atividades comuns de lazer e formação.</li>
	<li>É proibido uso de bebidas alcoólicas ou qualquer tipo de drogas. A não observância dessa norma incorrerá na expulsão do infrator, <strong>sem devolução da taxa de inscrição</strong>, a mesma postura será usada para aqueles que por qualquer ato de vandalismo causarem algum dano a outro jovem ou a estrutura do evento.</li>
	<li><strong>O jovem ficará responsável por seus pertences pessoais </strong>(para a sua maior segurança, recomendamos que, permaneçam com sua bagagem trancada durante todo o evento).</li>
	<li>Em cada barraca haverá um(a) coordenador(a), que orientará os horários no decorrer do dia. Em qualquer necessidade, pode procurá-lo.</li>
	<li><strong>As visitas de pais e familiares serão permitidas apenas no último dia do Acampamento</strong>, <strong>durante a missa de encerramento</strong> (às 17h), para maior segurança dos participantes. No caso de aniversário do participante, ou outra necessidade, a família deve entrar em contato com a coordenação para viabilizar visita durante o evento.</li>
	<li>Pessoas com patologias como renites, asma, alergias, etc, devem levar seus próprios medicamentos, acompanhados de receita médica. <strong>Haverá um ambulatório para atendimento</strong>.</li>
	<li>A manutenção da ordem interna do acampamento exige dos participantes o cumprimento destas normas. Caso o participante não colabore com a organização, será chamado atenção; havendo reincidência o mesmo <strong>será desligado do evento, sem devolução da taxa de inscrição</strong>.</li>
	<li>É proibido o uso de cigarro nas dependências do clube e do açude, bem como a ingestão de bebidas alcoólicas; o não cumprimento destas regras resultará no <strong>desligamento do participante</strong> <strong>sem devolução de taxa de inscrição</strong>.</li>
	<li>Em caso de desistência por parte do participante, <strong>não haverá reembolso da taxa de inscrição</strong>.</li>
	<li>Para maior segurança e melhor andamento do evento não é permitido o uso de aparelhos celulares. <strong>Haverá telefone de plantão</strong> para eventuais necessidades.</li>
	<li>PLANTÃO DE INFORMAÇÃO durante o evento: (085) 8690 1014, 8661 1319, 8846 6951, 8821 3015.</li>
	<li>A Rádio Shalom AM 690 trará irformações diariamente.</li>
</ol>
<p align="center"><?php echo anchor('/inscricao/'.$tipo, 'Continuar Inscrição &raquo;', array('class'=>'btn btn-primary btn-large', 'id'=>'continuar'))//echo anchor('/inscricao/buscarinscricao/'.$tipo, 'Continuar Inscrição &raquo;') ?></p>
</div>
</div>