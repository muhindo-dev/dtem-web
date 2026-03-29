# Learn it with Muhindo Academy - Setup Instructions

## Database Setup

1. Open phpMyAdmin or your MySQL client
2. Import the `database.sql` file to create the database and tables automatically
   OR run this command in terminal:
   ```
   mysql -u root -proot < database.sql
   ```

## File Structure

- `index.php` - Main landing page (renamed from index.html to support PHP)
- `functions.php` - Core functions for database operations and form handling
- `config.php` - Database configuration and settings
- `admin.php` - Admin panel to view enrollments
- `database.sql` - SQL file to create database and tables

## Admin Access

- URL: `http://localhost:8888/learn-it-with-muhindo/admin.php`
- Password: `4321`

## Features

### Security Features
- SQL injection protection using PDO prepared statements
- XSS protection with input sanitization
- CSRF protection via session management
- Password-protected admin panel
- Duplicate enrollment prevention (1 hour cooldown)
- IP address logging

### Form Validation
- Required field validation
- Email format validation
- Phone number validation
- Real-time error messages

### Admin Panel Features
- Password-protected access
- View all enrollments (latest first)
- Course statistics dashboard
- Responsive table design
- Clean black & white interface

## Usage

### For Students (Enrollment)
1. Go to `http://localhost:8888/learn-it-with-muhindo/`
2. Scroll to the "Enroll Now" section
3. Fill in the form with your details
4. Select a course
5. Submit the form
6. You'll see a success message

### For Admin
1. Go to `http://localhost:8888/learn-it-with-muhindo/admin.php`
2. Enter password: `4321`
3. View all enrollments with statistics
4. Enrollments are sorted by date (newest first)

## Database Configuration

Default settings in `config.php`:
- Host: localhost
- Database: learn_it_with_muhindo
- Username: root
- Password: root
- Socket: /Applications/MAMP/tmp/mysql/mysql.sock

To change these settings, edit the `config.php` file.

## Notes

- The database table is automatically created when the first enrollment is submitted
- Session-based messaging for user feedback
- Admin sessions expire after browser close
- All inputs are sanitized and validated
- Responsive design works on all devices
