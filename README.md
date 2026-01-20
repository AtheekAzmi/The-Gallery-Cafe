# The Gallery Café

A PHP/MySQL restaurant website for The Gallery Café — menu browsing, reservations, events and bookings, shopping cart, checkout, admin dashboard and order management.

<img src="images/logo.png" alt="The Gallery Café logo">

---

Table of Contents
- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Quick Start (Local Development)](#quick-start-local-development)
  - [1. Clone repository](#1-clone-repository)
  - [2. Create and import database](#2-create-and-import-database)
  - [3. Configure database connection](#3-configure-database-connection)
  - [4. Run the app locally](#4-run-the-app-locally)
- [Important Files & Structure](#important-files--structure)
- [Admin & User Workflows](#admin--user-workflows)
- [Deployment (CI) Notes](#deployment-ci-notes)
- [Security Hardening Checklist](#security-hardening-checklist)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

---

## About

The Gallery Café is a small restaurant website built with plain PHP and MySQL (mysqli). It includes:

- Public pages and homepage (index.php)
- Menu and product management
- User sign-up / login
- Cart and checkout flow with order details and order_items
- Reservation system and event listing with ticket booking
- Admin dashboard for managing products, orders, reservations, users and events
- Static assets (CSS/JS/images) included in the repo

This README helps you set up and run the project locally, configure the database, and prepare for deployment.

---

## Features

- User authentication (signup & login)
- Product menu, cart, and checkout (orders + order_items)
- Table reservations and reservation management
- Events listing, ticket availability and booking
- Admin dashboard (add/edit/delete products, manage orders, bookings, reservations, users, events)
- File upload for product/event images (uploadedimage/)
- Example GitHub Actions workflow for deploying to AWS ECS/ECR (.github/workflows/aws.yml)

---

## Requirements

- PHP 7.4+ (or newer)
- MySQL / MariaDB
- Web server (Apache / Nginx) or PHP built-in server for development
- Git (to clone repo)
- Optional: Docker & AWS account (if using the included GitHub Actions AWS workflow)

---

## Quick Start (Local Development)

These steps get the app running on your machine.

### 1. Clone repository
```bash
git clone https://github.com/AtheekAzmi/The-Gallery-Cafe.git
cd The-Gallery-Cafe
```

### 2. Create and import database

1. Create a new MySQL database (example name: gallery_cafe)
```sql
CREATE DATABASE gallery_cafe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Import schema and recommended changes:
- The project includes SQL snippets in `SQL.txt`. You can import them using the MySQL CLI or a GUI tool.

From shell (assuming SQL.txt is compatible and your mysql user has access):
```bash
# replace DB_USER and DB_PASSWORD with your credentials
mysql -u DB_USER -p gallery_cafe < SQL.txt
```

If you prefer manually, open `SQL.txt` and run the CREATE/ALTER TABLE statements inside your MySQL client. The important tables referenced by the app include:
- `user_table` (users)
- `products` (menu items)
- `cart` (temporary cart storage)
- `orders` and `order_items` (order storage)
- `reservations`
- `events` and `bookings`

Note: If `SQL.txt` doesn't contain every table used by the app (some projects include additional tables created elsewhere), create the missing tables as needed by reading relevant PHP files (e.g., `signup.php`, `admin.php`, `cart.php`).

### 3. Configure database connection

The app uses `config.php` for the DB connection. Edit that file with your database credentials.

Open `config.php` and replace placeholders:
```php
<?php
// config.php - update these values
$conn = mysqli_connect('localhost', 'db_user', 'db_password', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

Security note: it is recommended to use environment variables instead of hardcoding credentials. For example create a small wrapper:

```php
// config.php (recommended)
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'gallery_cafe';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
```

Then set environment variables in your shell or web server.

### 4. Run the app locally

Option A — PHP built-in server (for development)
```bash
# from project root
php -S localhost:8000
# then open http://localhost:8000/index.php
```

Option B — Apache or Nginx
- Place the project in your web root (e.g., /var/www/html/gallery_cafe)
- Ensure file permissions let the web server read/write `uploadedimage/` for uploads
- Configure virtual host as needed and restart webserver

---

## Important Files & Structure

A short map of the most relevant files:

- index.php — Homepage and primary entry point
- style.css, events.css, checkout.css, etc. — Frontend styling
- script.js, events.js — Frontend JS behavior
- config.php — Database connection (update with your credentials)
- SQL.txt — SQL snippets / schema to create/alter required tables
- login.php, signup.php — User authentication
- admin.php, manage_events.php — Admin pages and controls
- events.php, add_event.php, edit_event.php, delete_event.php — Events & bookings
- cart.php, checkout.php, order_success.php — Cart & checkout flow
- uploadedimage/ — Image upload storage
- .github/workflows/aws.yml — Example CI workflow for deploying to AWS ECS/ECR

If you want a full list of files, explore the repo or run:
```bash
ls -la
```

---

## Admin & User Workflows

Admin:
- Visit `admin.php` (requires admin session — see login-admin.php).
- Use the dashboard to add products (images and categories), manage orders and events.
- `manage_events.php` lists events, and you can add/edit/delete events with `add_event.php` / `edit_event.php` / `delete_event.php`.

Users:
- New users can register via `signup.php`.
- Login via `login.php` (creates a session and redirects).
- Browse menu, add items to cart (`cart.php`), and checkout via `checkout.php`.
- Reserve a table via `reserve.php`, and book event tickets from `events.php`.

Creating an admin account:
- The repository includes `signup-staff.php` and `login-admin.php`—use these pages if they are set up in your DB.
- Alternatively create an admin row directly in the DB in your users table (the column names vary by project). Check `user_table` structure and `login-admin.php` for which fields are required.

---

## Deployment (CI) Notes

This repo includes an example GitHub Actions workflow: `.github/workflows/aws.yml`. It demonstrates how to:

- Build and push a Docker image to Amazon ECR
- Render and deploy a new ECS task definition
- Deploy to ECS service/cluster

Before using the workflow, you must:
- Set env variables inside the workflow (AWS_REGION, ECR_REPOSITORY, ECS_SERVICE, ECS_CLUSTER, ECS_TASK_DEFINITION, CONTAINER_NAME) or modify the workflow to use repository secrets / environment secrets.
- Add AWS credentials to your repository secrets: `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY`.
- Provide an ECS task definition JSON in the repo (path referenced by ECS_TASK_DEFINITION).

If you don't use AWS/ECS, remove or ignore the workflow.

---

## Security Hardening Checklist (recommended)

The current codebase includes helpful features but needs security improvements before production:

- Passwords:
  - Use password_hash() for storing passwords.
  - Use password_verify() when checking login credentials.
- SQL Injection:
  - Prefer prepared statements (parameterized queries) everywhere — many files use raw interpolated SQL.
- Sessions:
  - Regenerate session IDs on login.
  - Use secure, HTTP-only cookies (session.cookie_secure, session.cookie_httponly).
- File Uploads:
  - Validate uploaded image MIME types.
  - Limit file size and sanitize filenames.
  - Store uploaded files outside webroot if possible or serve via a proxy.
- CSRF:
  - Add CSRF tokens in forms that change state (forms that add/edit/delete).
- Input Validation:
  - Validate and sanitize all user inputs (server-side) — especially numeric ids, file names, email formats, and dates/times.
- Error Handling:
  - Do not display raw SQL or system errors in production — log them instead.

---

## Troubleshooting

- "Connection failed" from config.php:
  - Verify host, username, password and DB name.
  - Try connecting with the mysql CLI to confirm credentials.
- Blank pages or PHP errors:
  - Enable development error reporting (only locally):
    ```php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    ```
- File uploads not working:
  - Ensure `uploadedimage/` directory exists and is writable by the webserver (e.g., `chmod 775 uploadedimage` or chown to www-data).
- Missing tables:
  - Review `SQL.txt` and import the SQL manually.
  - Check PHP files for the expected table names (e.g., `user_table`, `products`, `cart`, `orders`, `order_items`, `events`, `bookings`, `reservations`).
- Payment processing:
  - The checkout form includes a payment method field but no gateway integration. Add your preferred payment gateway (Stripe, PayPal, etc.) if you need real payments.

---

## Contributing

Contributions are welcome!

Suggested workflow:
1. Fork the repository.
2. Create a new branch: `git checkout -b feature/my-feature`.
3. Make changes and add tests where appropriate.
4. Commit and push your branch.
5. Open a Pull Request describing the changes, why they’re needed, and any setup steps.

Please:
- Follow secure coding practices listed above.
- Add a clear description and steps to reproduce for any bug fix PRs.
- Include screenshots or demo steps for UI changes.

---

## License

This repository currently has no LICENSE file. If you plan to open-source it, please add a license (e.g., MIT, Apache 2.0) to clarify usage and contribution terms.

---

If you want, I can:
- Generate a secure config template (.env.example) and a sample shell script to import the SQL automatically.
- Create a checklist of code-level tasks (convert auth to password_hash, convert SQL queries to prepared statements).
- Draft a minimal Dockerfile to build a container for local testing.

Thank you — enjoy developing The Gallery Café!
