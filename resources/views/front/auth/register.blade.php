@extends('front.layouts.app')

@section('content')
<section id="register-section" style="padding: 120px 0 80px; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">Join Our Community</span>
            <h2 class="stitle">Create an <span>Account</span></h2>
            <div class="sline"></div>
            <p class="sdesc mx-auto" style="max-width:480px;">Become a part of the Sip & Snug family to enjoy exclusive offers and faster checkout.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10" data-aos="zoom-in">
                <div class="fcard" style="position: relative; margin-bottom: 50px;">
                    <form action="{{ route('register') }}" method="POST">
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
                                <label class="flbl">Full Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="fctrl" placeholder="John Doe" required/>
                            </div>

                            <div class="col-12">
                                <label class="flbl">Email Address *</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="fctrl" placeholder="yourname@gmail.com" required/>
                            </div>
                            
                            <div class="col-sm-6">
                                <label class="flbl">Password *</label>
                                <input type="password" name="password" class="fctrl" placeholder="Create a password" required/>
                            </div>

                            <div class="col-sm-6">
                                <label class="flbl">Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="fctrl" placeholder="Confirm your password" required/>
                            </div>
                            
                            <div class="col-12 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms" style="color: #666; font-size: 0.9rem;">
                                        I agree to the <a href="#" style="color: var(--secondary); text-decoration: none;">Terms & Conditions</a> and <a href="#" style="color: var(--secondary); text-decoration: none;">Privacy Policy</a>.
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-red w-100 justify-content-center">
                                    <i class="fas fa-user-plus"></i> Create Account
                                </button>
                            </div>
                            
                            <div class="col-12 text-center mt-3">
                                <p style="color: #666; font-size: 0.95rem;">
                                    Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Login here</a>
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
