@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h4 class="mb-4" style="color: var(--text-primary);">Edit Profile</h4>
            
            <div class="card" style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 10px;">
                <div class="card-body p-4">
                    @if(auth()->user()->is_admin)
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{ route('users.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf
                        @method('PUT')
                        
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: #FF4500;">
                                        <span style="font-size: 2.5rem; color: white; text-transform: uppercase;">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <label for="avatar" class="position-absolute mb-0" style="bottom: 0; right: 0; cursor: pointer;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #FF4500; border: 2px solid var(--bg-secondary);">
                                        <i class="fas fa-camera" style="color: white; font-size: 14px;"></i>
                                    </div>
                                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                                </label>
                            </div>
                            <small style="color: var(--text-secondary);">Click the camera icon to change your profile picture</small>
                        </div>

                        <div class="mb-4">
                            <label for="name" style="color: var(--text-primary); margin-bottom: 8px;">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0" style="background: var(--bg-primary);">
                                        <i class="fas fa-user" style="color: var(--text-secondary);"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border-0 @error('name') is-invalid @enderror" 
                                    name="name" id="name" value="{{ old('name', $user->name) }}" 
                                    style="background: var(--bg-primary); color: var(--text-primary);">
                            </div>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" style="color: var(--text-primary); margin-bottom: 8px;">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0" style="background: var(--bg-primary);">
                                        <i class="fas fa-envelope" style="color: var(--text-secondary);"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control border-0 @error('email') is-invalid @enderror" 
                                    name="email" id="email" value="{{ old('email', $user->email) }}" 
                                    style="background: var(--bg-primary); color: var(--text-primary);">
                            </div>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" onclick="window.history.back()" class="btn" 
                                style="background: var(--bg-primary); color: var(--text-primary); min-width: 120px;">
                                Cancel
                            </button>
                            <button type="submit" class="btn" 
                                style="background: #FF4500; color: white; min-width: 120px;">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.querySelector('.rounded-circle');
            if (img.tagName === 'IMG') {
                img.src = e.target.result;
            } else {
                const newImg = document.createElement('img');
                newImg.src = e.target.result;
                newImg.classList.add('rounded-circle', 'mb-3');
                newImg.style.width = '120px';
                newImg.style.height = '120px';
                newImg.style.objectFit = 'cover';
                img.parentNode.replaceChild(newImg, img);
            }
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endsection