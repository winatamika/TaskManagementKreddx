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


## Installation

Clone the repository:

   git clone https://github.com/winatamika/TaskManagementKreddx.git
   

1. Install the dependencies:
    composer install
2. Configure the database settings in the .env file.
3. Run the database migrations:
    php artisan migrate
4. (Optional) Seed the database with sample data:
    php artisan db:seed --class=TasksTableSeeder
    
##Usage

To start the Task Management System, run the following command:
    php artisan serve

This will start the Laravel development server, and you can access the application in your browser at http://localhost:8000.

##API Endpoints

The Task Management System provides the following API endpoints:

    GET /allTasks: Retrieve all tasks.
    GET /tasks/{id}: Retrieve a specific task.
    POST /tasks: Create a new task.
    POST /tasks/{id}: Update a task.
    DELETE /tasks/{id}: Delete a task.
    GET /tasksfilter/: Filter tasks based on criteria such as status, priority, and due date.

Refer to the source code and the TasksController for more details on the available API endpoints and their usage.

##Interaction with Bash

You can simply use this script to manipulate the API 

    bash BashControl.sh add "Write some code" "Implement the auth module" "21/08/2023" "high" "Mika"
    bash BashControl.sh list
    bash BashControl.sh expiring-today
    bash BashControl.sh status "pending"
    bash BashControl.sh done 3
    bash BashControl.sh update 10 --description "xx" --priority "low"
    bash BashControl.sh delete 3



##Contributing

Contributions to the Task Management System are welcome! If you find any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request.


##License

This project is licensed under the MIT License.
