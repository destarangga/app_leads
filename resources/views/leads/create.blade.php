@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container py-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Buat Lead Baru</h3>
                </div>
                
                <div class="card-body">
                    <!-- Menampilkan pesan sukses jika ada -->
                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Menampilkan pesan error jika ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('leads.store') }}" method="POST">
                        @csrf

                        <!-- Opsi Input Manual -->
                        <h5>Input Lead Manual</h5>
                        <div class="mb-4">
                            <label class="form-label fw-bold" for="name">Nama Lead</label>
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

                        <div class="mb-4">
                            <label class="form-label fw-bold" for="phone">Telepon</label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold" for="address">Alamat</label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('address') is-invalid @enderror" 
                                   id="address" 
                                   name="address" 
                                   value="{{ old('address') }}" 
                                   required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" for="origin">Asal Lead</label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('origin') is-invalid @enderror" 
                                   id="origin" 
                                   name="origin" 
                                   value="{{ old('origin') }}" 
                                   required>
                            @error('origin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan untuk input manual -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-2"></i>Simpan Lead
                            </button>
                        </div>
                    </form>

                    <!-- Form Unggah Excel -->
                    <form action="{{ route('leads.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h5>Unggah Lead dari File Excel</h5>
                        <div class="mb-4">
                            <label class="form-label fw-bold" for="file">Pilih File Excel</label>
                            <input type="file" 
                                   class="form-control form-control-lg @error('file') is-invalid @enderror" 
                                   id="file" 
                                   name="file" 
                                   accept=".xlsx,.xls,.csv" 
                                   required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Unggah untuk Excel -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-upload me-2"></i>Unggah File
                            </button>
                            
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
