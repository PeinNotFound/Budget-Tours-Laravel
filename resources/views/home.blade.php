@extends('layouts.app')

@section('css')
<style>
    /* Dark mode styles */
    [data-theme="dark"] .section-title {
        color: #ffffff !important;
    }

    [data-theme="dark"] .dashboard-card {
        border: 1px solid var(--border-color);
    }

    [data-theme="dark"] .dashboard-card.bg-primary {
        background: linear-gradient(135deg, #2196F3, #1976D2) !important;
    }

    [data-theme="dark"] .dashboard-card.bg-success {
        background: linear-gradient(135deg, #4CAF50, #388E3C) !important;
    }

    [data-theme="dark"] .dashboard-card.bg-info {
        background: linear-gradient(135deg, #00BCD4, #0097A7) !important;
    }

    [data-theme="dark"] .dashboard-card.orange-card {
        background: linear-gradient(135deg, #FF4500, #FF5722) !important;
    }

    [data-theme="dark"] .card-header {
        background-color: var(--bg-secondary) !important;
        border-bottom-color: var(--border-color);
    }

    [data-theme="dark"] .activity-item:hover {
        background-color: var(--hover-bg) !important;
    }

    [data-theme="dark"] .activity-icon {
        background-color: var(--hover-bg) !important;
    }

    [data-theme="dark"] .quick-action-btn {
        background-color: var(--bg-secondary) !important;
        color: var(--text-primary) !important;
        border: 1px solid var(--border-color);
    }

    [data-theme="dark"] .quick-action-btn:hover {
        background: linear-gradient(135deg, #FF4500, #FF5722) !important;
        color: #ffffff !important;
        border: none;
    }

    /* Base styles */
    .section-title {
        color: var(--text-primary) !important;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .dashboard-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px var(--shadow-color);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card.bg-primary {
        background: linear-gradient(135deg, #2196F3, #1976D2) !important;
    }

    .dashboard-card.bg-success {
        background: linear-gradient(135deg, #4CAF50, #388E3C) !important;
    }

    .dashboard-card.bg-info {
        background: linear-gradient(135deg, #00BCD4, #0097A7) !important;
    }

    .dashboard-card.orange-card {
        background: linear-gradient(135deg, #FF4500, #FF5722) !important;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px var(--shadow-color);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
    }

    .icon-circle i {
        font-size: 28px;
        color: white;
    }

    .stat-card-value {
        font-size: 2.5rem;
        font-weight: 600;
        margin: 0;
        color: #ffffff;
    }

    .stat-card-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
        opacity: 0.9;
        color: #ffffff;
    }

    .activity-item {
        padding: 1rem;
        border-radius: 10px;
        transition: background-color 0.2s ease;
        color: var(--text-primary);
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    .quick-action-btn {
        border-radius: 12px;
        padding: 1.2rem;
        transition: all 0.3s ease;
        border: none;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    .quick-action-btn:hover {
        transform: translateY(-3px);
        background: #FF4500;
        color: white;
        text-decoration: none;
    }

    .quick-action-btn i {
        font-size: 1.8rem;
    }

    /* Card styles */
    .card-header {
        background: none;
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem 1.5rem 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Smooth transition for dark mode */
    body, .dashboard-card, .card-header, .activity-item, .quick-action-btn, .text-muted {
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Dashboard Overview</h1>
        <a href="{{ route('destinations.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px; background: linear-gradient(135deg, #FF4500, #FF5722); border: none;">
            <i class="fas fa-plus mr-2"></i> New Destination
        </a>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-circle">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3 class="stat-card-value text-white">{{ $destinationsCount }}</h3>
                    </div>
                    <p class="stat-card-label text-white">Total Destinations</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-circle">
                            <i class="fas fa-folder"></i>
                        </div>
                        <h3 class="stat-card-value text-white">{{ $categoriesCount }}</h3>
                    </div>
                    <p class="stat-card-label text-white">Categories</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card bg-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-circle">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3 class="stat-card-value text-white">{{ $postsCount }}</h3>
                    </div>
                    <p class="stat-card-label text-white">Blog Posts</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card dashboard-card orange-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-circle">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="stat-card-value text-white">{{ $usersCount }}</h3>
                    </div>
                    <p class="stat-card-label text-white">Total Users</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="section-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentDestinations->count() > 0)
                        @foreach($recentDestinations as $destination)
                            <div class="activity-item mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon mr-3">
                                        <i class="fas fa-plus text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 font-weight-bold">{{ $destination->title }}</h6>
                                        <p class="text-muted mb-0 small">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $destination->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                            <p class="text-muted mb-0">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="section-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <a href="{{ route('destinations.create') }}" class="quick-action-btn">
                                <i class="fas fa-plus"></i>
                                <span>Add Destination</span>
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('blog.create') }}" class="quick-action-btn">
                                <i class="fas fa-edit"></i>
                                <span>New Blog Post</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('categories.create') }}" class="quick-action-btn">
                                <i class="fas fa-folder-plus"></i>
                                <span>Add Category</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('tags.create') }}" class="quick-action-btn">
                                <i class="fas fa-tags"></i>
                                <span>Add Tag</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
