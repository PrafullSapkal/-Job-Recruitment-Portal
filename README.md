# Job Recruitment Portal (PHP + MySQL)

A starter academic project for a job recruitment portal using PHP, MySQL, HTML, CSS, and XAMPP.

## Features
- User registration and login
- Browse available vacancies
- Apply for a vacancy
- View submitted applications and their status
- Admin login and basic vacancy management
- MySQL database schema included

## Setup in XAMPP
1. Extract this folder into `C:\xampp\htdocs\`.
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. Check database credentials in `config.php` (default XAMPP values: user `root`, empty password).
6. Open `http://localhost/Job_Recruitment_Portal/`.

## Admin account
Create an admin by registering a normal account, then run this SQL in phpMyAdmin:

```sql
UPDATE users SET role='admin' WHERE email='your-email@example.com';
```

Replace the email with the account you registered. Sign in again and open the Admin link.

## Notes
- This is a learning/starter project. Before deploying publicly, add stronger validation, CSRF protection, rate limiting, secure file upload handling, and production database credentials.
- Do not upload real passwords, `.env` files, or private user data to a public repository.
