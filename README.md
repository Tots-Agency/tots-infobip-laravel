# tots-infobip-laravel

Librería para integrar el envío de SMS a través de Infobip en proyectos Laravel.

## Instalación

Agrega el paquete a tu proyecto usando Composer:

```bash
composer require tots/infobip-laravel
```

## Configuración

1. Publica el archivo de configuración (si es necesario):

```bash
php artisan vendor:publish --provider="Tots\Infobip\Providers\TotsInfobipServiceProvider"
```

2. Configura tus credenciales en el archivo `.env`:

```
INFOBIP_API_KEY=tu_api_key
INFOBIP_API_BASE_URL=https://xxxx.api.infobip.com
INFOBIP_SENDER=NombreRemitente
```

3. El archivo de configuración `config/infobip.php` tomará estos valores automáticamente.

## Uso

Puedes utilizar el servicio para enviar SMS de la siguiente manera:

```php
use Tots\Infobip\Services\TotsInfobipService;

$service = app(TotsInfobipService::class);
$response = $service->sendSMS('+5491112345678', 'Mensaje de prueba');
```

## Ejemplo de respuesta

El método `sendSMS` retorna la respuesta de la API de Infobip en formato de objeto.

## Requisitos

- PHP >= 8.0
- Laravel 10 o 11

## Créditos

Desarrollado por [Matias Camiletti](mailto:matias.camiletti@gmail.com) para Tots Agency.

## Licencia

MIT