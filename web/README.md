# Dockerización de una Aplicación Laravel

## Contexto
Este proyecto, desarrollado como parte del curso de "Actualización II", tiene como objetivo dockerizar una aplicación Laravel para crear un entorno de desarrollo estandarizado y replicable. Utilizando Docker y Docker Compose, configuramos contenedores para PHP 8.2 con Apache y MySQL 8.2, permitiendo a los desarrolladores trabajar en un ambiente similar al de producción. La configuración incluye volúmenes para la persistencia de datos y la edición en tiempo real desde el host, facilitando el flujo de trabajo y la colaboración en equipo.

Este proyecto fue realizado por el equipo **"El Blog de los Ingenieros"** y documenta paso a paso la configuración de Dockerfiles, volúmenes, redes y otras configuraciones necesarias para implementar un entorno de desarrollo eficiente para Laravel.

## Instrucciones para Hacer Funcionar la Aplicación

### Requisitos Previos
Antes de iniciar, asegúrate de tener instalados en tu sistema:
- **Docker** (versión 20.10.0 o superior)
- **Docker Compose** (versión 1.27.0 o superior)

### Estructura del Proyecto
La estructura básica del proyecto es la siguiente:
```
docker_with_laravel/
├── db/
│   └── Dockerfile         # Dockerfile para el contenedor MySQL
├── web/
│   ├── Dockerfile         # Dockerfile para el contenedor PHP con Apache
│   ├── .env               # Archivo de configuración de variables de entorno para Laravel
│   ├── 000-default.conf   # Configuración de Apache para redirigir a Laravel
│   └── public/
│       └── .htaccess      # Configuración para manejar redirecciones en Laravel
├── docker-compose.yml     # Archivo de configuración para Docker Compose
└── README.md              # Instrucciones del proyecto
```

### Paso 1: Clonar el Repositorio

Clona el repositorio en tu máquina local:
```bash
git clone https://github.com/ReyCrisGit/docker_with_laravel.git
cd docker_with_laravel
```

### Paso 2: Configurar las Variables de Entorno
Dentro de la carpeta `web/`, asegúrate de tener el archivo `.env` configurado correctamente. Este archivo define las variables de entorno para conectar Laravel con la base de datos MySQL en Docker. Puedes utilizar el siguiente contenido como ejemplo:

```dotenv
APP_NAME="EL BLOG DE LOS INGENIEROS"
APP_ENV=local
APP_KEY=base64:65CilasP5AMD2I8wh6kFiy82X7+qVxUa8/5extdPupc=
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=mysql-service
DB_PORT=3306
DB_DATABASE=blog-db
DB_USERNAME=Admin
DB_PASSWORD=Admin123
```

### Paso 3: Crear y Configurar los Contenedores
Asegúrate de estar en el directorio raíz del proyecto (`docker_with_laravel`). Luego, ejecuta el siguiente comando para construir y lanzar los contenedores:

```bash
docker-compose up --build
```

Este comando realizará las siguientes acciones:
- **Construirá los contenedores**: PHP con Apache y MySQL, utilizando los Dockerfiles en `web/` y `db/`.
- **Creará una red** (`blog-red`) para permitir la comunicación entre los contenedores.
- **Montará los volúmenes** para la persistencia de datos en MySQL y la edición del código Laravel desde el host.

> Nota: La primera vez que se ejecute este comando, puede demorar algunos minutos, ya que Docker descargará las imágenes necesarias.
> Nota: Si no te funciona, ejecuta composer update para actualizar la carpeta vendor del proyecto de Laravel.

### Paso 4: Verificar el Estado de la Aplicación

Cuando los contenedores estén en ejecución, abre tu navegador y visita la siguiente URL:
```
http://localhost:8080/
```

Si todo está configurado correctamente, deberías ver la página de inicio de la aplicación Laravel.

### Paso 5: Comandos Útiles para Manejo de Contenedores

- **Detener los contenedores**:
  ```bash
  docker-compose down
  ```

- **Ver los logs de los contenedores**:
  ```bash
  docker-compose logs
  ```

- **Reiniciar los contenedores** (por ejemplo, después de hacer cambios en los Dockerfiles):
  ```bash
  docker-compose up --build
  ```

### Paso 6: Ejecución de Migraciones y Seeder

Para configurar la base de datos con tablas y datos de prueba, ejecuta los siguientes comandos:

```bash
docker-compose exec laravel-service php artisan migrate --seed
```

### Solución de Problemas

- **Error de Conexión a MySQL**: Verifica que las variables de conexión en `.env` coincidan con las del archivo `docker-compose.yml` y que el contenedor `mysql-service` esté en ejecución.
- **Cambios en el Código no Reflejados**: Asegúrate de que el volumen `./web:/var/www/html` esté correctamente configurado en `docker-compose.yml`.
- **Permisos de Archivos**: Si encuentras problemas de permisos, puedes ejecutar el siguiente comando para asignar los permisos necesarios en el contenedor:
  ```bash
  docker-compose exec laravel-service chown -R www-data:www-data /var/www/html
  ```

### Contribuciones y Control de Versiones

Para colaborar en el proyecto, cada miembro del equipo trabajó en una rama específica (e.g., `main`, `dev`, `barrios`, `ariel`). Esto permitió que los cambios individuales se integraran en la rama principal de forma organizada y con menos conflictos.