<?php

class contenido_model {

    private $db;
    private $contenidos_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->contenidos_model = array();
    }

    public function insertar_contenido($id_curso, $id_fase, $nombre, $instrucciones, $archivo) {
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_contenido_usp" => null, ":id_curso_usp" => $id_curso, ":id_fase_usp" => $id_fase,
            ":nombre_usp" => $nombre, ":instrucciones_usp" => $instrucciones, ":archivo_usp" => $archivo));
    }

    public function seleccionar_contenido($id) {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_contenido_usp" => $id, ":id_curso_usp" => null, ":id_fase_usp" => null,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }

    public function editar_contenido($id, $id_curso, $id_fase, $nombre, $instrucciones, $archivo) {
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_contenido_usp" => $id, ":id_curso_usp" => $id_curso, ":id_fase_usp" => $id_fase,
            ":nombre_usp" => $nombre, ":instrucciones_usp" => $instrucciones, ":archivo_usp" => $archivo));
    }

    public function ver_contenidos_fase($id_fase) {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_cont_fase", ":id_contenido_usp" => null, ":id_curso_usp" => null, ":id_fase_usp" => $id_fase,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }

    public function ver_contenidos() {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_todo", ":id_contenido_usp" => null, ":id_curso_usp" => null, ":id_fase_usp" => null,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }
    
    public function id_primer_contenido($id_fase) {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "id_primer_cont", ":id_contenido_usp" => null, ":id_curso_usp" => null, ":id_fase_usp" => $id_fase,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }
    
    public function id_ultimo_contenido($id_cur) {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "id_ult_cont", ":id_contenido_usp" => null, ":id_curso_usp" => $id_cur, ":id_fase_usp" => null,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }
    
    public function url_contenido($id_contenido, $id_usu) {
        $this->contenidos_model = array();
        $sql = "call usp_contenido(:opc, :id_contenido_usp, :id_curso_usp, :id_fase_usp, :nombre_usp, :instrucciones_usp, :archivo_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "url_contenido", ":id_contenido_usp" => $id_contenido, ":id_curso_usp" => $id_usu, ":id_fase_usp" => null,
            ":nombre_usp" => null, ":instrucciones_usp" => null, ":archivo_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->contenidos_model[] = $filas;
        }
        return $this->contenidos_model;
    }

}