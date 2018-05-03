<?php
// ConexionBD.php
require_once 'datosBD.php';


class ConexionBD
{
  private static $bd = null;
  private static $pdo;

  function __construct()
  {
      try {
        self::obtenerBD();
      } catch (PDOException $e) {
        echo "<h2>Error en la conexion con la base de datos </h2>". $e;
      }
  }
  /* Regresa una instancia de la clase (ConexionBD) */
  public static function obtenerInstancia() {
    if (self::$bd == null) {
      self::$bd = new self();
    }
    return self::$bd;
  }
  /* Creamos una conexion PDO con las constantes declaradas */
  public function obtenerBD() {
    if (self::$pdo == null) {
      //creamos la conexion
      self::$pdo = new PDO(
        'mysql:dbname=' . BASE_DE_DATOS .
        ';host=' . HOST . ';',
        USUARIO,
        CONTRASENA,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
      );
      //Habilitamos las excepciones
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return self::$pdo;
  }

//Destruimos la conexión
function _destructor(){
  self::$pdo = null;
}
}


?>
