# Добро пожаловать на сайт!

Ниже я расскажу на каких технологиях базируется сайт и как они были реализованы и настроены.

Все инструменты были установленны посредством утилиты Homebrew и Xcode Command Line Tools на MacOS Mojave (10.14.6)
# NGINX

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
        	listen       5000;
        	server_name  localhost;
        	client_max_body_size 20M;
        	root   /Users/{user}/Sites/{project};
        	location / {
            	index  index.php index.html index.htm;
        	}
        	location ~ \.php$ {
            	fastcgi_pass   127.0.0.1:9000;
            	fastcgi_index  index.php;
            	fastcgi_param  SCRIPT_FILENAME /Users/{user}/Sites/{project}/$fastcgi_script_name;
            	include        fastcgi_params;
        	}
    }

# MySQL
СУБД была установлена с помощью Homebrew и был скачен инструмент для взаимодействия с базами данных и проверкой подключения - MySQL Workbench

Configuration File PATH: /etc/my.cnf

# PHP
PHP Version 7.2.22

Configuration File PATH: /usr/local/etc/php/7.2/php.ini

#PhpStorm
Идеальная среда разработки для работы и соединения всех этих компонентов в единное целое

 
