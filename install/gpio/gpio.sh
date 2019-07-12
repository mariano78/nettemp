#! /bin/bash 


{
mkdir wiringPi
cd wiringPi
wget https://project-downloads.drogon.net/wiringpi-latest.deb
dpkg -i wiringpi-latest.deb
ln -s /usr/bin/gpio /usr/local/bin/
cd $dir

} >> $dir/install_log.txt 2>&1

exitstatus=$?
if [ $exitstatus = 1 ]; then
    echo -e "[ ${RED}error${R} ] GPIO"
    exit 1
else 
    echo -e "[ ${GREEN}ok${R} ] GPIO"
fi





