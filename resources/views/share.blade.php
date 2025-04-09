@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="text-center mb-4">Share Your Experience</h1>
                    
                    <form action="{{ route('share.search') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder="Search destinations..." value="{{ $query ?? '' }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>

                    @if(isset($destinations) && $destinations->count() > 0)
                        <div class="row">
                            @foreach($destinations as $destination)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $destination->name }}</h5>
                                            <p class="card-text">{{ Str::limit($destination->description, 100) }}</p>
                                            <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-primary">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(isset($query))
                        <div class="alert alert-info">
                            No destinations found matching your search.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 