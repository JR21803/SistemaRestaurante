# Sistema Restaurante

El presente repositorio contiene el desarrollo de un proyecto de cátedera de la materia de Desarrollo de Back-end con Laravel en la carrera de Ingeniería de Software y Negocios Digitales.

Se hizo el desarrollo de una API REST que buscaba la resolución de un problema de gestión de restaurantes. Permite un mejor control de la gestión de pedidos, inventarios, pagos y descuentos, dejando de lado la falta de organización y la gestión manual.


## Descripción del problema

Un restaurante local enfrenta dificultades para llevar un control efectivo de la gestión de pedidos. Actualmente, el registro es manual y se busca que la API ayude a resolver problemas como:

- Falta de organización: No se puede gestionar el inventario y materia prima disponible.
- Detalles incorrectos: Se puede presentar imprecisión en los precios del menú y por lo tanto afectar el total/subtotal en la factura


## Funcionalidades propuestas

### Autenticación por roles
- Usuarios: admin, empleado, cliente

### Gestión de pedidos
- CRUD de pedidos
- CRUD de productos
- CRUD de Usuarios

### Gestión de inventario
- Control detallado del inventario físico de materia prima

### Gestión de pagos
- Métodos de pago
- Pago de pedidos
- Aplicación de descuentos

## Tecnologías
- Laravel (PHP)
- MYSQL
- Composer
- Postman
- Stoplight

## Instrucciones de levantamiento

### 1. Clonar el repositorio del proyecto

git clone https://github.com/JR21803/SistemaRestaurante
cd SistemaRestaurante

### 2. Instalar dependencias

composer install

### 3. Configurar el entorno 

cp .env.example .env 
php artisan key:generate


### 4. Configurar base de datos

Editar .env con tus credenciales de base de datos


### 5. Migrar y poblar la base de datos

php artisan migrate --seed

### 6. Ejecutar pruebas 

php artisan test

### 7. Borrar la base de datos, migrar y poblar otra vez (Opcional)

php artisan migrate:fresh --seed


## Usuarios de prueba

admin: adminRestaurante@example.com // password

Empleado: luisEmpleado@example.com // password
mariaEmpleado@example.com // password

Cliente: juan@example.com // password
ana@example.com // password
