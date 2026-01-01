# Rating System

A Laravel-based rating system application with user authentication, posts, comments, questions, and ratings functionality.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

-   **PHP** >= 8.0
-   **Composer** (PHP dependency manager)
-   **Node.js** and **npm** (for frontend assets)
-   **XAMPP** (for MySQL database and Apache server)
-   **Git** (for version control)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Anasaljammal/ratingSystem.git
cd ratingSystem
```

### 2. Install PHP Dependencies

```bash
composer update
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the `.env.example` file to `.env` (if it exists) or create a new `.env` file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 5. Database Setup

1. **Start XAMPP**

    - Open XAMPP Control Panel
    - Start **Apache** and **MySQL** services

2. **Create Database**

    - Open phpMyAdmin (usually at `http://localhost/phpmyadmin`)
    - Create a new database (e.g., `rating_system`)

3. **Configure Database in `.env`**

    - Open the `.env` file
    - Update the database configuration:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=rating_system
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4. **Run Migrations**

    ```bash
    php artisan migrate
    ```

5. **Seed the Database**
    ```bash
    php artisan db:seed
    ```

## Running the Application

### 1. Start the Laravel Development Server

Open a terminal and run:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### 2. Start Frontend Asset Compilation

Open another terminal and run:

```bash
npm start
```

This will watch for changes and automatically recompile your assets.

## Complete Setup Commands Summary

Run these commands in order:

```bash
# 1. Install PHP dependencies
composer update

# 2. Install Node.js dependencies
npm install

# 3. Generate application key (if not done already)
php artisan key:generate

# 4. Run database migrations
php artisan migrate

# 5. Seed the database
php artisan db:seed

# 6. Start Laravel server (in one terminal)
php artisan serve

# 7. Start frontend compilation (in another terminal)
npm start
```

**Important:** Make sure XAMPP is running with Apache and MySQL services started before running migrations.

## Project Structure

-   `app/` - Application core files (Controllers, Models, Services)
-   `database/` - Migrations and seeders
-   `public/` - Public assets (CSS, JS, images)
-   `resources/` - Views and frontend source files
-   `routes/` - Application routes

## Technologies Used

-   **Laravel 9** - PHP Framework
-   **MySQL** - Database
-   **Laravel Mix** - Frontend asset compilation
-   **XAMPP** - Local development environment

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
