<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## Building the app on your local machine - with laravel sail
I built on Windows Home 10 with WSL2 and docker, using  [laravel sail](https://laravel.com/docs/8.x/sail ) <br/>
Turn on your desktop docker. <br/>
```
git clone https://github.com/avrahamm/laraveldaily-shop.git 
cd laraveldaily-shop
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

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
 
# if you want to rebuild
# sail build --no-cache   
# usually, run
sail up

```

## laravel container shell
open another bash shell to run artisan scripts to migrate tables, seed data, link files storage - inside container. <br/>
sail up creates database and user with credentials given in .env file. </br>
If had problems, may be 'mysql container troubleshoot' section can help.
```
sail shell
sail@1010be0b0584:/var/www/html$ # there is some chance data seeding fails. If so just run again and it will finally succeed.
sail@1010be0b0584:/var/www/html$ php artisan migrate:fresh --seed
sail@1010be0b0584:/var/www/html$ php artisan storage:link
```

### mysql container troubleshoot
Only if mysql user was not set properly by sail up, you can do it manually. <br/>
Otherwise, forward to next step. <br/>
```
 docker ps
CONTAINER ID   IMAGE          COMMAND                  CREATED          STATUS                    PORTS                                                  NAMES
1010be0b0584   sail-8.0/app   "start-container"        12 minutes ago   Up 12 minutes             0.0.0.0:80->80/tcp, :::80->80/tcp, 8000/tcp            laraveldaily-shop_laravel.test_1
904ab7c434da   mysql:8.0      "docker-entrypoint.s…"   12 minutes ago   Up 12 minutes (healthy)   0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp   laraveldaily-shop_mysql_1
avrahamm@DESKTOP-OFPVALS:/mnt/d/xamp/htdocs/laravel/exams/laraveldaily-shop$ docker exec -it 904 bash

root@904ab7c434da:/# mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.

mysql> CREATE USER 'sail'@'%' IDENTIFIED BY 'password';
Query OK, 0 rows affected (0.02 sec)

mysql> GRANT ALL PRIVILEGES ON *.* TO 'sail'@'%';
Query OK, 0 rows affected (0.03 sec)

mysql>
```

## Running in browser 
That's happy end !? <br/>
open browser on localhost:80, log in with pre seeded admin user: <br/>
admin@admin.com <br/>
password <br/>
You can rock! <br/>

