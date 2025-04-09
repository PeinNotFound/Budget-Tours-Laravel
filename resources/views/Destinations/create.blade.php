@extends('layouts.app')

@section('css')
<style>
:root {
    --form-bg: #ffffff;
    --input-bg: #ffffff;
    --input-text: #2d3748;
    --input-border: #e2e8f0;
    --label-text: #4a5568;
    --card-bg: #ffffff;
    --placeholder-text: #a0aec0;
    --accent-color: #f15d30;
    --accent-hover: #e04d20;
    --accent-shadow: rgba(241, 93, 48, 0.2);
}

[data-bs-theme="dark"] {
    --form-bg: #1a202c;
    --input-bg: #2d3748;
    --input-text: #e2e8f0;
    --input-border: #4a5568;
    --label-text: #e2e8f0;
    --card-bg: #2d3748;
    --placeholder-text: #718096;
}

.card {
    background: var(--card-bg);
    border: 1px solid var(--input-border);
        border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: var(--card-bg);
    border-bottom: 1px solid var(--input-border);
    padding: 1.5rem;
    border-radius: 15px 15px 0 0 !important;
}

.card-header h5 {
    color: var(--label-text);
        font-weight: 600;
    margin: 0;
}

.card-body {
    background: var(--form-bg);
    padding: 2rem;
    border-radius: 0 0 15px 15px;
}

.form-label {
    color: var(--label-text) !important;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

    .form-control {
        background-color: var(--input-bg) !important;
    border: 1px solid var(--input-border) !important;
        color: var(--input-text) !important;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--accent-color) !important;
    box-shadow: 0 0 0 3px var(--accent-shadow) !important;
    }

    .form-control::placeholder {
    color: var(--placeholder-text) !important;
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236B7280' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}

    .image-upload-container {
    border: 2px dashed var(--input-border);
    background: var(--input-bg);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
}

.image-upload-container:hover,
.image-upload-container.dragover {
        border-color: var(--accent-color);
    background: var(--form-bg);
    }

    .upload-icon {
        color: var(--accent-color);
    font-size: 2.5rem;
        margin-bottom: 1rem;
    }

.upload-content p {
    color: var(--label-text);
    margin-bottom: 0.5rem;
}

.upload-content small {
    color: var(--placeholder-text);
    }

    .image-preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

.preview-item {
    position: relative;
        border-radius: 8px;
        overflow: hidden;
    aspect-ratio: 1;
    }

.preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

.preview-actions {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.5rem;
    display: flex;
    gap: 0.5rem;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 0 8px 0 8px;
}

    .btn-primary {
        background-color: var(--accent-color) !important;
        border-color: var(--accent-color) !important;
    color: white !important;
        padding: 0.75rem 1.5rem;
    font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--accent-hover) !important;
        border-color: var(--accent-hover) !important;
        transform: translateY(-1px);
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .required::after {
        content: '*';
    color: #dc3545;
        margin-left: 4px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ isset($destinations) ? 'Edit Destination' : 'Create Destination' }}</h5>
        </div>

        <div class="card-body">
            @include('partials.errors')
            
            <form action="{{ isset($destinations) ? route('destinations.update', $destinations->id) : route('destinations.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                    @csrf
                @if(isset($destinations))
                    @method('PUT')
                @endif

                <div class="form-group mb-4">
                        <label for="title" class="form-label">Title</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           name="title" 
                           id="title"
                           value="{{ isset($destinations) ? $destinations->title : old('title') }}"
                           placeholder="Enter destination title">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group mb-4">
                        <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" 
                              id="description" 
                              rows="3"
                              placeholder="Enter a brief description">{{ isset($destinations) ? $destinations->description : old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group mb-4">
                    <label for="content" class="form-label">Detailed Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              name="content" 
                              id="content" 
                              rows="6"
                              placeholder="Enter detailed content">{{ isset($destinations) ? $destinations->content : old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   name="price" 
                                   id="price"
                                   step="0.01"
                                   value="{{ isset($destinations) ? $destinations->price : old('price') }}"
                                   placeholder="Enter price">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="days" class="form-label">Number of Days</label>
                            <input type="number" 
                                   class="form-control @error('days') is-invalid @enderror" 
                                   name="days" 
                                   id="days"
                                   value="{{ isset($destinations) ? $destinations->days : old('days') }}"
                                   placeholder="Enter number of days">
                                @error('days')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                <div class="form-group mb-4">
                        <label for="location" class="form-label">Location</label>
                    <input type="text" 
                           class="form-control @error('location') is-invalid @enderror" 
                           name="location" 
                           id="location"
                           value="{{ isset($destinations) ? $destinations->location : old('location') }}"
                           placeholder="Enter location">
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group mb-4">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" 
                            name="category_id" 
                            id="category">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (isset($destinations) && $destinations->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group mb-4">
                    <label class="form-label d-block">Images</label>
                        <div class="image-upload-container" id="imageUploadContainer">
                        <input type="file" 
                               class="d-none" 
                               id="images" 
                               name="images[]" 
                               accept="image/*" 
                               multiple>
                        <div class="upload-content">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <p class="mb-1">Click to upload images or drag and drop</p>
                            <small class="text-muted">Upload multiple high-quality images</small>
                        </div>
                    </div>
                    <div id="imagePreviewContainer" class="image-preview-container mt-3">
                        @if(isset($destinations) && $destinations->images)
                            @foreach($destinations->images as $image)
                                <div class="preview-item">
                                    <img src="{{ asset('storage/'.$image->image) }}" alt="Destination image">
                                    <div class="preview-actions">
                                        <button type="button" class="btn btn-sm btn-danger delete-image" data-image-id="{{ $image->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary set-primary" data-image-id="{{ $image->id }}" 
                                                {{ $image->is_primary ? 'disabled' : '' }}>
                                            {{ $image->is_primary ? 'Primary' : 'Set as Primary' }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('images')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        {{ isset($destinations) ? 'Update Destination' : 'Create Destination' }}
                        </button>
                    </div>
                </form>
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

    // Click to upload
    imageUploadContainer.addEventListener('click', () => {
        imageInput.click();
    });

    // Drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        imageUploadContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        imageUploadContainer.addEventListener(eventName, () => {
            imageUploadContainer.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        imageUploadContainer.addEventListener(eventName, () => {
            imageUploadContainer.classList.remove('dragover');
        });
    });

    // Handle dropped files
    imageUploadContainer.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    });

    // Handle selected files
    imageInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        [...files].forEach(file => {
            if (file.type.startsWith('image/')) {
            const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Image preview">
                        <div class="preview-actions">
                            <button type="button" class="btn btn-sm btn-danger remove-preview">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    imagePreviewContainer.appendChild(previewItem);

                    // Remove preview
                    previewItem.querySelector('.remove-preview').addEventListener('click', () => {
                        previewItem.remove();
                    });
            };
            reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection