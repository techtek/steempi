Tutotial is unfinished at this moment


# STEEMPI V1.0
Steemit LED light notifications and Web interface for Raspberry Pi (and other pi clones that uses the Wirringpi library)

Operating system
1 Install the latest version of Raspbian on your SD card
2 Boot up the system and connect to your network and the internet (wifi or cable)

Steemit LED light notifications 
3 Copy ledscript.sh to the desktop of Raspbian
4 Make ledscript.sh excecutable "CHMOD    to run manualy: "sudo ./ledscript"
5 Make ledscript.sh boot on startup, "sudo nano /etc/rc.local" add before exit 0 this line "/home/pi/Desktop/./ledscript"
6 Check if it works, and to celebrate, please leave me a reply on my steemit post and check if your LED lights up.
7 if it worked, you can change "@techtek" the script, to watch your account for updates: "cd /home/pi/Desktop"   "sudo nano ledscript.sh"

Webinterface
8 Install Apache and PHP5, "sudo apt-get update"   "sudo apt-get install apache2 php5 libapache2-mod-php5" test it by opening a browser and type in the IP of your Pi, it should show a "it works" page. delete the index file from /var/www/html/
9 Copy and replace the Steempi interface files into the /var/www/html/ folder
10 Open the IP of your PI in a browser and you should see the SteemPi webinterface
