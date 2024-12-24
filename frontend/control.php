<?php
// URL of your ESP8266
$esp_url = "http://192.168.8.102"; // Replace with the IP address of your ESP8266

// Function to turn the LED on
function turnLEDOn() {
    global $esp_url;
    file_get_contents($esp_url . "/led/on");
    echo '<script>window.location = "index.html" </script>';
}

// Function to turn the LED off
function turnLEDOff() {
    global $esp_url;
    file_get_contents($esp_url . "/led/off");
    echo '<script>window.location = "index.html" </script>';
}

// Function to enable the sensor
function enableSensor() {
    global $esp_url;
    file_get_contents($esp_url . "/sensor/on");
    echo '<script>window.location = "index.html" </script>';
}

// Function to disable the sensor
function disableSensor() {
    global $esp_url;
    file_get_contents($esp_url . "/sensor/off");
    echo '<script>window.location = "index.html" </script>';
}

// Function to check sensor status
function checkSensor() {
    global $esp_url;
    return file_get_contents($esp_url . "/sensor");
    echo '<script>window.location = "index.html" </script>';
}

// Handle user action
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'led_on':
            turnLEDOn();
            break;
        case 'led_off':
            turnLEDOff();
            break;
        case 'enable_sensor':
            enableSensor();
            break;
        case 'disable_sensor':
            disableSensor();
            break;
        case 'check_sensor':
            $sensorStatus = checkSensor();
            echo $sensorStatus;
            break;
    }
}

?>
