/*
Connection ESP2866 vers base sql
Modifié par S'Tonfute le 05/02/15
*/

// Set up macros for wifi and connection.
#define SSID ""		// SSID
#define PASS ""      // Network Password
#define HOST ""  // Webhost

// Set a password so that people can't just insert values by visiting the data entry page
// in their browser. Must be consistent with $passcode in data.php.
#define PASSCODE ""

#define SENDDELAY 180  // Seconds between sending data. Try to keep under 3 digits.


init errortype = 0; // =1 si erreur connection



void setup()
{
  
  // Test ESP8266 module.
  Serial.println("AT");
  delay(5000);
  if(Serial.find("OK")){
    connectWiFi();
  }
}



void loop(){



}

void sendData(String tBrightness, String tTemp, String tHum){
  // Set up TCP connection.
  String cmd = "AT+CIPSTART=\"TCP\",\"";
  cmd += HOST;
  cmd += "\",80";
  Serial.println(cmd);
  delay(2000);
  if(Serial.find("Error")){
    errortype = 1;  // Sets appropriate error message.
    return;
  }

  // Send data.
  cmd = "GET /esp8266/data.php?code=";
  cmd += PASSCODE;
  cmd += "&l=";
  cmd += tBrightness;
  cmd += "&t=";
  cmd += tTemp;
  cmd += "&h=";
  cmd += tHum;
  cmd += " HTTP/1.1\r\nHost: www.mwhprojects.com\r\n\r\n\r\n";
  Serial.print("AT+CIPSEND=");
  Serial.println(cmd.length());
  if(Serial.find(">")){
    Serial.print(cmd);
  }
  else{
    errortype = 1; //erreur WIFI
    Serial.println("AT+CIPCLOSE");
  }
}


boolean connectWiFi(){
  Serial.println("AT+CWMODE=1");
  delay(2000);
  String cmd="AT+CWJAP=\"";
  cmd+=SSID;
  cmd+="\",\"";
  cmd+=PASS;
  cmd+="\"";
  Serial.println(cmd);
  delay(5000);
  if(Serial.find("OK")){
    return true;
  }
  else{
    return false;
  }
}





