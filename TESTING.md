# Testing Guide - Learn it with Muhindo Academy

## Setup Steps (Run Once)

1. **Setup Database**
   - Open: http://localhost:8888/learn-it-with-muhindo/setup.php
   - This creates the database and tables automatically
   - You should see success messages

2. **Run Tests**
   - Open: http://localhost:8888/learn-it-with-muhindo/test.php
   - Verify all tests pass
   - This also creates a test enrollment

## Test Enrollment Form (AJAX Submission)

1. **Open Homepage**
   - URL: http://localhost:8888/learn-it-with-muhindo/index.php

2. **Scroll to "Enroll Now" Section**

3. **Fill the Form:**
   - Name: Your Name
   - Email: your@email.com
   - Phone: +256700000000
   - Course: Select any course
   - Message: Optional message

4. **Click "Submit Enrollment"**

5. **Expected Result:**
   - Button shows "Submitting..."
   - Page stays on same page (no reload)
   - Success message appears in black box
   - Form clears automatically
   - Message disappears after 10 seconds

6. **Test Error Handling:**
   - Try submitting with invalid email
   - Try submitting with same email twice
   - Check error messages appear in white box with red border

## Test Admin Panel

1. **Access Admin Panel**
   - URL: http://localhost:8888/learn-it-with-muhindo/admin.php

2. **Login:**
   - Password: 4321
   - Click "Login"

3. **Verify Admin Panel:**
   - See total enrollments count
   - See course statistics
   - See enrollment table (latest first)
   - Check all enrollment details are visible

4. **Test Logout:**
   - Click "Logout" button
   - Should redirect to login page

## AJAX Features to Test

### Success Cases:
- ✓ Form submits without page reload
- ✓ Success message appears
- ✓ Form clears after success
- ✓ Submit button disabled during submission
- ✓ Button text changes to "Submitting..."

### Error Cases:
- ✓ Invalid email format
- ✓ Missing required fields
- ✓ Duplicate enrollment (try same email within 1 hour)
- ✓ Invalid phone number

### Security Features:
- ✓ SQL injection protection (try: ' OR '1'='1)
- ✓ XSS protection (try: <script>alert('test')</script>)
- ✓ Admin password protection
- ✓ Duplicate prevention

## Browser Console Testing

Open browser console (F12) and check:
- No JavaScript errors
- AJAX requests complete successfully
- JSON responses are correct

## Database Verification

Check phpMyAdmin:
1. Database: learn_it_with_muhindo
2. Table: enrollments
3. Verify data is saved correctly
4. Check timestamps are correct

## Files Created:
- index.php (main page with AJAX form)
- enroll.php (AJAX endpoint - returns JSON)
- functions.php (backend functions)
- config.php (configuration)
- admin.php (admin panel)
- setup.php (database setup)
- test.php (system tests)

## Troubleshooting

If form doesn't submit:
1. Check browser console for errors
2. Verify MAMP is running
3. Check database connection in test.php
4. Verify enroll.php is accessible
5. Check file permissions

If admin panel doesn't work:
1. Verify password is exactly "4321"
2. Check sessions are enabled in PHP
3. Clear browser cookies/cache

## Success Indicators:
- Setup.php shows all green checkmarks
- Test.php shows all tests passing
- Form submits via AJAX successfully
- Admin panel shows enrollments
- No console errors in browser
