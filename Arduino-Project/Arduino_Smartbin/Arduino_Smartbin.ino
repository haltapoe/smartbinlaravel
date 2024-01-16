#include <ESP8266WiFi.h>
#include <NewPing.h>
#include <TinyGPS++.h>
#include <SoftwareSerial.h>
#include <ESP8266HTTPClient.h>

// Define ultrasonic sensor pins
#define TRIGGER1 D0
#define ECHO1 D1
#define TRIGGER2 D2
#define ECHO2 D3

// Define motor control pins
#define motorPin D4
#define AIN1 D5
#define AIN2 D6

const char* ssid = "vivo T1 5G";
const char* password = "fadjar0011";

// Define motor speed
int speed = 255;

// Create NewPing objects for each sensor
NewPing sonar1(TRIGGER1, ECHO1);
NewPing sonar2(TRIGGER2, ECHO2);

// GPS variables
static const int RXPin = 9;
static const int TXPin = 10;
static const uint32_t GPSBaud = 9600;

// The TinyGPS++ object
TinyGPSPlus gps;

// The serial connection to the GPS device
SoftwareSerial ss(RXPin, TXPin);

// SoftwareSerial for SIM800L
SoftwareSerial sim800l(D7, D8);

void sendGPSData(float latitude, float longitude) {
  HTTPClient http;

  String url = "http://10.14.210.89:8080/get-rute";
  String jsonPayload = "{\"latitude\":" + String(latitude, 6) + ",\"longitude\":" + String(longitude, 6) + "}";

  http.begin(url.c_str());
  http.addHeader("Content-Type", "application/json");
  int httpResponseCode = http.POST(jsonPayload);

  if (httpResponseCode > 0) {
    Serial.print("HTTP Response code (GPS): ");
    Serial.println(httpResponseCode);
    String response = http.getString();
    Serial.println(response);
  } else {
    Serial.print("HTTP Request failed with error code (GPS): ");
    Serial.println(httpResponseCode);
  }

  http.end();
}

void sendUltrasonicData(int sensorNumber, int distance) {
  HTTPClient http;

  String url = "http://10.14.210.89:8080/get-centimeter-data";
  String jsonPayload = "{\"sensorNumber\":" + String(sensorNumber) + ",\"distance\":" + String(distance) + "}";

  http.begin(url.c_str());
  http.addHeader("Content-Type", "application/json");
  int httpResponseCode = http.POST(jsonPayload);

  if (httpResponseCode > 0) {
    Serial.print("HTTP Response code (Ultrasonic): ");
    Serial.println(httpResponseCode);
    String response = http.getString();
    Serial.println(response);
  } else {
    Serial.print("HTTP Request failed with error code (Ultrasonic): ");
    Serial.println(httpResponseCode);
  }

  http.end();
}

void setup() {
  Serial.begin(115200);

  pinMode(AIN1, OUTPUT);
  pinMode(AIN2, OUTPUT);
  pinMode(motorPin, OUTPUT);

  WiFi.begin(ssid, password);

  Serial.print("Connecting to WiFi");
  unsigned long startTime = millis();

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
    if (millis() - startTime > 15000) {
      Serial.println("\nConnection to WiFi timed out");
      break;
    }
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\nConnected to WiFi!");
  } else {
    Serial.println("\nFailed to connect to WiFi. Check your credentials and network.");
  }

  ss.begin(GPSBaud);

  sim800l.begin(9600);
  delay(2000);
  sim800l.println("AT");
  delay(2000);
  ShowSerialData();
  sim800l.println("AT+CGATT=1");
  delay(2000);
  ShowSerialData();
  sim800l.println("AT+CIFSR");
  delay(2000);
  ShowSerialData();
  sim800l.println("AT+CIPSTART=\"TCP\",\"example.com\",80");
  delay(2000);
  ShowSerialData();
  sim800l.println("AT+CIPSEND");
  delay(2000);
  ShowSerialData();
  sim800l.println("GET /index.html HTTP/1.0");
  sim800l.println();
  sim800l.println((char)26);
  delay(2000);
  ShowSerialData();
}

void loop() {
  delay(500); // Delay between measurements
  unsigned int distance1 = sonar1.ping_cm();
  unsigned int distance2 = sonar2.ping_cm();

  Serial.print("Sensor Trash: ");
  Serial.print(distance1);
  Serial.print(" cm\t");

  Serial.print("Open-Close Sensor: ");
  Serial.print(distance2);
  Serial.println(" cm\t");

  // Send ultrasonic sensor data to the server
  sendUltrasonicData(1, distance1);
  sendUltrasonicData(2, distance2);

  if (distance1 >= 15) {
    Serial.println("FULL");
  } else if (distance1 > 15 && distance1 < 55) {
    Serial.println("MEDIUM");
  } else {
    Serial.println("EMPTY");
  }

  if (distance2 >= 5 && distance2 <= 10) {
    Serial.println("Object Detected, Opening Trash Bin");
    digitalWrite(AIN1, HIGH);
    digitalWrite(AIN2, HIGH);
    delay(5000);
    digitalWrite(AIN1, LOW);
    digitalWrite(AIN2, LOW);
    delay(5000);
  } else {
    Serial.println("No Object");
    if (distance2 < 5) {
      digitalWrite(AIN1, HIGH);
      digitalWrite(AIN2, LOW);
    } else if (distance2 > 10) {
      digitalWrite(AIN1, LOW);
      digitalWrite(AIN2, HIGH);
    } else {
      digitalWrite(AIN1, LOW);
      digitalWrite(AIN2, LOW);
    }

    analogWrite(motorPin, speed);
    delay(10000);
  }

  // GPS loop
  while (ss.available() > 0) {
    gps.encode(ss.read());
    if (gps.location.isUpdated()) {
      Serial.print("Latitude= ");
      Serial.print(gps.location.lat(), 6);
      Serial.print(" Longitude= ");
      Serial.println(gps.location.lng(), 6);

      // Send GPS data to the server
      sendGPSData(gps.location.lat(), gps.location.lng());
    }
  }

  // SIM800L loop
  // You can add SIM800L functionality here if needed
}

void ShowSerialData() {
  while(sim800l.available()) {
    Serial.write(sim800l.read());
  }
}