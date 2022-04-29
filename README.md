## Prueba Técnica
Para Iniciar el proyecto se debe clonar este repositorio dentro de la máquina virtual, 
Luego se deberá seguir los siguientes pasos para instalar el proyecto.

## Instalación
Este comando instalara Laravel Sail dentro del proyecto:

composer require laravel/sail --dev

Antes de continuar se debe configurar el archivo .env para realizar la instalación de los servicios.

APP_NAME=Laravel<br>
APP_ENV=local<br>
APP_KEY=base64:YD7kOIGX77gr3iwQcklHyq392G7u6ly+sWRfVG2gVDo=<br>
APP_DEBUG=true<br>
APP_URL=http://prueba_tecnica.test<br>

LOG_CHANNEL=stack<br>
LOG_DEPRECATIONS_CHANNEL=null<br>
LOG_LEVEL=debug<br>

DB_CONNECTION=mysql<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=prueba_tecnica<br>
DB_USERNAME=sail<br>
DB_PASSWORD=password<br>

BROADCAST_DRIVER=log<br>
CACHE_DRIVER=file<br>
FILESYSTEM_DRIVER=local<br>
QUEUE_CONNECTION=sync<br>
SESSION_DRIVER=file<br>
SESSION_LIFETIME=120<br>

MEMCACHED_HOST=memcached<br>

REDIS_HOST=redis<br>
REDIS_PASSWORD=null<br>
REDIS_PORT=6379<br>

MAIL_MAILER=smtp<br>
MAIL_HOST=mailhog<br>
MAIL_PORT=1025<br>
MAIL_USERNAME=null<br>
MAIL_PASSWORD=null<br>
MAIL_ENCRYPTION=null<br>
MAIL_FROM_ADDRESS=null<br>
MAIL_FROM_NAME="${APP_NAME}"<br>

AWS_ACCESS_KEY_ID=<br>
AWS_SECRET_ACCESS_KEY=<br>
AWS_DEFAULT_REGION=us-east-1<br>
AWS_BUCKET=<br>
AWS_USE_PATH_STYLE_ENDPOINT=false<br>

PUSHER_APP_ID=<br>
PUSHER_APP_KEY=<br>
PUSHER_APP_SECRET=<br>
PUSHER_APP_CLUSTER=mt1<br>

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"<br>
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"<br>

Una vez configurado nuestro archivo .env se debe ejecutar:

php artisan sail:install

Cuando pregunte qué servicio instalar elegir la opción 0 mysql

Una vez instalado ahora se podrá ejecutar el proyecto con siguiente comando:
./vendor/bin/sail up

## Migración

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
