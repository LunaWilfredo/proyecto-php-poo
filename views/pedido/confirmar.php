<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] =="complete"):?>
    <h1 class="">Pedido confirmado</h1>
    <p class="">agardecemos por tu confianza , el pedido realizado ha sido guardado de manerra exitosa </p>
    <p class="">Una vez realizada la transferencia bancaria , el producto sera procesado y enviado.</p>
    <br>
    <?php if(isset($pedido)): ?>
        <h3 class="">Datos de Pedido</h3>
        <br>
        Numero de pedido: <?=$pedido->id?>
        <br>
        Total a Pagar ($.):  <?=$pedido->coste?>
        <br>
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
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] !="complete"): ?>
    <h1 class="">Pedido no realizado Exitosamente</h1>
<?php endif; ?>