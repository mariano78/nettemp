#! /bin/bash 

{
sudo pip install Adafruit-GPIO

cd $dir
} >> $dir/install_log.txt 2>&1

exitstatus=$?
if [ $exitstatus = 1 ]; then
    echo -e "[ ${RED}error${R} ] Python - Adafruit"
    exit 1
else 
    echo -e "[ ${GREEN}ok${R} ] Python - Adafruit"
fi





