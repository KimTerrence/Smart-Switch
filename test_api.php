<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $esp_ip = "192.168.8.105"; // Replace with the IP address of your ESP8266

    if ($action == "on") {
        file_get_contents("http://$esp_ip/LED=ON");
        echo "LED turned ON.";
    } elseif ($action == "off") {
        file_get_contents("http://$esp_ip/LED=OFF");
        echo "LED turned OFF.";
    } elseif ($action == "low") {
        file_get_contents("http://$esp_ip/LED=MID");
        echo "LED turned OFF.";
    }

    //Sensor
    if ($action == "senOn") {
        file_get_contents("http://$esp_ip/SLED=ON");
        echo "LED turned ON.";
    } elseif ($action == "senOff") {
        file_get_contents("http://$esp_ip/SLED=OFF");
        echo "LED turned OFF.";
    }

} else {
    echo "No action specified.";
}


?>