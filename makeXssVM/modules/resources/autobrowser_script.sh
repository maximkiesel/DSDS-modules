apt-get update
apt-get install -y firefox-esr

(crontab -l 2>/dev/null; echo "* * * * * /bin/bash /root/crontab_script.sh") | crontab -

#fix for image upload
chown www-data /var/www/html/images/uploads/
chmod 755 /var/www/html/images/uploads/

