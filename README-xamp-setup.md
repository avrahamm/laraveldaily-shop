<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## Building the app on your local machine - with XAMP
- Install latest XAMP with php 8.
- Open Windows Powershell
```
cd C:\xampp\htdocs 
mkdir projects
cd C:\xampp\htdocs\projects\
git clone https://github.com/avrahamm/laraveldaily-shop.git 
cd laraveldaily-shop
php artisan key:generate 
```
Now copy .env.example and update DB block, for example you can take
```
DB_CONNECTION=mysql
#DB_HOST=127.0.0.1
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=first
DB_USERNAME=sail
DB_PASSWORD=password
#DB_USERNAME=root
#DB_PASSWORD=
```

### mysql phpmyadmin
- Open http://localhost/phpmyadmin in browser. <br/>
- Create DB, in my case DB_DATABASE=first. <br/>
```
cd laraveldaily-shop
```

## Running in browser without virtual host
open browser on http://localhost/projects/laraveldaily-shop/public/index.php<br/>
log in with pre seeded admin user: <br/>
admin@admin.com <br/>
password <br/>
You can rock! <br/>

## Running in browser with virtual host
You can configure virtual host. <br/>
Open C:\xampp\apache\conf\extra\httpd-vhosts.conf, edit <br/>

```
<VirtualHost *:80>
	DocumentRoot "C:/xampp/htdocs/"
	ServerName localhost
</VirtualHost>

<VirtualHost *:80>
	DocumentRoot "C:/xampp/htdocs/projects/laraveldaily-shop/public"
	ServerName laraveldaily-shop
</VirtualHost>
```
and save.

Open C:\Windows\System32\drivers\etc\hosts ,edit <br/>

```
127.0.0.1       localhost
127.0.0.1 		laraveldaily-shop
```
and save. <br/>

Restart XAMP <br/>

open browser on http://laraveldaily-shop <br/>
log in with pre seeded admin user: <br/>
admin@admin.com <br/>
password <br/>
You can rock! <br/>

