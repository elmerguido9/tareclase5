<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coneccion
 *
 * @author CíborgA scend
 */
$dns = 'mysql:dbname=alumno;host=127.0.0.1'; 
$usuario = 'root';
$clave = '';
    try{
        $con = new PDO($dns,$usuario, $clave);
    }catch (PDOException $e){
        print $e->getTraceAsString();
    }

    function consultaA($Coneccion, $sql){
        $ejecutor = $coneccion;
        $msgok = Null;
        $msgerror = Null;

        try{

    $condicion = strstr(trim($sql)," ", TRUE);

    switch ($condicion) 
{
    case 'INSERT':
      $msgerror = "No se ha podido Insertar los Datos";
      $msgok = "Datos Insertados"

      break;

      case 'DELETE':
      $msgerror = "No se ha podido Eliminar los Datos";
      $msgok = "Datos Eliminados"

      break;

      case 'UPDATE':
      $msgerror = "No se ha podido actualizar los Datos";
      $msgok = "Datos Actualizados"

      break;
    
    default:
        $msgerror = "Es posible que no se use un estandar de consulta SQL"
        break;
}

$ejecutor->beginTransaction();
$fila = $ejecutor->exec($sql);
$ejecutor->commit();

if($fila == 0){
    $msgok = $msgerror."<br> No exixte coicidencia para la accion sobre los"
}

return $msgok. " Filas Afectadas ".$fila;
}catch(Exception $exc){

    $ejecutor->roolBack();
    return $msgerror. ":(<br>".$exc->getMessage();

}
    }


function ConsultarD($coneccion, $sql,$modo=2,$presentacion=FALCE)
{
    $ejecutor = $coneccion;
    $manejador = trim($sql);
    $devulucion = "";

    try{

        $datos = $ejecutador->query($manejador);
        $datos->setFetchMode($modo);

        if($presentacion ==TRUE){
            $devolucion .="<table border=1>";

            foreach ($datos->fetchall() as $registros) {
                $devolucion.="<tr>";
                foreach ($registros as $valor) {
                    $devolucion.="<td>".$valor."</td>";
                }
                $devolucion.="</tr>";
                $devolucion .="</table>";
            }
        }else{
           $contenedor = $datos->fetchAll();
           $devolucion=$contenedor;
        }

    }catch (Exception $exc){
        return "No se pudieron consultar los Datos<br />".$exc->getMessage();
    }
    return $devolucion;
}

