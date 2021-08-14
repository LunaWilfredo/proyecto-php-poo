<h1 class="">Detalles del Pedido</h1>

<?php if(isset($pedido)): ?>
    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar Estado de Pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="Post">
            <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
            <select name="estado">
                <option value="confirm" <?=$pedido->estado == 'confirm' ? 'selected':'';?>>Pendiente</option>
                <option value="preparation" <?=$pedido->estado == 'preparation' ? 'selected':'';?>>En preparacion</option>
                <option value="ready" <?=$pedido->estado == 'ready' ? 'selected':'';?>>En proceso de envio</option>
                <option value="sended" <?=$pedido->estado == 'sended' ? 'selected':'';?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif;?>

        <h3 class="">Direccion de envio</h3>
        Provincia: <?=$pedido->provincia?><br>
        Ciudad:  <?=$pedido->localidad?><br>
        Direccion: <?=$pedido->direccion?><br>

        <h3 class="">Datos de Pedido</h3>
        Numero de pedido: <?=$pedido->id?><br>
        Estado: <?=Utils::showStatus($pedido->estado)?><br>
        Total a Pagar ($.):  <?=$pedido->coste?><br>

        Productos:
        <table>
            <tr>
                <th>Imagen de Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>unidades</th>
            </tr>
            <?php while($producto = $productos->fetch_object()):?>
                <tr>
                    <td>
                    <?php if($producto->imagen != null): ?>
                            <img src="<?=base_url?>upload/images/<?=$producto->imagen?>" class="img_carrito"/>
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito"/>
                        <?php endif; ?>
                    </td>
                    <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
                    <td><?=$producto->precio?></td>
                    <td><?=$producto->unidades;?></td>
                </tr>
            <?php endwhile;?>
        </table>
    <?php endif; ?>