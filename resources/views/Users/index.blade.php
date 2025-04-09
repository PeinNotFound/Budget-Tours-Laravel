@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td style="width: 70px;">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div style="width: 40px; height: 40px; background-color: {{ '#' . substr(md5($user->email), 0, 6) }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-transform: uppercase;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                <span class="badge {{ $user->is_admin ? 'badge-primary' : 'badge-secondary' }}" style="{{ $user->is_admin ? 'background: #FF4500; color: white;' : 'background: #6c757d; color: white;' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->id !== $user->id)
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-danger' : 'btn-success' }} mr-2" style="min-width: 110px; {{ $user->is_admin ? 'background: #dc3545; border-color: #dc3545;' : 'background: #28a745; border-color: #28a745;' }}">
                                                <i class="fas {{ $user->is_admin ? 'fa-user-minus' : 'fa-user-plus' }} mr-1"></i>
                                                {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info" style="background: #17a2b8; border-color: #17a2b8;">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .gap-2 {
        gap: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 50rem;
    }

    .table td {
        vertical-align: middle;
    }
</style>
@endsection