<h1>Gestion de productos</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">New Product</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] = "Complete"): ?>
    <strong class="alert_green">Producto Creado Correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != "Complete"): ?>
    <strong class="alert_red">Error de Creado de Producto </strong>
<?php endif;?>
<?php Utils::deleteSession('producto'); ?>
<!-- DELETE -->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] = "Complete"): ?>
    <strong class="alert_green">Producto Eliminado Correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != "Complete"): ?>
    <strong class="alert_red">Error de Eliminado de Producto </strong>
<?php endif;?>
<?php Utils::deleteSession('delete'); ?>

<!-- TABLA DE CONTENIDO -->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>

    </tr>
<?php while($pro = $productos->fetch_object()): ?>
   </tr>
        <td><?=$pro->id?></td> 
        <td><?=$pro->nombre?></td>
        <td><?=$pro->precio?></td>
        <td><?=$pro->stock?></td>
        <td>
            <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
            <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-red">Eliminar</a>
        </td>
   <tr>
<?php endwhile; ?>
</table>