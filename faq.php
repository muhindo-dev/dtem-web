<?php
$currentPage = 'faq';
$pageTitle = 'FAQ';
include 'config.php';
include 'functions.php';

$pageDescription = 'Frequently asked questions about DTEHM Health Ministries - products, membership, insurance, investment, and network marketing.';
include 'includes/header.php';
?>

<!-- FAQ Schema Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What is DTEHM Health Ministries?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "DTEHM Health Ministries is a healthcare organization based in Kasese, Uganda. We provide natural Ayurvedic and herbal health products, health insurance programs, investment opportunities, and a community-driven network marketing model to improve healthcare access and livelihoods across Uganda."
            }
        },
        {
            "@type": "Question",
            "name": "Where is DTEHM located?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Our head office is located at Kamaiba Lower, Near SDA Primary School, Kasese, Uganda. We also have branch offices in Bwera, Rugendabara, and Kisinga."
            }
        },
        {
            "@type": "Question",
            "name": "How can I contact DTEHM?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "You can reach us by phone at +256 782 284788 or +256 705 070995, by email at dtehmhealth@gmail.com, or visit our contact page to send us a message."
            }
        },
        {
            "@type": "Question",
            "name": "How do I become a DTEHM member?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Download the DTEHM mobile app from Google Play Store and register with a sponsor code from an existing member. Membership fees: DTEHM (UGX 76,000 one-time), DIP (UGX 20,000 one-time), or both (UGX 96,000)."
            }
        },
        {
            "@type": "Question",
            "name": "What benefits do members get?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Members earn commissions from personal sales (8%), a 10-generation network (3% to 0.2%), and stockist distribution (7%). They can also enroll in health insurance (up to UGX 50M coverage for UGX 16,000/month), invest in projects, and qualify for 8 leadership ranks with rewards."
            }
        },
        {
            "@type": "Question",
            "name": "What types of products does DTEHM sell?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We offer a wide range of natural health products including Ayurvedic medicines, herbal supplements, personal care products, and wellness items. All products are sourced from trusted manufacturers and promote holistic health."
            }
        },
        {
            "@type": "Question",
            "name": "Are the products safe?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Our products are natural, Ayurvedic, and herbal formulations. We recommend following the usage instructions provided with each product. Consult a healthcare professional if you have specific medical conditions."
            }
        },
        {
            "@type": "Question",
            "name": "What insurance programs are available?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We offer the Comprehensive Health Insurance program with coverage up to UGX 50,000,000 at a monthly premium of UGX 16,000. The plan covers 12 months with a 7-day grace period on each payment."
            }
        },
        {
            "@type": "Question",
            "name": "How does DTEHM investment work?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "DTEHM offers share-based investment in healthcare, agriculture, and transport projects. Purchase shares from UGX 100,000 each. Your ownership percentage equals your shares divided by total project shares. Shareholders earn returns proportional to project profits."
            }
        },
        {
            "@type": "Question",
            "name": "How do commissions work?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "4 ways to earn: Sponsor commission (8%) on sales by your referred buyers. Stockist commission (7%) as a product distributor. Network commissions (3% to 0.2%) across 10 generations of your downline. Referral bonus (5%) on purchases by referred members. Total commission pool per sale: up to 27.5%."
            }
        }
    ]
}
</script>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
            <p>Find answers to common questions about DTEHM Health Ministries</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="section-pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- General -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-info-circle me-2" style="color: var(--primary-blue);"></i>General</h3>
                    <div class="accordion mb-5" id="faqGeneral">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <span>What is DTEHM Health Ministries?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq1" class="collapse" data-bs-parent="#faqGeneral">
                                <div class="faq-answer">
                                    DTEHM Health Ministries is a healthcare organization based in Kasese, Uganda. We provide natural Ayurvedic and herbal health products, health insurance programs, investment opportunities, and a community-driven network marketing model to improve healthcare access and livelihoods across Uganda.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <span>Where is DTEHM located?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent="#faqGeneral">
                                <div class="faq-answer">
                                    Our head office is located at Kamaiba Lower, Near SDA Primary School, Kasese, Uganda. We also have branch offices in Bwera, Rugendabara, and Kisinga.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <span>How can I contact DTEHM?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent="#faqGeneral">
                                <div class="faq-answer">
                                    You can reach us by phone at +256 782 284788 or +256 705 070995, by email at dtehmhealth@gmail.com, or visit our <a href="contact.php">contact page</a> to send us a message.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Membership -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-id-card me-2" style="color: var(--primary-green);"></i>Membership</h3>
                    <div class="accordion mb-5" id="faqMembership">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <span>How do I become a DTEHM member?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent="#faqMembership">
                                <div class="faq-answer">
                                    You can register by downloading the <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer">DTEHM mobile app</a> from the Google Play Store. You will need a sponsor code from an existing member to join.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5">
                                <span>What are the membership fees?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq5" class="collapse" data-bs-parent="#faqMembership">
                                <div class="faq-answer">
                                    There are three membership options: <strong>DTEHM Membership (UGX 76,000)</strong> &mdash; one-time lifetime fee that lets you sell products (8% commission), sponsor members, earn network commissions across 10 generations, and qualify for leadership ranks. <strong>DIP Membership (UGX 20,000)</strong> &mdash; one-time fee for access to insurance programs and medical services. <strong>Both (UGX 96,000)</strong> &mdash; full access to all DTEHM services. All payments are made via mobile money through the app.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq6">
                                <span>What benefits do members get?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq6" class="collapse" data-bs-parent="#faqMembership">
                                <div class="faq-answer">
                                    Members get access to health products at member prices, can earn commissions from personal sales (8%), earn from a 10-generation network (3% to 0.2%), become a stockist for additional 7% commission, enroll in insurance programs (up to UGX 50M coverage), invest in projects by purchasing shares, qualify for 8 leadership ranks with rewards (from smartphone to profit share), and request medical services. Active DTEHM members can also earn a 5% referral bonus.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-leaf me-2" style="color: var(--primary-green);"></i>Health Products</h3>
                    <div class="accordion mb-5" id="faqProducts">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq7">
                                <span>What types of products does DTEHM sell?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq7" class="collapse" data-bs-parent="#faqProducts">
                                <div class="faq-answer">
                                    We offer a wide range of natural health products including Ayurvedic medicines, herbal supplements, personal care products, and wellness items. All products are sourced from trusted manufacturers and promote holistic health.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq8">
                                <span>How do I order products?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq8" class="collapse" data-bs-parent="#faqProducts">
                                <div class="faq-answer">
                                    Products can be ordered through the DTEHM mobile app, from your nearest stockist, or by contacting our branch offices. Payment is accepted via mobile money through the app.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq9">
                                <span>Are the products safe?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq9" class="collapse" data-bs-parent="#faqProducts">
                                <div class="faq-answer">
                                    Yes. Our products are natural, Ayurvedic, and herbal formulations. We recommend following the usage instructions provided with each product. Consult a healthcare professional if you have specific medical conditions.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-shield-alt me-2" style="color: var(--primary-blue);"></i>Insurance</h3>
                    <div class="accordion mb-5" id="faqInsurance">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq10">
                                <span>What insurance programs are available?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq10" class="collapse" data-bs-parent="#faqInsurance">
                                <div class="faq-answer">
                                    We currently offer the <strong>Comprehensive Health Insurance</strong> program with coverage up to <strong>UGX 50,000,000</strong> at a monthly premium of <strong>UGX 16,000</strong>. The plan covers 12 months with a 7-day grace period on each payment. Late payment penalty is UGX 2,000. Visit our <a href="insurance.php">insurance page</a> for full details.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq11">
                                <span>How do I enroll in insurance?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq11" class="collapse" data-bs-parent="#faqInsurance">
                                <div class="faq-answer">
                                    First, become a DIP member (UGX 20,000 one-time fee). Then you can enroll in insurance programs through the DTEHM mobile app. You will need to make monthly premium payments of UGX 16,000 via mobile money to maintain your coverage.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Investment -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-chart-line me-2" style="color: var(--primary-blue);"></i>Investment</h3>
                    <div class="accordion mb-5" id="faqInvestment">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq12">
                                <span>How does DTEHM investment work?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq12" class="collapse" data-bs-parent="#faqInvestment">
                                <div class="faq-answer">
                                    DTEHM offers share-based investment in healthcare, agriculture, and transport projects. You purchase shares at the project&rsquo;s listed price (from UGX 100,000 per share). Your ownership percentage equals your shares divided by total project shares. As projects generate profit, shareholders earn returns proportional to their ownership. Visit our <a href="investment.php">investment page</a> to see available projects.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq13">
                                <span>What is the minimum investment?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq13" class="collapse" data-bs-parent="#faqInvestment">
                                <div class="faq-answer">
                                    The minimum investment is one share. Current projects have share prices starting at UGX 100,000. Available projects include medicine distribution, agriculture, property, and motorcycle fleet ventures. Check the <a href="investment.php">investment page</a> for current share prices and availability.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Network -->
                    <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-project-diagram me-2" style="color: var(--primary-green);"></i>Network & Earnings</h3>
                    <div class="accordion mb-5" id="faqNetwork">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq14">
                                <span>How do commissions work?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq14" class="collapse" data-bs-parent="#faqNetwork">
                                <div class="faq-answer">
                                    There are 4 ways to earn: <strong>Sponsor commission (8%)</strong> &mdash; earned when someone you referred as a buyer makes a purchase. <strong>Stockist commission (7%)</strong> &mdash; earned as a product distributor. <strong>Network commissions (3%&ndash;0.2%)</strong> &mdash; earned from purchases across your 10-generation downline. <strong>Referral bonus (5%)</strong> &mdash; earned when referred members make purchases. The total commission pool per sale is up to 27.5%. Visit our <a href="network.php">network page</a> for the full breakdown.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq15">
                                <span>How do I become a stockist?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq15" class="collapse" data-bs-parent="#faqNetwork">
                                <div class="faq-answer">
                                    Active members can apply to become product stockists. As a stockist, you maintain an inventory of DTEHM products and earn a 7% commission on all sales. Contact our office or your sponsor for the stockist application process.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq16">
                                <span>How do I withdraw my earnings?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq16" class="collapse" data-bs-parent="#faqNetwork">
                                <div class="faq-answer">
                                    Earnings can be withdrawn through the DTEHM mobile app via Mobile Money (MTN or Airtel) or bank transfer. The minimum withdrawal amount is <strong>UGX 10,000</strong>. Withdrawals are processed within 24&ndash;48 hours. You can also use your wallet balance to purchase products or pay insurance premiums directly.
                                </div>
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
            <h2 class="section-heading" style="color: var(--white);">Still Have Questions?</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Our team is happy to help. Reach out to us anytime.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="contact.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-envelope me-2"></i>Contact Us</a>
                <a href="tel:+256782284788" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Call Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
