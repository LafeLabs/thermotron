# [THERMOTRON](https://github.com/lafelabs/thermotron/)

### [localhost](http://localhost/)

![qr code pointing to github repository](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/qrcode.png)

![a whole page of qr codes to print out](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/qrcode-screen.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/WHOLE-GEOMETRON.svg)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/geometron-assembly.svg)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/base.svg)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/base-geometron-cardboard.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/dividor-photograph.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/base-photo.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/shield-photo.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/photo-whole-thermometer.png)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/trashmagic/shield-board-screenshot.png)


### ARDUINO CODE

```
//THERMOTRON!
//PUBLIC DOMAIN!
//INSTALL THE ADAFRUIT NEOPIXEL LIBRARY TO RUN THIS CODE!




#include <Adafruit_NeoPixel.h>
#ifdef __AVR__
 #include <avr/power.h> // Required for 16 MHz Adafruit Trinket
#endif



// Which pin on the Arduino is connected to the NeoPixels?
// On a Trinket or Gemma we suggest changing this to 1:
#define LED_PIN    6

// How many NeoPixels are attached to the Arduino?
#define LED_COUNT 30


//put a voltage divider from 5 volts thru a 
//100 K thermister to A1 and from A1 to ground 
//via a 100k bias resistor, with negative temperature coeficient 
//voltage is monotonically increasing with temperature

int knob = 0;
int temperature = 0;
int temperature0 = 0;
int numLEDs = 30;
int v = 0;
int n = 10;
int barlevel = 0;
float gain = .25;
int frequency = 220;

int button1pin = 3;
int button2pin = 2;
boolean button1 = false;
boolean button2 = false;



Adafruit_NeoPixel strip(LED_COUNT, LED_PIN, NEO_GRB + NEO_KHZ800);

#include <Wire.h>
#include <SPI.h>


void setup() {

    Serial.begin(115200);
    strip.begin();           // INITIALIZE NeoPixel strip object (REQUIRED)
    strip.show();            // Turn OFF all pixels ASAP
    pinMode(button1pin,INPUT_PULLUP); 
    pinMode(button2pin,INPUT_PULLUP); 
    temperature = analogRead(A1);
    knob = analogRead(A2);
    temperature0 = temperature;

 
}


void loop() {
  v = 0;
  for(int index = 0;index < n;index++){
      v  = v + analogRead(A1);
      delay(1);
  }
  
  v = v/n;
  temperature = int(v);
  temperature = analogRead(A1);
  Serial.println(temperature);
  
  knob = analogRead(A2);
  button1 = !digitalRead(button1pin);  
  button2 = !digitalRead(button2pin);  
  if(!button1 && !button2){
    barlevel = int(knob*30/1024);
  }
  if(button1){
    gain = (knob+30.0)/1024.0;
  }
  if(button2){
    temperature0 = knob;
  }
  if(button1 || button2){
    barlevel = 14 + int(gain*(temperature - temperature0));
  }
  
   for(int i=0; i<strip.numPixels(); i++) { // For each pixel in strip...
    if(i < barlevel){
        strip.setPixelColor(i, 255, 0, 0);         
    }
    else{
        strip.setPixelColor(i, 0, 0, 0);               
    }
   }
    strip.show(); 

}



```