#! /bin/bash
{
#check other www server
if dpkg --get-selections | grep apache; then
service apache2 stop
update-rc.d apache2 disable
echo -e "[ ${GREEN}ok${R} ] Looks like You have Apache, service was stoped, until reboot."
fi

sudo openssl req -x509  -subj "/C=PL/CN=NNT"  -nodes -days 3650 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt

cp $dir/install/www/self-signed.conf /etc/nginx/snippets/
cp $dir/install/www/ssl-params.conf /etc/nginx/snippets/
cp $dir/install/www/nettemp /etc/nginx/sites-available/
ln -s /etc/nginx/sites-available/nettemp /etc/nginx/sites-enabled/

if [ ! -f /etc/nginx/sites-enabled/default ]
then
  echo "File does not exist. Skipping..."
else
  rm /etc/nginx/sites-enabled/default
fi

# php.ini upload file max size
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 2048M/g' /etc/php/7.3/cgi/php.ini
sed -i 's/post_max_size = 8M/post_max_size = 1024M/g' /etc/php/7.3/cgi/php.ini
sed -i 's/upload_max_filesize =.*/upload_max_filesize = 2048M/g'  /etc/php/7.3/fpm/php.ini
sed -i 's/post_max_size =.*/post_max_size = 1024M/g'  /etc/php/7.3/fpm/php.ini


#PHP7-FPM
#mv /etc/lighttpd/conf-available/15-fastcgi-php.conf /etc/lighttpd/conf-available/15-fastcgi-php.conf.old
#cp $dir/install/www/15-fastcgi-php.conf /etc/lighttpd/conf-available/
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 2048M/g' /etc/php/7.3/fpm/php.ini
sed -i 's/post_max_size = 8M/post_max_size = 2048M/g' /etc/php7.3/fpm/php.ini
sed -i 's/;sendmail_path =/sendmail_path = '\''\/usr\/bin\/msmtp -t'\''/g' /etc/php/7.3/fpm/php.ini


} >> $dir/install_log.txt 2>&1

exitstatus=$?
if [ $exitstatus = 1 ]; then
    echo -e "[ ${RED}error${R} ] WWW"
    exit 1
else 
    echo -e "[ ${GREEN}ok${R} ] WWW"
fi



