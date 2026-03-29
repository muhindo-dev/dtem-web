<?php
require_once 'functions.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $password = $_POST['password'] ?? '';
    if (adminLogin($password)) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    adminLogout();
    header('Location: admin.php');
    exit;
}

// Check if logged in
if (!isAdminLoggedIn()) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DTEHM Admin Login</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Arial', sans-serif;
                background: #000;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .login-container {
                background: #fff;
                color: #000;
                padding: 3rem;
                width: 100%;
                max-width: 450px;
                border: 5px solid #01399a;
            }
            .logo {
                text-align: center;
                margin-bottom: 2rem;
            }
            .logo h1 {
                color: #01399a;
                font-size: 2rem;
                font-weight: 800;
                margin-bottom: 0.3rem;
            }
            .logo p {
                color: #666;
                font-size: 0.9rem;
            }
            h2 {
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
                text-align: center;
                border-bottom: 3px solid #01399a;
                padding-bottom: 1rem;
            }
            .form-group {
                margin-bottom: 1.5rem;
            }
            label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #333;
            }
            input[type="password"] {
                width: 100%;
                padding: 0.9rem;
                border: 3px solid #000;
                font-size: 1rem;
                transition: all 0.3s;
            }
            input[type="password"]:focus {
                outline: none;
                border-color: #01399a;
                background: #fffef5;
            }
            button {
                width: 100%;
                padding: 1rem;
                background: #01399a;
                color: #000;
                border: 3px solid #01399a;
                font-size: 1rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s;
                text-transform: uppercase;
                letter-spacing: 1px;
                position: relative;
                overflow: hidden;
            }
            button::before {
                content: '';
                position: absolute;
                inset: 0;
                background: #000;
                transform: translateY(100%);
                transition: transform 0.3s;
                z-index: 0;
            }
            button:hover::before {
                transform: translateY(0);
            }
            button:hover {
                color: #01399a;
                border-color: #000;
            }
            .error {
                background: #fff;
                color: #c00;
                padding: 1rem;
                margin-bottom: 1.5rem;
                border: 3px solid #c00;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="logo">
                <h1>DTEHM</h1>
                <p>DTEHM Health Ministries - Admin Panel</p>
            </div>
            <h2>Admin Login</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autofocus>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Get contact inquiries
$enrollments = getAllEnrollments();
$totalEnrollments = count($enrollments);

// Calculate subject statistics
$courseStats = [];
foreach ($enrollments as $enrollment) {
    $subject = $enrollment['subject'];
    if (!isset($courseStats[$subject])) {
        $courseStats[$subject] = 0;
    }
    $courseStats[$subject]++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTEHM Admin - Contact Inquiries</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            color: #000;
        }
        .header {
            background: #000;
            color: #fff;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 5px solid #01399a;
        }
        .header h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .header h1 span {
            color: #01399a;
        }
        .logout-btn {
            background: transparent;
            color: #01399a;
            padding: 0.7rem 1.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border: 3px solid #01399a;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .logout-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: #01399a;
            transform: translateX(-100%);
            transition: transform 0.3s;
            z-index: -1;
        }
        .logout-btn:hover::before {
            transform: translateX(0);
        }
        .logout-btn:hover {
            color: #000;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: #fff;
            border: 4px solid #000;
            padding: 1.5rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 5px;
            background: #01399a;
            transition: width 0.3s;
        }
        .stat-card:hover::after {
            width: 100%;
        }
        .stat-card:hover {
            background: #fffef5;
            border-color: #01399a;
        }
        .stat-card h3 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
        }
        .enrollments-section {
            background: #fff;
            padding: 2rem;
            border: 3px solid #000;
        }
        .enrollments-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #000;
            border-bottom: 3px solid #01399a;
            padding-bottom: 0.5rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #000;
        }
        th {
            background: #000;
            color: #01399a;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        tr:hover {
            background: #01399a;
        }
        .course-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: #01399a;
            color: #000;
            font-size: 0.85rem;
            font-weight: 600;
            border: 2px solid #000;
        }
        .no-data {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            .container {
                padding: 1rem;
            }
            table {
                font-size: 0.85rem;
            }
            th, td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span>DTEHM</span> Admin Dashboard</h1>
        <a href="?logout=1" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <h3>Total Inquiries</h3>
                <div class="number"><?php echo $totalEnrollments; ?></div>
            </div>
            <div class="stat-card">
                <h3>Donations</h3>
                <div class="number"><?php echo $courseStats['donation'] ?? 0; ?></div>
            </div>
            <div class="stat-card">
                <h3>Volunteers</h3>
                <div class="number"><?php echo $courseStats['volunteer'] ?? 0; ?></div>
            </div>
            <div class="stat-card">
                <h3>Partnerships</h3>
                <div class="number"><?php echo $courseStats['partnership'] ?? 0; ?></div>
            </div>
        </div>

        <div class="enrollments-section">
            <h2>Recent Contact Inquiries</h2>
            <?php if ($totalEnrollments > 0): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enrollments as $enrollment): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($enrollment['id']); ?></td>
                                    <td><?php echo date('M d, Y H:i', strtotime($enrollment['created_at'])); ?></td>
                                    <td><?php echo htmlspecialchars($enrollment['name']); ?></td>
                                    <td><?php echo htmlspecialchars($enrollment['email']); ?></td>
                                    <td><?php echo htmlspecialchars($enrollment['phone']); ?></td>
                                    <td>
                                        <span class="course-badge">
                                            <?php 
                                                $subjectNames = [
                                                    'donation' => 'Donation',
                                                    'volunteer' => 'Volunteer',
                                                    'sponsor' => 'Sponsor Child',
                                                    'partnership' => 'Partnership',
                                                    'general' => 'General'
                                                ];
                                                echo $subjectNames[$enrollment['subject']] ?? ucfirst($enrollment['subject']);
                                            ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($enrollment['message'] ?: '-'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-data">No enrollments yet.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
