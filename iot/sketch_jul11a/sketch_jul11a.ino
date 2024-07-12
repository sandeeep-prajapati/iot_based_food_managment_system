#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "mrmark";
const char* password = "11111112";
const char* apiUrl = "http://192.168.43.28:8000/on_led_light?latitude=27.1304175&longitude=83.5389898";
WiFiClient client;
const int ledPin = 2; 
void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  pinMode(ledPin, OUTPUT);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(client, apiUrl); // Pass the WiFiClient object here
    int httpCode = http.GET();
    if (httpCode == 200) {
      String payload = http.getString();
      if(payload == "1"){
        Serial.println(payload);
        digitalWrite(ledPin, HIGH);
        // digitalWrite(ledPin, LOW);

      }
      else{
      digitalWrite(ledPin, LOW);
      }
    } else {
      // digitalWrite(ledPin, LOW);
      Serial.println("API request failed");
    }
    http.end();
  } else {
    Serial.println("WiFi connection lost");
  }
  delay(10000);

}


