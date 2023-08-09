<?php
include "conexion.php"; // Incluir archivo de conexión

$region = $_POST['region'];

$queryProvincias = "SELECT provincia_id FROM provincias WHERE region_id = $region";
$resultProvincias = $conn->query($queryProvincias);

$provincias = array();
while ($rowProvincia = $resultProvincias->fetch_assoc()) {
    $provincias[] = $rowProvincia['provincia_id'];
}

$provinciasInClause = implode(",", $provincias);

$queryComunas = "SELECT * FROM comunas WHERE provincia_id IN ($provinciasInClause)";
$resultComunas = $conn->query($queryComunas);

$comunas = array();
while ($rowComuna = $resultComunas->fetch_assoc()) {
    $comunas[] = $rowComuna;
}
echo json_encode($comunas);