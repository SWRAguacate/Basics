<?php

class fase_model {

    private $db;
    private $fases_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->fases_model = array();
    }
    
    public function siguiente_id() {
        $this->cursos_model = array();
        $sql = "select auto_increment from  information_schema.tables where table_schema = 'id17896900_basics' and table_name   = 'fase'";
        $result = $this->db->prepare($sql);
        $result->execute();
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }

    public function insertar_fase($id_curso, $nombre, $descripcion, $monto, $tipo) {
        $sql = "call usp_fase(:opc, :id_fase_usp, :id_curso_usp, :nombre_usp, :descripcion_usp, :monto_usp, :tipo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_fase_usp" => null, ":id_curso_usp" => $id_curso, 
            ":nombre_usp" => $nombre, ":descripcion_usp" => $descripcion, ":monto_usp" => $monto, ":tipo_usp" => $tipo));
    }

    public function seleccionar_fase($id_fase) {
        $this->fases_model = array();
        $sql = "call usp_fase(:opc, :id_fase_usp, :id_curso_usp, :nombre_usp, :descripcion_usp, :monto_usp, :tipo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_fase_usp" => $id_fase, ":id_curso_usp" => null, 
            ":nombre_usp" => null, ":descripcion_usp" => null, ":monto_usp" => null, ":tipo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->fases_model[] = $filas;
        }
        return $this->fases_model;
    }

    public function editar_fase($id_fase, $id_curso, $nombre, $descripcion, $monto, $tipo) {
        $sql = "call usp_fase(:opc, :id_fase_usp, :id_curso_usp, :nombre_usp, :descripcion_usp, :monto_usp, :tipo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_fase_usp" => $id_fase, ":id_curso_usp" => $id_curso, 
            ":nombre_usp" => $nombre, ":descripcion_usp" => $descripcion, ":monto_usp" => $monto, ":tipo_usp" => $tipo));
    }

    public function ver_fases_activas() {
        $this->fases_model = array();
        $sql = "call usp_fase(:opc, :id_fase_usp, :id_curso_usp, :nombre_usp, :descripcion_usp, :monto_usp, :tipo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_fase_usp" => null, ":id_curso_usp" => null, 
            ":nombre_usp" => null, ":descripcion_usp" => null, ":monto_usp" => null, ":tipo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->fases_model[] = $filas;
        }
        return $this->fases_model;
    }

}
