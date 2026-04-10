<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Peminjaman Alat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #17a2b8;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0d6efd 100%);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background: white;
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 60px;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .sidebar-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .sidebar-header h5 {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -0.5px;
        }

        .sidebar-header small {
            display: block;
            font-size: 0.75rem;
            color: #7c8db0;
            margin-top: 3px;
        }

        .btn-group-sm .btn {
            padding: 0.4rem 0.6rem;
            font-size: 0.85rem;
        }

        .btn-group-sm .btn i {
            margin-right: 0.25rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            margin-top: 60px;
        }

        .sidebar .nav-link {
            color: #555;
            border-left: 4px solid transparent;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            margin: 2px 0;
        }

        .sidebar .nav-link:hover {
            background-color: #f5f5f5;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: #e7f4f7;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }

        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #138496;
            border-color: #138496;
        }

        .table {
            background: white;
            border-radius: 8px;
        }

        .table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }

        .table th {
            color: #555;
            font-weight: 600;
            padding: 15px;
            border-bottom: 2px solid #e0e0e0;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .badge {
            padding: 6px 10px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .card-header {
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 15px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                top: 0;
                margin-top: 60px;
            }

            .main-content {
                margin-left: 0;
                margin-top: 0;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-tools"></i> Peminjaman Alat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-5 pt-3">
        <div class="row">
            <!-- Sidebar -->
            @include('shared.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 main-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h4 class="alert-heading">Error!</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
