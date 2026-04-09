<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #17a2b8 0%, #0d6efd 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #17a2b8 0%, #0d6efd 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            margin-bottom: 10px;
        }

        .login-header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #17a2b8 0%, #0d6efd 100%);
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(23, 162, 184, 0.4);
            color: white;
        }

        .alert {
            border-radius: 6px;
            border: none;
            margin-bottom: 20px;
        }

        .text-center {
            margin-top: 20px;
        }

        .demo-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
            font-size: 13px;
        }

        .demo-info h6 {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .demo-info p {
            margin: 5px 0;
            color: #666;
        }

        .demo-info code {
            background: white;
            padding: 2px 6px;
            border-radius: 3px;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-tools"></i> Peminjaman Alat</h1>
            <p>Sistem Informasi Peminjaman Alat</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username') }}" autofocus required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>
            </form>

            <div class="demo-info">
                <h6>Demo Credentials:</h6>
                <p><strong>Admin:</strong> <code>admin</code> / <code>password</code></p>
                <p><strong>Petugas:</strong> <code>petugas1</code> / <code>password</code></p>
                <p><strong>Peminjam:</strong> Check database for users with role 'peminjam'</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
