# Codes Manager Application

A Laravel-based application for generating, listing, and managing unique 10-digit numeric codes.

## Features

- **List Codes**: Display all generated codes with pagination.
- **Generate Codes**: Create batch of unique, random 10-digit codes (1-10 at a time).
- **Delete Codes**: Bulk deletion of codes with strict validation (all-or-nothing logic).

## Technical Requirements

- PHP 8.3
- Laravel 11.x
- MySQL
- Bootstrap 5

## Installation

1. Clone the repository.
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the configuration file:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Configure your database connection in `.env` file (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
6. Run database migrations:
   ```bash
   php artisan migrate
   ```

## Usage

Start the local development server:
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.