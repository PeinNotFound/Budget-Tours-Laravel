@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('blog.create')}}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Blog Post
    </a>
</div>

<div class="card card-default">
    <div class="card-header">
        <h5 class="mb-0">Blog Posts</h5>
    </div>

    <div class="card-body">
        @if ($blog->count() > 0)
            <div class="row">
                @foreach ($blog as $post)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="blog-card">
                            <div class="blog-image">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('storage/placeholder.jpg') }}" alt="Placeholder" class="img-fluid">
                                @endif
                            </div>
                            <div class="blog-content">
                                <h5 class="blog-title">{{ $post->title }}</h5>
                                <div class="blog-meta">
                                    <span class="category">
                                        <i class="fas fa-folder"></i>
                                        <a href="{{route('categories.edit', $post->category->id)}}">
                                            {{$post->category->name}}
                                        </a>
                                    </span>
                                    <span class="date">
                                        <i class="fas fa-calendar"></i>
                                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Draft' }}
                                    </span>
                                </div>
                                <p class="blog-excerpt">{{ Str::limit($post->description, 100) }}</p>
                                <div class="blog-actions">
                                    @if ($post->trashed())
                                        <form action="{{route('restore-blog', $post->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fas fa-undo"></i> Restore
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{route('blog.edit', $post->id)}}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    @endif
                                    <form action="{{route('blog.destroy', $post->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-{{ $post->trashed() ? 'times' : 'trash' }}"></i>
                                            {{$post->trashed() ? 'Delete' : 'Trash'}}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">No Blog Posts Yet</h3>
                <p class="text-muted">Get started by adding your first blog post!</p>
                <a href="{{route('blog.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Blog Post
                </a>
            </div>
        @endif
    </div>
</div>

@endsection

@section('css')
<style>
.blog-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.blog-image {
    position: relative;
    padding-top: 60%;
    overflow: hidden;
}

.blog-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.05);
}

.blog-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2d3748;
}

.blog-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.875rem;
    color: #718096;
    margin-bottom: 1rem;
}

.blog-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.blog-meta a {
    color: #4a5568;
    text-decoration: none;
    transition: color 0.2s ease;
}

.blog-meta a:hover {
    color: #f15d30;
}

.blog-excerpt {
    color: #718096;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

.blog-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: auto;
}

.blog-actions .btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.blog-actions .btn i {
    font-size: 0.875rem;
}
</style>
@endsection