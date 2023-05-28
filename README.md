# Trabajo final de grado - Web para gestión de competiciones y clubes de fútbol canarios #

En primer lugar, si desea ver los correos que se envían en la web deberán tener una cuenta en [Mailtrap](https://mailtrap.io/). 

En segundo lugar, deberá descargar el código y generar un archivo con el nombre ".env" fuera de la carpeta "app" donde se encuentra el fichero ".env.example". En el archivo generado copie todo el contenido del ".env.example" y si han creado la cuenta en Mailtrap deberá seguir el tutorial del siguiente enlace para añadir al archivo las líneas necesarias con sus credenciales:  [Tutorial para configurar Mailtrap](https://styde.net/como-enviar-emails-de-prueba-con-mailtrap-io-en-laravel/).

En tercer lugar, para ejecutar el código deberá introducir y ejecutar los siguientes comandos en un terminal del editor de código que utilice:

#### Atención: los comandos 4 y 5 son ejecuciones que se deberán quedar activas mientras desee ver la web. Por tanto, deberá tener dos terminales activas una para cada comando. Si desea terminarlas pulsen CRTL+C en ambos terminales. ####

1. ```composer install```
2. ```npm install```
3. ```php artisan migrate:fresh --seed```
4. ```npm run dev```
5. ```php artisan serve```

Por último, una vez haya configurado el archivo ".env" y ejecutado todos los comandos deberá ir a un navegador e introducir la url <http://localhost:8000/>. Si desea entrar al panel de administración deberá abrir la url <http://localhost:8000/admin/>
