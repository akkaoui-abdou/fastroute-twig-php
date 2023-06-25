## Make a PHP Router


### in the first time install Composer in your machine

### install package fast-route 

https://packagist.org/packages/nikic/fast-route

        composer require nikic/fast-route


### install twig package

        composer require "twig/twig:^3.0"

### Fix error Route Not Found

by adding file .htaccess


## You have to add autoload in composer.json

        "autoload": {
                "psr-4": {
                         "App\\": "src/"
                }
        },

Source fix probleme route not found: https://stackoverflow.com/questions/56961390/class-not-found-with-composer-psr4

Links :

https://www.youtube.com/watch?v=ExCBgYMN5U0

https://github.com/nikic/FastRoute
