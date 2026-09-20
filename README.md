# 📝 Postify — PHP Blog & Content Management System

A full-stack blog and content management system built with **Native PHP, MySQL, PDO, HTML & CSS**.

Postify is a practical PHP project designed to demonstrate the fundamentals of backend web development, database management, authentication, CRUD operations, sessions, and server-side rendering.

---

## 🚀 Features

### 🌐 Public Website

* Modern blog homepage
* Display published posts
* Category-based post filtering
* Single post detail page
* Dynamic content loaded from MySQL
* Server-side rendering with PHP

### 🔐 Authentication

* User registration
* User login
* Session-based authentication
* Secure password hashing with `password_hash()`
* Password verification with `password_verify()`
* Duplicate email detection
* Password confirmation validation

### 🛠️ Admin Panel

* Dashboard
* Post management
* Create posts
* Edit posts
* Delete posts
* Change post status
* Category management
* Create categories
* Edit categories
* Delete categories
* Authentication-protected administration area

### 🗄️ Database

* MySQL database
* PDO database connection
* Prepared statements
* Dynamic relationships between posts and categories
* Exception-based database error handling

---

## 🧰 Tech Stack

| Technology | Usage                         |
| ---------- | ----------------------------- |
| PHP        | Backend & server-side logic   |
| MySQL      | Database                      |
| PDO        | Database communication        |
| HTML5      | Page structure                |
| CSS3       | Styling                       |
| Sessions   | Authentication                |
| Apache     | Local web server              |
| XAMPP      | Local development environment |

---

## 📁 Project Structure

```text
project-weblog/
│
├── admin/
│   ├── category/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── post/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   └── change-status.php
│   │
│   └── layouts/
│       ├── nav-top.php
│       └── sidbar.php
│
├── auth/
│   ├── login.php
│   └── register.php
│
├── functions/
│   └── pdo_connection.php
│
├── category.php
├── detail.php
├── index.php
└── README.md
```

---

# ⚙️ Installation & Setup

## 1. Install XAMPP

Download and install XAMPP with:

* Apache
* MySQL
* PHP
* phpMyAdmin

Then start:

```text
Apache
MySQL
```

---

## 2. Clone the Repository

```bash
git clone https://github.com/yosuf-dev/project-weblog.git
```

Move the project into:

```text
C:\xampp\htdocs\
```

The final path should look like:

```text
C:\xampp\htdocs\project-weblog
```

---

## 3. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
php_project
```

The project uses tables for:

```text
users
posts
categories
```

> Make sure your database structure matches the SQL schema required by the project.

---

## 4. Configure Database Connection

The database connection is located at:

```text
functions/pdo_connection.php
```

Default local configuration:

```text
Host: localhost
Database: php_project
Username: root
Password: empty
```

For example:

```php
$host = 'localhost';
$dbname = 'php_project';
$username = 'root';
$password = '';
```

> ⚠️ These credentials are intended for local XAMPP development only. Never use default `root` credentials in a production environment.

---

# ▶️ Running the Project

After starting Apache and MySQL, open:

### Public Website

```text
http://localhost/project-weblog/
```

### Login

```text
http://localhost/project-weblog/auth/login.php
```

### Register

```text
http://localhost/project-weblog/auth/register.php
```

### Admin Panel

```text
http://localhost/project-weblog/admin/
```

---

# 🔄 Application Flow

```text
                 ┌─────────────────┐
                 │     Browser     │
                 └────────┬────────┘
                          │
                          ▼
                 ┌─────────────────┐
                 │   PHP Website   │
                 └────────┬────────┘
                          │
                 ┌────────▼────────┐
                 │       PDO       │
                 └────────┬────────┘
                          │
                          ▼
                 ┌─────────────────┐
                 │      MySQL      │
                 │   php_project   │
                 └─────────────────┘
```

---

# 🧩 Main Modules

## Public Website

The public section allows visitors to:

* View blog posts
* Browse categories
* Open individual posts
* Read published content

The homepage retrieves published posts directly from the MySQL database.

---

## Authentication

The authentication system provides:

```text
Register
   ↓
Password Hashing
   ↓
Login
   ↓
password_verify()
   ↓
Session
   ↓
Admin Access
```

Passwords are not stored as plain text.

The project uses PHP's built-in password hashing functions:

```php
password_hash()
```

and:

```php
password_verify()
```

---

## Admin Panel

The admin panel provides CRUD functionality for:

### Posts

```text
Create
Read
Update
Delete
Change Status
```

### Categories

```text
Create
Read
Update
Delete
```

This makes the project a practical example of a basic **Content Management System (CMS)**.

---

# 🗃️ Database

The main database is:

```text
php_project
```

Main entities include:

```text
users
categories
posts
```

Conceptually:

```text
users
  │
  └── Authentication

categories
  │
  └── posts
        │
        └── Blog Content
```

Posts are associated with categories so that content can be organized and filtered dynamically.

---

# 🔒 Security Concepts

This project demonstrates several important backend security concepts.

### Password Hashing

Passwords should never be stored directly.

```php
password_hash($password, PASSWORD_DEFAULT);
```

### Password Verification

```php
password_verify($password, $hashedPassword);
```

### Prepared Statements

PDO prepared statements should be used when working with user input:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE email = ?"
);

$stmt->execute([$email]);
```

This helps reduce SQL injection risks.

---

# ⚠️ Production Security Improvements

This project is primarily intended for learning and local development.

Before deploying a real production application, additional security measures should be implemented, including:

* CSRF protection
* Strong authorization checks
* Secure session configuration
* Input validation
* Output escaping
* Secure file upload validation
* Environment variables for credentials
* Better error handling
* HTTPS
* Rate limiting
* Account protection
* Database user with limited privileges

---

# 📚 What I Learned

This project helped practice important PHP backend concepts:

* PHP fundamentals
* MySQL
* PDO
* SQL queries
* CRUD
* Authentication
* Sessions
* Password hashing
* Form handling
* Server-side rendering
* Database relationships
* Admin panel architecture
* Backend project structure

It is also a practical foundation for moving toward more advanced PHP development and frameworks such as Laravel.

---

# 📈 Future Improvements

Possible future improvements include:

* [ ] CSRF protection
* [ ] Role-based authorization
* [ ] Better admin dashboard
* [ ] Image upload system
* [ ] Post editor
* [ ] Pagination
* [ ] Search system
* [ ] User profile management
* [ ] Comments
* [ ] Tags
* [ ] REST API
* [ ] Laravel version
* [ ] Responsive UI improvements
* [ ] Production deployment

---

# 🎯 Project Status

**Status:** 🟢 Active Learning Project

This project was created as part of my journey into **PHP backend and full-stack web development**.

The goal is to understand how a real-world PHP application communicates with a database and handles authentication, content management, and dynamic pages.

---

# 👨‍💻 Author

## Yosuf Saleh Zadeh

**Full-Stack Developer**

GitHub:

https://github.com/yosuf-dev

Project:

https://github.com/yosuf-dev/project-weblog

---

# ⭐ Support

If you find this project useful or interesting, consider giving the repository a ⭐ on GitHub.

---

## 📄 License

This project is available for educational and personal learning purposes.
