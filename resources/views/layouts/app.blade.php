<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codes Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Professional UI styles for recruitment project */
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .navbar { border-bottom: 1px solid #e2e8f0; background: #ffffff !important; }
        .card { border: none; border-radius: 12px; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #4f46e5; border-color: #4f46e5; border-radius: 8px; font-weight: 600; transition: all 0.2s; }
        .btn-primary:hover { background-color: #4338ca; border-color: #4338ca; }

        /* Forced vertical pagination: Results info on top, buttons centered below */
        .pagination-wrapper nav .d-none.d-sm-flex { display: flex !important; flex-direction: column !important; align-items: center !important; gap: 10px; }
        .pagination-wrapper nav .d-none.d-sm-flex > div { width: auto !important; display: block !important; text-align: center !important; }
        .pagination-wrapper .pagination { margin-bottom: 0 !important; }
        .page-link { color: #4f46e5; border-radius: 8px !important; border: 1px solid #e2e8f0; padding: 8px 16px; font-weight: 600; }
        .page-item.active .page-link { background-color: #4f46e5; border-color: #4f46e5; color: #fff; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('codes.index') }}">
                <i class="fas fa-key me-2"></i>CodesApp
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('codes.index') ? 'active fw-bold' : '' }}" href="{{ route('codes.index') }}">Code List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('codes.create') ? 'active fw-bold' : '' }}" href="{{ route('codes.create') }}">Generate Codes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('codes.delete_form') ? 'active fw-bold' : '' }}" href="{{ route('codes.delete_form') }}">Delete Codes</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-user-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm ms-lg-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <x-system-messages />

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>