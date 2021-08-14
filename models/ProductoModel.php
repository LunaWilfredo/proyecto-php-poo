<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    function getId(){
        return $this->id;
    }
    function getCategoriaId(){
        return $this->categoria_id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getStock(){
        return $this->stock;
    }
    function getOferta(){
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }

    function setId($id){
        $this->id = $id;
    }
    function setCategoriaId($categoria_id){
        $this->categoria_id = $categoria_id;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio = $precio;
    }
    function setStock($stock){
        $this->stock = $stock;
    }
    function setOferta($oferta){
        $this->oferta = $oferta;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getAll(){
        $sql = "SELECT * FROM productos ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllCategory(){
        $sql ="SELECT * FROM productos  WHERE categoria_id ='{$this->getCategoriaId()}'; ";
        $productos = $this->db->query($sql);
        return $productos;
    }


    public function getRandom($limit){
        $sql="SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $productos = $this->db->query($sql);
        return $productos;
    }


    public function getOne(){
        $sql = "SELECT * FROM productos WHERE id = {$this->getId()};";
        $productos = $this->db->query($sql);
        return $productos->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO productos VALUES(NULL,'{$this->getCategoriaId()}','{$this->getNombre()}','{$this->getDescripcion()}','{$this->getPrecio()}','{$this->getStock()}',NULL,CURDATE(),'{$this->getImagen()}');";
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql="DELETE FROM productos WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE productos SET categoria_id='{$this->getCategoriaId()}',nombre='{$this->getNombre()}',descripcion ='{$this->getDescripcion()}',precio='{$this->getPrecio()}',stock='{$this->getStock()}'";

        if($this->getImagen() != null){
            $sql.=",imagen='{$this->getImagen()}'";
        }

        $sql.="WHERE id={$this->id};";
        
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }



}