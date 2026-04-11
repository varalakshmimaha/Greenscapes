<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SR Greenscapes Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2d5a27 0%, #1a3a15 50%, #4a7c3f 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-card .brand { text-align: center; margin-bottom: 30px; }
        .login-card .brand h3 { color: #2d5a27; font-weight: 700; }
        .form-control:focus { border-color: #4a7c3f; box-shadow: 0 0 0 0.2rem rgba(74,124,63,0.25); }
        .btn-login { background: #4a7c3f; border: none; padding: 12px; font-weight: 600; border-radius: 8px; width: 100%; color: #fff; }
        .btn-login:hover { background: #2d5a27; color: #fff; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <h3><i class="fas fa-leaf"></i> SR GREENSCAPES</h3>
            <p class="text-muted">Reset Your Password</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-login mb-3">
                <i class="fas fa-paper-plane me-2"></i>Send Reset Link
            </button>

            <div class="text-center">
                <a href="{{ route('admin.login') }}" class="text-decoration-none" style="color: #4a7c3f;">
                    <i class="fas fa-arrow-left me-1"></i>Back to Login
                </a>
            </div>
        </form>
    </div>
</body>
</html>
