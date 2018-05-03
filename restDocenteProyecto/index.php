<?php
  require 'datos/ConexionBD.php';
  require 'controladores/docentes.php';
  require 'vistas/vistaJson.php';
  require 'utils/exceptionApi.php';

$vista = new VistaJson();

set_exception_handler(
  function ($excepcion) use ($vista) {
    $body = array(
      "estado"=> $excepcion->estado,
      "mensaje"=>$excepcion->getMessage()
    );
    if ($excepcion->getCode()) {
      $vista->estado = $excepcion->getCode();
    } else {
      $vista->estado = 500;
    }
    $vista->imprimir($body);
  }
);
if (isset($_GET['PATH_INFO'])) {
  $peticion = explode('/', $_GET['PATH_INFO']);
} else {
  throw new ExceptionApi(ESTADO_URL_INCORRECTA,
      "Solicitud incorrecta");
}
//print_r($peticion);

//Obtener el recurso del WS
$recurso = array_shift($peticion);
$recursos_disponibles = array('docentes','alumnos','materias','examenes');

//echo $recurso;

//Validamos si el recurso existe
if (!in_array($recurso,$recursos_disponibles)) {
  //echo "Error";
  throw new ExceptionApi(
    "ESTADO_RECURSO_INEXISTENTE",
    "No se encuentra el recurso solicitado");
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);
//GET, POST, PUT, DELETE
switch ($metodo) {
  case 'get':
    # code...
    break;
  case 'post':
    $vista->imprimir(docentes::post($peticion));
    break;
  case 'put':
    # code...s
    break;
  case 'delete':
    # code...
    break;
  default:
    # code...
}
//print $_GET['PATH_INFO'];
?>
