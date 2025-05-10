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
                        <h2 class="fs-2x fw-bold    mb-3">Selamat datang, {{ $user->name }}!</h2>
                        <div class="fs-5 text-gray-700">
                            <p class="mb-2"><span class="fw-semibold text-dark">Email:</span> {{ $user->email }}</p>
                            <p class="mb-4"><span class="fw-semibold text-dark">Role:</span> {{ $user->role }}</p>

                            @if ($user->role === 'admin')
                                <p class="mb-4">Anda memiliki akses penuh sebagai administrator sistem.</p>
                                <a href="{{ route('leads.show') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-database me-2"></i>Kelola Data
                                </a>
                            @else
                                <p class="mb-4">Selamat datang di panel Salesman kami.</p>
                                <a href="{{ route('leads.show') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-eye me-2"></i>Lihat Data
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-5">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h2>Statistik Leads</h2>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="row g-4">
                            <!-- Total Leads -->
                            <div class="col-md-4">
                                <div class="card shadow-lg border-0 bg-light">
                                    <div class="card-body text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-chart-line text-primary" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="card-title text-primary fw-bold mb-3">Total New Leads</h5>
                                        <p class="card-text" style="font-size: 2.5rem; font-family: 'Roboto', sans-serif; font-weight: 700; color: #000;">
                                            {{ $totalLeads }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Leads Diambil -->
                            
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