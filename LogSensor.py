import smbus
import csv
import time, os

Number = 100
TimeDelay = 300

def GetTemperature() :
    Temp_LSB = bus.read_byte_data(0x5d, 0x2b)
    Temp_MSB = bus.read_byte_data(0x5d, 0x2c)
    
    #combine LSB & MSB
    count = (Temp_MSB << 8) | Temp_LSB
     
    # As value is negative convert 2's complement to decimal
    comp = count - (1 << 16)

    #calc temp according to data sheet
    return(round(42.5 + (comp/480.0),2))

def GetPressure() :
    Pressure_XLB = bus.read_byte_data(0x5d, 0x28)
    Pressure_LSB = bus.read_byte_data(0x5d, 0x29)
    Pressure_MSB = bus.read_byte_data(0x5d, 0x2a)

    count = (Pressure_MSB << 16) | ( Pressure_LSB << 8 ) | Pressure_XLB
    #comp = count - (1 << 24)
    #Pressure value is positive so just use value as decimal 
    
    return(round(count/4096.0,2))



#init bus
bus = smbus.SMBus(1)

# power up LPS331AP pressure sensor
bus.write_byte_data(0x5d, 0x20, 0b10000000)

os.system("rm -f /var/ram/temp.csv")

while True :
   if os.path.isfile("/var/ram/readings.csv") :
      os.system("mv /var/ram/readings.csv /var/ram/temp.csv")
   with open("/var/ram/readings.csv","wb") as datafile:
        writer = csv.writer(datafile)

        #option to do a single read
        #write value 0b1 to register 0x21 on device at address 0x5d
        bus.write_byte_data(0x5d,0x21, 0b1)
        temperature = GetTemperature()
        pressure    = GetPressure() 

#       print "Temperature: %.2f" % temperature
#       print "Pressure   : %.2f" % pressure
        print "Temperature: ", temperature
        print "Pressure   : ", pressure

        writer.writerow(["Temperature","Pressure"])
        writer.writerow([temperature,pressure])
        if os.path.isfile("/var/ram/temp.csv") :
           with open("/var/ram/temp.csv","rb") as tmpfile:
                reader = csv.reader(tmpfile)
                next(reader, None) # skip header 
                x = 0
                for row in reader:
                    if x < Number:
                       #print(row)
                       writer.writerow(row)
                       x = x + 1
   time.sleep(TimeDelay)
