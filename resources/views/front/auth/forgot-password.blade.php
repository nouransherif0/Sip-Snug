@extends('front.layouts.app')

@section('content')
<section id="login-section" style="padding: 120px 0 80px; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">Forgot Password</span>
            <h2 class="stitle">Reset <span>Password</span></h2>
            <div class="sline"></div>
            <p class="sdesc mx-auto" style="max-width:480px;">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8" data-aos="zoom-in">
                <div class="fcard" style="position: relative; margin-bottom: 50px;">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" style="background: rgba(40, 167, 69, 0.1); border: 1px solid rgba(40, 167, 69, 0.2); color: #28a745; border-radius: 8px; padding: 10px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST">
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
                                <input type="email" name="email" value="{{ old('email') }}" class="fctrl" placeholder="yourname@gmail.com" required autofocus/>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-red w-100 justify-content-center">
                                    <i class="fas fa-envelope"></i> Email Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
