<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "conexion.php"; // Incluir archivo de conexión   

    $nombreApellido = $_POST["nombre_apellido"];
    $alias = $_POST["alias"];
    $rut = $_POST["rut"];
    $email = $_POST["email"];
    $region = $_POST["region"];
    $comuna = $_POST["comuna"];
    $candidato = $_POST["candidato"];
    $comoSeEntero = implode(", ", $_POST["como_se_entero"]);

    // Verificar si el RUT ya existe en la base de datos
    $queryCheckRut = "SELECT * FROM votacion WHERE rut = '$rut'";
    $resultCheckRut = $conn->query($queryCheckRut);

    if ($resultCheckRut->num_rows > 0) {
        echo json_encode(array("status" => "error", "message" => "El RUT existe registrado"));
        exit(); // Detener la ejecución si el RUT ya existe
    }
        
    // Aquí puedes realizar la inserción en la base de datos
    $queryInsert = "INSERT INTO votacion (nombre, alias, rut, email, region_id, comuna_id, candidato_id, como_entero) 
                    VALUES ('$nombreApellido', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$comoSeEntero')";

    if ($conn->query($queryInsert) === TRUE) {
        echo json_encode(array("status" => "success" ,"message" => "¡Votación exitosa!"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error en la votación"));
    }
} else {
    echo json_encode(array("status" => "error"));
}
?>