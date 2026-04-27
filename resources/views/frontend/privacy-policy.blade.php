@extends('frontend.layouts.app')

@section('title', 'Privacy Policy — SR Greenscapes')

@section('styles')
<style>
    .policy-hero {
        position: relative;
        width: 100%;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .policy-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 35, 15, 0.72);
    }
    .policy-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .policy-hero-content h1 {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
    }
    .policy-hero-content p {
        color: rgba(255,255,255,0.75);
        font-size: 1rem;
    }
    .policy-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: rgba(255,255,255,0.55);
        font-size: 0.82rem;
        margin-top: 10px;
    }
    .policy-breadcrumb a { color: var(--accent); text-decoration: none; }
    .policy-breadcrumb span { color: rgba(255,255,255,0.3); }

    .policy-body {
        padding: 70px 0 80px;
        background: #f9fdf5;
    }
    .policy-card {
        background: #fff;
        border-radius: 20px;
        padding: 48px 56px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        max-width: 860px;
        margin: 0 auto;
    }
    .policy-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2a1a;
        margin: 32px 0 10px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e8f5d8;
    }
    .policy-card h2:first-child { margin-top: 0; }
    .policy-card p {
        color: #555;
        font-size: 0.93rem;
        line-height: 1.85;
        text-align: justify;
        margin-bottom: 14px;
    }
    .policy-card ul {
        margin: 0 0 14px 0;
        padding-left: 20px;
    }
    .policy-card ul li {
        color: #555;
        font-size: 0.93rem;
        line-height: 1.8;
        margin-bottom: 6px;
    }
    .policy-updated {
        display: inline-block;
        background: rgba(139,195,74,0.12);
        color: var(--primary-dark);
        border-radius: 50px;
        padding: 5px 18px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 28px;
    }
    @media (max-width: 767px) {
        .policy-hero { height: 220px; }
        .policy-hero-content h1 { font-size: 1.8rem; }
        .policy-card { padding: 28px 22px; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="policy-hero">
    <div class="policy-hero-content">
        <h1>Privacy Policy</h1>
        <div class="policy-breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <span>Privacy Policy</span>
        </div>
    </div>
</section>

<!-- Content -->
<section class="policy-body">
    <div class="container">
        <div class="policy-card">
            <span class="policy-updated"><i class="fas fa-calendar-alt" style="margin-right:6px;"></i> Last Updated: January 2025</span>

            <h2>1. Introduction</h2>
            <p>SR Greenscapes Pvt Ltd ("we," "our," or "us") respects your privacy and is committed to protecting your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or engage our landscaping services.</p>

            <h2>2. Information We Collect</h2>
            <p>We may collect the following types of information:</p>
            <ul>
                <li><strong>Personal Identification:</strong> Name, email address, phone number, and postal address provided through our contact forms or service inquiries.</li>
                <li><strong>Project Details:</strong> Information about your landscaping requirements, site location, and project scope shared with us.</li>
                <li><strong>Usage Data:</strong> Browser type, pages visited, time spent on pages, and other diagnostic data collected automatically when you browse our website.</li>
                <li><strong>Communication Records:</strong> Records of your correspondence with us via email, phone, or our website forms.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <p>The information we collect is used to:</p>
            <ul>
                <li>Respond to your inquiries and provide landscaping consultation and project proposals.</li>
                <li>Process service bookings and manage ongoing project communications.</li>
                <li>Send you updates about our services, promotions, and relevant landscaping content (with your consent).</li>
                <li>Improve our website functionality and user experience.</li>
                <li>Comply with legal obligations and resolve any disputes.</li>
            </ul>

            <h2>4. Data Sharing & Disclosure</h2>
            <p>We do not sell, trade, or transfer your personal information to third parties without your consent, except in the following circumstances:</p>
            <ul>
                <li><strong>Service Partners:</strong> Trusted vendors or subcontractors who assist in delivering our landscaping projects, bound by confidentiality agreements.</li>
                <li><strong>Legal Requirements:</strong> When disclosure is required by law or to protect our legal rights.</li>
                <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your data may be transferred to the successor entity.</li>
            </ul>

            <h2>5. Data Security</h2>
            <p>We implement industry-standard security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

            <h2>6. Cookies</h2>
            <p>Our website may use cookies to enhance your browsing experience. Cookies are small files placed on your device that help us analyze web traffic and remember your preferences. You can choose to disable cookies through your browser settings, though this may limit certain features of our website.</p>

            <h2>7. Third-Party Links</h2>
            <p>Our website may contain links to third-party sites (such as social media platforms). We are not responsible for the privacy practices of those sites and encourage you to review their privacy policies.</p>

            <h2>8. Your Rights</h2>
            <p>You have the right to access, correct, or request deletion of your personal data held by us. To exercise these rights, please contact us at <a href="mailto:mdsrgreenscapes@gmail.com" style="color:var(--primary);">mdsrgreenscapes@gmail.com</a>.</p>

            <h2>9. Changes to This Policy</h2>
            <p>We reserve the right to update this Privacy Policy at any time. Changes will be posted on this page with an updated effective date. We encourage you to review this policy periodically.</p>

            <h2>10. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us:</p>
            <ul>
                <li><strong>SR Greenscapes Pvt Ltd</strong></li>
                <li>Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Hoskote Taluk, Bangalore – 562114</li>
                <li>Email: <a href="mailto:mdsrgreenscapes@gmail.com" style="color:var(--primary);">mdsrgreenscapes@gmail.com</a></li>
                <li>Phone: <a href="tel:+919845728507" style="color:var(--primary);">+91 9845728507</a></li>
            </ul>
        </div>
    </div>
</section>

@endsection
