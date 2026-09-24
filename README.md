<div align="center">

# `</> POSTIFY`

### PHP BLOG · CONTENT MANAGEMENT SYSTEM

**SERVER-SIDE RENDERING · AUTHENTICATION · CRUD · MYSQL · PDO**

<br>

[![PHP](https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge\&logo=php\&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)](https://www.mysql.com/)
[![PDO](https://img.shields.io/badge/PDO-Database%20Layer-8892BF?style=for-the-badge)](https://www.php.net/manual/en/book.pdo.php)
[![Apache](https://img.shields.io/badge/Apache-Server-D22128?style=for-the-badge\&logo=apache\&logoColor=white)](https://httpd.apache.org/)

<br>

[![GitHub](https://img.shields.io/badge/GitHub-Repository-181717?style=flat-square\&logo=github)](https://github.com/yosuf-dev/project-weblog)

</div>

---

# `01` PROJECT

**Postify** is a full-stack blog and content management system built with **Native PHP, MySQL, PDO, HTML5 and CSS3**.

The project focuses on understanding how a server-rendered PHP application works from request to database and back to the browser.

```text
┌─────────────────────────────────────────────────────────────┐
│                         POSTIFY                             │
│                                                             │
│  Public Blog                                               │
│       │                                                     │
│       ├── Posts                                             │
│       ├── Categories                                        │
│       └── Post Details                                      │
│                                                             │
│  Authentication                                             │
│       │                                                     │
│       ├── Register                                          │
│       ├── Login                                             │
│       └── Sessions                                          │
│                                                             │
│  Administration                                             │
│       │                                                     │
│       ├── Posts CRUD                                        │
│       ├── Categories CRUD                                   │
│       └── Post Status                                       │
│                                                             │
│                         ↓                                   │
│                       PDO                                   │
│                         ↓                                   │
│                    MySQL Database                           │
└─────────────────────────────────────────────────────────────┘
```

> A practical backend project focused on PHP fundamentals, database architecture, authentication and content management.

---

# `02` CORE FEATURES

## 🌐 Public Blog

```text
Homepage
   │
   ├── Published Posts
   ├── Categories
   ├── Category Filtering
   └── Post Details
```

* Dynamic blog homepage
* Published post listing
* Category-based filtering
* Individual post pages
* Dynamic MySQL content
* Server-side rendering with PHP

---

## 🔐 Authentication

```text
REGISTER
   ↓
VALIDATION
   ↓
PASSWORD HASH
   ↓
LOGIN
   ↓
PASSWORD VERIFY
   ↓
SESSION
   ↓
AUTHENTICATED ACCESS
```

Implemented concepts:

* User registration
* User login
* Session-based authentication
* Password hashing
* Password verification
* Duplicate email detection
* Password confirmation validation

---

## 🛠️ Admin CMS

```text
                 ADMIN PANEL
                      │
          ┌───────────┴───────────┐
          ↓                       ↓
        POSTS                CATEGORIES
          │                       │
     ┌────┼────┐             ┌────┼────┐
     ↓    ↓    ↓             ↓    ↓    ↓
   CREATE READ UPDATE       CREATE READ UPDATE
     │         │               │         │
     └──── DELETE              └──── DELETE
```

### Post Management

* Create posts
* Read posts
* Edit posts
* Delete posts
* Change publication status

### Category Management

* Create categories
* Read categories
* Edit categories
* Delete categories

---

# `03` BACKEND ARCHITECTURE

Postify follows a simple server-rendered architecture:

```text
┌──────────────┐
│    Browser   │
└──────┬───────┘
       │ HTTP Request
       ▼
┌──────────────┐
│     PHP      │
│ Application  │
└──────┬───────┘
       │
       ├───────────────┐
       ↓               ↓
┌──────────────┐ ┌──────────────┐
│ Application  │ │    Session   │
│    Logic     │ │    State     │
└──────┬───────┘ └──────────────┘
       │
       ↓
┌──────────────┐
│     PDO      │
└──────┬───────┘
       │ SQL
       ▼
┌──────────────┐
│    MySQL     │
│ php_project  │
└──────────────┘
```

The application uses PHP to process requests, PDO to communicate with MySQL, and server-side rendering to generate the final HTML response.

---

# `04` TECHNOLOGY STACK

| Technology   | Role                                    |
| ------------ | --------------------------------------- |
| **PHP**      | Backend & server-side application logic |
| **MySQL**    | Relational database                     |
| **PDO**      | Database communication                  |
| **SQL**      | Data querying & manipulation            |
| **HTML5**    | Server-rendered page structure          |
| **CSS3**     | Interface styling                       |
| **Sessions** | Authentication state                    |
| **Apache**   | Local web server                        |
| **XAMPP**    | Development environment                 |

---

# `05` DATABASE ARCHITECTURE

The application uses a MySQL database named:

```text
php_project
```

Core entities:

```text
┌──────────────┐
│    users     │
└──────┬───────┘
       │
       │ authentication
       │
       ▼
┌──────────────────────────────┐
│       Admin Access           │
└──────────────────────────────┘


┌──────────────┐
│  categories  │
└──────┬───────┘
       │
       │ category relationship
       ▼
┌──────────────┐
│    posts     │
└──────────────┘
```

### Main Tables

```text
users
categories
posts
```

Posts are associated with categories, allowing the public website to filter and organize content dynamically.

---

# `06` SECURITY

Security fundamentals are an important part of the project.

## Password Hashing

Passwords are never intended to be stored as plain text.

```php
password_hash($password, PASSWORD_DEFAULT);
```

## Password Verification

```php
password_verify(
    $password,
    $hashedPassword
);
```

## Prepared Statements

Database queries use PDO prepared statements when processing user-controlled values.

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE email = ?"
);

$stmt->execute([$email]);
```

This helps reduce the risk of SQL injection.

---

# `07` PROJECT STRUCTURE

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

### Architecture Overview

```text
PUBLIC
├── index.php
├── category.php
└── detail.php

AUTH
├── login.php
└── register.php

ADMIN
├── Posts
├── Categories
└── Layouts

DATABASE
└── PDO Connection
```

---

# `08` APPLICATION FLOW

### Public Request

```text
USER
 │
 ▼
index.php
 │
 ▼
PHP
 │
 ▼
PDO
 │
 ▼
MySQL
 │
 ▼
Published Posts
 │
 ▼
HTML Response
 │
 ▼
BROWSER
```

### Authentication Flow

```text
REGISTER
   ↓
VALIDATE INPUT
   ↓
HASH PASSWORD
   ↓
STORE USER
   ↓
LOGIN
   ↓
VERIFY PASSWORD
   ↓
CREATE SESSION
   ↓
AUTHORIZED AREA
```

### Admin Flow

```text
ADMIN LOGIN
     ↓
SESSION CHECK
     ↓
ADMIN PANEL
     │
     ├── POST CRUD
     │
     └── CATEGORY CRUD
              ↓
            MYSQL
```

---

# `09` CRUD SYSTEM

One of the main purposes of Postify is practicing the complete CRUD lifecycle.

```text
                    CRUD
                     │
       ┌─────────────┼─────────────┐
       ↓             ↓             ↓
     CREATE         READ          UPDATE
       │             │             │
       └─────────────┼─────────────┘
                     ↓
                   DELETE
```

### Posts

```text
CREATE
READ
UPDATE
DELETE
CHANGE STATUS
```

### Categories

```text
CREATE
READ
UPDATE
DELETE
```

This provides the foundation of a basic **Content Management System**.

---

# `10` LOCAL DEVELOPMENT

Postify is currently designed primarily for local development using **XAMPP**.

### Requirements

```text
PHP
MySQL
Apache
phpMyAdmin
XAMPP
```

### Local Environment

```text
C:\xampp\htdocs\project-weblog
```

### Database

```text
php_project
```

### Database Connection

```text
Host      → localhost
Database  → php_project
Username  → root
Password  → empty
```

> These credentials are intended for local XAMPP development and should not be used as-is in production.

---

# `11` RUN LOCALLY

### Clone

```bash
git clone https://github.com/yosuf-dev/project-weblog.git
```

### Move into XAMPP

```text
C:\xampp\htdocs\project-weblog
```

### Start Services

```text
Apache
MySQL
```

### Create Database

Open:

```text
http://localhost/phpmyadmin
```

Create:

```text
php_project
```

### Open Application

```text
http://localhost/project-weblog/
```

### Authentication

```text
http://localhost/project-weblog/auth/login.php
```

```text
http://localhost/project-weblog/auth/register.php
```

### Administration

```text
http://localhost/project-weblog/admin/
```

---

# `12` ENGINEERING CONCEPTS

This project was built around several fundamental backend concepts:

```text
PHP
 │
 ├── Server-Side Rendering
 ├── Forms
 ├── Sessions
 ├── Authentication
 └── Application Logic
       │
       ▼
     PDO
       │
       ├── Prepared Statements
       ├── Queries
       └── Exceptions
       │
       ▼
     MySQL
       │
       ├── Users
       ├── Categories
       └── Posts
```

The goal is not only to make pages work, but to understand how the different layers of a backend application communicate.

---

# `13` WHAT I LEARNED

Building Postify strengthened my understanding of:

* PHP fundamentals
* Server-side rendering
* MySQL
* SQL queries
* PDO
* CRUD architecture
* Authentication
* Sessions
* Password hashing
* Form processing
* Database relationships
* Admin panel structure
* Backend project organization

It also provides a foundation for moving from **Native PHP** toward larger backend architectures and frameworks such as **Laravel**.

---

# `14` PRODUCTION ROADMAP

The current implementation is primarily a learning project.

Before treating the application as a production CMS, the following areas can be improved:

```text
CURRENT
   │
   ▼
Authentication
   │
   ▼
Authorization
   │
   ▼
CSRF Protection
   │
   ▼
Input Validation
   │
   ▼
Output Escaping
   │
   ▼
Secure Sessions
   │
   ▼
Environment Variables
   │
   ▼
HTTPS
   │
   ▼
Rate Limiting
   │
   ▼
Production Deployment
```

---

# `15` ROADMAP

```text
[ ] CSRF Protection
[ ] Role-Based Authorization
[ ] Improved Admin Dashboard
[ ] Image Upload System
[ ] Rich Post Editor
[ ] Pagination
[ ] Search
[ ] User Profiles
[ ] Comments
[ ] Tags
[ ] REST API
[ ] Responsive UI Improvements
[ ] Production Deployment
[ ] Laravel Version
```

---

# `16` DEVELOPMENT MINDSET

```text
UNDERSTAND
     ↓
DESIGN
     ↓
IMPLEMENT
     ↓
TEST
     ↓
SECURE
     ↓
REFACTOR
     ↓
DEPLOY
```

> **The goal is not just to learn PHP syntax.
> The goal is to understand backend engineering.**

---

# `17` PROJECT STATUS

```text
STATUS      → ACTIVE LEARNING PROJECT
TYPE        → PHP CMS
BACKEND     → NATIVE PHP
DATABASE    → MYSQL
ARCHITECTURE → SERVER-SIDE RENDERED
```

Postify represents a practical step in my journey toward **Full-Stack Web Development**, with a focus on understanding backend fundamentals before moving into larger frameworks and architectures.

---

# `18` DEVELOPER

<div align="center">

## `</> YOSUF`

### FULL-STACK WEB DEVELOPER

**Frontend Engineering · Backend Development · Database Design**

<br>

[![GitHub](https://img.shields.io/badge/GitHub-yosuf--dev-181717?style=for-the-badge\&logo=github)](https://github.com/yosuf-dev)

[![LinkedIn](https://img.shields.io/badge/LinkedIn-Yosuf%20Saleh%20Zadeh-0A66C2?style=for-the-badge\&logo=linkedin\&logoColor=white)](https://www.linkedin.com/in/yosuf-saleh-zadeh-2a0b34421/)

</div>

---

# `19` PROJECT

<div align="center">

### POSTIFY

**PHP · MySQL · PDO · CMS**

<br>

[![Repository](https://img.shields.io/badge/View%20Repository-181717?style=for-the-badge\&logo=github\&logoColor=white)](https://github.com/yosuf-dev/project-weblog)

</div>

---

<div align="center">

### `</> BUILD · LEARN · REFACTOR · SHIP`

<br>

**Yosuf Saleh Zadeh**

*Full-Stack Web Developer*

</div>
