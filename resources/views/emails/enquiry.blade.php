<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{background:#F7F5F0;font-family:'Segoe UI',Arial,sans-serif;font-size:14px;color:#1A1714;line-height:1.6}
        .wrapper{max-width:600px;margin:40px auto;background:#fff;border:1px solid rgba(0,0,0,0.08)}
        .header{background:#111008;padding:32px 40px;display:flex;align-items:center;justify-content:space-between}
        .header-brand{font-size:1.4rem;font-weight:600;color:#fff;letter-spacing:0.04em}
        .header-brand span{color:#B8892A}
        .header-sub{font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:3px}
        .alert-bar{background:#B8892A;padding:12px 40px;font-size:0.72rem;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;color:#fff}
        .body{padding:40px}
        .title{font-size:1.3rem;font-weight:600;color:#1A1714;margin-bottom:6px}
        .subtitle{font-size:0.82rem;color:#6B6560;margin-bottom:32px}
        .detail-table{width:100%;border-collapse:collapse;margin-bottom:28px}
        .detail-table tr{border-bottom:1px solid rgba(0,0,0,0.07)}
        .detail-table tr:last-child{border-bottom:none}
        .detail-table td{padding:12px 0;font-size:0.88rem;vertical-align:top}
        .detail-table td:first-child{font-weight:600;color:#6B6560;text-transform:uppercase;font-size:0.65rem;letter-spacing:0.12em;width:140px;padding-top:14px}
        .detail-table td:last-child{color:#1A1714}
        .message-box{background:#F7F5F0;border-left:3px solid #B8892A;padding:20px 24px;margin-bottom:32px}
        .message-box p{font-size:0.9rem;color:#1A1714;line-height:1.8;white-space:pre-wrap}
        .cta{text-align:center;margin-bottom:32px}
        .cta a{display:inline-block;padding:13px 36px;background:#B8892A;color:#fff;font-size:0.75rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;text-decoration:none}
        .footer{background:#F7F5F0;border-top:1px solid rgba(0,0,0,0.07);padding:24px 40px;text-align:center}
        .footer p{font-size:0.72rem;color:#A8A49F;line-height:1.8}
        .footer a{color:#B8892A;text-decoration:none}
        .badge{display:inline-block;padding:3px 10px;background:rgba(184,137,42,0.1);border:1px solid rgba(184,137,42,0.25);font-size:0.65rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#B8892A}
    </style>
</head>
<body>
<div class="wrapper">

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="header-brand">De <span>Knest</span></div>
            <div class="header-sub">Construction Ltd</div>
        </div>
        <span class="badge" style="border-color:rgba(255,255,255,0.2);color:rgba(255,255,255,0.5);background:rgba(255,255,255,0.05)">New Enquiry</span>
    </div>

    <!-- ALERT BAR -->
    <div class="alert-bar">You have received a new project enquiry</div>

    <!-- BODY -->
    <div class="body">
        <h1 class="title">{{ $enquiry['name'] }} is interested in your services</h1>
        <p class="subtitle">Received on {{ now()->format('F j, Y \a\t g:i A') }}</p>

        <table class="detail-table">
            <tr>
                <td>Full Name</td>
                <td><strong>{{ $enquiry['name'] }}</strong></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><a href="mailto:{{ $enquiry['email'] }}" style="color:#B8892A">{{ $enquiry['email'] }}</a></td>
            </tr>
            @if(!empty($enquiry['phone']))
            <tr>
                <td>Phone</td>
                <td><a href="tel:{{ $enquiry['phone'] }}" style="color:#B8892A">{{ $enquiry['phone'] }}</a></td>
            </tr>
            @endif
            @if(!empty($enquiry['service']))
            <tr>
                <td>Service</td>
                <td><span class="badge">{{ $enquiry['service'] }}</span></td>
            </tr>
            @endif
        </table>

        @if(!empty($enquiry['message']))
        <p style="font-size:0.72rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:#6B6560;margin-bottom:10px">Message</p>
        <div class="message-box">
            <p>{{ $enquiry['message'] }}</p>
        </div>
        @endif

        <div class="cta">
            <a href="mailto:{{ $enquiry['email'] }}">Reply to {{ $enquiry['name'] }}</a>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>
            This email was sent from the contact form on<br>
            <a href="{{ url('/') }}">{{ url('/') }}</a>
        </p>
        <p style="margin-top:8px">De Knest Construction Ltd · No. 3 Domeabra, Pokuase, Accra</p>
    </div>

</div>
</body>
</html>