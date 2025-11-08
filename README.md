# BATCH 42 CU

This is a foundational Laravel web application developed by ForkByte, intended as a base layout for future projects. It features a complete user authentication system, role-based access control, and a secure admin panel with pre-built UI and configurations.

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Key Features

- **Authentication:** Standard user login and registration.
- **Role-Based Access Control:** Differentiates between a regular `user` and a powerful `admin`.
- **Admin Panel:** A secure area for site administration with features like:
  - User Management
  - Role & Permission Management
  - Product, Category, and Order Management
- **Security Hardening:** The primary `admin` user and `admin` role are protected and cannot be modified or deleted from the panel.

---

## Installation & Setup

### Prerequisites
Before you begin, ensure you have the following installed on your local development machine:
- **PHP** (>= 8.2)
- **Composer**
- **Node.js** & **npm**
- **A database server** (e.g., MySQL, MariaDB)

### 1. Clone the Repository
```bash
git clone https://github.com/suranjitpartho/batch42-cu.git
cd batch42-cu
```

### 2. Configure Environment
First, copy the example environment file.
```bash
cp .env.example .env
```
Open the newly created `.env` file and configure your local environment details, especially the database credentials and admin user details.

```env
APP_NAME="You_App_Name"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

ADMIN_EMAIL=admin@email.com
ADMIN_NAME=Admin
ADMIN_PASSWORD=#####
```

### 3. Install Dependencies
Install the required PHP and JavaScript packages.

```bash
composer install
npm install
```

### 4. Set Up Application
Generate a unique application key, run the database migrations and seeders, and create the symbolic link for file storage.

```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### Running Specific Seeders (Post-Installation)

The `php artisan migrate --seed` command is for the initial setup. If you later modify the seeders that define content pages or permissions, you can run them individually without affecting the rest of the database.

-   **To update or add predefined content pages:**
    If you have modified the `ContentPageSeeder.php` file, run:
    ```bash
    php artisan db:seed --class=ContentPageSeeder
    ```

-   **To update roles and permissions:**
    If you have modified the `RolesAndPermissionsSeeder.php` file, run:
    ```bash
    php artisan db:seed --class=RolesAndPermissionsSeeder
    ```

### 5. Build Frontend Assets
Compile the frontend assets for the application.

```bash
npm run build
```

### 6. Run the Development Servers
For local development, you need to run two processes in separate terminal windows:

**Terminal 1: Start the PHP Server**
```bash
php artisan serve
```

**Terminal 2: Start the Vite Frontend Server**
```bash
npm run dev
```

### 7. Access the Application
Your application is now running and accessible at **http://localhost:8000**.

---

## Default Accounts

After seeding the database, the following accounts will be available:

- **Administrator:**
  - **Email:** (The `ADMIN_EMAIL` you set in your `.env` file)
  - **Password:** (The `ADMIN_PASSWORD` you set in your `.env` file)

- **Regular User:**
  - **Email:** `user@gmail.com`
  - **Password:** `password`

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).