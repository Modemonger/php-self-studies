# Project requirements

- Node.js >= 16.10
- PHP >= 7.4.3
- Laravel >= 8.83.7
- composer >= 2.3.3

## Installation

1. Installing PHP on the system.
    Instalation guides for all systems can be found here: 
    https://www.php.net/manual/en/install.php

2. Downloading and installing composer.
Command line:
    - **Download**: ```php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"```
    - **Local install**: ```php composer-setup.php```
    - **Global install**: ```php composer-setup.php --install-dir=/usr/local/bin --filename=composer```
    - **Test**: ```composer``` \
Or use the installer from https://getcomposer.org/

3. Install Laravel.
    laravel instalation guide https://laravel.com/docs/9.x/installation \
    Or install using composer: ``` composer global require laravel/installe ```

4. Finally we will need npm which comes with Node.js. \
    Node.js instalation guide can be found here https://nodejs.org/en/

5. Install laravel dependencies using ``` composer install ```

6. To run the project simply go to project directory and in your terminal run :
    ```php artisan serve```

## Database 

1. To add a database to the project you will need to install MariaDb and MySql from https://mariadb.org/download \
 Or use XAMMP for a faster setup

2. Then create a database.

3. Then make a table in the database called 'items'.
    ```
    CREATE TABLE items (id INT NOT NULL AUTO_INCREMENT sku VARCHAR(20), name VARCHAR(255), price DECIMAL(15,3), weather VARCHAR(255));
    ```

4. Add items to database. 
    ```
    INSERT INTO `items` (`id`, `sku`, `name`, `weather`, `price`) VALUES (NULL, 'ht-001', 'hat', 'clear-snow-rain', '5.99');
    ```
5. Add the database configuration to the project in the .env file.
    ```
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=<your database name>
    DB_USERNAME=root
    DB_PASSWORD=<your database password if you have one>
    ```
## After starting
The API link is ``` http://127.0.0.1:8000/api/products/recommended/:city ``` \
The page link is ``` http://127.0.0.1:8000 ```
