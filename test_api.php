<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $esp_ip = "192.168.8.102"; // Replace with the IP address of your ESP8266

    if ($action == "on") {
        file_get_contents("http://$esp_ip/LED=ON");
        echo "LED turned ON.";
    } elseif ($action == "off") {
        file_get_contents("http://$esp_ip/LED=OFF");
        echo "LED turned OFF.";
    } elseif ($action == "low") {
        file_get_contents("http://$esp_ip/LED=MID");
        echo "LED turned OFF.";
    } else {
        echo "Invalid action.";
    }
} else {
    echo "No action specified.";
}
?>