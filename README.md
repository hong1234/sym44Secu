# sym44Secu

git clone https://github.com/hong1234/sym44Secu.git

cd sym44Secu

composer install

php bin/console doctrine:fixtures:load --append

php -S 127.0.0.1:8000 -t public

http://localhost:8000/product


