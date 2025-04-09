@extends('layouts.app')

@section('content')
<div class="hero-wrap" style="background-image: url('{{ asset('images/bg_1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 text-center">
                <h1 class="mb-3 bread">Search Results</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                    <span>Search</span>
                </p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate p-4 mb-4" style="background: rgba(255, 255, 255, 0.95); border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-0" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); z-index: 10;">
                                            <i class="ion-ios-search" style="font-size: 24px; color: #000;"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="query" class="form-control py-3" placeholder="Search destinations, activities..." 
                                        style="height: 50px; border-radius: 5px 0 0 5px; border: 1px solid #e6e6e6; padding-left: 50px; color: #000; font-size: 16px;"
                                        value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary px-5" style="height: 50px; border-radius: 0 5px 5px 0; background: #f9ab30; border: none; font-weight: 600;">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @if(isset($destinations) && $destinations->count() > 0)
                @foreach($destinations as $destination)
                    <div class="col-md-4 ftco-animate">
                        <div class="destination">
                            <a href="{{ route('desti.show', $destination->id) }}" class="img img-2 d-flex justify-content-center align-items-center" 
                                style="background-image: url({{ asset('storage/' . $destination->primaryImage->image) }});">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="text p-3">
                                <span class="price">${{ $destination->price }}</span>
                                <p>{{ $destination->days }} Days Tour</p>
                                <h3><a href="{{ route('desti.show', $destination->id) }}">{{ $destination->title }}</a></h3>
                                <p class="days"><span>{{ $destination->location }}</span></p>
                                <hr>
                                <p class="bottom-area d-flex">
                                    <span><i class="icon-map-o"></i> {{ $destination->category->name }}</span>
                                    <span class="ml-auto"><a href="{{ route('desti.show', $destination->id) }}">Discover</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <h3>No destinations found matching your search.</h3>
                    <p>Try searching with different keywords.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection 