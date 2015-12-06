
# Pressure Click Barometer

A web based Barometer using a Mikrobus Pressure Click on a Raspberry Pi

Having been a fan of Matrix Multimeter E-Blocks system whilst developing on Microchip PIC's I was keen to try out MikroElekronica's Mikrobus system on the Raspberry Pi. The Mikrobus system makes it easy to add sensors in a building block fashion. There are hundreds of different Mikrobus click's available (They are not only usable with the Raspberry but also Beagle Bone Black and Arduino have expansion boards for the Mikrobus system).

As I have a Raspberry Pi as my webserver I liked the idea of adding a web based Charting Barograph. Many years ago when I did gliding. The gliding club had a analogue charting Barograph and it was useful to give a hint as to when the clouds might start to lift. I therefore ordered a Pressure sensor, only to later discoer that I might have done better with a weather sensor
## Hardware
I went for the 2-way shield but there is a single shield availabe`
### Hardware used
* [pi2-shield](http://www.mikroe.com/click/pi2-shield/)
* [pressure click](http://www.mikroe.com/click/pressure/)

I ordered mine from RS Components

### Alternative Hardware
* [Single pi shield](http://www.mikroe.com/click/pi-shield/)
* [Weather Click](http://www.mikroe.com/click/weather/)
(Would need different/altered software to read sensor)

### Install this software
From directory /home/pi issue command

**git clone https://github.com/KeithSloan/PressureClickBarometer.git**

## Setting up I2C
I2C must be enabled on the Raspberry Pi - 
see [Setting up I2C](http://www.raspberrypi-spy.co.uk/2014/11/enabling-the-i2c-interface-on-the-raspberry-pi)

When you get to the testing stage i.e. Running 
**sudo i2cdetect -y 1**

You should see an I2C device at address 5d

### Setting up ram file system
To avoid stress on my SD card I setup a ram filing system at /var/ram
First create the tmp dir:

 **sudo mkdir /var/ram** 

then edit the fstab file by

 **sudo nano /etc/fstab**

and add the line

 **tmpfs /var/ram tmpfs nodev,nosuid,size=1M 0 0** 

save and close the file. Now issue

 **sudo mount -a**

To check if your operation succeeded issue

 **df**
### Running LogServer.py

**python /home/pi/PressureClickBarometer/LogSensor.py**

Once you are happy it is working okay ctrl-C and this time run

**python /home/pi/PressureClickBarometer/LogSensor.py > /dev/null &**

Its worth checking that readings are being logged i.e. file /var/ram/readings.csv
exits and has reasonable values

I will add instructions to run on boot later

### Setting up webserver

Installing apache2, php5, php5-gd

**sudo apt-get install -y apache2, php5, php5-gd**

### Make php files available to Webserver

**sudo ln -s /home/pi/PressureClickBarometer/Info.php /var/www/html/Info.php**
**sudo ln -s /home/pi/PressureClickBarometer/Barometer.php /var/www/html/Barometer.php**

###php disgnostics

In browser access access **Info.php** on the Pi Webserver.
You can find the hostname of the pi by running the command

**hostname**

Then in a browser access URL <hostname>.local
Where <hostname> is the name returned by the hostname command

check "Loaded Configuration File". 

On my system is is **/etc/php5/apache2/php.ini** 

In configuration file change option Display Errors to

 **display_errors = On**

###pChart

Download pchart from [pChart DownLoad](http://www.pchart.net/download)

I unzipped to /home/pi/pChart/pChart2.1.4

soft links to /var/www/html

**sudo ln -s /home/pi/pChart/pChart2.1.4 /var/www/html/pChart**

You should now be able to access the Pi's Webserver and run Barometer.php

##Feedback

    Feedback to keith@sloan-home.co.uk


