@extends('front.layouts.app')

@section('content')
<section id="login-section" style="padding: 120px 0 80px; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">New Password</span>
            <h2 class="stitle">Create New <span>Password</span></h2>
            <div class="sline"></div>
            <p class="sdesc mx-auto" style="max-width:480px;">Enter your new password to access your account.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8" data-aos="zoom-in">
                <div class="fcard" style="position: relative; margin-bottom: 50px;">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                <input type="email" name="email" value="{{ old('email', $request->email) }}" class="fctrl" placeholder="yourname@gmail.com" required autofocus/>
                            </div>

                            <div class="col-12">
                                <label class="flbl">Password *</label>
                                <input type="password" name="password" class="fctrl" placeholder="Enter your new password" required/>
                            </div>
                            
                            <div class="col-12">
                                <label class="flbl">Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="fctrl" placeholder="Confirm your new password" required/>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-red w-100 justify-content-center">
                                    <i class="fas fa-lock"></i> Reset Password
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
