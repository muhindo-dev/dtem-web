<?php
$currentPage = 'network';
$pageTitle = 'Network & Leadership';
include 'config.php';
include 'functions.php';

$pageDescription = 'Learn about the DTEHM network and leadership structure - become a sponsor, stockist, or leader in our growing health community.';
include 'includes/header.php';

// Get member stats
$totalMembers = $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'active'")->fetchColumn();
$totalSponsors = $pdo->query("SELECT COUNT(DISTINCT sponsor_id) FROM users WHERE sponsor_id IS NOT NULL AND sponsor_id != 0")->fetchColumn();
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Network & Leadership</h1>
            <p>Build your team, earn commissions, and lead a healthier community</p>
        </div>
    </div>

    <!-- Network Overview -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-heading">The DTEHM Network</h2>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        DTEHM Health Ministries operates through a powerful network marketing model that rewards 
                        members for sharing health products and building their teams. As a member, you can earn 
                        commissions by sponsoring new members and becoming a product stockist.
                    </p>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        Our 10-level leadership structure ensures that everyone in the network benefits from growth, 
                        creating a sustainable community-driven healthcare system.
                    </p>
                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <div style="text-align: center; padding: 1.5rem; background: var(--light-blue); border-radius: 12px;">
                                <div class="stat-value"><?php echo number_format($totalMembers); ?></div>
                                <small style="color: var(--gray-text);">Active Members</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div style="text-align: center; padding: 1.5rem; background: var(--light-blue); border-radius: 12px;">
                                <div class="stat-value"><?php echo number_format($totalSponsors); ?></div>
                                <small style="color: var(--gray-text);">Active Sponsors</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-block" style="text-align: center;">
                        <i class="fas fa-sitemap" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700;">10-Level Network</h3>
                        <p style="color: var(--gray-text);">Build your team up to 10 levels deep and earn commissions from every level of your network.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Earning Structure -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">How You Earn</h2>
                <p style="color: var(--gray-text);">Multiple income streams within the DTEHM network</p>
            </div>
            <div class="row g-4">
                <!-- Sponsor Commission -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-user-friends" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Sponsor Commission</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">8%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Earn 8% commission on every purchase made by members you directly sponsor (refer as a buyer).</p>
                    </div>
                </div>
                <!-- Stockist Commission -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-store" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Stockist Commission</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">7%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Become a product distributor and earn 7% on products sold through your stockist point.</p>
                    </div>
                </div>
                <!-- Network Commission -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-project-diagram" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Network Commissions</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">10 Levels</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Earn commissions from purchases across your 10-level deep network of members.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Network Levels -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Network Levels</h2>
                <p style="color: var(--gray-text);">Earn commissions from every level of your organization</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); overflow: hidden;">
                        <?php 
                        $levels = [
                            ['level' => 1, 'title' => 'Direct Referrals', 'desc' => 'People you personally sponsor'],
                            ['level' => 2, 'title' => 'Second Generation', 'desc' => 'People sponsored by your Level 1'],
                            ['level' => 3, 'title' => 'Third Generation', 'desc' => 'Network continues to grow'],
                            ['level' => 4, 'title' => 'Fourth Generation', 'desc' => 'Deeper network benefits'],
                            ['level' => 5, 'title' => 'Fifth Generation', 'desc' => 'Mid-level network rewards'],
                            ['level' => 6, 'title' => 'Sixth Generation', 'desc' => 'Growing leadership impact'],
                            ['level' => 7, 'title' => 'Seventh Generation', 'desc' => 'Advanced network level'],
                            ['level' => 8, 'title' => 'Eighth Generation', 'desc' => 'Senior network benefits'],
                            ['level' => 9, 'title' => 'Ninth Generation', 'desc' => 'Executive level reach'],
                            ['level' => 10, 'title' => 'Tenth Generation', 'desc' => 'Maximum network depth'],
                        ];
                        foreach ($levels as $i => $lvl): 
                            $opacity = 1 - ($i * 0.06);
                        ?>
                        <div style="display: flex; align-items: center; padding: 1rem 1.5rem; border-bottom: 1px solid var(--gray-border); <?php echo $i === 0 ? 'background: var(--light-blue);' : ''; ?>">
                            <div class="icon-circle-md" style="background: <?php echo $i === 0 ? 'var(--primary-blue)' : 'var(--light-blue)'; ?>; color: <?php echo $i === 0 ? 'var(--white)' : 'var(--primary-blue)'; ?>; font-weight: 800; margin-right: 1rem;">
                                <?php echo $lvl['level']; ?>
                            </div>
                            <div style="flex: 1;">
                                <strong style="color: var(--dark-blue);"><?php echo $lvl['title']; ?></strong>
                                <p style="color: var(--gray-text); font-size: 0.85rem; margin: 0;"><?php echo $lvl['desc']; ?></p>
                            </div>
                            <div style="min-width: 80px; text-align: right;">
                                <span style="color: var(--primary-green); font-weight: 700;">Level <?php echo $lvl['level']; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Join -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">How to Join the Network</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">1</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Register as a Member</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Sign up on the DTEHM app or website with a sponsor code</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">2</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Activate Your Account</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Purchase a membership package to activate your network position</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">3</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Build & Earn</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Share products, sponsor members, and earn commissions on 10 levels</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Join the DTEHM Network Today</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Start your journey as a sponsor, stockist, or network leader.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="enroll.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-user-plus me-2"></i>Join Now</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
