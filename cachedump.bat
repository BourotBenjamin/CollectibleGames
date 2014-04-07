rm -R ./app/cache/* ./app/logs/
chmod -R 777 ./app/cache ./app/logs
rm -R ./web/css/ 
rm -R ./web/js/
rm -R ./web/less/
php app/console assets:install web --symlink
php app/console assetic:dump
chmod -R 777 ./app/cache ./app/logs
PAUSE