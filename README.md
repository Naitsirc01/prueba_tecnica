## Prueba Tecnica
Para Iniciar el proyecto se debe clonar este repositorio dentro de la maquina virtual, 
luego se debera usar los siguientes comandos dentro de la carpeta del proyecto:

Este comando instalara Laravel Sail dentro del proyecto:
composer require laravel/sail --dev

Antes de continuar se debe configurar el archivo .env para realizar la instalacion de los servicios.

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YD7kOIGX77gr3iwQcklHyq392G7u6ly+sWRfVG2gVDo=
APP_DEBUG=true
APP_URL=http://prueba_tecnica.test

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=prueba_tecnica
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=memcached

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

Una vez configurado nuestro archivo .env se debe ejecutar:
php artisan sail:install

Cuando pregunte que servicio instalar elegir la opcion 0 mysql

Una vez instalado ahora se podra ejecutar el proyecto con siguiete comando:
./vendor/bin/sail up

## Migracion

Una vez iniciado el proyecto, desde otra terminal en la carpeta del proyecto se debe ejecutar:
sail artisan migrate:fresh --seed

## Testing

Para realizar las pruebas en PHPUnit se debe utilizar el siguiente comando:
sail artisan test

## Credenciales

admin:
correo: admin@admin.com
contraseña: secret

usuario:
correo: user@user.com
contraseña: secret
