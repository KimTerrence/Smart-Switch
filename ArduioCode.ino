
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

// WiFi credentials
const char* ssid = "HUAWEI-E5330-6FF2";       // Replace with your Wi-Fi SSID
const char* password = "m7t05htj";   // Replace with your Wi-Fi password

// GPIO pin for LED and HC-SR501 sensor
const int ledPin = 5; // GPIO 5 (D1 on NodeMCU)
const int sensorPin = 4; // GPIO 4 (D2 on NodeMCU)

// Flag to enable or disable sensor reading
bool sensorEnabled = true;
unsigned long lastMotionCheck = 0;
int motionStatus = LOW; // Default to no motion

ESP8266WebServer server(80); // Web server on port 80

void setup() {
  Serial.begin(9600);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  // Set pin modes
  pinMode(ledPin, OUTPUT);
  pinMode(sensorPin, INPUT);

  // Handle requests for controlling LED
  server.on("/led/on", HTTP_GET, [](){
    digitalWrite(ledPin, HIGH); // Turn LED on
    server.send(200, "text/plain", "LED is ON");
  });

  server.on("/led/off", HTTP_GET, [](){
    digitalWrite(ledPin, LOW); // Turn LED off
    server.send(200, "text/plain", "LED is OFF");
  });

  // Handle request to enable/disable sensor
  server.on("/sensor/on", HTTP_GET, [](){
    sensorEnabled = true; // Enable sensor
    server.send(200, "text/plain", "Sensor is enabled");
  });

  server.on("/sensor/off", HTTP_GET, [](){
    sensorEnabled = false; // Disable sensor
    server.send(200, "text/plain", "Sensor is disabled");
  });

  // Handle request for reading the sensor
  server.on("/sensor", HTTP_GET, [](){
    if (sensorEnabled) {
      server.send(200, "text/plain", motionStatus == HIGH ? "Motion detected" : "No motion");
      if(motionStatus == HIGH){
        digitalWrite(ledPin, HIGH); 
      }else{
        digitalWrite(ledPin, LOW); 
      }
    } else {
      server.send(200, "text/plain", "Sensor is disabled");
    }
  });

  // Start the server
  server.begin();
}

void loop() {
  server.handleClient(); // Handle client requests

  // Check motion every 5 seconds
  unsigned long currentMillis = millis();
  if (sensorEnabled && (currentMillis - lastMotionCheck >= 1000)) {
    lastMotionCheck = currentMillis;
    motionStatus = digitalRead(sensorPin); // Read HC-SR501 sensor
    Serial.println(motionStatus == HIGH ? "Motion detected" : "No motion");
  }
}