<?php
session_start(); // Iniciar sesión para acceder a los datos

// Verificar si existen los datos de la sesión
if (!isset($_SESSION['owner']) || !isset($_SESSION['pet_name']) || !isset($_SESSION['services_count'])) {
    echo "Error: No hay datos disponibles. <a href='index.html'>Volver al inicio</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Servicios Adicionales</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registro de Servicios Adicionales</h1>
    <p><strong>Cliente:</strong> <?php echo htmlspecialchars($_SESSION['owner']); ?></p>
    <p><strong>Mascota:</strong> <?php echo htmlspecialchars($_SESSION['pet_name']); ?></p>
    <p><strong>Tipo de Mascota:</strong> <?php echo htmlspecialchars($_SESSION['pet_type']); ?></p>

    <form action="factura.php" method="POST">
        <h2>Servicios Adicionales</h2>
        <?php
        for ($i = 1; $i <= $_SESSION['services_count']; $i++) {
            echo "<label>Servicio $i:</label> ";
            echo "<input type='text' name='service_name[]' required> ";
            echo "<label>Costo:</label> ";
            echo "<input type='number' name='service_cost[]' step='0.01' required><br><br>";
        }
        ?>
        <button type="submit">Generar Factura</button>
    </form>
</body>
</html>
