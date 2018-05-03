<?php
//exceptionApi.php
 /**
  * Heredamos la clase Exception para poder mostrar los
  * errores que se puedan generar en nuestro WS
  */
 class ExceptionApi extends Exception
 {
   public $estado;

   //throw new ExceptionApi(2, "Error con estado 2", 400);

   function __construct($estado, $mensaje, $codigo = 400)
   {
     //echo "<br> Excepcion.....................";
     $this->estado = $estado;
     //echo "<br> Estado-Excepcion=" . $this->estado;
     $this->message = $mensaje;
     //echo "<br> mensaje-Excepcion=" . $this->message;
     $this->code = $codigo;
     //echo "<br> codigo-Excepcion=" . $this->code;
   }
 }











?>
