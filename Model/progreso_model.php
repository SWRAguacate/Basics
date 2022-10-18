<?php

class progreso_model {

    private $db;
    private $progresos_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->progresos_model = array();
    }

    public function insertar_progreso($id_curso, $id_alumno, $id_fase) {
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":finalizado_usp" => null));
    }

    public function seleccionar_progreso($id_curso, $id_alumno, $id_fase) {
        $this->progresos_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->progresos_model[] = $filas;
        }
        return $this->progresos_model;
    }

    public function editar_progreso($id, $id_curso, $id_alumno, $id_fase, $estatus) {
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_usp" => $id, ":id_curso_usp" => $id_curso, ":id_alumno_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":estatus_usp" => $estatus));
    }

    public function ver_progresos_curso($id_curso) {
        $this->progresos_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => null, 
            ":id_fase_usp" => null, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->progresos_model[] = $filas;
        }
        return $this->progresos_model;
    }
    
    public function finaliza_fase($id_alumno, $id_fase) {
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "fin_fase", ":id_curso_usp" => null, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":finalizado_usp" => null));
    }
    
    public function id_primer_fase($id_curso, $id_usu) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "id_primer_fase", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usu, 
            ":id_fase_usp" => null, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
    
    public function total_fases($id_curso) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "tot_fases", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => null, 
            ":id_fase_usp" => null, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
    
    public function total_progresos_finalizados($id_curso, $id_usu) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "tot_fin", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usu, 
            ":id_fase_usp" => null, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
    
    public function total_progresos($id_curso, $id_usu) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_progreso(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :finalizado_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "tot_progresos", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usu, 
            ":id_fase_usp" => null, ":finalizado_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
}