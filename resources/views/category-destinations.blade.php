@extends('layouts.front')

@section('page')
<!-- Add lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('storage/images/bg_4.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">{{ $category->name }}</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span class="mr-2"><a href="{{ route('packages') }}">Categories <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>{{ $category->name }} <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Destinations in {{ $category->name }}</h2>
                @if($category->description)
                    <p class="mb-4">{{ $category->description }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            @foreach($destinations as $destination)
            <div class="col-md-4 ftco-animate mb-4">
                <div class="destination-card">
                    <div class="img-container">
                        @if($destination->primaryImage)
                            <a href="{{ asset('storage/' . $destination->primaryImage->image) }}" 
                               data-lightbox="destination-{{ $destination->id }}"
                               data-title="{{ $destination->title }}"
                               class="gallery-link">
                                <img src="{{ asset('storage/' . $destination->primaryImage->image) }}" 
                                     alt="{{ $destination->title }}" 
                                     class="destination-img">
                                @if($destination->images->count() > 1)
                                    <div class="gallery-indicator">
                                        <i class="fa fa-images"></i>
                                        <span>+{{ $destination->images->count() - 1 }}</span>
                                    </div>
                                @endif
                            </a>
                            {{-- Hidden links for additional images --}}
                            @foreach($destination->images as $image)
                                @if(!$image->is_primary)
                                    <a href="{{ asset('storage/' . $image->image) }}" 
                                       data-lightbox="destination-{{ $destination->id }}"
                                       data-title="{{ $destination->title }}"
                                       style="display: none;"></a>
                                @endif
                            @endforeach
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" 
                                 alt="Placeholder" 
                                 class="destination-img">
                        @endif
                    </div>
                    <div class="card-content">
                        <h3>{{ $destination->title }}</h3>
                        <p class="description">{{ Str::limit($destination->description, 100) }}</p>
                        <div class="card-footer">
                            <p class="price">${{ number_format($destination->price, 2) }}</p>
                            <a href="{{ route('desti.show', $destination) }}" class="btn-view">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                {{ $destinations->links() }}
            </div>
        </div>
    </div>
</section>

<style>
.destination-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.destination-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.img-container {
    position: relative;
    width: 100%;
    padding-top: 66.67%; /* 3:2 Aspect Ratio */
    overflow: hidden;
}

.destination-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-link:hover .destination-img {
    transform: scale(1.05);
}

.gallery-indicator {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.gallery-indicator i {
    font-size: 1rem;
}

.card-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.card-content h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 1rem;
}

.description {
    color: #636e72;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.price {
    color: #f15d30;
    font-weight: 600;
    font-size: 1.3rem;
    margin: 0;
}

.btn-view {
    background: #f15d30;
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    font-size: 0.95rem;
}

.btn-view:hover {
    background: #d64a1f;
    color: white;
    text-decoration: none;
    transform: translateX(3px);
}

/* Lightbox customization */
.lb-data .lb-caption {
    font-size: 1.1rem;
    font-weight: 500;
}

.lb-nav a.lb-prev,
.lb-nav a.lb-next {
    opacity: 0.8;
}

.lb-nav a.lb-prev:hover,
.lb-nav a.lb-next:hover {
    opacity: 1;
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Add lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Image %1 of %2',
        'disableScrolling': true,
        'fadeDuration': 300,
        'imageFadeDuration': 300
    });
</script>
@endsection 