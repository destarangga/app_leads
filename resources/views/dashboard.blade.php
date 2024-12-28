@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container">
            <!--begin::Welcome Card-->
            <div class="card shadow-sm mb-5 mt-4">
                <div class="card-header bg-light border-0">
                    <h3 class="card-title fw-bold text-dark">Dashboard</h3>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <h2 class="fs-2x fw-bold mb-3">Selamat datang, {{ $user->name }}!</h2>
                        <div class="fs-5 text-gray-700">
                            <p class="mb-2"><span class="fw-semibold text-dark">Email:</span> {{ $user->email }}</p>
                            <p class="mb-4"><span class="fw-semibold text-dark">Role:</span> {{ $user->role }}</p>

                            @if ($user->role === 'admin')
                                <p class="mb-4">Anda memiliki akses penuh sebagai administrator sistem.</p>
                                <a href="{{ route('leads.index') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-database me-2"></i>Kelola Data
                                </a>
                            @else
                                <p class="mb-4">Selamat datang di panel Salesman kami.</p>
                                <a href="{{ route('leads.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-eye me-2"></i>Lihat Data
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Welcome Card-->
        </div>
    </div>
    <!--end::Content wrapper-->


</div>
<!--end:::Main-->
@endsection