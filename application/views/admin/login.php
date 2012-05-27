<div id="login">
    <?php echo form_open('admin/login'); ?>
    <?php echo form_label('Login','nm_usuario'); ?>
    <p>
    <?php echo form_input(array(
        'name'        => 'nm_usuario',
        'id'          => 'nm_usuario',
        'maxlength'   => '20'
    )); ?>
    </p>
    <?php echo form_label('Senha','pw_usuario'); ?>
    <p>
    <?php echo form_password(array(
        'name'        => 'pw_usuario',
        'id'          => 'pw_usuario',
        'maxlength'   => '20'
    )); ?>
    </p>
    <p align="center">
    <?php echo form_submit('login', 'Login', 'class="btn"'); ?>
    </p>
    <?php echo form_close(); ?>
</div>
<?php if(isset($erro) && $erro==true): ?>
	<div id="erro">
		<p>Usuário ou senha inválidos.</p>
	</div>
<?php endif; ?>