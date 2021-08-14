<?php

require_once 'models/UsuarioModel.php';

class usuarioController{

    public function index(){
        echo "Controlador usuario , accion index";
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){
        if($_POST){

            $nombre = isset($_POST['nombre'])?$_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos'])?$_POST['apellidos'] : false;
            $email = isset($_POST['email'])?$_POST['email'] : false;
            $password = isset($_POST['password'])?$_POST['password'] : false;

            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
            
                $save = $usuario->save();
                if($save){
                    $_SESSION['register'] = "Complete";
                }else{
                    $_SESSION['register'] = "Failed";
                }
            }else{
                $_SESSION['register'] = "Failed";
            }    
        }else{
            $_SESSION['register'] = "Failed";
        }
        header("Location:".base_url.'usuario/registro');
    }

    public function Login(){
        if(isset($_POST)){
            //Identificar al usuario
            //consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();
            ////crear sesion
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;

                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = "Identificacion Fallida";
            }

        }
        header("Location:".base_url);
    }


    public function Logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".base_url);
    }

}//Fin Clase