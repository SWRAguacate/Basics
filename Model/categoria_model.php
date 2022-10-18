<?php

class categoria_model {

    private $db;
    private $categorias_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->categorias_model = array();
    }

    public function insertar_categoria($idUsuario, $nombre, $descripcion) {
        $sql = "call usp_categoria(:opc, :id_categoria_usp, :id_usuario_usp, :nombre_usp, :descripcion_usp, :fech_cre_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_categoria_usp" => null, ":id_usuario_usp" => $idUsuario, 
            ":nombre_usp" => $nombre, ":descripcion_usp" => $descripcion, ":fech_cre_usp" => null));
    }

    public function seleccionar_categoria($id) {
        $this->categorias_model = array();
        $sql = "call usp_categoria(:opc, :id_categoria_usp, :id_usuario_usp, :nombre_usp, :descripcion_usp, :fech_cre_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_categoria_usp" => $id, ":id_usuario_usp" => null, 
            ":nombre_usp" => null, ":descripcion_usp" => null, ":fech_cre_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias_model[] = $filas;
        }
        return $this->categorias_model;
    }

    public function editar_categoria($id, $idUsuario, $nombre, $descripcion) {
        $sql = "call usp_categoria(:opc, :id_categoria_usp, :id_usuario_usp, :nombre_usp, :descripcion_usp, :fech_cre_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_categoria_usp" => $id, ":id_usuario_usp" => $idUsuario, 
            ":nombre_usp" => $nombre, ":descripcion_usp" => $descripcion, ":fech_cre_usp" => null));
    }

    public function eliminar_categoria($id) {
        $sql = "call usp_categoria(:opc, :id_categoria_usp, :id_usuario_usp, :nombre_usp, :descripcion_usp, :fech_cre_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_categoria_usp" => $id, ":id_usuario_usp" => null, 
            ":nombre_usp" => null, ":descripcion_usp" => null, ":fech_cre_usp" => null));
    }

    public function ver_categorias() {
        $this->categorias_model = array();
        $sql = "call usp_categoria(:opc, :id_categoria_usp, :id_usuario_usp, :nombre_usp, :descripcion_usp, :fech_cre_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_categoria_usp" => null, ":id_usuario_usp" => null, 
            ":nombre_usp" => null, ":descripcion_usp" => null, ":fech_cre_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias_model[] = $filas;
        }
        return $this->categorias_model;
    }

}
