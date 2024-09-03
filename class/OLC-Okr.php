<?php

require_once 'connect/conexion.php';
require_once 'class.inputfilter.php';

class OKR{

	private $dbh;
	private $iFilter;

	public function __construct(){
		$this->dbh     = Conexion::singleton_conexion();
		$this->iFilter = new InputFilterion();
	}

	public function get_task($condicion = ""){
		try {
			$query = $this->dbh->prepare("

				SELECT
				TASK.id AS id_tarea, TASK.estado estado_tarea, TASK.nombre nombre_tarea, TASK.descripcion descripcion_tarea,
				TASK.id_semana, SEM.ano ano_semana, SEM.mes mes_semana, SEM.semana, SEM.fecha_desde fecha_desde_semana, SEM.fecha_hasta fecha_hasta_semana,
				TASK.id_sprint, SPR.id_responsable id_responsable_sprint, SPR.nombre nombre_sprint, SPR.descripcion descripcion_sprint, SPR.ano ano_sprint, SPR.mes mes_sprint,
				TASK.id_accion, ACC.id_responsable id_responsable_accion, ACC.nombre nombre_accion, ACC.descripcion descripcion_accion,
				TASK.id_kr, KRS.id_responsable id_responsable_kr, KRS.nombre nombre_kr, KRS.descripcion descripcion_kr,
				TASK.id_objetivo, OBJ.id_responsable id_responsable_objetivo, OBJ.nombre nombre_objetivo, OBJ.descripcion descripcion_objetivo,
				TASK.id_proyecto, PROY.id_responsable id_responsable_proyecto, PROY.nombre nombre_proyecto, PROY.descripcion descripcion_proyecto,
				TASK.id_responsable, TRA.nombre nombre_responsable, TRA.identificacion identificacion_responsable, TRA.cargo cargo_responsable, TRA.inactivo inactivo_responsable, TRA.eliminado eliminado_responsable,
				TASK.id_empresa, EMP.nombre nombre_empresa, EMP.descripcion descripcion_empresa

				FROM grw_okr_tareas TASK

				INNER JOIN olc_empresas EMP ON EMP.id = TASK.id_empresa && EMP.inactivo = 0 && EMP.eliminado = 0
				LEFT JOIN zoom_users TRA ON TRA.id = TASK.id_responsable
				INNER JOIN grw_okr_proyectos PROY ON PROY.id = TASK.id_proyecto && PROY.inactivo = 0 && PROY.eliminado = 0
				INNER JOIN grw_okr_objetivos OBJ ON OBJ.id = TASK.id_objetivo && OBJ.inactivo = 0 && OBJ.eliminado = 0
				INNER JOIN grw_okr_krs KRS ON KRS.id = TASK.id_kr && KRS.inactivo = 0 && KRS.eliminado = 0
				INNER JOIN grw_okr_acciones ACC ON ACC.id = TASK.id_accion && ACC.inactivo = 0 && ACC.eliminado = 0
				INNER JOIN grw_okr_sprints SPR ON SPR.id = TASK.id_sprint && SPR.inactivo = 0 && SPR.eliminado = 0
				INNER JOIN olc_semanas SEM ON SEM.id = TASK.id_semana && SEM.inactivo = 0 && SEM.eliminado = 0

				WHERE TASK.inactivo = 0 && TASK.eliminado = 0 $condicion
			");

			$query->execute();
			if($query->rowCount() != 0)	{
				return $query->fetchAll();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

}