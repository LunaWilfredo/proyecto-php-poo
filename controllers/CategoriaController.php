<?php
require_once 'models/CategoriaModel.php';
require_once 'models/ProductoModel.php';

class categoriaController{

    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            // conseguir productos
            $producto = new Producto();
            $producto->setCategoriaId($id);
            $productos = $producto->getAllCategory(); 
      
        }
        require_once 'views/categoria/ver.php';
    }

    public function crear(){

        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
            //Guardar categoria en base de datos
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        header("Location:".base_url."categoria/index");
    }

    

}