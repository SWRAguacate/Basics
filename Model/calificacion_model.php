<?php

class calificacion_model {

    private $db;
    private $calificaciones_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->calificaciones_model = array();
    }

    public function insertar_calificacion($id_curso, $id_alumno, $like_dislike) {
        $sql = "call usp_calificacion(:opc, :id_curso_usp, :id_usuario_usp, :like_dislike_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_curso_usp" => $id_curso, 
            ":id_usuario_usp" => $id_alumno,  ":like_dislike_usp" => $like_dislike));
    }

    public function seleccionar_calificacion($id_curso, $id_alumno, $calif) {
        $this->calificaciones_model = array();
        $sql = "call usp_calificacion(:opc, :id_curso_usp, :id_usuario_usp, :like_dislike_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_curso_usp" => $id_curso, 
            ":id_usuario_usp" => $id_alumno,  ":like_dislike_usp" => $calif));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->calificaciones_model[] = $filas;
        }
        return $this->calificaciones_model;
    }

    public function eliminar_calificacion($id_curso, $id_alumno) {
        $sql = "call usp_calificacion(:opc, :id_curso_usp, :id_usuario_usp, :like_dislike_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_curso_usp" => $id_curso, 
            ":id_usuario_usp" => $id_alumno,  ":like_dislike_usp" => null));
    }

    public function ver_calificaciones_curso($id_curso) {
        $this->calificaciones_model = array();
        $sql = "call usp_calificacion(:opc, :id_curso_usp, :id_usuario_usp, :like_dislike_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_curso_usp" => $id_curso, 
            ":id_usuario_usp" => null,  ":like_dislike_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->calificaciones_model[] = $filas;
        }
        return $this->calificaciones_model;
    }
    
}
