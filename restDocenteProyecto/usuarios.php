<?php
  require 'ConexionBD.php';

  //print ConexionBD::obtenerInstancia()->obtenerBD()->errorCode();

  echo "</br>";
  // echo "Clave API: " . generarClaveApi();
  // echo "Password encriptado: " . encriptarConstrasena("12345678");

  //echo "Hora Actual: " . generarFecha();
  // America/Mexico_City

  $fecha = generarFecha();
  $api = generarClaveApi();
  //insertarUsuario("Jose", "jose@jose.com","87654321",2,$fecha,$api);
  selectUsuarios();
  function selectUsuarios() {
    try {
      $sql = "SELECT * FROM usuarios";
      $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
      $query = $pdo->query($sql);
      //$pdo->prepare($sql);
      //$query = $pdo->execute();
      if ($query) {
        $resultado = $query->fetch();
        echo "Nombre: " . $resultado['nombre'] . "<br>";
        print_r($resultado);
      } else {
        echo "Error al obtener usuarios.";
      }
    } catch (PDOException $e) {
      echo "Error al realizar la consulta: " . $e;
    }
  }

  function insertarUsuario($nombre, $email,
    $password, $estado, $fecha_creacion, $api_key) {
      $sql = "INSERT INTO usuarios(
              nombre, email, password, estado,
              fecha_creacion, api_key) VALUES (?, ?, ?, ?, ?, ?)";
      try {
        //Creamos la conexión con la base de datos.
        $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
        //Preparamos el insert
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $nombre);
        $query->bindParam(2, $email);
        $query->bindParam(3, encriptarConstrasena($password));
        $query->bindParam(4, $estado);
        $query->bindParam(5, $fecha_creacion);
        $query->bindParam(6, $api_key);
        $resultado = $query->execute();
        if ($resultado) { echo "<h1>Usuario creado correctamente.</h1>";
        } else { echo "<h1>Error al crear el usuario.</h1>"; }
      } catch (PDOException $e) {
        echo "Error al crear usuario: " . $e;
      }
  }

  function generarClaveApi() {
    $microt = microtime().rand();
    // echo "Microtime: " . $microt . "<br>";
    return md5($microt);
  }

  function generarFecha() {
    $timestamp = date('Y-m-d G:i:s');
    return $timestamp;
  }

  function encriptarConstrasena($password) {
    if ($password) {
      return password_hash($password, PASSWORD_DEFAULT);
    } else {
      return null;
    }
  }


/*
Base de datos: db_tareas
Usuarios
  - id                INT           PK
  - nombre            VARCHAR
  - email             VARCHAR
  - password          TEXT
  - estado            INT
  - fecha_creacion    TIMESTAMP
  - api_key           VARCHAR(32)

Tareas
  - id                INT           PK
  - tarea             TEXT
  - estado            INT
  - fecha_creacion    TIMESTAMP

Usuario_Tarea
  - id                INT           PK
  - id_usuario        INT           FK
  - id_tarea          INT           FK
*/
?>
