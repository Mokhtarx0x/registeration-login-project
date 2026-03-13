# registeration-login-project
beginner-friendly PHP and MySQL web application that demonstrates the core concepts of user authentication. It allows users to create an account, log in securely, and view their profile on a protected dashboard. 


PHP & MySQL Project
A simple web application built with PHP and MySQL featuring user registration, login, and a protected dashboard.

Pages
Page File Description Registerregister.php  : Create a new 
account Login : login.php 
Sign in to your account Dashboard : dashboard.php Protected page showing user info

Project Structure
registeration-login-project/
├── config.php       # Database connection
├── register.php     # Registration form + validation
├── login.php        # Login form + session handling
├── dashboard.php    # Protected dashboard (requires login)
├── logout.php       # Destroys session and redirects to login
├── style.css        # All page styles
└── database.sql     # SQL to create the database and users table

Requirements

XAMPP (Apache + MySQL + PHP)
A web browser


How It Works
Register

The user fills in: First Name, Second Name, Username, Email, and Password
The backend validates all fields (empty check, email format, password length, duplicate username/email)
If valid, the password is hashed and the user is saved to the database
The user is redirected to the Login page

Login

The user enters their Username and Password
The backend looks up the user in the database and verifies the password
If correct, a session is started and the user is redirected to the Dashboard

Dashboard

Protected page — if you are not logged in, you get redirected to Login automatically
Displays the user's full name, username, email, and join date

Logout

Destroys the session and redirects back to the Login page


Database Table
Table name: users

| Column | Type | Description |
|---|---|---|
| `id` | INT, AUTO_INCREMENT | Primary key |
| `username` | VARCHAR(50) | Unique username |
| `email` | VARCHAR(100) | Unique email address |
| `password` | VARCHAR(255) | Bcrypt-hashed password |
| `first_name` | VARCHAR(50) | User's first name |
| `second_name` | VARCHAR(50) | User's second name |
| `created_at` | TIMESTAMP | Account creation date |


Configuration
If you changed the MySQL password in XAMPP, update config.php:
    php$conn = mysqli_connect("localhost", "root", "YOUR_PASSWORD", "webapp_db");
By default XAMPP uses an empty password, so no changes are needed.
