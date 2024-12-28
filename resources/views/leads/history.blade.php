@extends('layouts.index')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <div class="container py-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Follow-Up Lead</h3>
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

                     <!-- Kontainer untuk tombol dan tabel -->
                     <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Riwayat Follow-Up</h5>
                        <a href="{{ route('leads.export-history', ['id' => $lead->id]) }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel me-2"></i> Ekspor ke Excel
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">NO</th>
                                    <th class="min-w-150px">Metode Follow-Up</th>
                                    <th class="min-w-150px">Status</th>
                                    <th class="min-w-125px">Tanggal Follow-Up</th>
                                    <th class="min-w-200px">Keterangan</th>
                                    <th class="min-w-150px">Email</th>
                                    <th class="min-w-150px">Alamat</th>
                                    <th class="min-w-150px">Pekerjaan Pelanggan</th>
                                    <th class="min-w-150px">Hobi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($leadHistories as $history)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $history->follow_up_via }}</td>
                                        <td>{{ $history->status }}</td>
                                        <td>{{ $history->follow_up_date }}</td>
                                        <td>{{ $history->notes }}</td>
                                        <td>{{ $history->email }}</td>
                                        <td>{{ $history->address }}</td>
                                        <td>{{ $history->job }}</td>
                                        <td>{{ $history->hobby }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($user->role != 'admin')
                    <!-- Form Follow-Up -->
                    <div class="card shadow-sm mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Follow-Up</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('leads.follow-up', ['id' => $lead->id]) }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="follow_up_via">Metode Follow-Up</label>
                                    <select name="follow_up_via" id="follow_up_via" class="form-control form-control-lg @error('follow_up_via') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Metode</option>
                                        <option value="Telepon">Telepon</option>
                                        <option value="Email">Email</option>
                                        <option value="Pertemuan">Pertemuan</option>
                                    </select>
                                    @error('follow_up_via')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="status">Status Follow-Up</label>
                                    <select name="status" id="status" class="form-control form-control-lg @error('status') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="Sudah di Follow UP">Sudah di Follow UP</option>
                                        <option value="Follow UP ulang">Follow UP ulang</option>
                                        <option value="Belum di Follow UP">Belum di Follow UP</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="follow_up_date">Tanggal Follow-Up</label>
                                    <input type="date" name="follow_up_date" id="follow_up_date" class="form-control form-control-lg @error('follow_up_date') is-invalid @enderror" required>
                                    @error('follow_up_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="notes">Keterangan</label>
                                    <textarea name="notes" id="notes" class="form-control form-control-lg @error('notes') is-invalid @enderror"></textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kolom tambahan -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="address">Alamat</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-lg @error('address') is-invalid @enderror">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="job">Pekerjaan Pelanggan</label>
                                    <input type="text" name="job" id="job" class="form-control form-control-lg @error('job') is-invalid @enderror">
                                    @error('job')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" for="hobby">Hobi</label>
                                    <input type="text" name="hobby" id="hobby" class="form-control form-control-lg @error('hobby') is-invalid @enderror">
                                    @error('hobby')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-send me-2"></i>Tambah Follow-Up
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
</div>
<!--end:::Main-->
@endsection
