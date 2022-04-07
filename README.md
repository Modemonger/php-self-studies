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

5. To run the project simply use:
    ```php artisan serve```
