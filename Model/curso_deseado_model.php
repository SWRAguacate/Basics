<?php

class curso_deseado_model {

    private $db;
    private $cursos_deseados_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->cursos_deseados_model = array();
    }

    public function insertar_curso_deseado($id_curso, $id_alumno, $id_fase, $forma_pago, $monto) {
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":forma_pago_usp" => $forma_pago, ":monto_usp" => $monto));
    }

    public function seleccionar_fase_curso_deseado($id_curso, $id_alumno, $id_fase) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":forma_pago_usp" => null, ":monto_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }

    public function editar_curso_deseado($id_curso, $id_alumno, $id_fase, $forma_pago, $monto) {
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":forma_pago_usp" => $forma_pago, ":monto_usp" => $monto));
    }

    public function adquiere_fase($id_curso, $id_alumno, $id_fase, $id_fp) {
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "adquiere_fase", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":forma_pago_usp" => $id_fp, ":monto_usp" => null));
    }
    
    public function vacia_carrito($id_curso, $id_alumno, $id_fase) {
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "borrar_fase", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => $id_fase, ":forma_pago_usp" => null, ":monto_usp" => null));
    }
    
    public function agrega_curso_carrito($id_curso, $id_alumno) {
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "enlista_curso", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_alumno, 
            ":id_fase_usp" => 1, ":forma_pago_usp" => 1, ":monto_usp" => 0.00));
    }

    public function ver_adquisiciones_curso($id_curso) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => null, 
            ":id_fase_usp" => null, ":forma_pago_usp" => null, ":monto_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
    
    public function ver_curso_adquirido($id_curso, $id_usu) {
        $this->cursos_deseados_model = array();
        $sql = "call usp_curso_deseado(:opc, :id_curso_usp, :id_usuario_usp, :id_fase_usp, :forma_pago_usp, :monto_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_fases", ":id_curso_usp" => $id_curso, ":id_usuario_usp" => $id_usu, 
            ":id_fase_usp" => null, ":forma_pago_usp" => null, ":monto_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_deseados_model[] = $filas;
        }
        return $this->cursos_deseados_model;
    }
    
}