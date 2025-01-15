# API de Noticias
API de noticias hecho con funcionalidad CRUD (Create, Read, Update, Delete) y siguiendo patrones
UML de base de datos para que dicho proyecto sea estandarizable a nivel global, asimismo mantenible
y escalable a futuro.

## Paso a paso para preparar la API

### Instalación
1. Antes de descargar el proyecto, asegúrate de tener los siguientes programas instalados:
- [x] Xampp o Laragon
- [x] Composer

2. El proyecto vendrá sin los módulos encargados de que funcione correctamente, similar a los `node_modules` de Node.js, ubícate 
en el directorio raíz del proyecto y luego instala los módulos con los siguientes comandos:
```BASH
composer install
composer require doctrine/dbal
```

3. Encender el servidor `Apache` y `MySQL` como si fueses a trabajar con un proyecto de PHP convencional.
4. Crear una base de datos con el nombre `news_feed`, dicho nombre puede ser modificado en el archivo `.env`.
5. La base de datos estará vacía después de creada, para agregarle las tablas y `seeders`, debes ejecutar los siguientes comandos:
```BASH
php artisan migrate
php artisan db:seed
```
6. Refresca la página o recarga la aplicación que esté manejando la base de datos, verás como se habrá llenado con sus respectivas tablas y datos de prueba.

>[!NOTE]
> Si solo necesitas subir las tablas sin datos de prueba, ejecuta el siguiente comando:

```BASH
php artisan migrate
```

7. Una vez rellenada la base de datos con sus tablas y/o datos de prueba, la API está lista para ejecutarse con el siguiente comando:
```BASH
php artisan serve
```

> [!NOTE]
> Si las imágenes no se logran mostrar en el frontend, en el directorio raíz del proyecto, ejecuta el siguiente comando:
```BASH
php artisan storage:link
```
