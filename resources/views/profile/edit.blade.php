@extends('layouts.app')

@section('css')
<style>
    .profile-section {
        background: var(--bg-secondary);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px var(--shadow-color);
        border: 1px solid var(--border-color);
    }

    .profile-section h3 {
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .profile-section h3 i {
        margin-right: 0.75rem;
        color: #FF4500;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #FF4500;
        box-shadow: 0 0 0 0.2rem rgba(255, 69, 0, 0.25);
    }

    .btn-primary {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(255, 69, 0, 0.2);
    }

    .avatar-upload {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .current-avatar {
        width: 100px;
        height: 100px;
        border-radius: 15px;
        margin-bottom: 1rem;
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .avatar-upload:hover .current-avatar {
        border-color: #FF4500;
    }

    .custom-file-upload {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-file-upload:hover {
        background: var(--hover-bg);
        border-color: #FF4500;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Profile Information -->
            <div class="profile-section">
                <h3><i class="fas fa-user-circle"></i>{{ __('Profile Information') }}</h3>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="avatar-upload">
                        @if($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Picture" class="current-avatar">
                        @else
                            <div class="current-avatar d-flex align-items-center justify-content-center" style="background-color: {{ '#' . substr(md5($user->email), 0, 6) }}; color: white; font-size: 2.5rem; font-weight: bold; text-transform: uppercase;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <label class="custom-file-upload">
                            <input type="file" name="avatar" id="avatar" class="d-none">
                            <i class="fas fa-camera mr-2"></i>Change Photo
                        </label>
                        @error('avatar')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>{{ __('Update Profile') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Update -->
            <div class="profile-section">
                <h3><i class="fas fa-lock"></i>{{ __('Update Password') }}</h3>
                <form method="POST" action="{{ route('profile.update-password') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm New Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key mr-2"></i>{{ __('Update Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.current-avatar').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endsection

@endsection 