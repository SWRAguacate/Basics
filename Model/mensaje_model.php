<?php

class mensaje_model {

    private $db;
    private $mensajes_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->mensajes_model = array();
    }

    public function insertar_mensaje($id_usuario1, $id_usuario2, $mensaje) {
        $sql = "call usp_mensaje(:opc, :id_usuario1_usp, :id_usuario2_usp, :mensaje_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_usuario1_usp" => $id_usuario1, ":id_usuario2_usp" => $id_usuario2, 
            ":mensaje_usp" => $mensaje, ":fech_salida_usp" => null));
    }

    public function seleccionar_mensaje($id_usuario1, $id_usuario2, $fecha) {
        $this->mensajes_model = array();
        $sql = "call usp_mensaje(:opc, :id_usuario1_usp, :id_usuario2_usp, :mensaje_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_usuario1_usp" => $id_usuario1, ":id_usuario2_usp" => $id_usuario2, 
            ":mensaje_usp" => null, ":fech_salida_usp" => $fecha));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->mensajes_model[] = $filas;
        }
        return $this->mensajes_model;
    }

    public function editar_mensaje($id_usuario1, $id_usuario2, $mensaje, $fecha) {
        $sql = "call usp_mensaje(:opc, :id_usuario1_usp, :id_usuario2_usp, :mensaje_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_usuario1_usp" => $id_usuario1, ":id_usuario2_usp" => $id_usuario2, 
            ":mensaje_usp" => $mensaje, ":fech_salida_usp" => $fecha));
    }

    public function eliminar_mensaje($id_usuario1, $id_usuario2, $fecha) {
        $sql = "call usp_mensaje(:opc, :id_usuario1_usp, :id_usuario2_usp, :mensaje_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_usuario1_usp" => $id_usuario1, ":id_usuario2_usp" => $id_usuario2, 
            ":mensaje_usp" => null, ":fech_salida_usp" => $fecha));
    }

    public function ver_mensajes() {
        $this->mensajes_model = array();
        $sql = "call usp_mensaje(:opc, :id_usuario1_usp, :id_usuario2_usp, :mensaje_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_usuario1_usp" => null, ":id_usuario2_usp" => null, 
            ":mensaje_usp" => null, ":fech_salida_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->mensajes_model[] = $filas;
        }
        return $this->mensajes_model;
    }

}
