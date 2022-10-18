<?php

class forma_pago_model {

    private $db;
    private $formas_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->formas_model = array();
    }

    public function insertar_forma_pago($nombre, $descripcion) {
        $sql = "call usp_forma_pago(:opc, :id_fp_usp, :nombre_usp, :descripcion_usp, :fecha_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_fp_usp" => null, ":nombre_usp" => $nombre, 
            ":descripcion_usp" => $descripcion, ":fecha_usp" => null));
    }

    public function seleccionar_forma_pago($id) {
        $this->formas_model = array();
        $sql = "call usp_forma_pago(:opc, :id_fp_usp, :nombre_usp, :descripcion_usp, :fecha_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_fp_usp" => $id, ":nombre_usp" => null, 
            ":descripcion_usp" => null, ":fecha_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->formas_model[] = $filas;
        }
        return $this->formas_model;
    }

    public function editar_forma_pago($id, $nombre, $descripcion) {
        $sql = "call usp_forma_pago(:opc, :id_fp_usp, :nombre_usp, :descripcion_usp, :fecha_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_fp_usp" => $id, ":nombre_usp" => $nombre, 
            ":descripcion_usp" => $descripcion, ":fecha_usp" => null));
    }

    public function eliminar_forma_pago($id) {
        $sql = "call usp_forma_pago(:opc, :id_fp_usp, :nombre_usp, :descripcion_usp, :fecha_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_fp_usp" => $id, ":nombre_usp" => null, 
            ":descripcion_usp" => null, ":fecha_usp" => null));
    }

    public function ver_formas_pago() {
        $this->formas_model = array();
        $sql = "call usp_forma_pago(:opc, :id_fp_usp, :nombre_usp, :descripcion_usp, :fecha_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_fp_usp" => null, ":nombre_usp" => null, 
            ":descripcion_usp" => null, ":fecha_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->formas_model[] = $filas;
        }
        return $this->formas_model;
    }

}
