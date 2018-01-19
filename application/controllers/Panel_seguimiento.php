<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Panel_seguimiento extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Usuarios');
		$this->load->model('SeguimientoModelo');
		$this->load->model('Materia');
		$this->load->model('Docentes');
		$this->load->model('PeriodoModelo');
		$this->load->model('Alumnos');
		$this->load->model('Departamentos');
		$this->load->model('Mesa_AyudaModel');
		$this->load->model('Grupos');
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database('default');
	}
	public function index()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$this->load->view('ssainicio');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function aplicaciones()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarAplicaciones($this->session->userdata('departamento'));
			$datos["Periodos"]=$this->PeriodoModelo->cargarPeriodos();
			if($datos["Aplicaciones"]!=false)
			{
				$valorescontados;
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$valor=$this->SeguimientoModelo->contarEncuestas($value->idaplicaciones);
					foreach ($valor as $key => $nuermos) {
						$valorescontados[]=$nuermos->numero;
					}
				}
				$datos["Cantidad_Encuestas"]=$valorescontados;
			}
			$this->load->view('aplicaciones',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function generarAplicacion()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {

			$depaTEMP=$this->Departamentos->obtenerCarrerasDepartamento($this->session->userdata('departamento'));
			$carrera="";
			$poosi=0;
			if($depaTEMP){
				foreach ($depaTEMP as $key => $value) {
					if($poosi<count($depaTEMP)-1){
						$carrera.="'".$value->carreras_id_carrera."',";
					}else {
						$carrera.="'".$value->carreras_id_carrera."'";
					}
					$poosi++;
				}
			}else {
				$carrera="'NADA'";
			}

			$datos= array(
				'plantilla_encuestas_idplantilla_encuestas' => ''.$this->input->post('plantilla'),
				'fecha_creacion' => ''.date('Y-m-d H:i:s'),
				'periodos_escolares_idperiodos'=> ''.$this->input->post('periodo'),
				'periodo_texto'=> ''.$this->input->post('periodo_texto'),
				'departamento_academico_iddepartamento_academico'=> ''.$this->session->userdata('departamento')
			);

			$this->SeguimientoModelo->crearAplicacion($datos);
			$idaplicacion=$this->SeguimientoModelo->obtenerIdAplicacion();
			//	var_dump($idaplicacion);
			//$exclusivos=$this->Departamentos->exclusivoCarrera($this->session->userdata('departamento'));
			//	if(!$exclusivos){
			/*MEDIANTE LA TABLA MATERIAS CARRERA*/
			$materias_del_periodo=$this->Materia->cargarMateriasPeriodoCarrera($carrera,$this->input->post('periodo'));
			foreach ($materias_del_periodo as $key => $value) {
				if($this->Materia->comprobarNoCarrera($this->session->userdata('departamento'),$value->materias_idmaterias)){ //materias no
					if($this->Materia->comprobar_materia_carrera($carrera,$value->materias_idmaterias)){
						$nombre_materia="";
						$nombre_docente="";
						$materias_datos=$this->Materia->cargarNombreMateria($value->materias_idmaterias);
						foreach ($materias_datos as $key => $value2) {
							$nombre_materia=$value2->nombre_materia;
						}
						$docentes_datos=$this->Docentes->obtenerDocenteRFC($value->docentes_rfc);
						foreach ($docentes_datos as $key => $value2) {
							$nombre_docente=$value2->nombre_docente;
						}
						$grupodatos= array(
							'fecha_creacion' => ''.date('Y-m-d H:i:s'),
							'grupos_idgrupos'=> ''.$value->idgrupos,
							'nombre_materia'=> ''.$nombre_materia,
							'idmateria'=> ''.$value->materias_idmaterias,
							'rfc_docente'=> ''.$value->docentes_rfc,
							'nombre_docente'=> ''.$nombre_docente,
							'aplicaciones_idaplicaciones'=> ''.$idaplicacion[0]->maximo
						);
						//	var_dump($grupodatos);
						if($this->Grupos->verificarGrupoCarrera($value->idgrupos,$this->input->post('periodo'),$value->materias_idmaterias,$carrera)){
							$this->SeguimientoModelo->crearSeguimiento($grupodatos);
							$idseguimiento_encuesta_creada= $this->SeguimientoModelo->obtenerIdSeguimiento();
							$alumnos=$this->Grupos->obtenerAlumnosGrupo_Materia($value->idgrupos,$value->materias_idmaterias,$this->input->post('periodo'),$carrera);
							//	echo "$value->idgrupos  $value->materias_idmaterias   ";
							//	var_dump($alumnos);
							if($alumnos){
								//		echo "ALUMNOS : <br>";
								foreach ($alumnos as $key => $valuealumnos) {
									$alumno_encuesta= array(
										'nombre_alumno'=>$valuealumnos->nombre,
										'no_de_control'=>$valuealumnos->numero_control,
										'encuestas_seguimiento_idencuesta_seguimiento'=>$idseguimiento_encuesta_creada[0]->maximo
									);
									$this->SeguimientoModelo->clonarAlumnoEncuesta($alumno_encuesta);
									//			var_dump($alumno_encuesta);
								}
								//				echo "-------------------------------------";
							}
						}
					}
				}
			}
			/* ------------------------------------------------------------ */
			/*METODO 2*/
			// $materias_periodo=$this->Grupos->m2CargarGrupos($this->input->post('periodo'));
			// //var_dump($materias_periodo);
			// foreach ($materias_periodo as $key => $value) {
			// 	$alumnos=$this->Grupos->m2VerificarAlumnosGrupo($value->idgrupos,$carrera,$this->input->post('periodo'),$value->materias_idmaterias);
			// 	if($alumnos){
			// 		echo "SI $value->idgrupos <BR>";
			// 		$nombre_materia="";
			// 		$nombre_docente="";
			// 		$materias_datos=$this->Materia->cargarNombreMateria($value->materias_idmaterias);
			// 		foreach ($materias_datos as $key => $value2) {
			// 			$nombre_materia=$value2->nombre_materia;
			// 		}
			// 		$docentes_datos=$this->Docentes->obtenerDocenteRFC($value->docentes_rfc);
			// 		foreach ($docentes_datos as $key => $value2) {
			// 			$nombre_docente=$value2->nombre_docente;
			// 		}
			// 		$grupodatos= array(
			// 			'fecha_creacion' => ''.date('Y-m-d H:i:s'),
			// 			'grupos_idgrupos'=> ''.$value->idgrupos,
			// 			'nombre_materia'=> ''.$nombre_materia,
			// 			'idmateria'=> ''.$value->materias_idmaterias,
			// 			'rfc_docente'=> ''.$value->docentes_rfc,
			// 			'nombre_docente'=> ''.$nombre_docente,
			// 			'aplicaciones_idaplicaciones'=> ''.$idaplicacion[0]->maximo
			// 		);
			// 		$this->SeguimientoModelo->crearSeguimiento($grupodatos);
			// 		$idseguimiento_encuesta_creada= $this->SeguimientoModelo->obtenerIdSeguimiento();
			// 		$alumnos=$this->Grupos->obtenerAlumnosGrupo_Materia($value->idgrupos,$value->materias_idmaterias,$this->input->post('periodo'),$carrera);
			// 		if($alumnos){
			// 			foreach ($alumnos as $key => $valuealumnos) {
			// 				$alumno_encuesta= array(
			// 					'nombre_alumno'=>$valuealumnos->nombre,
			// 					'no_de_control'=>$valuealumnos->numero_control,
			// 					'encuestas_seguimiento_idencuesta_seguimiento'=>$idseguimiento_encuesta_creada[0]->maximo
			// 				);
			// 				$this->SeguimientoModelo->clonarAlumnoEncuesta($alumno_encuesta);
			// 			}
			// 		}
			// 	}else {
			// 	}
			// }
			/*-------------------------------------FIN METODO 2-------------------------------------------------------*/
			//	}
			// else {
			// 	//  echo "EXCLUSIVAS";
			// 	//var_dump($exclusivos);
			// 	$materias_del_periodo=$this->Materia->cargarMateriasPeriodoCarrera($carrera,$this->input->post('periodo'));
			// 	//	var_dump($materias_del_periodo);
			// 	foreach ($exclusivos as $key => $materias_exclusivas) {
			// 		foreach ($materias_del_periodo as $key => $materias__periodo) {
			// 			if($materias_exclusivas->materias_idmaterias==$materias__periodo->materias_idmaterias){
			// 				//echo "MATERIA ".$materias__periodo->materias_idmaterias."  ".$materias__periodo->docentes_rfc."<br>";
			// 				$nombre_materia="";
			// 				$nombre_docente="";
			// 				$materias_datos=$this->Materia->cargarNombreMateria($materias__periodo->materias_idmaterias);
			// 				foreach ($materias_datos as $key => $value2) {
			// 					$nombre_materia=$value2->nombre_materia;
			// 				}
			// 				$docentes_datos=$this->Docentes->obtenerDocenteRFC($materias__periodo->docentes_rfc);
			// 				foreach ($docentes_datos as $key => $value2) {
			// 					$nombre_docente=$value2->nombre_docente;
			// 				}
			// 				$grupodatos= array(
			// 					'fecha_creacion' => ''.date('Y-m-d H:i:s'),
			// 					'grupos_idgrupos'=> ''.$materias__periodo->idgrupos,
			// 					'nombre_materia'=> ''.$nombre_materia,
			// 					'idmateria'=> ''.$materias__periodo->materias_idmaterias,
			// 					'rfc_docente'=> ''.$materias__periodo->docentes_rfc,
			// 					'nombre_docente'=> ''.$nombre_docente,
			// 					'aplicaciones_idaplicaciones'=> ''.$idaplicacion[0]->maximo
			// 				);
			// 				$this->SeguimientoModelo->crearSeguimiento($grupodatos);
			// 				$idseguimiento_encuesta_creada= $this->SeguimientoModelo->obtenerIdSeguimiento();
			// 				//var_dump($grupodatos);
			// 				$alumnos=$this->Grupos->obtenerAlumnosGrupo_Materia($materias__periodo->idgrupos,$materias__periodo->materias_idmaterias,$this->input->post('periodo'),$carrera);
			// 				//$alumnos=$this->Grupos->obtenerAlumnosGrupo_MateriaExcluvivo($materias__periodo->idgrupos,$materias__periodo->materias_idmaterias,$this->input->post('periodo'));
			// 				//echo "$materias__periodo->idgrupos  $materias__periodo->materias_idmaterias   ";
			// 				if($alumnos){
			// 					//echo "ALUMNOS : <br>";
			// 					foreach ($alumnos as $key => $valuealumnos) {
			// 						$alumno_encuesta= array(
			// 							'nombre_alumno'=>$valuealumnos->nombre,
			// 							'no_de_control'=>$valuealumnos->numero_control,
			// 							'encuestas_seguimiento_idencuesta_seguimiento'=>$idseguimiento_encuesta_creada[0]->maximo
			// 						);
			// 						$this->SeguimientoModelo->clonarAlumnoEncuesta($alumno_encuesta);
			// 					}
			// 				}
			// 			}
			// 		}
			// 	}
			// }
			redirect(base_url().'Panel_seguimiento/aplicaciones');
		}
		else {
			redirect(base_url().'index.php');
		}
	}
	public function listado($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			if($datos["AplicacionesPeriodo"][0]->departamento_academico_iddepartamento_academico == $this->session->userdata('departamento')){
				$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
				$datos["AplicacionData"]=$idAplicacion;
				$NumeroTotal;
				$ActualContestados;
				if($datos["Aplicaciones"])
				{
					foreach ($datos["Aplicaciones"] as $key => $value) {
						$tempTotal=$this->Grupos->contadorAlumnosGrupo($value->idencuesta_seguimiento);
						$NumeroTotal[]=$tempTotal[0]->total;
						$tempContestados=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
						$ActualContestados[]=$tempContestados[0]->total;
					}
					$datos["totalAlumnos"]=$NumeroTotal;
					$datos["totalContestados"]=$ActualContestados;
				}
				$datos["idaplicacion"]=$idAplicacion;
				$this->load->view('aplicaciones_lista',$datos);
			}else {
				redirect(base_url().'Panel_seguimiento/aplicaciones');
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function obtenerAlumnosSeguimiento($idseguimiento)
	{
		$grupo=$this->SeguimientoModelo->obtenerGrupoPorSeguimiento($idseguimiento);
		$alumnos=$this->SeguimientoModelo->getAlumnosEncuesta($grupo[0]->idgrupos);
		echo json_encode($alumnos);
		//var_dump($alumnos);
	}
	public function obtenerDepartamento($departamentoid)
	{
		$departamentoRetorno="";
		switch ($departamentoid) {
			case '2':
			$departamentoRetorno="DEPARTAMENTO DE CIENCIAS DE LA TIERRA";
			break;
			case '3':
			$departamentoRetorno="DEPARTAMENTO DE SISTEMAS Y COMPUTACION";
			break;
			case '4':
			$departamentoRetorno="DEPARTAMENTO DE QUIMICA Y BIOQUIMICA";
			break;
			case '5':
			$departamentoRetorno="DEPTO. DE INGENIERIA INDUSTRIAL";
			break;
			case '6':
			$departamentoRetorno="DEPARTAMENTO DE INGENIERIA ELECTRICA Y ELECTRONICA";
			break;
			case '7':
			$departamentoRetorno="DEPARTAMENTO DE INGENIERIAS";
			break;
			case '8':
			$departamentoRetorno="DEPARTAMENTO DE CIENCIAS ECONOMICO ADMINISTRATIVAS";
			break;
			default:
			$departamentoRetorno="DEPARTAMENTO DE SISTEMAS Y COMPUTACION";
			break;
		}
		return $departamentoRetorno;
	}
	public function obtenerAlumnosPorDepartamento($departamentoid)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$AlumosEnviar;
			$idenviar="";
			$carreras=$this->Departamentos->obtenerCarrerasDepartamento($departamentoid);
			$tamano=count($carreras);
			$pos=0;
			if($carreras){
				foreach ($carreras as $key => $value) {
					if($pos<$tamano-1){
						$idenviar.="'".$value->carreras_id_carrera."',";
					}else {
						$idenviar.="'".$value->carreras_id_carrera."'";
					}
					$pos++;
				}
				$AlumosEnviar=$this->Alumnos->cargarAlumnosDosCarreras($idenviar);
			}else {
				$AlumosEnviar=false;
			}
			return $AlumosEnviar;
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function gestionarGrupo($idseguimiento,$idseguimiento_encuesta)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idseguimiento_encuesta);
			$ALUMNOSCONTESTADOS;
			if($datos["ALUMNOSGRUPO"] ){
				foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
					if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->no_de_control,$idseguimiento_encuesta))
					{
						$ALUMNOSCONTESTADOS[]=true;
					}else {
						$ALUMNOSCONTESTADOS[]=false;
					}
				}
				$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			}
			$datos["idEncuesta"]=$idseguimiento;
			$datos["idseguimiento_encuesta"]=$idseguimiento_encuesta;//*/
			$datos["IDGRUPO"]=$idseguimiento_encuesta;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idseguimiento_encuesta);
			$this->load->view('aplicaciones_grupos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}

	public function retroalimentacionlista($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicacion);
			$datos["AplicacionData"]=$idAplicacion;
			$this->load->view('aplicaciones_lista_retro',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionseguimiento($idaplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateriaEncuesta($idaplicacion);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idaplicacion);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idaplicacion);
			$this->load->model('GeneradorEncuestas');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idaplicacion);
			$datos["idRetroAlimntacion"]=$idaplicacion;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			$this->load->view('aplicaciones_retro',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function guardaretroAlimentacion($idretro)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('id');
			$retro=$this->input->post('retroalimentacion');
			$fecha=date('Y-m-d H:i:s');
			$this->SeguimientoModelo->actualizarRetro($idretro,$retro,$fecha);
			redirect(base_url().'Panel_seguimiento/retroalimentacionlista/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacionseguimientocon($idaplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idaplicacion);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idaplicacion);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idaplicacion);

			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idaplicacion);
			$datos["idRetroAlimntacion"]=$idaplicacion;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$this->load->model('GeneradorEncuestas');
			$datos["EncuestaRetro"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			$this->load->view('aplicaciones_retro_m',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function guardaretroAlimentacionContinua($idretro)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('id');
			$retro=$this->input->post('retroalimentacion');
			$fecha=date('Y-m-d H:i:s');
			$this->SeguimientoModelo->actualizarRetro($idretro,$retro,$fecha);
			redirect(base_url().'Panel_seguimiento/retroalimentacioncontinua/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function retroalimentacioncontinua($idaplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idenviar=1;
			$idarreglo;
			$arreloaumnos;
			$idfinales;
			$datos=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idaplicacion);
			if($datos)
			{
				$poosi=0;
				foreach ($datos as $key => $value) {
					if($value->retroalimentacion=="")
					{
						$d=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
						foreach ($d as $key => $value2) {
							$arreloaumnos[]=$value2->total;
						}
						$idarreglo[]=$value->idencuesta_seguimiento;
					}
				}
				for($i=0;$i<count($idarreglo);$i++)
				{
					if($arreloaumnos[$i]>0){
						$idfinales[]=$idarreglo[$i];
					}
				}
				if(isset($idfinales))
				{
					$this->retroalimentacionseguimientocon($idfinales[0]);
				}else {
					redirect(base_url().'Panel_seguimiento/retroalimentacionlista/'.$idaplicacion);
				}
			}else {
				redirect(base_url().'Panel_seguimiento/retroalimentacionlista/'.$idaplicacion);
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function manual_usuario($value='')
	{
		if ($this->session->userdata('tipo')=='2') {
			$this->load->view('manual_usuariovista');
		}
		else {
			redirect(base_url().'index.php');
		}
	}
	public function docentes()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$depa=$this->obtenerDepartamento($this->session->userdata('departamento'));
			$datos["DOCENTES"]=$this->Docentes->cargarDocentesDepartamento($depa);
			$this->load->view('seg_docentes',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function alumnos()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AlumnosCargados"]=$this->obtenerAlumnosPorDepartamento($this->session->userdata('departamento'));
			$this->load->view('seg_alumnos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function materias()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$depaTEMP=$this->Departamentos->obtenerCarrerasDepartamento($this->session->userdata('departamento'));
			$carrera="";
			$poosi=0;
			foreach ($depaTEMP as $key => $value) {
				if($poosi<count($depaTEMP)-1){
					$carrera.="'".$value->carreras_id_carrera."',";
				}else {
					$carrera.="'".$value->carreras_id_carrera."'";
				}
				$poosi++;
			}
			$datos["MATERIAS"]=$this->Materia->cargarMateriasCarrera($carrera);
			//$datos["MATERIAS"]=$this->Materia->cargarMateriasExclusivaDepartamento($this->session->userdata('departamento'));
			$this->load->view('seg_materias',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function materias_elegir()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$depaTEMP=$this->Departamentos->obtenerCarrerasDepartamento($this->session->userdata('departamento'));
			$carrera="";
			$poosi=0;
			foreach ($depaTEMP as $key => $value) {
				if($poosi<count($depaTEMP)-1){
					$carrera.="'".$value->carreras_id_carrera."',";
				}else {
					$carrera.="'".$value->carreras_id_carrera."'";
				}
				$poosi++;
			}
			$datos["MATERIAS"]=$this->Materia->cargarMateriasCarrera($carrera);
			$this->load->view('seg_materias_sii',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function materias_excluidas()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["MATERIAS"]=$this->Materia->cargarMateriasCarreraeXCLUIDAS($this->session->userdata('departamento'));
			$this->load->view('seg_materias_excluida',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function asignar_materias()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$materias=$this->input->post('numero_control_alumnos');
			$materiasarreglo = explode(',', $materias);
			for ($i=0; $i < count($materiasarreglo); $i++) {
				$MateriaRelacion= array(
					'departamento_academico_iddepartamento_academico' => ''.$this->session->userdata('departamento'),
					'materias_idmaterias' => ''.$materiasarreglo[$i],
				);
				//	var_dump($MateriaRelacion);
				if(!$this->Materia->verificarExclusiva($this->session->userdata('departamento'),$materiasarreglo[$i])){
					$this->Materia->agregarMateriaDepartamento($MateriaRelacion);
				}
			}
			redirect(base_url().'Panel_seguimiento/materias');
			//	$datos["MATERIAS"]=$this->Materia->cargarMateriasSII();
			//	$this->load->view('seg_materias_sii',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function materias_remover($materias)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {

			$this->Materia->removerMateriaDepartamento($this->session->userdata('departamento'),$materias);
			redirect(base_url().'Panel_seguimiento/materias');
		}
		else {
			redirect(base_url().'index.php');
		}
	}

	/* Elimar grupo inicio*/
	public function eliminarEncuestaDatos($idEncuesta)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos=$this->SeguimientoModelo->obtenerDocenteMateria($idEncuesta);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaDatosAplicacion($idEncuesta)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idEncuesta);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaGrupo()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idVolver=$this->input->post('idAplicacionPostEliminar');
			$idEliminarEncur=$this->input->post('idEliminarEncu');
			$this->SeguimientoModelo->borrarEncuestaSeguimiento($idEliminarEncur);
			redirect(base_url().'Panel_seguimiento/listado/'.$idVolver);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function eliminarEncuestaSeguimientoCompleta()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idAplicaciones=$this->input->post('idAplicacionesBorrar');
			$this->SeguimientoModelo->borrarAplicacionSeguimiento($idAplicaciones);
			redirect(base_url().'Panel_seguimiento/aplicaciones/');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function resultados($idSeguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idSeguimiento);
			//	var_dump($datos["ALUMNOSGRUPO"]);
			$ALUMNOSCONTESTADOS;
			foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
				if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->no_de_control,$idSeguimiento))
				{
					$ALUMNOSCONTESTADOS[]=true;
				}else {
					$ALUMNOSCONTESTADOS[]=false;
				}
			}
			$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idSeguimiento);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idSeguimiento);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idSeguimiento);
			$this->load->model('GeneradorEncuestas');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idSeguimiento);
			$datos["idEncuesta"]=$datos["idSegui"][0]->aplicaciones_idaplicaciones;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuRetro("",$resultados);
			//var_dump($datos["DATOSMATERIA"]);
			$this->load->view('aplicaciones_resultados',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function resultadosGraficos($idSeguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idSeguimiento);
			//	var_dump($datos["ALUMNOSGRUPO"]);
			$ALUMNOSCONTESTADOS;
			foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
				if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->no_de_control,$idSeguimiento))
				{
					$ALUMNOSCONTESTADOS[]=true;
				}else {
					$ALUMNOSCONTESTADOS[]=false;
				}
			}
			$datos["IDCARO"]=$idSeguimiento;
			$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idSeguimiento);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idSeguimiento);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idSeguimiento);
			$this->load->model('GeneradorEncuestas2');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idSeguimiento);
			$datos["idEncuesta"]=$datos["idSegui"][0]->aplicaciones_idaplicaciones;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestasResultados"]=$this->GeneradorEncuestas2->generarEncuRetro("",$resultados);
			//var_dump($datos["DATOSMATERIA"]);
			$this->load->view('aplicaciones_resultados_graficos',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function resultadosGraficos_imprimir($idSeguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["ALUMNOSGRUPO"]=$this->SeguimientoModelo->cargarGrupoId($idSeguimiento);
			//	var_dump($datos["ALUMNOSGRUPO"]);
			$ALUMNOSCONTESTADOS;
			foreach ($datos["ALUMNOSGRUPO"] as $key => $alumnos) {
				if($this->SeguimientoModelo->verificarContestadoAlumno($alumnos->no_de_control,$idSeguimiento))
				{
					$ALUMNOSCONTESTADOS[]=true;
				}else {
					$ALUMNOSCONTESTADOS[]=false;
				}
			}
			$datos["APLICADOS"]=$ALUMNOSCONTESTADOS;
			$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idSeguimiento);
			$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idSeguimiento);
			$datos["idSegui"]=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idSeguimiento);
			$this->load->model('GeneradorEncuestas2');
			$resultados=$this->SeguimientoModelo->resultadosEncuesta($idSeguimiento);
			$datos["idEncuesta"]=$datos["idSegui"][0]->aplicaciones_idaplicaciones;
			if(!$resultados)
			{
				$datos["ExistenResultados"]=true;
			}
			$datos["EncuestasResultados"]=$this->GeneradorEncuestas2->generarEncuRetro("",$resultados);
			//var_dump($datos["DATOSMATERIA"]);
			$this->load->view('aplicaciones_resultados_graficos_imprimir',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	/* Elimar grupo fin*/
	public function reportesAplicacion($idAplicaciones)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["AplicacionesPeriodo"]=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicaciones);
			$datos["Aplicaciones"]=$this->SeguimientoModelo->cargarEncuestasSeguimiento($idAplicaciones);
			//var_dump($datos["Aplicaciones"]);
			$datos["AplicacionData"]=$idAplicaciones;
			$NumeroTotal;
			$ActualContestados;
			if($datos["Aplicaciones"])
			{
				foreach ($datos["Aplicaciones"] as $key => $value) {
					$tempTotal=$this->Grupos->contadorAlumnosGrupo($value->idencuesta_seguimiento);
					$NumeroTotal[]=$tempTotal[0]->total;
					$tempContestados=$this->SeguimientoModelo->encuestaTotalContestados($value->idencuesta_seguimiento);
					$ActualContestados[]=$tempContestados[0]->total;
				}
				$datos["totalAlumnos"]=$NumeroTotal;
				$datos["totalContestados"]=$ActualContestados;
			}else {
			}
			$datos["DOCENTES"]=$this->SeguimientoModelo->docentesReportes($idAplicaciones);
			$this->load->view('aplicaciones_reportes',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reporteGeneradorAplicacion($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$datos["APLICACIONESCONSULTADAS"]=$this->SeguimientoModelo->reportesAplicacionesGeneral($idAplicacion);
			$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacion);
			$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idAplicacion);
			if($tempperiodo){
				$peridoencuesta=$tempperiodo[0]->periodo_texto;
				$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
				$this->load->model('GeneradorEncuestas');
				$EncuestasIMPRIMIR;
				if($datos["APLICACIONESCONSULTADAS"]){
					//var_dump($datos["APLICACIONESCONSULTADAS"]);
					foreach ($datos["APLICACIONESCONSULTADAS"] as $key => $value) {
						$resultados=$this->SeguimientoModelo->resultadosEncuesta($value->idencuesta_seguimiento);
						$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
						//echo "".$value->grupos_idgrupos;
						$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($value->idencuesta_seguimiento);
						$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($value->idencuesta_seguimiento);
						$DOCENTE="";
						$MATERIA="";
						$TXTGRUPO="";
						$TXTIDMATERIA="" ;
						//	var_dump($datos["DATOSMATERIA"]);
						if($datos["DATOSMATERIA"]){
							foreach ($datos["DATOSMATERIA"] as $key => $value) {
								$DOCENTE="".mb_convert_encoding($value->nombre_docente, 'Windows-1252');
					      $MATERIA="".mb_convert_encoding($value->nombre_materia, 'Windows-1252');
								$TXTGRUPO="".$value->grupos_idgrupos ;
								$TXTIDMATERIA="".$value->idmateria ;
							}
						}else {
							$DOCENTE="ERROR";
							$MATERIA="ERROR";
							$TXTGRUPO="ERROR";
							$TXTIDMATERIA="ERROR" ;
						}
						$temphtml= "
						<table  class='' width='100%' cellspacing='0' >
						<thead>
						<tr>
						<th> NOMBRE MATERIA</th>
						<th> DOCENTE</th>
						</tr>
						</thead>
						<tr>
						<td>  $MATERIA</td>
						<td>  $DOCENTE</td>
						</tr>
						</table>
						<table  class='' width='100%' cellspacing='0' >
						<thead>
						<tr>
						<th> GRUPO</th>
						<th> MATERIA</th>
						</tr>
						</thead>
						<tr>
						<td>  $TXTGRUPO</td>
						<td>  $TXTIDMATERIA</td>
						</tr>
						</table>
						";
						$temphtml.= $datos["EncuestasResultados"];
						if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
							$temphtml.= "\n";
							$temphtml.= "<b>Retroalimentación</b>";
							$temphtml.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
						}
						$EncuestasIMPRIMIR[]=$temphtml;
					}
				}else {
					$EncuestasIMPRIMIR[0]="<p style='font-size: 250%;'>No existen materias en esta aplicacion.</p>";
				}
				/*    CARGAR DATOS      */
				$this->load->library('Pdf');
				$resolution = array(216, 279);
				$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->SetAuthor('Fernando Manuel Avila Cataño');
				$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula - Docente');
				$pdf->SetSubject('Seguimiento en el aula reporte');
				$pdf->SetKeywords('Reporte, docente, seguimiento, en, el , aula');
				$image_file = 'cabecera.png';
				$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->setFontSubsetting(true);
				$pdf->SetFont('helvetica', '', 9);
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(true);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
				$resolution = array(279, 216);
				$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
				$html = '';
				for ($i=0; $i < count($EncuestasIMPRIMIR) ; $i++) {
					$html.='
					<table style="height: 53px;" width="100%"  border="0">
					<tbody>
					<tr>
					<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
					</tr>
					<tr>
					<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
					</tr>
					<tr>
					<td style="text-align: center; border:none; width: 100%;"> </td>
					</tr>
					</tbody>
					</table>';
					$html .= "<style type=text/css>";
					$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
					$html .= "td{background-color: #FFF; color: #000; border: 1px solid black}";
					$html .= "</style>";
					$html .= "<table  class='' cellspacing='0' >";
					$html.=$EncuestasIMPRIMIR[$i];
					$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
					$html="";
					if( $i <count($EncuestasIMPRIMIR)-1){
						$pdf->AddPage();
					}
				}
				$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_general.pdf");
				$pdf->Output($nombre_archivo, 'I');
			}else {
				redirect(base_url().'index.php');
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	function reporteDocenteGenerador($rfcdoncete,$idAplicaciones) {
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			/*    CARGAR DATOS      */
			$idAplicacionesGenerar=$this->SeguimientoModelo->reporteDocentePDFMaterias($rfcdoncete,$idAplicaciones);
			if($idAplicacionesGenerar){
				//$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicacionesGenerar[0]->aplicaciones_idaplicaciones);
				$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idAplicacionesGenerar[0]->aplicaciones_idaplicaciones);

				$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idAplicaciones);
				$peridoencuesta=$tempperiodo[0]->periodo_texto;
				$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
				$this->load->model('GeneradorEncuestas');
				$EncuestasIMPRIMIR;
				if($idAplicacionesGenerar){
					foreach ($idAplicacionesGenerar as $key => $value) {
						$resultados=$this->SeguimientoModelo->resultadosEncuesta($value->idencuesta_seguimiento);
						$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
						$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($value->idencuesta_seguimiento);
						$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($value->idencuesta_seguimiento);
						$DOCENTE="";
						$MATERIA="";
						$TXTGRUPO="";
						$TXTIDMATERIA="";
						if(isset($datos["DATOSMATERIA"])){
							foreach ($datos["DATOSMATERIA"] as $key => $value) {
								$DOCENTE="".mb_convert_encoding($value->nombre_docente, 'Windows-1252');
					      $MATERIA="".mb_convert_encoding($value->nombre_materia, 'Windows-1252');
								$TXTGRUPO="".$value->grupos_idgrupos;
								$TXTIDMATERIA="".$value->idmateria;
							}
						}else {
							$DOCENTE="ERROR";
							$MATERIA="ERROR";
							$TXTGRUPO="ERROR";
							$TXTIDMATERIA="ERROR";
						}
						$temphtml= "<table  class='' cellspacing='0' >
						<thead>
						<tr>
						<th> NOMBRE MATERIA</th>
						<th> DOCENTE</th>
						</tr>
						</thead>
						<tr>
						<td>  $MATERIA</td>
						<td>  $DOCENTE</td>
						</tr>
						</table>
						<table  class='' cellspacing='0' >
						<thead>
						<tr>
						<th> GRUPO</th>
						<th> MATERIA</th>
						</tr>
						</thead>
						<tr>
						<td>  $TXTGRUPO</td>
						<td>  $TXTIDMATERIA</td>
						</tr>
						</table>
						";
						$temphtml.= $datos["EncuestasResultados"];
						if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
							$temphtml.= "<p>";
							$temphtml.= "<b>Retroalimentación</b>";
							$temphtml.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
						}
						$EncuestasIMPRIMIR[]=$temphtml;
					}
				}else {
					$EncuestasIMPRIMIR[0]="Error al generar reporte";
				}
				/*    CARGAR DATOS      */
				$this->load->library('Pdf');
				$resolution = array(216, 279);
				$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->SetAuthor('Fernando Manuel Avila Cataño');
				$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula - Docente');
				$pdf->SetSubject('Seguimiento en el aula reporte');
				$pdf->SetKeywords('Reporte, docente, seguimiento, en, el , aula');
				$image_file = 'cabecera.png';
				$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->setFontSubsetting(true);
				$pdf->SetFont('helvetica', '', 9);
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(true);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
				$resolution = array(279, 216);
				$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
				$html = '';
				for ($i=0; $i < count($EncuestasIMPRIMIR) ; $i++) {
					$html.='
					<table style="height: 53px;" width="100%"  border="0">
					<tbody>
					<tr>
					<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
					</tr>
					<tr>
					<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
					</tr>
					<tr>
					<td style="text-align: center; border:none; width: 100%;"> </td>
					</tr>
					</tbody>
					</table>';
					$html .= "<style type=text/css>";
					$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
					$html .= "td{background-color: #FFF; color: #000; border: 1px solid black}";
					$html .= "</style>";
					$html .= "<table  class='' cellspacing='0' >";
					$html.=$EncuestasIMPRIMIR[$i];
					$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
					$html="";
					if( $i <count($EncuestasIMPRIMIR)-1){
						$pdf->AddPage();
					}
				}
				$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_docente.pdf");
				$pdf->Output($nombre_archivo, 'I');
			}else {
				redirect(base_url().'index.php');
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reporteIndividual($idencuesta_seguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			/*    CARGAR DATOS      */
			$this->load->model('GeneradorEncuestas');
			$idseguimientotemp=$this->SeguimientoModelo->obtenerIdSeguimientoporGrupo($idencuesta_seguimiento);
			if($idseguimientotemp){
				$tempperiodo=$this->SeguimientoModelo->obtenerPeriodoAplicacion($idseguimientotemp[0]->aplicaciones_idaplicaciones);
				$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idseguimientotemp[0]->aplicaciones_idaplicaciones);
				$peridoencuesta=$tempperiodo[0]->periodo_texto;
				$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
				$resultados=$this->SeguimientoModelo->resultadosEncuesta($idencuesta_seguimiento);
				$datos["EncuestasResultados"]=$this->GeneradorEncuestas->generarEncuPDF("",$resultados);
				$datos["DATOSMATERIA"]=$this->SeguimientoModelo->obtenerDocenteMateria($idencuesta_seguimiento);
				$DOCENTE="";
				$MATERIA="";
				$TXTGRUPO="";
				$TXTIDMATERIA="";
				if(isset($datos["DATOSMATERIA"])){
					foreach ($datos["DATOSMATERIA"] as $key => $value) {
						$DOCENTE="".mb_convert_encoding($value->nombre_docente, 'Windows-1252');
			      $MATERIA="".mb_convert_encoding($value->nombre_materia, 'Windows-1252');
						$TXTGRUPO="".$value->grupos_idgrupos ;
						$TXTIDMATERIA="".$value->idmateria ;
					}
				}else {
					$DOCENTE="ERROR";
					$MATERIA="ERROR";
					$TXTGRUPO="ERROR";
					$TXTIDMATERIA="ERROR";
				}
				$datos["RetroAlimentacion"]=$this->SeguimientoModelo->cargarRetroAlimentacionID($idencuesta_seguimiento);
				/*    CARGAR DATOS      */
				$this->load->library('Pdf');
				$resolution = array(216, 279);
				$pdf = new Pdf('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->SetAuthor('Fernando Manuel Avila Cataño');
				$pdf->SetTitle('Instituto Tecnologico de Tepic - Seguimiento en el aula');
				$pdf->SetSubject('Seguimiento en el aula reporte');
				$pdf->SetKeywords('Reporte, individual, ');
				$image_file = 'cabecera.png';
				$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 058', PDF_HEADER_STRING, array(0,0,0), array(255,255,255));
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-15, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-10);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->setFontSubsetting(true);
				$pdf->SetFont('helvetica', '', 9);
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(true);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 0, 'blend_mode' => 'Normal'));
				$resolution = array(279, 216);
				$pdf->AddPage('P', 'mm', $resolution, true, 'UTF-8', false);
				$pdf->setTextShadow(array('disabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
				$html = '';
				$html.='
				<table style="height: 53px;" width="100%"  border="0">
				<tbody>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"><h2><strong>Departamento de '.$departamentoacademico.'</strong></h2></td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;">Periodo de '.$peridoencuesta.'</td>
				</tr>
				<tr>
				<td style="text-align: center; border:none; width: 100%;"> </td>
				</tr>
				</tbody>
				</table>';
				$html .= "<style type=text/css>";
				$html .= "th{color: #fff; font-weight: bold; background-color: #222; border: 1px solid black}";
				$html .= "td{background-color: #FFF; color: #000; border: 1px solid black} .gp{ width: 30px} ";
				$html .= "</style>";
				$html .= "
				<table  class='' cellspacing='0' >
				<thead>
				<tr>
				<th> NOMBRE MATERIA</th>
				<th> DOCENTE</th>
				</tr>
				</thead>
				<tr>
				<td>  $MATERIA</td>
				<td>  $DOCENTE</td>
				</tr>
				</table>
				<table  class='' cellspacing='0' >
				<thead>
				<tr>
				<th> GRUPO</th>
				<th> MATERIA</th>
				</tr>
				</thead>
				<tr>
				<td>  $TXTGRUPO</td>
				<td>  $TXTIDMATERIA</td>
				</tr>
				</table>
				";
				$html.= $datos["EncuestasResultados"];
				if($datos["RetroAlimentacion"][0]->retroalimentacion!=""){
					$html.= "\n";
					$html.= "<b>Retroalimentación</b>";
					$html.= "".$datos["RetroAlimentacion"][0]->retroalimentacion;
				}
				$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
				$nombre_archivo = utf8_decode("Reporte_Seguimiento_en_aula_individual.pdf");
				$pdf->Output($nombre_archivo, 'I');
			}else {
				redirect(base_url().'index.php');
			}
		}else {
			redirect(base_url().'index.php');
		}
	}
	function borrarAlumnosNumeroControl()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$numero_control=$this->input->post('numero_Control_eliminar');
			$idencuesta=$this->input->post('idGrupoEnviar');
			$idgrupo=$this->SeguimientoModelo->getGrupoPorEncuesta($idencuesta);
			$this->SeguimientoModelo->deleteEncuestaAlumno($numero_control,$idencuesta);
			$this->SeguimientoModelo->deleteAlumnoGrupo($numero_control,$idgrupo[0]->idgrupos);
			redirect(base_url().'Panel_seguimiento/gestionarGrupo/'.$idencuesta);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function reactivaralumno()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$idapp=$this->input->post('idapliacion');
			$numero_control=$this->input->post('numero_Control_reactivar');
			$idencuesta=$this->input->post('idGrupoEnviar');
			$resultados=$this->SeguimientoModelo->deleteEncuestaAlumno($numero_control,$idencuesta);
			redirect(base_url().'Panel_seguimiento/gestionarGrupo/'.$idapp."/".$idencuesta);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function datosAlumno($numero_control)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$resultados=$this->Alumnos->getAlumno($numero_control);
			echo json_encode($resultados);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function addAlumnos($idseguimiento)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			if($this->input->post('numero_control_alumnos')!=""){
				$idgrupo=$this->SeguimientoModelo->getGrupoPorEncuesta($idseguimiento);
				$NumerosDeControl = explode(',', $this->input->post('numero_control_alumnos'));
				$GrupoAlumnosNumeros =array();
				if(count($NumerosDeControl)>0){
					for ($i=0; $i < count($NumerosDeControl) ; $i++) {
						if($this->SeguimientoModelo->verificarAlumnoGrupoDB($NumerosDeControl[$i],$idgrupo[0]->idgrupos)){
							$GrupoAlumnosNumeros[]=array("alumnos_numero_control"=>$NumerosDeControl[$i],"grupos_idgrupos"=>$idgrupo[0]->idgrupos);
						}
					}
					if(count($GrupoAlumnosNumeros)>0){
						$this->SeguimientoModelo->insertarGrupos($GrupoAlumnosNumeros);
					}
				}
			}
			redirect(base_url().'Panel_seguimiento/gestionarGrupo/'.$idseguimiento);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function soporte_tecnico()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$datos["MENSAJESENVIADOS"]=$this->Mesa_AyudaModel->cargarSolicitudesDeSoporte($this->session->userdata('idusuarios'));
			$this->load->view('mesa_ayuda_usuario',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function soporte_respuesta($idsoporte)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$datos['asuntos'] = $this->Mesa_AyudaModel->mostrarAsuntosUnico($idsoporte);
			$datos['respuestas'] = $this->Mesa_AyudaModel->mostrarMensjesAunsto($idsoporte);
			$this->load->view('soporte_individual',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function borrarMensajeprincipal($mensaje)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$this->Mesa_AyudaModel->borarMensajeSoporte($mensaje);
			redirect(base_url().'Panel_seguimiento/soporte_tecnico');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function cambiarEstadoMensaje()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$idmensaje = $this->input->post('idmensaje');
			$nuevoestado = $this->input->post('estado');
			$this->Mesa_AyudaModel->cambioEstado($idmensaje,$nuevoestado);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function respuesta($idmensajeprincipal)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$respus = $this->input->post('respuestamesaje');
			$iduser=$this->session->userdata('idusuarios');
			$this->Mesa_AyudaModel->insertarRespuesta($idmensajeprincipal,$respus,$iduser);
			redirect(base_url().'Panel_seguimiento/soporte_respuesta/'.$idmensajeprincipal);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function borrarRespuesta($mensaje)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$idmensajeprincipal = $this->input->post('idmensajeprincipal_b');
			$this->Mesa_AyudaModel->borarMensajeRespuesta($mensaje);
			redirect(base_url().'Panel_seguimiento/soporte_respuesta/'.$idmensajeprincipal);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function gestion_del_curso()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$this->load->view('procedimiento_gestion_del_curso');
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function obtenerAlumnosSelecionados()
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2' || $this->session->userdata('tipo')=='3') {
			$numeros_control = $this->input->post('numeros_control');
			$datos=$this->Alumnos->cargarAlumnosNumeroeControl($numeros_control);
			echo json_encode($datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	function genePerido($periodo)
	{
		$anioac = substr($periodo, 0,strlen($periodo)-1);
		$peridotTexto="";
		if($periodo==$anioac."1")
		{
			$peridotTexto="Enero-Junio ".$anioac;
		}
		else {
			if($periodo==$anioac."2")
			{
				$peridotTexto="Verano ".$anioac;
			}
			else {
				if($periodo==$anioac."3")
				{
					$peridotTexto="Agosto-Diciembre ".$anioac;
				}
			}
		}
		return $peridotTexto;
	}
	public function generadorCatel($idAplicacion)
	{
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$tempdepartamento=$this->Departamentos->obtenerDepartamentoPorAplicacion($idAplicacion);
			$departamentoacademico=$tempdepartamento[0]->nombre_departamento;
			$iddepartamento=$tempdepartamento[0]->iddepartamento_academico;;
			$datosenviar = array(	array('name'=> ''.$departamentoacademico,'font-size'=>'58','color'=>'negro'),
			array('name'=> 'Ya se encuentra disponible la encuesta de seguimiento en el aula','font-size'=>'35','color'=>'negro'),
			array('name'=> '','font-size'=>'35','color'=>'negro'),
			array('name'=> 'Solo accede a la siguiente direccion web: ','font-size'=>'35','color'=>'negro'),
			array('name'=> base_url().'index.php/Seguimiento/ ','font-size'=>'35','color'=>'azul'));
			$filename = $this->generar_imagen($datosenviar,$iddepartamento);
			$datos["cartel"]=$filename;
			$this->load->view('generar_imagen',$datos);
		}else {
			redirect(base_url().'index.php');
		}
	}
	function generar_imagen($user,$iddepartamento){
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$fontname =  $_SERVER['DOCUMENT_ROOT'].'/fonts/SourceSansPro-Regular.ttf';
			$i=60;
			$quality = 90;
			$file = FCPATH."file/carteles/cartel_promocional_aplicacion$iddepartamento.jpg";
			$ruta="file/carteles/cartel_promocional_aplicacion$iddepartamento.jpg";
			$height=500;
			$im = imagecreatefromjpeg(base_url()."file/carteles/cartel_promocional.jpg");
			$color['grey'] = imagecolorallocate($im, 54, 56, 60);
			$color['green'] = imagecolorallocate($im, 55, 189, 102);
			$color['red'] = imagecolorallocate($im, 255, 0, 0);
			$color['negro'] = imagecolorallocate($im, 0, 0, 0);
			$color['azul'] = imagecolorallocate($im, 0, 0, 255);
			$y = imagesy($im) - $height - 500;
			foreach ($user as $value){
				if($i==60){
					$x =120+ $this->centrar_texto($value['name'], $value['font-size']);
				}else {
					$x =$this->centrar_texto($value['name'], $value['font-size']);
				}
				imagettftext($im, $value['font-size'], 0, $x, $y+$i, $color[$value['color']], $fontname,$value['name']);
				if($i==60){
					$i = $i+300;
				}else {
					if($i==555){
						$i = $i+100;
					}else {
						$i = $i+65;
					}
				}
			}
			imagejpeg($im, $file, $quality);
			return $ruta;
		}else {
			redirect(base_url().'index.php');
		}
	}
	function centrar_texto($string, $font_size){
		if ($this->session->userdata('tipo')=='1' || $this->session->userdata('tipo')=='2') {
			$fontname = $_SERVER['DOCUMENT_ROOT'] .'/fonts/SourceSansPro-Regular.ttf';
			$image_width = 1920;
			$dimensions = imagettfbbox($font_size, 0, $fontname, $string);
			return ceil(($image_width - $dimensions[4]) / 2);
		}else {
			redirect(base_url().'index.php');
		}
	}
	public function test_encuesta()
	{
		$rutajson="file/json/seguimiento1.json";
		$this->load->model('GeneradorEncuestas3');
		$datos["EncuestaRetro"]=$this->GeneradorEncuestas3->generarEncu($rutajson);
		$this->load->view('encuesta/seguimientovi_generada',$datos);
	}
}
