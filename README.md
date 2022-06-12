## About eProtocol

It is an application for the digital management and organisation of the registration process in an organisation/institution.

An e-Protocol program includes all the necessary tools to coordinate, monitor and organise an organisation's protocol process.

It is the most suitable solution for the management of protocols, as it offers the possibility of recording any digital document, which simplifies the process of searching and tracking them.

Basic management functions of the e-Protocol application:
- Recording incoming and outgoing documents.
- Ability to search for registered protocols.
- Categorisation of protocols.
- Digitisation of documents.
- Document storage security.

>This application was developed by **Andrei Robert Tica** (**Αντρέϊ Ρομπερτ Τσίκα**).

## Installation Process

In the following sections we will be explaining how to install this application into a server with all the necessary tools.
- MySQL
- PHP
- Nginx
- Composer
- Node npm

## Install Nginx

```shell
sudo apt install nginx
```

## Install MySQL

Install MySQL:
```shell
sudo apt install mysql-server
```

You can connect to MySQL to check if it works.
```shell
sudo mysql
```

And the exit it.
```shell
exit
```

## Install PHP

Install PHP:
```shell
sudo apt install php-fpm php-mysql
```

## Configuring Nginx to use PHP

Create the root web directory for your domain as follows:
```shell
sudo mkdir /var/www/andreastsika.site
```
> **Note**: Instead of `andreastsika.site` you can use another name.

Assign ownership of the directory with the `$USER` environment variable, which will reference your current system user:
```shell
sudo chown -R $USER:$USER /var/www/andreastsika.site
```

Create a new configuration file in Nginx’s `sites-available` directory using the nano editor:
```shell
sudo nano /etc/nginx/sites-available/andreastsika.site
```

Create the following basic server configuration for http connections to nginx:
```shell
server {
    listen 80;
    server_name andreastsika.eu www.andreastsika.eu;
    root /var/www/andreastsika.site;

    index index.html index.htm index.php;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
     }

    location ~ /\.ht {
        deny all;
    }
}
```
>**Note**: Next to the variable `server_name` use your own domain name.

Link the config file to nginx `sites-enabled` directory
```shell
sudo ln -s /etc/nginx/sites-available/andreastsika.site /etc/nginx/sites-enabled/
```

Unlink the default nginx config file (if exists).
```shell
sudo unlink /etc/nginx/sites-enabled/default
```

Check the config for syntax errors
```shell
sudo nginx -t
```

Gracefully restart the nginx service
```shell
sudo systemctl reload nginx
```

## Setting up database user for MySQL

Access MySQL
```shell
sudo mysql
```

Create the database for the project
```shell
CREATE DATABASE eprotocol;
```
>**Note:** Where `eprotocol` is the database name of the project. You can use another name.

Create new database administrator user
```shell
CREATE USER 'eprotocol_admin'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
```
>**Note**: Where `eprotocol_admin` is the name of the new database administrator.
> `password` is the password that he will be using to access the database.

Grand him permissions over the database
```shell
GRANT ALL ON eprotocol.* TO 'eprotocol_admin'@'%';
```

Exit MySQL
```shell
exit
```

## Install the required PHP modules
```shell
sudo apt install php-mbstring php-xml php-bcmath php7.4-gd php7.4-zip
```

## Install Composer

Go in your home directory and download composer:
```shell
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
```

Verify the installed you downloaded matches the SHA-384 hash from the latest installer found in Composer Public Key / Checksums (https://composer.github.io/pubkeys.html) by checking the hash:
```shell
HASH=`curl -sS https://composer.github.io/installer.sig`
echo $HASH
```

Check that the installation script is safe to run by using the code in composer page (https://getcomposer.org/download)
```shell
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

If the output is Installer verified then continue. Install composer globally by the command `composer` under the `/usr/local/bin` directory
```shell
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

Test the composer command by printing the version
```shell
composer -V
```

If it works remove the installer
```shell
rm composer-setup.php
```

## Add project files

Go inside the domain folder `andreastsika.site` and clone the project from github or add the project files with another method

Give the webserver user access to the project’s storage & cache folder
```shell
sudo chown -R www-data.www-data /var/www/andreastsika.site/storage
sudo chown -R www-data.www-data /var/www/andreastsika.site/bootstrap/cache
```

Re-config the nginx file
```shell
sudo nano /etc/nginx/sites-available/andreastsika.site
```

You can find the Laravel Configuration inside the official Laravel docs here (https://laravel.com/docs/8.x/deployment) and adjust them accordingly
```shell
server {
    listen 80;
    listen [::]:80;

    server_name andreastsika.site www.andreastsika.site;
    root /var/www/andreastsika.site/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Check the config for syntax errors
```shell
sudo nginx -t
```

Gracefully restart the nginx service
```shell
sudo systemctl reload nginx
```

In case the `vendor` directory that contains the packages is missing from the project files, then run the following command to install the packages
```shell
composer install
```

In case you want to update the packages to the latest version run the following command
```shell
composer update
```

## Set environments variables in the .env project file

Create the `.env` file or edit it if it already exists.
```shell
APP_NAME=eProtocol
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://server_ip

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eprotocol
DB_USERNAME=eprotocol_admin
DB_PASSWORD=password

TIMEZONE=Europe/Athens

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=support@eprotocol.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Variable Description
- `APP_NAME`: Application name
- `APP_ENV`: Application Status
  - `development`: For development status
  - `production`: For production status
- `APP_DEBUG`: Displays additional system information for debugging
  - `true`: Is activated
  - `false`: Is deactivated
- `APP_URL`: Add the server ip. e.g. `http://111.222.33.4444`
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database administrator username
- `DB_PASSWORD`: Database administrator password
- `MAIL_HOST`: Mail host
- `MAIL_PORT`: Mail port
- `MAIL_USERNAME`: Username for the mail
- `MAIL_PASSWORD`: Password credentials for the mail
- `MAIL_ENCRYPTION`: Mail encryption
- `MAIL_FROM_ADDRESS`: Application sender email
- `MAIL_FROM_NAME`: Application sender name

Generate the application key
```shell
php artisan key:generate
```

Run the migrations
```shell
php artisan migrate
```

Run the seeders
```shell
php artisan db:seed
```

## Install Node.js NPM tool

Install the tool
```shell
sudo apt install npm
```

Install node_modules if they are missing. Check if the `node_modules` directory is missing.
```shell
npm install
```

Run the tool for production
```shell
npm run prod
```
