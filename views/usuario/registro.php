<h1>Registro</h1>
<?php if(isset($_SESSION['register'])&& $_SESSION['register']='complete'):?>
    <strong class="alert_green">Registro Completado correctamente</strong>
<?php elseif(isset($_SESSION['register'])&& $_SESSION['register']='failed'):?>
    <strong class="alert_red">Registro Fallido, Introduce bien los datos</strong>
<?php endif; ?>
<?php  Utils::deleteSession('register'); ?>
<form action="<?=base_url?>usuario/save" method="post">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" required>

    <label for="email">Email</label>
    <input type="text" name="email" required>

    <label for="password">Password</label>
    <input type="text" name="password" required>
    
    <input type="submit" value="Registrar">
</form>