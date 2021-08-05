<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## About my laraveldaily-shop

There is simple CRUD shop app built in laravel 8, inspired by several [Laraveldaily courses](https://laraveldaily.teachable.com/courses/ ) about basic features of Laravel framework. There are users, but maily categories and products (and ratings under construction). <br/>
You will find respective Models, Controllers, views. <br/>
That's master branch. <br/>
On other branches, I practice other topics inspired by respective [Laraveldaily course](https://laraveldaily.teachable.com/courses/ ), <br/>
suche as testing branch inspired by testing course, and etc.. 

## Building the app on your local machine
I built on Windows Home 10 with WSL2 and docker, using  [laravel sail](https://laravel.com/docs/8.x/sail ) <br/>

git clone https://github.com/avrahamm/laraveldaily-shop.git </br>
cd laraveldaily-shop

### mysql container
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
## laravel container shell
open another bash shell
```
sail shell
sail@1010be0b0584:/var/www/html$ php artisan migrate
php artisan db:seed
php artisan storage:link
```
## laravel container run sail shell
open another bash shell
```
sail up
```
open browser on localhost:80, log in with pre seeded admin user: <br/>
admin@admin.com <br/>
password <br/>

