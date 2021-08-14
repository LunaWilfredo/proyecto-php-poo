<?php if(isset($_SESSION['identity'])): ?>
    <h1>Realizae Pedido</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Detalles del pedido</a>
    </p>
    <br>
    <h3>Domicilio para envio</h3>
    <form action="<?=base_url.'pedido/add'?>" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" placeholder="Ingresar provincia" required/>

        <label for="provincia">Ciudad</label>
        <input type="text" name="localidad" placeholder="Ingresar ciudad" required/>

        <label for="provincia">Direccion</label>
        <input type="text" name="direccion" placeholder="Ingresar direccion" required/>

        <input type="submit" value="Confirmar Pedido">
    </form>
<?php else: ?>
    <h1>Necesitar iniciar Sesion</h1>
    <p>Debes estar  con sesion iniciada en la web apra poder realizar la compra</p>
<?php endif; ?>