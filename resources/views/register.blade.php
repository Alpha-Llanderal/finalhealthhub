@extends('layouts.app')
@section('title', 'HealthHub Connect')
@section('content')

<!-- MAIN CONTENT -->
<main>
    <!-- Logo and Title Section -->
    <section class="portal-container">
        <div class="card text-center p-4 mx-auto my-5" style="max-width: 600px;">
            <div class="portal-logo mb-3">
                <img src="img/logo.png" alt="HealthHub Logo" class="img-fluid mb-3">
                <h2 class="fw-bold">Patient Portal</h2>

                <!-- Registration Form -->
                <form class="mt-4" id="registrationForm" novalidate>
                    <div id="registrationAlert" class="alert alert-danger d-none" role="alert"></div>
                    <div class="mb-3 text-start">
                        <label for="firstName" class="form-label">First Name *</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter your first name" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="lastName" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="emailSignUp" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="emailSignUp" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="passwordSignUp" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="passwordSignUp" placeholder="Create a password" required>
                    </div>
                    <a href="{{ url('/login') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill me-1"></i> Register
                    </a>                   
                </form>
            </div>
        </div>
    </section>
</main>

@endsection
</body>
</html>
