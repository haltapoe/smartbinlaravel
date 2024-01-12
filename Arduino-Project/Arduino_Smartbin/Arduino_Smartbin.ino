#include <ESP8266WiFi.h>
#include <NewPing.h>
#include <TinyGPS++.h>
#include <SoftwareSerial.h>

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
static const int RXPin = 9; // Change this to an available pin on your board
static const int TXPin = 10; // Change this to an available pin on your board
static const uint32_t GPSBaud = 9600;

// The TinyGPS++ object
TinyGPSPlus gps;

// The serial connection to the GPS device
SoftwareSerial ss(RXPin, TXPin);

// SoftwareSerial for SIM800L
SoftwareSerial sim800l(D7, D8); // RX, TX

void setup() {
  Serial.begin(115200);

  pinMode(AIN1, OUTPUT);
  pinMode(AIN2, OUTPUT);
  pinMode(motorPin, OUTPUT);

  // Connect to WiFi
  WiFi.begin(ssid, password);

  Serial.print("Connecting to WiFi");
  unsigned long startTime = millis();
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
    if (millis() - startTime > 15000) {
    // Waktu habis setelah 15 detik
    Serial.println("\nWaktu koneksi WiFi habis");
    break;
    }
  }

  // Serial.println("");
  // Serial.println("Connected to WiFi!");

      if (WiFi.status() == WL_CONNECTED) {
      Serial.println("");
      Serial.println("Terhubung ke WiFi!");
    } else {
      Serial.println("\nGagal terhubung ke WiFi. Periksa kredensial dan jaringan Anda.");
    }
  // GPS setup
  ss.begin(GPSBaud);

  // SIM800L setup
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
  // Ultrasonic sensor measurements
  delay(500); // Delay between measurements
  unsigned int distance1 = sonar1.ping_cm();
  unsigned int distance2 = sonar2.ping_cm();

  Serial.print("Sensor Sampah: ");
  Serial.print(distance1);
  Serial.print(" cm\t");

  Serial.print("Sensor Buka Tutup: ");
  Serial.print(distance2);
  Serial.println(" cm\t");

// Kirim data ke server
  sendDistanceToServer(distance1, distance2);

  // Motor control based on sensor1
  if (distance1 >= 15) {
    Serial.println("PENUH");
  } else if (distance1 > 15 && distance1 < 55) {
    Serial.println("MEDIUM");
    // Add additional conditions or actions for the MEDIUM condition here
  } else {
    Serial.println("KOSONG");
    // Add additional conditions or actions for the KOSONG condition here
  }

  // Motor control based on sensor2
  if (distance2 >= 5 && distance2 <= 10) {
    Serial.println("Objek Terdeteksi, Membuka Buka Tutup Sampah ");
    digitalWrite(AIN1, HIGH);
    digitalWrite(AIN2, HIGH);
    delay(5000);
    digitalWrite(AIN1, LOW);
    digitalWrite(AIN2, LOW);
    delay(5000);
  } else {
    Serial.println("Tidak Ada Objek");
    analogWrite(motorPin, speed);

    digitalWrite(AIN1, LOW);
    digitalWrite(AIN2, HIGH);
    delay(10000);

    digitalWrite(AIN1, HIGH);
    digitalWrite(AIN2, LOW);
    delay(10000);

    digitalWrite(AIN1, LOW);
    digitalWrite(AIN2, LOW);
    delay(1000);
  }

  // GPS loop
  while (ss.available() > 0) {
    gps.encode(ss.read());
    if (gps.location.isUpdated()) {
      Serial.print("Latitude= ");
      Serial.print(gps.location.lat(), 6);
      Serial.print(" Longitude= ");
      Serial.println(gps.location.lng(), 6);

      // Kirim data ke server
      sendLocationToServer(gps.location.lat(), gps.location.lng());
    }
  }

  // SIM800L loop
  // You can add SIM800L functionality here if needed
}

// Fungsi untuk mengirim data lokasi ke server
void sendLocationToServer(float latitude, float longitude, unsigned int distance1, unsigned int distance2) {
  HTTPClient http;

  // Buat URL untuk pengiriman data lokasi
  String url1 = "http://10.14.210.89:8082/get-lokasi?lat=" + String(latitude, 6) + "&lng=" + String(longitude, 6);
  String url2 = "http://10.14.210.89:8082/get-centimeter-data?dist1=" + String(distance1) + "&dist2=" + String(distance2);

  // Mulai koneksi HTTP
  http.begin(url);

  // Kirim permintaan HTTP GET dan dapatkan respons
  int httpCode = http.GET();

  // Cek status koneksi
  if (httpCode > 0) {
    // Jika koneksi berhasil, tampilkan respons dari server
    Serial.println("Data lokasi terkirim ke server. Respons server:");
    Serial.println(http.getString());
  } else {
    Serial.println("Gagal mengirim data lokasi ke server");
  }

  // Akhiri koneksi
  http.end();
}

void ShowSerialData() {
  while(sim800l.available()) {
    Serial.write(sim800l.read());
  }
}