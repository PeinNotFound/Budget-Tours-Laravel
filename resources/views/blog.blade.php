@extends('layouts.front')

@section('page')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/Blog_overlay.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Our Stories</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Blog <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="blog-entry h-100">
                    <div class="blog-image">
                        <a href="{{ route('blog.show', $blog->id) }}">
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                        </a>
                        <div class="blog-date">
                            <span class="day">{{ $blog->created_at->format('d') }}</span>
                            <span class="month">{{ $blog->created_at->format('M') }}</span>
                        </div>
                    </div>
                    <div class="blog-content p-4">
                        <div class="blog-meta mb-3">
                            <span><i class="far fa-folder"></i> {{ $blog->category->name }}</span>
                            <span><i class="far fa-calendar"></i> {{ $blog->created_at->format('Y') }}</span>
                        </div>
                        <h3 class="blog-title">
                            <a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
                        </h3>
                        <p class="blog-excerpt">{{ Str::limit($blog->description, 120) }}</p>
                        <a href="{{ route('blog.show', $blog->id) }}" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="row mt-5">
            <div class="col text-center">
                <div class="custom-pagination">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<style>
.blog-entry {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-entry:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.blog-image {
    position: relative;
    padding-top: 65%;
    overflow: hidden;
}

.blog-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-entry:hover .blog-image img {
    transform: scale(1.05);
}

.blog-date {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #f15d30;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(241, 93, 48, 0.2);
}

.blog-date .day {
    font-size: 1.5rem;
    font-weight: 700;
    display: block;
    line-height: 1;
}

.blog-date .month {
    font-size: 0.9rem;
    text-transform: uppercase;
}

.blog-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    background: #fff;
}

.blog-meta {
    display: flex;
    gap: 1rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.blog-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.blog-meta i {
    color: #f15d30;
}

.blog-title {
    font-size: 1.25rem;
    margin: 0.5rem 0;
    line-height: 1.4;
}

.blog-title a {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.2s ease;
}

.blog-title a:hover {
    color: #f15d30;
}

.blog-excerpt {
    color: #6c757d;
    margin-bottom: 1.5rem;
    line-height: 1.6;
    flex-grow: 1;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #f15d30;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s ease;
    margin-top: auto;
}

.read-more:hover {
    color: #e04d20;
    gap: 0.75rem;
    text-decoration: none;
}

.read-more i {
    font-size: 0.8rem;
    transition: transform 0.2s ease;
}

.read-more:hover i {
    transform: translateX(3px);
}

.custom-pagination {
    margin-top: 3rem;
}

.custom-pagination .pagination {
    justify-content: center;
    gap: 0.5rem;
}

.page-link {
    border-radius: 8px;
    border: none;
    color: #6c757d;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #f15d30;
    color: white;
}

.page-item.active .page-link {
    background: #f15d30;
    color: white;
}

.page-item.disabled .page-link {
    background: #f8f9fa;
    color: #adb5bd;
}
</style>
@endsection