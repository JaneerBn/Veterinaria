<?php
session_start();

if (!isset($_SESSION['owner']) || !isset($_SESSION['pet_name']) || !isset($_SESSION['pet_type']) || !isset($_POST['service_cost'])) {
    echo "Error: No hay datos suficientes. <a href='index.html'>Volver al inicio</a>";
    exit();
}

// Definir costos base según el tipo de mascota
$costos_base = [
    "Perro" => 40000,
    "Gato" => 35000,
    "Ave" => 30000,
    "Roedor" => 25000,
    "Reptil" => 50000
];

$base = $costos_base[$_SESSION['pet_type']];
$servicios_total = array_sum($_POST['service_cost']); // Sumar los costos de los servicios

// Calcular descuento según cantidad de servicios
$descuento = 0;
$cantidad_servicios = count($_POST['service_cost']);

if ($cantidad_servicios >= 3 && $cantidad_servicios <= 5) {
    $descuento = 0.05;
} elseif ($cantidad_servicios >= 6 && $cantidad_servicios <= 8) {
    $descuento = 0.10;
} elseif ($cantidad_servicios > 8) {
    $descuento = 0.15;
}

$descuento_total = $servicios_total * $descuento;
$subtotal = $base + $servicios_total - $descuento_total;
$iva = $subtotal * 0.19;
$total = $subtotal + $iva;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="factura-container">
    <img src="../img/Logo_Sniffing Love.png" alt="Logo de Sniffing Love" class="logo">

        <h1>Sniffing Love</h1>
        <h2>Factura de Servicios</h2>

        <div class="factura-datos">
            <p><strong>Cliente:</strong> <?php echo $_SESSION['owner']; ?></p>
            <p><strong>Mascota:</strong> <?php echo $_SESSION['pet_name']; ?></p>
            <p><strong>Tipo de mascota:</strong> <?php echo $_SESSION['pet_type']; ?></p>
        </div>

        <div class="factura-detalles">
            <table>
                <tr>
                    <th>Concepto</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>Costo base</td>
                    <td>$<?php echo number_format($base, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Costo total de servicios</td>
                    <td>$<?php echo number_format($servicios_total, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Descuento</td>
                    <td>-$<?php echo number_format($descuento_total, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>IVA (19%)</td>
                    <td>$<?php echo number_format($iva, 0, ',', '.'); ?></td>
                </tr>
                <tr class="total">
                    <td><strong>Total a pagar</strong></td>
                    <td><strong>$<?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                </tr>
            </table>
        </div>

        <button onclick="window.print()">Imprimir Factura</button>
    </div>
</body>
</html>
