<div class="container-fluid p-0">
    <div class="row">
        <!-- Left Column - Image -->
        <div class="col-md-6">
            @if($destination->primaryImage)
                <img src="{{ asset('storage/' . $destination->primaryImage->image) }}" 
                     alt="{{ $destination->title }}" 
                     class="img-fluid w-100" style="height: 400px; object-fit: cover;">
            @else
                <img src="{{ asset('storage/placeholder.jpg') }}" 
                     alt="{{ $destination->title }}" 
                     class="img-fluid w-100" style="height: 400px; object-fit: cover;">
            @endif
        </div>

        <!-- Right Column - Details -->
        <div class="col-md-6">
            <h2 class="mb-4">{{ $destination->title }}</h2>
            
            <div class="d-flex mb-3">
                <span class="cat">{{ $destination->category->name }}</span>
                <p class="price ml-auto">${{ number_format($destination->price, 2) }}<span>/person</span></p>
            </div>

            <div class="mb-4">
                <p>{{ $destination->description }}</p>
            </div>

            <ul class="list-unstyled mb-4">
                <li><span class="flaticon-calendar mr-2"></span>{{ $destination->days }} Days Tour</li>
                <li><span class="flaticon-map mr-2"></span>{{ $destination->location }}</li>
            </ul>

            @if($destination->images->count() > 0)
                <div class="gallery">
                    <h4 class="mb-3">Gallery</h4>
                    <div class="row">
                        @foreach($destination->images as $image)
                            <div class="col-4 mb-2">
                                <a href="{{ asset('storage/' . $image->image) }}" class="gallery-image">
                                    <img src="{{ asset('storage/' . $image->image) }}" 
                                         alt="{{ $destination->title }}" 
                                         class="img-fluid w-100" style="height: 100px; object-fit: cover;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <a href="#" class="btn btn-primary py-3 px-4">Book Now</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    if (typeof $.fn.magnificPopup !== 'undefined') {
        $('.gallery-image').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }
});
</script> 