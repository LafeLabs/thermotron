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

#include <Adafruit_NeoPixel.h>
#ifdef __AVR__
 #include <avr/power.h> // Required for 16 MHz Adafruit Trinket
#endif

// Which pin on the Arduino is connected to the NeoPixels?
// On a Trinket or Gemma we suggest changing this to 1:
#define LED_PIN    6

// How many NeoPixels are attached to the Arduino?
#define LED_COUNT 30

int delay_time = 30;//ms

int x = 10;
int knob = 0;
 
// Declare our NeoPixel strip object:

Adafruit_NeoPixel strip(LED_COUNT, LED_PIN, NEO_GRB + NEO_KHZ800);

// Argument 1 = Number of pixels in NeoPixel strip
// Argument 2 = Arduino pin number (most are valid)
// Argument 3 = Pixel type flags, add together as needed:
//   NEO_KHZ800  800 KHz bitstream (most NeoPixel products w/WS2812 LEDs)
//   NEO_KHZ400  400 KHz (classic 'v1' (not v2) FLORA pixels, WS2811 drivers)
//   NEO_GRB     Pixels are wired for GRB bitstream (most NeoPixel products)
//   NEO_RGB     Pixels are wired for RGB bitstream (v1 FLORA pixels, not v2)
//   NEO_RGBW    Pixels are wired for RGBW bitstream (NeoPixel RGBW products)


// setup() function -- runs once at startup --------------------------------

void setup() {
  // These lines are specifically to support the Adafruit Trinket 5V 16 MHz.
  // Any other board, you can remove this part (but no harm leaving it):
#if defined(__AVR_ATtiny85__) && (F_CPU == 16000000)
  clock_prescale_set(clock_div_1);
#endif
  // END of Trinket-specific code.

  strip.begin();           // INITIALIZE NeoPixel strip object (REQUIRED)
  strip.show();            // Turn OFF all pixels ASAP
  strip.setBrightness(150); // Set BRIGHTNESS to about 1/5 (max = 255)
}


// loop() function -- runs repeatedly as long as board is on ---------------

void loop() {
  knob = analogRead(A2);
  x = 30*knob/1023;
  
  for(int i=0; i<strip.numPixels(); i++) { // For each pixel in strip...
    if(i < x){
        strip.setPixelColor(i, 255, 0, 0);         
    }
    else{
        strip.setPixelColor(i, 0, 0, 0);               
    }
    strip.show();                           
  }      
}
```