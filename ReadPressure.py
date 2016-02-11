import smbus

#init bus
bus = smbus.SMBus(1)

# power up LPS331AP pressure sensor & set BDU
bus.write_byte_data(0x5d, 0x20, 0b10000100)

#write value 0b1 to register 0x21 on device at address 0x5d
bus.write_byte_data(0x5d,0x21, 0b1)

Pressure_LSB = bus.read_byte_data(0x5d, 0x29)
Pressure_MSB = bus.read_byte_data(0x5d, 0x2a)
Pressure_XLB = bus.read_byte_data(0x5d, 0x28)

count = (Pressure_MSB << 16) | ( Pressure_LSB << 8 ) | Pressure_XLB
#comp = count - (1 << 24)
#Pressure value is positive so just use value as decimal 
Pressure = count/4096.0 

print "%.2f" % Pressure
#print "Pressure MSB ",format(Pressure_MSB,'02x')
#print "Pressure LSB ",format(Pressure_LSB,'02x')
#print "Pressure XLB ",format(Pressure_XLB,'02x')
#print "Pressure 2 comp ",format(count,'06x')
#print "Pressure : ",format(comp,'04x')


