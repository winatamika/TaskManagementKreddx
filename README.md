# Task Management System

The Task Management System is a Laravel-based application that allows users to manage their tasks. It provides functionalities such as creating tasks, updating task details, marking tasks as complete, and filtering tasks based on various criteria.

## Architecture

The Task Management System is built using the Laravel framework, which follows the Model-View-Controller (MVC) architectural pattern. Here's an overview of the key components:

- **Models**: The `Task` model represents a task and its attributes, while the `User` model represents the users who own the tasks. These models define the structure of the database tables and handle data manipulation.

- **Controllers**: The `TasksController` handles the incoming HTTP requests and interacts with the models to retrieve or manipulate task data. It follows the RESTful design principles and provides endpoints for various operations such as creating, updating, and deleting tasks.

- **Routes**: The routes defined in the `routes/web.php` file map the incoming HTTP requests to the appropriate controller methods. They define the API endpoints and their corresponding actions.

- **Migrations**: The database migrations in the `database/migrations` directory define the structure of the database tables. They ensure that the necessary tables and their relationships are created when running the migrations.

- **Seeders**: The seeders in the `database/seeders` directory allow you to populate the database with sample data. The `TasksTableSeeder` seeder can be used to insert initial task records.

## Prerequisites

Before running the Task Management System, ensure that you have the following prerequisites installed:

- PHP (>= 7.4)
- Composer
- MySQL

