# CampusFix – Campus Maintenance & IT Support System

CampusFix is a beginner-friendly PHP and MySQL web application. Students and staff can submit campus service requests. The requests are saved in MySQL, and an administrator can review them and update their status.

## Features

- Responsive request form
- PHP server-side validation
- MySQL database storage using PDO prepared statements
- Submission confirmation and request reference number
- Administrator account setup and login
- Admin dashboard to view all requests
- Update request status: Pending, In Progress, or Completed
- CSRF tokens on forms and HTML output escaping

## Technologies

- PHP 8 or later
- MySQL / MariaDB
- HTML5 and CSS3
- XAMPP
- Git and GitHub

## Requirements

Install XAMPP with Apache, PHP, and MySQL (MariaDB). A modern browser is also required.

## Setup with XAMPP

1. Download and install XAMPP.
2. Copy the complete `CampusFix` folder into the XAMPP `htdocs` directory. Usually this is `C:\xampp\htdocs\CampusFix`.
3. Open the XAMPP Control Panel and start **Apache** and **MySQL**.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`.
5. Select the **Import** tab, choose `database/campusfix.sql`, and click **Import** (or open the SQL tab, paste the file contents, and run it).
6. Check `config.php`. The default XAMPP settings are host `localhost`, database `campusfix`, user `root`, and an empty password. If your MySQL account uses a password, enter it as `DB_PASS`. If you downloaded the project from GitHub and `config.php` is missing, copy `config.example.php` and rename the copy to `config.php`.
7. Visit `http://localhost/CampusFix/` to use the request form.
8. Visit `http://localhost/CampusFix/admin/setup.php` to create the first administrator. Use a username of at least 4 characters and a password of at least 10 characters.
9. **Important:** After the admin account is created, delete `admin/setup.php` from the project folder.
10. Visit `http://localhost/CampusFix/admin/login.php` and log in. Open the dashboard to view requests and change their statuses.

## How the form works

The form in `index.php` sends a POST request to `submit.php`. The PHP file:

1. Checks that the request uses POST and verifies the CSRF token.
2. Reads and validates the submitted name, email, location, category, priority, and description.
3. Uses a PDO prepared `INSERT` statement to save the values in the `requests` table.
4. Stores the new database ID in the session and redirects to `success.php`.

The administrator dashboard uses a `SELECT` query to display requests. The status update form sends the request ID and new status to `admin/update-status.php`, which validates the values and runs a prepared `UPDATE` statement.

## Database design

### `requests`

| Column | Purpose |
|---|---|
| id | Unique auto-increment request ID |
| full_name | Person submitting the request |
| email | Contact email |
| location | Building and room |
| category | Type of issue |
| priority | Low, Normal, or High |
| description | Details of the issue |
| status | Pending, In Progress, or Completed |
| created_at | Date and time submitted |

### `admins`

| Column | Purpose |
|---|---|
| id | Unique administrator ID |
| username | Unique login name |
| password_hash | Secure password hash |
| created_at | Account creation time |

Passwords are stored using PHP's `password_hash()` function and checked using `password_verify()`. They are never stored as plain text.

## Testing checklist

- [ ] Home page opens in the browser.
- [ ] Submit a request with valid information.
- [ ] See the success page and request number.
- [ ] Open phpMyAdmin, select `campusfix`, and inspect the `requests` table.
- [ ] Confirm the submitted information appears in the table.
- [ ] Log in to the admin dashboard.
- [ ] Change a request from Pending to In Progress.
- [ ] Refresh the dashboard and confirm the status remains updated.
- [ ] Try submitting an invalid email and confirm it is rejected.

## Security notes

This project uses prepared statements, server-side validation, output escaping, password hashing, session regeneration at login, and CSRF tokens. For a public production deployment, add HTTPS, secure cookie settings, login rate limiting, stronger role/access controls, and environment-based secret configuration. Do not publish real database passwords or administrator credentials to GitHub.

## GitHub submission

Create a GitHub repository named `CampusFix`. Upload the project files and folders, including this README and the SQL file. The `.gitignore` file excludes `config.php`; keep it excluded because it may contain local database credentials. Include `config.example.php` so another person can copy it to `config.php` and add their own settings. Your instructor can follow the XAMPP setup instructions above to run the project locally.

## Author

Student project – PHP and MySQL database assignment.
