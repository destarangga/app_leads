@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container">
            <!--begin::Card Statistik Leads-->
            <div class="card shadow-sm mt-5">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2>Statistik Leads</h2>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Total Leads</h5>
                                    <p class="card-text">{{ $totalLeads }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Leads Diambil</h5>
                                    <p class="card-text">{{ $takenLeads }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Leads Belum Diambil</h5>
                                    <p class="card-text">{{ $untakenLeads }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card Statistik Leads-->

            <!--begin::Card Daftar Leads-->
            <div class="card shadow-sm mt-5">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2>Daftar Leads</h2>
                    </div>
                    <!-- Tombol untuk membuat lead baru -->
                    <div class="card-toolbar d-flex gap-3">
                        @if ($user->role != 'salesman') <!-- Cek apakah role bukan salesman -->
                        <a href="{{ route('leads.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle"></i> Buat Lead Baru
                        </a>
                        @endif
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-file-excel"></i> Export Leads
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="dropdown-item" href="{{ route('leads.export', ['status' => 'taken']) }}">
                                        <i class="fas fa-check-circle text-success"></i> Export Taken Leads
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('leads.export', ['status' => 'untaken']) }}">
                                        <i class="fas fa-times-circle text-warning"></i> Export Untaken Leads
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('leads.export') }}">
                                        <i class="fas fa-list-alt text-primary"></i> Export All Leads
                                    </a>
                                </li>
                            </ul>
                        </div>                        
                    </div>                                       
                </div>

                <!-- Tampilkan pesan jika ada -->
                @if (session('success'))
                    <div class="alert alert-success mx-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Filter Form -->
                <div class="card-body py-4">
                    <form method="GET" action="{{ route('leads.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="status" class="form-control form-control-sm">
                                    <option value="">Semua Status</option>
                                    <option value="taken" {{ request('status') == 'taken' ? 'selected' : '' }}>Diambil</option>
                                    <option value="untaken" {{ request('status') == 'untaken' ? 'selected' : '' }}>Belum Diambil</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">NO</th>
                                    <th class="min-w-125px">Nama</th>
                                    <th class="min-w-125px">No HP</th>
                                    <th class="min-w-125px">Address</th>
                                    <th class="min-w-125px">Asal Leads</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-100px text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->phone }}</td>
                                        <td>{{ $lead->address }}</td>
                                        <td>{{ $lead->origin }}</td>
                                        <td>
                                            @if ($lead->taken_by_salesman)
                                                @if ($lead->salesman) <!-- Mengecek apakah salesman ada -->
                                                    <span class="badge py-3 px-4 fs-7 badge-light-success">
                                                        Diambil oleh: {{ $lead->salesman->name }}
                                                    </span>
                                                @else
                                                    <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                        Salesman Dihapus
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">
                                                    Belum Diambil
                                                </span>
                                            @endif
                                        </td>                                        
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                @if ($user->role != 'admin')
                                                    @if (!$lead->taken_by_salesman)
                                                        <form action="{{ route('leads.take', $lead->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-hand-pointer"></i> Ambil
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('leads.history', $lead->id) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-history"></i> Lihat Histori
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('leads.history', $lead->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-history"></i> Lihat Histori
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data leads.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
