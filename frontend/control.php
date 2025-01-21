<?php

session_start();

include '../backend/database_config.php';


// URL of your ESP8266
$ip = $_GET['ip'];
$user = $_GET['currentUsr'];
$name = $_GET['name'];
$desc = $_GET['action'];


$conn-> query("INSERT INTO switch_logs(switch_name, fullname ,description) VALUES ('$name', '$user', '$desc');");

$esp_url = "http://" . $ip; // Replace with the IP address of your ESP8266
    
//$esp_url = "http://192.168.8.104";

// Function to turn the LED on
function turnLEDOn() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set switch = 'on' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/led/on");
    echo '<script>window.location = "home.php" </script>';
}

// Function to turn the LED off
function turnLEDOff() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set switch = 'off' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/led/off");
    echo '<script>window.location = "home.php" </script>';
}

// Function to enable the ligt
function enableLight() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set light = 'on' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/light/on");
    echo '<script>window.location = "home.php" </script>';
}

// Function to disable the sensor
function disableLight() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set light = 'off' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/light/off");
    echo '<script>window.location = "home.php" </script>';
}

// Function to enable the sensor
function enableSensor() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set motion = 'on' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/motion/on");
    echo '<script>window.location = "home.php" </script>';
}

// Function to disable the sensor
function disableSensor() {
    global $conn;
    global $ip;
    $conn-> query("UPDATE switch set motion = 'off' WHERE ip_address =  '$ip' ");
    global $esp_url;
    file_get_contents($esp_url . "/motion/off");
    echo '<script>window.location = "home.php" </script>';
}

// Function to check sensor status
function checkSensor() {
    global $esp_url;
    return file_get_contents($esp_url . "/motion");
    echo '<script>window.location = "home.php" </script>';
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
        case 'enable_light':
            enableLight();
            break;
        case 'disable_light':
            disableLight();
            break;
        case 'check_sensor':
            $sensorStatus = checkSensor();
            echo $sensorStatus;
            break;
    }
}

?>
