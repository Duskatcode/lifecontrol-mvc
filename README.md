# LifeControl MVC

LifeControl MVC es una aplicación web modular desarrollada con Laravel bajo arquitectura MVC. Integra herramientas de productividad, gestión personal y utilidades interactivas en una sola plataforma.

## Módulos principales

- Dashboard con datos reales
- Lista de tareas
- Calculadora de propinas
- Generador de contraseñas
- Gestor de gastos
- Sistema de reservas
- Gestor de notas
- Calendario de eventos
- Plataforma de recetas
- Juego de memoria
- Plataforma de encuestas
- Cronómetro online

## Stack utilizado

- PHP
- Laravel
- Blade
- SQLite
- JavaScript
- HTML
- CSS
- Git y GitHub

## Arquitectura MVC

El proyecto está organizado siguiendo el patrón MVC:

### Modelos

Representan las entidades persistentes de la aplicación:

- Task
- Expense
- Reservation
- Note
- Event
- Recipe
- Survey
- SurveyQuestion
- SurveyOption
- SurveyResponse

### Controladores

Gestionan la lógica de cada módulo:

- DashboardController
- TaskController
- TipCalculatorController
- PasswordGeneratorController
- ExpenseController
- ReservationController
- NoteController
- EventController
- RecipeController
- MemoryGameController
- SurveyController
- SurveyQuestionController
- SurveyResponseController
- StopwatchController

### Vistas

Las interfaces están construidas con Blade y organizadas por módulo dentro de:

```txt
resources/views/
Instalación local

Clonar el repositorio:

git clone https://github.com/Duskatcode/lifecontrol-mvc.git
cd lifecontrol-mvc

Instalar dependencias:

composer install

Crear archivo de entorno:

cp .env.example .env

Generar clave de aplicación:

php artisan key:generate

Crear base de datos SQLite:

touch database/database.sqlite

Configurar .env:

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/al/proyecto/database/database.sqlite

Ejecutar migraciones:

php artisan migrate

Levantar servidor:

php artisan serve

Abrir en el navegador:

http://127.0.0.1:8000
Tests

Ejecutar pruebas:

php artisan test
Estado del proyecto

El sistema cuenta con módulos funcionales de productividad, gestión, utilidades interactivas y encuestas. El dashboard principal resume datos reales de los módulos conectados a base de datos.

Repositorio
https://github.com/Duskatcode/lifecontrol-mvc

