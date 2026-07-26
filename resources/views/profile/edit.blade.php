@extends('front.layouts.app')

@section('content')
    <div class="container py-5" style="margin-top: 80px; min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--primary);">My Profile</h2>

                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                        Profile updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="border-radius: 12px;">
                        Password updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Profile Information -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; background: #fff;">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="mb-3" style="color: var(--primary); font-family: 'Playfair Display', serif;">Profile
                            Information</h4>
                        <p class="text-muted small mb-4">Update your account's profile information and email address.</p>



                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Profile Picture</label>
                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ $user->profile_image_url }}" alt="Profile Picture"
                                        style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                                    <input type="file" name="profile_image"
                                        class="form-control @error('profile_image') is-invalid @enderror" accept="image/*"
                                        style="border-radius: 10px; padding: 8px 15px;">
                                </div>
                                @error('profile_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required
                                    style="border-radius: 10px; padding: 12px 15px;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required
                                    style="border-radius: 10px; padding: 12px 15px;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror


                            </div>

                            <button type="submit" class="btn btn-dark"
                                style="background-color: var(--primary); border: none; border-radius: 25px; padding: 10px 30px; font-weight: 500;">Save
                                Changes</button>
                        </form>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; background: #fff;">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="mb-3" style="color: var(--primary); font-family: 'Playfair Display', serif;">Update
                            Password</h4>
                        <p class="text-muted small mb-4">Ensure your account is using a long, random password to stay
                            secure.</p>

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Current Password</label>
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                    required style="border-radius: 10px; padding: 12px 15px;">
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">New Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror" required
                                    style="border-radius: 10px; padding: 12px 15px;">
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    required style="border-radius: 10px; padding: 12px 15px;">
                                @error('password_confirmation', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark"
                                style="background-color: var(--primary); border: none; border-radius: 25px; padding: 10px 30px; font-weight: 500;">Update
                                Password</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card border-0 shadow-sm" style="border-radius: 15px; background: #fff;">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="mb-3 text-danger" style="font-family: 'Playfair Display', serif;">Delete Account</h4>
                        <p class="text-muted small mb-4">Once your account is deleted, all of its resources and data will be
                            permanently deleted. Before deleting your account, please download any data or information that
                            you wish to retain.</p>

                        <button type="button" class="btn btn-outline-danger"
                            style="border-radius: 25px; padding: 10px 30px; font-weight: 500;" data-bs-toggle="modal"
                            data-bs-target="#confirmUserDeletionModal">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title text-danger" style="font-family: 'Playfair Display', serif;">Are you sure you
                        want to delete your account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">Once your account is deleted, all of its resources and data will be
                        permanently deleted. Please enter your password to confirm you would like to permanently delete your
                        account.</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Password" required style="border-radius: 10px; padding: 12px 15px;">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                style="border-radius: 25px; padding: 8px 25px;">Cancel</button>
                            <button type="submit" class="btn btn-danger"
                                style="border-radius: 25px; padding: 8px 25px;">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                myModal.show();
            });
        </script>
    @endif
@endsection
