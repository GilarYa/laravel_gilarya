@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
    <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Pasien</span>
    </a>
</div>

<!-- Filter by Rumah Sakit -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
    </div>
    <div class="card-body">
        <div class="form-group row mb-0">
            <label for="filterRumahSakit" class="col-sm-2 col-form-label">Rumah Sakit:</label>
            <div class="col-sm-4">
                <select class="form-control" id="filterRumahSakit">
                    <option value="">-- Semua Rumah Sakit --</option>
                    @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}" {{ request('rumah_sakit_id') == $rs->id ? 'selected' : '' }}>{{ $rs->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
    </div>
    <div class="card-body">
        <div id="tableContainer">
            @include('pasien.partials.table', ['pasiens' => $pasiens])
        </div>
        <div class="d-flex justify-content-center" id="paginationContainer">
            {{ $pasiens->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Handle filter change with AJAX
    $('#filterRumahSakit').on('change', function() {
        var rumahSakitId = $(this).val();
        var baseUrl = window.location.origin + '/pasien';
        var url = baseUrl;
        
        if (rumahSakitId) {
            url += '?rumah_sakit_id=' + rumahSakitId;
        }
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#tableContainer').html(response.html);
                $('#paginationContainer').html(response.pagination);
                // Re-bind delete buttons
                bindDeleteButtons();
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memfilter data'
                });
            }
        });
    });
    
    // Bind delete buttons function with SweetAlert2
    function bindDeleteButtons() {
        $('.btn-delete').off('click').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus pasien "' + nama + '"?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: window.location.origin + '/pasien/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            var message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: message
                            });
                        }
                    });
                }
            });
        });
    }
    
    // Initial bind
    bindDeleteButtons();
});
</script>
@endpush
