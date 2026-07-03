College Authentication System (PHP + MySQL)
A complete web-based login/register/reset-password system built with PHP, HTML, CSS, JavaScript, and MySQL — matching the required design.

Files
database.sql — (a) Creates the COMPUTING database and users table.
config.php — (e) MySQLi connection to the COMPUTING database.
index.php — Front-end page with Login, Register, and Reset Password panels.
register.php — (b) Server-side registration logic + validation.
login.php — (c) Server-side login/authentication logic.
reset_password.php — (d) Server-side password reset logic.
assets/style.css — Styling matching the mock-up.
assets/script.js — Client-side validation + AJAX form submission.
Setup
Create the database Import the schema into MySQL:

mysql -u root -p < database.sql
Configure the connection Open config.php and set your MySQL username/password:

$DB_USER = "root";
$DB_PASS = "your_password";
Run with a local PHP server From inside the project folder:

php -S localhost:8000
Then open http://localhost:8000 in your browser.

Alternatively, place the folder inside your XAMPP/WAMP htdocs directory and visit http://localhost/college_auth_system.

How it works
Register: Validates full name, username, email format, and password length/match on both the client (JS) and server (PHP) sides. Passwords are hashed with password_hash() — never stored in plain text. Duplicate usernames/emails are rejected.
Login: Looks up the username, verifies the password with password_verify(), and on success starts a PHP session and returns a welcome message with the user's full name. Invalid credentials show an error message.
Reset Password: Confirms the email exists in the database, then updates the stored (hashed) password to the new one.
Security notes: All SQL queries use prepared statements (protects against SQL injection). Passwords are always hashed, never stored or compared in plain text.
Notes / possible extensions
The current reset flow updates the password directly after confirming the email (as shown in the mock-up's simple design). For production use, you'd normally email the user a secure, expiring reset link/token instead of resetting immediately in the same form.
You can extend login.php to redirect to a dashboard page using $_SESSION after login instead of just showing a message.
