# crm
This CRM (Customer Relationship Management) system is a web-based application designed to help business to manage customers and staffs made with php,msql,tailwindcss

## Features
- User login and authentication
- Customer data management
- Responsive design
- Basic CRUD operations for customer records

## Prerequisites

- XAMPP installed on your machine.
- PHP version 7.4+ (Included with XAMPP).
- MySQL (Included with XAMPP).

## Installation

Follow these steps to get the CRM system running on your local environment.

### 1. Clone the repository
```bash
git clone https://github.com/yourusername/crm-system.git
```

2. Move the project to XAMPP directory

    After cloning, move the project folder to the htdocs directory in your XAMPP installation. For example:
        C:\xampp\htdocs\crm

3. Import the Database

    Open phpMyAdmin via your browser: http://localhost/phpmyadmin
    Create a new database (e.g., crm_db).
    Import the SQL file (crm_db.sql) from the database folder of the project into the created database.

4. Update Database Configuration

    Open the config.php file located in the root directory of the project.
    Update the database connection details as needed:

```php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_db_username');
define('DB_PASSWORD', 'your_db_password');
define('DB_NAME', 'crm_db');
```
5. Start the Server

    Start the Apache and MySQL services using the XAMPP control panel.

6. Access the CRM System

    Open your browser and navigate to http://localhost/crm-system.
    You will be presented with a login screen. Use the credentials defined in the users table of the database.

Usage

    Login: Once the database and system are set up, log in using the default credentials:
        Username: admin
        Password: admin123

    Managing Customers: After logging in, you can add, update, delete, and view customer data.

Troubleshooting

    Ensure that Apache and MySQL are running in the XAMPP control panel.
    Check that your database credentials in config.php are correct.
    If you encounter issues with database import, verify that the SQL file matches the structure required.