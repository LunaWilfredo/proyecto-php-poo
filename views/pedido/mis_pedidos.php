<?php if(isset($gestion)):?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>
<table class="tabla">
    <tr>
        <th>N° Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php 
    while($ped = $pedidos->fetch_object()):
    ?>
    <tr>
        <td><a href="<?=base_url?>pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a></td>
        <td>$/.<?=$ped->coste?></td>
        <td><?=$ped->fecha?></td>
        <td><?=Utils::showStatus($ped->estado)?><br>
</td>
    </tr>
    <?php endwhile; ?>
</table>