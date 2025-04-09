@extends('layouts.front')

@section('page')
<div class="video-background">
    <video autoplay muted loop playsinline id="myVideo">
        <source src="{{ asset('images/marrakech-bt.mp4') }}" type="video/mp4">
    </video>
</div>

<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>

<div class="container" style="margin-top: 120px; margin-bottom: 60px; position: relative; z-index: 2;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 15px;">
                <div class="card-header text-white text-center py-4" style="background: #FF4500; border-radius: 15px 15px 0 0;">
                    <h3 class="mb-0">{{ __('Register') }}</h3>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f8f9fa; border-right: none;">
                                        <i class="ion-ios-person"></i>
                                    </span>
                                </div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name" style="border-left: none;">
                            </div>
                            @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f8f9fa; border-right: none;">
                                        <i class="ion-ios-mail"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email" style="border-left: none;">
                            </div>
                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold">{{ __('Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f8f9fa; border-right: none;">
                                        <i class="ion-ios-lock"></i>
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password" style="border-left: none;">
                            </div>
                            @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="font-weight-bold">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f8f9fa; border-right: none;">
                                        <i class="ion-ios-lock"></i>
                                    </span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" style="border-left: none;">
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 0.5rem 1.5rem; color: #FF4500; border-color: #FF4500;">
                                {{ __('Back to Login') }}
                            </a>
                            <button type="submit" class="btn" style="padding: 0.5rem 1.5rem; background: #FF4500; color: white;">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3" style="background: transparent; border-top: none;">
                    <div class="small">
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}" style="color: #FF4500;">Login here!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
<style>
    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        overflow: hidden;
    }
    
    .video-background video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        object-fit: cover;
    }

    #particles-js {
        background: rgba(0, 0, 0, 0.3);
    }

    body {
        min-height: 100vh;
        background: transparent;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }
    .form-control {
        border-left: none;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    .btn {
        transition: all 0.3s ease;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
particlesJS('particles-js',
{
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#FF4500"
    },
    "shape": {
      "type": "circle"
    },
    "opacity": {
      "value": 0.5,
      "random": false
    },
    "size": {
      "value": 3,
      "random": true
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#FF4500",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "repulse"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    }
  },
  "retina_detect": true
});
</script>
@endpush
@endsection
