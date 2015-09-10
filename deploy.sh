#!/usr/bin/env bash

# Update and upgrade

apt-get update
apt-get -y upgrade

# Install some general packages

apt-get -y install zip unzip nano git build-essential zlib1g-dev libpcre3 libpcre3-dev mariadb-server

# Install HHVM

wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | apt-key add -
echo deb http://dl.hhvm.com/ubuntu trusty main | sudo tee /etc/apt/sources.list.d/hhvm.list
apt-get update
apt-get -y install hhvm
update-rc.d hhvm defaults

# Install nginx

apt-get -y install libssl-dev nginx
cd
wget https://github.com/pagespeed/ngx_pagespeed/archive/release-1.9.32.6-beta.zip
unzip release-1.9.32.6-beta.zip
cd ngx_pagespeed-release-1.9.32.6-beta/
wget https://dl.google.com/dl/page-speed/psol/1.9.32.6.tar.gz
tar -xzvf 1.9.32.6.tar.gz
cd
wget http://nginx.org/download/nginx-1.9.4.tar.gz
tar -xvzf nginx-1.9.4.tar.gz
cd nginx-1.9.4/
./configure --add-module=/root/ngx_pagespeed-release-1.9.32.6-beta --prefix=/usr/local/share/nginx --conf-path=/etc/nginx/nginx.conf --sbin-path=/usr/local/sbin --error-log-path=/var/log/nginx/error.log --with-http_ssl_module --with-http_stub_status_module --with-http_spdy_module
make
sudo make install
cd
cp /etc/init.d/nginx /etc/init.d/nginx-pagespeed
sed -i 's|/usr/sbin/nginx|/usr/local/sbin/nginx|g' /etc/init.d/nginx-pagespeed
rm /etc/init.d/nginx
rm -rf nginx-1.9.4/ nginx-1.9.4.tar.gz ngx_pagespeed-release-1.9.32.6-beta/ release-1.9.32.6-beta.zip
mkdir /home/nginx-conf
touch /home/nginx-conf/default
rm /etc/nginx/sites-available/default
ln -s /home/nginx-conf/default /etc/nginx/sites-available/default

# Finishing up

mkdir /var/www
mkdir /home/ssl