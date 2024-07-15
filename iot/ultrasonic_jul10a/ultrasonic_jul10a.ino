#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h> // Use this header for ESP8266

#define echoPin 16 // pin D0
#define trigPin 5  // pin D1
long duration, distance;
const char* ssid = "mrmark"; // Replace with your WiFi SSID
const char* password = "11111112"; // Replace with your WiFi password
const char* apiUrl0 = "http://192.168.43.28:8000/change_status/66"; // Replace with your API URL
const char* apiUrl1 = "http://192.168.43.28:8000/zero_status/66"; // Replace with your API URL
WiFiClient client;

void setup() {
  Serial.begin(9600);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = duration / 58.2;
  String disp = String(distance);
  Serial.print("Distance: ");
  Serial.print(disp);
  Serial.println(" cm");
  if (distance < 20) { // Check if distance is less than 20 cm
    Serial.println("Distance is less than 20 cm, hitting API 0...");
    hitApi(apiUrl0);
  } else {
    Serial.println("Distance is more than 20 cm, hitting API 1...");
    hitApi(apiUrl1);
  }
  delay(10000);
}

void hitApi(const char* apiUrl) {
  HTTPClient http;
  http.begin(client, apiUrl); // Pass the WiFiClient object here
  int httpCode = http.GET();
  if (httpCode == 200) {
    Serial.println("API hit successfully!");
    Serial.println(httpCode);
  } else {
    Serial.println("API hit failed!");
    Serial.println(httpCode);
  }
  http.end();
}
