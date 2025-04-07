@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container py-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah Admin</h3>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Nama -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="name">Nama</label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="email">Email</label>
                                    <input type="email" 
                                           class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="password">Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required>
                                </div>

                                <!-- Role -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="role">Role</label>
                                    <select class="form-control form-control-lg @error('role') is-invalid @enderror" 
                                            id="role" name="role" required>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol -->
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-lg me-2"></i>Tambah Admin
                                    </button>
                                    <a href="{{ route('auth.index') }}" class="btn btn-light btn-lg">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
</div>
<!--end:::Main-->
@endsection
