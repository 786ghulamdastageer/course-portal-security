# Course Portal — Web Security Project

A full-stack web application for **Information Security (CS3002) — Assignment 2, Part 2**, demonstrating common web vulnerabilities and their security fixes.

## 1. Project Overview

The project contains two versions of a Course Portal:

- **Vulnerable Version:** Demonstrates common web attacks.
- **Safe Version:** Implements security defenses against these attacks.

### Core Features

- User login and authentication
- Course search
- Comment posting
- Password change
- Security testing and comparison

## 2. Technology Stack

- **Backend:** PHP 8.0
- **Database:** MySQL 8.0
- **Frontend:** HTML5, CSS3, JavaScript
- **Web Server:** Apache 2.4
- **Environment:** Ubuntu 20.04 (SEED Lab VM)

## 3. Project Structure

```text
course_portal/
├── vulnerable/
│   ├── config.php
│   ├── index.php
│   ├── dashboard.php
│   ├── course.php
│   ├── change_password.php
│   ├── dom_xss.php
│   └── logout.php
├── safe/
│   ├── config.php
│   ├── index.php
│   ├── dashboard.php
│   ├── course.php
│   ├── change_password.php
│   ├── dom_xss.php
│   └── logout.php
├── attack/
│   ├── csrf.html
│   └── csrf_safe.html
├── db.sql
└── README.md
```

## 4. Installation and Setup

Run the following commands inside the Ubuntu VM.

### Step 1: Install Dependencies

Install Apache, MySQL, PHP, and the PHP-MySQL connector.

```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysql libapache2-mod-php -y
```

Start the services:

```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

### Step 2: Set Up the Project

Place the `course_portal` directory inside Apache's web root:

```text
/var/www/html/course_portal/
```

Ensure the project files and folders are in the correct locations.

### Step 3: Import the Database

Navigate to the directory containing `db.sql` and run:

```bash
sudo mysql < db.sql
sudo mysql -e "USE course_portal; SHOW TABLES;"
```

The database contains the following tables:

- `users`
- `courses`
- `comments`

### Step 4: Configure Database Access

Open the MySQL shell:

```bash
sudo mysql
```

Create a database user for the application:

```sql
CREATE USER 'webuser'@'localhost' IDENTIFIED BY 'webpass123';
GRANT ALL PRIVILEGES ON course_portal.* TO 'webuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Update the database connection settings in both `vulnerable/config.php` and `safe/config.php` to use the same credentials.

### Step 5: Set Permissions

```bash
sudo chown -R www-data:www-data /var/www/html/course_portal
sudo chmod -R 755 /var/www/html/course_portal
```

### Step 6: Run the Application

Open the following URLs in the Ubuntu VM browser:

- **Vulnerable Version:** http://localhost/course_portal/vulnerable/index.php
- **Safe Version:** http://localhost/course_portal/safe/index.php

### Test Accounts

| Username | Password |
|---|---|
| admin | admin123 |
| alice | alice123 |
| bob | bob123 |

These credentials are for local lab testing only.

## 5. Vulnerabilities Demonstrated

| No. | Vulnerability | Vulnerable Version | Safe Version |
|---|---|---|---|
| 1 | SQL Injection — Login Bypass | Authentication bypass | Prepared statements |
| 2 | SQL Injection — UNION-Based | Unauthorized data extraction | Parameterized queries |
| 3 | SQL Injection — Advanced | Database schema and data exposure | Parameterized queries |
| 4 | Reflected XSS | Executes injected scripts | HTML output encoding |
| 5 | Stored XSS | Executes scripts saved in comments | HTML output encoding |
| 6 | DOM-Based XSS | Unsafe DOM manipulation | `textContent` |
| 7 | CSRF | Unauthorized password change | CSRF token validation |

## 6. Security Fixes

- **SQL Injection:** Prepared statements keep SQL commands separate from user input.
- **Reflected XSS:** HTML output encoding prevents injected input from being interpreted as HTML.
- **Stored XSS:** Usernames and comments are encoded before being displayed.
- **DOM-Based XSS:** `textContent` treats untrusted input as text instead of HTML.
- **CSRF:** Session-based tokens are validated before password changes are processed.

## 7. Testing and Expected Results

Test each vulnerability in the isolated lab environment using both application versions.

- **SQL Injection:** The vulnerable version may allow authentication bypass or unauthorized data access. The safe version should block these attacks.
- **Reflected XSS:** The vulnerable version may execute injected scripts, while the safe version displays the input as text.
- **Stored XSS:** The vulnerable version may execute scripts stored in comments, while the safe version displays comments without executing them.
- **DOM-Based XSS:** The vulnerable version may execute malicious URL-derived content, while the safe version treats it as text.
- **CSRF:** The vulnerable version may accept forged password-change requests, while the safe version rejects requests with missing or invalid tokens.

## 8. Useful Commands

Check service status:

```bash
sudo systemctl status apache2
sudo systemctl status mysql
```

Restart Apache:

```bash
sudo systemctl restart apache2
```

Check the PHP version:

```bash
php -v
```

View Apache error logs:

```bash
sudo tail -f /var/log/apache2/error.log
```

Check database tables:

```bash
sudo mysql -e "USE course_portal; SHOW TABLES;"
```

## 9. Conclusion

This project demonstrates common web security vulnerabilities and practical techniques for preventing them. Comparing vulnerable and safe implementations highlights the importance of prepared statements, output encoding, safe DOM manipulation, and CSRF protection.

**Note:** This project is intended for educational testing in an authorized lab environment. Use strong credentials and appropriate access controls in real deployments.
