# Security Checklist for ULFA Website - Production Deployment

## Security Status: ✅ Production Ready

This document outlines the security measures implemented in the ULFA charity website.

---

## ✅ Implemented Security Features

### 1. Database Security
- [x] PDO with prepared statements (prevents SQL injection)
- [x] Password hashing using `password_hash()` and `password_verify()`
- [x] Parameterized queries throughout the codebase
- [x] Database connection via secure socket or standard connection

### 2. Authentication & Authorization
- [x] Session-based admin authentication
- [x] Secure session management with timeout (30 minutes)
- [x] Session cookie security settings (httponly, strict mode)
- [x] Admin activity logging

### 3. CSRF Protection
- [x] CSRF token generation using `random_bytes(32)`
- [x] CSRF verification on all DELETE operations:
  - `news-delete.php`
  - `causes-delete.php`
  - `events-delete.php`
  - `gallery-delete.php`
  - `team-delete.php`
  - `inquiries-delete.php`
  - `admins-delete.php`
- [x] Token validation using `hash_equals()` (timing-safe comparison)

### 4. XSS Prevention
- [x] `htmlspecialchars()` used on all user output
- [x] Proper escaping in all templates
- [x] Safe Google Maps embed sanitization
- [x] Content Security Policy ready

### 5. Input Validation
- [x] Email validation using `filter_var(FILTER_VALIDATE_EMAIL)`
- [x] Phone number validation (minimum 10 digits)
- [x] Integer casting for IDs: `(int)$_GET['id']`
- [x] Input sanitization with `trim()`, `stripslashes()`, `htmlspecialchars()`

### 6. File Upload Security
- [x] MIME type validation using `finfo_file()`
- [x] File extension whitelist (jpg, jpeg, png, gif, webp)
- [x] Unique filename generation
- [x] Upload directory outside web root consideration

### 7. Rate Limiting
- [x] Contact form: Max 5 submissions per IP in 10 minutes
- [x] Duplicate submission prevention (1 hour cooldown)

### 8. Error Handling
- [x] Environment-based error display
- [x] Errors logged to file in production
- [x] User-friendly error messages
- [x] No sensitive data in error messages

---

## Before Going Live Checklist

### Configuration
- [ ] Copy `config-production.php` to `config.php` on production server
- [ ] Update database credentials (never use root/root)
- [ ] Set `ENVIRONMENT` to `'production'`
- [ ] Update `DB_SOCKET` to empty string `''` for standard hosting

### File Permissions
```bash
# Recommended permissions
chmod 644 *.php          # PHP files
chmod 755 admin/         # Directories
chmod 755 uploads/       # Upload directories
chmod 644 .htaccess      # Apache config
```

### Files to Remove from Production
```bash
# Delete these files from production server:
rm -f test.php test-form.html test-connection.php
rm -f setup.php database.sql admin-schema.sql
rm -f *.backup *.md
rm -f ngrok-setup.sh cloudflare-tunnel-setup.sh
```

### SSL/HTTPS
- [ ] Enable SSL certificate (Let's Encrypt or hosting provider)
- [ ] Force HTTPS redirects
- [ ] Set secure cookie flag in production

---

## Password Requirements for Admin

When creating admin accounts, use strong passwords:
- Minimum 12 characters
- Mix of uppercase, lowercase, numbers, symbols
- Never reuse passwords
- Consider using a password manager

---

## Monitoring & Maintenance

### Regular Tasks
- [ ] Check error.log weekly
- [ ] Review admin activity logs
- [ ] Monitor for unusual traffic patterns
- [ ] Update PHP and dependencies quarterly
- [ ] Backup database weekly

### Log Locations
- Application errors: `/error.log`
- Admin activity: `admin_activity_log` database table
- Contact submissions: `contact_inquiries` database table

---

## Emergency Procedures

### If Site is Compromised
1. Take site offline immediately
2. Change all database passwords
3. Check admin_users table for unauthorized accounts
4. Review activity logs for unauthorized actions
5. Restore from clean backup if necessary
6. Update all admin passwords

### If Admin Account is Compromised
1. Delete compromised admin from database
2. Change remaining admin passwords
3. Review and remove unauthorized content
4. Check activity logs for malicious changes
        if ($data['count'] >= $limit && (time() - $data['timestamp']) < $window) {
            return false;
        }
        if ((time() - $data['timestamp']) >= $window) {
            $data = ['count' => 0, 'timestamp' => time()];
        }
    } else {
        $data = ['count' => 0, 'timestamp' => time()];
    }
    
    $data['count']++;
    file_put_contents($cacheFile, json_encode($data));
    return true;
}
```

## Monitoring Tools:

1. **Uptime Monitoring**: https://uptimerobot.com (free)
2. **Error Tracking**: Check logs daily
3. **Security Scanning**: https://sitecheck.sucuri.net
4. **Speed Test**: https://pagespeed.web.dev

## Emergency Contacts:

- Cloudflare Support: https://support.cloudflare.com
- XAMPP Forum: https://community.apachefriends.org
- Keep hosting provider contact ready

## Regular Maintenance:

- Daily: Check error logs
- Weekly: Review enrollment submissions, check uptime
- Monthly: Update PHP/XAMPP, backup database, security audit
- Quarterly: Review and update security measures
