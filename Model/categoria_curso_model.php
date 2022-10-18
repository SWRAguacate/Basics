<?php

class categoria_curso_model {

    private $db;
    private $categorias_curso_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->categorias_curso_model = array();
    }

    public function insertar_categoria_curso($id_categoria, $id_curso) {
        $sql = "call usp_categoria_curso(:opc, :id_categoria_usp, :id_curso_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_categoria_usp" => $id_categoria, ":id_curso_usp" => $id_curso));
    }

    public function seleccionar_categorias_curso($id) {
        $this->categorias_curso_model = array();
        $sql = "call usp_categoria_curso(:opc, :id_categoria_usp, :id_curso_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_cur", ":id_categoria_usp" => null, ":id_curso_usp" => $id));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias_curso_model[] = $filas;
        }
        return $this->categorias_curso_model;
    }

    public function eliminar_categoria_curso($id_categoria, $id_curso) {
        $sql = "call usp_categoria_curso(:opc, :id_categoria_usp, :id_curso_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_categoria_usp" => $id_categoria, ":id_curso_usp" => $id_curso));
    }

    public function ver_categorias_cursos() {
        $this->categorias_curso_model = array();
        $sql = "call usp_categoria_curso(:opc, :id_categoria_usp, :id_curso_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_categoria_usp" => null, ":id_curso_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias_curso_model[] = $filas;
        }
        return $this->categorias_curso_model;
    }

}
