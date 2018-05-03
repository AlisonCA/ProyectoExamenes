<?php
  //vistonJson.php
  require_once "vistaApi.php";

  /**
   * Clase para mostrar respuestas con formato JSON
   */
  class VistaJson extends VistaApi
  {
    public function imprimir($contenido)
    {
      if ($this->estado) {
        //echo "<br>Estado-imprimir: " .$this->estado;
        http_response_code($this->estado);
      }
      header('Content-Type: application/json; charset=utf8');
      echo json_encode($contenido, JSON_PRETTY_PRINT);
      exit;
    }
  }

?>
