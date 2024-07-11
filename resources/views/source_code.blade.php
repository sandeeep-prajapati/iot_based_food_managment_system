<!-- @foreach($record as $r)
  <p>fhgj: {{$r->ssid}}</p>
@endforeach -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>your code to upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color : #F2E1C1;" onload="getCurrentLocation()">
    <div class="row">
        <h1>Your code to upload in ESP8266 Module</h1>
        <div class="col-md-6">
            <h2 class="p-4 text-center">
                this code you have to upload in food box
            </h2>
            <pre>
                <code>

#include <Wire.h>
#include <WiFi.h> // Add WiFi library
$include <HTTPClient.h> // Add HTTPClient library

$define echoPin 16   // Pin D0 
$define trigPin 5    // Pin D1

long duration, distance;

const char* ssid = "{{$r->ssid}}"; // Replace with your WiFi SSID
const char* password = "{{$r->wifiPassword}}"; // Replace with your WiFi password
const char* apiUrl0 = "http://192.168.43.28:8000/change_status/{{$r->id}}"; // Replace with your API URL
const char* apiUrl1 = "http://192.168.43.28:8000/zero_status/{{$r->id}}"; // Replace with your API URL

void setup(){
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

void loop(){
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
  
    if (distance < 10) { // Check if distance is less than 10 cm
        Serial.println("Distance is less than 10 cm, hitting API 0...");
        hitApi0();
    }
    else{
        Serial.println("Distance is less than 10 cm, hitting API 1...");
        hitApi1();
    }
    delay(10000);
}

void hitApi0() {
    HTTPClient http;
    http.begin(apiUrl0);
    int httpCode = http.GET();
    if (httpCode == 200) {
    Serial.println("API hit successfully!");
    } else {
    Serial.println("API hit failed!");
    }
    http.end();
}

void hitApi0() {
    HTTPClient http;
    http.begin(apiUrl1);
    int httpCode = http.GET();
    if (httpCode == 200) {
    Serial.println("API hit successfully!");
    } else {
    Serial.println("API hit failed!");
    }
    http.end();
}




// Here are some of the pin numbers used in ESP8266 programming in Arduino IDE ¹ ²:
// - D0: GPIO 16
// - D1: GPIO 5
// - D2: GPIO 4
// - D3: GPIO 0
// - D4: GPIO 2
// - D5: GPIO 14
// - D6: GPIO 12
// - D7: GPIO 13
// - D8: GPIO 15
// - D9/RX: GPIO 3
// - D10/TX: GPIO 1
// - D11/SD2: GPIO 9
// - D12/SD3: GPIO 10

                </code>
            </pre>
        </div>
        <div class="col-md-6"></div>

    </div>
</body>

</html>