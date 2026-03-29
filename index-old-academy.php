<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULFA - United Love for All Orphanage Centre | Empowering Children in Uganda</title>
    <meta name="description" content="United Love for All (ULFA) Orphanage Centre provides love, care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            overflow-x: hidden;
        }

        :root {
            --primary-yellow: #FFC107;
            --primary-black: #000000;
            --dark-yellow: #FFB300;
            --light-yellow: #FFECB3;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-border: #dee2e6;
            --gray-text: #6c757d;
            --gray-dark: #343a40;
            --success-green: #28a745;
            --info-blue: #17a2b8;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--primary-black);
        }

        /* Navigation */
        .navbar {
            background: var(--primary-black) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-yellow) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .navbar-brand span {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand .brand-main {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .navbar-brand .brand-sub {
            font-size: 0.65rem;
            font-weight: 400;
            color: var(--white);
            letter-spacing: 1px;
        }

        .navbar-toggler {
            border: 2px solid var(--primary-yellow) !important;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .navbar-toggler-icon {
            background-image: none !important;
            width: 30px;
            height: 2px;
            background-color: var(--primary-yellow);
            display: block;
            position: relative;
            transition: all 0.3s;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            width: 30px;
            height: 2px;
            background-color: var(--primary-yellow);
            display: block;
            position: absolute;
            transition: all 0.3s;
        }

        .navbar-toggler-icon::before {
            top: -8px;
        }

        .navbar-toggler-icon::after {
            top: 8px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--white) !important;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-yellow);
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        .nav-link:hover {
            color: var(--primary-yellow) !important;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background: var(--primary-black);
            border: 2px solid var(--primary-yellow);
            border-radius: 0;
            margin-top: 0.5rem;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            color: var(--white);
            padding: 0.7rem 1.5rem;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .dropdown-item:hover {
            background: var(--primary-yellow);
            color: var(--primary-black);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            width: 20px;
        }

        .btn-donate {
            background: var(--primary-yellow);
            border: 2px solid var(--primary-yellow);
            padding: 0.6rem 1.5rem;
            color: var(--primary-black);
            font-weight: 700;
            transition: all 0.3s;
            border-radius: 50px;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .btn-donate:hover {
            background: transparent;
            color: var(--primary-yellow);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        /* Hero Section */
        #hero {
            background: linear-gradient(135deg, rgba(0,0,0,0.9), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920') center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            color: var(--white);
        }

        #hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, var(--primary-yellow) 0%, transparent 50%);
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content .badge-ulfa {
            background: var(--primary-yellow);
            color: var(--primary-black);
            padding: 0.5rem 1.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            color: var(--white);
        }

        .hero-content h1 .highlight {
            color: var(--primary-yellow);
            position: relative;
            display: inline-block;
        }

        .hero-content p.lead {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: rgba(255,255,255,0.9);
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .btn-hero {
            padding: 1rem 2.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            transition: all 0.3s;
            font-size: 1rem;
            border: 2px solid;
        }

        .btn-hero-primary {
            background: var(--primary-yellow);
            border-color: var(--primary-yellow);
            color: var(--primary-black);
        }

        .btn-hero-primary:hover {
            background: var(--dark-yellow);
            border-color: var(--dark-yellow);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        }

        .btn-hero-outline {
            background: transparent;
            border-color: var(--white);
            color: var(--white);
        }

        .btn-hero-outline:hover {
            background: var(--white);
            color: var(--primary-black);
            transform: translateY(-3px);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem 2rem;
            background: rgba(255, 193, 7, 0.1);
            border-left: 4px solid var(--primary-yellow);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            display: block;
            color: var(--primary-yellow);
            line-height: 1;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--white);
            margin-top: 0.5rem;
            display: block;
        }

        /* Section Styling */
        section {
            padding: 5rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title .badge-section {
            background: var(--light-yellow);
            color: var(--primary-black);
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-black);
            margin-bottom: 1rem;
        }

        .section-title p.subtitle {
            font-size: 1.1rem;
            color: var(--gray-text);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Mission & Vision Section */
        #mission {
            background: var(--gray-light);
        }

        .mission-card {
            background: var(--white);
            padding: 2.5rem;
            height: 100%;
            border-left: 5px solid var(--primary-yellow);
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .mission-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-black);
        }

        .mission-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-black);
        }

        .mission-card p {
            color: var(--gray-text);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Impact Stats Section */
        #impact {
            background: var(--primary-black);
            color: var(--white);
        }

        #impact .section-title h2,
        #impact .section-title .badge-section {
            color: var(--white);
            background: rgba(255, 193, 7, 0.2);
        }

        #impact .section-title p.subtitle {
            color: rgba(255,255,255,0.8);
        }

        .impact-card {
            text-align: center;
            padding: 2rem;
        }

        .impact-icon {
            width: 100px;
            height: 100px;
            background: var(--primary-yellow);
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary-black);
            border-radius: 50%;
        }

        .impact-number {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--primary-yellow);
            margin-bottom: 0.5rem;
        }

        .impact-label {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
        }

        /* Programs Section */
        #programs {
            background: var(--white);
        }

        .program-card {
            background: var(--white);
            border: 2px solid var(--gray-border);
            padding: 2rem;
            height: 100%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-yellow);
            transform: translateX(-100%);
            transition: all 0.3s;
        }

        .program-card:hover::before {
            transform: translateX(0);
        }

        .program-card:hover {
            border-color: var(--primary-yellow);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.2);
            transform: translateY(-5px);
        }

        .program-icon {
            width: 70px;
            height: 70px;
            background: var(--light-yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--primary-black);
            border: 2px solid var(--primary-yellow);
        }

        .program-card:hover .program-icon {
            background: var(--primary-yellow);
            transform: scale(1.1);
        }

        .program-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .program-card p {
            color: var(--gray-text);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .program-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .program-card ul li {
            padding: 0.5rem 0;
            color: var(--gray-dark);
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .program-card ul li i {
            color: var(--primary-yellow);
            font-size: 0.9rem;
        }

        .btn-learn-more {
            background: transparent;
            border: 2px solid var(--primary-black);
            color: var(--primary-black);
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
        }

        .btn-learn-more:hover {
            background: var(--primary-black);
            color: var(--primary-yellow);
        }

        /* Get Involved Section */
        #get-involved {
            background: var(--light-yellow);
        }

        .involvement-card {
            background: var(--white);
            padding: 2.5rem;
            text-align: center;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .involvement-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .involvement-icon {
            width: 90px;
            height: 90px;
            background: var(--primary-yellow);
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--white);
            border-radius: 50%;
            border: 5px solid rgba(255, 193, 7, 0.3);
        }

        .involvement-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .involvement-card p {
            color: var(--gray-text);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .btn-involvement {
            background: var(--primary-yellow);
            border: 2px solid var(--primary-yellow);
            color: var(--primary-black);
            padding: 0.8rem 2rem;
            font-weight: 700;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-involvement:hover {
            background: var(--primary-black);
            border-color: var(--primary-black);
            color: var(--primary-yellow);
        }

        /* Testimonials Section */
        #testimonials {
            background: var(--white);
        }

        .testimonial-card {
            background: var(--gray-light);
            padding: 2.5rem;
            height: 100%;
            position: relative;
            border-left: 4px solid var(--primary-yellow);
        }

        .testimonial-quote {
            font-size: 3rem;
            color: var(--primary-yellow);
            line-height: 1;
            margin-bottom: 1rem;
        }

        .testimonial-text {
            font-style: italic;
            color: var(--gray-dark);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-black);
            font-weight: 700;
        }

        .author-info h5 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .author-info p {
            margin: 0;
            color: var(--gray-text);
            font-size: 0.9rem;
        }

        /* Latest News Section */
        #news {
            background: var(--gray-light);
        }

        .news-card {
            background: var(--white);
            overflow: hidden;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .news-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }

        .news-image {
            height: 220px;
            background: var(--gray-border);
            overflow: hidden;
            position: relative;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s;
        }

        .news-card:hover .news-image img {
            transform: scale(1.1);
        }

        .news-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-yellow);
            color: var(--primary-black);
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .news-content {
            padding: 1.5rem;
        }

        .news-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: var(--gray-text);
        }

        .news-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .news-content h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .news-content h4 a {
            color: var(--primary-black);
            text-decoration: none;
            transition: all 0.3s;
        }

        .news-content h4 a:hover {
            color: var(--primary-yellow);
        }

        .news-content p {
            color: var(--gray-text);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .btn-read-more {
            color: var(--primary-black);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-read-more:hover {
            color: var(--primary-yellow);
            gap: 1rem;
        }

        /* CTA Section */
        #cta {
            background: linear-gradient(135deg, var(--primary-black), var(--gray-dark));
            color: var(--white);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        #cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, var(--primary-yellow) 0%, transparent 50%);
            opacity: 0.1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .cta-content h2 {
            font-size: 3rem;
            font-weight: 900;
            color: var(--white);
            margin-bottom: 1rem;
        }

        .cta-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: rgba(255,255,255,0.9);
        }

        /* Contact Section */
        #contact {
            background: var(--white);
        }

        .contact-info-card {
            background: var(--gray-light);
            padding: 2rem;
            height: 100%;
        }

        .contact-item {
            display: flex;
            align-items: start;
            gap: 1.5rem;
            padding: 1.5rem;
            background: var(--white);
            margin-bottom: 1rem;
            border-left: 3px solid var(--primary-yellow);
        }

        .contact-item-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--primary-black);
            flex-shrink: 0;
        }

        .contact-item-content h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .contact-item-content p {
            margin: 0;
            color: var(--gray-text);
        }

        .contact-form-card {
            background: var(--gray-light);
            padding: 2.5rem;
        }

        .contact-form .form-control {
            border: 2px solid var(--gray-border);
            padding: 0.9rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .contact-form .form-control:focus {
            border-color: var(--primary-yellow);
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
            outline: none;
        }

        .contact-form textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn-submit {
            background: var(--primary-yellow);
            border: 2px solid var(--primary-yellow);
            padding: 1rem 2.5rem;
            color: var(--primary-black);
            font-weight: 700;
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background: var(--primary-black);
            border-color: var(--primary-black);
            color: var(--primary-yellow);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Footer */
        footer {
            background: var(--primary-black);
            color: var(--white);
            padding: 3rem 0 1.5rem;
        }

        .footer-section h4 {
            color: var(--primary-yellow);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.7rem;
        }

        .footer-section ul li a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-section ul li a:hover {
            color: var(--primary-yellow);
            padding-left: 0.5rem;
        }

        .footer-section ul li a i {
            font-size: 0.8rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .social-link:hover {
            background: var(--primary-yellow);
            color: var(--primary-black);
            border-color: var(--primary-yellow);
            transform: translateY(-3px);
        }

        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255,255,255,0.6);
        }

        /* Alert Styles */
        .alert-custom {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 2px solid;
            font-weight: 500;
        }

        .alert-success {
            background: var(--light-yellow);
            color: var(--primary-black);
            border-color: var(--primary-yellow);
        }

        .alert-error {
            background: #ffe6e6;
            color: #c00;
            border-color: #c00;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .hero-stats {
                gap: 1.5rem;
            }

            .section-title h2 {
                font-size: 1.6rem;
            }

            .skills-list {
                grid-template-columns: 1fr;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }

        /* Badge/Tag Styles */
        .badge-custom {
            background: var(--black);
            color: var(--white);
            padding: 0.3rem 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .course-card:hover .badge-custom {
            background: var(--white);
            color: var(--black);
        }

        .course-duration {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-text);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .course-card:hover .course-duration {
            color: rgba(255,255,255,0.9);
        }

        .course-card:hover .price-sub {
            color: rgba(255,255,255,0.7);
        }

        /* Remove all rounded corners */
        .navbar,
        .btn-enroll,
        .course-card,
        .course-icon,
        .feature-card,
        .feature-icon,
        .contact-card,
        .contact-item,
        .contact-item i,
        .form-control,
        .btn-submit,
        .skill-item,
        .experience-section,
        .badge-custom,
        .instructor-card {
            border-radius: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#hero">
                Learn it with Muhindo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Instructor</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="btn btn-enroll ms-3" href="#contact">Enroll Now</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <h1>Master <span class="highlight">Programming with AI</span> This Holiday Season</h1>
                        <p>Join Learn it with Muhindo Academy and transform your career with cutting-edge courses in Web Design, Web Development, and Mobile App Development.</p>
                        <a href="#courses" class="btn btn-enroll btn-lg">
                            Explore Courses
                        </a>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <span class="stat-number">6</span>
                                <span class="stat-label">Weeks Duration</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Professional Courses</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">100%</span>
                                <span class="stat-label">Online Learning</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="text-center">
                        <i class="fas fa-laptop-code" style="font-size: 15rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses">
        <div class="container">
            <div class="section-title">
                <h2>Our Professional Courses!</h2>
                <p>Choose from our comprehensive programs designed to make you job-ready</p>
            </div>

            <!-- Course Introduction Video -->
            <div class="row mb-5">
                <div class="col-12">
                    <div style="background: var(--black); padding: 2rem; margin-bottom: 2rem;">
                        <h3 style="color: var(--white); margin-bottom: 1.5rem; text-align: center;">Course Introduction</h3>
                        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background: #000;">
                            <iframe 
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                src="https://www.youtube.com/embed/0MLfJ3fKGgs" 
                                title="Course Introduction Video" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Course 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <span class="badge-custom">BEGINNER FRIENDLY</span>
                        <h3>Web Design</h3>
                        <div class="course-duration">
                            <i class="fas fa-clock"></i>
                            <span>6 Weeks • Online</span>
                        </div>
                        <ul class="course-topics">
                            <li><i class="fas fa-check-circle"></i> HTML & CSS Fundamentals</li>
                            <li><i class="fas fa-check-circle"></i> Bootstrap Framework</li>
                            <li><i class="fas fa-check-circle"></i> JavaScript Basics</li>
                            <li><i class="fas fa-check-circle"></i> Responsive Design</li>
                            <li><i class="fas fa-check-circle"></i> Final Project Portfolio</li>
                        </ul>
                        <div class="course-price">
                            <div>
                                <span class="price-tag">$100</span>
                                <span class="price-sub">UGX 300,000</span>
                            </div>
                            <a href="#contact" class="btn btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <span class="badge-custom">INTERMEDIATE</span>
                        <h3>Web System Development</h3>
                        <div class="course-duration">
                            <i class="fas fa-clock"></i>
                            <span>6 Weeks • Online</span>
                        </div>
                        <ul class="course-topics">
                            <li><i class="fas fa-check-circle"></i> PHP Programming</li>
                            <li><i class="fas fa-check-circle"></i> MySQL Database</li>
                            <li><i class="fas fa-check-circle"></i> Laravel Framework</li>
                            <li><i class="fas fa-check-circle"></i> Backend Development</li>
                            <li><i class="fas fa-check-circle"></i> Complete Web System Project</li>
                        </ul>
                        <div class="course-price">
                            <div>
                                <span class="price-tag">$120</span>
                                <span class="price-sub">UGX 400,000</span>
                            </div>
                            <a href="#contact" class="btn btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <span class="badge-custom">ADVANCED</span>
                        <h3>Mobile App Development</h3>
                        <div class="course-duration">
                            <i class="fas fa-clock"></i>
                            <span>6 Weeks • Online</span>
                        </div>
                        <ul class="course-topics">
                            <li><i class="fas fa-check-circle"></i> Dart Programming</li>
                            <li><i class="fas fa-check-circle"></i> Flutter Framework</li>
                            <li><i class="fas fa-check-circle"></i> UI/UX Design for Mobile</li>
                            <li><i class="fas fa-check-circle"></i> Firebase Integration</li>
                            <li><i class="fas fa-check-circle"></i> Complete Mobile App Project</li>
                        </ul>
                        <div class="course-price">
                            <div>
                                <span class="price-tag">$130</span>
                                <span class="price-sub">UGX 350,000</span>
                            </div>
                            <a href="#contact" class="btn btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Us?</h2>
                <p>Get the best learning experience with industry-standard practices</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h4>Online Learning</h4>
                        <p>Learn via Zoom, Google Meet, and pre-recorded videos</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>Certificate</h4>
                        <p>Receive a certificate of completion after finishing</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h4>Flexible Payment</h4>
                        <p>Pay 50% upfront and the rest during the course</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h4>Real Projects</h4>
                        <p>Build actual projects to showcase in your portfolio</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About/Instructor Section -->
    <section id="about">
        <div class="container">
            <div class="section-title">
                <h2>Meet Your Instructor</h2>
                <p>Learn from an experienced full-stack developer with 8+ years of industry experience</p>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="instructor-card">
                        <h3>Muhindo Mubarak</h3>
                        <p class="instructor-title">Full Stack Developer | Lead Developer at Eight Tech Consults Ltd</p>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4>Education</h4>
                                <ul style="list-style: none; padding-left: 0;">
                                    <li>• Masters in Computer Science (Ongoing) - Makerere University</li>
                                    <li>• Bachelor of Computer Science - Islamic University of Technology</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>Experience</h4>
                                <ul style="list-style: none; padding-left: 0;">
                                    <li>• 8+ Years Professional Development</li>
                                    <li>• Lead Developer - 14+ Major Projects</li>
                                    <li>• YouTube Educator - "Learn it with Muhindo"</li>
                                </ul>
                            </div>
                        </div>

                        <h4 class="mb-3">Technical Expertise</h4>
                        <div class="skills-list">
                            <div class="skill-item">
                                PHP, Laravel, Python Django
                            </div>
                            <div class="skill-item">
                                React.js, Vue.js, JavaScript
                            </div>
                            <div class="skill-item">
                                Flutter, Dart, Mobile Development
                            </div>
                            <div class="skill-item">
                                MySQL, Firebase, Database Design
                            </div>
                            <div class="skill-item">
                                HTML, CSS, Bootstrap, UI/UX
                            </div>
                            <div class="skill-item">
                                WordPress Development
                            </div>
                        </div>

                        <div class="experience-section">
                            <h4>Notable Projects</h4>
                            <div class="experience-list">
                                <div class="mb-3">
                                    <strong>School Dynamics</strong> - Complete school management system (Web & Mobile)
                                </div>
                                <div class="mb-3">
                                    <strong>Uganda Livestock System</strong> - Comprehensive livestock management platform
                                </div>
                                <div class="mb-3">
                                    <strong>Hospital Management System</strong> - Full-featured healthcare solution
                                </div>
                                <div class="mb-3">
                                    <strong>E-commerce Platforms</strong> - Multiple online store solutions
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Enroll Now</h2>
                <p>Ready to start your programming journey? Get in touch with us today!</p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-card">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h4 class="mb-3">Contact Information</h4>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>Email</strong>
                                        <p class="mb-0">muhindo@8technologies.net</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <strong>Phone</strong>
                                        <p class="mb-0">+256 783 204665</p>
                                        <p class="mb-0">+256 706 638484</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong>Location</strong>
                                        <p class="mb-0">Kampala, Uganda</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fab fa-youtube"></i>
                                    <div>
                                        <strong>YouTube Channel</strong>
                                        <p class="mb-0">Learn it with Muhindo</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-3">Send a Message</h4>
                                <div id="enrollmentAlert" style="display: none; padding: 1rem; margin-bottom: 1rem; border: 2px solid #000;"></div>
                                <form class="contact-form" id="enrollForm">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                                    <select class="form-control" name="course" id="course" required>
                                        <option value="">Select Course</option>
                                        <option value="web-design">Web Design ($100)</option>
                                        <option value="web-development">Web System Development ($120)</option>
                                        <option value="mobile-app">Mobile App Development ($130)</option>
                                    </select>
                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Message (Optional)"></textarea>
                                    <button type="submit" class="btn btn-submit" id="submitBtn">
                                        Submit Enrollment
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Learn it with Muhindo Academy. All Rights Reserved.</p>
            <p>Empowering the Next Generation of Developers</p>
            <div class="mt-3">
                <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-2x"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin fa-2x"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Show enrollment alert
        function showEnrollmentAlert(result) {
            const alertDiv = document.getElementById('enrollmentAlert');
            const submitBtn = document.getElementById('submitBtn');
            
            alertDiv.textContent = result.message;
            alertDiv.style.display = 'block';
            alertDiv.style.background = result.success ? '#000' : '#fff';
            alertDiv.style.color = result.success ? '#fff' : '#000';
            alertDiv.style.borderColor = result.success ? '#000' : '#f00';
            
            // Scroll to the alert
            alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Hide after 10 seconds
            setTimeout(function() {
                alertDiv.style.display = 'none';
            }, 10000);

            // Reset form if successful
            if (result.success) {
                document.getElementById('enrollForm').reset();
            }
            
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Enrollment';
        }

        // Handle form submission via AJAX
        document.getElementById('enrollForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const alertDiv = document.getElementById('enrollmentAlert');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            
            // Hide previous alert
            alertDiv.style.display = 'none';
            
            // Get form data
            const formData = new FormData();
            formData.append('action', 'enroll');
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('course', document.getElementById('course').value);
            formData.append('message', document.getElementById('message').value);
            
            // Send AJAX request
            fetch('enroll.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.text();
            })
            .then(text => {
                console.log('Server response:', text);
                try {
                    const data = JSON.parse(text);
                    showEnrollmentAlert(data);
                } catch (e) {
                    console.error('JSON parse error:', e);
                    console.error('Response text:', text);
                    showEnrollmentAlert({
                        success: false,
                        message: 'Server error: Invalid response format'
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showEnrollmentAlert({
                    success: false,
                    message: 'Connection error: ' + error.message
                });
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 2px 0 #000';
            } else {
                navbar.style.boxShadow = '0 1px 0 #ddd';
            }
        });
    </script>
</body>
</html>
