<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULFA - United Love for All Orphanage Centre | Empowering Children in Uganda</title>
    <meta name="description" content="United Love for All (ULFA) provides love, care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #1a1a1a; overflow-x: hidden; }
        
        :root {
            --primary-yellow: #FFC107;
            --primary-black: #000000;
            --dark-yellow: #FFB300;
            --light-yellow: #FFF9E6;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-text: #6c757d;
        }
        
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--primary-black); }
        
        html { scroll-behavior: smooth; }
        
        /* Navigation */
        .navbar { background: var(--primary-black) !important; padding: 1rem 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s; }
        .navbar.scrolled { padding: 0.5rem 0; }
        .navbar-brand { font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 1.5rem; color: var(--primary-yellow) !important; display: flex; align-items: center; gap: 0.5rem; }
        .navbar-brand i { font-size: 1.8rem; }
        .navbar-brand .brand-main { font-size: 1.5rem; font-weight: 800; }
        .navbar-brand .brand-sub { font-size: 0.65rem; font-weight: 400; color: var(--white); letter-spacing: 1px; display: block; }
        .navbar-toggler { border: 2px solid var(--primary-yellow) !important; }
        .navbar-toggler-icon { background-image: none !important; width: 30px; height: 2px; background-color: var(--primary-yellow); display: block; position: relative; }
        .navbar-toggler-icon::before, .navbar-toggler-icon::after { content: ''; width: 30px; height: 2px; background-color: var(--primary-yellow); display: block; position: absolute; }
        .navbar-toggler-icon::before { top: -8px; }
        .navbar-toggler-icon::after { top: 8px; }
        .nav-link { font-weight: 500; color: var(--white) !important; margin: 0 0.5rem; padding: 0.5rem 1rem !important; transition: all 0.3s; position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: 0; left: 50%; width: 0; height: 2px; background: var(--primary-yellow); transition: all 0.3s; transform: translateX(-50%); }
        .nav-link:hover::after, .nav-link.active::after { width: 80%; }
        .nav-link:hover { color: var(--primary-yellow) !important; }
        .dropdown { position: relative; }
        .dropdown:hover .dropdown-menu { display: block; opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-menu { background: var(--primary-black); border: 3px solid var(--primary-yellow); margin-top: 0; display: block; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s; }
        .dropdown-toggle::after { display: none; }
        .dropdown-toggle .dropdown-icon { display: inline-block; width: 10px; height: 10px; border: 2px solid var(--white); border-left: 0; border-top: 0; transform: rotate(45deg); margin-left: 0.4rem; margin-bottom: 2px; transition: all 0.3s; }
        .dropdown:hover .dropdown-toggle .dropdown-icon { border-color: var(--primary-yellow); transform: rotate(45deg) translateY(2px); }
        .dropdown-item { color: var(--white); padding: 0.7rem 1.5rem; transition: all 0.3s; }
        .dropdown-item:hover { background: var(--primary-yellow); color: var(--primary-black); }
        .dropdown-item i { margin-right: 0.5rem; width: 20px; }
        .btn-donate { background: var(--primary-yellow); border: 3px solid var(--primary-yellow); padding: 0.6rem 1.5rem; color: var(--primary-black); font-weight: 700; transition: all 0.3s; text-transform: uppercase; font-size: 0.9rem; position: relative; overflow: hidden; z-index: 1; }
        .btn-donate::before { content: ''; position: absolute; inset: 0; background: var(--primary-black); transform: translateY(100%); transition: transform 0.3s; z-index: -1; }
        .btn-donate:hover::before { transform: translateY(0); }
        .btn-donate:hover { color: var(--primary-yellow); border-color: var(--primary-black); }
        .btn-donate span, .btn-donate i { position: relative; }
        
        /* Hero */
        #hero { background: var(--primary-black); min-height: 100vh; display: flex; align-items: center; padding-top: 80px; color: var(--white); position: relative; overflow: hidden; }
        #hero::before { content: ''; position: absolute; top: -50%; right: -20%; width: 60%; height: 150%; background: var(--primary-yellow); opacity: 0.08; transform: rotate(-15deg); }
        .hero-content { position: relative; z-index: 2; }
        .hero-content .badge-ulfa { background: var(--primary-yellow); color: var(--primary-black); padding: 0.5rem 1.5rem; font-weight: 700; font-size: 0.9rem; letter-spacing: 1px; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase; }
        .hero-content h1 { font-size: 3.5rem; font-weight: 900; margin-bottom: 1.5rem; line-height: 1.2; color: var(--white); }
        .hero-content h1 .highlight { color: var(--primary-yellow); }
        .hero-content p.lead { font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9); line-height: 1.7; }
        .hero-buttons { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem; }
        .btn-hero { padding: 1rem 2.5rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; border: 3px solid; position: relative; overflow: hidden; z-index: 1; }
        .btn-hero::after { content: ''; position: absolute; inset: 0; transition: transform 0.3s; z-index: -1; }
        .btn-hero span { position: relative; }
        .btn-hero-primary { background: var(--primary-yellow); border-color: var(--primary-yellow); color: var(--primary-black); }
        .btn-hero-primary::after { background: var(--primary-black); transform: translateX(-100%); }
        .btn-hero-primary:hover::after { transform: translateX(0); }
        .btn-hero-primary:hover { color: var(--primary-yellow); }
        .btn-hero-outline { background: transparent; border-color: var(--white); color: var(--white); }
        .btn-hero-outline::after { background: var(--white); transform: translateX(100%); }
        .btn-hero-outline:hover::after { transform: translateX(0); }
        .btn-hero-outline:hover { color: var(--primary-black); border-color: var(--white); }
        .hero-stats { display: flex; gap: 3rem; flex-wrap: wrap; }
        .stat-item { text-align: center; padding: 1.5rem 2rem; background: transparent; border: 3px solid var(--primary-yellow); transition: all 0.3s; cursor: pointer; }
        .stat-item:hover { background: var(--primary-yellow); }
        .stat-item:hover .stat-number { color: var(--primary-black); }
        .stat-item:hover .stat-label { color: var(--primary-black); }
        .stat-number { font-size: 3rem; font-weight: 900; display: block; color: var(--primary-yellow); line-height: 1; }
        .stat-label { font-size: 1rem; color: var(--white); margin-top: 0.5rem; display: block; }
        
        /* Sections */
        section { padding: 5rem 0; }
        .section-title { text-align: center; margin-bottom: 3rem; }
        .section-title .badge-section { background: var(--light-yellow); color: var(--primary-black); padding: 0.5rem 1.5rem; font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; display: inline-block; margin-bottom: 1rem; text-transform: uppercase; }
        .section-title h2 { font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; }
        .section-title p.subtitle { font-size: 1.1rem; color: var(--gray-text); max-width: 700px; margin: 0 auto; }
        
        /* Mission */
        #mission { background: var(--gray-light); }
        .mission-card { background: var(--white); padding: 2.5rem; height: 100%; border: 3px solid var(--gray-border); transition: all 0.3s; position: relative; overflow: hidden; }
        .mission-card::before { content: ''; position: absolute; left: 0; top: 0; width: 8px; height: 0; background: var(--primary-yellow); transition: height 0.3s; }
        .mission-card:hover::before { height: 100%; }
        .mission-card:hover { border-color: var(--primary-yellow); background: var(--light-yellow); }
        .mission-icon { width: 80px; height: 80px; background: var(--primary-yellow); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin-bottom: 1.5rem; color: var(--primary-black); }
        .mission-card h3 { font-size: 1.8rem; margin-bottom: 1rem; }
        .mission-card p { color: var(--gray-text); line-height: 1.8; font-size: 1.05rem; }
        
        /* Impact */
        #impact { background: var(--primary-black); color: var(--white); position: relative; }
        #impact::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: var(--primary-yellow); }
        #impact .section-title h2 { color: var(--white); }
        #impact .section-title .badge-section { background: rgba(255, 193, 7, 0.2); }
        #impact .section-title p.subtitle { color: rgba(255,255,255,0.8); }
        .impact-card { text-align: center; padding: 2rem; }
        .impact-icon { width: 100px; height: 100px; background: var(--primary-yellow); margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: var(--primary-black); border: 4px solid var(--primary-yellow); transition: all 0.3s; }
        .impact-card:hover .impact-icon { background: transparent; color: var(--primary-yellow); transform: scale(1.1); }
        .impact-number { font-size: 3.5rem; font-weight: 900; color: var(--primary-yellow); margin-bottom: 0.5rem; }
        .impact-label { font-size: 1.1rem; color: rgba(255,255,255,0.9); }
        
        /* Programs */
        .program-card { background: var(--white); border: 3px solid var(--primary-black); padding: 2rem; height: 100%; transition: all 0.3s; position: relative; }
        .program-card:hover { background: var(--primary-black); border-color: var(--primary-yellow); }
        .program-card:hover h3, .program-card:hover p { color: var(--white); }
        .program-card:hover .program-icon { background: var(--primary-yellow); border-color: var(--primary-yellow); }
        .program-icon { width: 70px; height: 70px; background: var(--primary-yellow); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.5rem; color: var(--primary-black); border: 3px solid var(--primary-black); transition: all 0.3s; }
        .program-card h3 { font-size: 1.5rem; margin-bottom: 1rem; }
        .program-card p { color: var(--gray-text); line-height: 1.7; }
        
        /* Get Involved */
        #get-involved { background: var(--light-yellow); }
        .involvement-card { background: var(--white); padding: 2.5rem; text-align: center; height: 100%; border: 3px solid var(--primary-black); transition: all 0.3s; }
        .involvement-card:hover { background: var(--primary-yellow); border-color: var(--primary-yellow); }
        .involvement-card:hover .involvement-icon { background: var(--primary-black); color: var(--primary-yellow); }
        .involvement-icon { width: 90px; height: 90px; background: var(--primary-black); margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: var(--primary-yellow); border: 3px solid var(--primary-black); transition: all 0.3s; }
        .involvement-card h4 { font-size: 1.5rem; margin-bottom: 1rem; }
        .btn-involvement { background: var(--primary-black); border: 3px solid var(--primary-black); color: var(--primary-yellow); padding: 0.8rem 2rem; font-weight: 700; transition: all 0.3s; text-transform: uppercase; text-decoration: none; display: inline-block; position: relative; overflow: hidden; z-index: 1; }
        .btn-involvement::before { content: ''; position: absolute; inset: 0; background: var(--primary-yellow); z-index: -1; transform: scaleX(0); transform-origin: left; transition: transform 0.3s; }
        .btn-involvement:hover::before { transform: scaleX(1); }
        .btn-involvement:hover { color: var(--primary-black); border-color: var(--primary-black); }
        
        /* Testimonials */
        .testimonial-card { background: var(--white); padding: 2.5rem; height: 100%; border: 3px solid var(--primary-black); transition: all 0.3s; }
        .testimonial-card:hover { background: var(--primary-yellow); border-color: var(--primary-yellow); }
        .testimonial-quote { font-size: 3rem; color: var(--primary-yellow); line-height: 1; }
        .testimonial-text { font-style: italic; color: #343a40; font-size: 1.1rem; line-height: 1.7; margin: 1rem 0 1.5rem; }
        .author-avatar { width: 60px; height: 60px; background: var(--primary-black); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary-yellow); font-weight: 700; border: 3px solid var(--primary-black); }
        .testimonial-author { display: flex; align-items: center; gap: 1rem; }
        
        /* News */
        #news { background: var(--gray-light); }
        .news-card { background: var(--white); overflow: hidden; height: 100%; border: 3px solid var(--primary-black); transition: all 0.3s; }
        .news-card:hover { border-color: var(--primary-yellow); background: var(--light-yellow); }
        .news-image { height: 220px; background: #dee2e6; overflow: hidden; position: relative; }
        .news-badge { position: absolute; top: 1rem; left: 1rem; background: var(--primary-yellow); color: var(--primary-black); padding: 0.4rem 1rem; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }
        .news-content { padding: 1.5rem; }
        .news-meta { display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.85rem; color: var(--gray-text); }
        .news-content h4 { font-size: 1.3rem; margin-bottom: 0.8rem; }
        .news-content h4 a { color: var(--primary-black); text-decoration: none; }
        .news-content h4 a:hover { color: var(--primary-yellow); }
        
        /* CTA */
        #cta { background: var(--primary-yellow); color: var(--primary-black); position: relative; border-top: 5px solid var(--primary-black); border-bottom: 5px solid var(--primary-black); }
        .cta-content { position: relative; z-index: 2; text-align: center; }
        .cta-content h2 { font-size: 3rem; font-weight: 900; color: var(--primary-black); margin-bottom: 1rem; }
        .cta-content p { color: var(--primary-black); }
        
        /* Contact */
        .contact-item { display: flex; align-items: start; gap: 1.5rem; padding: 1.5rem; background: var(--white); margin-bottom: 1rem; border: 3px solid var(--primary-black); transition: all 0.3s; }
        .contact-item:hover { background: var(--primary-black); border-color: var(--primary-yellow); }
        .contact-item:hover .contact-item-icon { background: var(--primary-yellow); color: var(--primary-black); }
        .contact-item:hover h5, .contact-item:hover p { color: var(--white); }
        .contact-item-icon { width: 50px; height: 50px; background: var(--primary-yellow); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--primary-black); }
        .contact-form .form-control { border: 3px solid var(--primary-black); padding: 0.9rem; margin-bottom: 1rem; transition: all 0.3s; background: var(--white); }
        .contact-form .form-control:focus { border-color: var(--primary-yellow); background: var(--light-yellow); outline: none; }
        .btn-submit { background: var(--primary-yellow); border: 3px solid var(--primary-yellow); padding: 1rem 2.5rem; color: var(--primary-black); font-weight: 700; width: 100%; transition: all 0.3s; text-transform: uppercase; position: relative; overflow: hidden; z-index: 1; }
        .btn-submit::before { content: ''; position: absolute; inset: 0; background: var(--primary-black); transform: translateY(100%); transition: transform 0.3s; z-index: -1; }
        .btn-submit:hover::before { transform: translateY(0); }
        .btn-submit:hover { color: var(--primary-yellow); border-color: var(--primary-black); }
        
        /* Footer */
        footer { background: var(--primary-black); color: var(--white); padding: 3rem 0 1.5rem; }
        .footer-section h4 { color: var(--primary-yellow); font-size: 1.3rem; margin-bottom: 1.5rem; }
        .footer-section ul { list-style: none; padding: 0; }
        .footer-section ul li { margin-bottom: 0.7rem; }
        .footer-section ul li a { color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s; }
        .footer-section ul li a:hover { color: var(--primary-yellow); padding-left: 0.5rem; }
        .social-link { width: 45px; height: 45px; background: transparent; border: 3px solid var(--primary-yellow); display: flex; align-items: center; justify-content: center; color: var(--primary-yellow); text-decoration: none; transition: all 0.3s; }
        .social-link:hover { background: var(--primary-yellow); color: var(--primary-black); border-color: var(--primary-yellow); }
        .footer-bottom { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); text-align: center; color: rgba(255,255,255,0.6); }
        
        .alert-custom { padding: 1.5rem; margin-bottom: 1.5rem; border: 3px solid; font-weight: 500; display: none; }
        .alert-success { background: var(--primary-yellow); color: var(--primary-black); border-color: var(--primary-black); }
        .alert-error { background: var(--white); color: #c00; border-color: #c00; }
        
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2rem; }
            .hero-buttons { flex-direction: column; }
            .btn-hero { width: 100%; }
            section { padding: 3rem 0; }
            .cta-content h2 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#hero">
                <i class="fas fa-hands-helping"></i>
                <span>
                    <span class="brand-main">ULFA</span>
                    <span class="brand-sub">United Love for All</span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">About Us<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#mission"><i class="fas fa-bullseye"></i>Mission & Vision</a></li>
                            <li><a class="dropdown-item" href="#impact"><i class="fas fa-chart-line"></i>Our Impact</a></li>
                            <li><a class="dropdown-item" href="#about"><i class="fas fa-users"></i>Our Team</a></li>
                            <li><a class="dropdown-item" href="#testimonials"><i class="fas fa-comments"></i>Stories</a></li>
                            <li><a class="dropdown-item" href="#news"><i class="fas fa-newspaper"></i>News</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Our Programs<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#programs"><i class="fas fa-graduation-cap"></i>Education Support</a></li>
                            <li><a class="dropdown-item" href="#programs"><i class="fas fa-child"></i>Child Welfare</a></li>
                            <li><a class="dropdown-item" href="#programs"><i class="fas fa-home"></i>Orphanage Development</a></li>
                            <li><a class="dropdown-item" href="#programs"><i class="fas fa-seedling"></i>Agriculture Projects</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Get Involved<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#get-involved"><i class="fas fa-donate"></i>Donate Now</a></li>
                            <li><a class="dropdown-item" href="#get-involved"><i class="fas fa-hand-holding-heart"></i>Volunteer</a></li>
                            <li><a class="dropdown-item" href="#get-involved"><i class="fas fa-handshake"></i>Partner With Us</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-donate" href="#get-involved"><i class="fas fa-heart me-2"></i>Donate Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <span class="badge-ulfa">NGO Registered Under Uganda NGO Act, 2016</span>
                        <h1>Empowering <span class="highlight">Orphaned Children</span> Through Love, Care & Education</h1>
                        <p class="lead">United Love for All (ULFA) Orphanage Centre provides sustainable support to vulnerable children in Mpondwe Lhubiriha, Kasese District, Uganda.</p>
                        <div class="hero-buttons">
                            <a href="#get-involved" class="btn btn-hero btn-hero-primary">Donate Now</a>
                            <a href="#programs" class="btn btn-hero btn-hero-outline">Our Programs</a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Children Helped</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">5</span>
                                <span class="stat-label">Core Programs</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">10+</span>
                                <span class="stat-label">Years of Service</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section id="mission">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Our Foundation</span>
                <h2>Mission & Vision</h2>
                <p class="subtitle">Building a brighter future for Uganda's orphaned and vulnerable children</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p>A Uganda where all children are loved, protected, educated, and empowered to reach their full potential regardless of their background or circumstances.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-heart"></i></div>
                        <h3>Our Mission</h3>
                        <p>To provide love, care, education, and sustainable support to orphaned and vulnerable children while promoting dignity, safety, and community development in Kasese District and beyond.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats Section -->
    <section id="impact">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Making A Difference</span>
                <h2>Our Impact in Numbers</h2>
                <p class="subtitle">See how your support transforms lives every single day</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-child"></i></div>
                        <div class="impact-number">500+</div>
                        <div class="impact-label">Children Supported</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="impact-number">350</div>
                        <div class="impact-label">Students in School</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-utensils"></i></div>
                        <div class="impact-number">1000+</div>
                        <div class="impact-label">Meals Served Daily</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-hands-helping"></i></div>
                        <div class="impact-number">50+</div>
                        <div class="impact-label">Active Volunteers</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">What We Do</span>
                <h2>Our Core Programs</h2>
                <p class="subtitle">Comprehensive support programs designed to transform lives</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-book-open"></i></div>
                        <h3>Education Support</h3>
                        <p>Providing books, uniforms, scholastic materials, and school fees for orphaned children to access quality education.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>Child Welfare & Protection</h3>
                        <p>Ensuring every child's safety, health, and wellbeing through comprehensive care and protection services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-home"></i></div>
                        <h3>Orphanage Development</h3>
                        <p>Building and maintaining safe, loving homes where children can grow, learn, and thrive.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-leaf"></i></div>
                        <h3>Agricultural Sustainability</h3>
                        <p>Teaching sustainable farming practices to ensure long-term food security and self-reliance.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-people-carry"></i></div>
                        <h3>Community Engagement</h3>
                        <p>Building awareness and mobilizing communities to support vulnerable children and families.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-heartbeat"></i></div>
                        <h3>Healthcare Services</h3>
                        <p>Providing access to medical care, nutrition programs, and health education for all children.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Get Involved Section -->
    <section id="get-involved">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Join Us</span>
                <h2>How You Can Help</h2>
                <p class="subtitle">There are many ways you can make a difference in a child's life</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="involvement-card">
                        <div class="involvement-icon"><i class="fas fa-donate"></i></div>
                        <h4>Donate</h4>
                        <p>Your financial support helps us provide food, education, and shelter to children in need.</p>
                        <a href="#contact" class="btn-involvement">Donate Now</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="involvement-card">
                        <div class="involvement-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4>Volunteer</h4>
                        <p>Share your time and skills to directly impact the lives of our children.</p>
                        <a href="#contact" class="btn-involvement">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="involvement-card">
                        <div class="involvement-icon"><i class="fas fa-user-friends"></i></div>
                        <h4>Sponsor a Child</h4>
                        <p>Create a lasting impact by sponsoring a child's education and wellbeing.</p>
                        <a href="#contact" class="btn-involvement">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="involvement-card">
                        <div class="involvement-icon"><i class="fas fa-handshake"></i></div>
                        <h4>Partner With Us</h4>
                        <p>Join forces with ULFA as a corporate or organizational partner.</p>
                        <a href="#contact" class="btn-involvement">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Success Stories</span>
                <h2>Lives Transformed</h2>
                <p class="subtitle">Hear from those whose lives have been touched by ULFA</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">ULFA gave me hope when I had none. They provided education, love, and a family. Today, I'm in university studying medicine to give back to my community.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">JM</div>
                            <div>
                                <h5>Jane Mugisha</h5>
                                <p>Former Beneficiary, Now Medical Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">As a volunteer, I've witnessed the incredible transformation in these children. ULFA doesn't just provide shelter, they provide love, dignity, and opportunity.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">RK</div>
                            <div>
                                <h5>Robert Kiiza</h5>
                                <p>Volunteer & Supporter</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">Our organization has partnered with ULFA for 5 years. Their transparency, dedication, and impact are remarkable. Every donation truly makes a difference.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">SM</div>
                            <div>
                                <h5>Sarah Namuli</h5>
                                <p>Corporate Partner Representative</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Latest Updates</span>
                <h2>News & Events</h2>
                <p class="subtitle">Stay informed about our latest activities and success stories</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-image">
                            <span class="news-badge">News</span>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span><i class="far fa-calendar"></i> Jan 15, 2026</span>
                                <span><i class="far fa-user"></i> ULFA Team</span>
                            </div>
                            <h4><a href="#">50 New Students Enrolled for 2026 Academic Year</a></h4>
                            <p>We're thrilled to announce that 50 more children have joined our education program, bringing hope and opportunity to their lives...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-image">
                            <span class="news-badge">Event</span>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span><i class="far fa-calendar"></i> Jan 10, 2026</span>
                                <span><i class="far fa-user"></i> Admin</span>
                            </div>
                            <h4><a href="#">Annual Fundraising Gala Success</a></h4>
                            <p>Our annual fundraising gala raised over UGX 50M, enabling us to expand our programs and reach more children in need...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <div class="news-image">
                            <span class="news-badge">Achievement</span>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span><i class="far fa-calendar"></i> Dec 20, 2025</span>
                                <span><i class="far fa-user"></i> ULFA Team</span>
                            </div>
                            <h4><a href="#">New Agricultural Project Launched</a></h4>
                            <p>Our sustainable agriculture initiative now provides fresh food daily while teaching children valuable farming skills...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Make a Difference?</h2>
                <p>Join us in transforming the lives of orphaned and vulnerable children</p>
                <div class="hero-buttons justify-content-center mt-4">
                    <a href="#contact" class="btn btn-hero btn-hero-primary">Get in Touch</a>
                    <a href="#programs" class="btn btn-hero btn-hero-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">Get in Touch</span>
                <h2>Contact Us</h2>
                <p class="subtitle">We'd love to hear from you. Reach out for inquiries, partnerships, or donations</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Our Location</h5>
                            <p>Mpondwe Lhubiriha Town Council<br>Kasese District, Uganda</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5>Phone</h5>
                            <p>+256 XXX XXXXXX<br>+256 XXX XXXXXX</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email</h5>
                            <p>info@ulfa-uganda.org<br>contact@ulfa-uganda.org</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h5>Working Hours</h5>
                            <p>Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday: 9:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="alert-custom" id="contactAlert"></div>
                    <form class="contact-form" id="contactForm">
                        <input type="text" class="form-control" name="name" placeholder="Your Full Name *" required>
                        <input type="email" class="form-control" name="email" placeholder="Your Email Address *" required>
                        <input type="tel" class="form-control" name="phone" placeholder="Phone Number *" required>
                        <select class="form-control" name="subject" required>
                            <option value="">Select Inquiry Type *</option>
                            <option value="donation">Make a Donation</option>
                            <option value="volunteer">Volunteer Opportunity</option>
                            <option value="sponsor">Sponsor a Child</option>
                            <option value="partnership">Partnership Inquiry</option>
                            <option value="general">General Inquiry</option>
                        </select>
                        <textarea class="form-control" name="message" rows="5" placeholder="Your Message *" required></textarea>
                        <button type="submit" class="btn btn-submit" id="submitBtn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-section">
                        <h4>About ULFA</h4>
                        <p style="color: rgba(255,255,255,0.7);">United Love for All (ULFA) Orphanage Centre is a registered NGO dedicated to providing love, care, education, and sustainable support to orphaned and vulnerable children in Uganda.</p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#hero">Home</a></li>
                            <li><a href="#mission">About Us</a></li>
                            <li><a href="#programs">Programs</a></li>
                            <li><a href="#news">News</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4>Our Programs</h4>
                        <ul>
                            <li><a href="#programs">Education Support</a></li>
                            <li><a href="#programs">Child Welfare</a></li>
                            <li><a href="#programs">Orphanage Development</a></li>
                            <li><a href="#programs">Agriculture Projects</a></li>
                            <li><a href="#programs">Community Engagement</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4>Get Involved</h4>
                        <ul>
                            <li><a href="#get-involved">Donate Now</a></li>
                            <li><a href="#get-involved">Volunteer</a></li>
                            <li><a href="#get-involved">Sponsor a Child</a></li>
                            <li><a href="#get-involved">Partner With Us</a></li>
                            <li><a href="admin.php">Admin Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 United Love for All (ULFA) Orphanage Centre. All Rights Reserved.</p>
                <p>Registered NGO under Uganda NGO Act, 2016 | Kasese District, Uganda</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Close mobile menu
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(navbarCollapse).hide();
                    }
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const alertDiv = document.getElementById('contactAlert');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            alertDiv.style.display = 'none';
            
            const formData = new FormData();
            formData.append('action', 'contact');
            formData.append('name', this.name.value);
            formData.append('email', this.email.value);
            formData.append('phone', this.phone.value);
            formData.append('subject', this.subject.value);
            formData.append('message', this.message.value);
            
            fetch('enroll.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alertDiv.textContent = data.message;
                alertDiv.className = 'alert-custom ' + (data.success ? 'alert-success' : 'alert-error');
                alertDiv.style.display = 'block';
                alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                if (data.success) {
                    document.getElementById('contactForm').reset();
                }
                
                setTimeout(() => { alertDiv.style.display = 'none'; }, 10000);
            })
            .catch(error => {
                alertDiv.textContent = 'Connection error. Please try again.';
                alertDiv.className = 'alert-custom alert-error';
                alertDiv.style.display = 'block';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Send Message';
            });
        });

        // Active nav link on scroll
        window.addEventListener('scroll', () => {
            let current = '';
            document.querySelectorAll('section').forEach(section => {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>