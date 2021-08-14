<?php if(isset($edit) && isset($pro) && is_object($pro)):?>
    <h1>Update Product <?=$pro->nombre?> </h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id;?>
<?php else: ?>
    <h1>Create new Product</h1>
    <?php $url_action = base_url."producto/save";?>
<?php endif;?>

<div class="form-container">

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

    <label for="name">Product name</label>
    <input type="text" name="name" value="<?=isset($pro) && is_object($pro)?$pro->nombre : ''?> ">

    <label for="description">Description</label>
    <textarea name="description" cols="30" rows="10"><?=isset($pro) && is_object($pro)?$pro->descripcion:''?></textarea>

    <label for="price">Price</label>
    <input type="text" name="price" value="<?=isset($pro) && is_object($pro)?$pro->precio:''?>">

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=isset($pro) && is_object($pro)?$pro->stock:''?>">

    <label for="category">Category</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="category">
        <?php while($cat = $categorias->fetch_object()):?>
        <option value="<?=$cat->id?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ?'SELECTED':''?>><?=$cat->nombre?></option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen</label>
    <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
        <img src="<?=base_url?>/upload/images/<?=$pro->imagen?>" class="thumb"/>
    <?php endif;?>
    <input type="file" name="imagen" >

    <input type="submit" value="Guardar">

</form>

</div>