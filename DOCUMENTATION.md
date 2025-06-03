# Documentación del Sistema de Gestión de Matrículas

> **Nota sobre el idioma**: Esta documentación está escrita en español para mantener consistencia con la interfaz de usuario y los comentarios del código. Esto facilita la comprensión y mantenimiento del proyecto para el equipo de desarrollo local.

## Descripción General
Este sistema permite gestionar de manera eficiente las matrículas de estudiantes en diferentes cursos. Está desarrollado con Laravel y utiliza una interfaz moderna y responsiva.

## Características Principales

### 1. Gestión de Estudiantes
- Registro de estudiantes con información detallada
- Búsqueda avanzada de estudiantes
- Gestión de documentos (certificados)
- Historial de matrículas por estudiante
- Exportación de datos en formato XML

### 2. Gestión de Cursos
- Creación y administración de cursos
- Control de capacidad de estudiantes
- Registro de fechas de inicio
- Seguimiento de matrículas por curso

### 3. Gestión de Matrículas
- Proceso de matrícula simplificado
- Registro de documentos de matrícula
- Historial de matrículas
- Gestión de estados de matrícula

## Estructura del Proyecto

### Directorios Principales
```
├── app/
│   ├── Http/Controllers/    # Controladores de la aplicación
│   ├── Models/             # Modelos de la base de datos
│   └── Services/           # Servicios de la aplicación
├── resources/
│   ├── views/              # Vistas Blade
│   │   ├── students/       # Vistas de estudiantes
│   │   ├── courses/        # Vistas de cursos
│   │   ├── enrollments/    # Vistas de matrículas
│   │   └── layouts/        # Plantillas principales
│   └── css/               # Estilos CSS
└── routes/
    └── web.php            # Definición de rutas
```

### Modelos Principales

#### Student
- `id`: Identificador único
- `first_name`: Nombre del estudiante
- `last_name`: Apellido del estudiante
- `dni_nie`: Documento de identidad
- `email`: Correo electrónico
- `phone`: Teléfono
- `birth_date`: Fecha de nacimiento
- `disability`: Indicador de discapacidad
- `address`: Dirección

#### Course
- `id`: Identificador único
- `name`: Nombre del curso
- `start_date`: Fecha de inicio
- `capacity`: Capacidad máxima de estudiantes

#### Enrollment
- `id`: Identificador único
- `student_id`: ID del estudiante
- `course_id`: ID del curso
- `enrollment_date`: Fecha de matrícula
- `enrollment_document`: Documento de matrícula

## Guía de Uso

### 1. Gestión de Estudiantes

#### Crear un Nuevo Estudiante
1. Navegar a "Estudiantes" en el menú principal
2. Hacer clic en "Nuevo Estudiante"
3. Completar el formulario con los datos requeridos
4. Guardar el registro

#### Buscar Estudiantes
- Utilizar el formulario de búsqueda avanzada
- Filtrar por nombre, DNI/NIE o correo electrónico
- Los resultados se actualizan en tiempo real

#### Gestionar Documentos
1. Seleccionar el estudiante
2. Hacer clic en "Subir Certificado"
3. Seleccionar el archivo
4. Confirmar la carga

### 2. Gestión de Cursos

#### Crear un Nuevo Curso
1. Acceder a "Cursos" en el menú
2. Hacer clic en "Nuevo Curso"
3. Ingresar nombre, fecha de inicio y capacidad
4. Guardar el curso

#### Ver Detalles del Curso
- Hacer clic en el curso deseado
- Ver lista de estudiantes matriculados
- Ver estadísticas de ocupación

### 3. Proceso de Matrícula

#### Realizar una Matrícula
1. Ir a "Matrículas" en el menú
2. Hacer clic en "Nueva Matrícula"
3. Seleccionar estudiante y curso
4. Subir documento de matrícula
5. Confirmar la matrícula

#### Gestionar Matrículas Existentes
- Ver detalles de la matrícula
- Editar información si es necesario
- Eliminar matrícula (si aplica)

## Requisitos Técnicos

### Servidor
- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js y NPM (para assets)

### Extensiones PHP Requeridas
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Instalación

1. Clonar el repositorio
```bash
git clone https://github.com/Andreas103-SI/Gestion-de-Matriculas-php-y-Laravel.git
```

2. Instalar dependencias
```bash
composer install
npm install
```

3. Configurar el entorno
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar la base de datos en `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=matriculas
DB_USERNAME=root
DB_PASSWORD=
```

5. Ejecutar migraciones
```bash
php artisan migrate
```

6. Compilar assets
```bash
npm run dev
```

7. Iniciar el servidor
```bash
php artisan serve
```

## Seguridad

### Autenticación
- Sistema de login integrado
- Protección de rutas
- Gestión de sesiones

### Permisos
- Control de acceso basado en roles
- Validación de formularios
- Protección CSRF

## Mantenimiento

### Backups
- Realizar backups regulares de la base de datos
- Mantener copias de seguridad de los documentos
- Documentar cambios importantes

### Actualizaciones
- Mantener Laravel actualizado
- Revisar dependencias regularmente
- Probar actualizaciones en entorno de desarrollo

## Soporte

Para reportar problemas o solicitar ayuda:
1. Revisar la documentación
2. Verificar los logs de error
3. Contactar al equipo de desarrollo

## Contribución

1. Fork el repositorio
2. Crear una rama para tu feature
3. Commit tus cambios
4. Push a la rama
5. Crear un Pull Request

## Licencia
Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Enlaces Útiles

### Documentación y Recursos
- [Documentación oficial de Laravel](https://laravel.com/docs)
- [GitHub del Proyecto](https://github.com/Andreas103-SI/Gestion-de-Matriculas-php-y-Laravel)

### Herramientas de Desarrollo
- [Composer](https://getcomposer.org/doc/)
- [Node.js](https://nodejs.org/es/docs/)
- [MySQL Documentation](https://dev.mysql.com/doc/)

### Entornos de Desarrollo
- [Docker](https://docs.docker.com/)
- [Laravel Sail](https://laravel.com/docs/sail)
- [XAMPP](https://www.apachefriends.org/es/docs/)
- [Laragon](https://laragon.org/docs/)


### Herramientas de Testing
- [PHPUnit](https://phpunit.de/documentation.html)
- [Laravel Testing](https://laravel.com/docs/testing)
- [Browser Testing con Laravel Dusk](https://laravel.com/docs/dusk)

### Seguridad
- [Laravel Security](https://laravel.com/docs/security)
- [OWASP](https://owasp.org/www-project-top-ten/)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)

### Despliegue
- [Laravel Forge](https://forge.laravel.com/docs)
- [DigitalOcean](https://docs.digitalocean.com)
- [AWS Documentation](https://docs.aws.amazon.com)
- [Heroku Documentation](https://devcenter.heroku.com)

## Rutas de la Aplicación

### Autenticación
- `GET /login` - Página de inicio de sesión
- `POST /login` - Procesar inicio de sesión
- `POST /logout` - Cerrar sesión
- `GET /register` - Página de registro
- `POST /register` - Procesar registro
- `GET /forgot-password` - Recuperar contraseña
- `GET /reset-password` - Restablecer contraseña

### Estudiantes
- `GET /students` - Lista de estudiantes
- `GET /students/create` - Formulario de nuevo estudiante
- `POST /students` - Guardar nuevo estudiante
- `GET /students/{id}` - Ver detalles del estudiante
- `GET /students/{id}/edit` - Editar estudiante
- `PUT/PATCH /students/{id}` - Actualizar estudiante
- `DELETE /students/{id}` - Eliminar estudiante
- `GET /students/trashed` - Ver estudiantes eliminados
- `GET /students/xml` - Exportar estudiantes a XML
- `GET /students/{id}/upload-certificate` - Subir certificado
- `POST /students/{id}/upload-certificate` - Procesar certificado

### Cursos
- `GET /courses` - Lista de cursos
- `GET /courses/create` - Formulario de nuevo curso
- `POST /courses` - Guardar nuevo curso
- `GET /courses/{id}` - Ver detalles del curso
- `GET /courses/{id}/edit` - Editar curso
- `PUT/PATCH /courses/{id}` - Actualizar curso
- `DELETE /courses/{id}` - Eliminar curso

### Matrículas
- `GET /enrollments` - Lista de matrículas
- `GET /enrollments/create` - Formulario de nueva matrícula
- `POST /enrollments` - Guardar nueva matrícula
- `GET /enrollments/{id}` - Ver detalles de la matrícula
- `GET /enrollments/{id}/edit` - Editar matrícula
- `PUT/PATCH /enrollments/{id}` - Actualizar matrícula
- `DELETE /enrollments/{id}` - Eliminar matrícula

### Perfil de Usuario
- `GET /profile` - Ver perfil
- `GET /profile/edit` - Editar perfil
- `PUT/PATCH /profile` - Actualizar perfil
- `PUT /profile/password` - Actualizar contraseña

### Dashboard
- `GET /dashboard` - Panel principal

> **Nota**: Todas las rutas están protegidas por autenticación excepto las rutas de login y registro. 