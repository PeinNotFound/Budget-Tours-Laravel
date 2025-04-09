@extends('layouts.app')

@section('css')
<style>
    .form-container {
        background: var(--bg-secondary) !important;
        border-radius: 15px;
        box-shadow: 0 4px 6px var(--shadow-color);
        border: 1px solid var(--border-color);
        padding: 2rem;
        margin-top: 1rem;
    }

    .form-title {
        color: var(--text-primary) !important;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-primary) !important;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        background-color: var(--input-bg) !important;
        border-color: var(--input-border) !important;
        color: var(--input-text) !important;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--accent-color) !important;
        box-shadow: 0 0 0 0.2rem var(--accent-shadow) !important;
    }

    .image-upload-container {
        border: 2px dashed var(--border-color);
        background-color: var(--input-bg) !important;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--text-primary) !important;
    }

    .image-upload-container:hover {
        border-color: var(--accent-color);
    }

    .btn-success {
        background-color: var(--accent-color) !important;
        border-color: var(--accent-color) !important;
        color: var(--text-primary) !important;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        opacity: 0.9;
    }

    .image-preview-wrapper {
        position: relative;
        display: inline-block;
    }

    .delete-image-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .delete-image-btn:hover {
        background: rgba(220, 53, 69, 1);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="form-title">{{isset($category)? 'Edit Category': 'Create Category'}}</h2>
                @include('partials.errors')

                <form action="{{isset($category) ? route('categories.update', $category->id) :route('categories.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($category))
                    @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" name="name"
                            value="{{ isset($category)? $category->name:'' }}" placeholder="Enter category name">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" 
                            placeholder="Enter category description">{{ isset($category)? $category->description:'' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Category Image</label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <input type="file" class="d-none" id="image" name="image" accept="image/*">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                            <p class="mb-1">Click to upload image or drag and drop</p>
                            <small class="text-muted">Supported formats: JPG, PNG, GIF</small>
                        </div>
                        @if(isset($category) && $category->image)
                        <div class="mt-3 image-preview-wrapper">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                                class="img-thumbnail" style="max-width: 200px;">
                            <button type="button" class="delete-image-btn" onclick="deleteImage()">
                                <i class="fas fa-times"></i>
                            </button>
                            <input type="checkbox" name="delete_image" id="delete_image" class="d-none">
                        </div>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success">
                            {{isset($category) ? 'Update Category' : 'Add Category'}}
                        </button>
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
    const imageInput = document.getElementById('image');
    let previewWrapper = document.querySelector('.image-preview-wrapper');

    // Handle click on upload container
    imageUploadContainer.addEventListener('click', () => imageInput.click());

    // Handle drag and drop
    imageUploadContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadContainer.style.borderColor = 'var(--accent-color)';
    });

    imageUploadContainer.addEventListener('dragleave', (e) => {
        e.preventDefault();
        imageUploadContainer.style.borderColor = 'var(--border-color)';
    });

    imageUploadContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadContainer.style.borderColor = 'var(--border-color)';
        if (e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            handleImagePreview(e.dataTransfer.files[0]);
        }
    });

    // Handle file input change
    imageInput.addEventListener('change', (e) => {
        if (e.target.files.length) {
            handleImagePreview(e.target.files[0]);
        }
    });

    function handleImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Check if preview wrapper exists
            previewWrapper = document.querySelector('.image-preview-wrapper');
            
            if (previewWrapper) {
                // If wrapper exists but was hidden (after deletion), show it
                if (previewWrapper.style.display === 'none') {
                    previewWrapper.style.display = 'block';
                }
                const img = previewWrapper.querySelector('img');
                img.src = e.target.result;
            } else {
                // Create new preview wrapper if it doesn't exist
                const newPreview = document.createElement('div');
                newPreview.className = 'mt-3 image-preview-wrapper';
                newPreview.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px;">
                    <button type="button" class="delete-image-btn" onclick="deleteImage()">
                        <i class="fas fa-times"></i>
                    </button>
                    <input type="checkbox" name="delete_image" id="delete_image" class="d-none">
                `;
                imageUploadContainer.parentNode.insertBefore(newPreview, imageUploadContainer.nextSibling);
            }
        }
        reader.readAsDataURL(file);
    }
});

function deleteImage() {
    const deleteCheckbox = document.getElementById('delete_image');
    const previewWrapper = document.querySelector('.image-preview-wrapper');
    const imageInput = document.getElementById('image');
    
    if (deleteCheckbox) {
        deleteCheckbox.checked = true;
    }
    
    if (previewWrapper) {
        previewWrapper.style.display = 'none';
    }
    
    // Clear the file input
    imageInput.value = '';
    
    // Reset the delete checkbox
    if (deleteCheckbox) {
        deleteCheckbox.checked = false;
    }
}
</script>
@endsection