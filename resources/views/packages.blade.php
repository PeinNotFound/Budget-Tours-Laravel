@extends('layouts.front')

@section('page')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/Destinations_overlay.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Tour Categories</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Categories <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Choose Your Tour Category</h2>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 ftco-animate mb-4">
                <div class="category-wrap">
                    <a href="{{ route('packages.category', $category->id) }}" class="category-link">
                        <div class="img-wrap">
                            @if($category->image)
                                <div class="img" style="background-image: url('{{ asset('storage/' . $category->image) }}');"></div>
                            @else
                                <div class="img" style="background-image: url('{{ asset('images/placeholder.jpg') }}');"></div>
                            @endif
                            <div class="text p-4">
                                <h2>{{ $category->name }}</h2>
                                @if($category->description)
                                    <p>{{ Str::limit($category->description, 100) }}</p>
                                @endif
                                <span class="destination-count">{{ $category->destinations_count ?? $category->destinations->count() }} Destinations</span>
                                <p class="view-more">View Destinations <i class="ion-ios-arrow-forward"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.category-wrap {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.category-wrap:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.category-link {
    text-decoration: none;
    color: inherit;
}

.category-link:hover {
    text-decoration: none;
    color: inherit;
}

.img-wrap {
    position: relative;
    width: 100%;
}

.img {
    height: 250px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.text {
    background: rgba(255, 255, 255, 0.95);
    padding: 1.5rem !important;
}

.text h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #000;
    margin-bottom: 1rem;
}

.text p {
    color: #666;
    margin-bottom: 0.5rem;
}

.destination-count {
    display: block;
    color: #f15d30;
    font-weight: 500;
    margin-bottom: 1rem;
}

.view-more {
    color: #f15d30;
    font-weight: 500;
    margin: 0;
}

.view-more i {
    transition: transform 0.3s ease;
}

.category-wrap:hover .view-more i {
    transform: translateX(5px);
}
</style>
@endsection