<?php

class curso_model {

    private $db;
    private $cursos_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->cursos_model = array();
    }
    
    public function siguiente_id() {
        $this->cursos_model = array();
        $sql = "select auto_increment from  information_schema.tables where table_schema = 'id17896900_basics' and table_name   = 'curso'";
        $result = $this->db->prepare($sql);
        $result->execute();
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }

    public function insertar_curso($id_maestro, $titulo, $descripcion, $imagen, $precio, $tipo) {
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_curso_usp" => null, ":id_usuario_usp" => $id_maestro, ":titulo_usp" => $titulo,
            ":descripcion_usp" => $descripcion, ":imagen_usp" => $imagen, ":precio_usp" => $precio, ":tipo_usp" => $tipo, ":fecha_usp" => null, ":estatus_usp" => 1));
    }

    public function seleccionar_curso($id) {
        $this->cursos_model = array();
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar", ":id_curso_usp" => $id, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }

    public function editar_curso($id, $id_maestro, $titulo, $descripcion, $imagen, $precio, $tipo, $estatus) {
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_curso_usp" => $id, ":id_usuario_usp" => $id_maestro, ":titulo_usp" => $titulo,
            ":descripcion_usp" => $descripcion, ":imagen_usp" => $imagen, ":precio_usp" => $precio, ":tipo_usp" => $tipo, ":fecha_usp" => null, ":estatus_usp" => $estatus));
    }

    public function eliminar_curso($id) {
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_curso_usp" => $id, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
    }

    public function ver_cursos_activos() {
        $this->cursos_model = array();
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_activos", ":id_curso_usp" => null, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }
    
    public function seleccionar_contenidos_curso($id) {
        $this->cursos_model = array();
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cont_curso", ":id_curso_usp" => $id, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }
    
    public function seleccionar_categorias_curso($id) {
        $this->cursos_model = array();
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cats_curso", ":id_curso_usp" => $id, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }
    
    public function seleccionar_fases_curso($id) {
        $this->cursos_model = array();
        $sql = "call usp_curso(:opc, :id_curso_usp, :id_usuario_usp, :titulo_usp, :descripcion_usp, :imagen_usp, :precio_usp, :tipo_usp, :fecha_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "fases_curso", ":id_curso_usp" => $id, ":id_usuario_usp" => null, ":titulo_usp" => null,
            ":descripcion_usp" => null, ":imagen_usp" => null, ":precio_usp" => null, ":tipo_usp" => null, ":fecha_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_model[] = $filas;
        }
        return $this->cursos_model;
    }

}
