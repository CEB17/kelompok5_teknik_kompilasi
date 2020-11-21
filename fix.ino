#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <ESP8266HTTPClient.h>
#define LED D2
#define potPin A0

const char* ssid = "KISHELL"; 
const char* password = "bayardulu";
const char* host = "192.168.100.5";

bool Parsing = false;
String dataPHP, data[8];
int nilai, nil;
String isi;

void setup()
{
  Serial.begin(115200);
  Serial.println();
 
  Serial.printf("Connecting to %s ", ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println(" connected");
 
  pinMode(LED, OUTPUT);
  digitalWrite(LED, HIGH);
  nil=0;
}

void loop()
{

  WiFiClient client;

  if (client.connect(host, 80)) {
    Serial.println("connected]");
    Serial.println("[Sending a request]");

    String url = "iot_1/iot/baca-data.php?id=1"; // Lokasi File Baca Data
   
    client.print(String("GET /") + url + " HTTP/1.1\r\n" +
    "Host: " + host + "\r\n" +
    "Connection: close\r\n" +
    "\r\n"
  );

 
   Serial.println("[Response:]");
    while (client.connected())
    {
      if (client.available())
      {
        dataPHP = client.readStringUntil('\n');
        int q = 0;
        Serial.print("Data Masuk : ");
        Serial.print(dataPHP);
        Serial.println();

        data[q] = "";
        for (int i = 0; i < dataPHP.length(); i++) {
          if (dataPHP[i] == '#') {
            q++;
            data[q] = "";
          }
          else {
            data[q] = data[q] + dataPHP[i];
          }
        }
        Serial.println(data[1].toInt());
        digitalWrite(LED, data[1].toInt());
        Parsing = false;
        dataPHP = "";
      }    
     
    }
   
    client.stop();  
    database();
     
    Serial.println("\n[Disconnected]");
  }
  else
  {
    Serial.println("connection failed!]");
    client.stop();
  }
  delay(50);
}


void database(){
  if(WiFi.status()== WL_CONNECTED){
        HTTPClient http;
       
        nilai = analogRead(potPin);
        Serial.print("Nilai Potensio : ");
        Serial.println(nilai);
       
        // Your Domain name with URL path or IP address with path
        http.begin("http://192.168.100.5/simpan-data.php?potensio="+String(nilai)+"&kecerahan="+String(nil));
       
        // Specify content-type header
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
       
        // Prepare your HTTP POST request data
        String httpRequestData = "data=";
        Serial.println("httpRequestData~ ");
        //Serial.println(httpRequestData);
    
        // Send HTTP POST request
        int httpResponseCode = http.POST(httpRequestData);
         
        if (httpResponseCode>0) {
          Serial.print("HTTP Response code: ");
          Serial.println(httpResponseCode);
        }
        else {
          Serial.print("Error code: ");
          Serial.println(httpResponseCode);
        }
        // Free resources
        http.end();
    }
}
