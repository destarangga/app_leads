@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container py-6">
            <!--begin::Card-->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Profil Pengguna</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="py-5">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- User Info Card -->
                                <div class="card border shadow-sm">
                                    <div class="card-body p-5">
                                        <h4 class="fs-4 fw-bold mb-4">Informasi Pengguna</h4>
                                        
                                        <div class="mb-4">
                                            <label class="fs-6 fw-semibold text-muted mb-2">Nama</label>
                                            <div class="fs-5">{{ $user->name }}</div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="fs-6 fw-semibold text-muted mb-2">Email</label>
                                            <div class="fs-5">{{ $user->email }}</div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex gap-2 mt-5">
                                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                                <i class="bi bi-pencil me-2"></i>
                                                Perbarui Profil
                                            </a>
                                            <a href="{{ route('dashboard') }}" class="btn btn-light">
                                                <i class="bi bi-arrow-left me-2"></i>
                                                Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Content wrapper-->
</div>
<!--end:::Main-->
@endsection