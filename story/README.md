
# [Back to Thermotron](../)


# Thermotron TALE

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
