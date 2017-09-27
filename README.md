SteemPi
======

<div style="text-align: center">
!(SteemPi)[app/images/readme_header.png]
</div>

STEEMPI V2.0 | Steemit LED light notifications and web interface for Raspberry Pi 
and other Raspberry Pi clones that uses the Wirringpi GPIO library.

SteemPi shows its interface on a connected TV (HDMI), 
but you can also view the interface with a web browser on mobile devices, laptops, pc, game consoles, smartwatches 
and other devices that are capable of browsing web pages.

SteemPi is made by:

- @techtek - https://steemit.com/@techtek
- @dehenne - https://steemit.com/@dehenne


Installation - How to make your Pi, Steem?
------


### Step 1: Operating system

Install the latest version of Raspbian on your SD card
`https://www.raspberrypi.org/downloads/raspbian/`

- Boot up the system and connect to your home network and the internet (Wifi or cable)
- Enable SSH `Start > Preferences > Raspberry Pi Configuration > Interfaces > Enable ssh`
- Login in via SSH


### Step 2: SteemPi Installation

- `sudo su`
- `mkdir /var/www/html -p`
- `apt-get install git -y`
- `cd /var/www/html`
- `git clone https://github.com/techtek/steempi.git .`

*If you want to install dev*

- `git checkout dev`
- `./install`


*It take a while*
*The script installs SteemPi and keep your system up to date*
*I recommend you to get a coffee*
*;-)*


### Step 3: Steemit LED light notifications

- Connect a LED to GPIO17 of the Pi 
(and you shoud solder the correct resistor to the LED. it works without one, 
no problems so far but you may damage the pi without one. 

- Make ledscript.sh executable, `cd /var/www/html/ledscript/` and use the command `sudo chmod u+x ledscript.sh`

- To run the script manualy: `cd /var/www/html/ledscript/` and to run it, `sudo ./ledscript.sh` 
The LED should blink one time because it detected change.

You can test if it is working by making a reply on my Steemit account `http://steemit.com/@techtek` 
This way you can test if your LED lights up, and it's a way to let me know you installed SteemPi.   

If the LED lights up, change `@techtek` in the script, 
to watch your account for updates to do this, use the commands:

`cd /var/www/html/ledscript/` and to edit use the command 
`sudo nano ledscript.sh` edit the username in the URL and exit and save with, ctrl+x

To make ledscript.sh boot on startup, 
`sudo nano /etc/rc.local` add in this file before exit 0 this line `/var/www/html/ledscript/./ledscript.sh`
and exit and save with, ctrl+x


Everything is now ready to use!
------

(When loading the interface local on the Pi it can be slow because of the auto-play of the 2 video feeds, 
you can fix this by disabling the `autoplay` function in `index.php`)

If you make changes to the SteemPi project, 
please do share them back to the SteemPi project so others can use those functionalities as well.

- https://github.com/techtek/steempi
- https://steemit.com/@techtek
- https://steemit.com/@dehenne   

Please support the makers of the services that are integrated into SteemPi.

If you have a service or functionality you want to integrate, 
you could help by writing a custom code for your service that can be implemented in the SteemPi web interface.


