# SISGEC (Sistema Gestor de Expedientes Clínicos)
[![Build Status](https://travis-ci.org/SISGEC/SISGEC.svg?branch=master)](https://travis-ci.org/SISGEC/SISGEC)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FSISGEC%2FSISGEC.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2FSISGEC%2FSISGEC?ref=badge_shield)

Este proyecto aborda la problemática actual concerniente a la eficiencia y a la gestión de la información de los pacientes, que enfrentan los médicos en los consultorios médicos pequeños, de los encuadrados en el nivel uno de la atención médica en México.

Se llevó a cabo la planificación de este proyecto contemplando los requerimientos solicitados por un médico certificado, contemplando también la normatividad aplicable a los productos de expediente clínico en México. Se utilizó la metodología RUP y el modelo de ciclo de vida cascada modificado para el desarrollo, así como el empleo de tecnología web.

## Entorno de desarrollo

SISGEC trabaja con el [framework Laravel](https://laravel.com/docs/5.7/mix), siga los siguientes pasos para instalar el proyecto en su entorno de desarrollo.

### Requisitos

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Git >= 2.10.2.*
- Composer >= 1.7.2
- Node.js >= 8.11.1
- npm >= 6.1.10

### Instalación

1. Clone el repositorio en su carpeta de desarrollo preferida.
```
  $ cd /direccion/de/su/carpeta/htdocs
  $ git clone https://github.com/SISGEC/SISGEC sisgec
```
2. Ingrese a la carpeta que se ha creado en la clonación.
```
  $ cd sisgec
```
3. Ejecute el comando `composer install` y espere a que finalice.
4. Ejecute el comando `npm install` y espere a que finalice.
5. Listo, ¡ya puedes comenzar a contribuir! :)

#### Base de datos

SISGEC por default esta pensado para trabajar con SQLite sin embargo, puede llegar a trabajar con MySQL/MariaDB, PostgreSQL y SQL Server. Tenga en cuenta que utilizar cualquier otro sistema de gestión de base de datos diferente a SQLite puede conllevar a fallas en el software.

Para configurar SQLite siga los siguientes pasos:

1. Cree el archivo `database.sqlite` en la siguiente ruta `/direccion/de/su/carpeta/htdocs/sisgec/database`.
2. Abra el archivo `.env` con el editor de su preferencia y configure las siguientes opciones:
```
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```
3. Ingrese a la carpeta de su instalación por consola y ejecute los siguientes comandos:
```
  $ php artisan migrate
  $ php artisan db:seed
```
4. Con esto ya estará funcionando la base de datos correctamente. Por default podra ingresar al sistema usando los siguientes datos:
```
email: admin@nidiasoft.com
password: admin
```

## Contribuir

SISGEC es un proyecto Open Source por lo que esta abierto a recibir solicitudes, por favor lea la [documentación](https://github.com/SISGEC/SISGEC/wiki) para familiarizarse con nuestra filosofía antes de enviar su solicitud.

## Vulnerabilidades de Seguridad

Si descubre una vulnerabilidad de seguridad dentro de SISGEC, por favor envíe un correo electrónico a Jesús Magallón a través de jesus@yosoydev.net. Todas las vulnerabilidades de seguridad serán tratadas con prontitud.

## Licencia
SISGEC es un proyecto Open Source bajo la licencia [GNU General Public License v3.0](https://github.com/SISGEC/SISGEC/blob/master/LICENSE)


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FSISGEC%2FSISGEC.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2FSISGEC%2FSISGEC?ref=badge_large)