<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DE VOTACIÓN</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>FORMULARIO DE VOTACIÓN:</h1>
    <form id="formVotar" method="POST">
        <table>
            <tr>
                <td><label for="nombre_apellido">Nombre y Apellido:</label></td>
                <td><input type="text" id="nombre_apellido" name="nombre_apellido" required></td>
            </tr>
            <tr>
                <td><label for="alias">Alias:</label></td>
                <td><input type="text" id="alias" name="alias" required></td>
            </tr>
            <tr>
                <td><label for="rut">RUT:</label></td>
                <td><input type="text" id="rut" name="rut" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label>Región:</label></td>
                <td>
                    <select id="region" name="region">
                    <option value="">Seleccione Región</option>
                    <?php
                        include "conexion.php"; // Incluir archivo de conexión                    
                        $queryRegiones = "SELECT * FROM regiones";
                        $resultRegiones = $conn->query($queryRegiones);
                        $regiones = array();
                        while ($rowRegion = $resultRegiones->fetch_assoc()) {
                            $regiones[] = $rowRegion;
                        }

                        $queryCandidatos = "SELECT * FROM candidato";
                        $resultCandidatos = $conn->query($queryCandidatos);
                        $candidatos = array();
                        while ($rowCandidatos = $resultCandidatos->fetch_assoc()) {
                            $candidatos[] = $rowCandidatos;
                        }
                    ?>
                        //Utilizar los datos obtenidos
                        <?php foreach ($regiones as $region): ?>
                            <option value="<?php echo $region['region_id']?>"><?php echo $region['region_nombre']?></option>
                        <?php endforeach ?>  
                            
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label >Comuna:</label></td>
                <td>
                    <select id="comuna" name="comuna"></select>                    
                </td>
            </tr>
            <tr>
                <td><label>Candidato:</label></td>
                <td>
                    
                    <select id="candidato" name="candidato">
                    <option value="">Seleccione Candidato</option>
                        <?php foreach ($candidatos as $candidato): ?>
                            <option value="<?php echo $candidato['candidato_id']?>"><?php echo $candidato['nombre']." ".$candidato['apellido']?></option>
                        <?php endforeach ?>  
                        <!-- Agregar más opciones aquí -->
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>¿Cómo se enteró de nosotros?</label></td>
                <td>
                    <input type="checkbox" id="chkWeb" value="Web" name="como_se_entero[]">
                    <label for="chkWeb">Web</label>
            
                    <input type="checkbox" id="chkTv" value="TV" name="como_se_entero[]">
                    <label for="chkTv">TV</label>
            
                    <input type="checkbox" id="chkRedes" value="RedesSociales" name="como_se_entero[]">
                    <label for="chkRedes">Redes Sociales</label>
            
                    <input type="checkbox" id="chkAmigo"  value="Amigo" name="como_se_entero[]">
                    <label for="chkAmigo">Amigo</label>
                </td>
            </tr>
        </table>
        <button type="submit" id="btnVotar">Votar</button>
    </form>
    <script src="js/scripts.js"></script>
</body>
</html>
