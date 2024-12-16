

<!DOCTYPE html>
<html>
<head>
    <title>ESP8266 LED Control</title>
</head>
<body>
    <h1>Control LED</h1>
    <button onclick="controlLED('on')">Turn ON</button>
    <button onclick="controlLED('off')">Turn OFF</button>
    <button onclick="controlLED('low')">Turn DIMM</button>


    <script>
        function controlLED(action) {
            fetch(`test_api.php?action=${action}`)
                .then(response => response.text())
                .then(data => alert(data))
                .catch(err => console.error(err));
        }
    </script>
</body>
</html>
