<?php

require_once 'models/productoModel.php';

class productoController{

    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        //Renderizar vista
        require_once 'views/producto/destacados.php';
    }

    public function gestion(){
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once 'views/producto/gestion.php';

    }

    public function crear(){
        Utils::isAdmin();

        require_once 'views/producto/crear.php';
    }

    public function save(){
        if(isset($_POST)){

            $nombre = isset($_POST['name'])?$_POST['name'] : false;
            $descripcion = isset($_POST['description'])?$_POST['description'] : false;
            $precio = isset($_POST['price'])?$_POST['price'] : false;
            $stock = isset($_POST['stock'])?$_POST['stock'] : false;
            $categoria = isset($_POST['category'])?$_POST['category'] : false;

            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);

                //Guardar la imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $file_name = $file['name'];
                    $mimetype = $file['type'];
            
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/git"){

                        if(!is_dir('upload/images')){
                        mkdir('upload/images',0777,true);
                        }
                        move_uploaded_file($file['tmp_name'],'upload/images/'.$file_name);
                        $producto->setImagen($file_name);
                    }
                }

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $producto->setId($id);
                    
                    $save = $producto->edit();
                }else{
                    $save = $producto->save();
                }

                if($save){
                $_SESSION['producto'] = "Complete";
                }else{
                $_SESSION['producto'] = "Failled";
                }
                
            }else{
                $_SESSION['producto'] = "Failled";
            }
   
        }else{
                $_SESSION['producto'] = "Failled";
        }
        header("Location:".base_url."producto/gestion");
    }

    public function editar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        }else{
            header("Location:".base_url."producto/gestion");
        }
    }

    public function eliminar(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto ->setId($id);
            $delete = $producto->delete();

            if($delete){
                $_SESSION['delete'] = "Complete";
            }else{
                $_SESSION['delete'] = "Failled";
            }
        }else{
            $_SESSION['delete'] = "Failled";
        }
        header("Location:".base_url."producto/gestion");
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);

            $product = $producto->getOne();

        }
            require_once 'views/producto/ver.php';
        
    }

}