@extends('front.layouts.app')

@section('content')
<section id="login-section" style="padding: 120px 0 80px; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">Welcome Back</span>
            <h2 class="stitle">Login to <span>Your Account</span></h2>
            <div class="sline"></div>
            <p class="sdesc mx-auto" style="max-width:480px;">Enter your credentials to access your account, track orders, and discover new favorites.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8" data-aos="zoom-in">
                <div class="fcard" style="position: relative; margin-bottom: 50px;">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="col-12 text-center text-danger mb-3">
    @if ($errors->any())
        <div class="alert alert-danger" style="background: rgba(232, 40, 26, 0.1); border: 1px solid rgba(232, 40, 26, 0.2); color: #e8281a; border-radius: 8px; padding: 10px;">
            <ul class="mb-0" style="list-style: none; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="flbl">Email Address *</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="fctrl" placeholder="yourname@gmail.com" required/>
                            </div>

                            <div class="col-12">
                                <label class="flbl">Password *</label>
                                <input type="password" name="password" class="fctrl" placeholder="Enter your password" required/>
                            </div>

                            <div class="col-12 d-flex justify-content-between align-items-center mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe" style="color: #666; font-size: 0.9rem;">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" style="color: var(--secondary); font-size: 0.9rem; text-decoration: none;">Forgot Password?</a>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-red w-100 justify-content-center">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <p style="color: #666; font-size: 0.95rem;">
                                    Don't have an account? <a href="/register" style="color: var(--primary); font-weight: 600; text-decoration: none;">Sign Up here</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
