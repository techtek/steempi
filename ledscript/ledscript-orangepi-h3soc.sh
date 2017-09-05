#!/bin/bash

# SteemPi https://steemit.com/@techtek

# ledscript v1.0
# This script monitors a Steemit account and turns on a LED (gpio17 - wirringpi gpio 0) when change is detected.
# The script uses Streemian.com RSS feed: streemian.com/rss/@techtek/replies as the source for the updates
# To make it monitor replies to your account, change in the first line of the below script "@techtek" to your steemit account.



#Steemit account to monitor, change to your account!
    
	URL="https://streemian.com/rss/@techtek/replies"


	
	for (( ; ; )); do
    		mv new.html old.html 2> /dev/null	
    			curl $URL -L --compressed  -s > new.html 
sleep 1
				sed -i 's/[0-9]//g' new.html
sleep 1
    		DIFF_OUTPUT="$(diff new.html old.html)"
    		if [ "0" != "${#DIFF_OUTPUT}" ]; then

		
	

# Echo that there is a change detected when comparing old.html with new.html 

        echo notification LED On, change detected! 



# Make GPIO 1 an output port 

	gpio mode 1 out



# Turn the LED ON

        gpio write 1 1


sleep 3

        gpio write 1 0


sleep 2


    fi

done
