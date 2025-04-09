@extends('layouts.app')

@section('css')
<style>
    .form-container {
        background: var(--bg-secondary);
        border-radius: 15px;
        box-shadow: 0 4px 6px var(--shadow-color);
        border: 1px solid var(--border-color);
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .form-control {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #FF4500;
        box-shadow: 0 0 0 0.2rem rgba(255, 69, 0, 0.25);
    }

    .image-upload-container {
        border: 2px dashed var(--border-color);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-upload-container:hover {
        border-color: #FF4500;
    }

    .image-preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .image-preview {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-preview:hover .remove-image {
        opacity: 1;
    }

    .btn-primary {
        background: #FF4500;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(255, 69, 0, 0.2);
    }

    .btn-secondary {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: var(--hover-bg);
        color: var(--text-primary);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .form-text {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .current-images {
        margin-top: 1rem;
    }

    .current-image {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
    }

    .current-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .current-image .image-actions {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        padding: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .current-image .form-check {
        margin: 0;
    }

    .current-image .form-check-input {
        margin-top: 0;
    }

    .current-image .form-check-label {
        color: white;
        margin-left: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-container">
                <h2 class="mb-4">{{ isset($destination) ? 'Edit Destination' : 'Create Destination' }}</h2>
                <form method="POST" action="{{ isset($destination) ? route('destinations.update', $destination->id) : route('destinations.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($destination))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $destination->title ?? '') }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $destination->description ?? '') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content', $destination->content ?? '') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $destination->location ?? '') }}" required>
                        @error('location')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $destination->price ?? '') }}" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="days" class="form-label">Days</label>
                                <input type="number" class="form-control @error('days') is-invalid @enderror" id="days" name="days" value="{{ old('days', $destination->days ?? '') }}" required>
                                @error('days')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $destination->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Images</label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <input type="file" class="d-none" id="images" name="images[]" multiple accept="image/*">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #FF4500;"></i>
                            <p class="mb-0">Click to upload images or drag and drop</p>
                            <small class="form-text">You can select multiple images. The first image will be set as the primary image.</small>
                        </div>
                        <div class="image-preview-container" id="imagePreviewContainer"></div>
                        @error('images')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    @if(isset($destination) && $destination->images->count() > 0)
                    <div class="form-group">
                        <label class="form-label">Current Images</label>
                        <div class="row current-images">
                            @foreach($destination->images as $image)
                            <div class="col-md-3 mb-3">
                                <div class="current-image">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Destination Image">
                                    <div class="image-actions">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="delete_image_{{ $image->id }}" name="delete_images[]" value="{{ $image->id }}">
                                            <label class="form-check-label" for="delete_image_{{ $image->id }}">Delete</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="primary_image_{{ $image->id }}" name="primary_image" value="{{ $image->id }}" {{ $image->is_primary ? 'checked' : '' }}>
                                            <label class="form-check-label" for="primary_image_{{ $image->id }}">Primary</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($destination) ? 'Update' : 'Create' }} Destination
                        </button>
                        <a href="{{ route('destinations.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('images');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const previews = new Map();

    // Handle click on upload container
    imageUploadContainer.addEventListener('click', () => imageInput.click());

    // Handle drag and drop
    imageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadContainer.style.borderColor = '#FF4500';
    });

    imageUploadContainer.addEventListener('dragleave', () => {
        imageUploadContainer.style.borderColor = 'var(--border-color)';
    });

    imageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadContainer.style.borderColor = 'var(--border-color)';
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // Handle file input change
    imageInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const preview = document.createElement('div');
                    preview.className = 'image-preview';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-image" onclick="removePreview(this)">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    imagePreviewContainer.appendChild(preview);
                    previews.set(preview, file);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Add removePreview function to window object
    window.removePreview = function(button) {
        const preview = button.parentElement;
        previews.delete(preview);
        preview.remove();
    };
});
</script>
@endsection 