<?php
if (isset($_GET['pir'])) {
    $pirStatus = $_GET['pir'];
    file_put_contents('pir_status.txt', $pirStatus);
}
?>
