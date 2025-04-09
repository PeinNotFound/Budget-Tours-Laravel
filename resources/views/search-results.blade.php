@extends('layouts.front')

@section('page')
<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/bg_2.jpg') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    <span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                    <span>Search Results</span>
                </p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    Search Results for "{{ $query }}"
                </h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <!-- Modern Search Box -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="search-box ftco-animate">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control search-input" placeholder="Search destinations..." value="{{ $query }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn search-btn">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @if($destinations->count() > 0)
                @foreach($destinations as $destination)
                    <div class="col-md-4 ftco-animate">
                        <div class="project-wrap">
                            <a href="{{ route('desti.show', $destination->id) }}" class="img" style="background-image: url({{ asset('storage/' . optional($destination->primaryImage)->image) }});">
                                <span class="price">{{ $destination->price }}$/person</span>
                            </a>
                            <div class="text p-4">
                                <h3><a href="{{ route('desti.show', $destination->id) }}">{{ $destination->title }}</a></h3>
                                <p class="location"><span class="fa fa-map-marker"></span> {{ $destination->location }}</p>
                                <ul>
                                    <li><span class="flaticon-shower"></span>{{ $destination->days }} Days Tour</li>
                                    <li><span class="flaticon-mountains"></span>{{ optional($destination->category)->name }}</li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div>
                                        <span class="rate">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star-o"></i>
                                            <span>8 Rating</span>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="https://wa.me/+212622884174?text=Hi, I'm interested in booking: {{ urlencode($destination->title) }}%0A%0ADetails:%0A- Duration: {{ $destination->days }} Days%0A- Location: {{ $destination->location }}%0A- Price: ${{ $destination->price }} per person%0A%0APlease provide more information about availability and booking process." 
                                           target="_blank" 
                                           class="btn-custom book-btn">
                                            <i class="icon-whatsapp"></i> Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center ftco-animate">
                    <div class="alert alert-info">
                        <h4>No destinations found</h4>
                        <p>Try searching with different keywords or browse our featured destinations.</p>
                        <a href="{{ route('packages') }}" class="btn btn-primary mt-3">View All Destinations</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<style>
.project-wrap {
    margin-bottom: 30px;
    position: relative;
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.project-wrap:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.project-wrap .img {
    display: block;
    height: 250px;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

.project-wrap .price {
    position: absolute;
    top: 20px;
    left: 20px;
    background: orangered;
    color: #fff;
    padding: 8px 16px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
}

.project-wrap .text {
    position: relative;
    padding: 20px;
}

.project-wrap .text h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}

.project-wrap .text h3 a {
    color: #333;
    transition: all 0.3s ease;
}

.project-wrap .text h3 a:hover {
    color: orangered;
}

.project-wrap .text .location {
    color: #666;
    font-size: 15px;
    margin-bottom: 15px;
}

.project-wrap .text .location span {
    color: orangered;
    margin-right: 5px;
}

.project-wrap .text ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.project-wrap .text ul li {
    display: inline-block;
    margin-right: 20px;
    color: #666;
    font-size: 14px;
}

.project-wrap .text ul li span {
    color: orangered;
    margin-right: 5px;
}

.rate {
    color: #ffd700;
    font-size: 14px;
}

.rate span {
    color: #666;
    margin-left: 5px;
}

.btn-custom {
    display: inline-block;
    background: orangered;
    color: #fff;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-custom:hover {
    background: #ff3c00;
    color: #fff;
    text-decoration: none;
}

/* Modern Search Box Styles */
.search-box {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    margin-top: -70px;
    position: relative;
    z-index: 1;
}

.search-input {
    height: 60px;
    border: 2px solid #f1f1f1;
    border-right: none;
    border-radius: 30px 0 0 30px;
    padding: 0 30px;
    font-size: 16px;
    background: #fff;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: orangered;
    box-shadow: none;
}

.search-input::placeholder {
    color: #999;
}

.search-btn {
    min-width: 100px;
    height: 60px;
    background: orangered;
    border: none;
    border-radius: 0 30px 30px 0;
    color: #fff;
    font-size: 20px;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: #ff3c00;
    color: #fff;
}

.book-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25d366;  /* WhatsApp green */
    color: #fff;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.book-btn:hover {
    background: #128c7e;  /* Darker WhatsApp green */
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
}

.book-btn i {
    font-size: 18px;
}
</style>
@endsection 