# Deployment Instructions for ai-programming.tusometech.com

## Pre-Deployment Checklist

### 1. Database Setup
- [ ] Create MySQL database: `learn_it_with_muhindo`
- [ ] Create database user with appropriate privileges
- [ ] Note down database credentials (host, username, password)
- [ ] Test database connection

### 2. Update Configuration Files

#### A. Production Configuration (`config-production.php`)
Replace the following values:
```php
define('DB_HOST', 'localhost');           // Your database host
define('DB_NAME', 'learn_it_with_muhindo'); // Your database name
define('DB_USER', 'your_db_username');      // Your database username
define('DB_PASS', 'your_db_password');      // Your database password
define('ADMIN_PASSWORD', 'strong_password'); // Change to strong password
```

#### B. Production Enrollment File (`enroll-production.php`)
Update the same database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'learn_it_with_muhindo');
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');
```

### 3. File Deployment

#### Upload these files to your server:
1. `index.php` - Main landing page
2. `enroll.php` - Rename `enroll-production.php` to `enroll.php` on server
3. `admin.php` - Admin panel
4. `config.php` - Rename `config-production.php` to `config.php` on server
5. `functions.php` - Backend functions (if using with admin.php)
6. `.htaccess` - Use `.htaccess-production` content

#### DO NOT upload these files to production:
- `test.php`
- `test-form.html`
- `test-connection.php`
- `setup.php`
- `database.sql`
- Any files starting with `test-`
- `DEPLOYMENT-INSTRUCTIONS.md`

### 4. Set File Permissions
```bash
chmod 644 index.php
chmod 644 enroll.php
chmod 644 admin.php
chmod 644 config.php
chmod 644 functions.php
chmod 644 .htaccess
chmod 666 error.log (create this file if it doesn't exist)
```

### 5. Configure .htaccess
1. Rename `.htaccess-production` to `.htaccess`
2. Verify HTTPS redirect is working
3. Test that sensitive files are protected

### 6. Test the Website

#### A. Test Homepage
- Visit: https://ai-programming.tusometech.com
- Verify all sections load correctly
- Test mobile responsiveness
- Check navigation menu

#### B. Test Enrollment Form
1. Fill out the form with test data
2. Submit and verify success message appears
3. Check that data is saved in database

#### C. Test Admin Panel
1. Visit: https://ai-programming.tusometech.com/admin.php
2. Login with your admin password
3. Verify enrollments are displayed
4. Test logout functionality

### 7. Security Checklist
- [ ] Changed default admin password (4321) to strong password
- [ ] Updated database credentials in config files
- [ ] Verified `.htaccess` protects sensitive files
- [ ] HTTPS is enforced (no HTTP access)
- [ ] Error display is disabled (display_errors = 0)
- [ ] Error logging is enabled
- [ ] Test files removed from production

### 8. Database Schema
The enrollment table will be created automatically on first form submission, but you can also create it manually:

```sql
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    course VARCHAR(100) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    INDEX idx_created_at (created_at DESC),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Post-Deployment Testing

### Critical Tests:
1. **Homepage Load** - https://ai-programming.tusometech.com
2. **Form Submission** - Submit test enrollment
3. **Admin Login** - Access admin panel
4. **Mobile View** - Test on mobile devices
5. **HTTPS** - Verify SSL certificate is working
6. **Error Logs** - Check error.log for any issues

## Troubleshooting

### Form Submission Fails
- Check database credentials in `enroll.php`
- Verify database exists and user has privileges
- Check `error.log` for PHP errors
- Test database connection manually

### Admin Panel Won't Load
- Verify `config.php` has correct database credentials
- Check that admin password was updated
- Ensure `functions.php` is uploaded

### 500 Internal Server Error
- Check `.htaccess` syntax
- Verify PHP version (requires PHP 7.4+)
- Check file permissions
- Review server error logs

### Database Connection Failed
- Verify MySQL service is running
- Check database host (might be `localhost` or IP address)
- Confirm database user has proper privileges
- Test connection using command line or phpMyAdmin

## Support
For issues or questions, contact the developer.

## Version
Version: 1.0  
Last Updated: December 8, 2025  
Production URL: https://ai-programming.tusometech.com
