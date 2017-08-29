 ![SteemPi logo](https://steemitimages.com/DQmVmaHMM4Hx8CzhZ4tAjvzJZAH1yq1R6xDABpFHgob8HNb/logo-09.png)

<p align="center">
  ![SteemPi logo](https://steemitimages.com/DQmVmaHMM4Hx8CzhZ4tAjvzJZAH1yq1R6xDABpFHgob8HNb/logo-09.png)
  
  cvcxvcv
</p>



STEEMPI V1.0 | Steemit LED light notifications and web interface for Raspberry Pi and other Raspberry Pi clones that uses the Wirringpi GPIO library.

SteemPi shows its interface on a connected TV (HDMI), but you can also view the interface with a web browser on mobile devices, laptops, pc, game consoles, smartwatches and other devices that are capable of browsing web pages.

SteemPi is made by @techtek and @dehenne.
<br>
<br>

"How to make your Pi, Steem?"
<br>
<br>


<h2>SteemPi v1.0 Tutorial</h2>
<br>


<h3>Step 1: Operating system</h3>

Install the latest version of Raspbian on your SD card
<code>https://www.raspberrypi.org/downloads/raspbian/</code>

- Boot up the system and connect to your home network and the internet (Wifi or cable)
- Enable SSH <code>Start > Preferences > Raspberry Pi Configuration > Interfaces > Enable ssh</code>
<br>
<br>


<h3>Step 2: SteemPi Installation</h3>

- Install Apache and PHP5, <code>sudo apt-get update</code> and install with the command <code>sudo apt-get install apache2 php5 libapache2-mod-php5</code> 
- Test the Apache websserver by opening a browser and type in the IP of your Pi, it should show a "it works" page. 
- If the test went ok you can delete the index file from /var/www/html/ open the directory by using the command <code>cd /var/www/html/</code> and to remove, <code>sudo rm index.html</code> 

- Clone the SteemPi project files to your Pi <code>cd /var/www/</code> and to clone it into the root html folder use the command, <code>sudo git clone https://github.com/techtek/steempi.git html</code>

The Webinterface is done!, Open the IP of your Pi in a browser and you should see the SteemPi webinterface.
<br>
<br>


<h3>Step 3: Steemit LED light notifications</h3>

- Connect a LED to GPIO17 of the Pi 
(and you shoud solder the correct resistor to the LED. it works without one, no problems so far but you may damage the pi without one. 
- Make ledscript.sh executable, <code>cd /var/www/html/ledscript/</code> and use the command <code>sudo chmod u+x ledscript.sh</code> 
- To run the script manualy: <code>cd /var/www/html/ledscript/</code> and to run it, <code>sudo ./ledscript.sh</code> The LED should blink one time because it detected change.

You can test if it is working by making a reply on my Steemit account <code>http://steemit.com/@techtek</code> 
This way you can test if your LED lights up, and it's a way to let me know you installed SteemPi.   

If the LED lights up, change <code>@techtek</code> in the script, to watch your account for updates to do this, use the commands:
<code>cd /var/www/html/ledscript/</code> and to edit use the command <code>sudo nano ledscript.sh</code> edit the username in the URL and exit and save with, ctrl+x

To make ledscript.sh boot on startup, <code>sudo nano /etc/rc.local</code> add in this file before exit 0 this line <code>/var/www/html/ledscript/./ledscript.sh</code>
and exit and save with, ctrl+x
<br>
<br>
<br>



<h1>Everything is now ready to use!</h1>

(When loading the interface local on the Pi it can be slow because of the auto-play of the 2 video feeds, you can fix this by disabling the <code>autoplay</code> function in <code>index.php</code>)
<br>
<br>
<br>

If you make changes to the SteemPi project, please do share them back to the SteemPi project so others can use those functionalities as well.

https://github.com/techtek/steempi

https://steemit.com/@techtek

https://steemit.com/@dehenne   

Please support the makers of the services that are integrated into SteemPi.

If you have a service or functionality you want to integrate, you could help by writing a custom code for your service that can be implemented in the SteemPi web interface.


