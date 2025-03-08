<?php
session_start();
$costos_base = [
    "Perro" => 40000,
    "Gato" => 35000,
    "Ave" => 30000,
    "Roedor" => 25000,
    "Reptil" => 50000
];
$base = $costos_base[$_SESSION['pet_type']];
$servicios_total = array_sum($_POST['service_cost']);
$descuento = 0;
if ($_SESSION['services_count'] >= 3 && $_SESSION['services_count'] <= 5) {
    $descuento = 0.05;
} elseif ($_SESSION['services_count'] >= 6 && $_SESSION['services_count'] <= 8) {
    $descuento = 0.10;
} elseif ($_SESSION['services_count'] > 8) {
    $descuento = 0.15;
}
$descuento = $servicios_total * $descuento;
$subtotal = $base + $servicios_total - $descuento;
$iva = $subtotal * 0.19;
$total = $subtotal + $iva;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Factura</h2>
    <p>Cliente: <?php echo $_SESSION['owner']; ?></p>
    <p>Mascota: <?php echo $_SESSION['pet_name']; ?></p>
    <p>Tipo de mascota: <?php echo $_SESSION['pet_type']; ?></p>
    <p>Costo base: $<?php echo number_format($base, 2); ?></p>
    <p>Costo total de servicios: $<?php echo number_format($servicios_total, 2); ?></p>
    <p>Descuento: -$<?php echo number_format($descuento, 2); ?></p>
    <p>IVA (19%): $<?php echo number_format($iva, 2); ?></p>
    <h3>Total a pagar: $<?php echo number_format($total, 2); ?></h3>
</body>
</html>