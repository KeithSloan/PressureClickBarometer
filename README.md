
# Pressure Click Barometer

A web based Barometer using a Mikrobus Pressure Click on a Raspberry Pi

Having been a fan of Matrix Multimeter E-Blocks system whilst developing on Microchip PIC's I was keen to try out MikroElekronica's Mikrobus system on the Raspberry Pi. The Mikrobus system making it easy to add sensors in a building block fashion. There are hundreds of different Mikrobus click's available (They are not only usable with the Raspberry but also Beagle Bone Black and Arduino have expansion boards for the Mikrobus system).

As I have a Raspberry Pi as my webserver I liked the idea of adding a web based Charting Barograph. Many years ago when I did gliding. The gliding club had a analogue charting Barograph and it was useful to give a hint as to when the clouds might start to lift. I therefore ordered a Pressure sensor, only to later discoer that I might have done better with a weather sensor
## Hardware
I went for the 2-way shield but there is a single shield availabe`
### Hardware used
-[pi2-shield](http://www.mikroe.com/click/pi2-shield/)
-[pressure click](http://www.mikroe.com/click/pressure/)

I ordered mine from RS Components### Alternative Hardware
-[Single pi shield](http://www.mikroe.com/click/pi-shield/)
-[Weather Click](http://www.mikroe.com/click/weather/)
(Would need different/altered software to read sensor)

 Git download
## Setting up I2C
configuring pi
Setting up I2C sofware`
i2c dev
### Testing I2C sensor

### Setting up ram file system
Logging Sensor readings
### Setting up webserver
Installing apache2, php5, php5-gd
php disgnostics
Download pchart
soft links to /var/www/html

**bold**
* Item 1
* Item 2
  * Item 2a
  * Item 2b

1. Item 1
2. Item 2

##Feedback

    Feedback to keith@sloan-home.co.uk


