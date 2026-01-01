# Fixing Database Connection Issue

## Problem
MySQL access denied error: `Access denied for user 'root'@'localhost' (using password: YES)`

## Current Configuration
- Host: 127.0.0.1
- Port: 3306
- Database: rating_system
- Username: root
- Password: root (incorrect)

## Solutions

### Solution 1: Use Empty Password (XAMPP/WAMP Default)
If you're using XAMPP or WAMP, the default MySQL root password is usually empty.

Update your `.env` file:
```
DB_PASSWORD=
```

### Solution 2: Use Correct Root Password
If you know your MySQL root password, update `.env`:
```
DB_PASSWORD=your_actual_password
```

### Solution 3: Create a New MySQL User (Recommended)
1. Access MySQL (using phpMyAdmin, MySQL Workbench, or command line)
2. Run these SQL commands:
```sql
CREATE DATABASE IF NOT EXISTS rating_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON rating_system.* TO 'laravel_user'@'localhost';
FLUSH PRIVILEGES;
```

3. Update your `.env` file:
```
DB_USERNAME=laravel_user
DB_PASSWORD=your_secure_password
```

### Solution 4: Reset MySQL Root Password
If you've forgotten your root password:

**For XAMPP:**
- Open XAMPP Control Panel
- Stop MySQL
- Open `mysql\bin\my.ini` or `mysql\bin\my.cnf`
- Add this line under `[mysqld]`:
  ```
  skip-grant-tables
  ```
- Start MySQL
- Access MySQL and reset password:
  ```sql
  USE mysql;
  UPDATE user SET authentication_string=PASSWORD('newpassword') WHERE User='root';
  FLUSH PRIVILEGES;
  ```
- Remove `skip-grant-tables` from config
- Restart MySQL

**For Standalone MySQL:**
- Follow MySQL official documentation for password reset

## After Fixing Credentials

1. Test the connection:
   ```bash
   php test_db_connection.php
   ```

2. Run migrations:
   ```bash
   php artisan migrate
   ```

3. (Optional) Seed the database:
   ```bash
   php artisan db:seed
   ```

## Quick Test
Run the test script to verify your connection:
```bash
php test_db_connection.php
```






