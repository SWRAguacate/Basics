<?php

class comentario_model {

    private $db;
    private $comentarios_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->comentarios_model = array();
    }

    public function insertar_comentario($id_curso, $id_usuario, $comentario) {
        $sql = "call usp_comentario(:opc, :id_curso_usp, :id_usuario_usp, :comentario_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usuario, 
            ":comentario_usp" => $comentario, ":fech_salida_usp" => null));
    }

    public function seleccionar_comentario($id_curso, $id_usuario, $fecha) {
        $this->comentarios_model = array();
        $sql = "call usp_comentario(:opc, :id_curso_usp, :id_usuario_usp, :comentario_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usuario, 
            ":comentario_usp" => null, ":fech_salida_usp" => $fecha));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->comentarios_model[] = $filas;
        }
        return $this->comentarios_model;
    }

    public function editar_comentario($id_curso, $id_usuario, $comentario, $fecha) {
        $sql = "call usp_comentario(:opc, :id_curso_usp, :id_usuario_usp, :comentario_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usuario, 
            ":comentario_usp" => $comentario, ":fech_salida_usp" => $fecha));
    }

    public function eliminar_comentario($id_curso, $id_usuario, $fecha) {
        $sql = "call usp_comentario(:opc, :id_curso_usp, :id_usuario_usp, :comentario_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usuario, 
            ":comentario_usp" => null, ":fech_salida_usp" => $fecha));
    }

    public function ver_comentarios() {
        $this->comentarios_model = array();
        $sql = "call usp_comentario(:opc, :id_curso_usp, :id_usuario_usp, :comentario_usp, :fech_salida_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_curso_usp" => null, ":id_usuario_usp" => null, 
            ":comentario_usp" => null, ":fech_salida_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->comentarios_model[] = $filas;
        }
        return $this->comentarios_model;
    }

}
