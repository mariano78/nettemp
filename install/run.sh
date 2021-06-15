#! /bin/bash

> $dir/install_log.txt

mkdir -p $dir/tmp
rm -f $dir/config/config.php
cp $dir/install/config/config.php $dir/config/config.php

source install/apt/apt.sh
source install/rpi/rpi.sh
source install/1w/1w.sh
source install/python/python.sh
source install/dht/dht.sh
source install/gpio/gpio.sh
source install/i2c/i2c.sh

source install/fw/fw.sh
source install/sdm120/sdm120.sh
source install/sms/sms.sh
source install/ups/ups.sh


source install/www/www.sh
source install/crontab/crontab.sh
source install/perms/perms.sh
source install/db/db.sh

source install/services/services.sh


if [[ "$SENDSTATS" == "yes" ]]; then
	php-cgi -q install/stats/stats.php
fi

