# Smart Health Dashboard + PHP Auth Lab

## Aim
Build a small lab project that demonstrates:
- Form handling using POST
- Database connectivity with MySQL
- Validation of user credentials (login/register)
- PHP variable scope

## Features
- User registration and login (PHP + MySQL)
- Protected landing page after login
- Appointment booking form (POST)
- File functions demo using `appointments.txt`
- Variable scope demo

## Technologies Used
- HTML
- CSS
- PHP
- MySQL

## Setup
1. Create a database named `smart_healthcare`.
2. Run the SQL in `auth_schema.sql`.
3. Update DB credentials in `DASHdb_con.php` if needed.
4. Start a local PHP server (XAMPP/WAMP/LAMP).
5. Open `login.php` in the browser.

## Google OAuth Setup
1. Create a Google OAuth Client ID (Web application) in Google Cloud Console.
2. Add an authorized redirect URI that exactly matches your callback URL (scheme, host, port, and trailing slash must match).
3. For local development you may use `http://localhost/...` as the redirect URI.
4. Update `google_oauth_config.php` with your Client ID, Client Secret, and Redirect URI.
5. Use the "Sign in with Google" button on `login.php`.

## Key Pages
- `register.php` - create user account
- `login.php` - authenticate user
- `DASHindex.php` - protected home after login
- `Appoint_form.php` - appointment form (POST)
- `file_functions_demo.php` - file handling demo
- `scope_demo.php` - variable scope demo
