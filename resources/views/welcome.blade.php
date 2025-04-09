@extends('layouts.front')

@section('page')
<style>
    :root {
        --primary-color: #FF4500;
        --primary-hover: #FF5722;
    }

    /* Button styles */
    .btn-primary, 
    .btn.btn-primary,
    .form-control.btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
    }

    .btn-primary:hover, 
    .btn.btn-primary:hover {
        background-color: var(--primary-hover) !important;
        border-color: var(--primary-hover) !important;
    }

    /* Search box button */
    .search-wrap-1 .btn-primary {
        background-color: var(--primary-color) !important;
    }

    /* Links and active states */
    .text-primary,
    .ftco-navbar-light .navbar-nav > .active > a,
    .project-wrap .text .price,
    a:hover {
        color: var(--primary-color) !important;
    }

    /* Background elements */
    .bg-primary,
    .icon-video {
        background: var(--primary-color) !important;
    }
	
</style>

@include('partials.nav')

<div class="hero-wrap js-fullheight" style="background-image: url('images/mbt-bg.png');"
	data-stellar-background-ratio="0.5">
	<div class="overlay" style="background: rgba(0, 0, 0, 0.4);"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
			data-scrollax-parent="true">
			<div class="col-md-9 text text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
				<a href="https://lh3.googleusercontent.com/geougc/AF1QipP24x01WXO4sRBoigdaGqQSpZB9GkBb2gMHEFwQ=mm,37,22,18"
					class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="ion-ios-play"></span>
				</a>
				<p class="caps" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }" 
					style="color: #fff; font-weight: 600; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-size: 18px;">
					Travel to the any corner of the Morocco, without going around in circles
				</p>
				<h1 data-scrollax="properties: { translateY: '30%', opacity: 1.6 }" 
					style="color: #fff; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
					Make Your Tour Amazing With Us
				</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-no-pb ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-wrap-1 ftco-animate p-4" style="background: rgba(255, 255, 255, 0.95); border-radius: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
					<form action="{{ route('search') }}" method="GET">
						<div class="text-center mb-4">
							<h2 class="text-dark" style="font-weight: 600;">Where do you want to go?</h2>
						</div>
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
	</div>
</section>

<section class="ftco-section services-section bg-light">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate">
				<h2 class="mb-4">Tours, Day trips and Excursions From Marrakech</h2>
				<p>Marrakech is a treasure trove of mesmerizing history, culture, and architecture just waiting to be explored. For those looking to uncover the real Morocco, it's time to take a day trip outside the city. Thanks to Marrakech's strategic location, you can bask in the beauty of the Atlas Mountains, explore the ancient kasbahs of Ouarzazate and Ait Ben Haddou, or soak up the sea breeze in the charming coastal town of Essaouira. These day trips offer a fascinating insight into Morocco's diverse landscape, vibrant people, and rich heritage without having to venture too far.</p>
				<p><a href="#" class="btn btn-primary py-3 px-4">Search Destination</a></p>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6 d-flex align-self-stretch ftco-animate">
						<div class="media block-6 services d-block">
							<div class="icon"><span class="flaticon-paragliding"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Activities</h3>
								<p>Make memories with a variety of amazing tours from Marrakech. </p>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-self-stretch ftco-animate">
						<div class="media block-6 services d-block">
							<div class="icon"><span class="flaticon-route"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Travel Arrangements</h3>
								<p>Book last minute, free cancellation and payment options to satisfy any plans or budget </p>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-self-stretch ftco-animate">
						<div class="media block-6 services d-block">
							<div class="icon"><span class="flaticon-tour-guide"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Private Guide</h3>
								<p>Personalized rides with comfort, safety, and reliability. Meet & greet, door-to-door service. </p>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-self-stretch ftco-animate">
						<div class="media block-6 services d-block">
							<div class="icon"><span class="flaticon-map"></span></div>
							<div class="media-body">
								<h3 class="heading mb-3">Location Manager</h3>
								<p>We are recommended by our happy clients on Tripadvisor and Google </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-counter img" id="section-counter">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-6 d-flex">
				<div class="img d-flex align-self-stretch" style="background-image:url(images/morocco_blue.jpg);"></div>
			</div>
			<div class="col-md-6 pl-md-5 py-5">
				<div class="row justify-content-start pb-3">
					<div class="col-md-12 heading-section ftco-animate">
						<h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
						<p>Marrakech is a treasure trove of mesmerizing history, culture, and architecture just waiting to be explored. For those looking to uncover the real Morocco, it's time to take a day trip outside the city. Thanks to Marrakech's strategic location, you can bask in the beauty of the Atlas Mountains, explore the ancient kasbahs of Ouarzazate and Ait Ben Haddou, or soak up the sea breeze in the charming coastal town of Essaouira. These day trips offer a fascinating insight into Morocco's diverse landscape, vibrant people, and rich heritage without having to venture too far.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center mb-4">
							<div class="text">
								<strong class="number" data-number="300">0</strong>
								<span>Successful Tours</span>
							</div>
						</div>
					</div>
					<div class="col-md-4 justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center mb-4">
							<div class="text">
								<strong class="number" data-number="24000">0</strong>
								<span>Happy Tourist</span>
							</div>
						</div>
					</div>
					<div class="col-md-4 justify-content-center counter-wrap ftco-animate">
						<div class="block-18 text-center mb-4">
							<div class="text">
								<strong class="number" data-number="200">0</strong>
								<span>Place Explored</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4">Popular Destinations</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 ftco-animate">
				<div class="project-destination">
					<a href="#" class="img" style="background-image: url(images/agafayy.jpg);">
						<div class="text">
							<h3 style="color: black;">agafayy</h3>
							<span>8 Tours</span>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 ftco-animate">
				<div class="project-destination">
					<a href="#" class="img" style="background-image: url(images/Palemeraie.jpg);">
						<div class="text">
							<h3 style="color: black;">Palemeraie</h3>
							<span>2 Tours</span>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 ftco-animate">
				<div class="project-destination">
					<a href="#" class="img" style="background-image: url(images/marrakech_medina.jpg);">
						<div class="text">
							<h3 style="color: black;">Medina</h3>
							<span>5 Tours</span>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 ftco-animate">
				<div class="project-destination">
					<a href="#" class="img" style="background-image: url(images/ourika.jpg);">
						<div class="text">
							<h3>Ourika</h3>
							<span>5 Tours</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pt">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4">Tour Destination</h2>
			</div>
		</div>
		<div class="destination-slider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					@foreach ($destinations as $destination)
					<div class="swiper-slide">
						<div class="destination-card">
							<div class="image-container">
								@if($destination->primaryImage)
									<img src="{{ asset('storage/' . $destination->primaryImage->image) }}" alt="{{ $destination->title }}" class="destination-img">
								@else
									<img src="{{ asset('storage/placeholder.jpg') }}" alt="{{ $destination->title }}" class="destination-img">
								@endif
								<div class="category-badge">{{ $destination->category->name }}</div>
								<div class="price-badge">${{ number_format($destination->price) }}</div>
							</div>
							<div class="card-content">
								<div class="meta-info">
									<span class="days"><i class="far fa-clock"></i> {{ $destination->days }} Days Tour</span>
								</div>
								<h3><a href="{{ route('desti.show', $destination->id) }}">{{ $destination->title }}</a></h3>
								<div class="features">
									<span><i class="fas fa-bed"></i> 2</span>
									<span><i class="fas fa-bath"></i> 3</span>
									<span><i class="fas fa-umbrella-beach"></i> Near Beach</span>
								</div>
								<a href="{{ route('desti.show', $destination->id) }}" class="view-details">View Details</a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</section>

<!-- Add Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<style>
.destination-slider {
    padding: 20px 0;
    position: relative;
}

.swiper-container {
    padding: 20px 10px 40px;
}

.destination-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.destination-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.image-container {
    position: relative;
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

.destination-card:hover .destination-img {
    transform: scale(1.05);
}

.category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #f15d30;
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.price-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 1.1rem;
    font-weight: 600;
}

.card-content {
    padding: 1.5rem;
}

.meta-info {
    margin-bottom: 0.8rem;
}

.days {
    color: #666;
    font-size: 0.9rem;
}

.days i {
    color: #f15d30;
    margin-right: 5px;
}

.card-content h3 {
    font-size: 1.3rem;
    margin-bottom: 1rem;
}

.card-content h3 a {
    color: #2d3436;
    text-decoration: none;
    transition: color 0.3s ease;
}

.card-content h3 a:hover {
    color: #f15d30;
}

.features {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.2rem;
    color: #666;
    font-size: 0.9rem;
}

.features span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.features i {
    color: #f15d30;
}

.view-details {
    display: inline-block;
    background: #f15d30;
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.view-details:hover {
    background: #d64a1f;
    color: white;
    text-decoration: none;
    transform: translateX(5px);
}

/* Swiper Pagination */
.swiper-pagination {
    bottom: 0 !important;
}

.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #ddd;
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background: #f15d30;
    width: 20px;
    border-radius: 5px;
}

/* Swiper Navigation Buttons */
.swiper-button-next,
.swiper-button-prev {
    color: #f15d30;
    background: rgba(255, 255, 255, 0.9);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: #fff;
}

@media (max-width: 767px) {
    .swiper-button-next,
    .swiper-button-prev {
        display: none;
    }
}
</style>

<!-- Add Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        loop: true,
        effect: 'slide',
        speed: 800,
    });
});
</script>

<!-- Destination Details Modal -->
<div class="modal fade" id="destinationModal" tabindex="-1" role="dialog" aria-labelledby="destinationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="destinationModalLabel">Destination Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="destinationModalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Define the function in the global scope
function openDestinationModal(destinationId) {
    fetch(`/destinations/${destinationId}/modal`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            document.getElementById('destinationModalContent').innerHTML = html;
            jQuery('#destinationModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Initialize modal when document is ready
jQuery(document).ready(function($) {
    $('#destinationModal').modal({
        show: false
    });
});
</script>
@endpush

{{--<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_3.jpg);">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<h2 class="mb-4">Tourist Feedback</h2>
			</div>
		</div>
		<div class="row ftco-animate">
			<div class="col-md-12">
				<div class="carousel-testimony owl-carousel ftco-owl">
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
									and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
									and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
									and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
									and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap py-4">
							<div class="text">
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
									and Consonantia, there live the blind texts.</p>
								<div class="d-flex align-items-center">
									<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
									<div class="pl-3">
										<p class="name">Roger Scott</p>
										<span class="position">Marketing Manager</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center pb-4">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<h2 class="mb-4">Recent Post</h2>
			</div>
		</div>
		<div class="row d-flex">
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry justify-content-end">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
					</a>
					<div class="text mt-3 float-right d-block">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">21</span>
							</div>
							<div class="two">
								<span class="yr">2019</span>
								<span class="mos">August</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry justify-content-end">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
					</a>
					<div class="text mt-3 float-right d-block">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">21</span>
							</div>
							<div class="two">
								<span class="yr">2019</span>
								<span class="mos">August</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry">
					<a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
					</a>
					<div class="text mt-3 float-right d-block">
						<div class="d-flex align-items-center mb-4 topp">
							<div class="one">
								<span class="day">21</span>
							</div>
							<div class="two">
								<span class="yr">2019</span>
								<span class="mos">August</span>
							</div>
						</div>
						<h3 class="heading"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>--}}

<footer class="ftco-footer bg-bottom" style="background-image: url(images/footer-bg.jpg);">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Marrakech budget tours</h2>
					<p>Marrakech is a treasure trove of mesmerizing history, culture, and architecture just waiting to be explored. For those looking to uncover the real Morocco, it's time to take a day trip outside the city..</p>
					<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
						<li class="ftco-animate"><a href="https://www.tripadvisor.fr/Attraction_Review-g293734-d15323162-Reviews-Marrakech_Budget_Tours-Marrakech_Marrakech_Safi.html" target="_blank"><span class="icon-tripadvisor"></span></a></li>
						<li class="ftco-animate"><a href="https://web.facebook.com/ToursMoroccoTravel/" target="_blank"><span class="icon-facebook"></span></a></li>
						<li class="ftco-animate"><a href="https://www.instagram.com/marrakech_budget_tours/" target="_blank"><span class="icon-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4 ml-md-5">
					<h2 class="ftco-heading-2">Categories</h2>
					@foreach ($categories as $category)
					<div class="col-6">
						<a href="#">
							{{$category->name}}
						</a>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Tags</h2>
					@foreach ($tags as $tag)
					<div class="col-6">
						<a href="#">
							{{$tag->name}}
						</a>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Have any Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><span class="icon icon-map-marker"></span><span class="text">BELBAKAR 933 MARRAKECH.</span></li>
							<li><a href="#"><span class="icon icon-phone"></span><span
										class="text">+212xxxxxx</span></a></li>
							<li><a href="#"><span class="icon icon-envelope"></span><span
										class="text">info@marrakechbudgettours.com</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">

				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved
				</p>
			</div>
		</div>
	</div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
			stroke="#F96D00" /></svg></div>


@endsection