<?php

Class conectar {
    
    public static function conexion(){
        
        try {
            
            $conexion = new PDO('mysql:host=localhost; dbname=BASICS', 'debian-sys-maint', 'ccgtUOuJ28ISMBOH');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
            
        } catch (Exception $ex) {
            die("Error: " . $ex->getMessage());
            echo "Linea de error: " . $ex->getLine();
        }
        return $conexion;
    }
}
