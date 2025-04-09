@extends('layouts.app')

@section('css')
<style>
    .error-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: var(--bg-primary);
    }

    .error-content {
        text-align: center;
        max-width: 600px;
        padding: 3rem;
        background: var(--bg-secondary);
        border-radius: 15px;
        box-shadow: 0 4px 6px var(--shadow-color);
        border: 1px solid var(--border-color);
    }

    .error-code {
        font-size: 8rem;
        font-weight: 700;
        color: #FF4500;
        line-height: 1;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .error-message {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .error-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn-home {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: #FF4500;
        color: white;
        border: none;
        text-decoration: none;
    }

    .btn-home:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(255, 69, 0, 0.2);
        color: white;
    }

    .btn-back {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: var(--bg-primary);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        text-decoration: none;
    }

    .btn-back:hover {
        transform: translateY(-1px);
        background: var(--hover-bg);
        color: var(--text-primary);
    }

    @media (max-width: 576px) {
        .error-code {
            font-size: 6rem;
        }

        .error-title {
            font-size: 1.5rem;
        }

        .error-actions {
            flex-direction: column;
        }

        .btn-home, .btn-back {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="error-container">
    <div class="error-content">
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-message">
            Oops! The page you're looking for doesn't exist or has been moved.
            Let's get you back on track.
        </p>
        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn-home">
                <i class="fas fa-home mr-2"></i>Go Home
            </a>
            <a href="javascript:history.back()" class="btn-back">
                <i class="fas fa-arrow-left mr-2"></i>Go Back
            </a>
        </div>
    </div>
</div>
@endsection 