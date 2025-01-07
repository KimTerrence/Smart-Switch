
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

// WiFi credentials
const char* ssid = "HUAWEI-E5330-6FF2";       // Replace with your Wi-Fi SSID
const char* password = "m7t05htj";   // Replace with your Wi-Fi password

//pin for LED and HC-SR501 sensor 
const int ledPin = D1;
const int sensorPin = D2; 

// Flag to enable or disable sensor reading
bool sensorEnabled = false;
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
  server.on("/motion/on", HTTP_GET, [](){
    sensorEnabled = true; // Enable sensor
    server.send(200, "text/plain", "Sensor is enabled");
  });

  server.on("/motion/off", HTTP_GET, [](){
    sensorEnabled = false; // Disable sensor
    digitalWrite(ledPin, LOW); // Turn LED off
    server.send(200, "text/plain", "Sensor is disabled");
  });

  // Handle request for reading the sensor
  server.on("/motion", HTTP_GET, [](){
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

//--------------------------------------motion sensor--------------------------------
  // Check motion every 5 seconds
  unsigned long currentMillis = millis();
  if (sensorEnabled && (currentMillis - lastMotionCheck >= 1000)) {
    lastMotionCheck = currentMillis;
    motionStatus = digitalRead(sensorPin); // Read HC-SR501 sensor
    Serial.println(motionStatus == HIGH ? "Motion detected" : "No motion");
  }
/*
//---------------------------------------light sensor---------------------------------
 // read the input on analog pin 0:
  int sensorValue = analogRead(A0);
  
  // Convert the analog reading (which goes from 0 - 1023) to a voltage (0 - 5V):
  float voltage = sensorValue * (5.0 / 1023.0);
  
  if(voltage >= 3){
    digitalWrite(ledPin, LOW);  
  }else{
    digitalWrite(ledPin, HIGH);
  }
*/
}