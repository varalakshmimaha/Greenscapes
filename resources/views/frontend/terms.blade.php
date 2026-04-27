@extends('frontend.layouts.app')

@section('title', 'Terms of Use — SR Greenscapes')

@section('styles')
<style>
    .terms-hero {
        position: relative;
        width: 100%;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .terms-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 35, 15, 0.72);
    }
    .terms-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .terms-hero-content h1 {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
    }
    .terms-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: rgba(255,255,255,0.55);
        font-size: 0.82rem;
        margin-top: 10px;
    }
    .terms-breadcrumb a { color: var(--accent); text-decoration: none; }
    .terms-breadcrumb span { color: rgba(255,255,255,0.3); }

    .terms-body {
        padding: 70px 0 80px;
        background: #f9fdf5;
    }
    .terms-card {
        background: #fff;
        border-radius: 20px;
        padding: 48px 56px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        max-width: 860px;
        margin: 0 auto;
    }
    .terms-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2a1a;
        margin: 32px 0 10px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e8f5d8;
    }
    .terms-card h2:first-child { margin-top: 0; }
    .terms-card p {
        color: #555;
        font-size: 0.93rem;
        line-height: 1.85;
        text-align: justify;
        margin-bottom: 14px;
    }
    .terms-card ul {
        margin: 0 0 14px 0;
        padding-left: 20px;
    }
    .terms-card ul li {
        color: #555;
        font-size: 0.93rem;
        line-height: 1.8;
        margin-bottom: 6px;
    }
    .terms-updated {
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
        .terms-hero { height: 220px; }
        .terms-hero-content h1 { font-size: 1.8rem; }
        .terms-card { padding: 28px 22px; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="terms-hero">
    <div class="terms-hero-content">
        <h1>Terms of Use</h1>
        <div class="terms-breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <span>Terms of Use</span>
        </div>
    </div>
</section>

<!-- Content -->
<section class="terms-body">
    <div class="container">
        <div class="terms-card">
            <span class="terms-updated"><i class="fas fa-calendar-alt" style="margin-right:6px;"></i> Last Updated: January 2025</span>

            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using the SR Greenscapes Pvt Ltd website (<strong>www.srgreenscapes.com</strong>), you accept and agree to be bound by these Terms of Use. If you do not agree with any part of these terms, please do not use our website or services.</p>

            <h2>2. Use of Website</h2>
            <p>You agree to use this website only for lawful purposes and in a manner that does not infringe the rights of others. You must not:</p>
            <ul>
                <li>Use the site in any way that violates applicable local, national, or international laws or regulations.</li>
                <li>Transmit unsolicited or unauthorized advertising or promotional material.</li>
                <li>Attempt to gain unauthorized access to any part of the website, its servers, or connected systems.</li>
                <li>Engage in any conduct that restricts or inhibits anyone's use or enjoyment of the site.</li>
            </ul>

            <h2>3. Intellectual Property</h2>
            <p>All content on this website — including text, images, photographs, graphics, logos, icons, and software — is the property of SR Greenscapes Pvt Ltd and is protected under applicable intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written permission.</p>

            <h2>4. Service Information</h2>
            <p>The information presented on this website regarding our landscaping services, project portfolios, and pricing is for general informational purposes only. While we strive for accuracy, we make no warranties or representations regarding the completeness or suitability of information for your specific requirements. All services are subject to a formal proposal and agreement.</p>

            <h2>5. Project Portfolios & Testimonials</h2>
            <p>Project images and testimonials displayed on this website are from actual client projects and are used with permission. They represent past work and are not guarantees of identical outcomes for future projects, as each landscaping project is unique.</p>

            <h2>6. Third-Party Links</h2>
            <p>Our website may contain links to third-party websites for your convenience. SR Greenscapes Pvt Ltd has no control over the content of those sites and accepts no responsibility for them or for any loss or damage that may arise from your use of them.</p>

            <h2>7. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law, SR Greenscapes Pvt Ltd shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of or inability to use this website or our services, even if we have been advised of the possibility of such damages.</p>

            <h2>8. Modifications</h2>
            <p>We reserve the right to modify these Terms of Use at any time. Changes are effective immediately upon posting. Your continued use of the website after any changes constitutes your acceptance of the new terms.</p>

            <h2>9. Governing Law</h2>
            <p>These Terms of Use are governed by and construed in accordance with the laws of India. Any disputes arising shall be subject to the exclusive jurisdiction of the courts located in Bengaluru, Karnataka.</p>

            <h2>10. Contact</h2>
            <p>For questions regarding these Terms of Use, contact us at:</p>
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
