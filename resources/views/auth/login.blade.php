<x-guest-layout>
    <h4 class="fw-bold mb-3 text-center">Login</h4>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email Address</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-bold text-muted">Password</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label small" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">Log In</button>

        <div class="text-center">
            <a href="{{ route('register') }}" class="text-decoration-none small text-muted">Need an account? Register</a>
        </div>
    </form>
</x-guest-layout>