# Proprli API Project

This project is part of the technical test for Proprli. The objective is to develop an API for creating and editing tasks. The API was built using Laravel 10 with a focus on the API components. The project includes six main tables (building, team, team_member, task, task_status, task_comment) and an additional audit table. Additionally, the default Laravel user table is used to link users to teams. For convenience, some data is pre-populated using seeders, allowing tasks to be created with pre-existing data.

## Technologies Used

- Laravel 10
- Docker
- MySQL
- JWT (JSON Web Token)

## Project Features

- **Building and Managing Tasks:** The API allows the creation, updating, and management of tasks, with status tracking and comment functionalities.
- **Audit Logging:** An observer was implemented to automatically log audit records during model events.
- **Service Architecture:** The project follows a service-oriented architecture to decouple business logic from the controllers.
- **Automated Testing:** Automatic tests were implemented to ensure the reliability of the core functionalities.

## API Endpoints

The project provides 10 main API routes to assist in the development process:

- `GET|HEAD  api/audit` - Retrieve audit logs.
- `POST      api/auth` - User authentication.
- `PUT       api/auth` - Update user credentials.
- `POST      api/auth/logout` - Logout the user.
- `GET|HEAD  api/auth/me` - Retrieve current user information.
- `GET|HEAD  api/building` - Retrieve building information.
- `POST      api/task` - Create a new task.
- `PUT       api/task` - Update an existing task.
- `GET|HEAD  api/task` - Retrieve tasks.
- `POST      api/task/comment` - Add a comment to a task.
- `GET|HEAD  api/task/status` - Retrieve task statuses.
- `GET|HEAD  api/user` - Retrieve user information.

Additionally, there is an `Insomnia_2024-08-21.json` file located in the root of the project containing a collection for Insomnia with all the routes.

## Installation

To assist with the installation, a Makefile has been included with several commands.

1. Clone the project to your desired directory.
2. Copy the `.env_example` file to `.env`.
3. Open a terminal in the root of the project.
4. The project uses ports 3388 and 8989. If you have any processes running on these ports, you will need to stop them to successfully start the container.

Since we need to create Docker containers, this process may take a while. 

### Using the Makefile

- Run the command: `make build`.
- After that, install dependencies and modules with: `make composer`.
- Once the dependencies are installed, start the application with: `make up`.
- Finally, create the database tables and run the migrations with: `make migrate`.

### Using the CMD

- **Build the project:** Run the command `docker compose build`.
- **Start the container to execute the app installation operations:** Run the command `docker compose proprli-app up`.
- **Install dependencies:** Run the command `docker exec proprli-app composer install`.
- **Run migrations to create the tables:** Run the command `docker exec proprli-app php artisan migrate`.
- **Populate the database:** Run the command `docker exec proprli-app php artisan db:seed`.
- **Stop the current container:** Run the command `docker compose down`.
- **Start all containers:** Run the command `docker compose up`.

### Additional Commands

- **Bash:** Open the container's terminal with `make bash`.
- **Down:** Stop all Docker containers with `make down`.
- **Tests:** Run the automatic tests with `make test`.
- **Seed:** Run the seeders independently with `make seed`.
