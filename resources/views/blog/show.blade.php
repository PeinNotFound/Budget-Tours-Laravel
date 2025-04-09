@extends('layouts.front')

@section('page')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('storage/'.$blog->image) }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">{{ $blog->title }}</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span class="mr-2"><a href="{{ route('blog') }}">Blog <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>{{ Str::limit($blog->title, 30) }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 blog-single">
                <div class="blog-content">
                    <div class="blog-meta mb-4">
                        <span class="mr-3">
                            <i class="far fa-folder text-primary"></i>
                            {{ $blog->category->name }}
                        </span>
                        <span class="mr-3">
                            <i class="far fa-calendar text-primary"></i>
                            {{ $blog->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <div class="blog-description">
                        {{ $blog->description }}
                    </div>

                    <div class="blog-body mt-4">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 sidebar pl-lg-5">
                <div class="sidebar-box">
                    <h3 class="heading-sidebar">Recent Posts</h3>
                    @foreach($recentBlogs as $recentBlog)
                    <div class="recent-blog mb-4">
                        <a href="{{ route('blog.show', $recentBlog->id) }}" class="recent-img">
                            <img src="{{ asset('storage/'.$recentBlog->image) }}" alt="{{ $recentBlog->title }}" class="img-fluid">
                        </a>
                        <div class="recent-content">
                            <h4><a href="{{ route('blog.show', $recentBlog->id) }}">{{ Str::limit($recentBlog->title, 40) }}</a></h4>
                            <span class="date"><i class="far fa-calendar"></i> {{ $recentBlog->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="sidebar-box">
                    <h3 class="heading-sidebar">Categories</h3>
                    <ul class="categories">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('packages.category', $category->id) }}">
                                {{ $category->name }}
                                <span>({{ $category->blogs ? $category->blogs->count() : 0 }})</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
.blog-single {
    background: #fff;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.blog-meta {
    display: flex;
    flex-wrap: wrap;
    color: #6c757d;
    font-size: 0.95rem;
}

.blog-meta span {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.blog-meta i {
    color: #f15d30;
}

.blog-description {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #4a5568;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #edf2f7;
}

.blog-body {
    color: #2d3748;
    line-height: 1.8;
}

.blog-body p {
    margin-bottom: 1.5rem;
}

.blog-body img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 2rem 0;
}

.sidebar-box {
    background: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.heading-sidebar {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f15d30;
}

.recent-blog {
    display: flex;
    gap: 1rem;
}

.recent-img {
    flex: 0 0 80px;
    height: 80px;
}

.recent-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.recent-content {
    flex: 1;
}

.recent-content h4 {
    font-size: 1rem;
    margin: 0 0 0.5rem;
}

.recent-content h4 a {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.2s ease;
}

.recent-content h4 a:hover {
    color: #f15d30;
}

.recent-content .date {
    font-size: 0.85rem;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.recent-content .date i {
    color: #f15d30;
}

.categories {
    list-style: none;
    padding: 0;
    margin: 0;
}

.categories li {
    border-bottom: 1px solid #edf2f7;
}

.categories li:last-child {
    border-bottom: none;
}

.categories a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    color: #4a5568;
    text-decoration: none;
    transition: color 0.2s ease;
}

.categories a:hover {
    color: #f15d30;
}

.categories span {
    color: #6c757d;
    font-size: 0.9rem;
}
</style>
@endsection 