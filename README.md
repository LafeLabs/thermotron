# [THERMOTRON](https://github.com/lafelabs/thermotron)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/thermotron.svg)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T-replication.svg)

![](images/qrcode.png)
![](images/qrcode-page.png)


![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T-chain.svg)


[![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/feather.jpg)](https://www.adafruit.com/product/5300)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T1.svg)

[![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T1-back.jpg)](https://www.adafruit.com/product/5027)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T2.svg)

[![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T2-back.jpg)](https://www.adafruit.com/product/5027)


![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T3.svg)

[![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T3-back.jpg)](https://www.adafruit.com/product/5027)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T4.svg)

[![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/T4-back.jpg)](https://www.adafruit.com/product/5027)


### [code.py](https://github.com/LafeLabs/thermotron/blob/main/circuit_python/code.py)

![](https://raw.githubusercontent.com/LafeLabs/thermotron/main/images/circuitpy-lib.jpg)


## TALE

I am an applied physicists by trade and by training, and I go by Trash Robot on the Internet. The THERMOTRON is a free hardware implementation of a project I was paid to work on while working at the Johns Hopkins University Applied Physics Laboratory in suburban Maryland, half way between DC and Baltimore.  We had a complex system of pipes and tubes and needed to log temperatures at various points around the system.  This is the sort of task that is supposed to be "easy".  All you have to do is buy stuff and it "just works".  But what system? And how will it log?  How will it talk to your existing systems? How do you make the trade offs between cost and accuracy?

What I concluded was that I2C sensors from [Adafruit](https://adafrut.com) would be the easiest way to do this, with the best trade off of accuracy vs. cost, as well as removing a bunch of the cost associated with engineering that the user has to do to make a real system. 

To avoid soldering, we use the Qwiic Connect System from Sparkfun.  This is also something I plan to now adopt in all other projects I'm working on, including cryogenic.  

This is a project that got abandoned by me when I quit my old job, and then also abandoned internally for various reasons. But now, I've found myself talking with both compost enthusiasts and people fixing solar vehicles, where temperature matters in the range of room temperature, from below freezing up to as high as 200 F.  

Looking at advances in the hardware on Adafruit, especially how they have built in displays, run circuit python, have the connectors I need, and can emulate a keyboard, I decided to go with the FeatherWing to try out temperature readouts with that instead of Arduino.  

The plan here is to program the FeatherWing to read out all the thermometers, and then scroll them in a display on the screen, and also to *type* them as a keyboard emulated piece of hardware, so that the system can input data as text. 

Once we have a system that can behave like a keyboard, anyone can simply dump the output of that stream of keystrokes into a text file.  But also, that sequence can include carriage returns and control characters of all kinds, allowing it to fully interact with any kind of software with a keyboard input.   This will allow us to integrate the devices into the Trash Magic system of web-based applications as well as the decentralized social media networks of the Fediverse.  

We will specify a standard JSON format here in this self-replicating document which anyone copying the system can use to publish data over the Fediverse.  We can build formats on top of this for metadata which include latitude and longitude, altitude, stories of where the data came from, what it's for, what it means, what you can do with it, images, urls, contact info of creators and so on.  And then people can join together to build software which aggregates these data sets, plots them, analyzes them, and then releases the product of that analysis back out onto the federated science networks.  

This is thermometry as social media!

Also note that with a GPS module on a mobile station like a vehicle, this system can gather a rather large amount of high resolution temperature data.  A headless single board computer can log or it can save data and then dump after some amount of time over serial.  

A combination of photographs of a scene with locations marked of sensors can be used to generate an interpolated 3d map of expected temperatures.  This is not real. But it can be trained to become more and more real over time by taking data and building up models on the data both across the whole social network and around any given specific system. Python and the various open source machine learning systems around images in python can be used as well as Blender to create visualizations of temperature data on 3d virtual worlds built on the real world. 

We can create data which can see microclimates down to the millimeter of resolution, up to the global scale for all of the Earth. And we can create raw data which can be used to learn the physics of all things in our everyday world.  We can build up thermal models of parts in vehicles, parts of houses, parts of large buildings, trees, soil, compost, and so on.

One thing that is missing from the initial prototype is waterproofing. Also we need to build up a model for any given environmental enclosure for how the sensor actually couples to the environment, how much it might read off due to gradients, how to eliminate and compute gradients. We want a system for calibration of our sensors as well as standard operating procedures for using our sensors to calibrate other sensors.  

If you build one of these and run it, and help build out this network, you can build science for whatever it is you do, be it building machines or composting.

## BOM(Bill Of Materials)

 - [1x $24.95 Adafruit ESP32-S2 TFT Feather - 4MB Flash, 2MB PSRAM, STEMMA QT](https://www.adafruit.com/product/5300)
 - [4x $4.95 Adafruit MCP9808 High Accuracy I2C Temperature Sensor Breakout - STEMMA QT / Qwiic](https://www.adafruit.com/product/5027)
 - [1x $4.95 Adafruit USB Type A to Type C Cable - approx 1 meter / 3 ft long](https://www.adafruit.com/product/4474)
 - [4x $1.13 STEMMA QT / Qwiic JST SH 4-Pin Cable - 200mm Long](https://www.adafruit.com/product/4401)

## LORE

### [code.py](https://github.com/LafeLabs/thermotron/blob/main/circuit_python/code.py)

```
# SPDX-FileCopyrightText: 2018 Kattni Rembor for Adafruit Industries
#
# SPDX-License-Identifier: MIT

import time
import board
import digitalio
import adafruit_mcp9808
import usb_hid
from adafruit_hid.keyboard import Keyboard
from adafruit_hid.keyboard_layout_us import KeyboardLayoutUS
from adafruit_hid.keycode import Keycode

button_start_stop = digitalio.DigitalInOut(board.BUTTON)
button_start_stop.direction = digitalio.Direction.INPUT
button_start_stop.pull = digitalio.Pull.UP

#i2c = board.I2C()  # uses board.SCL and board.SDA
i2c = board.STEMMA_I2C()  # For using the built-in STEMMA QT connector on a microcontroller

# To initialise using the default address:
#mcp = adafruit_mcp9808.MCP9808(i2c)

# To initialise using a specified address:
# Necessary when, for example, connecting A0 to VDD to make address=0x19
mcp = adafruit_mcp9808.MCP9808(i2c, address=0x18)
mcp0 = adafruit_mcp9808.MCP9808(i2c, address=0x19) 
mcp1 = adafruit_mcp9808.MCP9808(i2c, address=0x1A)
mcp2 = adafruit_mcp9808.MCP9808(i2c, address=0x1C)

running = False
# The keyboard object!
time.sleep(1)  # Sleep for a bit to avoid a race condition on some systems
keyboard = Keyboard(usb_hid.devices)
keyboard_layout = KeyboardLayoutUS(keyboard)  # We're in the US :)



while True:
#    print(not(button_start_stop.value))
 #   print(not(button_unit_select.value))
    if not(button_start_stop.value):
        running = not(running)
        if not(running):
            print("STOP")
        else:
            print("START")
        time.sleep(0.1)
    T1C = mcp.temperature
    T1F = T1C * 9 / 5 + 32
    T2C = mcp0.temperature
    T2F = T2C * 9 / 5 + 32
    T3C = mcp1.temperature
    T3F = T3C * 9 / 5 + 32
    T4C = mcp2.temperature
    T4F = T4C * 9 / 5 + 32
    if running:
        print("[{},{},{},{}] F\n[{},{},{},{}] C".format(T1F, T2F, T3F, T4F, T1C, T2C, T3C, T4C))
        keyboard_layout.write("[{},{},{},{}] F\n[{},{},{},{}] C\n".format(T1F, T2F, T3F, T4F, T1C, T2C, T3C, T4C))
    time.sleep(1)


```


 - [The Qwiic Connect System from Sparkfun](https://www.sparkfun.com/qwiic)
 - [keyboard emulation absolute basics](https://learn.adafruit.com/make-it-a-keyboard/overview)
 - [logger with keyboard emulation](https://learn.adafruit.com/make-it-data-log-spreadsheet-circuit-playground/overview)
 - COMPOST
 - AUTO MECHANICAL THERMOMETRY
 - SOLAR POWER THERMOMETRY
 - THE FEDIVERSE
 - JSON
 - TRASH MAGIC
 - P5JS
 - ADAFRUIT
 - SPARKFUN
 - FEATHER WING
 - CLIMATE DATA
 - [EDITOR.PHP](editor.php)