#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

// WiFi credentials
const char* ssid = "HUAWEI-E5330-6FF2";       // Replace with your Wi-Fi SSID
const char* password = "m7t05htj";   // Replace with your Wi-Fi password

// Pin definitions
const int ledPin = D1;
const int sensorPin = D2;

// Flags to enable or disable functionality
bool sensorEnabled = false;
bool lightEnabled = false; // Added lightEnabled variable

// Variables for motion detection
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
  server.on("/led/on", HTTP_GET, []() {
    digitalWrite(ledPin, HIGH); // Turn LED on
    server.send(200, "text/plain", "LED is ON");
  });

  server.on("/led/off", HTTP_GET, []() {
    digitalWrite(ledPin, LOW); // Turn LED off
    server.send(200, "text/plain", "LED is OFF");
  });

  // Handle requests to enable/disable motion sensor
  server.on("/motion/on", HTTP_GET, []() {
    sensorEnabled = true;
    server.send(200, "text/plain", "Motion sensor is enabled");
  });

  server.on("/motion/off", HTTP_GET, []() {
    sensorEnabled = false;
    digitalWrite(ledPin, LOW); // Turn LED off
    server.send(200, "text/plain", "Motion sensor is disabled");
  });

  // Handle requests to enable/disable light sensor
  server.on("/light/on", HTTP_GET, []() {
    lightEnabled = true; // Enable light sensor
    server.send(200, "text/plain", "Light sensor is enabled");
  });

  server.on("/light/off", HTTP_GET, []() {
    lightEnabled = false; // Disable light sensor
    digitalWrite(ledPin, LOW); // Turn LED off
    server.send(200, "text/plain", "Light sensor is disabled");
  });

  // Start the server
  server.begin();
}

void loop() {
  server.handleClient(); // Handle client requests

  //-------------------------------------- Motion Sensor --------------------------------
  // Check motion every second
  unsigned long currentMillis = millis();
  if (sensorEnabled && (currentMillis - lastMotionCheck >= 1000)) {
    lastMotionCheck = currentMillis;
    motionStatus = digitalRead(sensorPin); // Read HC-SR501 sensor
    Serial.println(motionStatus == HIGH ? "Motion detected" : "No motion");
    digitalWrite(ledPin, motionStatus == HIGH ? HIGH : LOW);
  }

  //--------------------------------------- Light Sensor ---------------------------------
  if (lightEnabled) {
    // Read the input on analog pin A0
    int sensorValue = analogRead(A0);
    // Convert the reading to a voltage (assuming 0 - 1023 maps to 0 - 5V)
    float voltage = sensorValue * (5.0 / 1023.0);
    Serial.print("Light sensor voltage: ");
    Serial.println(voltage);

    // Control LED based on voltage threshold
    if (voltage >= 3.0) {
      digitalWrite(ledPin, LOW);  
    } else {
      digitalWrite(ledPin, HIGH);
    }
  }
}
