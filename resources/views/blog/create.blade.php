@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        {{isset($blog)? 'Edit Blog': 'Create Blog'}}
    </div>

    <div class="card-body">
        @include('partials.errors')
        <form
            action="{{isset($blog) ? route('blog.update', $blog->id): route('blog.store')}}"
            method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($blog))
            @method('PUT')

            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="{{isset($blog) ? $blog->title: ''}}">
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" class="form-control" name="description" id="description" cols="5"
                    rows="5">{{ isset($blog) ? $blog->description : ''}}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content"
                    value="{{isset($blog) ?$blog->content: ''}}">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at"
                    value="{{isset($blog) ?$blog->published_at: ''}}"">
            </div>
            @if (isset($blog))
            <div class=" form-group">
                <img src="{{asset($blog->image)}}" alt="" style="width: 100%">
            </div>
            @endif

            <div class="form-group">
                <label class="form-label">Blog Image</label>
                <div class="image-upload-container" id="imageUploadContainer">
                    <input type="file" class="d-none" id="image" name="image" accept="image/*" {{ !isset($blog) ? 'required' : '' }}>
                    <div class="upload-content">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="mb-1">Click to upload image or drag and drop</p>
                        <small class="form-text text-muted">Upload a high-quality image for your blog post</small>
                    </div>
                </div>
                <div class="image-preview-container mt-3" id="imagePreviewContainer">
                    @if (isset($blog) && $blog->image)
                        <div class="preview-item">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Current blog image" class="preview-image">
                        </div>
                    @endif
                </div>
                @error('image')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if (isset($blog) && $category->id === $blog->category_id)
                            selected
                        @endif
                    >
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            
            

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{isset($blog) ? 'Update Blog':'Create Blog'}}
                </button>
            </div>

        </form>
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
    });

    $(document).ready(function() {
        $('.tags-selector').select2();
        
        // Image upload handling
        const imageUploadContainer = document.getElementById('imageUploadContainer');
        const imageInput = document.getElementById('image');
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
            imageInput.files = files;
            handleFiles(files);
        });

        // Handle selected files
        imageInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreviewContainer.innerHTML = `
                            <div class="preview-item">
                                <img src="${e.target.result}" alt="Image preview" class="preview-image">
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
.image-upload-container {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #f15d30;
    background: #fff;
}

.image-upload-container.dragover {
    border-color: #f15d30;
    background: #fff;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.01); }
    100% { transform: scale(1); }
}

.upload-icon {
    font-size: 3rem;
    color: #f15d30;
    margin-bottom: 1rem;
}

.upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.image-preview-container {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.preview-item {
    position: relative;
    width: 200px;
    height: 150px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.remove-preview {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.remove-preview:hover {
    background: rgba(0,0,0,0.7);
}
</style>
@endsection