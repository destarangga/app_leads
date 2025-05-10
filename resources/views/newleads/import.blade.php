@extends('layouts.index')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container py-6">

            <!-- Card: Import Excel -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Data Lead Ekternal</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold" for="file">Pilih File Excel</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" accept=".xlsx,.xls,.csv" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-upload me-2"></i>Import Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

