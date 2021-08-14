<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    function getId(){
        return $this->id;
    }
    function getUsuarioId(){
        return $this->usuario_id;
    }
    function getProvincia(){
        return $this->provincia;
    }
    function getLocalidad(){
        return $this->localidad;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getCoste(){
        return $this->coste;
    }
    function getEstado(){
        return $this->estado;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getHora(){
        return $this->hora;
    }
    // SETTER
    function setId($id){
        $this->id = $id;
    }
    function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }
    function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }
    function setCoste($coste){
        $this->coste = $coste;
    }
    function setEstado($estado){
        $this->estado = $estado;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setHora($hora){
        $this->hora = $hora;
    }

    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne(){
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
        $productos = $this->db->query($sql);
        return $productos->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id,p.coste FROM pedidos p "
        // ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
        ."WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getProductosByPedido($id){
        $sql="SELECT pr.*,lp.unidades FROM productos pr "
        ."INNER JOIN lineas_pedidos lp ON pr.id=lp.producto_id "
        ."WHERE lp.pedido_id={$id};";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL,'{$this->getUsuarioId()}','{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME());";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        $sql="SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
            $save = $this->db->query($insert);
        };

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
        // ."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
        ."WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC;";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function updateOne(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}'";
        $sql.="WHERE id={$this->getId()};";
        
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }


}