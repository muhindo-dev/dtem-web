# ULFA Website Settings Integration

## Overview

The ULFA website now has a comprehensive settings system that allows administrators to control nearly every aspect of the website through the admin panel. This eliminates hardcoded values and makes the site fully configurable.

## Settings Categories

### 1. General Settings
- **Organization Info**: Site name, short name (acronym), tagline, description
- **Mission & Vision**: Editable mission and vision statements
- **Currency**: Currency code, symbol, minimum donation amount
- **Founding Info**: Year founded, registration number

### 2. Contact Settings
- **Primary Contact**: Email, phone, alternative phone, WhatsApp number
- **Location**: Full address, city, country, Google Maps embed code
- **Office Hours**: Working hours and weekend hours

### 3. Branding Settings
- **Logo**: Upload primary logo (dark), light logo (for dark backgrounds)
- **Favicon**: Upload site favicon (ICO or PNG)
- **Colors**: Primary and secondary colors (future feature)
- **Logo Icon**: Font Awesome icon class for fallback

### 4. Footer Settings
- **Copyright Text**: Footer copyright message
- **About Text**: Brief description in footer
- **Developer Credit**: Developer name and URL

### 5. Social Media
- Facebook, Twitter/X, Instagram, LinkedIn, YouTube, TikTok URLs
- WhatsApp floating button toggle and default message

### 6. Payment Settings (Pesapal)
- Environment (sandbox/live)
- Consumer key and secret
- IPN ID
- Bank details for manual transfers

### 7. SEO Settings
- Meta title, description, keywords
- Open Graph (og:title, og:description, og:image)
- Google Analytics ID
- Facebook Pixel ID

### 8. Advanced Settings
- Maintenance mode toggle and message
- Notification email
- Donation popup toggle
- Custom head/footer code injection

## Helper Functions (functions.php)

### Basic Functions

```php
// Get a single setting
$siteName = getSetting('site_name', 'Default Name');

// Get multiple settings
$settings = getSettings(['site_name', 'site_email', 'site_phone']);

// Get all settings with a prefix
$socialSettings = getSettingsByPrefix('facebook_');

// Check if setting has a value
if (hasSetting('google_analytics_id')) {
    // Analytics is configured
}
```

### Specialized Functions

```php
// Get logo URL (returns null if no logo uploaded)
$logo = getSiteLogo();

// Get favicon URL
$favicon = getSiteFavicon();

// Get formatted phone link
$phoneLink = getPhoneLink($phone); // Returns: tel:+256700000000

// Get WhatsApp chat link
$whatsappLink = getWhatsAppLink(); // Uses settings
$whatsappLink = getWhatsAppLink($customPhone, $customMessage); // Custom values

// Get all social media links
$social = getSocialLinks();
// Returns: ['facebook' => 'url', 'twitter' => 'url', ...]

// Get currency info
$currency = getCurrency();
// Returns: ['code' => 'UGX', 'symbol' => 'UGX', 'name' => 'Ugandan Shilling']

// Format currency amount
$formatted = formatCurrency(50000); // Returns: UGX 50,000
```

## Files Modified

### Frontend Templates
1. **includes/header.php** - Uses settings for:
   - Page title and meta description
   - Favicon
   - Logo (image or icon fallback)
   - Site name and tagline
   - Open Graph tags
   - Google Analytics
   - Custom head code

2. **includes/footer.php** - Uses settings for:
   - Site description
   - Logo icon
   - Contact info (address, phone, email)
   - Social media links
   - Copyright text
   - Developer credit
   - WhatsApp floating button
   - Custom footer code

3. **index.php** - Homepage hero section
4. **about.php** - Mission & vision statements
5. **contact.php** - Contact information
6. **donation-step1.php** - Currency and minimum donation

### Admin Panel
- **admin/settings.php** - Complete settings management with tabs:
  - General, Contact, Branding, Social, Payment, SEO, Advanced

## Database Schema

Settings are stored in the `site_settings` table:

```sql
CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Legacy Compatibility

The system handles legacy naming conventions automatically:
- `contact_email` ↔ `site_email`
- `contact_phone` ↔ `site_phone`
- `contact_address` ↔ `site_address`

## Setup Instructions

### Initial Setup
1. Run the `settings-setup.sql` script to populate default settings
2. Go to Admin Panel → Settings
3. Fill in your organization's information
4. Upload logo and favicon
5. Configure social media links
6. Set up Pesapal credentials for donations

### Testing
1. Visit the homepage to verify logo and branding
2. Check footer for contact info and social links
3. Test WhatsApp button (if enabled)
4. Verify donation page shows correct currency
5. Check meta tags in page source

## Best Practices

1. **Always use getSetting() with a default value** - This ensures the site works even if a setting is missing

2. **Use specialized functions** - `getSocialLinks()`, `formatCurrency()` etc. provide consistent formatting

3. **Settings are cached** - Loaded once per request, safe to call multiple times

4. **Escape output** - Always use `htmlspecialchars()` when displaying settings in HTML

## Troubleshooting

### Settings not showing
- Check if settings exist in database
- Verify the setting key spelling
- Check legacy mapping if using old keys

### Logo not displaying
- Ensure file was uploaded to `uploads/site/`
- Check file permissions
- Verify the file path in database

### WhatsApp button not showing
- Enable in Settings → Social → WhatsApp Integration
- Ensure WhatsApp number is set (Contact tab)
