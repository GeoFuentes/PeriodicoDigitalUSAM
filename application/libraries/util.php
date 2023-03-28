<?php if (!defined('BASEPATH')) exit();
class util {



	/*
	* @xides
	* Obteniendo instancia de CI por si necesitamos usar sus propios metodos...
	*/
	function __construct(){
		$this->ci =& get_instance();
		setlocale(LC_MONETARY, 'en_US');
	}

	function fecha_entendible( $fecha = '00-00-0000' ){
		$array = explode('-', $fecha);
		$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12 =>'Diciembre');
		return $array[0]." de ".$meses[ (int)$array[1] ]." de ".$array[2];
	}


	function dui($dui){
		return !preg_match( '/^[0-9]\d{8}$/' , $dui) ? FALSE : TRUE;
	}





	function loadConfigEmail(){
		/* Using PopStudios smtp */
		//$this->email->set_mailtype("html");
		/*
		$this->ci->load->library('email');
        $this->ci->email->clear();
		$config['useragent'] = "AGENTE";
		$config['mailpath']  = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
		$config['protocol']  = "smtp";
		$config['smtp_host'] = "mail.popstudios.com.sv";
		$config['smtp_user'] = 'correo@domain.com.sv';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = "25";
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";
		$config['wordwrap']  = true;
		$config['from']      = "soporte@demo.com";
		$config['autor']     = "demo";
		$config['multipart'] = "related";
        $this->ci->email->initialize($config);
		$this->ci->email->from( $config['from'], $config['autor'] );
        */

        /*Using Google count*/

	  //       $this->ci->load->library('email');
	  //       $this->ci->email->clear();
	  //      	$config['protocol'] = 'smtp';
	  //       $config['mail_path'] = 'ssl://smtp.googlemail.com';
	  //       $config['smtp_host'] = 'ssl://smtp.googlemail.com';
	  //       $config['smtp_port'] =  465;
	  //       $config['smtp_user'] = '';

	  //       $config['smtp_pass'] = '';

	  //       $config['charset'] = "utf-8";
	  //       $config['mailtype'] = "html";
	  //       $config['newline'] = "\r\n";
	  //       $config['from'] = "soporte@pizza.com";
	  //       $config['autor'] = "Pizza Team";
			// $this->ci->email->initialize($config);
			// $this->ci->email->from( $config['from'], $config['autor'] );



        // return $config;
	}#End function loadConfigEmail





	/*
	* Retorna la configuracion de archivos/documentos  - Un array .
	* $ruta es requerido porque los archivos no pueden quedar en ruta ppal(seteada en config)
	* $ruta es el agregado a la ruta seteada en application/config.php. Ejem C:/RUTAENCONFIG/$ruta.
	* Si ruta no existe, la crea con todos los permisos.
	* Define el tipo de archivos a recibir.
	*/
	function load_file_config( $ruta="" ){

		$config = array();

		if ($ruta==="")die('Ruta requerida');

		if ( $this->ci->config->item('real_path_documents')==="" || !$this->ci->config->item('real_path_documents') ) {
			die('Debe configurar real path en application/config.php ');
		}else{

			$ruta = mb_strtolower( $ruta );

			$ruta_real  = $this->ci->config->item('real_path_documents');
			$ruta_real  .= $ruta;


			if( !file_exists($ruta_real) ) {
				if ( ! mkdir($ruta_real,0777,true) ) die('No pudo crearse la ruta, verifique permisos de archivo/carpetas.');
			}

			$config['allowed_types']= 'pdf|doc|docx|xls|xlsx|csv';
			$config['remove_spaces']= true;
			$config['upload_path']  = $ruta_real;
			$config['ruta_real']    = $ruta_real;
			//$config['max_size']     = 2048; /* The maximum size (in kilobytes) that the file can be. Set to zero for no limit. Note: Most PHP installations have their own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default. */
		}

		return $config;
	}




	function load_form_messages( $lang = "" ){
		if ( $lang == "es" ) {
			$this->ci->form_validation->set_message('required', 'El campo %s es requerido.');
			$this->ci->form_validation->set_message('valid_email', 'Por favor ingrese un email válido.');
			$this->ci->form_validation->set_message('max_length', 'Por favor ingrese la cantidad de valores permitidos.');
			$this->ci->form_validation->set_message('matches', 'Los campos %s y %s debe coincidir.');
			$this->ci->form_validation->set_message('xss_clean', 'El campo %s debe mantener valores limpios');
			$this->ci->form_validation->set_message('max_length', 'El campo %s debe tener %s caracteres como máximo');
			$this->ci->form_validation->set_message('min_length', 'El campo %s debe tener %s caracteres como minimo');
			$this->ci->form_validation->set_message('integer', 'El campo %s debe contener valores numéricos');
			$this->ci->form_validation->set_message('is_unique', 'El valor de %s ya existe en el sistema.');
			$this->ci->form_validation->set_message('numeric', 'El campo %s debe contener solo números');
			$this->ci->form_validation->set_message('is_natural', 'El campo %s debe contener solo números mayores o iguales que 0.');
			$this->ci->form_validation->set_message('decimal', 'El campo %s debe contener números decimales.');
			$this->ci->form_validation->set_message('is_money', '%s debe ser formato moneda.');
			$this->ci->form_validation->set_message('greater_than', '%s debe ser mayor que %s.');
		}
	}




	function object2array($valor){
	    if( !(is_array($valor) || is_object($valor)) ){ //si no es un objeto ni un array
	        $dato = $valor; //lo deja
	    } else { //si es un objeto
	        foreach($valor as $key => $valor1){ //lo conteo
	            $dato[$key] = $this->object2array($valor1); //
	        }
	    }
	    return $dato;
	}




	function valid_date($date, $format = 'YYYY-MM-DD'){
		if(strlen($date) >= 8 && strlen($date) <= 10){
			$separator_only = str_replace(array('M','D','Y'),'', $format);
			$separator = $separator_only[0];
		if($separator){
			$regexp = str_replace($separator, "\\" . $separator, $format);
			$regexp = str_replace('MM', '(0[1-9]|1[0-2])', $regexp);
			$regexp = str_replace('M', '(0?[1-9]|1[0-2])', $regexp);
			$regexp = str_replace('DD', '(0[1-9]|[1-2][0-9]|3[0-1])', $regexp);
			$regexp = str_replace('D', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
			$regexp = str_replace('YYYY', '\d{4}', $regexp);
			$regexp = str_replace('YY', '\d{2}', $regexp);
			if($regexp != $date && preg_match('/'.$regexp.'$/', $date)){
				foreach (array_combine(explode($separator,$format), explode($separator,$date)) as $key=>$value) {
					if ($key == 'YY') $year = '20'.$value;
					if ($key == 'YYYY') $year = $value;
					if ($key[0] == 'M') $month = $value;
					if ($key[0] == 'D') $day = $value;
				}
				if (checkdate($month,$day,$year)) return true;
			}
		}
		}
		return false;
	}



	function load_pagination_config( $base_url, $total_rows , $per_page="5", $num_links=2 ){
		$this->ci->load->library('pagination');
		$config['base_url']        = $base_url;
		$config['total_rows']      = $total_rows;
		$config['per_page']        = $per_page;
		$config['num_links']       = $num_links;

		$config['full_tag_open']   = '<div class="center">';
		$config['full_tag_close']  = '</div>';

		$config['first_link']      = 'Primero';
		$config['last_link']       = 'Ultimo';
		$config['first_link']      = false;
		$config['last_link']       = false;

		$config['first_tag_open']  = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state"><span class="ui-button-text" >';
		$config['first_tag_close'] = '</label></span>';

		// $config['prev_link']       = '&larr; ';
		$config['prev_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-state"><span class="ui-button-text" >';
		$config['prev_tag_close']  = '</label></span>';

		// $config['next_link']       = ' &rarr;';
		$config['next_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right ui-state"><span class="ui-button-text" >';
		$config['next_tag_close']  = '</label></span>';

		$config['last_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right ui-state"><span class="ui-button-text" >';
		$config['last_tag_close']  = '</label></span>';

		$config['cur_tag_open']    = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state ui-state-active"><span class="ui-button-text" >';
		$config['cur_tag_close']   = '</label></span>';

		$config['num_tag_open']    = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state"><span class="ui-button-text" >';
		$config['num_tag_close']   = '</label></span>';

		$this->ci->pagination->initialize($config);
		$this->ci->pagination->create_links();
	}



	function load_pagination_simple_config(){
		$this->ci->load->library('pagination');

		$config['full_tag_open']   = '<div class="center">';
		$config['full_tag_close']  = '</div>';

		$config['first_link']      = 'Primero';
		$config['last_link']       = 'Ultimo';
		$config['first_link']      = true;
		$config['last_link']       = true;

		$config['first_tag_open']  = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state"><span class="ui-button-text" >';
		$config['first_tag_close'] = '</label></span>';

		// $config['prev_link']       = '&larr; ';
		$config['prev_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left ui-state"><span class="ui-button-text" >';
		$config['prev_tag_close']  = '</label></span>';

		// $config['next_link']       = ' &rarr;';
		$config['next_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right ui-state"><span class="ui-button-text" >';
		$config['next_tag_close']  = '</label></span>';

		$config['last_tag_open']   = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right ui-state"><span class="ui-button-text" >';
		$config['last_tag_close']  = '</label></span>';

		$config['cur_tag_open']    = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state ui-state-active"><span class="ui-button-text" >';
		$config['cur_tag_close']   = '</label></span>';

		$config['num_tag_open']    = '<label class="ui-button ui-widget ui-state-default ui-button-text-only ui-state"><span class="ui-button-text" >';
		$config['num_tag_close']   = '</label></span>';
		return $config;
	}



	function normaliza2($cadena){
		$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
		ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
		$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
		bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		$cadena = utf8_decode($cadena);
		$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
		$cadena = strtolower($cadena);
		return utf8_encode($cadena);
	}




	function normaliza($cadena) {
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		return str_replace($no_permitidas, $permitidas ,$cadena);
	}


	function quitar_ultimo_y_o( $valores="" ){
		$y_o = trim( substr( $valores , -4 ) );
		if ( $y_o=='y/o' || $y_o=='Y/O' || $y_o=='Y/O' ) {
			return substr( $valores , 0, -4 ); /* quitando y/o sobrante */
		}else{
			return trim( $valores );
		}
	}



	/**
	 * Genera password segun el tamaño requerido
	 * @param  [type] $length [description]
	 * @return [type]         [description]
	 */
	function generate_pass( $length="" ){
		if ($length=="") {
			return 'I need param';
		}
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<$length;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		return $cad;
	}




	function get_permiso( ){

		$this->ci->load->model('model_permisos');

		$data       = explode( '/cyr/', current_url() );
		$nueva      = explode('/', $data[1]);
		$url_actual = $nueva['0']."/".$nueva['1'];

	}




	function get_settings( $id = "" ){
		$this->ci->load->model('model_settings');
		return $this->ci->model_settings->get_settings();
	}





	/*
	* VICTOR
	* ADJUNTA EL NOMBRE AL ASEGURADO O AL CONTRATANTE DE UN PROGRAMA
	* Y A LOS ASEGURADOS ADJUNTA EL RAMO AL CUAL PERTENECE
	 */
	function _adjuntar_nombre_y_ramo( $array ){
		$this->ci->load->model('model_programa');
		$this->ci->load->model('model_cat_empresa_tdr');
		$this->ci->load->model('model_empresa_listados');

		if( !is_array($array) || count($array)==0 ){ return $array; }

		foreach ($array as$k=>$v) {
			// definimos campos dependiendo
			// de la tabla que estemos usando
			if( isset( $v->tipo_asegurado ) ){
				$tipo=$v->tipo_asegurado;
			}else
			if( isset( $v->tipo_contratante ) ){
				$tipo=$v->tipo_contratante;
			}else{ return $array; }
			// definimos idcliente dependiendo
			// de la tabla que estemos usando
			if( isset( $v->idcliente ) ){
				$idcliente=$v->idcliente;
			}else
			if( isset( $v->idcliente_asegurado ) ){
				$idcliente=$v->idcliente_asegurado;
			}else{ return $array; }
			// -------------------
			$my_cliente=$this->ci->model_programa->get_cliente( $idcliente, $tipo );
			$my_tdr    =isset($v->idempresa_tdr) ? $this->ci->model_cat_empresa_tdr->traer_tdr(array('idempresa_tdr'=>$v->idempresa_tdr)) : false;
			// -------------------
			$array[$k]->nombre =($my_cliente!=FALSE)?$my_cliente[0]->nombre:'';
			$array[$k]->nit    =($my_cliente!=FALSE)?$my_cliente[0]->nit:'';
			$array[$k]->dui    =($my_cliente!=FALSE&&isset($my_cliente[0]->dui))?$my_cliente[0]->dui:'';
			$array[$k]->ramo   =($my_tdr!=false)?$my_tdr[0]['descripcion']:'';
			// - adjuntamos los listados en los que es asegurado --
			if( isset( $v->idcot_programa_asegurados ) ){
				$params=array('idcot_programa_asegurados'=>$v->idcot_programa_asegurados);
				$array[$k]->listado= $this->ci->model_empresa_listados->traer_listado_enc($params);
			}else
			if( isset( $v->idpoliza_asegurados ) ){
				$params=array('idpoliza_asegurados'=>$v->idpoliza_asegurados);
				$array[$k]->listado= $this->ci->model_empresa_listados->traer_listado_enc($params);
			}else{
				$array[$k]->listado= false;
			}
		}
		return $array;
	}






	/*
	* VICTOR
	* ADJUNTA LOS NOMBRE DE LOS ASEGURADOS CONCATENADOS POR Y/O E INDIVIDUALMENTE
	* TAMBIEN ADJUNTA LAS ASEGURADORAS IMPLICADAS
	* EXCLUSIVAMENTE PARA EMPRESAS
	 */
	function _colocar_asegurados( $array, $columna, $tabla, $con_tdr=false ){
		$this->ci->load->model('model_programa');
		$this->ci->load->model('model_polizas');
		$this->ci->load->model('model_cat_empresa_tdr');
		if( !is_array($array) || count($array)==0 )return $array;
		foreach ($array as $k=>$v) {
			$my_asegurados=''; $my_tdr=false;
			// OBTENEMOS LOS ASEGURADOS
			if( $tabla=='cot_programa_asegurados' ){
				$asegurados=$this->ci->model_programa->get_programa_asegurados( $columna, $v[ $columna ] );
			}else
			if( $tabla=='poliza_asegurados' ){
				$parameters[ $columna ]     =$v[ $columna ];
				$parameters[ 'tipo_poliza' ]='e';
				$asegurados 		   =$parameters[ $columna ]!=null ? $this->ci->model_polizas->get_asegurados( $parameters ) : false;
			}else{ return $array; }
			if( $asegurados!=false ){
				$count=1;
				$length=count($asegurados);
				foreach ($asegurados as $k2=>$v2) {
					// OBTENEMOS EL TDR AL CUAL PERTENECE EL ASEGURADO
					$my_tdr=$this->ci->model_cat_empresa_tdr->traer_tdr(array('idempresa_tdr'=>$v2->idempresa_tdr));
					// OBTENEMOS EL LA INFORMACIÓN DEL ASEGURADO
					$idcliente     =isset( $v2->idcliente ) ? $v2->idcliente : $v2->idcliente_asegurado;
					$my_cliente    =$this->ci->model_programa->get_cliente( $idcliente, $v2->tipo_asegurado );
					$my_asegurados.=($my_cliente!=FALSE)?$my_cliente[0]->nombre:'';//<-- CONCATENAMOS NOMBRE DEL ASEGURADO
					$my_asegurados.=($my_tdr!=false&&$con_tdr)?' con '.$my_tdr[0]['descripcion']:'';//<-- CONCATENAMOS NOMBRE DEL TDR
					$my_asegurados.=($count<$length)?' Y/O ':'';//<-- CONCATENAMOS Y/O
					$count++;
				}
			}
			$array[$k]['asegurados']	=$my_asegurados;
			$array[$k]['my_ramo'] 		=(isset($v['idempresa_tdr']))?$this->ci->model_cat_empresa_tdr->traer_tdr(array('idempresa_tdr'=>$v['idempresa_tdr'])):false;
			$array[$k]['my_ramo']       =$this->adjuntar_poliza_a_tdr( array( 'tdrs'=>$array[$k]['my_ramo'] ) );
			$array[$k]['my_aseguradora']=(isset($v['idempresa_tdr_aseguradora']))?$this->ci->model_cat_empresa_tdr->traer_aseguradoras_involucradas(array('idempresa_tdr_aseguradora'=>$v['idempresa_tdr_aseguradora'])):false;
		}
		return $array;
	}





	/**
	 * VICTOR
	 * recibe una cadena y devuelve la misma cadena con espacios
	 * usada al generar excel en terminos.
	 * entre sus letras
	 */
	function cadena_espaciada( $params ){
		// params
		$cadena     =isset($params['cadena']) ? $params['cadena'] : '';
		$espaciado1 =isset($params['espaciado1']) ? $params['espaciado1'] : '&nbsp;';
		$espaciado2 =isset($params['espaciado2']) ? $params['espaciado2'] : '&nbsp;';
		$length1    =isset($params['length1']) ? $params['length1'] : 0;
		$length2    =isset($params['length2']) ? $params['length2'] : 1;
		// util
		$cadena_='';
		// validate
		if( !$cadena ){ return $cadena_; }
		for ($i=0; $i<strlen($cadena) ; $i++) {
			$cadena_.=utf8_encode($cadena[$i]);
			if( $cadena[$i]!=' ' ){
				for ($j=0; $j<$length1; $j++) {
					$cadena_.=$espaciado1;
				}
			}else{
				for ($j=1; $j<$length2; $j++) {
					$cadena_.=$espaciado2;
				}
			}
		}
		return $cadena_;
	}







	/**
	 * VICTOR
	 */
	function get_contratantes_string( $params=array() ){
		$idprograma          =isset($params['idprograma']) ? $params['idprograma'] : 0;
		$idcot_programa      =isset($params['idcot_programa']) ? $params['idcot_programa'] : 0;
		$sufijo_end          =isset($params['sufijo_end']) ? $params['sufijo_end'] : '';
		$string_contratantes ='';
		if( !$idprograma && !$idcot_programa ){ return $string_contratantes; }
		$this->ci->load->model('model_programa');
		$this->ci->load->helper('vrbh_helper');
		if( $idprograma ){
			$contratantes=$this->ci->model_programa->get_contratantes_programa( 'idprograma', $idprograma );
		}else if( $idcot_programa ){
			$contratantes=$this->ci->model_programa->get_contratantes( 'idcot_programa', $idcot_programa );
		}
		$contratantes        =( $contratantes!=false ) ? $this->_adjuntar_nombre_y_ramo( $contratantes ) : $contratantes;
		$string_contratantes =concatenar_contratantes__( array('result'=>$contratantes, 'sufijo_end'=>$sufijo_end) );
		return $string_contratantes;
	}





	/**
	 * VICTOR
	 * EXLCUSIVAMENTE PARA EMPRESAS
	 */
	function get_asegurados_string( $params=array() ){
		$this->ci->load->model('model_programa');
		$this->ci->load->model('model_polizas');
		// params
		$idpoliza             =isset($params['idpoliza']) ? $params['idpoliza'] : false;
		$idcot_poliza_empresa =isset($params['idcot_poliza_empresa']) ? $params['idcot_poliza_empresa'] : false;
		$sufijo_end           =isset($params['sufijo_end']) ? $params['sufijo_end'] : '';
		// util
		$asegurados           ='';
		$asegurados_          =false;
		$count                =1;
		$length               =0;
		// validate
		if( !$idpoliza && !$idcot_poliza_empresa ){ return $asegurados; }
		// Se trae el asegurado
		if( $idpoliza ){
			$p=array(
				'idpoliza'    =>$idpoliza,
				'tipo_poliza' =>'e',
				'group_by'    =>'a.idcliente_asegurado'
			);
			$asegurados_=$this->ci->model_polizas->get_asegurados( $p );
		}else
		if( $idcot_poliza_empresa ){
			$asegurados_=$this->ci->model_programa->get_programa_asegurados( 'idcot_poliza_empresa', $idcot_poliza_empresa, true );
		}else{
			return $asegurados;
		}
		// --
		if( $asegurados_ ){
			$length=count( $asegurados_ );
			foreach ($asegurados_ as $k=>$v) {
				if( isset( $v->idcliente ) ){
					$i = $v->idcliente;
				}else
				if( isset( $v->idcliente_asegurado ) ){
					$i = $v->idcliente_asegurado;
				}else{
					$i = 0;
				}
				// Se trae el cliente
				$c=$this->ci->model_programa->get_cliente( $i, $v->tipo_asegurado );
				if( $c ){
					$asegurados.=$c[0]->nombre;
					$asegurados.=($count<$length) ? ' Y/O ' : $sufijo_end;
				}
				$count++;
			}
		}
		return $asegurados;
	}







	/*
	* VICTOR
	* OJO ---->  NO USAR
	 */
	function get_idanexos($params=array()){
		$this->ci->load->model('model_polizas');
		$this->ci->load->model('model_programa');
		// params ------------------------------
		$numero               =isset($params['numero']) ? $params['numero'] : "";
		$numero               =(string)$numero;
		$idcot_poliza_empresa =isset($params['idcot_poliza_empresa']) ? $params['idcot_poliza_empresa'] : 0;
		$idpoliza             =isset($params['idpoliza']) ? $params['idpoliza'] : 0;
		$tipo_poliza 		  =isset($params['tipo_poliza']) ? $params['tipo_poliza'] : 'e';
		// util -----------------
		$match          =false;
		$idanexos_vacio =0;
		$vacio          =true;
		// -----------
		// data source
		$poliza        =false;
		$anexos_actual =false;
		$anexos 	   =false;
		$movimientos   =false;
		// ------
		// return
		$idanexos =null;

		if($numero!=""){
			// traemos la cot_póliza si la hay
			if( $idcot_poliza_empresa ){
				$poliza=$this->ci->model_cotizacion_empresa->traer_cot_polizas(array('idcot_poliza_empresa'=>$idcot_poliza_empresa));
			}
			// traemos la póliza si la hay
			if( $idpoliza ){
				$poliza=$this->ci->model_polizas->get_polizas(array('idpoliza'=>$idpoliza), $tipo_poliza);
			}
			// tramos el anexo actual de la póliza
			if( $poliza ){
				$poliza        =(object)$poliza[0];
				$anexos_actual =$this->ci->model_polizas->get_anexos(array('idanexos'=>$poliza->idanexos));
			}
			// verficamos que el anexo de la póliza haga match con el anexo ingresado por el usuario
			if( $anexos_actual ){
				$match= $numero==$anexos_actual[0]->numero ? true : false;
			}
			if( $match ){
				$idanexos=$anexos_actual[0]->idanexos;
			}else{ // si no hace match es que el usuario lo ha cambiado implicitamente

				// traemos los anexos que concuerden con el numero de anexo ingresado por
				// el usuario
				$anexos=$this->ci->model_polizas->get_anexos( array('numero'=>$numero) );
				if( $anexos ){
				// de los que se encontraron buscamos uno que este vacio
					foreach ($anexos as $k=>$v) {
						$movimientos=$this->get_movimientos_de_anexo(array('idanexos'=>$v->idanexos));
						if( $movimientos ){
							$vacio=true;
							foreach ($movimientos as $k2=>$v2) {
								if( $v2 ) $vacio=false;
							}
							if( $vacio ) $idanexos_vacio=$v->idanexos;
						}
					}
				}

				if( $anexos && $idanexos_vacio ){
					$idanexos=$idanexos_vacio; // edit
				}else{
					$idanexos=$this->ci->model_polizas->save_anexos( array('numero'=>$numero) );
					$idanexos=$idanexos==FALSE ? 0 : $idanexos; // new
				}
			}
		}
		return $idanexos;
	}







	/**
     * VICTOR
     * OJO -----> NO USAR
     */
    function get_movimientos_de_anexo( $params=array() ){

    	$this->ci->load->model('model_programa');
    	$this->ci->load->model('model_cat_empresa_tdr');
    	$this->ci->load->model('model_empresa_listados');
    	$this->ci->load->model('model_polizas');

      	// params
      	$idanexos=isset($params['idanexos']) ? $params['idanexos'] : false;

		$anexo = $this->ci->model_polizas->get_anexos( array('idanexos'=>$idanexos) );

		if( $anexo ){
			$my_params=array(
				'idanexos'=>$anexo[0]->idanexos
			);
			$data['cot_poliza_empresa']    = $this->ci->model_cotizacion_empresa->traer_cot_polizas( $params );
			$data['empresa_tdr_detalle']   = $this->ci->model_cat_empresa_tdr->get_tdr_details_values( $params );
			$data['inclusiones']           = $this->ci->model_empresa_listados->traer_filas( array('idanexos_inclusion'=>$anexo[0]->idanexos) );
			$data['exclusiones']           = $this->ci->model_empresa_listados->traer_filas( array('idanexos_exclusion'=>$anexo[0]->idanexos) );
			//$data['empresa_sumas_listado'] = $this->ci->model_empresa_listados->get_sumas( $params );
			$data['poliza_empresa']        = $this->ci->model_polizas->get_polizas($params, 'e');
			$data['poliza_persona']        = $this->ci->model_polizas->get_polizas($params, 'p');
		}else{
			$data=false;
		}
		return $data;
    }



    /**
     * VICTOR
     * adjunta numero_poliza en el campo poliza_referencia
     * a un tdr
     */
    function adjuntar_poliza_a_tdr( $params=array() ){
    	$this->ci->load->model('model_polizas');
    	// params
    	$tdrs=isset($params['tdrs']) ? $params['tdrs'] : array();
    	// validate
    	if( !is_array($tdrs) || !count($tdrs) ){ return $tdrs; }
    	foreach ($tdrs as $k=>$v_) {
    		$v=(object)$v_;
    		if( $v->idpoliza ){
    			$p=$this->ci->model_polizas->get_polizas( array( 'idpoliza'=>$v->idpoliza, 'select'=>'a.numero_poliza' ), 'e' );
    			if( $p ){
    				if( is_array($v_) ){
    					$tdrs[$k]['poliza_referencia']=$p[0]->numero_poliza;
    				}else
    				if( is_object($v_) ){
    					$tdrs[$k]->poliza_referencia  =$p[0]->numero_poliza;
    				}else{ /*--*/ }
    			}
    		}
    	}
    	return $tdrs;
    }






	function attr_unico_cliente( $params=array() ){

		$this->ci->load->model('model_cat_clientes');

		$tipo_cliente=isset($params['tipo_cliente']) ? $params['tipo_cliente'] : false;
		$idcliente   =isset($params['idcliente']) ? $params['idcliente'] : 0;
		$match_val   =isset($params['match_val']) ? $params['match_val'] : false;
		$match_name  =isset($params['match_name']) ? $params['match_name'] : false;

		if( !$tipo_cliente || !$match_val || !$match_name ){return false;}

		$parameters=array(
			$match_name 		=>$match_val,
			'idcliente' 		=>$idcliente,
			'idcliente_operador'=>'!='
		);

		if( $tipo_cliente=='e' ){

			if( $this->ci->model_cat_clientes->traer_cliente_( 'e', $parameters ) ){ return false; }
			//if( $this->ci->model_cat_clientes->traer_cliente_( 'p', array($match_name=>$match_val) ) ){ return false; }

		}else if( $tipo_cliente=='p' ){

			if( $this->ci->model_cat_clientes->traer_cliente_( 'p', $parameters ) ){ return false; }
			//if( $this->ci->model_cat_clientes->traer_cliente_( 'e', array($match_name=>$match_val) ) ){ return false; }

		}else{

			return false;
		}

		return true;
	}







	function send_email( $params, $debug=false ){
		if (!is_array ($params) ) return false;


		$email_to   = isset($params['email_to']) ? $params['email_to'] : 'analista1@cyrconsultores.com.sv';
		$subject    = isset($params['subject']) ? $params['subject'] : 'CYR SUBJECT';
		$message    = isset($params['message']) ? $params['message'] : 'MESSAGE DEMO';
		$attach_path= isset($params['attach_path']) ? $params['attach_path'] : FALSE;
		$cc         = isset($params['cc']) ? $params['cc'] : FALSE;


		$config 	= Array(
		    // 'protocol' => 'smtp',
		    // 'smtp_host' => 'ssl://smtp.googlemail.com',
		    // 'smtp_port' => 465,
		    // 'smtp_user' => 'alcides.torres1@gmail.com',
		    // 'smtp_pass' => 'USA TU PASS',
		    // 'mailtype'  => 'html'
		    'protocol' => 'smtp',
		    'smtp_host' => 'mail.cyrconsultores.com.sv',
		    'smtp_port' => 25,
		    'smtp_user' => 'analista1@cyrconsultores.com.sv',
		    'smtp_pass' => '1324354657687980',
		    'mailtype'  => 'html'
		);


		$this->ci->load->library('email', $config);

		if( $attach_path ) $this->ci->email->attach(  $attach_path  );

		if ( $cc ) {
			if ( is_array( $params['cc'] ) && count($params['cc'])>0 ) {
				foreach ($params['cc'] as $k => $v) {
					$this->ci->email->cc(trim($v));
				}
			}
		}

		$this->ci->email->set_newline("\r\n");
		$this->ci->email->from($params['from'], $params['from_name']);
		$this->ci->email->to( $email_to );
		$this->ci->email->subject( $subject );
		$this->ci->email->message( $message );

		$response = $this->ci->email->send();
		$debugger = $this->ci->email->print_debugger();

		if ($debug) {var_dump($debugger);die;}
		return $response;
	}






	function clean_string($str, $replace=array('*',"'", '`',), $delimiter='_') {
		if( !empty($replace) ) $str = str_replace((array)$replace, ' ', $str);

		$clean = urlencode($str);
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		return $clean;
	}






	/**
	* Recibe PATH completo de archivo(No importa el lugar).
	* Lo coloca/copia en la temporal(Ruta previamente configurada en config.php)
	* Retorna la nueva direccion.
	**/
	function to_temporal( $complete_path_file ){
		if (!$complete_path_file) die('I Nedd a value!');

		$params = explode('/', $complete_path_file);
		$temp_folder = explode('/', $this->ci->config->item('temp_path_documents'));

		if( !file_exists( $this->ci->config->item('temp_path_documents') ) ) mkdir( $this->ci->config->item('temp_path_documents') ,0777,true);


			@ copy( $complete_path_file, $this->ci->config->item('temp_path_documents').'/'.$params[end(array_keys($params))] );


		return base_url().$temp_folder[count($temp_folder)-2].'/'.$params[end(array_keys($params))];
	}







	/*
	* Calcula tiempos entre una seccion de codigo.
	* Se llama timequery() al inicio
	* Se coloca timequery() al final, imprimero tiempo de ejecucion.
	* != Codeigniter Benchmark
	*/
	function timequery(){
		static $querytime_begin;
		list($usec, $sec) = explode(' ',microtime());

		if(!isset($querytime_begin)) {
			$querytime_begin= ((float)$usec + (float)$sec);
		} else {
			$querytime = (((float)$usec + (float)$sec)) - $querytime_begin;
			echo sprintf(' %01.5f segundos<br />', $querytime);
		}
	}






	/**
	 * Se ocupa en views/cotizacion/view_nueva_cotizacion_pdf.php
	 * En la carta de oferta de la cotización
	 */
	function poner_cuadro_de_beneficios( $coberturas, $plan, $es_opcional, $attr_table='', $header, $footer='', $idplandetallecoberturapersona=0 ){
		// Propiedades para la tabla
		$attr_table = ( $attr_table != '' ) ? $attr_table : 'style="font:12px" width="100%" border="1"';
		// Propiedades css para los títulos
		$css_title  = 'background-color:#0B2161;';
		$css_title .= 'text-align:center;';
		$css_title .= 'color:#FFFFFF;';
		// Propiedades css para los subtítulos
		$css_subtitle  = 'background-color:#DDDDDD;';
		$css_subtitle .= 'font-weight: bold;';
		// Propiedades css para las columnas de la derecha
		$css_col_right  = 'text-align:center;';
		/* -- */
		$my_cuadro  = '<table '.$attr_table.'>';
		$my_cuadro .= '<thead>';
		$my_cuadro .= '<tr style="'.$css_title.'">';
		$header_split = explode(':', $header, 2);
		if( count( $header_split ) <= 1 ){
			$my_cuadro .= '<th colspan="2">'.$header.'</th>';
		}else{
			$my_cuadro .= '<th>'.trim( $header_split[0] ).'</th>';
			$my_cuadro .= '<th>'.trim( $header_split[1] ).'</th>';
		}
		$my_cuadro .= '</tr>';
		$my_cuadro .= "<tr>";
		$my_cuadro .= "<th><b>COBERTURA</b></th>";
		$my_cuadro .= '<th style="'.$css_col_right.'"><b>'.$plan.'</b></th>';
		$my_cuadro .= "</tr>";
		$my_cuadro .= "</thead>";
		$my_cuadro .= "<tbody>";
		if( isset( $coberturas ) && $coberturas != FALSE ) {
			$my_cobertura = ''; // Servira para determinar si es la primer fila de la cobertura
			foreach ($coberturas as $fila) {
				if( $fila->es_opcional == $es_opcional[0] || $fila->es_opcional == $es_opcional[1] || $fila->es_opcional == $es_opcional[2] ){  // Filtrando tipo de opciones
					if( ($fila->es_opcional!=1&&$fila->es_opcional!=4) || ($fila->tipo_opcional==2&&$fila->es_opcional==4) || ($fila->idplandetallecoberturapersona==$idplandetallecoberturapersona&&(($fila->es_opcional==1)||($fila->tipo_opcional==1&&$fila->es_opcional==4))) ){ // Filtrando solo las que eligio el usuario en caso de selectivas
						$detalle        = $this->formatear_dato( $fila );
						$dettalle_split = explode(':', $detalle, 2);
						if( count( $dettalle_split ) <= 1 ){ // si no encuentra el caracter ':' en el detalle
							// Encabezado
							if( $fila->cobertura != $my_cobertura ){ // Y es la primer fila de la cobertura
								$my_cuadro .= '<tr style="'.$css_subtitle.'">';
								$my_cuadro .= '<td>'.$fila->cobertura.'</td>';
								$my_cobertura = $fila->cobertura;
							}else{
								$my_cuadro .= '<tr>';
								$my_cuadro .= '<td></td>';
							}
							// Detalle
							$my_cuadro .= '<td style="'.$css_col_right.'" >'.$detalle.'</td>';
							$my_cuadro .= '</tr>';
						}else{ // ------------------------ // Si encuentra el caracter ':' en el detalle
							// Encabezado
							if( $fila->cobertura != $my_cobertura ){ // Y es la primer fila de la cobertura
								$my_cuadro .= '<tr style="'.$css_subtitle.'">';
								$my_cuadro .= '<td colspan="2" >'.$fila->cobertura.'</td>';
								$my_cuadro .= '</tr>';
								$my_cobertura = $fila->cobertura;
							}
							// Detalle
							$my_cuadro .= '<tr>';
							$my_cuadro .= '<td>'.trim( $dettalle_split[0] ).'</td>';
							$my_cuadro .= '<td style="'.$css_col_right.'">'.trim( $dettalle_split[1] ).'</td>';
							$my_cuadro .= '</tr>';
						}
					}
				}
			}
		}
		if( $footer != '' ){
			$my_cuadro .= '<tr>';
			$my_cuadro .= '<td colspan="2" style="border:none">';
			$my_cuadro .= $footer;
			$my_cuadro .= '</td>';
			$my_cuadro .= '</tr>';
		}
		$my_cuadro .= "</tbody>";
		$my_cuadro .= "</table>";
		if( $es_opcional[0]=='X' && $es_opcional[1]=='X' && $es_opcional[2]=='X' ){ $my_cuadro=''; } // Si el cuadro no mostrara ningun tipo de opción mejor no lo mostramos
		return $my_cuadro;
	}






	/**
	 * Se ocupa en views/cotizacion/view_nueva_cotizacion_pdf.php
	 * En la carta de oferta de la cotización
	 */
	function poner_cuadro_de_primas( $data, $attr_table='' ){
		// Propiedades para la tabla
		$attr_table = ( $attr_table != '' ) ? $attr_table : 'style="font:12px" width="100%" border="1"';
		// Propiedades css para los títulos
		$css_title  = 'background-color:#0B2161;';
		$css_title .= 'text-align:center;';
		$css_title .= 'color:#FFFFFF;';
		// Propiedades css para los subtítulos
		$css_subtitle  = 'background-color:#DDDDDD;';
		$css_subtitle .= 'font-weight: bold;';
		// Propiedades css para el total
		$css_total  = 'background-color:#0B2161;';
		$css_total .= 'text-align:right;';
		$css_total .= 'color:#FFFFFF;';
		// Propiedades css para el subtotal
		$css_subtotal  = 'background-color:#DDDDDD;';
		$css_subtotal .= 'font-weight: bold;';
		$css_subtotal .= 'text-align:right;';
		//propiedades css para valores
		$css_val =  'text-align:right;';
		/* -- */
		$my_cuadro  = '<table '.$attr_table.'>';
		$my_cuadro .= "<thead>";
		$header_split = explode(':', $data['header'], 2);
		$header_right = ( count( $header_split ) > 1 ) ? $header_split[1] : '';
		$my_cuadro .= "<tr>";
		$my_cuadro .= '<th colspan="2" rowspan="2" style="'.$css_title.'">'. trim( $header_split[0] ) .'</th>';
		$my_cuadro .= '<th colspan="4" style="'.$css_title.'">'. trim( $header_right ) .'</th>';
		$my_cuadro .= "</tr>";
		$my_cuadro .= '<tr>';
		$my_cuadro .= '<th style="'.$css_subtitle.'" >Gastos Médicos</th>';
		$my_cuadro .= '<th style="'.$css_subtitle.'" >Cobertura Dental</th>';
		$my_cuadro .= '<th style="'.$css_subtitle.'" >Seguro de Vida</th>';
		$my_cuadro .= '<th style="'.$css_subtitle.'" >Total por Persona</th>';
		$my_cuadro .= '</tr>';
		$my_cuadro .= "</thead>";
		$my_cuadro .= "<tbody>";
		$my_cuadro .= '<tr>';
		$my_cuadro .= '<td>Asegurado Principal:</td>';
		$my_cuadro .= '<td>'.$data['asegurado'].'</td>';
		$my_cuadro .= '<td style="'.$css_val.'">'.money_format('%(#10n', $data['prima_bruta']).'</td>';
		$my_cuadro .= '<td style="'.$css_val.'">'.money_format('%(#10n', $data['prima_bruta_dental']  ).'</td>';
		$my_cuadro .= '<td style="'.$css_val.'">'.money_format('%(#10n', $data['prima_bruta_vida']  ).'</td>';
		$prima_total_tit = $data['prima_bruta'] + $data['prima_bruta_dental'] + $data['prima_bruta_vida'];
		$my_cuadro .= '<td style="'.$css_subtotal.'" >'.money_format('%(#10n', $prima_total_tit ).'</td>';
		$my_cuadro .= '</tr>';
		$prima_total_deps = 0;
		if( isset($data['dependientes']) && $data['dependientes'] != FALSE ) {
			$contador = 1;
			$cant_de_deps = count( $data['dependientes'] );
			foreach ($data['dependientes'] as $fila) {
				$my_cuadro .= '<tr>';
				$my_cuadro .= ( $contador == 1 ) ? '<td rowspan="'.$cant_de_deps.'">Dependientes:</td>' : '';
				$my_cuadro .= '<td>'.$fila->nombre.'</td>';
				$my_cuadro .= '<td style="'.$css_val.'" >'.money_format('%(#10n', $fila->prima_bruta ).'</td>';
				$my_cuadro .= '<td style="'.$css_val.'">'.money_format('%(#10n', $fila->prima_bruta_dental ).'</td>';
				$my_cuadro .= '<td style="'.$css_val.'">'.money_format('%(#10n', 0 ).'</td>';
				$prima_total_deps += $prima_total_dep = $fila->prima_bruta + $fila->prima_bruta_dental;
				$my_cuadro .= '<td style="'.$css_subtotal.'">'.money_format('%(#10n', $prima_total_dep ).'</td>';
				$my_cuadro .= '</tr>';
				$contador   = $contador + 1;
			}
		}
		$my_cuadro .= '<tr>';
		$my_cuadro .= '<td colspan="5" style="'.$css_total.'">TOTAL '.trim( $header_split[0] ).':</td>';
		$my_cuadro .= '<td style="'.$css_total.'">'.money_format('%(#10n', $prima_total_tit + $prima_total_deps ).'</td>';
		$my_cuadro .= '</tr>';
		if( isset( $data['footer'] ) && $data['footer'] != '' ){
			$my_cuadro .= '<tr>';
			$my_cuadro .= '<td colspan="6" style="border:none">';
			$my_cuadro .= $data['footer'];
			$my_cuadro .= '</td>';
			$my_cuadro .= '</tr>';
		}
		$my_cuadro .= "</tbody>";
		$my_cuadro .= "</table>";
		return $my_cuadro;
	}





	function formatear_dato( $data ){
		$data=(object)$data;
		$sign=isset($data->simbolo) ? $data->simbolo : '';
		if( $data->tipo_dato == 'v' ){
			$data->valor = $data->valor ? $data->valor : 0;
			return $this->vrbh_formato_dollar($data->valor, $sign);
		}else
		if( $data->tipo_dato == 'p' ){
			$data->porcentaje = $data->porcentaje ? $data->porcentaje : 0;
			return $data->porcentaje.' %';
		}else
		if( $data->tipo_dato=='m' ){
			$data->porcentaje_o = $data->porcentaje_o ? $data->porcentaje_o : 0;
			return $data->porcentaje_o.' %o';
		}else
		if( $data->tipo_dato=='d' ){
			$f           = explode('-', $data->fecha);
			$data->fecha = count($f)==3 ? $f[2] . '-' . $f[1] . '-' . $f[0] : '';
			return $data->fecha;
		}else{
			return $data->texto;
		}
	}



	/**
	 * Victor
	 */
	function vrbh_formato_dollar( $valor, $sign='' ){
		$this->ci->load->model('model_settings');
		// Obteniendo simbolo
		if( !$sign ){
			$moneda=$this->ci->model_settings->get_settings_( array( 'descripcion'=>'tipo_moneda' ) );
			if( $moneda ){
				$sign=$moneda[0]['simbolo'];
			}
		}
		// Validando
		if( !is_numeric($valor) || $valor==null || $valor=='' ) return $sign.' 0.00';
		// --
		$array_valor_decimales = explode('.', $valor );
		// Colocando decimales si no los hay
		if( count( $array_valor_decimales ) == 1 ){
			$valor = $valor.'.00';
		}
		// Colocando comas despues de cada millar
		$cantidad_digitos = strlen ( $array_valor_decimales[0] );
		$contador         = 0;
		$vez              = 0;
		if( $cantidad_digitos > 3 ){
			for ($i = $cantidad_digitos; $i >= 1; $i--) {
				if( ( $i % 3 ) == 0 ){
					if( $i < $cantidad_digitos ){
						$valor = substr($valor, 0, $contador + $vez) . ',' . substr($valor, $contador + $vez);
						$vez   = $vez + 1;
					}
				}
				$contador = $contador + 1;
			}
		}
		return $sign.' '.$valor;
	}




	/*
	* @xides
	* http://www.tcpdf.org/doc/code/classTCPDF.html
	*/
	function set_pdf_file( $params ){

		if ( !is_array($params) ) die('FAIL PARAMS');

		$params = array(
			'autor'      => isset($params['autor']) ? $params['autor'] : '',
			'title'      => isset($params['title']) ? $params['title'] : '',
			'output'     => isset($params['output']) ? $params['output'] : 'I',
			'subject'    => isset($params['subject']) ? $params['subject'] : 'CYR Consultores - '.$params['title'].date('HMd His'),
			'html'       => isset($params['html']) ? $params['html'] : 'ERROR',
			'footer'     => isset($params['footer']) ? $params['footer'] : 'FOOTER',
			'page_format'=> isset($params['page_format']) ? $params['page_format'] : 'A4',
			'orientation'=> isset($params['orientation']) ? $params['orientation'] : 'portrait', //landscape
			'keywords'   => isset($params['Keywords']) ? $params['Keywords'] : '',
			'setmargins'   => isset($params['setmargins']) ? $params['setmargins'] : ''
		);


		if ($params['html']=="") die('HTML requerido. util->set_pdf_file');

		$this->ci->load->library('Pdf');

		$pdf = new pdf("P", $params['orientation'], $params['page_format'], FALSE, 'UTF-8', FALSE);

		$pdf->SetCreator( PDF_CREATOR );
		$pdf->SetAuthor( $params['autor'] );
		$pdf->SetTitle( $params['title'] );
		$pdf->SetSubject( $params['subject'] );
		$pdf->SetKeywords( $params['keywords'] );

		if ( $params['setmargins'] === "" ) {
			$pdf->SetMargins( 9,37,9,10 ); // 9,37,9,10 Por Defecto según diseño
		}else{
			$pdf->SetMargins( $params['setmargins'][0], $params['setmargins'][1], $params['setmargins'][2], $params['setmargins'][3] );
		}


		$pdf->setPageOrientation( mb_strtoupper( substr($params['orientation'], 0,1) ) );

		$pdf->AddFont('DroidSans', '', 'DroidSans.ttf');
		$pdf->SetFont('DroidSans', '', 10);

		$pdf->set_leyenda_footer( $params['footer'] );
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->AddPage();

		$pdf->writeHTMLCell(0, 0, '', '', $params['html']);

		$pdf->Output( trim( $params['title'] )  .".pdf",$params['output']);

		$size = ob_get_length();
		header("Content-Length: $size");
		ob_end_flush();
		header("Connection: close");

		exit();
	}





	/*
	* @xides
	* https://htmltodocx.codeplex.com/
	*/
	function set_doc_file( $filename="DOCUMENTO", $html="" ){

		$this->ci->load->library('simplehtml');


		// New Word Document:
		$phpword_object = new PHPWord();
		$section = $phpword_object->createSection();

		// HTML Dom object:
		$html_dom = new simple_html_dom();
		$html_dom->load('<html><body>' . $html . '</body></html>');
		// Note, we needed to nest the html in a couple of dummy elements.

		// Create the dom array of elements which we are going to work on:
		$html_dom_array = $html_dom->find('html',0)->children();

		// We need this for setting base_root and base_path in the initial_state array
		// (below). We are using a function here (derived from Drupal) to create these
		// paths automatically - you may want to do something different in your
		// implementation. This function is in the included file
		// documentation/support_functions.inc.
		$paths = htmltodocx_paths();


		// Provide some initial settings:
		$initial_state = array(
		  // Required parameters:
		  'phpword_object' => &$phpword_object, // Must be passed by reference.
		  // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
		  // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
		  'base_root' => $paths['base_root'],
		  'base_path' => $paths['base_path'],
		  // Optional parameters - showing the defaults if you don't set anything:
		  'current_style' => array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
		  'parents' => array(0 => 'body'), // Our parent is body.
		  'list_depth' => 0, // This is the current depth of any current list.
		  'context' => 'section', // Possible values - section, footer or header.
		  'pseudo_list' => TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
		  'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
		  'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
		  'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
		  'table_allowed' => TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
		  'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.

		  // Optional - no default:
		  'style_sheet' => htmltodocx_styles_example(), // This is an array (the "style sheet") - returned by htmltodocx_styles_example() here (in styles.inc) - see this function for an example of how to construct this array.
		  );


		// Convert the HTML and put it into the PHPWord object
		htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

		// Clear the HTML dom object:
		$html_dom->clear();
		unset($html_dom);

		// Save File
		$h2d_file_uri = tempnam('', 'htd');
		$objWriter = PHPWord_IOFactory::createWriter($phpword_object, 'Word2007');
		$objWriter->save($h2d_file_uri);

		// Download the file:
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename.'.docx');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($h2d_file_uri));
		ob_clean();
		flush();
		$status = readfile($h2d_file_uri);
		unlink($h2d_file_uri);
		exit;
	}

	/*
	* @xides
	* 2014-03-28 14:09:07
	*/
	function set_excel_file	( $filename="REPORTE" ){
		header("Content-Type:application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
	}

	function set_simple_doc_file($data="",$name=""){
		$this->ci->output->set_content_type('application/vnd.ms-word');
        $this->ci->output->set_header("Pragma: no-cache");
        $this->ci->output->set_header("Expires: 0");
        $this->ci->output->set_header("Content-Disposition: attachment; filename=".$name.'.doc');
        $this->ci->output->set_header('charset=UTF-8');
        $html='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$data;
        $this->ci->output->set_output( $html );
	}



	function force_download($filename = '', $data = '')
	 {
	  if ($filename == '' OR $data == '')
	  {
	   return FALSE;
	  }

	  // Try to determine if the filename includes a file extension.
	  // We need it in order to set the MIME type
	  if (FALSE === strpos($filename, '.'))
	  {
	   return FALSE;
	  }

	  // Grab the file extension
	  $x = explode('.', $filename);
	  $extension = end($x);

	  // Load the mime types
	  @include(APPPATH.'config/mimes'.EXT);

	  // Set a default mime if we can't find it
	  if ( ! isset($mimes[$extension]))
	  {
	   $mime = 'application/octet-stream';
	  }
	  else
	  {
	   $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
	  }

	  // Generate the server headers
	  if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
	  {
	   header('Content-Type: "'.$mime.'"');
	   header('Content-Disposition: attachment; filename="'.$filename.'"');
	   header('Expires: 0');
	   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	   header("Content-Transfer-Encoding: binary");
	   header('Pragma: public');
	   header("Content-Length: ".strlen($data));
	  }
	  else
	  {
	   header('Content-Type: "'.$mime.'"');
	   header('Content-Disposition: attachment; filename="'.$filename.'"');
	   header("Content-Transfer-Encoding: binary");
	   header('Expires: 0');
	   header('Pragma: no-cache');
	   header("Content-Length: ".strlen($data));
	  }

	  exit($data);
	 }


	// Formato yyyy/mm/dd
	function calcular_dif_dias( $fechaInicio="", $fechaFin="" ) {

		$fechaInicio= substr ( $fechaInicio ,0 ,10 );
		$fechaFin   = substr ( $fechaFin ,0 ,10 );

		if ( empty( $fechaFin ) ) $fechaFin = date('Y-m-d') ;

		if ( $fechaFin == "0000-00-00" ) return 0;
		if ( $fechaInicio == "0000-00-00" ) return 0;
		if ( $fechaFin == "0" ) return NULL;
		if ( $fechaInicio == "0" ) return NULL;

		$f1  = explode("-", str_replace(' ', '',  $fechaInicio ));

		$ano1= $f1[0];
		$mes1= $f1[1];
		$dia1= $f1[2];

		$f2  = explode("-", str_replace(' ', '',  $fechaFin ));
		$ano2= $f2[0];
		$mes2= $f2[1];
		$dia2= $f2[2];

		$timestamp1 = mktime( 0,0,0, $mes1, $dia1, $ano1 );
		$timestamp2 = mktime( 4,12,0, $mes2, $dia2, $ano2 );

		$segundos_diferencia = $timestamp2 - $timestamp1;

		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

		$dias_diferencia = floor($dias_diferencia);

		return $dias_diferencia ;
	}
	function quitar_tildes($cadena) {
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		return str_replace($no_permitidas, $permitidas ,$cadena);
	}
	function get_last_url() { return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; }
	/*
	* Retorna, en formato where de CI, los idramo de la agrupacion enviada.
	* Ojo con $table ya que puede referenciarse, en where, hacia otro idramo de tabla enviada.
	*/
	function get_ramos_agrupacion( $idcat_agrupacion_ramo="", $table="siniestros", $return="or" ){

		$response = FALSE;

		if (!empty($idcat_agrupacion_ramo)) {

			$this->ci->db->where('idcat_agrupacion_ramo', $idcat_agrupacion_ramo);
			$this->ci->db->select('idramo');
			$query = $this->ci->db->get('cat_ramos');

			if ($return=='or') {
				$agrupaciones = $query->num_rows > 0  ?  $query->result_array() : FALSE;

		        if ( $agrupaciones ) {

					$response = "(";
		            foreach ( $agrupaciones as $key => $agrupacion ) { $response .= "$table.idramo = ".$agrupacion['idramo']." or "; }
		            $response = substr($response, 0,-3);
		            $response .= ")";
		        }
			} else if($return=='array') {
				$response = array();
				foreach ($query->result_array() as $key => $value) {
					$response[] = $value['idramo'];
				}
			}
		}
		return $response;
	}

	/*
	* Retorna la informacion de un item de listado.
	*/
	function get_info_item( $idempresa_enc_listado=0, $tipo_valor="a", $select="tipo_valor,texto" ){

		$idempresa_enc_listado = (int) $idempresa_enc_listado;

		if ($idempresa_enc_listado >0) {
			$this->ci->load->model('model_empresa_listados');
			$this->ci->load->model('model_polizas');

			$val = array(
				'idempresa_enc_listado'=> (int) $idempresa_enc_listado,
				'tipo_valor'           => $tipo_valor,
				'select'               => $select
				);

			$r = $this->ci->model_polizas->get_listado_details_values( $val );

			if ( $r ) {
				foreach ($r as $key => $item) {
					if ( $item['tipo_valor'] == $tipo_valor ) {

						if ( $tipo_valor=='a' || $tipo_valor=='nc' ) {
							return $item['texto'];
						}else if ($tipo_valor=='s') {
							return $item['valor'];
						}
					}
				}
			}
		}
		return '';
	}

	function ismodoconsulta( ){return ($_SESSION['idrol'] == '1' || $_SESSION['super_root']=='1') ? FALSE : TRUE; }

	/*
	* Formulario de creacion de clientes en caliente. Pantallas creación de Cotizacion,programa y polizas.
	*/
	function formAddCliente( ){
		$this->ci->load->model('model_mantto');
		$data['actividades'] = $this->ci->model_mantto->get_actividades();
		return $this->ci->load->view('catalogo/view_form_save_cliente', $data, TRUE);
	}

	/*
	* Ciertas pantallas exigen campos a diversos deptos/roles
	* Automaticamente le establecerá "required" a los id establecidos en database, tabla 211212_roles (roles).
	 */
	function get_id_obligatorios( $idrol="" ){
		if ($idrol) {
			$this->ci->load->model('model_rol');
			return $this->ci->model_rol->get_all_roles( $idrol, 'id_obligatorios' );
		}
	}
	/*
	* Retorna el id de una tarjeta de credito.
	 */
	function get_idtarjeta( $numero_tarjeta="" ){
		$idcat_tarjetas_credito = NULL;
		if (!empty($numero_tarjeta)) {
			$this->ci->load->model('model_catalogo');
			$p = array(
				'numero_tarjeta'=> $numero_tarjeta,
				'limit'         => 1,
				'select'        =>'t.idcat_tarjetas_credito'
				);
			$info_tarjeta = $this->ci->model_catalogo->gettarjeta($p);
			if ( $info_tarjeta ) {
				$idcat_tarjetas_credito = (int) $info_tarjeta[0]['idcat_tarjetas_credito'];
				$idcat_tarjetas_credito = $idcat_tarjetas_credito > 0 ? (int) $idcat_tarjetas_credito : NULL;
			}
		}
		return $idcat_tarjetas_credito;
	}

	/*
	* Xides
	* Tipos de tarjetas de credito mientras no hay tabla
	* Solicitado por Lorena
	*/
	function gettipostarjeta( ){
		return array(
				1 => "American Express",
				2 => "Visa",
				3 => "MasterCard",
				4 => "China UnionPay",
				5 => "Discover",
				6 => "Diner's Club",
				7 => "JCB",
				8 => "RuPay"
			);
	}

	/*
    * ALCIDES 2015-10-09
    * Saber cuantos TDR tiene una poliza
    */
   function listadosdepoliza( $idprograma, $idpoliza, $count=1 ){
		$cantidad  = 0;

		if( $idprograma!=0 && $idpoliza!=0 ){

			$this->ci->load->model('model_cat_empresa_tdr');
			$this->ci->load->model('model_empresa_listados');
			$this->ci->load->model('model_cat_empresa_tdr_listado');

			$parameters=array(
				'idprograma'     => $idprograma,
				'idfusion'       => 0,
				'tipo_listado'   => 'c'
			);

			$tdr                   = $this->ci->model_cat_empresa_tdr->traer_tdr(array('idpoliza'=>$idpoliza, 'select'=>'id_cat_empresa_tdr_listado'));
			$data['plantillas']    = ( $tdr!=false ) ? $this->get_group_templates_from_tdrs( $tdr ) : array();

			$comparative_plantilla = $this->ci->model_cat_empresa_tdr_listado->obtener_lista($parameters);
			$data['plantillas']    = ($comparative_plantilla!=false) ? array_merge($data['plantillas'], $comparative_plantilla) : $data['plantillas'];

			foreach ($data['plantillas']as$k=>$v) {

				$parameters=array(
					'idprograma'                => $idprograma,
					'idpoliza'                  => $idpoliza,
					'id_cat_empresa_tdr_listado'=> $v['id_cat_empresa_tdr_listado']
				);

				$data['plantillas'][$k]['listados'] = $this->ci->model_empresa_listados->traer_listado_enc_pol( $parameters );

				// - Adjuntamos los asegurados al listado ---------------------------------
					/*
						$campo = $idprograma!=0 ? 'idpoliza_asegurados' : 'idcot_programa_asegurados';
						$tabla = $idprograma!=0 ? 'poliza_asegurados'   : 'cot_programa_asegurados';

						$data['plantillas'][$k]['listados'] = ( $data['plantillas'][$k]['listados']!=false ) ? $this->_colocar_asegurados($data['plantillas'][$k]['listados'], $campo, $tabla, false) : $data['plantillas'][$k]['listados'];
					*/

				if ($count==1 && $data['plantillas'][$k]['listados'])  $cantidad += count($data['plantillas'][$k]['listados']);
			}
			if ($count!=1) $cantidad = $data['plantillas'];
		}

		return $cantidad;
	}
		function get_group_templates_from_tdrs( $tdrs ){
			$this->ci->load->model('model_cat_empresa_tdr_listado');
			if( !is_array($tdrs) || count($tdrs)==0 ) return array();
			$return_templates=array();
			// --
			foreach ($tdrs as $k=>$v) {
				if( $v['id_cat_empresa_tdr_listado']!=null ){
					$plantillas = $this->ci->model_cat_empresa_tdr_listado->obtener_lista(array('id_cat_empresa_tdr_listado'=>$v['id_cat_empresa_tdr_listado']));
					if ($plantillas!=false){
						foreach ($plantillas as $k2=>$v2) {
							$fusion_plantillas = $this->ci->model_cat_empresa_tdr_listado->obtener_lista(array('idfusion'=>$v2['id_cat_empresa_tdr_listado']) );
							$plantillas        = ($fusion_plantillas!=false) ? array_merge($plantillas, $fusion_plantillas) : $plantillas;
						}
						$return_templates=array_merge($return_templates, $plantillas);
					}
				}
			}
			return $return_templates;
		}

	function getpermisosespeciales( ){
		$this->ci->load->model('model_usuario');
		$data = $this->ci->model_usuario->permisosespe( $_SESSION['id_usuario'] );
		$response = array();

		foreach ($data as $key => $value) {
			$response[] = $value['llave'];
		}
		return $response;
	}

	/*
	* fe_exclusion ="2017-10-10" 
	*/
	function getdif_exclusion_corte( $fe_exclusion="", $fechas=array() ){
		
		$diasDif     = 0;
		$tope        = "";
		$indice      = "";
		if (empty($fe_exclusion)) return 0;
		$fe_exclusion= strtotime(trim($fe_exclusion));
		// $fechas      = array(
		// 	'2017-02-12',
		// 	'2017-05-12',
		// 	'2017-08-12',
		// 	'2017-11-12',
		// 	'2018-02-12'
		// 	);

		if (empty($fechas)) {
			$diasDif = 0;
		}else{
			if (count($fechas)>0) {
				foreach ($fechas as $kuno=> $fecha1) {
					$funo = strtotime( trim($fecha1) );
					foreach ($fechas as $key => $fecha2) {
						$fdos = strtotime( trim($fecha2) );
						if ($funo<=$fe_exclusion && $fdos>=$fe_exclusion) {
							$indice = $key;
							break;
						}
					}
				}
			}
			if (!empty($indice)) {
				$f = strtotime( $fechas[$indice] ) - $fe_exclusion;
				$diasDif = $f/86400;
			}
		}

		return $diasDif;
	}			

	/*! 
	  @function num2letras () 
	  @abstract Dado un n?mero lo devuelve escrito. 
	  @param $num number - N?mero a convertir. 
	  @param $fem bool - Forma femenina (true) o no (false). 
	  @param $dec bool - Con decimales (true) o no (false). 
	  @result string - Devuelve el n?mero escrito en letra. 

	*/ 
	function num2letras($num, $fem = false, $dec = true) { 
	   $matuni[2]  = "dos"; 
	   $matuni[3]  = "tres"; 
	   $matuni[4]  = "cuatro"; 
	   $matuni[5]  = "cinco"; 
	   $matuni[6]  = "seis"; 
	   $matuni[7]  = "siete"; 
	   $matuni[8]  = "ocho"; 
	   $matuni[9]  = "nueve"; 
	   $matuni[10] = "diez"; 
	   $matuni[11] = "once"; 
	   $matuni[12] = "doce"; 
	   $matuni[13] = "trece"; 
	   $matuni[14] = "catorce"; 
	   $matuni[15] = "quince"; 
	   $matuni[16] = "dieciseis"; 
	   $matuni[17] = "diecisiete"; 
	   $matuni[18] = "dieciocho"; 
	   $matuni[19] = "diecinueve"; 
	   $matuni[20] = "veinte"; 
	   $matunisub[2] = "dos"; 
	   $matunisub[3] = "tres"; 
	   $matunisub[4] = "cuatro"; 
	   $matunisub[5] = "quin"; 
	   $matunisub[6] = "seis"; 
	   $matunisub[7] = "sete"; 
	   $matunisub[8] = "ocho"; 
	   $matunisub[9] = "nove"; 

	   $matdec[2] = "veint"; 
	   $matdec[3] = "treinta"; 
	   $matdec[4] = "cuarenta"; 
	   $matdec[5] = "cincuenta"; 
	   $matdec[6] = "sesenta"; 
	   $matdec[7] = "setenta"; 
	   $matdec[8] = "ochenta"; 
	   $matdec[9] = "noventa"; 
	   $matsub[3]  = 'mill'; 
	   $matsub[5]  = 'bill'; 
	   $matsub[7]  = 'mill'; 
	   $matsub[9]  = 'trill'; 
	   $matsub[11] = 'mill'; 
	   $matsub[13] = 'bill'; 
	   $matsub[15] = 'mill'; 
	   $matmil[4]  = 'millones'; 
	   $matmil[6]  = 'billones'; 
	   $matmil[7]  = 'de billones'; 
	   $matmil[8]  = 'millones de billones'; 
	   $matmil[10] = 'trillones'; 
	   $matmil[11] = 'de trillones'; 
	   $matmil[12] = 'millones de trillones'; 
	   $matmil[13] = 'de trillones'; 
	   $matmil[14] = 'billones de trillones'; 
	   $matmil[15] = 'de billones de trillones'; 
	   $matmil[16] = 'millones de billones de trillones'; 
	   
	   //Zi hack
	   $float=explode('.',$num);
	   $num=$float[0];

	   $num = trim((string)@$num); 
	   if ($num[0] == '-') { 
	      $neg = 'menos '; 
	      $num = substr($num, 1); 
	   }else 
	      $neg = ''; 
	   while ($num[0] == '0') $num = substr($num, 1); 
	   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
	   $zeros = true; 
	   $punt = false; 
	   $ent = ''; 
	   $fra = ''; 
	   for ($c = 0; $c < strlen($num); $c++) { 
	      $n = $num[$c]; 
	      if (! (strpos(".,'''", $n) === false)) { 
	         if ($punt) break; 
	         else{ 
	            $punt = true; 
	            continue; 
	         } 

	      }elseif (! (strpos('0123456789', $n) === false)) { 
	         if ($punt) { 
	            if ($n != '0') $zeros = false; 
	            $fra .= $n; 
	         }else 

	            $ent .= $n; 
	      }else 

	         break; 

	   } 
	   $ent = '     ' . $ent; 
	   if ($dec and $fra and ! $zeros) { 
	      $fin = ' coma'; 
	      for ($n = 0; $n < strlen($fra); $n++) { 
	         if (($s = $fra[$n]) == '0') 
	            $fin .= ' cero'; 
	         elseif ($s == '1') 
	            $fin .= $fem ? ' una' : ' un'; 
	         else 
	            $fin .= ' ' . $matuni[$s]; 
	      } 
	   }else 
	      $fin = ''; 
	   if ((int)$ent === 0) return 'Cero ' . $fin; 
	   $tex = ''; 
	   $sub = 0; 
	   $mils = 0; 
	   $neutro = false; 
	   while ( ($num = substr($ent, -3)) != '   ') { 
	      $ent = substr($ent, 0, -3); 
	      if (++$sub < 3 and $fem) { 
	         $matuni[1] = 'una'; 
	         $subcent = 'as'; 
	      }else{ 
	         $matuni[1] = $neutro ? 'un' : 'uno'; 
	         $subcent = 'os'; 
	      } 
	      $t = ''; 
	      $n2 = substr($num, 1); 
	      if ($n2 == '00') { 
	      }elseif ($n2 < 21) 
	         $t = ' ' . $matuni[(int)$n2]; 
	      elseif ($n2 < 30) { 
	         $n3 = $num[2]; 
	         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
	         $n2 = $num[1]; 
	         $t = ' ' . $matdec[$n2] . $t; 
	      }else{ 
	         $n3 = $num[2]; 
	         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
	         $n2 = $num[1]; 
	         $t = ' ' . $matdec[$n2] . $t; 
	      } 
	      $n = $num[0]; 
	      if ($n == 1) { 
	         $t = ' ciento' . $t; 
	      }elseif ($n == 5){ 
	         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
	      }elseif ($n != 0){ 
	         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
	      } 
	      if ($sub == 1) { 
	      }elseif (! isset($matsub[$sub])) { 
	         if ($num == 1) { 
	            $t = ' mil'; 
	         }elseif ($num > 1){ 
	            $t .= ' mil'; 
	         } 
	      }elseif ($num == 1) { 
	         $t .= ' ' . $matsub[$sub] . '?n'; 
	      }elseif ($num > 1){ 
	         $t .= ' ' . $matsub[$sub] . 'ones'; 
	      }   
	      if ($num == '000') $mils ++; 
	      elseif ($mils != 0) { 
	         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
	         $mils = 0; 
	      } 
	      $neutro = true; 
	      $tex = $t . $tex; 
	   } 
	   $tex = $neg . substr($tex, 1) . $fin; 
	   //Zi hack --> return ucfirst($tex);
	   $end_num=ucfirst($tex).' dolares '.$float[1].'/100 M.N.';
	   return $end_num; 
	} 


	function num_to_letras($numero, $moneda = 'Dolar', $subfijo = 'U.S.D') {
	    $xarray = array(
	        0 => 'Cero'
	        , 1 => 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'
	        , 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE'
	        , 'VEINTI', 30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA'
	        , 60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA'
	        , 100 => 'CIENTO', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS', 400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS'
	        , 600 => 'SEISCIENTOS', 700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'
	    );

	    $numero = trim($numero);
	    $xpos_punto = strpos($numero, '.');
	    $xaux_int = $numero;
	    $xdecimales = '00';
	    if (!($xpos_punto === false)) {
	        if ($xpos_punto == 0) {
	            $numero = '0' . $numero;
	            $xpos_punto = strpos($numero, '.');
	        }
	        $xaux_int = substr($numero, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
	        $xdecimales = substr($numero . '00', $xpos_punto + 1, 2); // obtengo los valores decimales
	    }

	    $XAUX = str_pad($xaux_int, 18, ' ', STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
	    $xcadena = '';
	    for ($xz = 0; $xz < 3; $xz++) {
	        $xaux = substr($XAUX, $xz * 6, 6);
	        $xi = 0;
	        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
	        $xexit = true; // bandera para controlar el ciclo del While
	        while ($xexit) {
	            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
	                break; // termina el ciclo
	            }

	            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
	            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
	            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
	                switch ($xy) {
	                    case 1: // checa las centenas
	                        $key = (int) substr($xaux, 0, 3);
	                        if (100 > $key) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
	                            /* do nothing */
	                        } else {
	                            if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
	                                $xseek = $xarray[$key];
	                                $xsub = $this-> subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
	                                if (100 == $key) {
	                                    $xcadena = ' ' . $xcadena . ' CIEN ' . $xsub;
	                                } else {
	                                    $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
	                                }
	                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
	                            } else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
	                                $key = (int) substr($xaux, 0, 1) * 100;
	                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
	                                $xcadena = ' ' . $xcadena . ' ' . $xseek;
	                            } // ENDIF ($xseek)
	                        } // ENDIF (substr($xaux, 0, 3) < 100)
	                        break;
	                    case 2: // checa las decenas (con la misma lógica que las centenas)
	                        $key = (int) substr($xaux, 1, 2);
	                        if (10 > $key) {
	                            /* do nothing */
	                        } else {
	                            if (TRUE === array_key_exists($key, $xarray)) {
	                                $xseek = $xarray[$key];
	                                $xsub = $this-> subfijo($xaux);
	                                if (20 == $key) {
	                                    $xcadena = ' ' . $xcadena . ' VEINTE ' . $xsub;
	                                } else {
	                                    $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
	                                }
	                                $xy = 3;
	                            } else {
	                                $key = (int) substr($xaux, 1, 1) * 10;
	                                $xseek = $xarray[$key];
	                                if (20 == $key)
	                                    $xcadena = ' ' . $xcadena . ' ' . $xseek;
	                                else
	                                    $xcadena = ' ' . $xcadena . ' ' . $xseek . ' Y ';
	                            } // ENDIF ($xseek)
	                        } // ENDIF (substr($xaux, 1, 2) < 10)
	                        break;
	                    case 3: // checa las unidades
	                        $key = (int) substr($xaux, 2, 1);
	                        if (1 > $key) { // si la unidad es cero, ya no hace nada
	                            /* do nothing */
	                        } else {
	                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
	                            $xsub = $this-> subfijo($xaux);
	                            $xcadena = ' ' . $xcadena . ' ' . $xseek . ' ' . $xsub;
	                        } // ENDIF (substr($xaux, 2, 1) < 1)
	                        break;
	                } // END SWITCH
	            } // END FOR
	            $xi = $xi + 3;
	        } // ENDDO
	        # si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
	        if ('ILLON' == substr(trim($xcadena), -5, 5)) {
	            $xcadena.= ' DE';
	        }

	        # si la cadena obtenida en MILLONES o BILLONES, entonces le agrega al final la conjuncion DE
	        if ('ILLONES' == substr(trim($xcadena), -7, 7)) {
	            $xcadena.= ' DE';
	        }

	        # depurar leyendas finales
	        if ('' != trim($xaux)) {
	            switch ($xz) {
	                case 0:
	                    if ('1' == trim(substr($XAUX, $xz * 6, 6))) {
	                        $xcadena.= 'UN BILLON ';
	                    } else {
	                        $xcadena.= ' BILLONES ';
	                    }
	                    break;
	                case 1:
	                    if ('1' == trim(substr($XAUX, $xz * 6, 6))) {
	                        $xcadena.= 'UN MILLON ';
	                    } else {
	                        $xcadena.= ' MILLONES ';
	                    }
	                    break;
	                case 2:
	                    if (1 > $numero) {
	                        $xcadena = "CERO {$moneda}ES {$xdecimales}/100 {$subfijo}";
	                    }
	                    if ($numero >= 1 && $numero < 2) {
	                        $xcadena = "UN {$moneda} {$xdecimales}/100 {$subfijo}";
	                    }
	                    if ($numero >= 2) {
	                        $xcadena.= " {$moneda}ES {$xdecimales}/100 {$subfijo}"; //
	                    }
	                    break;
	            } // endswitch ($xz)
	        } // ENDIF (trim($xaux) != "")

	        $xcadena = str_replace('VEINTI ', 'VEINTI', $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
	        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
	        $xcadena = str_replace('UN UN', 'UN', $xcadena); // quito la duplicidad
	        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
	        $xcadena = str_replace('BILLON DE MILLONES', 'BILLON DE', $xcadena); // corrigo la leyenda
	        $xcadena = str_replace('BILLONES DE MILLONES', 'BILLONES DE', $xcadena); // corrigo la leyenda
	        $xcadena = str_replace('DE UN', 'UN', $xcadena); // corrigo la leyenda
	    } // ENDFOR ($xz)
	    return trim($xcadena);
	}
	/**
	 * Esta función regresa un subfijo para la cifra
	 * 
	 * @param string $cifras La cifra a medir su longitud
	 */
	function subfijo($cifras) {
	    $cifras = trim($cifras);
	    $strlen = strlen($cifras);
	    $_sub = '';
	    if (4 <= $strlen && 6 >= $strlen) {
	        $_sub = 'MIL';
	    }

	    return $_sub;
	}
}
?>