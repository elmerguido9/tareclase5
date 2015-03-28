<?php
include './clases/Coneccion.php';
include './clases/Seccion.php';
include './clases/SeccionControlador.php';
$seccionA = new SeccionControlador();
$accion= $_REQUEST['accion'];
switch($accion){
	case 'save':
	if(isset($_REQUEST['boot'])){
		$seccionA->setId('NULL');
		$seccionA->getNombres($_REQUEST['nombre']);
		$seccionA->getEscuela($_REQUEST['escuela']);

		$datosObj=array($seccionA->getId(),
			            $seccionA->getNombre(),
			            $seccionA->getEscuela()
			            );
		print $seccionA->guardarDatos($con,$datosObj);
		print '<a href=\'manejadorSeccion.php?accion=con\'>Ver datos</a>';
	}else{
		print 'No se ha enviado datos ';
	}
	break;
	case 'con':
	$sql = 'SELECT * FROM seccion';
	print consultaD($con, $sql, 2, TRUE);
	break;

	case 'del':
	$sql = 'DELETE from seccion where id='.$_REQUEST['id'].';';
	print consultarA($con, $sql);
	break;

	default:
	print 'No hay Accion que realizar';
	break;
}