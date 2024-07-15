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
  <h1 class="text-center text-success">Your code to upload in ESP8266 Module</h1>
  @foreach ($record as $d)
    <div class="row">
        <div class="col-md-6">
            <h2 class="p-4 text-center">
                this code you have to upload in food box
            </h2>
            <pre>
                <code>
#include <*ESP8266WiFi.h*>
#include <*ESP8266HTTPClient.h*> // Use this header for ESP8266

#define echoPin 16 // pin D0
#define trigPin 5  // pin D1
long duration, distance;
const char* ssid = "{{$d->ssid}}"; // Replace with your WiFi SSID
const char* password = "{{$d->wifiPassword}}"; // Replace with your WiFi password
const char* apiUrl0 = "http://192.168.43.28:8000/change_status/{{$d->id}}"; // Replace with your API URL
const char* apiUrl1 = "http://192.168.43.28:8000/zero_status/{{$d->id}}"; // Replace with your API URL

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
        <div class="col-md-6">
            <h2 class="p-4 text-center">
                this code, you have to upload in your indicator box
            </h2>
            <pre>
              <code>
              #include <*ESP8266WiFi.h*>
#include <*ESP8266HTTPClient.h*>

const char* ssid = "{{$d->ssid}}";
const char* password = "{{$d->wifiPassword}}";
const char* apiUrl = "http://192.168.43.28:8000/on_led_light?latitude={{$d->latitude}}&longitude={{$d->longitude}}";
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



              </code>
            </pre>
        </div>

    </div>
    @endforeach
</body>

</html>