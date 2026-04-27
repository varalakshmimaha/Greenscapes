<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Inquiry — SR Greenscapes</title>
<style>
    body { margin:0; padding:0; background:#f4f7f4; font-family:'Segoe UI',Arial,sans-serif; font-size:15px; color:#222; }
    .wrapper { max-width:600px; margin:30px auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.08); }
    .header { background:linear-gradient(135deg,#4a7c2f 0%,#689F38 100%); padding:36px 40px; text-align:center; }
    .header img { height:48px; margin-bottom:14px; }
    .header h1 { color:#fff; font-size:22px; font-weight:700; margin:0 0 4px; letter-spacing:-0.3px; }
    .header p { color:rgba(255,255,255,0.8); font-size:13px; margin:0; }
    .badge { display:inline-block; background:rgba(255,255,255,0.2); color:#fff; font-size:11px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 14px; border-radius:50px; margin-bottom:12px; }
    .body { padding:36px 40px; }
    .alert-box { background:#f0f8e8; border-left:4px solid #8BC34A; border-radius:6px; padding:14px 18px; margin-bottom:28px; font-size:14px; color:#3a6318; }
    .alert-box strong { display:block; font-size:15px; margin-bottom:2px; }
    .field-row { display:flex; margin-bottom:16px; border-bottom:1px solid #f0f0f0; padding-bottom:16px; }
    .field-row:last-child { border-bottom:none; margin-bottom:0; padding-bottom:0; }
    .field-label { width:130px; min-width:130px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#888; padding-top:2px; }
    .field-value { flex:1; font-size:15px; color:#222; word-break:break-word; }
    .field-value a { color:#4a7c2f; text-decoration:none; }
    .service-tag { display:inline-block; background:#f0f8e8; color:#3a6318; font-size:13px; font-weight:600; padding:4px 12px; border-radius:20px; border:1px solid #c5e1a5; }
    .message-box { background:#fafafa; border:1px solid #eee; border-radius:8px; padding:16px; font-size:14px; line-height:1.7; color:#444; margin-top:4px; }
    .footer { background:#f4f7f4; padding:24px 40px; text-align:center; border-top:1px solid #eee; }
    .footer p { margin:0; font-size:12px; color:#aaa; line-height:1.8; }
    .footer a { color:#689F38; text-decoration:none; }
    .divider { height:1px; background:#f0f0f0; margin:24px 0; }
    .cta-btn { display:inline-block; background:#689F38; color:#fff; font-size:13px; font-weight:700; padding:11px 28px; border-radius:8px; text-decoration:none; letter-spacing:0.5px; margin-top:20px; }
</style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <div class="badge">New Inquiry</div>
        <h1>SR Greenscapes Pvt Ltd</h1>
        <p>Sowing Science, Growing Beauty</p>
    </div>

    <!-- Body -->
    <div class="body">
        <div class="alert-box">
            <strong>You have received a new inquiry!</strong>
            Submitted on {{ now()->format('d M Y \a\t h:i A') }} via your website.
        </div>

        <!-- Name -->
        <div class="field-row">
            <div class="field-label">Name</div>
            <div class="field-value"><strong>{{ $data['name'] ?? '—' }}</strong></div>
        </div>

        <!-- Phone -->
        <div class="field-row">
            <div class="field-label">Phone</div>
            <div class="field-value">
                <a href="tel:{{ $data['phone'] ?? '' }}">{{ $data['phone'] ?? '—' }}</a>
            </div>
        </div>

        <!-- Email -->
        @if(!empty($data['email']))
        <div class="field-row">
            <div class="field-label">Email</div>
            <div class="field-value">
                <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
            </div>
        </div>
        @endif

        <!-- Service -->
        @php
            $service = $data['subject'] ?? $data['message'] ?? null;
        @endphp
        @if($service)
        <div class="field-row">
            <div class="field-label">Service</div>
            <div class="field-value"><span class="service-tag">{{ $service }}</span></div>
        </div>
        @endif

        <!-- Source -->
        @if(!empty($data['source']))
        <div class="field-row">
            <div class="field-label">Source</div>
            <div class="field-value" style="color:#888;font-size:13px;">{{ ucwords(str_replace('-', ' ', $data['source'])) }}</div>
        </div>
        @endif

        <!-- Message -->
        @php
            $message = $data['details'] ?? $data['message'] ?? null;
            if ($message === $service) $message = null;
        @endphp
        @if($message)
        <div class="field-row" style="flex-direction:column;">
            <div class="field-label" style="width:100%;margin-bottom:8px;">Message</div>
            <div class="message-box">{{ $message }}</div>
        </div>
        @endif

        <div class="divider"></div>
        <p style="font-size:13px;color:#888;margin:0;">
            Please follow up with this lead promptly. Log in to your admin panel to view all inquiries.
        </p>
        <a href="{{ config('app.url') }}/admin/contacts" class="cta-btn">View All Inquiries</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            SR Greenscapes Pvt Ltd · Sy No. 32/40, Jinnagara, Hoskote Taluk, Bangalore – 562114<br>
            <a href="tel:+916361115701">+91 6361115701</a> &nbsp;|&nbsp;
            <a href="mailto:info@srgreenscapes.com">info@srgreenscapes.com</a><br><br>
            This is an automated notification. Do not reply to this email.
        </p>
    </div>

</div>
</body>
</html>
