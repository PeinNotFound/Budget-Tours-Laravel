@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Destination</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('destinations.update', $destinations) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $destinations->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $destinations->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $destinations->price) }}" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="days">Days</label>
                            <input type="number" class="form-control @error('days') is-invalid @enderror" id="days" name="days" value="{{ old('days', $destinations->days) }}" required>
                            @error('days')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $destinations->location) }}" required>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $destinations->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Current Images</label>
                            <div class="row">
                                @foreach($destinations->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="position-relative image-container">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="Destination Image" class="img-fluid rounded">
                                            <button type="button" class="delete-image" 
                                                    onclick="document.getElementById('delete_image_{{ $image->id }}').checked = true;"
                                                    title="Delete image"></button>
                                            <input type="checkbox" class="d-none" id="delete_image_{{ $image->id }}" name="delete_images[]" value="{{ $image->id }}">
                                            <div class="image-actions mt-2">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="primary_image_{{ $image->id }}" 
                                                           name="primary_image" value="{{ $image->id }}" {{ $image->is_primary ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="primary_image_{{ $image->id }}">
                                                        Set as primary image
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images">Add New Images</label>
                            <input type="file" class="form-control-file @error('images.*') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                            <small class="form-text text-muted">You can select multiple new images. If this is the first image upload, the first image will be set as the primary image.</small>
                            @error('images.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Destination</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    flatpickr('#published_at',{
        enableTime:true
    })

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
.image-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
}

.image-container img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.delete-image {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    width: 24px;
    height: 24px;
    border: none;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #dc3545;
}

.delete-image::before {
    content: "×";
    line-height: 1;
}

.image-container:hover .delete-image {
    opacity: 1;
}

.image-actions {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.9);
    padding: 8px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
</style>
@endsection 