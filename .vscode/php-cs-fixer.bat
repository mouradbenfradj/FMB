@echo off
setlocal enabledelayedexpansion
set "ARGS=%*"
:: Remplacer le chemin Windows par le chemin du conteneur
set "ARGS=!ARGS:C:\Mourad\www\Asc\=/var/www/asc/!"
set "ARGS=!ARGS:c:\Mourad\www\Asc\=/var/www/asc/!"
:: Convertir les antislashs en slashs
set "ARGS=!ARGS:\=/!"

docker exec -i www_asc php /var/www/asc/vendor/bin/php-cs-fixer !ARGS!