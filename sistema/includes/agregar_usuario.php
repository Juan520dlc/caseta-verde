<?php 

include("../conexion.php");

if (isset($_POST['agregar_usuario'])){
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['password'];
    $tipo_usuario = $_POST['$tipo_usuario'];

    $query = "INSERT INTO usuarios(nombre, usuario, contraseña, tipo_usuario) VALUES ('$nombre','$usuario', '$contraseña', '$tipo_usuario')";
    $result = mysqli_query($mysqli, $query);
    if (!$result) {
        die("Query Failed");
    }

    $_SESSION['meesage'] = 'Usuario Registrado Exitosamente!';
    $_SESSION['message_type'] = 'success';

    header("Location: principal.php");
}

?>