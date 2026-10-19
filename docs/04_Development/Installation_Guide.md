# Installation Guide
## Smart School Management System (Smart SMS)

Follow these steps to set up the project on a local computer.

## 1. Prerequisites
Ensure you have installed: PHP 8.5, Composer, Node.js, MySQL, and DBeaver.

## 2. Backend Setup (Laravel)
```bash
cd Backend
composer install
cp .env.example .env
php artisan key:generate
```
Update the `.env` file with your database details:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_school_db
DB_USERNAME=ligemir
DB_PASSWORD=Ligemir@2026
```
Run the database tables and start the server:
```bash
php artisan migrate
php artisan serve
```

## 3. Frontend Setup (Vue.js)
Open a new terminal tab:
```bash
cd frontend
npm install
npm run dev
```