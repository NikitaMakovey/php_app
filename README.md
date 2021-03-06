# Добро пожаловать на сайт!

Ниже я расскажу на каких технологиях базируется сайт и как они были реализованы и настроены.

Все инструменты были установленны посредством утилиты Homebrew и Xcode Command Line Tools на MacOS Mojave (10.14.6)
# NGINX
Идеальный HTTP-сервер, в отличии от всем известного и уже устаревшего Apache - быстрый и экономный в потреблении ресурсов, и это не единственные особенности этого сервера.
 
Configuration location: /usr/local/etc/nginx/nginx.conf

Configuration:

    worker_processes  1;
    
    events {
        worker_connections  1024;
    }
    
    
    http {
        include       mime.types;
        default_type  application/octet-stream;
    
        sendfile        on;
        
        keepalive_timeout  65;
    
        server {
        	listen       80;
        	server_name  localhost;
        	client_max_body_size 20M;
        	root   /Users/{user}/Sites/{project}/symfony/public;
        	location / {
            	index  index.php index.html index.htm;
        	}
        	location ~ \.php$ {
            	fastcgi_pass   127.0.0.1:9000;
            	fastcgi_index  index.php;
            	fastcgi_param  SCRIPT_FILENAME /Users/{user}/Sites/{project}/symfony/public/$fastcgi_script_name;
            	include        fastcgi_params;
        	}
    }

Для пользователей MacOS:

По умолчанию на http://localhost находится стандартная страница Apache или же любая другая страница, которую вы когда-либо создавали. 
Чтобы от этого избавиться и сохранить право главного порта за NGINX, нужно выполнить команду 
    
    sudo apachectl stop
    # или
    sudo apachectl -k stop

# MySQL
СУБД была установлена с помощью Homebrew и был скачен инструмент для взаимодействия с базами данных и проверкой подключения - MySQL Workbench

Configuration File PATH: /etc/my.cnf

# PHP
PHP Version 7.2.22

Configuration File PATH: /usr/local/etc/php/7.2/php.ini

# PhpStorm
Идеальная среда разработки для работы и соединения всех этих компонентов в единное целое

# Symfony

Install symfony like this:
    
    cd project_folder/
    symfony check:requirements
    composer create-project symfony/skeleton symfony 

# Doctrine ORM

Action for installing and setting:
    
    composer require doctrine
    
    # into .env: DATABASE_URL=mysql://user:password@127.0.0.1:3306/lovikupon
    
    ./bin/console doctrine:database:create
    
    # create all tables into database like this:
    
    ./bin/console make:entity
    
    # make migration:
    
    ./bin/console make:migration
    ./bin/console doctrine:migrations:migrate
    
    #check migrations status

    ./bin/console doctrine:migrations:migrate
    
# PHPUnit

