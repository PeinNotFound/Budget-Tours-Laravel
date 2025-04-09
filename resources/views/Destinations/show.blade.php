@extends('layouts.front')

@section('page')
<!-- Add lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@include('partials.nav')

<!-- Main Content Section -->
<section class="destination-section">
    <div class="container py-5">
        <div class="row">
            <!-- Breadcrumbs -->
            <div class="col-12 mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('packages') }}">Destinations</a></li>
                        <li class="breadcrumb-item active">{{ $destination->title }}</li>
                    </ol>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Title and Meta -->
                <div class="destination-header mb-4">
                    <h1 class="destination-title">{{ $destination->title }}</h1>
                    <div class="destination-meta">
                            <span class="cat">{{ $destination->category->name }}</span>
                        <span class="days"><i class="far fa-clock mr-1"></i>{{ $destination->days }} Days Tour</span>
                        <span class="location"><i class="fas fa-map-marker-alt mr-1"></i>{{ $destination->location }}</span>
                    </div>
                </div>

                <!-- Gallery -->
                @if($destination->images->count() > 0)
                <div class="destination-gallery mb-5">
                    <a href="{{ asset('storage/' . $destination->primaryImage->image) }}" 
                       data-lightbox="destination-gallery"
                       data-title="{{ $destination->title }}">
                        <img src="{{ asset('storage/' . $destination->primaryImage->image) }}" 
                             alt="{{ $destination->title }}" 
                             class="img-fluid rounded main-image">
                    </a>
                </div>
                <div class="gallery-thumbnails">
                    <div class="row g-2">
                        @foreach($destination->images as $image)
                            @if(!$image->is_primary)
                            <div class="col-4 col-md-3 mb-3">
                                <a href="{{ asset('storage/' . $image->image) }}" 
                                   data-lightbox="destination-gallery"
                                   data-title="{{ $destination->title }}"
                                   class="thumbnail-link">
                                    <img src="{{ asset('storage/' . $image->image) }}" 
                                         alt="{{ $destination->title }}" 
                                         class="img-fluid rounded thumbnail">
                                    <div class="thumbnail-overlay">
                                        <i class="fas fa-search-plus"></i>
                        </div>
                                </a>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                    <!-- Description -->
                <div class="content-section">
                    <h2>About This Tour</h2>
                        <p>{{ $destination->description }}</p>
                    <div class="mt-4">
                            {!! $destination->content !!}
                        </div>
                    </div>

                    <!-- Features -->
                <div class="features-section mt-5">
                    <h2>Tour Features</h2>
                    <div class="row g-4 mt-3">
                            <div class="col-md-4">
                            <div class="feature-card">
                                <i class="fas fa-bath feature-icon"></i>
                                <h4>Private Bathroom</h4>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="feature-card">
                                <i class="fas fa-bed feature-icon"></i>
                                <h4>Luxury Rooms</h4>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="feature-card">
                                <i class="fas fa-mountain feature-icon"></i>
                                <h4>Beautiful View</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <i class="fas fa-umbrella-beach feature-icon"></i>
                                <h4>Near Beach</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="booking-card">
                    <div class="price-tag mb-4">
                        <span class="amount">${{ number_format($destination->price, 2) }}</span>
                        <span class="per-person">/person</span>
                    </div>
                    
                    <div class="booking-info mb-4">
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span>{{ $destination->days }} Days Tour</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $destination->location }}</span>
                </div>
                        <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <span>{{ $destination->category->name }}</span>
                        </div>
                    </div>

                    <a href="https://wa.me/+212622884174?text=Hi, I'm interested in booking: {{ urlencode($destination->title) }}%0A%0ADetails:%0A- Duration: {{ $destination->days }} Days%0A- Location: {{ $destination->location }}%0A- Price: ${{ number_format($destination->price, 2) }} per person%0A%0APlease provide more information about availability and booking process." 
                       class="btn-book-now whatsapp-btn" 
                       target="_blank">
                        <i class="fab fa-whatsapp"></i> Book via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Main Styles */
.destination-section {
    padding-top: 120px;
    background: #f8f9fa;
}

.destination-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 1rem;
}

.destination-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.destination-meta span {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 1rem;
}

.destination-meta i {
    margin-right: 0.5rem;
    color: #f15d30;
}

.cat {
    background: #f15d30;
    color: white !important;
    padding: 0.3rem 1rem;
    border-radius: 20px;
}

/* Gallery Styles */
.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.thumbnail {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.thumbnail-link {
    position: relative;
    display: block;
}

.thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 0.25rem;
}

.thumbnail-overlay i {
    color: white;
    font-size: 1.5rem;
}

.thumbnail-link:hover .thumbnail-overlay {
    opacity: 1;
}

/* Content Styles */
.content-section {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
}

.content-section h2 {
    color: #2d3436;
    font-size: 1.75rem;
    margin-bottom: 1rem;
}

/* Features Styles */
.feature-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 1rem;
}

.feature-icon {
    font-size: 2rem;
    color: #f15d30;
    margin-bottom: 1rem;
}

/* Booking Card Styles */
.booking-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    position: sticky;
    top: 2rem;
}

.price-tag {
    text-align: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.amount {
    font-size: 2.5rem;
    font-weight: 700;
    color: #f15d30;
}

.per-person {
    color: #666;
    font-size: 1rem;
}

.booking-info {
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    color: #666;
}

.info-item i {
    width: 20px;
    margin-right: 1rem;
    color: #f15d30;
}

.whatsapp-btn {
    background: #25D366 !important;
    color: white !important;
    border: none !important;
    padding: 1rem !important;
    border-radius: 8px !important;
    width: 100% !important;
    font-weight: 600 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.5rem !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
}

.whatsapp-btn:hover {
    background: #128C7E !important;
    transform: translateY(-2px) !important;
}

.whatsapp-btn i {
    font-size: 1.25rem !important;
}

/* Responsive Styles */
@media (max-width: 991.98px) {
    .booking-card {
        position: static;
        margin-top: 2rem;
    }
    
    .destination-section {
        padding-top: 80px;
    }
    
    .destination-title {
        font-size: 2rem;
    }
}

@media (max-width: 767.98px) {
    .main-image {
        height: 300px;
    }
    
    .thumbnail {
        height: 80px;
    }
    
    .destination-meta {
        gap: 1rem;
    }
}
</style>

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