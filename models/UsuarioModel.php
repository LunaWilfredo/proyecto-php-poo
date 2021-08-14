<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getApellidos(){
        return $this->apellidos;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }
    function getRol(){
        return $this->rol;
    }
    function getImagen(){
        return $this->imagen;
    }
    

    function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }
    function setNombre($nombre){
       $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    function setPassword($password){
        $this->password = $password;
    }
    function setRol($rol){
        $this->rol = $this->db->real_escape_string($rol);
    }
    function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function save(){
        $sql="INSERT INTO usuarios VALUES (null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user','{$this->getImagen()}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function Login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        //Comprobar si existe usuario
        $sql = "SELECT * FROM  usuarios WHERE email = '$email';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows ==1){
            $usuario = $login->fetch_object();

            //verificar contraseña
            $verify = password_verify($password,$usuario->clave);
            
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
        
        
    }


}