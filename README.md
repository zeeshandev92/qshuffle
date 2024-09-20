
# Limitless with Laravel.

This repository contains limitless theme integrated with laravel and contains basic setup authentication and authorization with packages laravel roles and permission.

## Requirements

- PHP >= 8.0
- Laravel >= 9.0
- Composer

## Installation

1. Clone the repository:

```bash
git clone https://github.com/zee-web-dev/limitless-laravel.git
```

2. Navigate to the project directory:

```bash
cd limitless-laravel
```

3. Install the dependencies using Composer:

```bash
composer install
```

4. Create a copy of the `.env.example` file and rename it to `.env`:

```bash
cp .env.example .env
```

5. Generate a new application key:

```bash
php artisan key:generate
```

6. Configure your database connection in the `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run the database migrations:

```bash
php artisan migrate --seed
```

8. Start the development server:

```bash
php artisan serve
```

The theme is now up and running at `http://localhost:8000`.
