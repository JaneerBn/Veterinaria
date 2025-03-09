
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['owner'] = $_POST['owner'];
    $_SESSION['pet_name'] = $_POST['pet_name'];
    $_SESSION['pet_type'] = $_POST['pet_type'];
    $_SESSION['services_count'] = $_POST['services_count'];
    header('Location: servicios.php'); 

    exit();
}
?>
