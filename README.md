# Trabajo final de grado - Web para gestión de competiciones y clubes de fútbol canarios #

## Atención
### Hay varios roles tanto para el panel de administración como para la web. Las credenciales se encuentran en el fichero txt con el enlace a este repositorio entregado en el moodle. Si han perdido el fichero txt o por cualquier motivo no funcionan contacten conmigo por el correo universitario raul.sanchez110@alu.ulpgc.es para solucionarlo ###

## Prerrequisitos
* [PHP](https://www.php.net/downloads) ^8.0.2
* [Composer](https://desarrolloweb.com/articulos/como-instalar-composer.html) ^2.4.2
* [NodeJS](https://nodejs.org/en/download)
* [SQLite](https://www.sqlite.org/download.html)

## Set up
En primer lugar, si desea ver los correos que se envían en la web deberán tener una cuenta en [Mailtrap](https://mailtrap.io/). 

En segundo lugar, deberá descargar el código y generar un archivo con el nombre *.env* (con el punto incluido) fuera de la carpeta *app* en el mismo nivel donde se encuentra el fichero *.env.example*. En el archivo generado copie todo el contenido del *.env.example* y si han creado la cuenta en Mailtrap deberá seguir el tutorial del siguiente enlace para añadir al archivo las líneas necesarias con sus credenciales:  [Tutorial para configurar Mailtrap](https://styde.net/como-enviar-emails-de-prueba-con-mailtrap-io-en-laravel/).

En tercer lugar, para ejecutar el código deberá introducir y ejecutar los siguientes comandos en un terminal del editor de código que utilice:

#### Atención: los comandos 4 y 5 son ejecuciones que se deberán quedar activas mientras desee ver la web. Por tanto, deberá tener dos terminales activas una para cada comando. Si desea terminarlas pulsen CRTL+C en ambos terminales. ####

1. ```npm install```
2. ```npm run build```
3. ```composer install```
4. ```npm run dev```
5. ```php artisan serve```
6. ```php artisan migrate:fresh --seed```
7. ```php artisan storage:link ```

Por último, una vez haya configurado el archivo *.env* y ejecutado todos los comandos deberá ir a un navegador e introducir la url <http://localhost:8000/>. Si desea entrar al panel de administración deberá abrir la url <http://localhost:8000/admin/>
