# ULFA Donation System Documentation

## Overview

The ULFA Donation System provides a complete, secure, and user-friendly donation flow integrated with Pesapal Payment Gateway (API 3.0). It supports both general donations and donations to specific causes.

## Table of Contents

1. [System Architecture](#system-architecture)
2. [Files Structure](#files-structure)
3. [Database Schema](#database-schema)
4. [Payment Flow](#payment-flow)
5. [Configuration](#configuration)
6. [Admin Panel](#admin-panel)
7. [IPN Handling](#ipn-handling)
8. [Security Considerations](#security-considerations)
9. [Troubleshooting](#troubleshooting)

---

## System Architecture

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│  donation-      │ --> │  donation-      │ --> │  Pesapal        │
│  step1.php      │     │  step2.php      │     │  Payment Page   │
│  (Form)         │     │  (Confirm)      │     │                 │
└─────────────────┘     └─────────────────┘     └────────┬────────┘
                                                         │
                                                         v
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│  donation-      │ <-- │  Pesapal        │     │  donation-      │
│  step3.php      │     │  Callback       │     │  ipn.php        │
│  (Status)       │     │                 │     │  (Webhook)      │
└─────────────────┘     └─────────────────┘     └─────────────────┘
```

---

## Files Structure

### Frontend Donation Pages

| File | Purpose |
|------|---------|
| `donation-step1.php` | Donation form - amount selection and donor details |
| `donation-step2.php` | Confirmation page and payment initiation |
| `donation-step3.php` | Payment status callback and result display |
| `donation-ipn.php` | IPN webhook endpoint for Pesapal notifications |

### Backend Integration

| File | Purpose |
|------|---------|
| `includes/PesapalHelper.php` | Pesapal API 3.0 wrapper class |
| `admin/donations.php` | Admin donations list view |
| `admin/donations-view.php` | Admin single donation detail view |
| `admin/donations-export.php` | CSV export functionality |

### Database

| File | Purpose |
|------|---------|
| `donations-schema.sql` | Database schema for donations table |

---

## Database Schema

### donations table

```sql
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_name VARCHAR(255) NOT NULL,
    donor_email VARCHAR(255) NOT NULL,
    donor_phone VARCHAR(50),
    amount DECIMAL(12, 2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'UGX',
    cause_id INT DEFAULT NULL,
    message TEXT,
    is_anonymous TINYINT(1) DEFAULT 0,
    merchant_reference VARCHAR(100) UNIQUE NOT NULL,
    order_tracking_id VARCHAR(100),
    payment_method VARCHAR(50),
    confirmation_code VARCHAR(100),
    payment_status ENUM('pending', 'completed', 'failed', 'reversed', 'invalid') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (cause_id) REFERENCES causes(id) ON DELETE SET NULL
);
```

### site_settings (Pesapal configuration)

| Key | Description |
|-----|-------------|
| `pesapal_environment` | 'sandbox' or 'live' |
| `pesapal_consumer_key` | Your Pesapal consumer key |
| `pesapal_consumer_secret` | Your Pesapal consumer secret |
| `pesapal_ipn_id` | IPN ID from Pesapal IPN registration |

---

## Payment Flow

### Step 1: Donation Form (`donation-step1.php`)

1. User selects donation amount (preset or custom)
2. User enters personal details (name, email, phone)
3. User optionally selects a specific cause
4. User can choose to remain anonymous
5. Data is validated and stored in PHP session
6. User is redirected to Step 2

### Step 2: Confirmation (`donation-step2.php`)

1. Displays donation summary
2. On "Pay Now" click:
   - Generates unique merchant reference
   - Creates Pesapal order via API
   - Saves donation record with 'pending' status
   - Redirects user to Pesapal payment page

### Step 3: Callback (`donation-step3.php`)

1. Receives callback from Pesapal with OrderTrackingId
2. Queries Pesapal for transaction status
3. Updates donation record in database
4. If completed, updates cause raised_amount
5. Displays appropriate success/failure message

### IPN Handler (`donation-ipn.php`)

1. Receives server-to-server notification from Pesapal
2. Logs all requests for debugging
3. Verifies transaction status via API
4. Updates donation record
5. Returns JSON acknowledgment to Pesapal

---

## Configuration

### 1. Database Setup

Run the SQL schema:
```bash
mysql -u root -p ulfa_charity < donations-schema.sql
```

### 2. Pesapal Credentials

Configure in Admin → Settings → Pesapal Payment Gateway:

- **Environment**: 'sandbox' for testing, 'live' for production
- **Consumer Key**: Your Pesapal API consumer key
- **Consumer Secret**: Your Pesapal API consumer secret
- **IPN ID**: Obtained after registering your IPN URL with Pesapal

### 3. Register IPN URL

1. Go to Pesapal Dashboard → Settings → IPN URLs
2. Register your IPN URL: `https://yourdomain.com/donation-ipn.php`
3. Copy the returned IPN ID to your settings

---

## Admin Panel

### Donations List (`admin/donations.php`)

- View all donations with filters (status, cause, date range)
- Search by donor name, email, phone, or reference
- Statistics dashboard showing totals and counts
- Export to CSV functionality
- Pagination support

### Donation Detail (`admin/donations-view.php`)

- Complete donor information
- Payment details and tracking IDs
- Timeline of donation events
- Manual status verification via Pesapal API
- Donor lifetime statistics

---

## IPN Handling

### Request Logging

All IPN requests are logged to `/logs/pesapal_ipn.log`:
```
[2026-01-20 01:30:00] IPN Request received
[2026-01-20 01:30:00] GET: {"OrderTrackingId":"xxx","OrderMerchantReference":"xxx"}
[2026-01-20 01:30:00] Processing: tracking_id=xxx, merchant_ref=xxx
[2026-01-20 01:30:00] Status result: {"success":true,"status":"completed",...}
[2026-01-20 01:30:00] Donation updated to status: completed
```

### Status Codes

| Code | Status | Description |
|------|--------|-------------|
| 0 | INVALID | Transaction is invalid |
| 1 | COMPLETED | Payment completed successfully |
| 2 | FAILED | Payment failed |
| 3 | REVERSED | Payment was reversed |

---

## Security Considerations

### Input Validation

- All user inputs are validated and sanitized
- Email format validation
- Phone number format validation
- Amount minimum/maximum limits

### Database Security

- PDO prepared statements prevent SQL injection
- Passwords and secrets are not logged
- IP addresses are recorded for audit

### Session Security

- Session data cleared after payment
- CSRF protection via session tokens
- Secure cookie settings recommended

### API Security

- SSL/TLS for all API communications
- Access tokens expire after 5 minutes
- Secrets stored in database, not code

---

## Troubleshooting

### Common Issues

#### "Payment gateway is not configured"
- Ensure all Pesapal settings are filled in Admin → Settings
- Verify IPN ID is registered and saved

#### "Authentication failed"
- Check if credentials are for correct environment (sandbox vs live)
- Verify consumer key and secret are correct

#### Payment stuck on "pending"
- Check IPN logs for errors
- Use "Verify Payment Status" button in admin
- Ensure IPN URL is accessible publicly

#### "Donation record not found"
- Check if donation was created in database
- Verify merchant reference matches

### Debug Mode

Enable error logging in `config.php`:
```php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_log('logs/error.log');
```

### Useful SQL Queries

```sql
-- Check recent donations
SELECT * FROM donations ORDER BY created_at DESC LIMIT 10;

-- Check pending donations
SELECT * FROM donations WHERE payment_status = 'pending';

-- Get donation statistics
SELECT 
    payment_status, 
    COUNT(*) as count, 
    SUM(amount) as total
FROM donations 
GROUP BY payment_status;
```

---

## API Reference

### PesapalHelper Class

#### Constructor
```php
$pesapal = new PesapalHelper(
    $consumer_key,
    $consumer_secret,
    $environment,  // 'sandbox' or 'live'
    $ipn_id
);
```

#### Methods

| Method | Description |
|--------|-------------|
| `getAccessToken()` | Get OAuth bearer token |
| `registerIPN($url, $type)` | Register IPN URL with Pesapal |
| `submitOrder($order_data)` | Submit new payment order |
| `getTransactionStatus($tracking_id)` | Check payment status |
| `generateMerchantReference($prefix)` | Generate unique reference |
| `buildIPNResponse($tracking_id, $ref, $status)` | Build IPN acknowledgment |

---

## Changelog

### Version 1.0.0 (2026-01-20)
- Initial release
- Pesapal API 3.0 integration
- 3-step donation flow
- Admin management interface
- CSV export functionality
- IPN webhook handler

---

## Support

For technical support, contact the ULFA development team or refer to:
- Pesapal API Documentation: https://developer.pesapal.com/
- ULFA Admin Panel: /admin/donations.php
