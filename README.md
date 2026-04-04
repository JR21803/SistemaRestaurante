## Sistema Restaurante

El presente proyecto es la resolución de un problema de gestión de restaurantes. Un restaurante enfrenta dificultades para llevar un control efectivo de la gestión de pedidos. Actualmente, el registro es manual y se busca que la API ayudar a resolver problemas como la falta de organización, detalles incorrectos, realización de pedidos y descuentos, etc.

## Instrucciones de levantamiento

1. Clonar el repositorio y abrir la carpeta
git clone https://github.com/JR21803/SistemaRestaurante

cd SistemaRestaurante

2. Instalar dependencias

composer install

3. Configurar el entorno desde el archivo .env

cp .env.example .env 
php artisan key:generate


4. Configurar la base de datos desde el archivo .env


5. Ejecutar migraciones y seeders

php artisan migrate --seed

6. Ejecutar pruebas 

php artisan test


5. Borrar la base de datos y migraciones, y volver a ejecutar los seeders

php artisan migrate:fresh --seed


## Usuarios de prueba

admin: adminRestaurante@example.com // password

Empleado: luisEmpleado@example.com // password
mariaEmpleado@example.com // password

Cliente: juan@example.com // password
ana@example.com // password
