<?php

class busqueda_avanzada_model {

    private $db;
    private $cursos_busqueda_avanzada_model;

    public function __construct() {
        require_once 'Conexion.php';
        $this->db = conectar::conexion();
        $this->cursos_busqueda_avanzada_model = array();
    }
    
    public function busqueda_avanzada($fecha_inicio, $fecha_fin, $nombre_categoria, $titulo_curso, $nombre_autor) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "b_avanzada", ":fecha_ini_usp" => $fecha_inicio, ":fecha_fin_usp" => $fecha_fin, 
            ":nom_categoria_usp" => $nombre_categoria, ":titulo_cur_usp" => $titulo_curso, ":nom_usu_usp" => $nombre_autor, 
            ":id_usuario_usp" => null, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function busqueda_avanzada_paginada($fecha_inicio, $fecha_fin, $nombre_categoria, $titulo_curso, $nombre_autor, $pagina) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "b_avanzada_pag", ":fecha_ini_usp" => $fecha_inicio, ":fecha_fin_usp" => $fecha_fin, 
            ":nom_categoria_usp" => $nombre_categoria, ":titulo_cur_usp" => $titulo_curso, ":nom_usu_usp" => $nombre_autor, 
            ":id_usuario_usp" => null, ":pagina_usp" => $pagina));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }

    public function mas_vendidos() {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "mas_vendidos", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => null, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }

    public function mejor_calificados() {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "mejor_calif", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => null, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }

    public function mas_recientes() {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "mas_recientes", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => null, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
     public function adquiridos_paginado_usuario($id_usuario_logueado, $num_pagina) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "adquiridos_usu", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usuario_logueado, ":pagina_usp" => $num_pagina));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function adquiridos_usuario($id_usuario_logueado) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cuenta_adqui", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usuario_logueado, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function detalle_curso_creado($id_curso) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "det_cur_cre", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_curso, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function detalle_curso_creado_pagina($id_curso, $num_pagina) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "det_cur_crea2", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_curso, ":pagina_usp" => $num_pagina));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function cursos_creados($id_usuario_logueado) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cursos_cre", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usuario_logueado, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function cursos_creados_pagina($id_usuario_logueado, $num_pagina) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cursos_crea2", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usuario_logueado, ":pagina_usp" => $num_pagina));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function contenido_carrito_0($id_usuario) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "carrito_paga", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usuario, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function contenido_carrito_1($id_usuario) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "carrito_f_g", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null,
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null,
            ":id_usuario_usp" => $id_usuario, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function contenido_carrito_2($id_usuario) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "carrito_c_g", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null,
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null,
            ":id_usuario_usp" => $id_usuario, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function info_curso($id_curso) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "info_curso", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_curso, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function contenido_info_curso($id_curso) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "cont_curso", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_curso, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function comentarios_curso($id_curso) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "com_curso", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_curso, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function pinta_finalizados($id_cur, $id_usu) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "conte_adqui", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_cur, ":pagina_usp" => $id_usu));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function total_recaudado_del_curso($id_cur) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "total_cur", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_cur, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function desglose_formas_pago($id_usu) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "desglose", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_usu, ":pagina_usp" => null));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }
    
    public function ver_mensajes_usuarios($id_emisor,$id_receptor) {
        $this->cursos_busqueda_avanzada_model = array();
        $sql = "call usp_busqueda(:opc, :fecha_ini_usp, :fecha_fin_usp, :nom_categoria_usp, :titulo_cur_usp, "
                . ":nom_usu_usp, :id_usuario_usp, :pagina_usp)";
        $result = $this->db->prepare($sql);
        $result->execute(array(":opc" => "msj_de_usu", ":fecha_ini_usp" => null, ":fecha_fin_usp" => null, 
            ":nom_categoria_usp" => null, ":titulo_cur_usp" => null, ":nom_usu_usp" => null, 
            ":id_usuario_usp" => $id_emisor, ":pagina_usp" => $id_receptor));
        while ($filas = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->cursos_busqueda_avanzada_model[] = $filas;
        }
        return $this->cursos_busqueda_avanzada_model;
    }

}