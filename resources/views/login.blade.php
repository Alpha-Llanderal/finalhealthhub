@extends('layouts.app')
@section('title', 'HealthHub Connect')
@section('content')


<!-- MAIN CONTENT -->
<main>
    <!-- Logo and Title Section -->
    <section class="portal-container">
        <div class="card text-center p-4 mx-auto" style="max-width: 600px;">
            <div class="portal-logo mb-3">
                <img src="img/logo.png" alt="HealthHub Logo" class="img-fluid mb-3">
                <h2 class="fw-bold">Patient Portal</h2>

                <!-- Login Form -->
                <form class="mt-4" onsubmit="event.preventDefault(); login();">
                    <div class="mb-3">
                        <input type="email" class="form-control" id="emailSignUp" aria-label="Enter your email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="passwordSignUp" aria-label="Enter your password" placeholder="Enter your password" required>
                    </div>
                    <a href="{{ url('/dashboard') }}" class="btn btn-success" aria-label="Login to Patient Portal">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection
</body>
</html>
