<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SR Greenscapes</title>
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
        .login-card .brand p { color: #888; font-size: 0.9rem; }
        .form-control:focus { border-color: #4a7c3f; box-shadow: 0 0 0 0.2rem rgba(74,124,63,0.25); }
        .btn-login {
            background: #4a7c3f; border: none; padding: 12px; font-weight: 600;
            border-radius: 8px; width: 100%; color: #fff; font-size: 1rem;
        }
        .btn-login:hover { background: #2d5a27; color: #fff; }
        .input-group-text { background: #f8f9fa; border-right: none; }
        .form-control { border-left: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <h3><i class="fas fa-leaf"></i> SR GREENSCAPES</h3>
            <p>Admin Panel Login</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
                </div>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="Password" required>
                </div>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="{{ route('admin.password.request') }}" class="text-decoration-none" style="color: #4a7c3f; font-size:0.9rem;">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
        </form>
    </div>
</body>
</html>
