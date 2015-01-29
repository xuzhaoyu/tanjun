import serial
import requests 
import socket, struct, fcntl
import time, datetime

def get_ip_address(ifname):
		s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
		return socket.inet_ntoa(fcntl.ioctl(
				s.fileno(),
				0x8915,  # SIOCGIFADDR
				struct.pack('256s', ifname[:15])
		)[20:24])
		
file= open('/sys/class/net/wlan0/address')
mac = file.read().translate(None, ':').replace('\n','')
file.close()

serUSB = serial.Serial('/dev/ttyUSB0',9600,timeout=10)
serUSB.flush()
serUSB.open()

serArduino = serial.Serial('/dev/ttyACM0', 9600, timeout=0)

start = time.time()
PM25 = 0
PM100 = 0

while 1:
	p1 = 0;
	p2 = 0;

	while 1:
		if ((p1 == 170) and (p2 == 192)):
			break
		p1 = p2
		p2 = ord(serUSB.read(size = 1))
	
	line = serUSB.read(size = 8)
	
	PM25 += ord(line[1]) * 256 + ord(line[0])
	PM100 += ord(line[2]) + ord(line[3]) * 256

	if not ((ord(line[4]) == 0) and (ord(line[5]) == 0) and (ord(line[7]) == 171)) :
		print 'tail error!'
		break;

	if (time.time() - start) > 15:

		last = []
		while 1:
			line = serArduino.readline()

			if (line == ''): 
				time.sleep(0.2)
				continue

			temp = line.split()
			
			try:
        			if (temp[0] == 'Pressure=') and (temp[2] == 'Temperature=') or (temp[4] == 'Humidity='):
					break

			except:
				continue

		p = temp[1]
		t = temp[3]
		h = temp[5]

		print 'Time:' ,
		print time.strftime('%Y-%m-%d %H:%M:%S') ,
		print '     PM2.5=' ,
		print PM25 ,
		print '     PM10.0=' ,
		print PM100 ,
		print '     Pressure=' ,
		print p ,
		print '     Temperature=' ,
		print t ,
		print '     Humidity=' ,
		print h
		
		times = datetime.datetime.now()
		ip = get_ip_address('wlan0')
		data = {'mac': mac, 'ip': ip, 'clientTime': times, 'temp': round(float(t), 2), 'humidity': round(float(h), 2), 'pressure': round(float(p), 2), 'dust': round(float(PM100), 2)}
		r = requests.post("http://123.57.251.73/readings/reading", params = data)
		print r
		start = time.time()
		PM25 = 0
		PM100 = 0
