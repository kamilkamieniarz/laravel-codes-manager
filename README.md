# Numerical Code Management System

A professional web application built with **Laravel 11**, designed for generating, storing, and securely managing unique 10-digit identification codes.

## Key Features

* **Authentication & Security**: Robust login and registration system powered by **Laravel Breeze** with enforced strong password policies (requires special characters, numbers, and mixed case).
* **Secure Code Generation**: Generation of unique 10-digit sequences using the cryptographically secure `random_int()` function.
* **Data Isolation**: Strict ownership model (**One-to-Many** relationship). Users can only access and manage their own generated data, ensuring privacy and security.
* **Advanced Data Table**: Interactive list featuring **Dynamic Sorting** (ID, Code, Date) and optimized **Bootstrap 5 Pagination** (available at both top and bottom of the list).
* **Bulk Operations**: Atomic "all-or-nothing" deletion system implemented with **Database Transactions** to ensure data integrity.
* **Performance Optimization**: Efficient database interaction using **Eager Loading** to eliminate **N+1 query** problems.

## Tech Stack & Standards

* **Backend**: **PHP 8.4** / **Laravel 12** (MVC Architecture, Service Layer Pattern).
* **Frontend**: **Bootstrap 5** with custom styles, **Inter** typography, and semantic **HTML5** for accessibility (`aria-labels`, `autocomplete`).
* **Database**: Relational DB (**MySQL/PostgreSQL**) with strict **UNIQUE** constraints and foreign keys with cascading deletes (`onDelete cascade`).
* **Validation**: Multi-layer validation – from frontend (**HTML5**) to rigorous server-side validation using **Regular Expressions (Regex)**.

## Installation & Setup

1. **Clone the repository**:
```bash
git clone [https://github.com/kamilkamieniarz/laravel-codes-manager.git](https://github.com/kamilkamieniarz/laravel-codes-manager.git)
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Install and build frontend assets:**
```bash
npm install && npm run build
```

4. **Environment Configuration:**
```bash
cp .env.example .env
php artisan key:generate
(Note: Set your database credentials in the .env file)
```

5. **Run Migrations & Seeding:**
```bash
php artisan migrate:fresh --seed
```

6. **Start the local development server:**
```bash
php artisan serve
(Note: The application will be accessible at localhost:8000)
```

Recruitment Testing Data
A test account is available for immediate review:

Login: recruiter@example.com

Password: recruiter123

The test account comes pre-loaded with 20 codes to instantly demonstrate pagination, dynamic sorting, and data table responsiveness.