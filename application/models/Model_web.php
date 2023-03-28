<?php

class Model_web extends CI_Model
{

    /************************************************Menu****************************************************/

    public function listar_menu()
    {
        $this->db->select('
                            cn.id_cat_noticia,
                            cn.nc_noticia,
                            cn.nc_icono,
                            cn.nc_categoria,
                            cn.nc_url,
                            (
                                select count(*) 
                                from cat_noticia 
                                where cat_noticia.nc_categoria = cn.id_cat_noticia

                            ) as count
                        ');
        $this->db->from('cat_noticia cn');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function listar_opcion()
    {
        $this->db->where('nc_categoria !=', NULL);
        $this->db->select('*');
        $this->db->from('cat_noticia');
        $query = $this->db->get();
        return $query->result_array();
    }

    /************************************************Home****************************************************/

    public function listar_carrousel()
    {
        $this->db->where('estado', 'Activo');
        $this->db->select('*');
        $this->db->from('carrousel');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function ultima_edicion()
    {
        $this->db->order_by('id_edicion', 'DESC');
        $this->db->where('estado', 'Activo');
        $this->db->select('*');
        $this->db->from('edicion');
        $this->db->limit(1);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function ultimas_noticias($edicion)
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('edi.id_edicion', $edicion);
        $this->db->where('noti_foto.principal', 1);
        $this->db->order_by('noti.id_noticia', 'RANDOM');
        $this->db->select('
                            noti.id_noticia,
                            noti.Titular,
                            noti.Subtitulo,
                            LEFT(noti.Nota,500) AS Nota,
                            DATE_FORMAT(noti.Fecha, "%d de %M del %Y")  as Fecha,
                            noti.Editor,
                            noti.Reportero,
                            noti.Visita,
                            cat.nc_noticia,
                            cat.nc_icono,
                            foto.url,
                            foto.Fotografo
        ');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat', 'cat.id_cat_noticia = noti.id_cat_noticia');
        $this->db->join('edicion_noticia ed_not', 'ed_not.id_noticia = noti.id_noticia');
        $this->db->join('edicion edi', 'edi.id_edicion = ed_not.id_edicion');
        $this->db->join('noticia_foto noti_foto', 'noti_foto.id_noticia = noti.id_noticia');
        $this->db->join('fotografia foto', 'foto.id_foto = noti_foto.id_foto');
        $this->db->limit(3);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function ultimas_ediciones()
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->order_by('edi.id_edicion', 'DESC');
        $this->db->where('edi.estado', 'Activo');
        $this->db->select('
                            edi.id_edicion,
                            edi.fecha_publicacion,
                            edi.num_edicion,
                            (
                                select noti.id_noticia from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion 
                                order by RAND()
                                limit 1
                            ) as Noticia,
                            (
                                select noti.id_noticia from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion
                                order by noti.id_noticia
                                limit 1
                            ) as id_noticia,
                            (
                                select Titular from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion
                                order by noti.id_noticia
                                limit 1
                            ) as Titular,
                            (
                                select LEFT(noti.Nota,300) AS Nota from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion
                                order by noti.id_noticia
                                limit 1
                            ) as Nota,
                            (
                                select Fecha from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion
                                order by noti.id_noticia
                                limit 1
                            ) as Fecha,
                            (
                                select foto.url from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                inner join noticia_foto noti_foto on noti_foto.id_noticia = noti.id_noticia
                                inner join fotografia foto on foto.id_foto = noti_foto.id_foto
                                where edi_noti.id_edicion = edi.id_edicion
                                order by noti.id_noticia
                                limit 1
                            ) as url
                            
        ');
        $this->db->from('edicion edi');
        $this->db->limit(3);
        $query =  $this->db->get();
        return $query->result_array();
    }

    /************************************************Footer****************************************************/

    public function listar_redes()
    {
        $this->db->where('estado', 'Activo');
        $this->db->select('*');
        $this->db->from('redes');
        $query =  $this->db->get();
        return $query->result_array();
    }

    /************************************************Categorias****************************************************/

    public function ultima_categoria($id_categoria)
    {
        $this->db->where('id_cat_noticia', $id_categoria);
        $this->db->select('*');
        $this->db->from('cat_noticia');
        $this->db->limit(1);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function listar_noticias($categoria, $buscar, $inicio = FALSE, $cantidad = FALSE)
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('cat.id_cat_noticia', $categoria);
        $this->db->like("noti.Titular", $buscar);
        $this->db->where('noti_foto.principal', 1);
        if ($inicio !== FALSE && $cantidad !== FALSE) {
            $this->db->limit($cantidad, $inicio);
        }
        $this->db->order_by('noti.Fecha', 'DESC');
        $this->db->select('
                            noti.id_noticia,
                            noti.Titular,
                            noti.Subtitulo,
                            LEFT(noti.Nota,150) AS Nota,
                            LEFT(noti.Nota,500) AS Editorial,
                            DATE_FORMAT(noti.Fecha, "%d / %M / %Y")  as Fecha,
                            noti.Editor,
                            noti.Reportero,
                            noti.Visita,
                            cat.nc_noticia,
                            cat.nc_icono,
                            foto.url,
                            foto.Fotografo
        ');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat', 'cat.id_cat_noticia = noti.id_cat_noticia');
        $this->db->join('noticia_foto noti_foto', 'noti_foto.id_noticia = noti.id_noticia');
        $this->db->join('fotografia foto', 'foto.id_foto = noti_foto.id_foto');
        $query =  $this->db->get();
        return $query->result_array();
    }

    /***************************************************************************************/

    public function listar_ediciones($buscar, $inicio = FALSE, $cantidad = FALSE)
    {
        $estado = 'Activo';
        $this->db->where('edi.estado', $estado);
        $this->db->like('edi.num_edicion', $buscar);
        if ($inicio !== FALSE && $cantidad !== FALSE) {
            $this->db->limit($cantidad, $inicio);
        }
        $this->db->order_by('edi.fecha_publicacion', 'DESC');
        $this->db->select('
                        DATE_FORMAT(edi.fecha_publicacion, "%d de %M del %Y")  as fecha_publicacion,
                        edi.num_edicion,
                        edi.id_edicion,
                        edi.estado,
                        (
                            select foto.url from noticias noti
                            inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                            inner join noticia_foto noti_foto on noti_foto.id_noticia = noti.id_noticia
                            inner join fotografia foto on foto.id_foto = noti_foto.id_foto
                            inner join edicion edt on edi_noti.id_edicion = edt.id_edicion
                            where edt.num_edicion = edi.num_edicion and noti_foto.principal = 1 and noti.id_cat_nivel = 1
                            order by noti.id_noticia desc
                            limit 1

                        ) as url,
                        (
                            select Titular from noticias noti
                            inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                            where edi_noti.id_edicion = edi.id_edicion and noti.id_cat_nivel = 1
                            order by noti.id_noticia desc
                            limit 1
                        ) as titular,
                        (
                            select substring(noti.Nota, 1, locate(".", noti.Nota)) from noticias noti
                                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                                where edi_noti.id_edicion = edi.id_edicion and noti.id_cat_nivel = 1
                                order by noti.id_noticia desc
                                limit 1
                        ) as nota
        ');
        $this->db->from('edicion edi');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function listar_edicion($idEdicion, $buscar, $inicio = FALSE, $cantidad = FALSE)
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('en.id_edicion', $idEdicion);
        $this->db->like("noti.Titular", $buscar);

        if ($inicio !== FALSE && $cantidad !== FALSE) {
            $this->db->limit($cantidad, $inicio);
        }
        $this->db->order_by('noti.id_noticia', 'DESC');
        $this->db->select(' noti.id_noticia, 
                            noti.Titular, 
                            noti.Subtitulo,
                            LEFT(noti.Nota,150) AS Nota,
                            DATE_FORMAT(noti.Fecha, "%d/%M/%Y")  as Fecha,
                            noti.Editor, 
                            noti.Reportero, 
                                (
                                    select foto.url from fotografia foto
                                    inner join noticia_foto noti_foto on foto.id_foto = noti_foto.id_foto
                                    where noti_foto.id_noticia = noti.id_noticia and noti_foto.principal = 1
                                    limit 1
        
                                ) as url
                                  
                        ');
        $this->db->from('noticias noti');
        $this->db->join('edicion_noticia en', 'en.id_noticia = noti.id_noticia');
        $query =  $this->db->get();
        return $query->result_array();
    }

    /************************************************Ver Noticia***************************************************/

    public function get_noticia($notiId)
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('noti.id_noticia', $notiId);
        $this->db->select('
                noti.id_noticia,
                noti.Titular,
                noti.Subtitulo,
                noti.Nota,
                DATE_FORMAT(noti.Fecha, "%d de %M del %Y")  as Fecha,
                noti.Editor,
                noti.Reportero,
                noti.Visita,
                cat.nc_noticia,
                cat.nc_icono,
                foto.url,
                foto.Fotografo
        ');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat', 'cat.id_cat_noticia = noti.id_cat_noticia', 'left');
        $this->db->join('edicion_noticia ed_not', 'ed_not.id_noticia = noti.id_noticia', 'left');
        $this->db->join('edicion edi', 'edi.id_edicion = ed_not.id_edicion', 'left');
        $this->db->join('noticia_foto noti_foto', 'noti_foto.id_noticia = noti.id_noticia', 'left');
        $this->db->join('fotografia foto', 'foto.id_foto = noti_foto.id_foto', 'left');
        $this->db->limit(1);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function get_galeria($notiId)
    {
        $this->db->where('noti.id_noticia', $notiId);
        $this->db->where('noti_foto.principal', 0);
        $this->db->select('
                            foto.url,
        ');
        $this->db->from('noticias noti');
        $this->db->join('noticia_foto noti_foto', 'noti_foto.id_noticia = noti.id_noticia');
        $this->db->join('fotografia foto', 'foto.id_foto = noti_foto.id_foto');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function sugerencia_noticias()
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('noti_foto.principal', 1);
        $this->db->order_by('noti.id_noticia', 'RANDOM');
        $this->db->select('
                            noti.id_noticia,
                            noti.Titular,
                            noti.Subtitulo,
                            LEFT(noti.Nota,250) AS Nota,
                            DATE_FORMAT(noti.Fecha, "%d/%M/%y")  as Fecha,
                            noti.Editor,
                            noti.Reportero,
                            noti.Visita,
                            cat.nc_noticia,
                            cat.nc_icono,
                            foto.url,
                            foto.Fotografo
        ');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat', 'cat.id_cat_noticia = noti.id_cat_noticia');
        $this->db->join('edicion_noticia ed_not', 'ed_not.id_noticia = noti.id_noticia');
        $this->db->join('edicion edi', 'edi.id_edicion = ed_not.id_edicion');
        $this->db->join('noticia_foto noti_foto', 'noti_foto.id_noticia = noti.id_noticia');
        $this->db->join('fotografia foto', 'foto.id_foto = noti_foto.id_foto');
        $this->db->limit(9);
        $query =  $this->db->get();
        return $query->result_array();
    }

    /************************Ver perfiles*********************************/
    public function listar_perfiles($buscar, $inicio = FALSE, $cantidad = FALSE)
    {
        $this->db->like("perf.nombre", $buscar);
        $this->db->where('perf.estado', 'Activo');
        if ($inicio !== FALSE && $cantidad !== FALSE) {
            $this->db->limit($cantidad, $inicio);
        }
        $this->db->order_by('perf.idperfiles', 'DESC');
        $this->db->select('
                        perf.idperfiles,
                        perf.nombre,
                        perf.url_foto                        
        ');
        $this->db->from('perfiles perf');
        $query =  $this->db->get();
        return $query->result_array();
    }

    /**************************Ver Perfil**********************************/

    public function get_comentarios($perfilId)
    {
        $this->db->where('comen.idperfiles', $perfilId);
        $this->db->where('comen.estado', 1);
        $this->db->select('
                            comen.idComentario,
                            comen.nombre,
                            comen.comentario,
                            comen.titulo,
                            comen.estado,
                            comen.foto_comen
        ');
        $this->db->from('comentario comen');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function get_perfil($perfilId)
    {
        $this->db->query("SET lc_time_names = 'es_ES'");
        $this->db->where('perf.idperfiles', $perfilId);
        $this->db->select('
                            perf.idperfiles,
                            perf.nombre,
                            perf.info,
                            perf.estado,
                            perf.url_foto,
                            perf.cargo,
                            perf.banner,
                            DATE_FORMAT(perf.fecha_crea, "%d de %M del %Y")  as fecha_crea
        ');
        $this->db->from('perfiles perf');
        $query =  $this->db->get();
        return $query->result_array();
    }

    /************************Contadores*********************************/
    public function listar_contadores()
    {
        $this->db->query('SET lc_time_names = "es_ES"');
        $this->db->select(
            '
                noticias.id_noticia, 
                noticias.id_cat_noticia, 
                noticias.id_cat_nivel, 
                count(noticias.id_noticia) as top,
                noticias.Titular, 
                noticias.Subtitulo, 
                LEFT(noticias.Nota,200) AS Nota, 
                noticias.Fecha, 
                noticias.Editor, 
                noticias.Reportero, 
                noticias.Visita,
                fotografia.url'
        );
        $this->db->from('tbl_stats_count');
        $this->db->join('noticias', 'noticias.id_noticia = tbl_stats_count.id_noticia', 'inner');
        $this->db->join('noticia_foto', 'noticia_foto.id_noticia = noticias.id_noticia', 'inner');
        $this->db->join('fotografia', 'fotografia.id_foto = noticia_foto.id_foto', 'inner');
        ##comenta esta linea para ver datos##
        /*sirve para hacer un top mensual*/ //$this->db->where('month(noticias.Fecha) = month(now()) and year(noticias.Fecha) = year(now())'); 
        ##comenta esta linea para ver datos##
        $this->db->where('noticia_foto.principal', 1);
        $this->db->group_by('noticias.id_noticia');
        $this->db->order_by('count(noticias.id_noticia)', 'desc');
        $this->db->limit(10);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function list_count_edi()
    {
        $this->db->query('SET lc_time_names = "es_ES"');
        $this->db->select('
            DATE_FORMAT(edi.fecha_publicacion, "%d de %M del %Y")  as fecha_publicacion,
            edi.num_edicion,
            edi.id_edicion,
            edi.estado,
            (
                select foto.url from noticias noti
                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                inner join noticia_foto noti_foto on noti_foto.id_noticia = noti.id_noticia
                inner join fotografia foto on foto.id_foto = noti_foto.id_foto
                inner join edicion edt on edi_noti.id_edicion = edt.id_edicion
                where edt.num_edicion = edi.num_edicion and noti_foto.principal = 1 and noti.id_cat_nivel = 1
                order by noti.id_noticia desc
                limit 1

            ) as url,
            (
                select Titular from noticias noti
                inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                where edi_noti.id_edicion = edi.id_edicion and noti.id_cat_nivel = 1
                order by noti.id_noticia desc
                limit 1
            ) as titular,
            (
                select substring(noti.Nota, 1, locate(".", noti.Nota)) from noticias noti
                    inner join edicion_noticia edi_noti on noti.id_noticia = edi_noti.id_noticia
                    where edi_noti.id_edicion = edi.id_edicion and noti.id_cat_nivel = 1
                    order by noti.id_noticia desc
                    limit 1
            ) as nota,
            count(edi.id_edicion) as top
');

        $this->db->from('tbl_edi_count');
        $this->db->join('edicion edi', 'edi.id_edicion = tbl_edi_count.id_edicion', 'inner');
        $this->db->group_by('edi.id_edicion');
        $this->db->order_by('count(edi.id_edicion)', 'desc');
        $this->db->limit(10);
        $query =  $this->db->get();
        return $query->result_array();

    }
}
