-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 07:36 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basics`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_busqueda` (`opc` VARCHAR(15), `fecha_ini_usp` DATE, `fecha_fin_usp` DATE, `nom_categoria_usp` VARCHAR(35), `titulo_cur_usp` VARCHAR(35), `nom_usu_usp` VARCHAR(80), `id_usuario_usp` INT, `pagina_usp` INT)  BEGIN

	declare nom_usu varchar(80); declare nom_usu1 varchar(83); declare nom_usu2 varchar(83); declare nom_usu3 varchar(83);
    declare nom_cur varchar(80); declare nom_cur1 varchar(83); declare nom_cur2 varchar(83); declare nom_cur3 varchar(83);
    
	if opc = 'mas_vendidos' then			
		select * from vw_mas_vendidos;
    end if;

	if Opc = 'mas_recientes' then
			select * from vw_mas_recientes;
	end if;

	if opc = 'mejor_calif' then
			select * from vw_mejor_calificados;
	end if;

	if opc = 'b_avanzada' then
			if nom_usu_usp is null then
				set nom_usu1 = null; set nom_usu2 = null; set nom_usu3 = null;
            else
				set nom_usu = nom_usu_usp;
				set nom_usu1 = CONCAT('%',nom_usu);
                set nom_usu2 = CONCAT(nom_usu,'%'); 
                set nom_usu3 = CONCAT('%',nom_usu,'%');
            end if;
            if titulo_cur_usp is null then
				set nom_cur1 = null; set nom_cur2 = null; set nom_cur3 = null;
            else
				set nom_cur = titulo_cur_usp;
				set nom_cur1 = CONCAT('%',nom_cur);
                set nom_cur2 = CONCAT(nom_cur,'%'); 
                set nom_cur3 = CONCAT('%',nom_cur,'%');
            end if;
			select vw.* from (select @fecha_ini:=fecha_ini_usp fecha_ini) param1, (select @fecha_fin:=fecha_fin_usp fecha_fin) param2, 
			(select @categoria:=nom_categoria_usp categoria) param3, (select @curso1:=nom_cur1 curso1) param4, (select @curso2:=nom_cur2 curso2) param5, 
			(select @curso3:=nom_cur3 curso3) param6, (select @usuario1:=nom_usu1 usuario1) param7, 
			(select @usuario2:=nom_usu2 usuario2) param8, (select @usuario3:=nom_usu3 usuario3) param9, vw_busqueda_avanzada as vw;
	end if;
    
    if opc = 'b_avanzada_pag' then
			if nom_usu_usp is null then
				set nom_usu1 = null; set nom_usu2 = null; set nom_usu3 = null;
            else
				set nom_usu = nom_usu_usp;
				set nom_usu1 = CONCAT('%',nom_usu);
                set nom_usu2 = CONCAT(nom_usu,'%'); 
                set nom_usu3 = CONCAT('%',nom_usu,'%');
            end if;
            if titulo_cur_usp is null then
				set nom_cur1 = null; set nom_cur2 = null; set nom_cur3 = null;
            else
				set nom_cur = titulo_cur_usp;
				set nom_cur1 = CONCAT('%',nom_cur);
                set nom_cur2 = CONCAT(nom_cur,'%'); 
                set nom_cur3 = CONCAT('%',nom_cur,'%');
            end if;
            set pagina_usp = (pagina_usp-1)*8;
			select vw.* from (select @fecha_ini:=fecha_ini_usp fecha_ini) param1, (select @fecha_fin:=fecha_fin_usp fecha_fin) param2, 
			(select @categoria:=nom_categoria_usp categoria) param3, (select @curso1:=nom_cur1 curso1) param4, (select @curso2:=nom_cur2 curso2) param5, 
			(select @curso3:=nom_cur3 curso3) param6, (select @usuario1:=nom_usu1 usuario1) param7, 
			(select @usuario2:=nom_usu2 usuario2) param8, (select @usuario3:=nom_usu3 usuario3) param9, vw_busqueda_avanzada as vw limit pagina_usp, 8;
	end if;
    
    if opc = 'adquiridos_usu' then
			set pagina_usp = (pagina_usp-1)*4;
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_cursos_usuario as vw limit pagina_usp, 4;
	end if;
    
    if opc = 'cuenta_adqui' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_cursos_usuario as vw;
	end if;
    
    if opc = 'det_cur_cre' then
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, vw_detalle_curso_creado as vw;
	end if;
    
    if opc = 'info_curso' then
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, vw_info_curso as vw;
	end if;
    
    if opc = 'cont_curso' then
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, vw_info_curso_contenidos as vw;
	end if;
    
    if opc = 'conte_adqui' then
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, (select @clave_usuario:=pagina_usp clave_usuario) param2, 
            vw_ver_contenidos_curso as vw;
	end if;
    
    if opc = 'com_curso' then
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, vw_comentarios_curso as vw;
	end if;
    
    if opc = 'cursos_cre' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_cursos_creados as vw;
	end if;
    
    if opc = 'det_cur_crea2' then
			set pagina_usp = (pagina_usp-1)*4;
			select vw.* from (select @clave_curso:=id_usuario_usp clave_curso) param1, vw_detalle_curso_creado as vw limit pagina_usp, 4;
	end if;
    
    if opc = 'cursos_crea2' then
			set pagina_usp = (pagina_usp-1)*4;
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_cursos_creados as vw limit pagina_usp, 4;
	end if;
    
    if opc = 'carrito_paga' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_carrito_paga as vw;
	end if;
    
    if opc = 'carrito_f_g' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_carrito_fases_gratis as vw;
	end if;
    
    if opc = 'carrito_c_g' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_carrito_cursos_gratis as vw;
	end if;
    
    if opc = 'desglose' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, vw_total_curso_forma_pago as vw;
	end if;
    
    if opc = 'msj_de_usu' then
			select vw.* from (select @clave_usuario:=id_usuario_usp clave_usuario) param1, (select @clave_usuario2:=pagina_usp clave_usuario2) param2, vw_mensajes_de_usuarios as vw;
	end if;
    
    if opc = 'total_cur' then
			select fun_total_ventas(id_usuario_usp) as total_ventas_curso;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_calificacion` (`opc` VARCHAR(15), `id_curso_usp` INT, `id_usuario_usp` INT, `like_dislike_usp` BIT)  BEGIN

	if opc = 'insertar' then			
		replace into calificacion (id_curso, id_usuario, like_dislike)
					values	(id_curso_usp, id_usuario_usp, like_dislike_usp);
    end if;

	if opc = 'eliminar' then
			delete from calificacion where id_curso = id_curso_usp and id_usuario = id_usuario_usp;
	end if;
    
    if opc = 'seleccionar_uno' then
			select id_curso, id_usuario, like_dislike
			from calificacion where id_curso = id_curso_usp and id_usuario = id_usuario_usp and like_dislike = like_dislike_usp;
	end if;

	if opc = 'ver_todo' then
			select id_curso, id_usuario, like_dislike
			from calificacion order by id_curso;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_categoria` (`opc` VARCHAR(15), `id_categoria_usp` INT, `id_usuario_usp` INT, `nombre_usp` VARCHAR(30), `descripcion_usp` VARCHAR(100), `fech_cre_usp` DATE)  BEGIN

declare existe int;

	if opc = 'insertar' then
		set existe = (select id_categoria from categoria where nombre = nombre_usp);
        if existe > 0 then
			update categoria set 
				id_usuario = IFNULL (id_usuario_usp, id_usuario), 
				nombre = IFNULL (nombre_usp, nombre), 
				descripcion = IFNULL (descripcion_usp, descripcion)
            where id_categoria = existe;
        else
			insert into categoria (id_usuario, nombre, descripcion, fech_cre) values (id_usuario_usp, nombre_usp, descripcion_usp, curdate());
		end if;
    end if;

	if Opc = 'editar' then
			update categoria set 
            id_usuario = IFNULL (id_usuario_usp, id_usuario), 
            nombre = IFNULL (nombre_usp, nombre), 
            descripcion = IFNULL (descripcion_usp, descripcion)
            where id_categoria = id_categoria_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_categoria, id_usuario, nombre, descripcion, fech_cre
			from categoria where id_categoria = id_categoria_usp;
	end if;

	if opc = 'ver_todo' then
			select id_categoria, id_usuario, nombre, descripcion, fech_cre
			from categoria order by id_categoria;
	end if;
    
    if opc = 'eliminar' then
			delete from categoria where id_categoria = id_categoria_usp;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_categoria_curso` (`opc` VARCHAR(15), `id_categoria_usp` INT, `id_curso_usp` INT)  BEGIN

	if opc = 'insertar' then			
		replace into categoria_curso (id_categoria, id_curso)
					values	(id_categoria_usp, id_curso_usp);
    end if;

	if opc = 'eliminar' then
			delete from categoria_curso where id_categoria = id_categoria_usp and id_curso = id_curso_usp;
	end if;

	if opc = 'seleccionar_cur' then
			select id_categoria, id_curso, fecha
			from categoria_curso where id_curso = id_curso_usp;
	end if;

	if opc = 'ver_todo' then
			select id_categoria, id_curso, fecha
			from categoria_curso order by id_curso;
	end if;
    
    if opc = 'desasignar_cat' then			
		update categoria_curso set
        id_categoria = null
		where id_categoria = id_categoria_usp;
    end if;
    
    if opc = 'asigna_cat' then
			update categoria_curso set 
            id_categoria = id_categoria_usp
			where id_categoria = null;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_comentario` (`opc` VARCHAR(15), `id_curso_usp` INT, `id_usuario_usp` INT, `comentario_usp` VARCHAR(150), `fech_salida_usp` DATETIME)  BEGIN

	if opc = 'insertar' then			
		insert into comentario (id_curso, id_usuario, comentario, fech_salida, fech_modif)
					values	(id_curso_usp, id_usuario_usp, comentario_usp, now(), now());
    end if;

	if Opc = 'editar' then
			update comentario set 
            comentario = IFNULL (comentario_usp, comentario), 
			fech_modif = now()
            where id_curso = id_curso_usp and id_usuario = id_usuario_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'eliminar' then
			delete from comentario where id_curso = id_curso_usp and id_usuario = id_usuario_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_curso, id_usuario, comentario, fech_salida, fech_modif
			from comentario where id_curso = id_curso_usp and id_usuario = id_usuario_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'ver_todo' then
			select id_curso, id_usuario, comentario, fech_salida, fech_modif
			from comentario order by fech_salida;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_contenido` (`opc` VARCHAR(15), `id_contenido_usp` INT, `id_curso_usp` INT, `id_fase_usp` INT, `nombre_usp` VARCHAR(25), `instrucciones_usp` VARCHAR(100), `archivo_usp` VARCHAR(256))  BEGIN
	declare fas int;

	if opc = 'insertar' then			
		insert into contenido (id_curso, id_fase, nombre, instrucciones, archivo)
					values	(id_curso_usp, id_fase_usp, nombre_usp, instrucciones_usp, archivo_usp);
    end if;

	if Opc = 'editar' then
			update contenido set 
            id_curso = IFNULL (id_curso_usp, id_curso), 
            id_fase = IFNULL (id_fase_usp, id_fase), 
            nombre = IFNULL (nombre_usp, nombre), 
			instrucciones = IFNULL (instrucciones_usp, instrucciones), 
            archivo = IFNULL (archivo_usp, archivo)
            where id_contenido = id_contenido_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_contenido, id_curso, id_fase, nombre, instrucciones, archivo
			from contenido where id_contenido = id_contenido_usp;
	end if;

	if opc = 'ver_cont_fase' then
			select id_contenido, id_curso, id_fase, nombre, instrucciones, archivo
			from contenido where id_fase = id_fase_usp order by id_contenido;
	end if;

	if opc = 'ver_todo' then
			select id_contenido, id_curso, id_fase, nombre, instrucciones, archivo
			from contenido order by id_contenido;
	end if;
    
    if opc = 'id_primer_cont' then
			select MIN(id_contenido) from contenido where id_fase = id_fase_usp;
	end if;
    
    if opc = 'id_ult_cont' then
			set fas = (select MAX(id_fase) from fase where id_curso = id_curso_usp);
			select MAX(id_contenido) from contenido where id_fase = fas;
	end if;
    
    if opc = 'url_contenido' then
            if id_curso_usp is not null then
				set fas = (select id_fase from contenido where id_contenido = id_contenido_usp);
				update progreso set fecha_ingreso = curdate() where id_fase = fas and id_usuario = id_curso_usp;
            end if;
			select archivo, nombre from contenido where id_contenido = id_contenido_usp;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_curso` (`opc` VARCHAR(15), `id_curso_usp` INT, `id_usuario_usp` INT, `titulo_usp` VARCHAR(35), `descripcion_usp` VARCHAR(150), `imagen_usp` BLOB, `precio_usp` DECIMAL(6,2), `tipo_usp` TINYINT, `fecha_usp` DATE, `estatus_usp` BIT)  BEGIN

declare total_de_iteraciones int; declare forma_pago_usp int; declare iteraciones_por_usuario int; 
declare total_de_usuarios int; declare fase_por_iteracion int; declare existe2 int; 
declare id_ultima_fase int; declare selec int; declare total_de_fases int;

	if opc = 'insertar' then			
		insert into curso (id_usuario, titulo, descripcion, imagen, precio, tipo, fecha, estatus)
					values	(id_usuario_usp, titulo_usp, descripcion_usp, imagen_usp, precio_usp, tipo_usp, curdate(), 1);
    end if;

	if Opc = 'editar' then
			update curso set 
            id_usuario = IFNULL (id_usuario_usp, id_usuario), 
			titulo = IFNULL (titulo_usp, titulo), 
            descripcion = IFNULL (descripcion_usp, descripcion), 
            imagen = IFNULL (imagen_usp, imagen), 
            precio = IFNULL (precio_usp, precio), 
            tipo = IFNULL (tipo_usp, tipo), 
            estatus = IFNULL (estatus_usp, estatus) 
            where id_curso = id_curso_usp;
	end if;

	if opc = 'eliminar' then
			update curso set estatus = 0 where id_curso = id_curso_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_curso, id_usuario, titulo, descripcion, imagen, precio, tipo, fecha, estatus
			from curso where id_curso = id_curso_usp and estatus = 1;
	end if;

	if opc = 'ver_activos' then
			select id_curso, id_usuario, titulo, descripcion, imagen, precio, tipo, fecha, estatus
			from curso where estatus = 1 order by id_curso;
	end if;

	if opc = 'ver_todo' then
			select id_curso, id_usuario, titulo, descripcion, imagen, precio, tipo, fecha, estatus
			from curso order by id_curso;
	end if;
    
    if opc = 'seleccionar' then
			select id_curso, id_usuario, titulo, descripcion, imagen, precio, tipo, fecha, estatus
			from curso where id_curso = id_curso_usp;
	end if;
    
    if opc = 'cont_curso' then
			select id_contenido, id_curso, id_fase, nombre, instrucciones, archivo 
            from contenido where id_curso = id_curso_usp;
	end if;
    
    if opc = 'cats_curso' then
			select id_categoria, id_curso, fecha
            from categoria_curso where id_curso = id_curso_usp;
	end if;
    
    if opc = 'fases_curso' then
			select id_fase, id_curso, nombre, descripcion, monto, tipo 
            from fase where id_curso = id_curso_usp;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_curso_deseado` (`opc` VARCHAR(15), `id_curso_usp` INT, `id_usuario_usp` INT, `id_fase_usp` INT, `forma_pago_usp` TINYINT, `monto_usp` DECIMAL(8,2))  BEGIN

	declare counter int; declare tipo int; declare existe int; declare precio_var decimal(6,2); declare fase_precio int;

	if opc = 'insertar' then			
		replace into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
					values	(id_curso_usp, id_usuario_usp, id_fase_usp, monto_usp, forma_pago_usp, 0);
    end if;

	if Opc = 'editar' then
			update curso_deseado set 
            monto = IFNULL (monto_usp, monto),
            forma_pago = IFNULL (forma_pago_usp, forma_pago)
            where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_curso, id_usuario, id_fase, forma_pago, monto, adquirido
			from curso_deseado where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp;
	end if;
    
    if opc = 'borrar_fase' then
			delete from curso_deseado where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp  and adquirido = 0;
	end if;
    
    if opc = 'borrar_curso' then
			delete from curso_deseado where id_curso = id_curso_usp and id_usuario = id_usuario_usp and adquirido = 0;
	end if;
    
    if opc = 'enlista_curso' then
		set counter = (select count(*) from fase where id_curso = id_curso_usp);
        set precio_var = (select precio from curso where id_curso = id_curso_usp);
		set id_fase_usp = (select MAX(id_fase) from fase where id_curso = id_curso_usp);
        set tipo = (select c.tipo from curso as c where c.id_curso = id_curso_usp);
        set fase_precio = (select MAX(f.id_fase) from fase as f where f.id_curso = id_curso_usp and f.tipo = 1);
        
		my_loop: LOOP
		SET counter = counter - 1;
		IF counter = -1 THEN
			LEAVE my_loop;
		END IF;
        set existe = (select count(*) from curso_deseado where id_fase = id_fase_usp and id_curso = id_curso_usp and id_usuario = id_usuario_usp);
        if existe = 0 then
            if tipo = 2 then
				insert into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
				select id_curso_usp, id_usuario_usp, id_fase_usp, f.monto, forma_pago_usp, 0 from fase as f where id_fase = id_fase_usp;
			else if tipo = 1 then
				if id_fase_usp = fase_precio then 
					replace into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
					values (id_curso_usp, id_usuario_usp, fase_precio, precio_var, forma_pago_usp, 0);
				else
                    replace into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
					values (id_curso_usp, id_usuario_usp, id_fase_usp, 0.00, forma_pago_usp, 0);
                end if;
			else
				replace into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
				values (id_curso_usp, id_usuario_usp, id_fase_usp, 0.00, forma_pago_usp, 0);
            end if;
        end if;
        end if;
        set id_fase_usp = id_fase_usp - 1;
		END LOOP my_loop;
	end if;
    
    if opc = 'adquiere_fase' then
			update curso_deseado set
            adquirido = 1,
            forma_pago = forma_pago_usp,
            fecha_inscripcion = curdate()
            where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp;
	end if;

	if opc = 'ver_todo' then
			select id_curso, id_usuario, id_fase, forma_pago, monto, adquirido
			from curso_deseado order by id_curso;
	end if;
    
    if opc = 'ver_fases' then
			select cd.id_curso, f.nombre, cd.id_usuario, cd.id_fase, cd.forma_pago, cd.monto, cd.adquirido
			from curso_deseado as cd inner join fase as f on f.id_fase = cd.id_fase 
            where cd.id_curso = id_curso_usp and cd.adquirido = 1 and cd.id_usuario = id_usuario_usp order by id_curso;
	end if;
    
    if opc = 'id_primer_fase' then
			select MIN(id_fase) from curso_deseado where id_curso = id_curso_usp and adquirido = 1 and id_usuario = id_usuario_usp;
	end if;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_fase` (`opc` VARCHAR(15), `id_fase_usp` INT, `id_curso_usp` INT, `nombre_usp` VARCHAR(25), `descripcion_usp` VARCHAR(80), `monto_usp` DECIMAL(5,2), `tipo_usp` BIT)  BEGIN

	if opc = 'insertar' then			
		insert into fase (id_curso, nombre, descripcion, monto, tipo)
					values	(id_curso_usp, nombre_usp, descripcion_usp, monto_usp, tipo_usp);
    end if;

	if Opc = 'editar' then
			update fase set 
            id_curso = IFNULL (id_curso_usp, id_curso), 
            nombre = IFNULL (nombre_usp, nombre), 
			descripcion = IFNULL (descripcion_usp, descripcion), 
            monto = IFNULL (monto_usp, monto), 
            tipo = IFNULL (tipo_usp, tipo)
            where id_fase = id_fase_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_fase, id_curso, nombre, descripcion, monto, tipo
			from fase where id_fase = id_fase_usp;
	end if;

	if opc = 'ver_todo' then
			select id_fase, id_curso, nombre, descripcion, monto, tipo
			from fase order by id_fase;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_forma_pago` (`opc` VARCHAR(15), `id_fp_usp` TINYINT, `nombre_usp` VARCHAR(25), `descripcion_usp` VARCHAR(50), `fecha_usp` DATE)  BEGIN

	if opc = 'insertar' then			
		insert into forma_pago (nombre, descripcion, fecha)
					values	(nombre_usp, descripcion_usp, curdate());
    end if;

	if Opc = 'editar' then
			update forma_pago set 
            nombre = IFNULL (nombre_usp, nombre),
            descripcion = IFNULL (descripcion_usp, descripcion)
            where id_fp = id_fp_usp;
	end if;
    
    if Opc = 'eliminar' then
			delete from forma_pago where id_fp = id_fp_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_fp, nombre, descripcion, fecha
			from forma_pago where id_fp = id_fp_usp;
	end if;

	if opc = 'ver_todo' then
			select id_fp, nombre, descripcion, fecha
			from forma_pago order by id_fp;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_mensaje` (`opc` VARCHAR(15), `id_usuario1_usp` INT, `id_usuario2_usp` INT, `mensaje_usp` VARCHAR(150), `fech_salida_usp` DATETIME)  BEGIN

	if opc = 'insertar' then			
		insert into mensaje (id_usuario1, id_usuario2, mensaje, fech_salida, fech_modif)
					values	(id_usuario1_usp, id_usuario2_usp, mensaje_usp, now(), now());
    end if;

	if Opc = 'editar' then
			update mensaje set 
            mensaje = IFNULL (mensaje_usp, mensaje),
            fech_modif = now()
            where id_usuario1 = id_usuario1_usp and id_usuario2 = id_usuario2_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'eliminar' then
			delete from mensaje where id_usuario1 = id_usuario1_usp and id_usuario2 = id_usuario2_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_usuario1, id_usuario2, mensaje, fech_salida, fech_modif
			from mensaje where id_usuario1 = id_usuario1_usp and id_usuario2 = id_usuario2_usp and fech_salida = fech_salida_usp;
	end if;

	if opc = 'ver_todo' then
			select id_usuario1, id_usuario2, mensaje, fech_salida, fech_modif
			from mensaje order by fech_salida;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_progreso` (`opc` VARCHAR(15), `id_curso_usp` INT, `id_usuario_usp` INT, `id_fase_usp` INT, `finalizado_usp` BIT)  BEGIN
	declare fin bit; declare fase_mas_reciente int;

	if opc = 'insertar' then			
		insert into progreso (id_curso, id_usuario, id_fase, finalizado)
					values	(id_curso_usp, id_usuario_usp, id_fase_usp, 0);
    end if;

	if Opc = 'editar' then
			update progreso set 
            finalizado = IFNULL (finalizado_usp, finalizado)
            where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_curso, id_usuario, id_fase, finalizado
			from progreso where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = id_fase_usp;
	end if;

	if opc = 'ver_todo' then
			select id_curso, id_usuario, id_fase, finalizado
			from progreso order by id_curso;
	end if;
    
    if opc = 'fin_fase' then
			set fin = (select finalizado from progreso where id_fase = id_fase_usp and id_usuario = id_usuario_usp);
            if fin = 0 then
            update progreso set finalizado = 1, fecha_finalizado = curdate() 
            where id_fase = id_fase_usp and id_usuario = id_usuario_usp;
            end if;
	end if;
    
    if opc = 'id_primer_fase' then
			set fase_mas_reciente = (select MIN(id_fase) from progreso where id_curso = id_curso_usp and id_usuario = id_usuario_usp and finalizado = 0);
            if fase_mas_reciente is null then
				set fase_mas_reciente = (select MAX(id_fase) from progreso where id_curso = id_curso_usp and id_usuario = id_usuario_usp and finalizado = 1);
            end if;
            select fase_mas_reciente;
	end if;
    
    if opc = 'tot_fin' then
			select count(*) from progreso where id_curso = id_curso_usp and id_usuario = id_usuario_usp and finalizado = 1;
	end if;
    
    if opc = 'tot_fases' then
			select count(*) from fase where id_curso = id_curso_usp;
	end if;
    
    if opc = 'tot_progresos' then
			select count(*) from progreso where id_curso = id_curso_usp and id_usuario = id_usuario_usp;
	end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario` (`opc` VARCHAR(15), `id_usuario_usp` INT, `nombre_usp` VARCHAR(80), `email_usp` VARCHAR(40), `contra_usp` VARCHAR(25), `foto_usp` BLOB, `fech_nac_usp` DATE, `genero_usp` BIT, `tipo_usp` BIT, `estatus_usp` BIT)  BEGIN

	if opc = 'insertar' then			
		insert into usuario (nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus)
					values	(nombre_usp, email_usp, contra_usp, foto_usp, fech_nac_usp, curdate(), curdate(), genero_usp, tipo_usp, estatus_usp);
    end if;

	if Opc = 'editar' then
			update usuario set 
            nombre = IFNULL (nombre_usp, nombre), 
            email = IFNULL (email_usp, email), 
			contra = IFNULL (contra_usp, contra), 
            foto = IFNULL (foto_usp, foto), 
            fech_nac = IFNULL (fech_nac_usp, fech_nac), 
            fech_mod = curdate(), 
            genero = IFNULL (genero_usp, genero), 
            estatus = IFNULL (estatus_usp, estatus)
            where id_usuario = id_usuario_usp;
	end if;

	if opc = 'eliminar' then
			update usuario set estatus = 0 where id_usuario = id_usuario_usp;
	end if;

	if opc = 'seleccionar_uno' then
			select id_usuario, nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus
			from usuario where id_usuario = id_usuario_usp and estatus = 1;
	end if;
    
    if opc = 'nom_autor' then
			select nombre from usuario where id_usuario = id_usuario_usp and estatus = 1;
	end if;
    
    if opc = 'buscar_uno' then
			select id_usuario, nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus
			from usuario where email = email_usp and contra = contra_usp and tipo = tipo_usp and estatus = 1;
	end if;

	if opc = 'ver_activos' then
			select id_usuario, nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus
			from usuario where estatus = 1 order by id_usuario;
	end if;

	if opc = 'ver_todo' then
			select id_usuario, nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus
			from usuario order by id_usuario;
	end if;
    
    if opc = 'ultimo_id' then
			SELECT id_usuario, nombre, email, contra, foto, fech_nac, fech_cre, fech_mod, genero, tipo, estatus
            FROM usuario WHERE id_usuario = (SELECT MAX(id_usuario) FROM usuario);
	end if;
    
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `categoria` () RETURNS VARCHAR(35) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @categoria$$

CREATE DEFINER=`root`@`localhost` FUNCTION `clave_curso` () RETURNS INT(11) NO SQL
    DETERMINISTIC
return @clave_curso$$

CREATE DEFINER=`root`@`localhost` FUNCTION `clave_usuario` () RETURNS INT(11) NO SQL
    DETERMINISTIC
return @clave_usuario$$

CREATE DEFINER=`root`@`localhost` FUNCTION `clave_usuario2` () RETURNS INT(11) NO SQL
    DETERMINISTIC
return @clave_usuario2$$

CREATE DEFINER=`root`@`localhost` FUNCTION `curso1` () RETURNS VARCHAR(35) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @curso1$$

CREATE DEFINER=`root`@`localhost` FUNCTION `curso2` () RETURNS VARCHAR(35) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @curso2$$

CREATE DEFINER=`root`@`localhost` FUNCTION `curso3` () RETURNS VARCHAR(35) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @curso3$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fecha_fin` () RETURNS DATE NO SQL
    DETERMINISTIC
return @fecha_fin$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fecha_ini` () RETURNS DATE NO SQL
    DETERMINISTIC
return @fecha_ini$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_costo` (`id_cur` INT) RETURNS DECIMAL(10,2) begin
	declare precio_fases decimal(8,2); declare precio_curso decimal(6,2);
	set precio_curso = (select precio from curso where id_curso = id_cur);
    set precio_fases = (select sum(monto) from fase where id_curso = id_cur);
    
	return (precio_curso+precio_fases);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_cuenta_alumnos` (`id_cur` INT) RETURNS INT(11) begin
	return (SELECT count(distinct u.id_usuario) from usuario as u inner join curso_deseado as cd on u.id_usuario = cd.id_usuario and cd.adquirido = 1 
    inner join curso as c on c.id_curso = cd.id_curso where cd.id_curso = id_cur and u.id_usuario = cd.id_usuario and cd.adquirido = 1);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_curso_acabado` (`id_usu` INT, `id_cur` INT) RETURNS BIT(1) begin
	declare total_fases int; declare total_progreso int;
	set total_fases = (select count(*) from fase where id_curso = id_cur);
    set total_progreso = (select count(*) from progreso where id_curso = id_cur and id_usuario = id_usu and finalizado = 1);
	if total_fases = total_progreso then
		return 1;
    else
		return 0;
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_fases_curso_gratis` (`id_cur` INT) RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin begin
		return (SELECT GROUP_CONCAT(nombre separator ' | ') from fase where id_curso = id_cur);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_fase_actual` (`id_usu` INT, `id_cur` INT) RETURNS VARCHAR(50) CHARSET utf8 COLLATE utf8_bin begin
		declare fase_actual int; declare ultima_fase int;
        set fase_actual = (select MAX(id_fase) from progreso where finalizado = 1 and id_usuario = id_usu and id_curso = id_cur);
        if fase_actual is null then
			set fase_actual = (select MIN(id_fase) from curso_deseado where adquirido = 1 and id_usuario = id_usu and id_curso = id_cur);
            return (select nombre from fase where id_fase = fase_actual);
        else 
			set ultima_fase = (select MAX(id_fase) from fase where id_curso = id_cur);
            if ultima_fase = fase_actual then 
				return (select nombre from fase where id_fase = fase_actual);
            else
				set fase_actual = fase_actual + 1;
				return (select nombre from fase where id_fase = fase_actual);
            end if;
        end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_id_fases_curso_gratis` (`id_cur` INT) RETURNS VARCHAR(15) CHARSET utf8 COLLATE utf8_bin begin
		return (SELECT GROUP_CONCAT(id_fase separator ',') from fase where id_curso = id_cur);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_id_fases_curso_paga` (`id_cur` INT, `id_fas` INT) RETURNS VARCHAR(15) CHARSET utf8 COLLATE utf8_bin begin
		declare ctipo int;
        set ctipo = (select tipo from curso where id_curso = id_cur);
		if ctipo = 1 then
			return (SELECT GROUP_CONCAT(id_fase separator ',') from fase where id_curso = id_cur and tipo = 1);
		else
			return (SELECT id_fase from fase where id_curso = id_cur and id_fase = id_fas);
        end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_ingresos_forma_pago_curso` (`id_fp` INT, `id_cur` INT) RETURNS DECIMAL(9,2) begin
	declare total_fp decimal(9,2);
    set total_fp = (select sum(monto) from curso_deseado where forma_pago = id_fp and id_curso = id_cur and adquirido = 1);
    
    if total_fp is null then
		return 0;
    else
		return total_fp;
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_monto_carrito` (`id_cur` INT, `id_usu` INT, `id_fas` INT) RETURNS DECIMAL(8,2) begin
	declare ctipo int;
	set ctipo = (select tipo from curso where id_curso = id_cur);
    if ctipo = 1 then
        return (SELECT MAX(monto) from curso_deseado where id_curso = id_cur and id_usuario = id_usu);
	else
		return (SELECT monto from curso_deseado where id_curso = id_cur and id_usuario = id_usu and id_fase = id_fas);
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_nivel_promedio` (`id_cur` INT) RETURNS VARCHAR(40) CHARSET utf8 COLLATE utf8_bin begin
	declare prom int;
    set prom = (SELECT round(AVG(p.id_fase)) from progreso as p where p.id_curso = id_cur and p.finalizado = 1);
    if prom is null then 
    return 'Sin nivel promedio';
    else
	return (select nombre from fase where id_fase = prom);
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_nombre_autor` (`id_usu` INT) RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin begin
    return (select nombre from usuario where id_usuario = id_usu);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_nombre_fp` (`id_usu` INT, `id_cur` INT) RETURNS VARCHAR(40) CHARSET utf8 COLLATE utf8_bin begin
    return (select distinctrow group_concat( distinct fun_nombre_individual_fp(cd.forma_pago) separator ' | ') 
    as formas_pago from curso_deseado as cd inner join forma_pago as fp 
    where cd.adquirido = 1 and cd.id_usuario = id_usu and cd.id_curso = id_cur group by fp.nombre);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_nombre_individual_fp` (`id` INT) RETURNS VARCHAR(40) CHARSET utf8 COLLATE utf8_bin begin
    return (select fp.nombre from forma_pago as fp where fp.id_fp = id);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_nom_fase_paga` (`id_cur` INT, `id_fas` INT) RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin begin
	declare tipo int;
	set tipo = (select c.tipo from curso as c where c.id_curso = id_cur);
    if tipo = 1 then
		return (SELECT GROUP_CONCAT(f.nombre separator ' | ') from fase as f where f.id_curso = id_cur and f.tipo = 1);
	else
		return (SELECT nombre as Fase from fase where id_fase = id_fas);
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_porcentaje_dislikes` (`id_cur` INT) RETURNS DECIMAL(5,2) begin
	declare likes int; declare dislikes int; declare porcentaje_unitario int; declare porcentaje_dislikes int;
    set likes = (select count(*) from calificacion where id_curso = id_cur and like_dislike = 1);
    set dislikes = (select count(*) from calificacion where id_curso = id_cur and like_dislike = 0);
    
    if likes <> 0 or dislikes <> 0 then
		set porcentaje_unitario = 100/(likes + dislikes);
		set porcentaje_dislikes = porcentaje_unitario * dislikes;
    else
		set porcentaje_dislikes = 0;
    end if;
    return porcentaje_dislikes;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_porcentaje_likes` (`id_cur` INT) RETURNS DECIMAL(5,2) begin
	declare likes int; declare dislikes int; declare porcentaje_unitario int; declare porcentaje_likes int;
    set likes = (select count(*) from calificacion where id_curso = id_cur and like_dislike = 1);
    set dislikes = (select count(*) from calificacion where id_curso = id_cur and like_dislike = 0);
    
    if likes <> 0 or dislikes <> 0 then
		set porcentaje_unitario = 100/(likes + dislikes);
		set porcentaje_likes = porcentaje_unitario * likes;
    else
		set porcentaje_likes = 0;
    end if;
    return porcentaje_likes;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_progreso` (`id_cur` INT, `id_usu` INT) RETURNS DECIMAL(5,2) begin
		declare total_fases int; declare total_progreso int;
		set total_fases = (select count(*) from fase where id_curso = id_cur);
        set total_progreso = (select count(*) from progreso where id_curso = id_cur and id_usuario = id_usu and finalizado = 1);
		return ((total_progreso/total_fases)*100);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_total_dislikes` (`id_cur` INT) RETURNS INT(11) begin
    return (select count(*) from calificacion where id_curso = id_cur and like_dislike = 0);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_total_likes` (`id_cur` INT) RETURNS INT(11) begin
    return (select count(*) from calificacion where id_curso = id_cur and like_dislike = 1);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_total_usuario_curso` (`id_cur` INT, `id_usu` INT) RETURNS DECIMAL(8,2) begin
	return (select sum(monto) as total from curso_deseado where adquirido = 1 and id_curso = id_cur and id_usuario = id_usu);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_total_ventas` (`id_cur` INT) RETURNS DECIMAL(8,2) begin
	declare total decimal(8,2);
    set total = (select sum(monto) as total from curso_deseado where adquirido = 1 and id_curso = id_cur);
    if total is null then
		return 0;
    else
		return total;
    end if;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_trae_categorias` (`id_cur` INT) RETURNS VARCHAR(100) CHARSET utf8 COLLATE utf8_bin begin
	return (SELECT GROUP_CONCAT(cat.nombre separator ', ') as Categorias from curso  as c inner join categoria_curso as cc on c.id_curso = cc.id_curso 
    inner join usuario as u on u.id_usuario = c.id_usuario inner join categoria as cat on cat.id_categoria = cc.id_categoria
    where c.id_curso = id_cur and cc.id_curso = id_cur);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fun_ventas_curso` (`id_cur` INT) RETURNS INT(11) begin
	declare total_fases int; declare total_compras int;
	set total_fases = (select count(*) from fase where id_curso = id_cur);
    set total_compras = (select count(*) from fase as f 
						join curso_deseado as cd on cd.adquirido = 1 and cd.id_fase = f.id_fase 
						where cd.id_curso = id_cur and cd.adquirido = 1 and f.id_curso = id_cur);
	return floor(total_compras/total_fases);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `usuario1` () RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @usuario1$$

CREATE DEFINER=`root`@`localhost` FUNCTION `usuario2` () RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @usuario2$$

CREATE DEFINER=`root`@`localhost` FUNCTION `usuario3` () RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_bin NO SQL
    DETERMINISTIC
return @usuario3$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `calificacion`
--

CREATE TABLE `calificacion` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `like_dislike` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `fech_cre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `categoria_curso`
--

CREATE TABLE `categoria_curso` (
  `id_categoria` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fech_salida` datetime NOT NULL,
  `comentario` varchar(150) COLLATE utf8_bin NOT NULL,
  `fech_modif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `contenido`
--

CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_bin NOT NULL,
  `instrucciones` varchar(100) COLLATE utf8_bin NOT NULL,
  `archivo` varchar(256) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(35) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `imagen` blob DEFAULT NULL,
  `precio` decimal(7,2) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `fecha` date NOT NULL,
  `estatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `curso`
--
DELIMITER $$
CREATE TRIGGER `tggr_curso` AFTER UPDATE ON `curso` FOR EACH ROW begin
declare valida int; declare total_de_iteraciones int; declare forma_pago_usp int; declare existe3 int; declare id_usuario_usp int; 
declare iteraciones_por_usuario int; declare total_de_usuarios int; declare fase_por_iteracion int; declare existe int; 
declare existe2 int; declare id_curso_usp int; declare id_ultima_fase int; declare selec int; declare total_de_fases int;

SELECT new.estatus INTO valida;
if valida = 0 then -- si el curso se da de baja, pone como completado a los usuarios que lo adquirieron parcial o completo
set selec = 0; set iteraciones_por_usuario = 1;
SELECT old.id_curso INTO id_curso_usp;
set total_de_usuarios = (select count(distinct id_usuario) from curso_deseado where id_curso = id_curso_usp);
set total_de_fases = (select count(*) from fase where id_curso = id_curso_usp);
set total_de_iteraciones = total_de_fases * total_de_usuarios;
set id_ultima_fase = (select MAX(id_fase) from fase where id_curso = id_curso_usp);
set fase_por_iteracion = (select MIN(id_fase) from fase where id_curso = id_curso_usp);

		my_loop: LOOP
		IF total_de_iteraciones = 0 THEN
			LEAVE my_loop;
		END IF;
        
        set id_usuario_usp = (select distinct id_usuario from curso_deseado where id_curso = id_curso_usp limit selec,1);
        
        if iteraciones_por_usuario = total_de_fases then
			set iteraciones_por_usuario = 1;
            set selec = selec + 1;
        else 
            set iteraciones_por_usuario = iteraciones_por_usuario + 1;
        end if;
	
	set existe2 = (select count(*) from curso_deseado where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = fase_por_iteracion and adquirido = 1);
                if existe2 = 0 or existe2 is null then
					delete from curso_deseado where id_curso = id_curso_usp and id_usuario = id_usuario_usp and id_fase = fase_por_iteracion;
                    insert into curso_deseado (id_curso, id_usuario, id_fase, monto, forma_pago, adquirido)
					values (id_curso_usp, id_usuario_usp, fase_por_iteracion, 0.00, 3, 0);
                end if;
                
        set total_de_iteraciones = total_de_iteraciones - 1;
        
        if fase_por_iteracion = id_ultima_fase then
			set fase_por_iteracion = (select MIN(id_fase) from fase where id_curso = id_curso_usp);
        else 
			set fase_por_iteracion = fase_por_iteracion + 1;
        end if;
        
		END LOOP my_loop;
UPDATE curso_deseado 
SET 
    monto = 0.00,
    adquirido = 1,
    fecha_inscripcion = CURDATE(),
    forma_pago = 3
WHERE
    adquirido != 1
        AND id_curso = id_curso_usp;
        
UPDATE progreso 
SET 
    finalizado = 1,
    fecha_finalizado = CURDATE(),
    fecha_ingreso = CURDATE()
WHERE
    id_curso = id_curso_usp;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `curso_deseado`
--

CREATE TABLE `curso_deseado` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `forma_pago` tinyint(4) NOT NULL,
  `monto` decimal(7,2) NOT NULL,
  `adquirido` bit(1) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `curso_deseado`
--
DELIMITER $$
CREATE TRIGGER `tggr_adquisicion` AFTER UPDATE ON `curso_deseado` FOR EACH ROW begin
declare id_cur int; declare id_alum int; declare compra int; declare id_fas int;
SELECT new.adquirido INTO compra;
if compra = 1 then 
	select new.id_curso into id_cur;
	SELECT new.id_usuario INTO id_alum;
	SELECT new.id_fase INTO id_fas;
	insert into progreso (id_curso, id_usuario, id_fase, fecha_ingreso, finalizado) values	(id_cur, id_alum, id_fas, curdate(), 0);
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fase`
--

CREATE TABLE `fase` (
  `id_fase` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `monto` decimal(6,2) DEFAULT NULL,
  `tipo` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_fp` tinyint(4) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mensaje`
--

CREATE TABLE `mensaje` (
  `id_usuario1` int(11) NOT NULL,
  `id_usuario2` int(11) NOT NULL,
  `fech_salida` datetime NOT NULL,
  `mensaje` varchar(150) COLLATE utf8_bin NOT NULL,
  `fech_modif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `progreso`
--

CREATE TABLE `progreso` (
  `id_curso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  `finalizado` bit(1) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_finalizado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_bin NOT NULL,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `contra` varchar(25) COLLATE utf8_bin NOT NULL,
  `foto` blob DEFAULT NULL,
  `fech_nac` date NOT NULL,
  `fech_cre` date NOT NULL,
  `fech_mod` date NOT NULL,
  `genero` bit(1) NOT NULL,
  `tipo` bit(1) NOT NULL,
  `estatus` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `usuario`
--
DELIMITER $$
CREATE TRIGGER `tggr_usuario` AFTER UPDATE ON `usuario` FOR EACH ROW begin
declare id_usu int; declare estat bit;
SELECT old.id_usuario INTO id_usu;
SELECT new.estatus INTO estat;
if estat = 0 then 
	delete from comentario where id_usuario = id_usu;
    delete from calificacion where id_usuario = id_usu;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_busqueda_avanzada`
-- (See below for the actual view)
--
CREATE TABLE `vw_busqueda_avanzada` (
`id_curso` int(11)
,`imagen` blob
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`Categorias` varchar(100)
,`total_likes` int(11)
,`precio` decimal(10,2)
,`cursos_vendidos` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_carrito_cursos_gratis`
-- (See below for the actual view)
--
CREATE TABLE `vw_carrito_cursos_gratis` (
`id_curso` int(11)
,`id_fases` varchar(15)
,`tipo` tinyint(4)
,`imagen` blob
,`titulo` varchar(35)
,`fases` varchar(80)
,`monto` decimal(7,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_carrito_fases_gratis`
-- (See below for the actual view)
--
CREATE TABLE `vw_carrito_fases_gratis` (
`id_curso` int(11)
,`id_fases` int(11)
,`tipo` tinyint(4)
,`imagen` blob
,`titulo` varchar(35)
,`fases` varchar(25)
,`monto` decimal(6,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_carrito_paga`
-- (See below for the actual view)
--
CREATE TABLE `vw_carrito_paga` (
`id_curso` int(11)
,`id_fases` varchar(15)
,`tipo` tinyint(4)
,`imagen` blob
,`titulo` varchar(35)
,`fases` varchar(80)
,`monto` decimal(8,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_comentarios_curso`
-- (See below for the actual view)
--
CREATE TABLE `vw_comentarios_curso` (
`id_usuario` int(11)
,`nombre` varchar(80)
,`foto` blob
,`comentario` varchar(150)
,`fech_salida` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cursos_creados`
-- (See below for the actual view)
--
CREATE TABLE `vw_cursos_creados` (
`id_curso` int(11)
,`titulo` varchar(35)
,`total_recaudado` decimal(8,2)
,`total_alumnos` int(11)
,`total_likes` int(11)
,`total_dislikes` int(11)
,`estatus` bit(1)
,`nivel_promedio` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cursos_usuario`
-- (See below for the actual view)
--
CREATE TABLE `vw_cursos_usuario` (
`id_curso` int(11)
,`imagen` blob
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`categorias` varchar(100)
,`total_likes` int(11)
,`precio` decimal(10,2)
,`nombre_usuario` varchar(80)
,`progreso` decimal(5,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_detalle_curso_creado`
-- (See below for the actual view)
--
CREATE TABLE `vw_detalle_curso_creado` (
`id_usuario` int(11)
,`nombre` varchar(80)
,`email` varchar(40)
,`fase_actual` varchar(50)
,`progreso` decimal(5,2)
,`curso_acabado` bit(1)
,`fecha_inscripcion` date
,`pagado` decimal(8,2)
,`forma_pago` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_info_curso`
-- (See below for the actual view)
--
CREATE TABLE `vw_info_curso` (
`id_usuario` int(11)
,`nombre` varchar(80)
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`likes` int(11)
,`dislikes` int(11)
,`porcentaje_likes` decimal(5,2)
,`alumnos` int(11)
,`precio` decimal(10,2)
,`imagen` blob
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_info_curso_contenidos`
-- (See below for the actual view)
--
CREATE TABLE `vw_info_curso_contenidos` (
`fase` varchar(25)
,`contenido` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mas_recientes`
-- (See below for the actual view)
--
CREATE TABLE `vw_mas_recientes` (
`id_curso` int(11)
,`imagen` blob
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`Categorias` varchar(100)
,`total_likes` int(11)
,`precio` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mas_vendidos`
-- (See below for the actual view)
--
CREATE TABLE `vw_mas_vendidos` (
`id_curso` int(11)
,`imagen` blob
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`Categorias` varchar(100)
,`total_likes` int(11)
,`precio` decimal(10,2)
,`cursos_vendidos` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mejor_calificados`
-- (See below for the actual view)
--
CREATE TABLE `vw_mejor_calificados` (
`id_curso` int(11)
,`imagen` blob
,`titulo` varchar(35)
,`descripcion` varchar(150)
,`Categorias` varchar(100)
,`total_likes` int(11)
,`precio` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mensajes_de_usuarios`
-- (See below for the actual view)
--
CREATE TABLE `vw_mensajes_de_usuarios` (
`id_emisor` int(11)
,`id_receptor` int(11)
,`mensaje` varchar(150)
,`nombre` varchar(80)
,`fech_salida` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_total_curso_forma_pago`
-- (See below for the actual view)
--
CREATE TABLE `vw_total_curso_forma_pago` (
`nombre` varchar(25)
,`total_fp` decimal(31,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ver_contenidos_curso`
-- (See below for the actual view)
--
CREATE TABLE `vw_ver_contenidos_curso` (
`fase` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_busqueda_avanzada`
--
DROP TABLE IF EXISTS `vw_busqueda_avanzada`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_busqueda_avanzada`  AS SELECT DISTINCT `c`.`id_curso` AS `id_curso`, `c`.`imagen` AS `imagen`, `c`.`titulo` AS `titulo`, `c`.`descripcion` AS `descripcion`, `fun_trae_categorias`(`c`.`id_curso`) AS `Categorias`, `fun_total_likes`(`c`.`id_curso`) AS `total_likes`, `fun_costo`(`c`.`id_curso`) AS `precio`, `fun_ventas_curso`(`c`.`id_curso`) AS `cursos_vendidos` FROM (((`curso` `c` join `categoria_curso` `cc` on(`c`.`id_curso` = `cc`.`id_curso`)) join `usuario` `u` on(`u`.`id_usuario` = `c`.`id_usuario`)) join `categoria` `cat` on(`cat`.`id_categoria` = `cc`.`id_categoria`)) WHERE `cat`.`nombre` = ifnull(`categoria`(),`cat`.`nombre`) AND `c`.`fecha` >= ifnull(`fecha_ini`(),`c`.`fecha`) AND `c`.`fecha` <= ifnull(`fecha_fin`(),`c`.`fecha`) AND (`u`.`nombre` like ifnull(`usuario1`(),`u`.`nombre`) OR `u`.`nombre` like ifnull(`usuario2`(),`u`.`nombre`) OR `u`.`nombre` like ifnull(`usuario3`(),`u`.`nombre`)) AND (`c`.`titulo` like ifnull(`curso1`(),`c`.`titulo`) OR `c`.`titulo` like ifnull(`curso2`(),`c`.`titulo`) OR `c`.`titulo` like ifnull(`curso3`(),`c`.`titulo`)) AND `c`.`estatus` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_carrito_cursos_gratis`
--
DROP TABLE IF EXISTS `vw_carrito_cursos_gratis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_carrito_cursos_gratis`  AS SELECT `c`.`id_curso` AS `id_curso`, `fun_id_fases_curso_gratis`(`c`.`id_curso`) AS `id_fases`, `c`.`tipo` AS `tipo`, `c`.`imagen` AS `imagen`, `c`.`titulo` AS `titulo`, `fun_fases_curso_gratis`(`c`.`id_curso`) AS `fases`, `c`.`precio` AS `monto` FROM ((`curso` `c` join `curso_deseado` `cd` on(`cd`.`id_curso` = `c`.`id_curso` and `cd`.`id_usuario` = `clave_usuario`())) join `fase` `f` on(`f`.`id_fase` = `cd`.`id_fase`)) WHERE `c`.`tipo` = 0 AND `cd`.`adquirido` = 0 AND `cd`.`id_usuario` = `clave_usuario`() GROUP BY `c`.`titulo` ORDER BY `c`.`precio` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_carrito_fases_gratis`
--
DROP TABLE IF EXISTS `vw_carrito_fases_gratis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_carrito_fases_gratis`  AS SELECT `c`.`id_curso` AS `id_curso`, `cd`.`id_fase` AS `id_fases`, `c`.`tipo` AS `tipo`, `c`.`imagen` AS `imagen`, `c`.`titulo` AS `titulo`, `f`.`nombre` AS `fases`, `f`.`monto` AS `monto` FROM ((`curso` `c` join `curso_deseado` `cd` on(`cd`.`id_curso` = `c`.`id_curso` and `cd`.`id_usuario` = `clave_usuario`())) join `fase` `f` on(`f`.`id_fase` = `cd`.`id_fase`)) WHERE `c`.`tipo` > 0 AND `cd`.`adquirido` = 0 AND `cd`.`id_usuario` = `clave_usuario`() AND `f`.`tipo` = 0 GROUP BY `f`.`nombre` ORDER BY `f`.`monto` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_carrito_paga`
--
DROP TABLE IF EXISTS `vw_carrito_paga`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_carrito_paga`  AS SELECT `c`.`id_curso` AS `id_curso`, `fun_id_fases_curso_paga`(`c`.`id_curso`,`cd`.`id_fase`) AS `id_fases`, `c`.`tipo` AS `tipo`, `c`.`imagen` AS `imagen`, `c`.`titulo` AS `titulo`, `fun_nom_fase_paga`(`c`.`id_curso`,`cd`.`id_fase`) AS `fases`, `fun_monto_carrito`(`c`.`id_curso`,`cd`.`id_usuario`,`cd`.`id_fase`) AS `monto` FROM ((`curso` `c` join `curso_deseado` `cd` on(`cd`.`id_curso` = `c`.`id_curso` and `cd`.`id_usuario` = `clave_usuario`())) join `fase` `f` on(`f`.`id_fase` = `cd`.`id_fase`)) WHERE `c`.`tipo` > 0 AND `cd`.`adquirido` = 0 AND `cd`.`id_usuario` = `clave_usuario`() AND `f`.`tipo` = 1 GROUP BY `fun_nom_fase_paga`(`c`.`id_curso`,`cd`.`id_fase`) ORDER BY `fun_monto_carrito`(`c`.`id_curso`,`cd`.`id_usuario`,`cd`.`id_fase`) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_comentarios_curso`
--
DROP TABLE IF EXISTS `vw_comentarios_curso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_comentarios_curso`  AS SELECT `u`.`id_usuario` AS `id_usuario`, `u`.`nombre` AS `nombre`, `u`.`foto` AS `foto`, `c`.`comentario` AS `comentario`, `c`.`fech_salida` AS `fech_salida` FROM (`comentario` `c` join `usuario` `u` on(`c`.`id_usuario` = `u`.`id_usuario`)) WHERE `c`.`id_curso` = `clave_curso`() ORDER BY `c`.`fech_salida` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cursos_creados`
--
DROP TABLE IF EXISTS `vw_cursos_creados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cursos_creados`  AS SELECT DISTINCT `curso`.`id_curso` AS `id_curso`, `curso`.`titulo` AS `titulo`, `fun_total_ventas`(`curso`.`id_curso`) AS `total_recaudado`, `fun_cuenta_alumnos`(`curso`.`id_curso`) AS `total_alumnos`, `fun_total_likes`(`curso`.`id_curso`) AS `total_likes`, `fun_total_dislikes`(`curso`.`id_curso`) AS `total_dislikes`, `curso`.`estatus` AS `estatus`, `fun_nivel_promedio`(`curso`.`id_curso`) AS `nivel_promedio` FROM `curso` WHERE `curso`.`id_usuario` = `clave_usuario`() ;

-- --------------------------------------------------------

--
-- Structure for view `vw_cursos_usuario`
--
DROP TABLE IF EXISTS `vw_cursos_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cursos_usuario`  AS SELECT DISTINCT `curso`.`id_curso` AS `id_curso`, `curso`.`imagen` AS `imagen`, `curso`.`titulo` AS `titulo`, `curso`.`descripcion` AS `descripcion`, `fun_trae_categorias`(`curso`.`id_curso`) AS `categorias`, `fun_total_likes`(`curso`.`id_curso`) AS `total_likes`, `fun_costo`(`curso`.`id_curso`) AS `precio`, `fun_nombre_autor`(`curso`.`id_usuario`) AS `nombre_usuario`, `fun_progreso`(`curso`.`id_curso`,`clave_usuario`()) AS `progreso` FROM ((`curso` join `curso_deseado` on(`curso_deseado`.`id_curso` = `curso`.`id_curso` and `curso_deseado`.`adquirido` = 1)) join `usuario` on(`usuario`.`id_usuario` = `curso_deseado`.`id_usuario`)) WHERE `curso_deseado`.`id_usuario` = `clave_usuario`() ;

-- --------------------------------------------------------

--
-- Structure for view `vw_detalle_curso_creado`
--
DROP TABLE IF EXISTS `vw_detalle_curso_creado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_detalle_curso_creado`  AS SELECT `f`.`id_usuario` AS `id_usuario`, `f`.`nombre` AS `nombre`, `f`.`email` AS `email`, `fun_fase_actual`(`f`.`id_usuario`,`clave_curso`()) AS `fase_actual`, `fun_progreso`(`cd`.`id_curso`,`f`.`id_usuario`) AS `progreso`, `fun_curso_acabado`(`f`.`id_usuario`,`cd`.`id_curso`) AS `curso_acabado`, `cd`.`fecha_inscripcion` AS `fecha_inscripcion`, `fun_total_usuario_curso`(`clave_curso`(),`f`.`id_usuario`) AS `pagado`, `fun_nombre_fp`(`cd`.`id_usuario`,`clave_curso`()) AS `forma_pago` FROM ((`usuario` `f` join `curso_deseado` `cd` on(`f`.`id_usuario` = `cd`.`id_usuario` and `cd`.`adquirido` = 1)) join `curso` `c` on(`c`.`id_curso` = `cd`.`id_curso`)) WHERE `cd`.`id_curso` = `clave_curso`() AND `f`.`id_usuario` = `cd`.`id_usuario` AND `cd`.`adquirido` = 1 GROUP BY `cd`.`id_usuario` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_info_curso`
--
DROP TABLE IF EXISTS `vw_info_curso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_info_curso`  AS SELECT `u`.`id_usuario` AS `id_usuario`, `u`.`nombre` AS `nombre`, `c`.`titulo` AS `titulo`, `c`.`descripcion` AS `descripcion`, `fun_total_likes`(`clave_curso`()) AS `likes`, `fun_total_dislikes`(`clave_curso`()) AS `dislikes`, `fun_porcentaje_likes`(`clave_curso`()) AS `porcentaje_likes`, `fun_cuenta_alumnos`(`clave_curso`()) AS `alumnos`, `fun_costo`(`clave_curso`()) AS `precio`, `c`.`imagen` AS `imagen` FROM (`curso` `c` join `usuario` `u` on(`u`.`id_usuario` = `c`.`id_usuario`)) WHERE `c`.`id_curso` = `clave_curso`() ;

-- --------------------------------------------------------

--
-- Structure for view `vw_info_curso_contenidos`
--
DROP TABLE IF EXISTS `vw_info_curso_contenidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_info_curso_contenidos`  AS SELECT `f`.`nombre` AS `fase`, `c`.`nombre` AS `contenido` FROM (`contenido` `c` join `fase` `f` on(`f`.`id_fase` = `c`.`id_fase`)) WHERE `c`.`id_curso` = `clave_curso`() ;

-- --------------------------------------------------------

--
-- Structure for view `vw_mas_recientes`
--
DROP TABLE IF EXISTS `vw_mas_recientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mas_recientes`  AS SELECT `curso`.`id_curso` AS `id_curso`, `curso`.`imagen` AS `imagen`, `curso`.`titulo` AS `titulo`, `curso`.`descripcion` AS `descripcion`, `fun_trae_categorias`(`curso`.`id_curso`) AS `Categorias`, `fun_total_likes`(`curso`.`id_curso`) AS `total_likes`, `fun_costo`(`curso`.`id_curso`) AS `precio` FROM `curso` WHERE `curso`.`estatus` = 1 ORDER BY `curso`.`id_curso` DESC LIMIT 0, 4 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_mas_vendidos`
--
DROP TABLE IF EXISTS `vw_mas_vendidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mas_vendidos`  AS SELECT `curso`.`id_curso` AS `id_curso`, `curso`.`imagen` AS `imagen`, `curso`.`titulo` AS `titulo`, `curso`.`descripcion` AS `descripcion`, `fun_trae_categorias`(`curso`.`id_curso`) AS `Categorias`, `fun_total_likes`(`curso`.`id_curso`) AS `total_likes`, `fun_costo`(`curso`.`id_curso`) AS `precio`, `fun_ventas_curso`(`curso`.`id_curso`) AS `cursos_vendidos` FROM `curso` WHERE `curso`.`estatus` = 1 ORDER BY `fun_ventas_curso`(`curso`.`id_curso`) DESC LIMIT 0, 4 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_mejor_calificados`
--
DROP TABLE IF EXISTS `vw_mejor_calificados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mejor_calificados`  AS SELECT `curso`.`id_curso` AS `id_curso`, `curso`.`imagen` AS `imagen`, `curso`.`titulo` AS `titulo`, `curso`.`descripcion` AS `descripcion`, `fun_trae_categorias`(`curso`.`id_curso`) AS `Categorias`, `fun_total_likes`(`curso`.`id_curso`) AS `total_likes`, `fun_costo`(`curso`.`id_curso`) AS `precio` FROM `curso` WHERE `curso`.`estatus` = 1 ORDER BY `fun_total_likes`(`curso`.`id_curso`) DESC LIMIT 0, 4 ;

-- --------------------------------------------------------

--
-- Structure for view `vw_mensajes_de_usuarios`
--
DROP TABLE IF EXISTS `vw_mensajes_de_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mensajes_de_usuarios`  AS SELECT `m`.`id_usuario1` AS `id_emisor`, `m`.`id_usuario2` AS `id_receptor`, `m`.`mensaje` AS `mensaje`, `u`.`nombre` AS `nombre`, `m`.`fech_salida` AS `fech_salida` FROM (`mensaje` `m` join `usuario` `u` on(`u`.`id_usuario` = `m`.`id_usuario1`)) WHERE `m`.`id_usuario1` = `clave_usuario`() AND `m`.`id_usuario2` = `clave_usuario2`() OR `m`.`id_usuario1` = `clave_usuario2`() AND `m`.`id_usuario2` = `clave_usuario`() GROUP BY `m`.`fech_salida` ORDER BY `m`.`fech_salida` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_total_curso_forma_pago`
--
DROP TABLE IF EXISTS `vw_total_curso_forma_pago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_total_curso_forma_pago`  AS SELECT `fp`.`nombre` AS `nombre`, sum(`fun_ingresos_forma_pago_curso`(`fp`.`id_fp`,`c`.`id_curso`)) AS `total_fp` FROM (`forma_pago` `fp` join `curso` `c`) WHERE `c`.`id_usuario` = `clave_usuario`() GROUP BY `fp`.`nombre` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ver_contenidos_curso`
--
DROP TABLE IF EXISTS `vw_ver_contenidos_curso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ver_contenidos_curso`  AS SELECT `f`.`nombre` AS `fase` FROM ((`contenido` `c` join `fase` `f` on(`f`.`id_fase` = `c`.`id_fase`)) join `progreso` `p` on(`p`.`id_curso` = `c`.`id_curso`)) WHERE `c`.`id_curso` = `clave_curso`() AND `p`.`id_fase` = `f`.`id_fase` AND `p`.`id_usuario` = `clave_usuario`() AND `p`.`finalizado` = 1 GROUP BY `f`.`nombre` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_curso`,`id_usuario`),
  ADD KEY `fk_alumno_calificacion` (`id_usuario`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `fk_usuario_categoria` (`id_usuario`);

--
-- Indexes for table `categoria_curso`
--
ALTER TABLE `categoria_curso`
  ADD PRIMARY KEY (`id_categoria`,`id_curso`),
  ADD KEY `fk_curso_categoria_curso` (`id_curso`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_curso`,`id_usuario`,`fech_salida`),
  ADD KEY `fk_alumno_comentario` (`id_usuario`);

--
-- Indexes for table `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id_contenido`),
  ADD KEY `fk_curso_contenido` (`id_curso`),
  ADD KEY `fk_fase_contenido` (`id_fase`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_maestro_curso` (`id_usuario`);

--
-- Indexes for table `curso_deseado`
--
ALTER TABLE `curso_deseado`
  ADD PRIMARY KEY (`id_curso`,`id_usuario`,`id_fase`),
  ADD KEY `fk_alumno_adquisicion` (`id_usuario`),
  ADD KEY `fk_FP_adquisicion` (`forma_pago`),
  ADD KEY `fk_fase_adquisicion` (`id_fase`);

--
-- Indexes for table `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`id_fase`),
  ADD KEY `fk_curso_fase` (`id_curso`);

--
-- Indexes for table `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_fp`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_usuario1`,`id_usuario2`,`fech_salida`),
  ADD KEY `fk_usuario2_mensaje` (`id_usuario2`);

--
-- Indexes for table `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`id_curso`,`id_usuario`,`id_fase`),
  ADD KEY `fk_alumno_progreso` (`id_usuario`),
  ADD KEY `fk_fase_progreso` (`id_fase`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id_fase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_fp` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_alumno_calificacion` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_curso_calificacion` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_usuario_categoria` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `categoria_curso`
--
ALTER TABLE `categoria_curso`
  ADD CONSTRAINT `fk_categoria_categoria_curso` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_curso_categoria_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_alumno_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_curso_comentario` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `fk_curso_contenido` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `fk_fase_contenido` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id_fase`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_maestro_curso` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `curso_deseado`
--
ALTER TABLE `curso_deseado`
  ADD CONSTRAINT `fk_FP_adquisicion` FOREIGN KEY (`forma_pago`) REFERENCES `forma_pago` (`id_fp`),
  ADD CONSTRAINT `fk_alumno_adquisicion` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_curso_adquisicion` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `fk_fase_adquisicion` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id_fase`);

--
-- Constraints for table `fase`
--
ALTER TABLE `fase`
  ADD CONSTRAINT `fk_curso_fase` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_usuario1_mensaje` FOREIGN KEY (`id_usuario1`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_usuario2_mensaje` FOREIGN KEY (`id_usuario2`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `fk_alumno_progreso` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_curso_progreso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `fk_fase_progreso` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id_fase`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
