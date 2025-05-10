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
                    <form method="GET" action="{{ route('leads.show') }}" class="mb-5">

                        <!-- Selection Criteria -->
                        <div class="card p-4 mb-4">
                            <h5>Selection Criteria</h5>
                            <div class="row">
                                <!-- Nomor Dropdown -->
                                <div class="col-md-2">
                                    <select name="nomor" class="form-control">
                                        <option value="">Nomor</option>
                                        @foreach($nomors as $nomor)
                                            <option value="{{ $nomor }}" {{ request('nomor') == $nomor ? 'selected' : '' }}>{{ $nomor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Tanggal Dropdown -->
                                <div class="col-md-2">
                                    <select name="tanggal" class="form-control">
                                        <option value="">Tanggal</option>
                                        @foreach($dates as $date)
                                            <option value="{{ $date }}" {{ request('tanggal') == $date ? 'selected' : '' }}>{{ $date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Nama Dropdown -->
                                <div class="col-md-2">
                                    <select name="nama" class="form-control">
                                        <option value="">Nama</option>
                                        @foreach($names as $name)
                                            <option value="{{ $name }}" {{ request('nama') == $name ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- No HP Dropdown -->
                                <div class="col-md-2">
                                    <select name="nohp" class="form-control">
                                        <option value="">No HP</option>
                                        @foreach($phoneNumbers as $phone)
                                            <option value="{{ $phone }}" {{ request('nohp') == $phone ? 'selected' : '' }}>{{ $phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Alamat Dropdown -->
                                <div class="col-md-2">
                                    <select name="alamat" class="form-control">
                                        <option value="">Alamat</option>
                                        @foreach($alamats as $address)
                                            <option value="{{ $address }}" {{ request('alamat') == $address ? 'selected' : '' }}>{{ $address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Kelurahan Dropdown -->
                                <div class="col-md-2 mt-4 mb-4">
                                    <select name="kelurahan" class="form-control">
                                        <option value="">Kelurahan</option>
                                        @foreach($kelurahans as $kelurahan)
                                            <option value="{{ $kelurahan }}" {{ request('kelurahan') == $kelurahan ? 'selected' : '' }}>{{ $kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Kecamatan Dropdown -->
                                <div class="col-md-2 mt-4 mb-4">
                                    <select name="kecamatan" class="form-control">
                                        <option value="">Kecamatan</option>
                                        @foreach($kecamatans as $kecamatan)
                                            <option value="{{ $kecamatan }}" {{ request('kecamatan') == $kecamatan ? 'selected' : '' }}>{{ $kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Kota Dropdown -->
                                <div class="col-md-2 mt-4 mb-4">
                                    <select name="kota" class="form-control">
                                        <option value="">Kota</option>
                                        @foreach($kotas as $kota)
                                            <option value="{{ $kota }}" {{ request('kota') == $kota ? 'selected' : '' }}>{{ $kota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Tipe Dropdown -->
                                <div class="col-md-2 mt-4 mb-4">
                                    <select name="tipe" class="form-control">
                                        <option value="">Tipe</option>
                                        @foreach($tipi as $tipe)
                                            <option value="{{ $tipe }}" {{ request('tipe') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Warna Dropdown -->
                                <div class="col-md-2 mt-4 mb-4">
                                    <select name="warna" class="form-control">
                                        <option value="">Warna</option>
                                        @foreach($warna as $color)
                                            <option value="{{ $color }}" {{ request('warna') == $color ? 'selected' : '' }}>{{ $color }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Hargajual Dropdown -->
                                <div class="col-md-2">
                                    <select name="hargajual" class="form-control">
                                        <option value="">Harga Jual</option>
                                        @foreach($hargajuals as $harga)
                                            <option value="{{ $harga }}" {{ request('hargajual') == $harga ? 'selected' : '' }}>{{ $harga }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Discount Dropdown -->
                                <div class="col-md-2">
                                    <select name="discount" class="form-control">
                                        <option value="">Discount</option>
                                        @foreach($discounts as $disc)
                                            <option value="{{ $disc }}" {{ request('discount') == $disc ? 'selected' : '' }}>{{ $disc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <!-- Status Dropdown -->
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="">Status</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>                        

                        <!-- Template Save -->
                        <div class="d-flex gap-3 mb-3">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                            <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset Filter</button>
                        </div>

                        <!-- Field Data Selection -->
                        <div class="card p-4 mb-4 mt-4">
                            <h5>Field Data</h5>
                            <div class="row">
                                @foreach(['nomor', 'tipe', 'warna', 'nama', 'nohp', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'tanggal', 'hargajual', 'discount', 'status'] as $field)
                                    <div class="col-md-2 form-check form-switch">
                                        <input class="form-check-input mt-2 mb-2" type="checkbox" name="fields[]" value="{{ $field }}"
                                            {{ in_array($field, request()->get('fields', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label text-capitalize mt-2 mb-2">{{ $field }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Template Save -->
                        <div class="d-flex gap-3">
                            <button type="submit" name="save_template" value="1" class="btn btn-dark">Simpan Template</button>
                        </div>

                    </form>

                    <!-- Daftar Template -->
                    @if($templates->count())
                        <div class="card p-4 mb-4">
                            <h5>Templates</h5>
                            @foreach($templates as $template)
                                <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
                                    <div>
                                        <input type="checkbox" name="template_ids[]" value="{{ $template->id }}" class="form-check-input me-2"
                                            {{ in_array($template->id, request('template_ids', [])) ? 'checked' : '' }}>
                                        {{ $template->name }}
                                    </div>
                                    <div>
                                        <form action="{{ route('leads.deleteTemplate', $template->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Tombol Cetak -->
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-primary" onclick="submitPrintForms()">Cetak</button>
                    </div>

                </div>
            </div>

            <!-- Card: Tabel Leads -->
            <div class="card shadow-sm mt-6">
                <div class="card-header">
                    <h3 class="card-title">Data Leads</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="bg-light fw-bold">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kota</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Harga Jual</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead->nama }}</td>
                                        <td>{{ $lead->nohp }}</td>
                                        <td>{{ $lead->alamat }}</td>
                                        <td>{{ $lead->kelurahan }}</td>
                                        <td>{{ $lead->kecamatan }}</td>
                                        <td>{{ $lead->kota }}</td>
                                        <td>{{ $lead->tipe }}</td>
                                        <td>{{ $lead->warna }}</td>
                                        <td>{{ number_format($lead->hargajual) }}</td>
                                        <td>{{ $lead->discount }}</td>
                                        <td>{{ $lead->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Belum ada data leads.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script Cetak -->
<script>
    function submitPrintForms() {
        const selectedTemplates = document.querySelectorAll('input[name="template_ids[]"]:checked');
        if (selectedTemplates.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Pilih template terlebih dahulu untuk mencetak!'
            });
            return;
        }

        selectedTemplates.forEach(selected => {
            const templateId = selected.value;
            const pdfUrl = `{{ route('leads.cetak') }}?template=${templateId}&format=pdf`;
            const excelUrl = `{{ route('leads.cetak') }}?template=${templateId}&format=excel`;

            const pdfWindow = window.open(pdfUrl, '_blank');
            const excelWindow = window.open(excelUrl, '_blank');

            if (!pdfWindow || !excelWindow) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pop-up diblokir',
                    text: 'Harap izinkan pop-up di browser Anda untuk melanjutkan.'
                });
            }
        });
    }
</script>

<!-- SweetAlert Success & Error -->
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}'
        });
    @endif
</script>
<script>
    function resetFilter() {
        window.location.href = "{{ route('leads.show') }}";
    }
</script>

@endsection
