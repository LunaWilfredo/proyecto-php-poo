<?php

require_once 'models/PedidosModel.php';

class pedidoController{

    public function hacer(){
        
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id=$_SESSION['identity']->id;
            $provincia = isset($_POST['provincia'])?$_POST['provincia']: false;
            $localidad = isset($_POST['localidad'])?$_POST['localidad']: false;
            $direccion = isset($_POST['direccion'])?$_POST['direccion']: false;
            // FUNCION ESTATICA
            $stats=Utils::statsCarrito();
            $coste = $stats['total'];

            if( $provincia && $localidad && $direccion){
                // guardar pedido en db
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save=$pedido->save();

                //Guardar linea pedido
                $save_linea=$pedido->save_linea();

                if($save && $save_linea){
                    $_SESSION['pedido'] = 'complete';
                }else{
                    $_SESSION['pedido'] = 'failed';
                }   
            }else{
                $_SESSION['pedido'] = 'failed';
            }

            header('location:'.base_url.'pedido/confirmado');

        }else{
            // Redireccionar a index
            header('location:'.base_url);
        }
    }

    public function confirmado(){

        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido=new Pedido();
            $pedido->setUsuarioId($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }

        require_once 'views/pedido/confirmar.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        // Sacar los pedidos del usuario
        $pedido->setUsuarioId($usuario_id);
        $pedidos=$pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){
            $id=$_GET['id'];

            // Sacar datos de pedido
            $pedido=new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            // Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once 'views/pedido/detalle.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        header('Location:'.base_url.'pedido/mis_pedidos');
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            // Recoleccion de datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //Update del Pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->updateOne();

            header("Location:".base_url.'pedido/detalle&id='.$id);
        }else{
            header("Location:".base_url);
        }

    }

}