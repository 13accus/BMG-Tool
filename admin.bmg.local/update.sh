#!/bin/sh
printf "Starting Update Process\n"
sudo rm -rf app/cache/* app/logs/*
rm src/BMG/BookToolBundle/Entity/*.php~


if [ ! -d "app/cache" ]; then
  mkdir app/cache
fi
if [ ! -d "app/logs" ]; then
  mkdir app/logs
fi
if [ ! -d "app/sessions" ]; then
  mkdir app/sessions
fi
if [ ! -d "app/Resources/translations" ]; then
  mkdir app/Resources/translations
fi
if [ ! -d "vendor" ]; then
  composer.phar install
fi

composer.phar update

HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo chmod +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs app/sessions app/Resources/translations
sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs app/sessions app/Resources/translations

php app/console cache:clear
php app/console assets:install --symlink
php app/console doctrine:migrations:migrate

composer.phar dump-autoload --optimize

printf "Done\n"