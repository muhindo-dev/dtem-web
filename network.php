<?php
$currentPage = 'network';
$pageTitle = 'Network & Earnings';
include 'config.php';
include 'functions.php';

$pageDescription = 'Earn commissions through the DTEHM 10-generation network. 8% sponsor commission, 7% stockist commission, up to 27.5% total from product sales. Achieve leadership ranks and unlock rewards.';
include 'includes/header.php';

// Get member stats
$totalMembers = $pdo->query("SELECT COUNT(*) FROM users WHERE is_dtehm_member = 'Yes'")->fetchColumn();
$totalSponsors = $pdo->query("SELECT COUNT(DISTINCT sponsor_id) FROM users WHERE sponsor_id IS NOT NULL AND sponsor_id != 0")->fetchColumn();
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Network & Earnings</h1>
            <p>Earn up to 27.5% commission on every product sale across 10 generations</p>
        </div>
    </div>

    <!-- Network Overview -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-heading">How the DTEHM Network Works</h2>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        DTEHM operates a 10-generation network marketing model. When you join as a DTEHM member 
                        (one-time fee of <strong>UGX 76,000</strong>), you are placed under your sponsor in the network tree. 
                        Every time a product is purchased anywhere in your 10-generation downline, you earn a percentage 
                        of that sale &mdash; automatically credited to your DTEHM wallet.
                    </p>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        There are <strong>4 ways to earn</strong>: Sponsor Commission (8%), Stockist Commission (7%), 
                        Network Commissions (3% &ndash; 0.2% across 10 levels), and Referral Bonus (5%). 
                        The total commission pool on a single sale can reach <strong>27.5%</strong>.
                    </p>
                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <div style="text-align: center; padding: 1.5rem; background: var(--light-blue); border-radius: 12px;">
                                <div class="stat-value"><?php echo number_format($totalMembers); ?>+</div>
                                <small style="color: var(--gray-text);">DTEHM Members</small>
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
                        <h3 style="color: var(--dark-blue); font-weight: 700;">27.5% Total Commission Pool</h3>
                        <p style="color: var(--gray-text);">On every product sale, up to 27.5% is distributed across the sponsor, stockist, and 10 generations of the upline network.</p>
                        <div style="background: var(--light-blue); border-radius: 8px; padding: 1rem; margin-top: 1rem; text-align: left;">
                            <small style="color: var(--gray-text); display: block; margin-bottom: 0.5rem;"><strong>Quick Breakdown:</strong></small>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;"><span style="color: var(--dark-blue); font-size: 0.85rem;">Sponsor (Seller)</span><strong style="color: var(--primary-green);">8%</strong></div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;"><span style="color: var(--dark-blue); font-size: 0.85rem;">Stockist (Distributor)</span><strong style="color: var(--primary-green);">7%</strong></div>
                            <div style="display: flex; justify-content: space-between;"><span style="color: var(--dark-blue); font-size: 0.85rem;">Network (GN1&ndash;GN10)</span><strong style="color: var(--primary-green);">12.5%</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Commission Types -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">4 Ways to Earn</h2>
                <p style="color: var(--gray-text);">Every product sale generates commissions across these 4 streams</p>
            </div>
            <div class="row g-4">
                <!-- Sponsor Commission -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-user-friends" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Sponsor Commission</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">8%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">When someone you referred as a buyer purchases a product, you earn 8% of the sale value. Credited instantly to your wallet.</p>
                    </div>
                </div>
                <!-- Stockist Commission -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-store" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Stockist Commission</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">7%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">As a product distributor (stockist), you earn 7% on every product sold through your distribution point.</p>
                    </div>
                </div>
                <!-- Network Commission -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-project-diagram" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Network Commission</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">3%&ndash;0.2%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Earn from purchases made across your 10 generations. GN1 earns 3%, decreasing to 0.2% at GN10 &mdash; totalling up to 12.5%.</p>
                    </div>
                </div>
                <!-- Referral Bonus -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card text-center">
                        <div class="icon-circle-lg" style="background: var(--light-blue); margin: 0 auto 1.5rem;">
                            <i class="fas fa-gift" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">Referral Bonus</h4>
                        <div class="stat-value" style="margin-bottom: 0.5rem;">5%</div>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Earn a 5% bonus when members you refer make purchases. This is in addition to your sponsor commission.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10-Generation Commission Table -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">10-Generation Commission Rates</h2>
                <p style="color: var(--gray-text);">Your network commissions from every level of your downline</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); overflow: hidden;">
                        <?php 
                        $levels = [
                            ['level' => 'GN1', 'title' => 'Generation 1 (Direct Referrals)', 'rate' => '3.0%', 'example' => '3,000'],
                            ['level' => 'GN2', 'title' => 'Generation 2', 'rate' => '2.5%', 'example' => '2,500'],
                            ['level' => 'GN3', 'title' => 'Generation 3', 'rate' => '2.0%', 'example' => '2,000'],
                            ['level' => 'GN4', 'title' => 'Generation 4', 'rate' => '1.5%', 'example' => '1,500'],
                            ['level' => 'GN5', 'title' => 'Generation 5', 'rate' => '1.0%', 'example' => '1,000'],
                            ['level' => 'GN6', 'title' => 'Generation 6', 'rate' => '0.8%', 'example' => '800'],
                            ['level' => 'GN7', 'title' => 'Generation 7', 'rate' => '0.6%', 'example' => '600'],
                            ['level' => 'GN8', 'title' => 'Generation 8', 'rate' => '0.5%', 'example' => '500'],
                            ['level' => 'GN9', 'title' => 'Generation 9', 'rate' => '0.4%', 'example' => '400'],
                            ['level' => 'GN10', 'title' => 'Generation 10', 'rate' => '0.2%', 'example' => '200'],
                        ];
                        ?>
                        <!-- Table Header -->
                        <div style="display: flex; align-items: center; padding: 1rem 1.5rem; background: var(--primary-blue); color: var(--white); font-weight: 700;">
                            <div style="width: 60px;">Level</div>
                            <div style="flex: 1;">Generation</div>
                            <div style="width: 80px; text-align: center;">Rate</div>
                            <div style="width: 120px; text-align: right;">Per UGX 100,000</div>
                        </div>
                        <?php foreach ($levels as $i => $lvl): ?>
                        <div style="display: flex; align-items: center; padding: 0.9rem 1.5rem; border-bottom: 1px solid var(--gray-border); <?php echo $i === 0 ? 'background: var(--light-blue);' : ''; ?>">
                            <div style="width: 60px;">
                                <span style="background: <?php echo $i === 0 ? 'var(--primary-blue)' : 'var(--light-blue)'; ?>; color: <?php echo $i === 0 ? 'var(--white)' : 'var(--primary-blue)'; ?>; font-weight: 800; padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.8rem;">
                                    <?php echo $lvl['level']; ?>
                                </span>
                            </div>
                            <div style="flex: 1;">
                                <strong style="color: var(--dark-blue); font-size: 0.9rem;"><?php echo $lvl['title']; ?></strong>
                            </div>
                            <div style="width: 80px; text-align: center;">
                                <span style="color: var(--primary-green); font-weight: 700;"><?php echo $lvl['rate']; ?></span>
                            </div>
                            <div style="width: 120px; text-align: right;">
                                <span style="color: var(--dark-blue); font-weight: 600;">UGX <?php echo $lvl['example']; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <!-- Total Row -->
                        <div style="display: flex; align-items: center; padding: 1rem 1.5rem; background: var(--light-blue); font-weight: 700;">
                            <div style="width: 60px;"></div>
                            <div style="flex: 1; color: var(--dark-blue);">Network Total (GN1&ndash;GN10)</div>
                            <div style="width: 80px; text-align: center; color: var(--primary-green);">12.5%</div>
                            <div style="width: 120px; text-align: right; color: var(--dark-blue);">UGX 12,500</div>
                        </div>
                    </div>
                    <p style="color: var(--gray-text); font-size: 0.85rem; margin-top: 1rem; text-align: center;">
                        <i class="fas fa-info-circle me-1"></i>
                        Commission is calculated on the product subtotal. If a parent at a particular level does not exist, that level&rsquo;s commission is skipped. 
                        Each recipient must be an active DTEHM member.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Earning Example -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Earnings Breakdown on a UGX 100,000 Sale</h2>
                <p style="color: var(--gray-text);">Here&rsquo;s how commissions are distributed when a product worth UGX 100,000 is sold</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-10">
                    <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); padding: 2rem;">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); border-radius: 10px; padding: 1.5rem; color: var(--white); text-align: center;">
                                    <i class="fas fa-user-friends" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <h5 style="margin-bottom: 0.3rem;">Sponsor (Seller)</h5>
                                    <div style="font-size: 1.8rem; font-weight: 800;">UGX 8,000</div>
                                    <small style="opacity: 0.8;">8% of UGX 100,000</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: linear-gradient(135deg, var(--primary-green), #028a22); border-radius: 10px; padding: 1.5rem; color: var(--white); text-align: center;">
                                    <i class="fas fa-store" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <h5 style="margin-bottom: 0.3rem;">Stockist</h5>
                                    <div style="font-size: 1.8rem; font-weight: 800;">UGX 7,000</div>
                                    <small style="opacity: 0.8;">7% of UGX 100,000</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 10px; padding: 1.5rem; color: var(--white); text-align: center;">
                                    <i class="fas fa-project-diagram" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <h5 style="margin-bottom: 0.3rem;">Network (GN1&ndash;GN10)</h5>
                                    <div style="font-size: 1.8rem; font-weight: 800;">UGX 12,500</div>
                                    <small style="opacity: 0.8;">12.5% split across 10 levels</small>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px dashed var(--gray-border);">
                            <span style="color: var(--gray-text); font-size: 0.95rem;">Total Commission Distributed:</span>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--primary-blue);">UGX 27,500 <span style="font-size: 1rem; color: var(--gray-text); font-weight: 400;">(27.5% of sale)</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Ranks -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Leadership Ranks & Rewards</h2>
                <p style="color: var(--gray-text);">Accumulate Points Volume (PV) from your own purchases and your entire downline to unlock rank rewards</p>
            </div>
            <div class="row g-4">
                <?php
                $ranks = [
                    ['name' => 'Member', 'points' => '0', 'reward' => 'Welcome to DTEHM', 'icon' => 'fa-user', 'color' => '#6b7280'],
                    ['name' => 'DTEHM Leader', 'points' => '12,000', 'reward' => 'Smartphone', 'icon' => 'fa-mobile-alt', 'color' => '#3b82f6'],
                    ['name' => 'Star Leader', 'points' => '50,000', 'reward' => 'Motorcycle', 'icon' => 'fa-motorcycle', 'color' => '#8b5cf6'],
                    ['name' => 'Diamond Leader', 'points' => '80,000', 'reward' => 'International Trip', 'icon' => 'fa-plane', 'color' => '#06b6d4'],
                    ['name' => 'Crown Leader', 'points' => '120,000', 'reward' => 'Small Car', 'icon' => 'fa-car', 'color' => '#f59e0b'],
                    ['name' => 'Senior Crown Leader', 'points' => '300,000', 'reward' => 'Luxury Car', 'icon' => 'fa-car-side', 'color' => '#ef4444'],
                    ['name' => 'Parlaw Leader', 'points' => '600,000', 'reward' => 'House Award', 'icon' => 'fa-home', 'color' => '#10b981'],
                    ['name' => 'DTEHM Executive Director', 'points' => '1,000,000', 'reward' => '2% Company Profit Share', 'icon' => 'fa-crown', 'color' => '#d97706'],
                ];
                foreach ($ranks as $i => $rank):
                ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="service-card text-center" style="position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: <?php echo $rank['color']; ?>;"></div>
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: <?php echo $rank['color']; ?>15; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <i class="fas <?php echo $rank['icon']; ?>" style="font-size: 1.3rem; color: <?php echo $rank['color']; ?>;"></i>
                        </div>
                        <h5 style="color: var(--dark-blue); font-weight: 700; font-size: 0.95rem; margin-bottom: 0.5rem;"><?php echo $rank['name']; ?></h5>
                        <div style="color: <?php echo $rank['color']; ?>; font-weight: 800; font-size: 1.1rem; margin-bottom: 0.3rem;"><?php echo $rank['points']; ?> PV</div>
                        <p style="color: var(--gray-text); font-size: 0.85rem; margin: 0;"><i class="fas fa-trophy me-1" style="color: <?php echo $rank['color']; ?>;"></i><?php echo $rank['reward']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <p style="color: var(--gray-text); font-size: 0.85rem; margin-top: 1.5rem; text-align: center;">
                <i class="fas fa-info-circle me-1"></i>
                <strong>Points Volume (PV)</strong> = your own purchase points + all points from your entire downline network. 
                Each product purchase earns PV based on the product&rsquo;s assigned point value.
            </p>
        </div>
    </section>

    <!-- Membership & Getting Started -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Getting Started</h2>
                <p style="color: var(--gray-text);">Join the DTEHM network in 3 simple steps</p>
            </div>
            <div class="row g-4 justify-content-center mb-5">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">1</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Download the App</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Get the DTEHM app from Google Play Store and register with a sponsor code from an existing member.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">2</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Pay Membership Fee</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Activate your account by paying the one-time DTEHM membership fee of <strong>UGX 76,000</strong> via mobile money.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-circle">3</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Sell, Sponsor & Earn</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Start selling products, referring new members, and earning commissions across your 10-generation network.</p>
                    </div>
                </div>
            </div>

            <!-- Membership Fees -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); overflow: hidden;">
                        <div style="background: var(--primary-blue); color: var(--white); padding: 1.2rem 1.5rem; text-align: center;">
                            <h4 style="margin: 0; font-weight: 700;"><i class="fas fa-id-card me-2"></i>Membership Options</h4>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4" style="border-right: 1px solid var(--gray-border); padding: 1.5rem; text-align: center;">
                                <h5 style="color: var(--dark-blue); font-weight: 700;">DTEHM</h5>
                                <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary-blue); margin-bottom: 0.5rem;">UGX 76,000</div>
                                <small style="color: var(--gray-text);">One-time, lifetime</small>
                                <p style="color: var(--gray-text); font-size: 0.8rem; margin-top: 0.8rem;">Sell products, earn commissions, build your network, qualify for ranks</p>
                            </div>
                            <div class="col-md-4" style="border-right: 1px solid var(--gray-border); padding: 1.5rem; text-align: center;">
                                <h5 style="color: var(--dark-blue); font-weight: 700;">DIP</h5>
                                <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary-blue); margin-bottom: 0.5rem;">UGX 20,000</div>
                                <small style="color: var(--gray-text);">One-time</small>
                                <p style="color: var(--gray-text); font-size: 0.8rem; margin-top: 0.8rem;">Access insurance programs and medical services</p>
                            </div>
                            <div class="col-md-4" style="padding: 1.5rem; text-align: center;">
                                <h5 style="color: var(--dark-blue); font-weight: 700;">Both</h5>
                                <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary-green); margin-bottom: 0.5rem;">UGX 96,000</div>
                                <small style="color: var(--gray-text);">One-time, full access</small>
                                <p style="color: var(--gray-text); font-size: 0.8rem; margin-top: 0.8rem;">All benefits: network earnings, insurance, investments, and medical services</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Withdrawal Info -->
    <section class="section-pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h2 class="section-heading">Withdrawals & Payments</h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="service-card text-center" style="padding: 1.5rem;">
                                <i class="fas fa-wallet" style="font-size: 2rem; color: var(--primary-blue); margin-bottom: 0.8rem;"></i>
                                <h5 style="color: var(--dark-blue); font-weight: 700;">Min. Withdrawal</h5>
                                <div style="font-size: 1.3rem; font-weight: 800; color: var(--primary-green);">UGX 10,000</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-card text-center" style="padding: 1.5rem;">
                                <i class="fas fa-mobile-alt" style="font-size: 2rem; color: var(--primary-blue); margin-bottom: 0.8rem;"></i>
                                <h5 style="color: var(--dark-blue); font-weight: 700;">Payment Method</h5>
                                <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">Mobile Money (MTN / Airtel) or Bank Transfer</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-card text-center" style="padding: 1.5rem;">
                                <i class="fas fa-clock" style="font-size: 2rem; color: var(--primary-blue); margin-bottom: 0.8rem;"></i>
                                <h5 style="color: var(--dark-blue); font-weight: 700;">Processing Time</h5>
                                <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">24&ndash;48 hours after withdrawal request</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Start Earning with DTEHM Today</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Download the app, join as a member for UGX 76,000, and start earning commissions on 10 generations.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fab fa-google-play me-2"></i>Get the App</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
