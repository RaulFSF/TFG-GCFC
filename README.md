# Trabajo final de grado - Web para gestión de competiciones y clubes de fútbol canarios #

### Hay varios roles tanto para el panel de administración como para la web. Para darle las credenciales de los diferentes roles contacten conmigo por el correo universitario raul.sanchez110@alu.ulpgc.es ###

### Prerequisitos: tener [PHP](https://www.php.net/downloads) ^8.0.2, [Composer](https://desarrolloweb.com/articulos/como-instalar-composer.html) ^2.4.2, [NodeJS](https://nodejs.org/en/download) y [SQLite](https://www.sqlite.org/download.html) instalado. ###

En primer lugar, si desea ver los correos que se envían en la web deberán tener una cuenta en [Mailtrap](https://mailtrap.io/). 

En segundo lugar, deberá descargar el código y generar un archivo con el nombre ".env" fuera de la carpeta "app" donde se encuentra el fichero ".env.example". En el archivo generado copie todo el contenido del ".env.example" y si han creado la cuenta en Mailtrap deberá seguir el tutorial del siguiente enlace para añadir al archivo las líneas necesarias con sus credenciales:  [Tutorial para configurar Mailtrap](https://styde.net/como-enviar-emails-de-prueba-con-mailtrap-io-en-laravel/).

En tercer lugar, para ejecutar el código deberá introducir y ejecutar los siguientes comandos en un terminal del editor de código que utilice:

#### Atención: los comandos 5 y 6 son ejecuciones que se deberán quedar activas mientras desee ver la web. Por tanto, deberá tener dos terminales activas una para cada comando. Si desea terminarlas pulsen CRTL+C en ambos terminales. ####

1. ```npm install```
2. ```npm run build```
3. ```composer install```
4. ```php artisan migrate:fresh --seed```
5. ```npm run dev```
6. ```php artisan serve```

Por último, una vez haya configurado el archivo ".env" y ejecutado todos los comandos deberá ir a un navegador e introducir la url <http://localhost:8000/>. Si desea entrar al panel de administración deberá abrir la url <http://localhost:8000/admin/>
