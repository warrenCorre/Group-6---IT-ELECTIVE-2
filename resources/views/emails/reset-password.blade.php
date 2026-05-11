<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #0f172a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #cbd5e1;
            padding: 40px 20px;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background: #1e293b;
            border-radius: 16px;
            border: 1px solid #334155;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1d4ed8 0%, #4338ca 100%);
            padding: 36px 40px;
            text-align: center;
        }
        .header h1 {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        .header p {
            color: #bfdbfe;
            font-size: 14px;
            margin-top: 6px;
        }
        .body {
            padding: 36px 40px;
        }
        .greeting {
            font-size: 16px;
            color: #e2e8f0;
            margin-bottom: 16px;
        }
        .message {
            font-size: 14px;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 28px;
        }
        .btn-wrap {
            text-align: center;
            margin-bottom: 28px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff !important;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 36px;
            border-radius: 10px;
            letter-spacing: 0.2px;
        }
        .divider {
            border: none;
            border-top: 1px solid #334155;
            margin: 24px 0;
        }
        .link-fallback {
            font-size: 12px;
            color: #64748b;
            line-height: 1.6;
        }
        .link-fallback a {
            color: #60a5fa;
            word-break: break-all;
        }
        .warning {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            margin-bottom: 24px;
        }
        .footer {
            background: #0f172a;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>Password Reset Request</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <div class="body">

            <p class="greeting">Hello, {{ $user->name }}!</p>

            <p class="message">
                We received a request to reset the password for your account associated with
                <strong style="color:#e2e8f0;">{{ $user->email }}</strong>.
                Click the button below to set a new password. This link will expire in
                <strong style="color:#e2e8f0;">60 minutes</strong>.
            </p>

            <div class="btn-wrap">
                <a href="{{ $resetUrl }}" class="btn">Reset My Password</a>
            </div>

            <div class="warning">
                ⚠️ If you did not request a password reset, please ignore this email. Your account is still secure.
            </div>

            <hr class="divider">

            <p class="link-fallback">
                If the button above doesn't work, copy and paste this link into your browser:<br>
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </p>

        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }} · This is an automated email, please do not reply.
        </div>

    </div>
</body>
</html>