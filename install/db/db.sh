#! /bin/bash


ROOTPASSWDDB=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 32 | head -n 1)
PASSWDDB=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 32 | head -n 1)
#PASSWDDB=db_pass_mysql
echo $ROOTPASSWDDB >> /root/mysql_pass
echo $PASSWDDB
MAINDB=nettemp
DBUSER=nettemp
echo $dir
echo "s/dbpassmysql/$PASSWDDB/g"
sed -i "s/dbpassmysql/$PASSWDDB/g" /var/www/nettemp/config/config.txt
sed -i "s/dbpassmysql/$PASSWDDB/g" $dir/config/config.txt

# If /root/mysql_pass exists then it won't ask for root password
if [ -f /root/mysql_pass ]; then

    mysql -e "CREATE DATABASE $MAINDB /*\!40100 DEFAULT CHARACTER SET utf8 */;"
    mysql -e "CREATE USER '$DBUSER'@localhost IDENTIFIED BY '$PASSWDDB';"
    mysql -e "GRANT ALL PRIVILEGES ON $MAINDB.* TO '$DBUSER'@'localhost';"
    mysql -e "FLUSH PRIVILEGES;"

# If /root/mysql_pass doesn't exist then it'll ask for root password   
else
    echo "Please enter root user MySQL password!"
    echo "Note: password will be hidden when typing"
    read -sp rootpasswd
	echo $rootpasswd >> /root/mysql_pass
    mysql -uroot -p${rootpasswd} -e "CREATE DATABASE ${MAINDB} /*\!40100 DEFAULT CHARACTER SET utf8 */;"
    mysql -uroot -p${rootpasswd} -e "CREATE USER ${MAINDB}@localhost IDENTIFIED BY '${PASSWDDB}';"
    mysql -uroot -p${rootpasswd} -e "GRANT ALL PRIVILEGES ON ${MAINDB}.* TO '${MAINDB}'@'localhost';"
    mysql -uroot -p${rootpasswd} -e "FLUSH PRIVILEGES;"
fi
systemctl enable mariadb
systemctl restart mariadb

php-cgi -f $dir/modules/tools/db_reset.php


