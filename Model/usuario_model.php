<?php

class usuario_model {

    private $db;
    private $usuarios_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->usuarios_model = array();
    }

    public function insertar_usuario($nombre, $email, $contra, $foto, $fech_nac, $tipo, $genero) {
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "insertar", ":id_usuario_usp" => null, ":nombre_usp" => $nombre, 
            ":email_usp" => $email, ":contra_usp" => $contra, ":foto_usp" => $foto, ":fech_nac_usp" => $fech_nac, 
            ":genero_usp" => $genero, ":tipo_usp" => $tipo, ":estatus_usp" => 1));
    }
    
    public function ver_usuarios_activos() {
        $this->usuarios_model = array();
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ver_activos", ":id_usuario_usp" => null, ":nombre_usp" => null, ":email_usp" => null, ":contra_usp" => null,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->usuarios_model[] = $filas;
        }
        return $this->usuarios_model;
    }
    
    public function nombre_autor($id) {
        $this->usuarios_model = array();
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "nom_autor", ":id_usuario_usp" => $id, ":nombre_usp" => null, ":email_usp" => null, ":contra_usp" => null,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->usuarios_model[] = $filas;
        }
        return $this->usuarios_model;
    }

    public function seleccionar_usuario($id) {
        $this->usuarios_model = array();
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "seleccionar_uno", ":id_usuario_usp" => $id, ":nombre_usp" => null, ":email_usp" => null, ":contra_usp" => null,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => null, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->usuarios_model[] = $filas;
        }
        return $this->usuarios_model;
    }
    
    public function buscar_usuario($email, $contra, $tipo) {
        $this->usuarios_model = array();
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "buscar_uno", ":id_usuario_usp" => null, ":nombre_usp" => null, ":email_usp" => $email, ":contra_usp" => $contra,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => $tipo, ":estatus_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->usuarios_model[] = $filas;
        }
        return $this->usuarios_model;
    }

    public function editar_usuario($id, $nombre, $email, $contra, $foto, $fech_nac, $genero, $estatus) {
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "editar", ":id_usuario_usp" => $id, ":nombre_usp" => $nombre, ":email_usp" => $email, ":contra_usp" => $contra,
            ":foto_usp" => $foto, ":fech_nac_usp" => $fech_nac, ":genero_usp" => $genero, ":tipo_usp" => null, ":estatus_usp" => $estatus));
    }

    public function eliminar_usuario($id) {
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "eliminar", ":id_usuario_usp" => $id, ":nombre_usp" => null, ":email_usp" => null, ":contra_usp" => null,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => null, ":estatus_usp" => null));
    }

    public function obtener_ultimo_id() {
        $this->usuarios_model = array();
        $sql = "call usp_usuario(:opc, :id_usuario_usp, :nombre_usp, :email_usp, :contra_usp, :foto_usp, "
                . ":fech_nac_usp, :genero_usp, :tipo_usp, :estatus_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "ultimo_id", ":id_usuario_usp" => null, ":nombre_usp" => null, ":email_usp" => null, ":contra_usp" => null,
            ":foto_usp" => null, ":fech_nac_usp" => null, ":genero_usp" => null, ":tipo_usp" => null, ":estatus_usp" => null));
        return $result->fetch(PDO::FETCH_ASSOC);
        
    }

}
