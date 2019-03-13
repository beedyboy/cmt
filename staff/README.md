#Debrise
This is an ecommerce website which basically deal in hamper's items
sudo nano /etc/apache2/sites-available/000-default.conf

<VirtualHost *:80>
    <Directory /var/www/html>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>

    . . .
</VirtualHost>

sudo systemctl restart apache2